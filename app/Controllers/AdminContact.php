<?php

namespace App\Controllers;

use App\Models\ContactModel;
use App\Config\Auth;

class AdminContact extends BaseController
{
    private $contactModel;

    public function __construct()
    {
        parent::__construct();
        $this->contactModel = new ContactModel();
        Auth::startSession();
    }

    public function index()
    {
        Auth::requireLogin();

        $messages = $this->contactModel->getMessages();

        $data = [
            'title' => 'Kelola Pesan Kontak - Admin PKBM',
            'admin_name' => Auth::getAdminName(),
            'messages' => $messages
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/kontak/index', $data);
        $this->view('admin/layout/footer');
    }

    public function detail($id)
    {
        Auth::requireLogin();

        $message = $this->contactModel->getById($id);

        if (!$message) {
            $this->redirect('admin-contact');
        }

        if ($message['status'] === 'baru') {
            $this->contactModel->markAsRead($id);
        }

        $data = [
            'title' => 'Detail Pesan - Admin PKBM',
            'admin_name' => Auth::getAdminName(),
            'message' => $message
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/kontak/detail', $data);
        $this->view('admin/layout/footer');
    }

    public function delete($id)
    {
        Auth::requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->contactModel->delete($id)) {
                $this->redirectWithNotification('admin-contact', '✓ Dihapus', 'Pesan berhasil dihapus!', 'success');
            } else {
                $this->redirect('admin-contact');
            }
        }
    }
}
