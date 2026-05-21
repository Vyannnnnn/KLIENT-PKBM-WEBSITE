<h1 class="mb-4"><i class="bi bi-plus-circle"></i> Tambah Berita</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Form Tambah Berita</h5>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select class="form-control" id="id_kategori" name="id_kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategoris as $kategori): ?>
                            <option value="<?php echo $kategori['id_kategori']; ?>">
                                <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tanggal" class="form-label">Tanggal Publikasi <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar (JPG, PNG, GIF - Max 5MB)</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                <small class="text-muted">Opsional. Jika tidak diupload, halaman akan menampilkan placeholder.</small>
            </div>

            <div class="mb-3">
                <label for="isi_berita" class="form-label">Isi Berita <span class="text-danger">*</span></label>
                <textarea class="form-control" id="isi_berita" name="isi_berita" rows="10" required></textarea>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Simpan Berita
                </button>
                <a href="/pkbm-website/public/admin-news" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('isi_berita').addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            e.preventDefault();
            const start = this.selectionStart;
            const end = this.selectionEnd;
            this.value = this.value.substring(0, start) + '\t' + this.value.substring(end);
            this.selectionStart = this.selectionEnd = start + 1;
        }
    });
</script>
