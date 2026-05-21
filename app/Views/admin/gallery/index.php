<h1 class="mb-4"><i class="bi bi-images"></i> Kelola Galeri</h1>

<div class="mb-3">
    <a href="/pkbm-website/public/admin-gallery/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Foto Baru
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Galeri Foto</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($gallery)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Foto</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($gallery as $photo): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars(substr($photo['judul'], 0, 50)); ?></td>
                                <td>
                                    <img src="/pkbm-website/public/uploads/<?php echo htmlspecialchars($photo['foto']); ?>" style="max-width: 100px; max-height: 80px; object-fit: cover;" alt="<?php echo htmlspecialchars($photo['judul']); ?>">
                                </td>
                                <td><?php echo date('d M Y', strtotime($photo['tanggal'])); ?></td>
                                <td>
                                    <a href="/pkbm-website/public/admin-gallery/edit/<?php echo $photo['id_galeri']; ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" title="Hapus" onclick="showDeleteConfirm('/pkbm-website/public/admin-gallery/delete/<?php echo $photo['id_galeri']; ?>', 'Yakin ingin menghapus foto ini? Data tidak dapat dikembalikan.')">
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
                <i class="bi bi-info-circle"></i> Belum ada foto di galeri. <a href="/pkbm-website/public/admin-gallery/create">Tambah foto sekarang</a>
            </div>
        <?php endif; ?>
    </div>
</div>
