<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use App\Config\Database;
use App\Config\Auth;

class AdminGallery extends BaseController
{
    private $galleryModel;
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->galleryModel = new GalleryModel();
        $this->conn = Database::getConnection();
        Auth::startSession();
    }

    public function index()
    {
        Auth::requireLogin();

        $data = [
            'title' => 'Kelola Galeri - Admin PKBM',
            'admin_name' => Auth::getAdminName(),
            'gallery' => $this->galleryModel->getAll()
        ];

        $this->view('admin/layout/header', $data);
        $this->view('admin/gallery/index', $data);
        $this->view('admin/layout/footer');
    }

    public function create()
    {
        Auth::requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $tanggal = $_POST['tanggal'] ?? date('Y-m-d H:i:s');
            $error = '';
            $foto = '';

            if (empty($judul) || empty($_FILES['foto']['name'])) {
                $error = 'Judul dan foto harus diisi!';
            } else {
                $file = $_FILES['foto'];
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $filename = basename($file['name']);
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                if (!in_array($ext, $allowed)) {
                    $error = 'Format file tidak didukung! Gunakan JPG, PNG, atau GIF.';
                } elseif ($file['size'] > 10485760) { // 10MB
                    $error = 'Ukuran file terlalu besar! Max 10MB.';
                } else {
                    $new_filename = 'gallery_' . time() . '.' . $ext;
                    $upload_path = __DIR__ . '/../../public/uploads/' . $new_filename;

                    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                        $foto = $new_filename;

                        $data_insert = [
                            'judul' => $judul,
                            'foto' => $foto,
                            'id_admin' => Auth::getAdminId(),
                            'tanggal' => $tanggal
                        ];

                        if ($this->galleryModel->insert($data_insert)) {
                            $this->redirectWithNotification('admin-gallery', '✓ Berhasil', 'Foto baru berhasil ditambahkan ke galeri!', 'success');
                        } else {
                            $error = 'Gagal menyimpan data!';
                        }
                    } else {
                        $error = 'Gagal mengupload file!';
                    }
                }
            }

            $data = [
                'title' => 'Tambah Galeri - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'error' => $error
            ];
        } else {
            $data = [
                'title' => 'Tambah Galeri - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'error' => ''
            ];
        }

        $this->view('admin/layout/header', $data);
        $this->view('admin/gallery/create', $data);
        $this->view('admin/layout/footer');
    }

    public function edit($id)
    {
        Auth::requireLogin();

        $photo = $this->galleryModel->getById($id);
        if (!$photo) {
            http_response_code(404);
            echo "Foto tidak ditemukan";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $tanggal = $_POST['tanggal'] ?? date('Y-m-d H:i:s');
            $foto = $photo['foto'];
            $error = '';

            if (empty($judul)) {
                $error = 'Judul harus diisi!';
            } else {
                if (!empty($_FILES['foto']['name'])) {
                    $file = $_FILES['foto'];
                    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                    $filename = basename($file['name']);
                    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                    if (!in_array($ext, $allowed)) {
                        $error = 'Format file tidak didukung!';
                    } elseif ($file['size'] > 10485760) {
                        $error = 'Ukuran file terlalu besar!';
                    } else {
                        if (!empty($foto)) {
                            $old_file = __DIR__ . '/../../public/uploads/' . $foto;
                            if (file_exists($old_file)) {
                                unlink($old_file);
                            }
                        }

                        $new_filename = 'gallery_' . time() . '.' . $ext;
                        $upload_path = __DIR__ . '/../../public/uploads/' . $new_filename;

                        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                            $foto = $new_filename;
                        } else {
                            $error = 'Gagal mengupload file!';
                        }
                    }
                }

                if (empty($error)) {
                    $query = "UPDATE tb_galeri SET judul='{$judul}', foto='{$foto}', tanggal='{$tanggal}' WHERE id_galeri={$id}";
                    
                    if ($this->conn->query($query)) {
                        $this->redirectWithNotification('admin-gallery', '✓ Diperbarui', 'Data galeri berhasil diperbarui!', 'success');
                    } else {
                        $error = 'Gagal mengupdate data!';
                    }
                }
            }

            $data = [
                'title' => 'Edit Galeri - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'photo' => (object)$photo,
                'error' => $error
            ];
        } else {
            $data = [
                'title' => 'Edit Galeri - Admin PKBM',
                'admin_name' => Auth::getAdminName(),
                'photo' => (object)$photo,
                'error' => ''
            ];
        }

        $this->view('admin/layout/header', $data);
        $this->view('admin/gallery/edit', $data);
        $this->view('admin/layout/footer');
    }

    public function delete($id)
    {
        Auth::requireLogin();

        $photo = $this->galleryModel->getById($id);
        if ($photo && !empty($photo['foto'])) {
            $old_file = __DIR__ . '/../../public/uploads/' . $photo['foto'];
            if (file_exists($old_file)) {
                unlink($old_file);
            }
        }

        if ($this->galleryModel->delete($id)) {
            $this->redirectWithNotification('admin-gallery', '✓ Dihapus', 'Foto berhasil dihapus dari galeri!', 'success');
        } else {
            $this->redirect('admin-gallery');
        }
    }
}
