<!-- Breadcrumb -->
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pkbm-website/public/home">Beranda</a></li>
            <li class="breadcrumb-item"><a href="/pkbm-website/public/gallery">Galeri</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($photo['judul']); ?></li>
        </ol>
    </nav>
</div>

<!-- Main Content -->
<main>
    <div class="container py-5">
        <?php if ($photo): ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <img src="<?php 
                          $foto = $photo['foto'];
                          if (strpos($foto, 'http') === false && strpos($foto, 'https') === false) {
                            echo htmlspecialchars('/pkbm-website/public/uploads/' . $foto);
                          } else {
                            echo htmlspecialchars($foto);
                          }
                        ?>" class="card-img-top" alt="<?php echo htmlspecialchars($photo['judul']); ?>" style="max-height: 500px; object-fit: cover;">
                        <div class="card-body">
                            <h2 class="card-title"><?php echo htmlspecialchars($photo['judul']); ?></h2>
                            <p class="text-muted">
                                <i class="bi bi-calendar"></i> <?php echo date('d M Y', strtotime($photo['tanggal'])); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Foto</h5>
                        </div>
                        <div class="card-body">
                            <p>
                                <strong>Judul:</strong><br>
                                <?php echo htmlspecialchars($photo['judul']); ?>
                            </p>
                            <p>
                                <strong>Tanggal:</strong><br>
                                <?php echo date('d M Y (H:i)', strtotime($photo['tanggal'])); ?>
                            </p>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-images"></i> Galeri Lainnya</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small">Lihat foto-foto lainnya dari PKBM Sidandu Indah.</p>
                            <a href="/pkbm-website/public/gallery" class="btn btn-primary btn-sm w-100">Lihat Semua Foto</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i> Foto tidak ditemukan
            </div>
        <?php endif; ?>
    </div>
</main>
