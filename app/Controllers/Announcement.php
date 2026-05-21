<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;

class Announcement extends BaseController
{
    private $announcementModel;

    public function __construct()
    {
        parent::__construct();
        $this->announcementModel = new AnnouncementModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengumuman - PKBM Sidandu Indah',
            'announcements' => $this->announcementModel->getAll()
        ];

        $this->view('layout/header', $data);
        $this->view('announcement/index', $data);
        $this->view('layout/footer');
    }

    public function detail($id)
    {
        $announcement = $this->announcementModel->getById($id);
        
        if (!$announcement) {
            http_response_code(404);
            echo "Pengumuman tidak ditemukan";
            return;
        }

        $data = [
            'title' => $announcement['judul'] . ' - PKBM Sidandu Indah',
            'announcement' => $announcement
        ];

        $this->view('layout/header', $data);
        $this->view('announcement/detail', $data);
        $this->view('layout/footer');
    }
}
