# PKBM Sidandu Indah Website

## Deskripsi Profesional
Website **PKBM Sidandu Indah** adalah aplikasi web profil lembaga pendidikan nonformal yang dirancang untuk menyajikan informasi publik secara cepat, rapi, dan mudah diakses. Sistem ini mendukung publikasi berita, pengumuman, galeri kegiatan, profil lembaga, serta kanal kontak masyarakat, sekaligus menyediakan panel admin untuk pengelolaan konten secara terstruktur.

## Tujuan Proyek
- Menyediakan pusat informasi resmi PKBM Sidandu Indah.
- Mempermudah pengelolaan konten oleh administrator.
- Meningkatkan komunikasi antara lembaga dan masyarakat.

## Fitur Utama
### Halaman Publik
- Beranda dengan ringkasan berita, pengumuman, dan galeri terbaru.
- Halaman berita dengan detail konten.
- Halaman pengumuman dengan detail informasi.
- Halaman galeri kegiatan.
- Halaman profil lembaga.
- Formulir kontak untuk pesan dari pengunjung.

### Panel Admin
- Login admin.
- Dashboard ringkasan data.
- Manajemen berita (tambah, ubah, hapus).
- Manajemen pengumuman (tambah, ubah, hapus).
- Manajemen galeri (tambah, ubah, hapus).
- Manajemen pesan/kontak masuk.

## Struktur Direktori
- `app/Controllers` : Logika request dan routing per fitur.
- `app/Models` : Akses data database (berita, pengumuman, galeri, kontak, admin).
- `app/Views` : Tampilan frontend dan backend.
- `public/` : Entry point aplikasi (`index.php`), aset CSS/JS, gambar, dan upload.

## Teknologi
- PHP (arsitektur MVC sederhana)
- MySQL/MariaDB (melalui MySQLi)
- HTML, CSS, JavaScript
- Bootstrap Icons (pada tampilan)

## Cara Menjalankan (Lokal)
1. Siapkan server lokal PHP + MySQL (XAMPP/Laragon/setara).
2. Pastikan struktur project berada pada root web server.
3. Buat konfigurasi database pada:
   - `app/Config/Database.php`
   - `app/Config/Auth.php`
4. Buat database dan tabel sesuai kebutuhan model (`tb_admin`, `tb_berita`, `tb_kategori`, `tb_pengumuman`, `tb_galeri`, `tb_kontak`).
5. Jalankan aplikasi melalui URL:
   - `http://localhost/pkbm-website/public`

## Catatan
- Folder `public/uploads` digunakan untuk file media unggahan.
- Pastikan hak akses folder upload sesuai agar proses unggah berjalan lancar.

---
Dokumentasi ini dapat dikembangkan lebih lanjut dengan menambahkan panduan deployment, backup database, dan SOP operasional admin.
