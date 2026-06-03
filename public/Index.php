<?php
require_once __DIR__ . '/../includes/config.php';
$db = getDB();

// Fetch active categories
$cats = $db->query("SELECT * FROM categories WHERE status=1 ORDER BY name")->fetchAll();

// Fetch active products with their images
$products = $db->query("
    SELECT DISTINCT p.*, c.name AS cat_name 
    FROM products p 
    LEFT JOIN categories c ON c.id = p.category_id 
    WHERE p.status = 'active' 
    ORDER BY p.featured DESC, p.created_at DESC
")->fetchAll();

// Fetch images for each product
foreach ($products as &$p) {
    $stmt = $db->prepare("SELECT image_path FROM product_images WHERE product_id = ? AND is_main = 1 LIMIT 1");
    $stmt->execute([$p['id']]);
    $p['main_image'] = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title><?= SITE_NAME ?> — Premium 360° Product Experience</title>
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
    --primary-light: #1a4a6f;
    --secondary: #635bff;
    --secondary-dark: #4c44cc;
    --accent: #00b4d8;
    --success: #00c853;
    --warning: #ff6d00;
    --gold: #ffd700;
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
    --shadow-xl: 0 24px 48px rgba(0,0,0,0.16);
    --radius-sm: 6px;
    --radius: 12px;
    --radius-lg: 16px;
    --radius-xl: 24px;
}

body {
    font-family: 'Inter', sans-serif;
    background: var(--gray-50);
    color: var(--gray-800);
    line-height: 1.5;
}

/* Header Styles */
.header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: var(--white);
    backdrop-filter: none;
    box-shadow: var(--shadow);
    z-index: 1000;
    padding: 0;
}

.top-bar {
    background: var(--primary);
    color: var(--white);
    padding: 0.5rem 5%;
    font-size: 0.75rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.top-bar-left {
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.top-bar-left i {
    margin-right: 0.25rem;
    font-size: 0.7rem;
}

.top-bar-right {
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.top-bar-right a {
    color: var(--white);
    text-decoration: none;
    transition: opacity 0.2s;
}

.top-bar-right a:hover {
    opacity: 0.8;
}

.main-header {
    padding: 1rem 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
}

.logo {
    font-size: 1.8rem;
    font-weight: 800;
    text-decoration: none;
    letter-spacing: -0.02em;
}

.logo .logo-primary {
    color: var(--primary);
}

.logo .logo-secondary {
    color: var(--secondary);
}

.nav-menu {
    display: flex;
    gap: 2rem;
    align-items: center;
}

.nav-menu a {
    text-decoration: none;
    color: var(--gray-700);
    font-weight: 500;
    transition: color 0.2s;
    font-size: 0.9rem;
}

.nav-menu a:hover {
    color: var(--secondary);
}

.header-icons {
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.header-icons a {
    color: var(--gray-700);
    text-decoration: none;
    font-size: 1.1rem;
    transition: color 0.2s;
    position: relative;
}

.header-icons a:hover {
    color: var(--secondary);
}

.cart-count {
    position: absolute;
    top: -8px;
    right: -12px;
    background: var(--secondary);
    color: white;
    font-size: 0.6rem;
    padding: 2px 6px;
    border-radius: 20px;
    font-weight: 600;
}

.btn-admin-header {
    background: var(--secondary);
    color: white !important;
    padding: 0.5rem 1.2rem;
    border-radius: 8px;
    font-weight: 600 !important;
}

.btn-admin-header:hover {
    background: var(--secondary-dark);
    transform: translateY(-1px);
}

/* Hero Section */
.hero {
    min-height: 90vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 4rem;
    max-width: 1280px;
    margin: 0 auto;
    padding: 8rem 5% 4rem;
}

.hero-content h1 {
    font-size: 3.5rem;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: var(--primary);
}

.hero-content .highlight {
    background: linear-gradient(135deg, var(--secondary) 0%, var(--accent) 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.hero-content p {
    font-size: 1.1rem;
    color: var(--gray-600);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.hero-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-primary {
    background: var(--secondary);
    color: white;
    padding: 0.9rem 2rem;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.btn-primary:hover {
    background: var(--secondary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.btn-outline {
    background: transparent;
    color: var(--primary);
    padding: 0.9rem 2rem;
    border: 2px solid var(--primary);
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.btn-outline:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
}

/* Viewer Container */
.viewer-container {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--gray-200);
}

.viewer-label {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--secondary);
    margin-bottom: 1rem;
    font-weight: 700;
}

.viewer-stage {
    background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
    border-radius: var(--radius);
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    cursor: grab;
}

.viewer-stage:active {
    cursor: grabbing;
}

#productImage {
    max-width: 85%;
    max-height: 350px;
    object-fit: contain;
    pointer-events: none;
    filter: drop-shadow(0 20px 25px -5px rgba(0,0,0,0.1));
}

.angle-indicator {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    background: rgba(0,0,0,0.75);
    backdrop-filter: blur(8px);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
    font-family: monospace;
}

.viewer-controls {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    margin-top: 1rem;
    flex-wrap: wrap;
}

.ctrl-btn {
    background: var(--white);
    border: 1px solid var(--gray-300);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    cursor: pointer;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    color: var(--gray-600);
}

.ctrl-btn:hover {
    background: var(--secondary);
    color: white;
    border-color: var(--secondary);
}

.ctrl-btn.active {
    background: var(--secondary);
    color: white;
}

.drag-hint {
    margin-top: 1rem;
    font-size: 0.7rem;
    color: var(--gray-500);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

/* Stats Section */
.stats-section {
    background: var(--primary);
    margin: 2rem 5%;
    border-radius: var(--radius-lg);
    max-width: 1280px;
    margin: 2rem auto;
}

.stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
    padding: 2.5rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--gold);
}

.stat-label {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.7);
    margin-top: 0.25rem;
}

/* Products Section */
.products-section {
    padding: 4rem 5%;
    max-width: 1280px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-header h2 {
    font-size: 2.2rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.section-header p {
    color: var(--gray-600);
    font-size: 1rem;
}

/* Filter Bar */
.filter-bar {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 2.5rem;
}

.filter-chip {
    background: var(--white);
    border: 1px solid var(--gray-300);
    padding: 0.5rem 1.25rem;
    border-radius: 40px;
    cursor: pointer;
    transition: all 0.2s;
    font-weight: 500;
    font-size: 0.85rem;
    color: var(--gray-600);
}

.filter-chip:hover,
.filter-chip.active {
    background: var(--secondary);
    color: white;
    border-color: var(--secondary);
}

/* Product Grid */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.75rem;
}

.product-card {
    background: var(--white);
    border-radius: var(--radius);
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
}

.product-image {
    position: relative;
    background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
    padding: 2rem;
    text-align: center;
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image img {
    max-width: 85%;
    max-height: 85%;
    object-fit: contain;
    transition: transform 0.3s;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.badge-360 {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    background: var(--primary);
    color: var(--gold);
    padding: 0.25rem 0.7rem;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.badge-featured {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    background: linear-gradient(135deg, var(--gold) 0%, #ffb347 100%);
    color: var(--primary);
    padding: 0.25rem 0.7rem;
    border-radius: 20px;
    font-size: 0.65rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.product-info {
    padding: 1.25rem;
    border-top: 1px solid var(--gray-200);
}

.product-brand {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--secondary);
    font-weight: 700;
}

.product-name {
    font-size: 1rem;
    font-weight: 600;
    margin: 0.5rem 0;
    color: var(--primary);
    line-height: 1.3;
}

.product-price {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary);
}

.old-price {
    font-size: 0.85rem;
    color: var(--gray-500);
    text-decoration: line-through;
    margin-left: 0.5rem;
    font-weight: normal;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.85);
    backdrop-filter: blur(8px);
    z-index: 2000;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.modal.active {
    display: flex;
}

.modal-content {
    background: var(--white);
    border-radius: var(--radius-xl);
    max-width: 1100px;
    width: 100%;
    max-height: 90vh;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 0.9fr;
    position: relative;
    animation: modalFadeIn 0.3s;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: var(--white);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: 1px solid var(--gray-300);
    cursor: pointer;
    z-index: 10;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    background: var(--secondary);
    color: white;
    transform: scale(1.05);
}

.modal-viewer {
    background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
    padding: 2rem;
}

.modal-viewer-stage {
    background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
    border-radius: var(--radius);
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    cursor: grab;
}

.modal-viewer-stage:active {
    cursor: grabbing;
}

#modalProductImage {
    max-width: 85%;
    max-height: 350px;
    object-fit: contain;
    pointer-events: none;
}

.modal-info {
    padding: 2rem;
    overflow-y: auto;
}

.modal-brand {
    color: var(--secondary);
    text-transform: uppercase;
    font-size: 0.7rem;
    letter-spacing: 0.1em;
    font-weight: 700;
}

.modal-name {
    font-size: 1.6rem;
    font-weight: 700;
    margin: 0.5rem 0;
    color: var(--primary);
}

.modal-price {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--primary);
    margin-bottom: 1rem;
}

.modal-price small {
    font-size: 1rem;
    color: var(--gray-500);
    text-decoration: line-through;
    margin-left: 0.5rem;
    font-weight: normal;
}

.color-swatches {
    display: flex;
    gap: 0.5rem;
    margin: 1rem 0;
}

.swatch {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid var(--white);
    transition: all 0.2s;
    box-shadow: var(--shadow-sm);
}

.swatch.active {
    border-color: var(--secondary);
    transform: scale(1.1);
    box-shadow: var(--shadow);
}

/* Toast */
.toast {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    background: var(--primary);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    transform: translateY(100px);
    opacity: 0;
    transition: all 0.3s;
    z-index: 9999;
    font-weight: 500;
    font-size: 0.9rem;
    box-shadow: var(--shadow-lg);
}

.toast.show {
    transform: translateY(0);
    opacity: 1;
}

/* Footer */
.footer {
    background: var(--primary-dark);
    color: var(--white);
    margin-top: 4rem;
}

.footer-top {
    max-width: 1280px;
    margin: 0 auto;
    padding: 3rem 5%;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.footer-col h4 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1.25rem;
    color: var(--white);
}

.footer-col p {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.7);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.footer-col ul {
    list-style: none;
}

.footer-col ul li {
    margin-bottom: 0.5rem;
}

.footer-col ul li a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    font-size: 0.85rem;
    transition: color 0.2s;
}

.footer-col ul li a:hover {
    color: var(--gold);
}

.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.social-links a {
    width: 36px;
    height: 36px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    text-decoration: none;
    transition: all 0.2s;
}

.social-links a:hover {
    background: var(--secondary);
    transform: translateY(-2px);
}

.newsletter-form {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}

.newsletter-form input {
    flex: 1;
    padding: 0.6rem 1rem;
    border: none;
    border-radius: 8px;
    background: rgba(255,255,255,0.1);
    color: var(--white);
    font-size: 0.85rem;
}

.newsletter-form input::placeholder {
    color: rgba(255,255,255,0.5);
}

.newsletter-form button {
    padding: 0.6rem 1.2rem;
    background: var(--secondary);
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 0.8rem;
}

.newsletter-form button:hover {
    background: var(--secondary-dark);
}

.footer-bottom {
    max-width: 1280px;
    margin: 0 auto;
    padding: 1.5rem 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.75rem;
    color: rgba(255,255,255,0.6);
}

.payment-icons {
    display: flex;
    gap: 1rem;
    font-size: 1.2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .hero {
        grid-template-columns: 1fr;
        gap: 2rem;
        padding-top: 6rem;
    }
    
    .hero-content h1 {
        font-size: 2rem;
    }
    
    .modal-content {
        grid-template-columns: 1fr;
    }
    
    .stats {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .footer-top {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .footer-bottom {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .top-bar {
        font-size: 0.65rem;
    }
    
    .top-bar-left, .top-bar-right {
        gap: 0.75rem;
    }
    
    .nav-menu {
        display: none;
    }
    
    .viewer-stage, .modal-viewer-stage {
        min-height: 300px;
    }
    
    #productImage, #modalProductImage {
        max-height: 250px;
    }
}
</style>
</head>
<body>

<!-- Header -->
<header class="header">
    <div class="top-bar">
        <div class="top-bar-left">
            <span><i class="fas fa-truck"></i> Free Shipping Worldwide</span>
            <span><i class="fas fa-undo-alt"></i> 30-Day Returns</span>
            <span><i class="fas fa-headset"></i> 24/7 Customer Support</span>
        </div>
        <div class="top-bar-right">
            <a href="#"><i class="fas fa-flag-usa"></i> EN</a>
            <a href="#"><i class="fas fa-dollar-sign"></i> USD</a>
            <a href="#"><i class="fas fa-user"></i> Account</a>
        </div>
    </div>
    
    <div class="main-header">
        <a href="/" class="logo">
            <span class="logo-primary">Luxury</span><span class="logo-secondary">Vision</span>
        </a>
        
        <nav class="nav-menu">
            <a href="#home">Home</a>
            <a href="#products">Shop</a>
            <a href="#">Collections</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </nav>
        
        <div class="header-icons">
            <a href="#"><i class="fas fa-search"></i></a>
            <a href="#"><i class="fas fa-heart"></i></a>
            <a href="#">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-count">0</span>
            </a>
            <a href="/product/admin/login.php" class="btn-admin-header"><i class="fas fa-lock"></i> Admin</a>
        </div>
    </div>
</header>

<main>
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Experience <span class="highlight">360° Product</span><br>Visualization</h1>
            <p>Click and drag to rotate products in full 360°. Inspect every detail before you purchase with our interactive viewing technology.</p>
            <div class="hero-buttons">
                <a href="#products" class="btn-primary"><i class="fas fa-shopping-bag"></i> Shop Now</a>
                <a href="#" class="btn-outline"><i class="fas fa-play-circle"></i> Watch Demo</a>
            </div>
        </div>
        
        <div class="viewer-container">
            <div class="viewer-label"><i class="fas fa-sync-alt"></i> 360° INTERACTIVE VIEWER</div>
            <div class="viewer-stage" id="viewerStage">
                <img id="productImage" src="" alt="360° Product View">
                <div class="angle-indicator" id="angleDisplay">0°</div>
            </div>
            <div class="viewer-controls">
                <button class="ctrl-btn" id="autoRotateBtn"><i class="fas fa-play"></i> Auto Rotate</button>
                <button class="ctrl-btn" id="resetViewBtn"><i class="fas fa-undo"></i> Reset</button>
                <button class="ctrl-btn" id="frontViewBtn"><i class="fas fa-arrow-left"></i> Front</button>
                <button class="ctrl-btn" id="backViewBtn"><i class="fas fa-arrow-right"></i> Back</button>
            </div>
            <div class="drag-hint">
                <i class="fas fa-mouse-pointer"></i> Click & drag left/right to rotate 360°
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stats">
            <div class="stat-item"><div class="stat-number"><?= count($products) ?>+</div><div class="stat-label">Premium Products</div></div>
            <div class="stat-item"><div class="stat-number">360°</div><div class="stat-label">Interactive Views</div></div>
            <div class="stat-item"><div class="stat-number"><?= count($cats) ?></div><div class="stat-label">Categories</div></div>
            <div class="stat-item"><div class="stat-number">4.9★</div><div class="stat-label">Customer Rating</div></div>
        </div>
    </div>

    <!-- Products Section -->
    <section class="products-section" id="products">
        <div class="section-header">
            <h2>Premium Collection</h2>
            <p>Click any product to experience 360° rotation</p>
        </div>

        <div class="filter-bar" id="filterBar">
            <div class="filter-chip active" data-cat="all" onclick="filterProducts('all')">All Products</div>
            <?php foreach ($cats as $c): ?>
            <div class="filter-chip" data-cat="<?= $c['id'] ?>" onclick="filterProducts('<?= $c['id'] ?>')"><?= sanitize($c['name']) ?></div>
            <?php endforeach; ?>
        </div>

        <div class="product-grid" id="productGrid">
            <?php foreach ($products as $p): 
                $imageUrl = !empty($p['main_image']['image_path']) ? UPLOADS_URL . $p['main_image']['image_path'] : '';
                $discount = $p['original_price'] > 0 ? round((($p['original_price'] - $p['price']) / $p['original_price']) * 100) : 0;
            ?>
            <div class="product-card" data-cat="<?= $p['category_id'] ?>" data-product-id="<?= $p['id'] ?>" onclick="open360Modal(<?= $p['id'] ?>, '<?= $imageUrl ?>')">
                <div class="product-image">
                    <?php if ($imageUrl): ?>
                        <img src="<?= $imageUrl ?>" alt="<?= sanitize($p['name']) ?>">
                    <?php else: ?>
                        <i class="fas fa-camera" style="font-size: 4rem; color: #adb5bd;"></i>
                    <?php endif; ?>
                    <div class="badge-360"><i class="fas fa-sync-alt"></i> 360°</div>
                    <?php if ($p['featured']): ?>
                        <div class="badge-featured"><i class="fas fa-star"></i> Featured</div>
                    <?php endif; ?>
                </div>
                <div class="product-info">
                    <div class="product-brand"><?= sanitize($p['brand']) ?></div>
                    <div class="product-name"><?= sanitize($p['name']) ?></div>
                    <div class="product-price">
                        ₹<?= number_format($p['price']) ?>
                        <?php if ($p['original_price'] > 0): ?>
                            <span class="old-price">₹<?= number_format($p['original_price']) ?></span>
                        <?php endif; ?>
                        <?php if ($discount > 0): ?>
                            <span style="color: #00c853; font-size: 0.7rem; margin-left: 0.5rem;">-<?= $discount ?>%</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<!-- Modal -->
<div class="modal" id="productModal">
    <div class="modal-content">
        <button class="modal-close" onclick="close360Modal()"><i class="fas fa-times"></i></button>
        <div class="modal-viewer">
            <div class="viewer-label"><i class="fas fa-sync-alt"></i> 360° VIEWER - DRAG TO ROTATE</div>
            <div class="modal-viewer-stage" id="modalViewerStage">
                <img id="modalProductImage" src="" alt="360° Product View">
                <div class="angle-indicator" id="modalAngleDisplay">0°</div>
            </div>
            <div class="viewer-controls">
                <button class="ctrl-btn" id="modalAutoBtn"><i class="fas fa-play"></i> Auto Rotate</button>
                <button class="ctrl-btn" onclick="resetModalView()"><i class="fas fa-undo"></i> Reset</button>
            </div>
        </div>
        <div class="modal-info" id="modalInfo"></div>
    </div>
</div>

<div class="toast" id="toast"></div>

<!-- Footer -->
<footer class="footer">
    <div class="footer-top">
        <div class="footer-col">
            <h4>LuxuryVision</h4>
            <p>Experience premium products with immersive 360° visualization technology. Shop with confidence and see every detail before you buy.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        
        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#products">Shop</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>Customer Service</h4>
            <ul>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Shipping Info</a></li>
                <li><a href="#">Returns Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>Newsletter</h4>
            <p>Subscribe to get special offers and updates</p>
            <div class="newsletter-form">
                <input type="email" placeholder="Your email address">
                <button><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div>&copy; 2024 LuxuryVision. All rights reserved.</div>
        <div class="payment-icons">
            <i class="fab fa-cc-visa"></i>
            <i class="fab fa-cc-mastercard"></i>
            <i class="fab fa-cc-amex"></i>
            <i class="fab fa-cc-paypal"></i>
            <i class="fab fa-apple-pay"></i>
        </div>
    </div>
</footer>

<script>
// Product data (same as before - no changes)
var PRODUCTS = <?php 
$productArray = array();
foreach ($products as $p) {
    $productArray[] = array(
        'id' => $p['id'],
        'name' => $p['name'],
        'brand' => $p['brand'],
        'price' => $p['price'],
        'original_price' => $p['original_price'],
        'short_desc' => $p['short_desc'],
        'description' => $p['description'],
        'featured' => $p['featured'],
        'colors_arr' => json_decode($p['colors'] ?? '[]', true) ?: array(),
        'features_arr' => json_decode($p['features'] ?? '[]', true) ?: array(),
        'image_url' => !empty($p['main_image']['image_path']) ? UPLOADS_URL . $p['main_image']['image_path'] : ''
    );
}
echo json_encode($productArray);
?>;

// 360° rotation variables
var currentAngle = 0;
var isDragging = false;
var startX = 0;
var autoRotate = false;
var autoRotateInterval = null;

// Get first product image
var defaultImageUrl = (PRODUCTS.length > 0 && PRODUCTS[0].image_url) ? PRODUCTS[0].image_url : 'https://placehold.co/800x800/0a2540/635bff?text=360°+Product';

// DOM elements
var viewerStage = document.getElementById('viewerStage');
var productImage = document.getElementById('productImage');
var angleDisplay = document.getElementById('angleDisplay');

// Set initial image
if (productImage) {
    productImage.src = defaultImageUrl;
}

function updateImageAngle(angle) {
    var normalizedAngle = angle % 360;
    if (angleDisplay) angleDisplay.textContent = Math.round(normalizedAngle) + '°';
    if (productImage) {
        productImage.style.transform = 'rotateY(' + normalizedAngle + 'deg)';
        productImage.style.transition = 'transform 0.05s linear';
    }
}

// Drag functionality
if (viewerStage) {
    viewerStage.addEventListener('mousedown', function(e) {
        isDragging = true;
        startX = e.clientX;
        if (autoRotate) stopAutoRotate();
        e.preventDefault();
    });
    
    document.addEventListener('mousemove', function(e) {
        if (isDragging) {
            var deltaX = e.clientX - startX;
            currentAngle += deltaX * 0.8;
            startX = e.clientX;
            updateImageAngle(currentAngle);
        }
    });
    
    document.addEventListener('mouseup', function() {
        isDragging = false;
    });
    
    viewerStage.addEventListener('touchstart', function(e) {
        isDragging = true;
        startX = e.touches[0].clientX;
        if (autoRotate) stopAutoRotate();
        e.preventDefault();
    });
    
    document.addEventListener('touchmove', function(e) {
        if (isDragging && e.touches.length) {
            var deltaX = e.touches[0].clientX - startX;
            currentAngle += deltaX * 0.8;
            startX = e.touches[0].clientX;
            updateImageAngle(currentAngle);
        }
    });
    
    document.addEventListener('touchend', function() {
        isDragging = false;
    });
}

function startAutoRotate() {
    if (autoRotateInterval) clearInterval(autoRotateInterval);
    autoRotate = true;
    autoRotateInterval = setInterval(function() {
        if (!isDragging) {
            currentAngle += 1.5;
            updateImageAngle(currentAngle);
        }
    }, 30);
}

function stopAutoRotate() {
    autoRotate = false;
    if (autoRotateInterval) {
        clearInterval(autoRotateInterval);
        autoRotateInterval = null;
    }
}

var autoBtn = document.getElementById('autoRotateBtn');
if (autoBtn) {
    autoBtn.onclick = function() {
        if (autoRotate) {
            stopAutoRotate();
            autoBtn.innerHTML = '<i class="fas fa-play"></i> Auto Rotate';
            autoBtn.classList.remove('active');
        } else {
            startAutoRotate();
            autoBtn.innerHTML = '<i class="fas fa-pause"></i> Pause';
            autoBtn.classList.add('active');
        }
    };
}

var resetBtn = document.getElementById('resetViewBtn');
if (resetBtn) {
    resetBtn.onclick = function() {
        currentAngle = 0;
        updateImageAngle(currentAngle);
    };
}

var frontBtn = document.getElementById('frontViewBtn');
if (frontBtn) {
    frontBtn.onclick = function() {
        currentAngle = 0;
        updateImageAngle(currentAngle);
    };
}

var backBtn = document.getElementById('backViewBtn');
if (backBtn) {
    backBtn.onclick = function() {
        currentAngle = 180;
        updateImageAngle(currentAngle);
    };
}

// Modal functionality
var modalAngle = 0;
var modalDragging = false;
var modalStartX = 0;
var modalAutoRotate = false;
var modalAutoInterval = null;
var modalImage = null;

function open360Modal(productId, imageUrl) {
    var product = null;
    for (var i = 0; i < PRODUCTS.length; i++) {
        if (PRODUCTS[i].id == productId) {
            product = PRODUCTS[i];
            break;
        }
    }
    if (!product) return;
    
    var imgUrl = imageUrl || 'https://placehold.co/800x800/0a2540/635bff?text=360°+Product';
    
    var discount = 0;
    if (product.original_price > 0) {
        discount = Math.round(((product.original_price - product.price) / product.original_price) * 100);
    }
    
    var featuresHtml = '';
    if (product.features_arr && product.features_arr.length > 0) {
        for (var f = 0; f < product.features_arr.length; f++) {
            featuresHtml += '<div style="margin:0.5rem 0;"><i class="fas fa-check-circle" style="color:#635bff;margin-right:0.75rem; width:1rem;"></i>' + escapeHtml(product.features_arr[f]) + '</div>';
        }
    } else {
        featuresHtml = '<div style="color:#6c757d;">• Premium quality<br>• 360° view<br>• Free shipping</div>';
    }
    
    var colorsHtml = '';
    if (product.colors_arr && product.colors_arr.length > 0) {
        colorsHtml = '<div style="margin:1rem 0;"><div style="font-weight:600;margin-bottom:0.5rem;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.1em;color:#6c757d;">Available Colors</div><div class="color-swatches">';
        for (var c = 0; c < product.colors_arr.length; c++) {
            var activeClass = (c === 0) ? 'active' : '';
            colorsHtml += '<div class="swatch ' + activeClass + '" style="background:' + product.colors_arr[c] + '" onclick="selectColor(this)"></div>';
        }
        colorsHtml += '</div></div>';
    }
    
    var html = '<div class="modal-brand">' + escapeHtml(product.brand || 'Premium Brand') + '</div>' +
        '<h2 class="modal-name">' + escapeHtml(product.name) + '</h2>' +
        '<div class="modal-price">₹' + formatNumber(product.price) +
        (product.original_price > 0 ? '<small>₹' + formatNumber(product.original_price) + '</small>' : '') +
        (discount > 0 ? '<span style="color:#00c853;font-size:0.9rem;margin-left:0.5rem;">' + discount + '% OFF</span>' : '') +
        '</div>' +
        '<p style="color:#6c757d;margin:1rem 0;line-height:1.6;">' + escapeHtml(product.short_desc || product.description || 'Experience this product in 360°. Drag left/right to rotate and see every angle.') + '</p>' +
        '<div style="margin:1.5rem 0;"><div style="font-weight:600;margin-bottom:0.75rem;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.1em;color:#6c757d;">Key Features</div>' + featuresHtml + '</div>' +
        colorsHtml +
        '<button class="btn-primary" style="width:100%;justify-content:center;margin-top:1rem;padding:0.9rem;" onclick="addToCart360(\'' + escapeHtml(product.name) + '\')"><i class="fas fa-shopping-cart"></i> Add to Cart</button>';
    
    document.getElementById('modalInfo').innerHTML = html;
    document.getElementById('productModal').classList.add('active');
    document.body.style.overflow = 'hidden';
    
    modalImage = document.getElementById('modalProductImage');
    modalImage.src = imgUrl;
    modalAngle = 0;
    updateModalAngle();
    
    setupModalDrag();
}

function setupModalDrag() {
    var modalStage = document.getElementById('modalViewerStage');
    if (!modalStage) return;
    
    modalStage.addEventListener('mousedown', function(e) {
        modalDragging = true;
        modalStartX = e.clientX;
        if (modalAutoRotate) stopModalAutoRotate();
        e.preventDefault();
    });
    
    document.addEventListener('mousemove', function(e) {
        if (modalDragging && modalImage) {
            var deltaX = e.clientX - modalStartX;
            modalAngle += deltaX * 0.8;
            modalStartX = e.clientX;
            updateModalAngle();
        }
    });
    
    document.addEventListener('mouseup', function() {
        modalDragging = false;
    });
    
    modalStage.addEventListener('touchstart', function(e) {
        modalDragging = true;
        modalStartX = e.touches[0].clientX;
        if (modalAutoRotate) stopModalAutoRotate();
        e.preventDefault();
    });
    
    document.addEventListener('touchmove', function(e) {
        if (modalDragging && modalImage && e.touches.length) {
            var deltaX = e.touches[0].clientX - modalStartX;
            modalAngle += deltaX * 0.8;
            modalStartX = e.touches[0].clientX;
            updateModalAngle();
        }
    });
    
    document.addEventListener('touchend', function() {
        modalDragging = false;
    });
}

function updateModalAngle() {
    if (modalImage) {
        var normalizedAngle = modalAngle % 360;
        modalImage.style.transform = 'rotateY(' + normalizedAngle + 'deg)';
        modalImage.style.transition = 'transform 0.05s linear';
        var angleSpan = document.getElementById('modalAngleDisplay');
        if (angleSpan) angleSpan.textContent = Math.round(normalizedAngle) + '°';
    }
}

function startModalAutoRotate() {
    if (modalAutoInterval) clearInterval(modalAutoInterval);
    modalAutoRotate = true;
    modalAutoInterval = setInterval(function() {
        if (!modalDragging) {
            modalAngle += 1.5;
            updateModalAngle();
        }
    }, 30);
}

function stopModalAutoRotate() {
    modalAutoRotate = false;
    if (modalAutoInterval) {
        clearInterval(modalAutoInterval);
        modalAutoInterval = null;
    }
}

function resetModalView() {
    modalAngle = 0;
    updateModalAngle();
}

var modalAutoBtn = document.getElementById('modalAutoBtn');
if (modalAutoBtn) {
    modalAutoBtn.onclick = function() {
        if (modalAutoRotate) {
            stopModalAutoRotate();
            modalAutoBtn.innerHTML = '<i class="fas fa-play"></i> Auto Rotate';
            modalAutoBtn.classList.remove('active');
        } else {
            startModalAutoRotate();
            modalAutoBtn.innerHTML = '<i class="fas fa-pause"></i> Pause';
            modalAutoBtn.classList.add('active');
        }
    };
}

function close360Modal() {
    document.getElementById('productModal').classList.remove('active');
    document.body.style.overflow = '';
    stopModalAutoRotate();
}

function selectColor(element) {
    var swatches = document.querySelectorAll('.swatch');
    for (var i = 0; i < swatches.length; i++) {
        swatches[i].classList.remove('active');
    }
    element.classList.add('active');
}

function addToCart360(productName) {
    var toast = document.getElementById('toast');
    toast.textContent = productName + ' added to cart!';
    toast.classList.add('show');
    setTimeout(function() {
        toast.classList.remove('show');
    }, 3000);
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    });
}

function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function filterProducts(categoryId) {
    var chips = document.querySelectorAll('.filter-chip');
    for (var i = 0; i < chips.length; i++) {
        chips[i].classList.remove('active');
    }
    var activeChip = document.querySelector('.filter-chip[data-cat="' + categoryId + '"]');
    if (activeChip) activeChip.classList.add('active');
    
    var cards = document.querySelectorAll('.product-card');
    for (var c = 0; c < cards.length; c++) {
        var cardCat = cards[c].dataset.cat;
        if (categoryId === 'all' || cardCat === String(categoryId)) {
            cards[c].style.display = '';
        } else {
            cards[c].style.display = 'none';
        }
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') close360Modal();
});

var modalOverlay = document.getElementById('productModal');
if (modalOverlay) {
    modalOverlay.addEventListener('click', function(e) {
        if (e.target === modalOverlay) close360Modal();
    });
}

updateImageAngle(0);
</script>
</body>
</html>