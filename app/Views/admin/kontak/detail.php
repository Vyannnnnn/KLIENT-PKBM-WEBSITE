<div class="mb-4">
    <a href="/pkbm-website/public/admin-contact" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-header" style="background-color: var(--primary-color); color: white;">
        <h5 class="mb-0">
            <i class="bi bi-envelope-open"></i> Detail Pesan
        </h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Pengirim</label>
                <p class="form-control-plaintext">
                    <strong><?php echo htmlspecialchars($message['nama']); ?></strong>
                </p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <p class="form-control-plaintext">
                    <?php if ($message['status'] === 'baru'): ?>
                        <span class="badge bg-danger">Baru</span>
                    <?php elseif ($message['status'] === 'dibaca'): ?>
                        <span class="badge bg-warning text-dark">Dibaca</span>
                    <?php else: ?>
                        <span class="badge bg-success">Dibalas</span>
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <p class="form-control-plaintext">
                    <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>">
                        <?php echo htmlspecialchars($message['email']); ?>
                    </a>
                </p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Telepon</label>
                <p class="form-control-plaintext">
                    <?php if ($message['telepon']): ?>
                        <a href="tel:<?php echo htmlspecialchars($message['telepon']); ?>">
                            <?php echo htmlspecialchars($message['telepon']); ?>
                        </a>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label class="form-label">Tanggal Dikirim</label>
                <p class="form-control-plaintext">
                    <?php echo date('d M Y H:i:s', strtotime($message['created_at'])); ?>
                </p>
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <label class="form-label">Pesan</label>
            <div class="p-3" style="background-color: #f8f9fa; border-radius: 5px; min-height: 150px;">
                <p class="mb-0" style="white-space: pre-wrap;">
                    <?php echo nl2br(htmlspecialchars($message['pesan'])); ?>
                </p>
            </div>
        </div>

        <hr>

        <div class="d-flex gap-2">
            <button class="btn btn-danger" onclick="showDeleteConfirm('/pkbm-website/public/admin-contact/delete/<?php echo $message['id_kontak']; ?>', 'Apakah Anda yakin ingin menghapus pesan ini? Tindakan ini tidak dapat dibatalkan.')">
                <i class="bi bi-trash"></i> Hapus Pesan
            </button>
        </div>
    </div>
</div>
