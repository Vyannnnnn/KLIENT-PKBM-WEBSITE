<h1 class="mb-4"><i class="bi bi-chat-left-text"></i> Kelola Pesan Kontak</h1>

<?php if (!empty($messages)): ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($messages as $msg): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <?php if ($msg['status'] === 'baru'): ?>
                                <strong><?php echo htmlspecialchars($msg['nama']); ?></strong>
                                <span class="badge badge-danger ms-2">Baru</span>
                            <?php else: ?>
                                <?php echo htmlspecialchars($msg['nama']); ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($msg['email']); ?></td>
                        <td><?php echo htmlspecialchars($msg['telepon'] ?? '-'); ?></td>
                        <td>
                            <?php if ($msg['status'] === 'baru'): ?>
                                <span class="badge bg-danger">Baru</span>
                            <?php elseif ($msg['status'] === 'dibaca'): ?>
                                <span class="badge bg-warning text-dark">Dibaca</span>
                            <?php else: ?>
                                <span class="badge bg-success">Dibalas</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('d M Y H:i', strtotime($msg['created_at'])); ?></td>
                        <td>
                            <a href="/pkbm-website/public/admin-contact/detail/<?php echo $msg['id_kontak']; ?>" 
                               class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="showDeleteConfirm('/pkbm-website/public/admin-contact/delete/<?php echo $msg['id_kontak']; ?>', 'Apakah Anda yakin ingin menghapus pesan ini? Data tidak dapat dikembalikan.')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php else: ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Tidak ada pesan kontak.
    </div>
<?php endif; ?>

<style>
    .badge-danger {
        background-color: #dc3545 !important;
    }
</style>
