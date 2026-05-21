<!-- Hero Section -->
<div class="hero">
  <div class="container">
    <h1 style="font-size: 3rem; font-weight: 700">
      Selamat Datang<br />di PKBM Sidandu Indah
    </h1>
    <p style="font-size: 1.1rem; margin-top: 20px; max-width: 650px">
      Pusat Kegiatan Belajar Masyarakat untuk Meningkatkan Kualitas Sumber Daya
      Manusia Pusat Kegiatan Belajar
    </p>
    <a
      href="/pkbm-website/public/profile"
      class="btn btn-lg bg-white text-dark"
      style="margin-top: 30px"
    >
      Tentang Kami
    </a>
  </div>
</div>

<!-- Main Content -->
<main>
  <div class="container py-5">
    <!-- Features Section -->
    <section class="mb-5">
      <div class="row g-4">
        <div class="col-md-4">
          <a href="/pkbm-website/public/news" class="text-decoration-none">
            <div
              class="card h-100 border-0 shadow-lg"
              style="border-top: 4px solid var(--primary-color)"
            >
              <div class="card-body text-center py-4">
                <div
                  class="bg-primary"
                  style="
                    width: 60px;
                    height: 60px;
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 20px;
                  "
                >
                  <i
                    class="bi bi-newspaper"
                    style="font-size: 2rem; color: white"
                  ></i>
                </div>
                <h5 class="card-title fw-bold">Berita Terbaru</h5>
                <p class="card-text text-muted">
                  Dapatkan informasi terbaru seputar kegiatan dan program PKBM
                  Sidandu Indah.
                </p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a href="/pkbm-website/public/announcement" class="text-decoration-none">
            <div
              class="card h-100 border-0 shadow-lg"
              style="border-top: 4px solid #ffc107"
            >
              <div class="card-body text-center py-4">
                <div
                  style="
                    width: 60px;
                    height: 60px;
                    background: #ffc107;
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 20px;
                  "
                >
                  <i
                    class="bi bi-megaphone"
                    style="font-size: 2rem; color: white"
                  ></i>
                </div>
                <h5 class="card-title fw-bold">Pengumuman Penting</h5>
                <p class="card-text text-muted">
                  Jangan lewatkan pengumuman penting yang berkaitan dengan
                  pendaftaran dan kegiatan PKBM.
                </p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4">
          <a href="/pkbm-website/public/gallery" class="text-decoration-none">
            <div
              class="card h-100 border-0 shadow-lg"
              style="border-top: 4px solid #28a745"
            >
              <div class="card-body text-center py-4">
                <div
                  style="
                    width: 60px;
                    height: 60px;
                    background: #28a745;
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 20px;
                  "
                >
                  <i
                    class="bi bi-images"
                    style="font-size: 2rem; color: white"
                  ></i>
                </div>
                <h5 class="card-title fw-bold">Galeri Foto</h5>
                <p class="card-text text-muted">
                  Lihat dokumentasi foto kegiatan dan prestasi PKBM Sidandu
                  Indah.
                </p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </section>

    <hr class="my-5" />

    <!-- Berita Terbaru -->
    <section class="mb-5">
      <div class="mb-4">
        <h2 style="font-weight: 700" class="text-dark">
          <i class="bi bi-newspaper"></i> Berita Terbaru
        </h2>
        <p class="text-muted">
          Informasi dan perkembangan terkini dari PKBM Sidandu Indah
        </p>
      </div>
      <div class="row g-4">
        <?php if (!empty($latest_news)): ?> <?php foreach ($latest_news as
        $news): ?>
        <div class="col-md-4">
          <div
            class="card h-100 border-0 shadow-sm"
            style="transition: all 0.3s"
          >
            <?php if (!empty($news['gambar'])): ?>
            <div style="height: 220px; overflow: hidden">
              <img
                src="<?php 
                  $gambar = $news['gambar'];
                  // Jika bukan URL lengkap, tambahkan path uploads
                  if (strpos($gambar, 'http') === false && strpos($gambar, 'https') === false) {
                    echo htmlspecialchars('/pkbm-website/public/uploads/' . $gambar);
                  } else {
                    echo htmlspecialchars($gambar);
                  }
                ?>"
                class="card-img-top"
                alt="<?php echo htmlspecialchars($news['judul']); ?>"
                style="
                  width: 100%;
                  height: 100%;
                  object-fit: cover;
                  transition: transform 0.3s;
                "
              />
            </div>
            <?php else: ?>
            <div
              class="card-img-top bg-light d-flex align-items-center justify-content-center"
              style="height: 220px"
            >
              <i class="bi bi-image" style="font-size: 3rem; color: #ccc"></i>
            </div>
            <?php endif; ?>
            <div class="card-body d-flex flex-column">
              <div class="mb-2">
                <span class="badge bg-primary"
                  ><?php echo htmlspecialchars($news['nama_kategori'] ?? 'Umum'); ?></span
                >
              </div>
              <h5 class="card-title" style="height: 55px; overflow: hidden">
                <?php echo htmlspecialchars($news['judul']); ?>
              </h5>
              <p class="card-text text-muted small mb-2">
                <i class="bi bi-calendar-event"></i> <?php echo date('d M Y',
                strtotime($news['tanggal'])); ?>
              </p>
              <p
                class="card-text text-muted small flex-grow-1"
                style="height: 60px; overflow: hidden"
              >
                <?php echo substr(strip_tags($news['isi_berita']), 0, 80) .
                '...'; ?>
              </p>
              <a
                href="/pkbm-website/public/news/detail/<?php echo $news['id_berita']; ?>"
                class="btn btn-outline-primary btn-sm mt-auto"
                >Baca Selengkapnya →</a
              >
            </div>
          </div>
        </div>
        <?php endforeach; ?> <?php else: ?>
        <div class="alert alert-info">
          Belum ada berita. Silakan kembali lagi nanti.
        </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- Pengumuman -->
    <section class="mb-5">
      <h2 class="mb-4"><i class="bi bi-megaphone"></i> Pengumuman Terbaru</h2>
      <div class="row">
        <div class="col-md-8">
          <?php if (!empty($announcements)): ?> <?php foreach ($announcements as
          $announce): ?>
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">
                <?php echo htmlspecialchars($announce['judul']); ?>
              </h5>
              <p class="card-text text-muted small">
                <i class="bi bi-calendar-event"></i> <?php echo date('d M Y
                H:i', strtotime($announce['tanggal'])); ?>
              </p>
              <p class="card-text">
                <?php echo substr(strip_tags($announce['isi_pengumuman']), 0,
                150) . '...'; ?>
              </p>
              <a
                href="/pkbm-website/public/announcement/detail/<?php echo $announce['id_pengumuman']; ?>"
                class="btn btn-sm btn-outline-primary"
                >Baca Selengkapnya</a
              >
            </div>
          </div>
          <?php endforeach; ?> <?php else: ?>
          <div class="alert alert-info">Belum ada pengumuman saat ini.</div>
          <?php endif; ?>
        </div>
        <div class="col-md-4">
          <div class="card bg-light">
            <div class="card-body">
              <h5 class="card-title">Informasi Kontak</h5>
              <p>
                <strong>Telepon:</strong><br />
                <i class="bi bi-telephone-fill"></i> (0000) 000-0000
              </p>
              <p>
                <strong>Email:</strong><br />
                <i class="bi bi-envelope-fill"></i> info@pkbmsidandu.com
              </p>
              <p>
                <strong>Lokasi:</strong><br />
                <i class="bi bi-geo-alt-fill"></i> Halong, Balangan, Kalimantan
                Selatan
              </p>
              <a
                href="/pkbm-website/public/contact"
                class="btn bg-primary btn-sm w-100"
                >Hubungi Kami</a
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Galeri -->
    <section class="mt-5">
      <div class="mb-4">
        <h2 style="font-weight: 700" class="text-dark">
          <i class="bi bi-images"></i> Galeri Foto
        </h2>
        <p class="text-muted">
          Dokumentasi kegiatan dan prestasi PKBM Sidandu Indah
        </p>
      </div>
      <div class="row g-4">
        <?php if (!empty($gallery)): ?> <?php foreach ($gallery as $photo): ?>
        <div class="col-md-4">
          <div
            class="card h-100 border-0 shadow-sm"
            style="overflow: hidden; transition: all 0.3s"
          >
            <a
              href="/pkbm-website/public/gallery/detail/<?php echo $photo['id_galeri']; ?>"
              class="position-relative"
              style="display: block; overflow: hidden; height: 280px"
            >
              <img
                src="<?php 
                  $foto = $photo['foto'];
                  // Jika bukan URL lengkap, tambahkan path uploads
                  if (strpos($foto, 'http') === false && strpos($foto, 'https') === false) {
                    echo htmlspecialchars('/pkbm-website/public/uploads/' . $foto);
                  } else {
                    echo htmlspecialchars($foto);
                  }
                ?>"
                class="card-img-top"
                alt="<?php echo htmlspecialchars($photo['judul']); ?>"
                style="
                  width: 100%;
                  height: 100%;
                  object-fit: cover;
                  transition: transform 0.3s;
                "
              />
              <div
                class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-0"
                style="transition: opacity 0.3s"
              ></div>
              <div
                class="position-absolute top-50 start-50 translate-middle opacity-0"
                style="transition: opacity 0.3s"
              >
                <i
                  class="bi bi-zoom-in"
                  style="font-size: 2.5rem; color: white"
                ></i>
              </div>
            </a>
            <div class="card-body">
              <h6 class="card-title fw-bold">
                <?php echo htmlspecialchars($photo['judul']); ?>
              </h6>
              <small class="text-muted d-block mb-2">
                <i class="bi bi-calendar"></i> <?php echo date('d M Y',
                strtotime($photo['tanggal'])); ?>
              </small>
            </div>
          </div>
        </div>
        <?php endforeach; ?> <?php else: ?>
        <div class="alert alert-info">Belum ada foto di galeri.</div>
        <?php endif; ?>
      </div>
    </section>
  </div>
</main>
