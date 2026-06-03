<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Dashboard' ?> - <?= SITE_NAME ?> Admin</title>
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
            --success: #00c853;
            --warning: #ff6d00;
            --danger: #dc2626;
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
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 12px 36px rgba(0,0,0,0.12);
            --radius: 12px;
            --radius-lg: 16px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-100);
            color: var(--gray-800);
            line-height: 1.5;
        }

        /* Admin Container */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--primary);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-logo {
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .sidebar-logo .logo-primary {
            color: var(--white);
        }

        .sidebar-logo .logo-secondary {
            color: var(--secondary);
        }

        .sidebar-header p {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
            margin-top: 0.5rem;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .sidebar-nav a i {
            width: 1.25rem;
            font-size: 1rem;
        }

        .sidebar-nav a:hover {
            background: rgba(99,91,255,0.2);
            color: var(--secondary);
        }

        .sidebar-nav a.active {
            background: rgba(99,91,255,0.2);
            color: var(--secondary);
            border-left: 3px solid var(--secondary);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 1.5rem;
        }

        /* Top Bar */
        .top-bar {
            background: var(--white);
            padding: 1rem 1.5rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            background: var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .logout-btn {
            background: var(--gray-100);
            color: var(--gray-700);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: var(--danger);
            color: white;
        }

        /* Cards */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
        }

        .card h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            transition: all 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: rgba(99,91,255,0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .stat-icon i {
            font-size: 1.5rem;
            color: var(--secondary);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--gray-600);
            margin-top: 0.25rem;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        th {
            background: var(--gray-50);
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-600);
        }

        td {
            font-size: 0.85rem;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--secondary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary-dark);
            transform: translateY(-1px);
        }

        .btn-edit {
            background: var(--warning);
            color: white;
        }

        .btn-edit:hover {
            background: #e65100;
        }

        .btn-delete {
            background: var(--danger);
            color: white;
        }

        .btn-delete:hover {
            background: #b91c1c;
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.85rem;
            color: var(--gray-700);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.6rem 0.75rem;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(99,91,255,0.1);
        }

        /* Alerts */
        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        .error {
            background: #fee2e2;
            color: #dc2626;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .sidebar-header p,
            .sidebar-nav a span {
                display: none;
            }
            .sidebar-nav a {
                justify-content: center;
                padding: 0.75rem;
            }
            .sidebar-nav a i {
                margin: 0;
            }
            .main-content {
                margin-left: 70px;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="admin-container">
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <span class="logo-primary">Luxury</span><span class="logo-secondary">Vision</span>
            </div>
            <p>Admin Dashboard</p>
        </div>
        <div class="sidebar-nav">
            <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i> <span>Dashboard</span>
            </a>
            <a href="products.php" class="<?= basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : '' ?>">
                <i class="fas fa-box"></i> <span>Products</span>
            </a>
            <a href="categories.php" class="<?= basename($_SERVER['PHP_SELF']) == 'categories.php' ? 'active' : '' ?>">
                <i class="fas fa-tags"></i> <span>Categories</span>
            </a>
            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </a>
        </div>
    </div>
    <div class="main-content">
        <div class="top-bar">
            <h1 class="page-title"><?= $page_title ?? 'Dashboard' ?></h1>
            <div class="admin-info">
                <div class="admin-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>