<h1 class="mb-4"><i class="bi bi-newspaper"></i> Kelola Berita</h1>

<div class="mb-3">
    <a href="/pkbm-website/public/admin-news/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Berita Baru
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Berita</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($news_list)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($news_list as $news): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars(substr($news['judul'], 0, 50)); ?></td>
                                <td><span class="badge bg-info"><?php echo htmlspecialchars($news['nama_kategori'] ?? '-'); ?></span></td>
                                <td><?php echo date('d M Y', strtotime($news['tanggal'])); ?></td>
                                <td>
                                    <?php if (!empty($news['gambar'])): ?>
                                        <small class="badge bg-success"><i class="bi bi-image"></i> Ada</small>
                                    <?php else: ?>
                                        <small class="badge bg-secondary">Tidak</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/pkbm-website/public/admin-news/edit/<?php echo $news['id_berita']; ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" title="Hapus" onclick="showDeleteConfirm('/pkbm-website/public/admin-news/delete/<?php echo $news['id_berita']; ?>', 'Yakin ingin menghapus berita ini? Data tidak dapat dikembalikan.')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Belum ada berita. <a href="/pkbm-website/public/admin-news/create">Tambah berita sekarang</a>
            </div>
        <?php endif; ?>
    </div>
</div>
