<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;
use App\Config\Database;
use App\Config\Auth;

class AdminAnnouncement extends BaseController
{
    private $announcementModel;
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->announcementModel = new AnnouncementModel();
        $this->conn = Database::getConnection();
        Auth::startSession();
    }

    public function index()
    {
        Auth::requireLogin();

        $data = [
            'title' => 'Kelola Pengumuman - Admin PKBM',
            'admin_name' => Auth::getAdminName(),
            'announcements' => $this->announcementModel->getAll()
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/announcement/index', $data);
        $this->view('admin/layout/footer');
    }

    public function create()
    {
        Auth::requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $isi_pengumuman = $_POST['isi_pengumuman'] ?? '';
            $tanggal = $_POST['tanggal'] ?? date('Y-m-d H:i:s');

            if (empty($judul) || empty($isi_pengumuman)) {
                $error = 'Judul dan isi pengumuman harus diisi!';
            } else {
                $data_insert = [
                    'judul' => $judul,
                    'isi_pengumuman' => $isi_pengumuman,
                    'id_admin' => Auth::getAdminId(),
                    'tanggal' => $tanggal
                ];

                if ($this->announcementModel->insert($data_insert)) {
                    $this->redirectWithNotification('admin-announcement', '✓ Berhasil', 'Pengumuman baru berhasil ditambahkan!', 'success');
                } else {
                    $error = 'Gagal menyimpan data!';
                }
            }

            $data = [
                'title' => 'Tambah Pengumuman - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'error' => $error ?? ''
            ];
        } else {
            $data = [
                'title' => 'Tambah Pengumuman - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'error' => ''
            ];
        }

        $this->view('admin/layout/header', $data);
        $this->view('admin/announcement/create', $data);
        $this->view('admin/layout/footer');
    }

    public function edit($id)
    {
        Auth::requireLogin();

        $announcement = $this->announcementModel->getById($id);
        if (!$announcement) {
            http_response_code(404);
            echo "Pengumuman tidak ditemukan";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $isi_pengumuman = $_POST['isi_pengumuman'] ?? '';
            $tanggal = $_POST['tanggal'] ?? date('Y-m-d H:i:s');

            if (empty($judul) || empty($isi_pengumuman)) {
                $error = 'Judul dan isi pengumuman harus diisi!';
            } else {
                $query = "UPDATE tb_pengumuman SET judul='{$judul}', isi_pengumuman='{$isi_pengumuman}', tanggal='{$tanggal}' WHERE id_pengumuman={$id}";
                
                if ($this->conn->query($query)) {
                    $this->redirectWithNotification('admin-announcement', '✓ Diperbarui', 'Pengumuman berhasil diperbarui!', 'success');
                } else {
                    $error = 'Gagal mengupdate data!';
                }
            }

            $data = [
                'title' => 'Edit Pengumuman - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'announcement' => (object)$announcement,
                'error' => $error ?? ''
            ];
        } else {
            $data = [
                'title' => 'Edit Pengumuman - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'announcement' => (object)$announcement,
                'error' => ''
            ];
        }

        $this->view('admin/layout/header', $data);
        $this->view('admin/announcement/edit', $data);
        $this->view('admin/layout/footer');
    }

    public function delete($id)
    {
        Auth::requireLogin();
        
        if ($this->announcementModel->delete($id)) {
            $this->redirectWithNotification('admin-announcement', '✓ Dihapus', 'Pengumuman berhasil dihapus!', 'success');
        } else {
            $this->redirect('admin-announcement');
        }
    }
}
