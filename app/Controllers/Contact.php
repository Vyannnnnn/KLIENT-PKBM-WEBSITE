<?php

namespace App\Controllers;

use App\Models\ContactModel;

class Contact extends BaseController
{
    private $contactModel;

    public function __construct()
    {
        parent::__construct();
        $this->contactModel = new ContactModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Hubungi Kami - PKBM Sidandu Indah'
        ];

        $this->view('layout/header', $data);
        $this->view('contact/index', $data);
        $this->view('layout/footer');
    }

    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['error' => 'Method tidak diizinkan'], 405);
        }

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $message = $_POST['message'] ?? '';

        if (empty($name) || empty($email) || empty($message)) {
            $this->json(['error' => 'Data tidak lengkap'], 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->json(['error' => 'Email tidak valid'], 400);
        }

        try {
            $result = $this->contactModel->saveMessage($name, $email, $phone, $message);
            
            if ($result) {
                $this->json(['success' => 'Pesan Anda telah dikirim dan disimpan. Terima kasih!'], 200);
            } else {
                $this->json(['error' => 'Gagal menyimpan pesan. Silakan coba lagi.'], 500);
            }
        } catch (\Exception $e) {
            $this->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}

