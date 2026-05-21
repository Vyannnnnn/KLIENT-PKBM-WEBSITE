<!-- Breadcrumb -->
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pkbm-website/public/home">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Berita</li>
        </ol>
    </nav>
</div>

<!-- Main Content -->
<main>
    <div class="container py-5">
        <div class="mb-4">
            <h1 style="font-weight: 700;" class="text-dark">
                <i class="bi bi-newspaper"></i> Berita & Pengumuman
            </h1>
            <p class="text-muted">Informasi terbaru seputar kegiatan PKBM Sidandu Indah</p>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <?php if (!empty($news_list)): ?>
                    <?php foreach ($news_list as $news): ?>
                        <div class="card mb-4 border-0 shadow-sm" style="transition: all 0.3s;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <?php if (!empty($news['gambar'])): ?>
                                        <img src="<?php 
                                          $gambar = $news['gambar'];
                                          if (strpos($gambar, 'http') === false && strpos($gambar, 'https') === false) {
                                            echo htmlspecialchars('/pkbm-website/public/uploads/' . $gambar);
                                          } else {
                                            echo htmlspecialchars($gambar);
                                          }
                                        ?>" class="img-fluid rounded-start" alt="<?php echo htmlspecialchars($news['judul']); ?>" style="height: 220px; object-fit: cover; display: block; width: 100%;">
                                    <?php else: ?>
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded-start" style="height: 220px;">
                                            <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <span class="badge bg-primary"><?php echo htmlspecialchars($news['nama_kategori'] ?? 'Umum'); ?></span>
                                            <small class="text-muted ms-2">
                                                <i class="bi bi-calendar-event"></i> <?php echo date('d M Y', strtotime($news['tanggal'])); ?>
                                            </small>
                                        </div>
                                        <h5 class="card-title fw-bold"><?php echo htmlspecialchars($news['judul']); ?></h5>
                                        <p class="card-text text-muted"><?php echo substr(strip_tags($news['isi_berita']), 0, 150) . '...'; ?></p>
                                        <a href="/pkbm-website/public/news/detail/<?php echo $news['id_berita']; ?>" class="btn bg-warning btn-sm">
                                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill"></i> Belum ada berita. Silakan kembali lagi nanti.
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4" style="position: sticky; top: 80px;">
                    <div class="card-header bg-primary" style=" color: white; border: none;">
                        <h5 class="mb-0"><i class="bi bi-search"></i> Kategori Berita</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-tag"></i> Berita Umum
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-tag"></i> Kegiatan PKBM
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-tag"></i> Pengumuman Penting
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-tag"></i> Prestasi
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="bi bi-tag"></i> Promo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
