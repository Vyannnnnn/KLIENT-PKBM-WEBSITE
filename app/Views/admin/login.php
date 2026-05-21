<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PKBM Sidandu Indah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #003d82;;
            --secondary-color: #ffc107;
        }

        body {
background: linear-gradient(135deg, rgba(26, 32, 92, 0.65) 0%, rgba(42, 50, 143, 0.63) 100%), url('https://picsum.photos/1920/1080?school') no-repeat center center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            text-align: left;

            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 15px;
        }

        .login-card {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .login-header {
        background: linear-gradient(135deg, #244b79 0%, #003d82 100%);    
        color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .login-header i {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .login-header h1 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .login-header p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .login-form {
            padding: 30px;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(26, 92, 47, 0.25);
        }

        .btn-login {
        background: linear-gradient(135deg, #244b79 0%, #003d82 100%);    
            border-color: var(--primary-color);
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #134a25;
            border-color: #134a25;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 92, 47, 0.3);
        }

        .alert {
            border-radius: 5px;
            border: none;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .login-footer {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
            font-size: 0.85rem;
            color: #666;
        }

        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card login-card">
            <!-- Header -->
            <div class="login-header">
                <i class="bi bi-mortarboard-fill"></i>
                <h1>Admin PKBM</h1>
                <p>Sidandu Indah - Halong</p>
            </div>

            <!-- Form -->
            <div class="login-form">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> <?php echo htmlspecialchars($error); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Session Timeout Information -->
                <div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 0.85rem;">
                    <i class="bi bi-info-circle-fill"></i>
                    <strong>Kebijakan Session:</strong> Anda akan otomatis logout setelah <strong>1 jam tidak ada aktivitas</strong> atau <strong>5 jam</strong> sejak login untuk keamanan akun.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <form method="POST">
                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i class="bi bi-person-circle"></i> Username
                        </label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock-fill"></i> Password
                        </label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    </div>

                    <button type="submit" class="btn btn-login mb-3">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="login-footer">
                <p>© 2026 PKBM Sidandu Indah. Sistem Administrasi Website.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
