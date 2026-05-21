<!-- Breadcrumb -->
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pkbm-website/public/home">Beranda</a></li>
            <li class="breadcrumb-item"><a href="/pkbm-website/public/announcement">Pengumuman</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($announcement['judul']); ?></li>
        </ol>
    </nav>
</div>

<!-- Main Content -->
<main>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <?php if ($announcement): ?>
                    <article>
                        <div class="mb-4">
                            <span class="badge bg-danger">Pengumuman Penting</span>
                        </div>

                        <h1 class="mb-3"><?php echo htmlspecialchars($announcement['judul']); ?></h1>

                        <div class="text-muted mb-4 pb-3 border-bottom">
                            <i class="bi bi-calendar-event"></i> <?php echo date('d M Y H:i', strtotime($announcement['tanggal'])); ?>
                        </div>

                        <div class="article-content mb-4">
                            <?php echo nl2br(htmlspecialchars($announcement['isi_pengumuman'])); ?>
                        </div>

                        <div class="card bg-light">
                            <div class="card-body">
                                <h5><i class="bi bi-share"></i> Bagikan</h5>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-sm bg-primary me-2">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($announcement['judul']); ?>" target="_blank" class="btn btn-sm bg-primary me-2">
                                    <i class="bi bi-twitter"></i> Twitter
                                </a>
                                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($announcement['judul'] . ' ' . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="btn btn-sm bg-primary">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </article>
                <?php else: ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i> Pengumuman tidak ditemukan
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-clock-history"></i> Pengumuman Lainnya</h5>
                    </div>
                    <div class="card-body">
                        <a href="/pkbm-website/public/announcement" class="btn btn-sm w-100" style="background-color: #003D82; color: #fff;">Lihat Semua Pengumuman</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
