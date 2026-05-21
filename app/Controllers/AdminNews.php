<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\BaseModel;
use App\Config\Database;
use App\Config\Auth;

class AdminNews extends BaseController
{
    private $newsModel;
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->newsModel = new NewsModel();
        $this->conn = Database::getConnection();
        Auth::startSession();
    }

    public function index()
    {
        Auth::requireLogin();

        $data = [
            'title' => 'Kelola Berita - Admin PKBM',
            'admin_name' => Auth::getAdminName(),
            'news_list' => $this->newsModel->getAllWithCategory()
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/news/index', $data);
        $this->view('admin/layout/footer');
    }

    public function create()
    {
        Auth::requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $isi_berita = $_POST['isi_berita'] ?? '';
            $id_kategori = $_POST['id_kategori'] ?? '';
            $tanggal = $_POST['tanggal'] ?? date('Y-m-d H:i:s');
            $gambar = '';

            if (empty($judul) || empty($isi_berita) || empty($id_kategori)) {
                $error = 'Semua field harus diisi!';
            } else {
                if (!empty($_FILES['gambar']['name'])) {
                    $file = $_FILES['gambar'];
                    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                    $filename = basename($file['name']);
                    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                    if (!in_array($ext, $allowed)) {
                        $error = 'Format file tidak didukung! Gunakan JPG, PNG, atau GIF.';
                    } elseif ($file['size'] > 5242880) { // 5MB
                        $error = 'Ukuran file terlalu besar! Max 5MB.';
                    } else {
                        $new_filename = 'news_' . time() . '.' . $ext;
                        $upload_path = __DIR__ . '/../../public/uploads/' . $new_filename;

                        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                            $gambar = $new_filename;
                        } else {
                            $error = 'Gagal mengupload file!';
                        }
                    }
                }

                if (empty($error)) {
                    $data_insert = [
                        'judul' => $judul,
                        'isi_berita' => $isi_berita,
                        'id_kategori' => $id_kategori,
                        'id_admin' => Auth::getAdminId(),
                        'tanggal' => $tanggal,
                        'gambar' => $gambar
                    ];

                    if ($this->newsModel->insert($data_insert)) {
                        $this->redirectWithNotification('admin-news', '✓ Berhasil', 'Berita baru berhasil ditambahkan!', 'success');
                    } else {
                        $error = 'Gagal menyimpan data!';
                    }
                }
            }

            $data = [
                'title' => 'Tambah Berita - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'kategoris' => $this->getKategoris(),
                'error' => $error ?? ''
            ];
        } else {
            $data = [
                'title' => 'Tambah Berita - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'kategoris' => $this->getKategoris(),
                'error' => ''
            ];
        }

        $this->view('admin/layout/header', $data);
        $this->view('admin/news/create', $data);
        $this->view('admin/layout/footer');
    }

    public function edit($id)
    {
        Auth::requireLogin();

        $news = $this->newsModel->getByIdWithCategory($id);
        if (!$news) {
            http_response_code(404);
            echo "Berita tidak ditemukan";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $isi_berita = $_POST['isi_berita'] ?? '';
            $id_kategori = $_POST['id_kategori'] ?? '';
            $tanggal = $_POST['tanggal'] ?? date('Y-m-d H:i:s');
            $gambar = $news['gambar'];

            if (empty($judul) || empty($isi_berita) || empty($id_kategori)) {
                $error = 'Semua field harus diisi!';
            } else {
                if (!empty($_FILES['gambar']['name'])) {
                    $file = $_FILES['gambar'];
                    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                    $filename = basename($file['name']);
                    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                    if (!in_array($ext, $allowed)) {
                        $error = 'Format file tidak didukung!';
                    } elseif ($file['size'] > 5242880) {
                        $error = 'Ukuran file terlalu besar!';
                    } else {
                        if (!empty($gambar)) {
                            $old_file = __DIR__ . '/../../public/uploads/' . $gambar;
                            if (file_exists($old_file)) {
                                unlink($old_file);
                            }
                        }

                        $new_filename = 'news_' . time() . '.' . $ext;
                        $upload_path = __DIR__ . '/../../public/uploads/' . $new_filename;

                        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                            $gambar = $new_filename;
                        } else {
                            $error = 'Gagal mengupload file!';
                        }
                    }
                }

                if (empty($error)) {
                    $data_update = [
                        'judul' => $judul,
                        'isi_berita' => $isi_berita,
                        'id_kategori' => $id_kategori,
                        'tanggal' => $tanggal,
                        'gambar' => $gambar
                    ];

                    $query = "UPDATE tb_berita SET judul='{$judul}', isi_berita='{$isi_berita}', id_kategori={$id_kategori}, tanggal='{$tanggal}', gambar='{$gambar}' WHERE id_berita={$id}";
                    
                    if ($this->conn->query($query)) {
                        $this->redirectWithNotification('admin-news', '✓ Diperbarui', 'Berita berhasil diperbarui!', 'success');
                    } else {
                        $error = 'Gagal mengupdate data!';
                    }
                }
            }

            $data = [
                'title' => 'Edit Berita - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'news' => (object)$news,
                'kategoris' => $this->getKategoris(),
                'error' => $error ?? ''
            ];
        } else {
            $data = [
                'title' => 'Edit Berita - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'news' => (object)$news,
                'kategoris' => $this->getKategoris(),
                'error' => ''
            ];
        }

        $this->view('admin/layout/header', $data);
        $this->view('admin/news/edit', $data);
        $this->view('admin/layout/footer');
    }

    public function delete($id)
    {
        Auth::requireLogin();

        $news = $this->newsModel->getByIdWithCategory($id);
        if ($news && !empty($news['gambar'])) {
            $old_file = __DIR__ . '/../../public/uploads/' . $news['gambar'];
            if (file_exists($old_file)) {
                unlink($old_file);
            }
        }

        if ($this->newsModel->delete($id)) {
            $this->redirectWithNotification('admin-news', '✓ Dihapus', 'Berita berhasil dihapus!', 'success');
        } else {
            $this->redirect('admin-news');
        }
    }

    private function getKategoris()
    {
        $query = "SELECT * FROM tb_kategori ORDER BY nama_kategori ASC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
