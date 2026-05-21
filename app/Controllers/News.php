<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    private $newsModel;

    public function __construct()
    {
        parent::__construct();
        $this->newsModel = new NewsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Berita & Pengumuman - PKBM Sidandu Indah',
            'news_list' => $this->newsModel->getAllWithCategory()
        ];

        $this->view('layout/header', $data);
        $this->view('news/index', $data);
        $this->view('layout/footer');
    }

    public function detail($id)
    {
        $news = $this->newsModel->getByIdWithCategory($id);
        
        if (!$news) {
            http_response_code(404);
            echo "Berita tidak ditemukan";
            return;
        }

        $data = [
            'title' => $news['judul'] . ' - PKBM Sidandu Indah',
            'news' => $news
        ];

        $this->view('layout/header', $data);
        $this->view('news/detail', $data);
        $this->view('layout/footer');
    }
}
