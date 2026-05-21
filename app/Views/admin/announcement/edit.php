<h1 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Pengumuman</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Form Edit Pengumuman</h5>
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo htmlspecialchars($announcement->judul); ?>" required>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Publikasi <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d\TH:i', strtotime($announcement->tanggal)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="isi_pengumuman" class="form-label">Isi Pengumuman <span class="text-danger">*</span></label>
                <textarea class="form-control" id="isi_pengumuman" name="isi_pengumuman" rows="10" required><?php echo htmlspecialchars($announcement->isi_pengumuman); ?></textarea>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Pengumuman
                </button>
                <a href="/pkbm-website/public/admin-announcement" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
