<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\AnnouncementModel;
use App\Models\GalleryModel;

class Home extends BaseController
{
    private $newsModel;
    private $announcementModel;
    private $galleryModel;

    public function __construct()
    {
        parent::__construct();
        $this->newsModel = new NewsModel();
        $this->announcementModel = new AnnouncementModel();
        $this->galleryModel = new GalleryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda - PKBM Sidandu Indah',
            'latest_news' => $this->newsModel->getLatestNews(3),
            'announcements' => $this->announcementModel->getLatest(3),
            'gallery' => $this->galleryModel->getLatest(6)
        ];

        $this->view('layout/header', $data);
        $this->view('home/index', $data);
        $this->view('layout/footer');
    }
}
