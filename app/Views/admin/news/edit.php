<h1 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Berita</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Form Edit Berita</h5>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo htmlspecialchars($news->judul); ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select class="form-control" id="id_kategori" name="id_kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategoris as $kategori): ?>
                            <option value="<?php echo $kategori['id_kategori']; ?>" <?php echo ($kategori['id_kategori'] == $news->id_kategori) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tanggal" class="form-label">Tanggal Publikasi <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d\TH:i', strtotime($news->tanggal)); ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar (JPG, PNG, GIF - Max 5MB)</label>
                <div class="mb-2">
                    <?php if (!empty($news->gambar)): ?>
                        <div>
                            <p><strong>Gambar saat ini:</strong></p>
                            <img src="/pkbm-website/public/uploads/<?php echo htmlspecialchars($news->gambar); ?>" style="max-width: 200px; max-height: 200px; margin-bottom: 10px;">
                            <p><small class="text-muted">Untuk mengganti gambar, pilih file baru di bawah ini</small></p>
                        </div>
                    <?php endif; ?>
                </div>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="isi_berita" class="form-label">Isi Berita <span class="text-danger">*</span></label>
                <textarea class="form-control" id="isi_berita" name="isi_berita" rows="10" required><?php echo htmlspecialchars($news->isi_berita); ?></textarea>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Berita
                </button>
                <a href="/pkbm-website/public/admin-news" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
