<h1 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Foto Galeri</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Form Edit Foto Galeri</h5>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Foto <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo htmlspecialchars($photo->judul); ?>" required>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d\TH:i', strtotime($photo->tanggal)); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Saat Ini</label>
                <div class="mb-3">
                    <img src="/pkbm-website/public/uploads/<?php echo htmlspecialchars($photo->foto); ?>" style="max-width: 300px; max-height: 300px; object-fit: cover;" alt="<?php echo htmlspecialchars($photo->judul); ?>" class="img-thumbnail">
                </div>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Ganti Foto (JPG, PNG, GIF - Max 10MB)</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Foto
                </button>
                <a href="/pkbm-website/public/admin-gallery" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
