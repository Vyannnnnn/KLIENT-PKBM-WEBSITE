<!-- Breadcrumb -->
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pkbm-website/public/home">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kontak</li>
        </ol>
    </nav>
</div>

<!-- Main Content -->
<main>
    <div class="container py-5">
        <h1 class="mb-4"><i class="bi bi-telephone"></i> Hubungi Kami</h1>

        <div class="row g-4">
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-geo-alt-fill"></i> Alamat</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            PKBM Sidandu Indah<br>
                            Kecamatan Halong<br>
                            Kabupaten Balangan<br>
                            Kalimantan Selatan
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-telephone-fill"></i> Telepon</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>Kepala PKBM:</strong><br>
                            (0000) 000-0000
                        </p>
                        <p>
                            <strong>Admin:</strong><br>
                            (0000) 000-0001
                        </p>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-envelope-fill"></i> Email</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            <a href="mailto:info@pkbmsidandu.com">info@pkbmsidandu.com</a><br>
                            <a href="mailto:admin@pkbmsidandu.com">admin@pkbmsidandu.com</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-chat-dots-fill"></i> Kirim Pesan</h5>
                    </div>
                    <div class="card-body">
                        <form id="contactForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn text-white" style="background-color: #003d82;">
                                <i class="bi bi-send"></i> Kirim Pesan
                            </button>
                        </form>

                        <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
                            <i class="bi bi-check-circle-fill"></i> Pesan Anda berhasil dikirim! Terima kasih telah menghubungi kami.
                        </div>
                        <div id="errorMessage" class="alert alert-danger mt-3" style="display: none;">
                            <i class="bi bi-exclamation-triangle-fill"></i> <span id="errorText"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Working Hours -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-clock-fill"></i> Jam Operasional</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    <strong>Hari Kerja (Senin - Jumat)</strong><br>
                                    08:00 - 17:00 WIB
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <strong>Hari Sabtu</strong><br>
                                    08:00 - 12:00 WIB
                                </p>
                            </div>
                        </div>
                        <p class="text-muted mb-0">
                            <i class="bi bi-info-circle"></i> Kami tutup pada hari Minggu dan hari libur nasional.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('/pkbm-website/public/contact/send', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('successMessage').style.display = 'block';
            document.getElementById('contactForm').reset();
            setTimeout(() => {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000);
        } else {
            document.getElementById('errorMessage').style.display = 'block';
            document.getElementById('errorText').textContent = data.error || 'Terjadi kesalahan!';
        }
    })
    .catch(error => {
        document.getElementById('errorMessage').style.display = 'block';
        document.getElementById('errorText').textContent = 'Terjadi kesalahan saat mengirim pesan!';
    });
});
</script>
