<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Profil PKBM - PKBM Sidandu Indah'
        ];

        $this->view('layout/header', $data);
        $this->view('profile/index', $data);
        $this->view('layout/footer');
    }
}
