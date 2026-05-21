<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'PKBM Sidandu Indah'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/pkbm-website/public/css/style.css">
    <style>
        :root {
            --primary-color: #1a5c2f;
            --secondary-color: #ffc107;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        .navbar {
            /* background-color: var(--primary-color); */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: black !important;
            margin-left: 10px;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #0D6EFD !important;
        }

        .nav-link.active {
            color: #0D6EFD!important;
            border-bottom: 2px solid #0D6EFD;
        }

        .motto {
            margin-top: -4px;
              font-weight: 100;
            font-size: 0.6rem;
            color: rgba(255,255,255,0.8);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(35, 40, 91, 0.65) 0%, rgba(64, 70, 139, 0.63) 100%), url('/pkbm-website/public/images/hero.jpeg') no-repeat center center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 120px 0;
            text-align: left;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        /* Card Styling */
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .card-header {
            background-color: #003d82;
            color: white;
            border: none;
        }

        /* Badge */
        .badge {
            background-color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #134a25;
            border-color: #134a25;
        }

        /* Footer */
        footer {
            /* background-color: #003d82; */
            background: linear-gradient(135deg, #003d82 0%, #0066cc 100%);
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }

        footer h5 {
            margin-bottom: 20px;
            font-weight: bold;
            color: var(--secondary-color);
        }

        footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: var(--secondary-color);
        }

        .footer-divider {
            border-top: 1px solid rgba(255,255,255,0.2);
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            color: rgba(255,255,255,0.7);
        }

        /* Breadcrumb */
        .breadcrumb {
            background-color: #f8f9fa;
        }

        .breadcrumb-item.active {
            color: #003d82;
        }

        .breadcrumb-item a {
            color: #003d82;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: #134a25;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/pkbm-website/public/home">
                <img src="/pkbm-website/public/images/logo.png" alt="Logo" height="40" class="me-2">
                <div class="d-flex flex-column gap-y-0">
                <p class="m-0 p-0 text-primary"><span class="text-dark">PKBM</span> Sidandu Indah</p>
                <span class="motto text-dark">Belajar, Berkarya, Berprestasi</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/pkbm-website/public/home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pkbm-website/public/profile">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pkbm-website/public/news">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pkbm-website/public/announcement">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pkbm-website/public/gallery">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pkbm-website/public/contact">Kontak</a>
                    </li>
                    <li class="nav-item mt-1">
                        <a class="nav-link bg-primary rounded px-3 py-1" href="/pkbm-website/public/admin/login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
