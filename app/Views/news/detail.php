<!-- Breadcrumb -->
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pkbm-website/public/home">Beranda</a></li>
            <li class="breadcrumb-item"><a href="/pkbm-website/public/news">Berita</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($news['judul']); ?></li>
        </ol>
    </nav>
</div>

<!-- Main Content -->
<main>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <?php if ($news): ?>
                    <article>
                        <div class="mb-4">
                            <span class="badge bg-primary"><?php echo htmlspecialchars($news['nama_kategori'] ?? 'Umum'); ?></span>
                        </div>

                        <h1 class="mb-3"><?php echo htmlspecialchars($news['judul']); ?></h1>

                        <div class="text-muted mb-4">
                            <i class="bi bi-calendar-event"></i> <?php echo date('d M Y H:i', strtotime($news['tanggal'])); ?>
                        </div>

                        <?php if (!empty($news['gambar'])): ?>
                            <img src="<?php 
                              $gambar = $news['gambar'];
                              if (strpos($gambar, 'http') === false && strpos($gambar, 'https') === false) {
                                echo htmlspecialchars('/pkbm-website/public/uploads/' . $gambar);
                              } else {
                                echo htmlspecialchars($gambar);
                              }
                            ?>" class="img-fluid rounded mb-4" alt="<?php echo htmlspecialchars($news['judul']); ?>">
                        <?php endif; ?>

                        <div class="article-content mb-4">
                            <?php echo nl2br(htmlspecialchars($news['isi_berita'])); ?>
                        </div>

                        <div class="card bg-light">
                            <div class="card-body">
                                <h5><i class="bi bi-share"></i> Bagikan</h5>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-sm bg-primary me-2">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($news['judul']); ?>" target="_blank" class="btn btn-sm bg-primary me-2">
                                    <i class="bi bi-twitter"></i> Twitter
                                </a>
                                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($news['judul'] . ' ' . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-sm bg-primary">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </article>
                <?php else: ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i> Berita tidak ditemukan
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Artikel</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>Kategori:</strong><br>
                            <?php echo htmlspecialchars($news['nama_kategori'] ?? 'Umum'); ?>
                        </p>
                        <p>
                            <strong>Tanggal:</strong><br>
                            <?php echo date('d M Y H:i', strtotime($news['tanggal'])); ?>
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-newspaper"></i> Berita Lainnya</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Berita terbaru lainnya tersedia di halaman berita.</p>
                        <a href="/pkbm-website/public/news" class="btn btn-sm w-100" style="background-color: #003D82; color: #fff;">Lihat Semua Berita</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
