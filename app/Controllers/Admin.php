<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\NewsModel;
use App\Models\AnnouncementModel;
use App\Models\GalleryModel;
use App\Models\ContactModel;
use App\Config\Auth;

class Admin extends BaseController
{
    private $adminModel;
    private $newsModel;
    private $announcementModel;
    private $galleryModel;
    private $contactModel;

    public function __construct()
    {
        parent::__construct();
        $this->adminModel = new AdminModel();
        $this->newsModel = new NewsModel();
        $this->announcementModel = new AnnouncementModel();
        $this->galleryModel = new GalleryModel();
        $this->contactModel = new ContactModel();
        Auth::startSession();
    }

    public function login()
    {
        if (Auth::isLoggedIn()) {
            $this->redirect('admin/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $error = '';

            if (empty($username) || empty($password)) {
                $error = 'Username dan password harus diisi!';
            } else {
                $admin = $this->adminModel->getByUsername($username);

                if (!$admin) {
                    $error = 'Username tidak ditemukan!';
                } elseif (!$this->adminModel->verifyPassword($password, $admin['password'])) {
                    $error = 'Password salah!';
                } else {
                    Auth::login($admin['id_admin'], $admin['username'], $admin['nama_admin']);
                    $this->redirect('admin/dashboard');
                }
            }

            $data = ['error' => $error];
        } else {
            $data = ['error' => ''];
        }

        $this->view('admin/login', $data);
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('home');
    }

    public function updateActivity()
    {
        Auth::startSession();
        
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            $_SESSION['last_activity'] = time();
            $this->json(['status' => 'success', 'message' => 'Activity updated']);
        } else {
            http_response_code(401);
            $this->json(['status' => 'error', 'message' => 'Not logged in'], 401);
        }
    }

    public function dashboard()
    {
        Auth::requireLogin();

        $messages = $this->contactModel->getMessages();
        $new_messages = array_filter($messages, fn($msg) => $msg['status'] === 'baru');

        $data = [
            'title' => 'Dashboard Admin - PKBM Sidandu Indah',
            'admin_name' => Auth::getAdminName(),
            'total_news' => count($this->newsModel->getAll()),
            'total_announcements' => count($this->announcementModel->getAll()),
            'total_gallery' => count($this->galleryModel->getAll()),
            'total_messages' => count($messages),
            'new_messages_count' => count($new_messages),
            'latest_news' => array_slice($this->newsModel->getAll(), 0, 5)
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('admin/layout/footer');
    }
}
