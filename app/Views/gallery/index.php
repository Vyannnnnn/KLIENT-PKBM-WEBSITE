<!-- Breadcrumb -->
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pkbm-website/public/home">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Galeri</li>
        </ol>
    </nav>
</div>

<!-- Main Content -->
<main>
    <div class="container py-5">
        <div class="mb-5">
            <h1 style="font-weight: 700;" class="text-dark">
                <i class="bi bi-images"></i> Galeri Foto
            </h1>
            <p class="text-muted">Dokumentasi kegiatan dan prestasi PKBM Sidandu Indah</p>
        </div>

        <?php if (!empty($gallery)): ?>
            <div class="row g-4">
                <?php foreach ($gallery as $photo): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm" style="overflow: hidden; transition: all 0.3s;">
                            <a href="/pkbm-website/public/gallery/detail/<?php echo $photo['id_galeri']; ?>" class="position-relative" style="display: block; overflow: hidden; height: 300px;">
                                <img src="<?php 
                                  $foto = $photo['foto'];
                                  if (strpos($foto, 'http') === false && strpos($foto, 'https') === false) {
                                    echo htmlspecialchars('/pkbm-website/public/uploads/' . $foto);
                                  } else {
                                    echo htmlspecialchars($foto);
                                  }
                                ?>" class="card-img-top" alt="<?php echo htmlspecialchars($photo['judul']); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-0" style="transition: opacity 0.3s;"></div>
                                <div class="position-absolute top-50 start-50 translate-middle opacity-0" style="transition: opacity 0.3s;">
                                    <i class="bi bi-zoom-in" style="font-size: 2.5rem; color: white;"></i>
                                </div>
                            </a>
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($photo['judul']); ?></h5>
                                <p class="card-text text-muted small mb-3">
                                    <i class="bi bi-calendar"></i> <?php echo date('d M Y', strtotime($photo['tanggal'])); ?>
                                </p>
                                <a href="/pkbm-website/public/gallery/detail/<?php echo $photo['id_galeri']; ?>" class="btn bg-primary btn-sm w-100">
                                    Lihat Foto <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle-fill"></i> Belum ada foto di galeri.
            </div>
        <?php endif; ?>
    </div>
</main>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
    }

    .card a:hover img {
        transform: scale(1.1);
    }

    .card a:hover .bg-dark {
        opacity: 0.5 !important;
    }

    .card a:hover .bi-zoom-in {
        opacity: 1 !important;
    }
</style>
