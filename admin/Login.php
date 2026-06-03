<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';

if (isLoggedIn()) {
    redirect('dashboard.php');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (verifyAdminLogin($email, $password)) {
        redirect('dashboard.php');
    } else {
        $error = 'Invalid email or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - <?= SITE_NAME ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0a2540;
            --primary-dark: #051a2c;
            --secondary: #635bff;
            --secondary-dark: #4c44cc;
            --accent: #00b4d8;
            --gray-50: #f8f9fa;
            --gray-100: #f1f3f5;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
            --white: #ffffff;
            --shadow: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 12px 36px rgba(0,0,0,0.12);
            --radius: 12px;
            --radius-lg: 16px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-container {
            background: var(--white);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .login-header {
            background: var(--primary);
            padding: 2rem;
            text-align: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: -0.02em;
        }

        .logo .logo-primary {
            color: var(--white);
        }

        .logo .logo-secondary {
            color: var(--secondary);
        }

        .login-header p {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .login-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--gray-700);
            font-size: 0.85rem;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            font-size: 1rem;
        }

        input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.5rem;
            border: 1px solid var(--gray-300);
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        input:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(99,91,255,0.1);
        }

        .btn-login {
            width: 100%;
            padding: 0.85rem;
            background: var(--secondary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            background: var(--secondary-dark);
            transform: translateY(-1px);
        }

        .error {
            background: #fee2e2;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .demo-cred {
            margin-top: 1.5rem;
            padding: 1rem;
            background: var(--gray-100);
            border-radius: 10px;
            font-size: 0.8rem;
            text-align: center;
            border: 1px solid var(--gray-200);
        }

        .demo-cred strong {
            color: var(--primary);
        }

        .demo-cred p {
            color: var(--gray-600);
            margin-top: 0.5rem;
            font-size: 0.75rem;
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: var(--gray-600);
            text-decoration: none;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.2s;
        }

        .back-link a:hover {
            color: var(--secondary);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <span class="logo-primary">Luxury</span><span class="logo-secondary">Vision</span>
            </div>
            <p>Admin Access Portal</p>
        </div>
        
        <div class="login-body">
            <?php if ($error): ?>
                <div class="error">
                    <i class="fas fa-exclamation-triangle"></i> <?= $error ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" required placeholder="admin@luxuryvision.com" value="admin@luxuryvision.com">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" required placeholder="••••••••" value="Admin@123">
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>
            
            <div class="demo-cred">
                <strong><i class="fas fa-info-circle"></i> Demo Credentials</strong>
                <p>Email: admin@luxuryvision.com<br>Password: Admin@123</p>
            </div>
            
            <div class="back-link">
                <a href="/product/public/index.php"><i class="fas fa-arrow-left"></i> Back to Website</a>
            </div>
        </div>
    </div>
</body>
</html>