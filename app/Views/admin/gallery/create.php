<h1 class="mb-4"><i class="bi bi-plus-circle"></i> Tambah Foto Galeri</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Form Tambah Foto Galeri</h5>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Foto <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Pelatihan Komputer Peserta PKBM" required>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto <span class="text-danger">*</span> (JPG, PNG, GIF - Max 10MB)</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                <small class="text-muted">Pilih file foto yang akan diupload ke galeri.</small>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Simpan Foto
                </button>
                <a href="/pkbm-website/public/admin-gallery" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
