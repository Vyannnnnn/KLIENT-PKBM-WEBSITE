<?php

namespace App\Controllers;

use App\Models\GalleryModel;

class Gallery extends BaseController
{
    private $galleryModel;

    public function __construct()
    {
        parent::__construct();
        $this->galleryModel = new GalleryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Galeri - PKBM Sidandu Indah',
            'gallery' => $this->galleryModel->getAll()
        ];

        $this->view('layout/header', $data);
        $this->view('gallery/index', $data);
        $this->view('layout/footer');
    }

    public function detail($id)
    {
        $photo = $this->galleryModel->getById($id);
        
        if (!$photo) {
            http_response_code(404);
            echo "Foto tidak ditemukan";
            return;
        }

        $data = [
            'title' => $photo['judul'] . ' - PKBM Sidandu Indah',
            'photo' => $photo
        ];

        $this->view('layout/header', $data);
        $this->view('gallery/detail', $data);
        $this->view('layout/footer');
    }
}
