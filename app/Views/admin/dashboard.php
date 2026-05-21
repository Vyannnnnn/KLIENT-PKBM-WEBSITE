<h1 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h1>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-newspaper" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                <h5 class="card-title mt-3">Total Berita</h5>
                <h2 style="color: var(--primary-color);"><?php echo $total_news; ?></h2>
                <a href="/pkbm-website/public/admin-news" class="btn btn-primary btn-sm mt-2">Kelola Berita</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-megaphone" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                <h5 class="card-title mt-3">Total Pengumuman</h5>
                <h2 style="color: var(--primary-color);"><?php echo $total_announcements; ?></h2>
                <a href="/pkbm-website/public/admin-announcement" class="btn btn-primary btn-sm mt-2">Kelola Pengumuman</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-images" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                <h5 class="card-title mt-3">Total Galeri</h5>
                <h2 style="color: var(--primary-color);"><?php echo $total_gallery; ?></h2>
                <a href="/pkbm-website/public/admin-gallery" class="btn btn-primary btn-sm mt-2">Kelola Galeri</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-chat-left-text" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                <h5 class="card-title mt-3">Pesan Kontak</h5>
                <h2 style="color: var(--primary-color);">
                    <?php echo $total_messages; ?>
                    <?php if ($new_messages_count > 0): ?>
                        <span class="badge bg-danger" style="font-size: 0.6rem; margin-left: 5px;">+<?php echo $new_messages_count; ?></span>
                    <?php endif; ?>
                </h2>
                <a href="/pkbm-website/public/admin-contact" class="btn btn-primary btn-sm mt-2">Lihat Pesan</a>
            </div>
        </div>
    </div>

<hr class="my-4">

<!-- Quick Links -->
<div class="row mb-4">
    <div class="col-md-12">
        <h3 class="mb-3">Akses Cepat</h3>
        <div class="d-flex gap-2 flex-wrap">
            <a href="/pkbm-website/public/admin-news/create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Berita
            </a>
            <a href="/pkbm-website/public/admin-announcement/create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Pengumuman
            </a>
            <a href="/pkbm-website/public/admin-gallery/create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Galeri
            </a>
            <a href="/pkbm-website/public/home" class="btn btn-primary">
                <i class="bi bi-globe"></i> Lihat Website
            </a>
        </div>
    </div>
</div>

<!-- Recent News -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-newspaper"></i> Berita Terbaru</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($latest_news)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($latest_news as $news): ?>
                            <tr>
                                <td><?php echo htmlspecialchars(substr($news['judul'], 0, 40)); ?>...</td>
                                <td><?php echo htmlspecialchars($news['nama_kategori'] ?? '-'); ?></td>
                                <td><?php echo date('d M Y', strtotime($news['tanggal'])); ?></td>
                                <td>
                                    <a href="/pkbm-website/public/admin-news/edit/<?php echo $news['id_berita']; ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="showDeleteConfirm('/pkbm-website/public/admin-news/delete/<?php echo $news['id_berita']; ?>', 'Yakin ingin menghapus berita ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">Belum ada berita. <a href="/pkbm-website/public/admin-news/create">Tambah berita sekarang</a></p>
        <?php endif; ?>
    </div>
</div>
