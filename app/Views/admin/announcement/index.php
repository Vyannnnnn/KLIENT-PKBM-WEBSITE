<h1 class="mb-4"><i class="bi bi-megaphone"></i> Kelola Pengumuman</h1>

<div class="mb-3">
    <a href="/pkbm-website/public/admin-announcement/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Pengumuman Baru
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Pengumuman</h5>
    </div>
    <div class="card-body">
        <?php if (!empty($announcements)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Isi (Preview)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($announcements as $announce): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars(substr($announce['judul'], 0, 50)); ?></td>
                                <td><?php echo date('d M Y H:i', strtotime($announce['tanggal'])); ?></td>
                                <td><?php echo htmlspecialchars(substr(strip_tags($announce['isi_pengumuman']), 0, 40)); ?>...</td>
                                <td>
                                    <a href="/pkbm-website/public/admin-announcement/edit/<?php echo $announce['id_pengumuman']; ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" title="Hapus" onclick="showDeleteConfirm('/pkbm-website/public/admin-announcement/delete/<?php echo $announce['id_pengumuman']; ?>', 'Yakin ingin menghapus pengumuman ini? Data tidak dapat dikembalikan.')">
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
                <i class="bi bi-info-circle"></i> Belum ada pengumuman. <a href="/pkbm-website/public/admin-announcement/create">Tambah pengumuman sekarang</a>
            </div>
        <?php endif; ?>
    </div>
</div>
