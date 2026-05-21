<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Admin Dashboard - PKBM Sidandu Indah'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #003d82;
            --secondary-color: #ffc107;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h3 {
            margin: 10px 0 5px;
            font-size: 1.3rem;
        }

        .sidebar-header small {
            opacity: 0.8;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: block;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left-color: var(--secondary-color);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background-color: white;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: bold;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-menu a {
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .user-menu a:hover {
            color: var(--primary-color);
        }

        /* Content */
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        /* Card */
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .card-header {
            background-color: #003d82;
            color: white;
            border: none;
            padding: 15px 20px;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #333;
            border-bottom: 2px solid #ddd;
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #002753;;
            border-color: #002753;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.85rem;
        }

        /* Badge */
        .badge {
            background-color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                width: calc(100% - 200px);
            }

            .content {
                padding: 15px;
            }

            .sidebar-menu a {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }

        /* Footer */
        footer {
            background-color: white;
            border-top: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }

        a {
            transition: all 0.3s;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="/pkbm-website/public/images/logo.png" alt="Logo" height="50" class="mb-2" style="border-radius: 8px;">
            <h3>Admin PKBM</h3>
            <small>Sidandu Indah</small>
        </div>

        <ul class="sidebar-menu">
            <li><a href="/pkbm-website/public/admin/dashboard" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a></li>
            <li><a href="/pkbm-website/public/admin-news" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'admin-news') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-newspaper"></i> Berita
            </a></li>
            <li><a href="/pkbm-website/public/admin-announcement" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'admin-announcement') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-megaphone"></i> Pengumuman
            </a></li>
            <li><a href="/pkbm-website/public/admin-gallery" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'admin-gallery') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-images"></i> Galeri
            </a></li>
            <li><a href="/pkbm-website/public/admin-contact" class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'admin-contact') !== false) ? 'active' : ''; ?>">
                <i class="bi bi-chat-left-text"></i> Pesan Kontak
            </a></li>
            <li style="margin-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
                <a href="/pkbm-website/public/home">
                    <i class="bi bi-globe"></i> Lihat Website
                </a>
            </li>
            <li><a href="/pkbm-website/public/admin/logout" style="color: #ffcccc;">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <span class="navbar-brand">
                    <i class="bi bi-speedometer2"></i> PKBM Sidandu Indah - Area Admin
                </span>
                <div class="user-menu ms-auto">
                    <span><i class="bi bi-person-circle"></i> Halo, <strong><?php echo htmlspecialchars($admin_name ?? 'Admin'); ?></strong></span>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="content">
