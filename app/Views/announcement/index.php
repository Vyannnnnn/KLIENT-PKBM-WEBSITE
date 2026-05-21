<!-- Breadcrumb -->
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pkbm-website/public/home">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
        </ol>
    </nav>
</div>

<!-- Main Content -->
<main>
    <div class="container py-5">
        <div class="mb-4">
            <h1 style="font-weight: 700;" class="text-dark">
                <i class="bi bi-megaphone"></i> Pengumuman Penting
            </h1>
            <p class="text-muted">Informasi penting yang perlu Anda ketahui</p>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <?php if (!empty($announcements)): ?>
                    <?php foreach ($announcements as $announce): ?>
                        <div class="card mb-4 border-left border-0 shadow-sm" style="border-left: 5px solid var(--primary-color);">
                            <div class="card-body">
                                <div class="mb-3 d-flex align-items-center justify-content-between">
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-exclamation-triangle"></i> Pengumuman
                                    </span>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar-event"></i> <?php echo date('d M Y H:i', strtotime($announce['tanggal'])); ?>
                                    </small>
                                </div>
                                <h4 class="card-title fw-bold"><?php echo htmlspecialchars($announce['judul']); ?></h4>
                                <p class="card-text text-muted"><?php echo substr(strip_tags($announce['isi_pengumuman']), 0, 200) . '...'; ?></p>
                                <a href="/pkbm-website/public/announcement/detail/<?php echo $announce['id_pengumuman']; ?>" class="btn bg-primary btn-sm">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill"></i> Belum ada pengumuman saat ini.
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #244b79 0%, #003d82 100%); color: white; position: sticky; top: 80px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-bell-fill"></i> Informasi Terkini
                        </h5>
                        <p class="card-text small">Pantau halaman ini secara berkala untuk mendapatkan informasi terbaru tentang pengumuman penting dari PKBM Sidandu Indah.</p>
                        <hr class="bg-light opacity-25">
                        <p class="small mb-0">Semua pengumuman penting akan kami sampaikan di halaman ini untuk memastikan seluruh peserta didik dan masyarakat mendapatkan informasi dengan jelas dan tepat waktu.</p>
                    </div>
                </div>

               
        </div>
    </div>
</main>
