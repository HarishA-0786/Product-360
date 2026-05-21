<?php
// Simple demo page - no database required for frontend demo
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>VIZION360 | Premium 360° Product Showcase</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ========== RESET & VARIABLES ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-dark: #05050A;
            --bg-card: #0C0C14;
            --bg-elevated: #11111A;
            --border-glow: rgba(255, 255, 255, 0.05);
            --accent-primary: #6366F1;
            --accent-secondary: #A855F7;
            --accent-glow: #818CF8;
            --accent-gradient: linear-gradient(135deg, #6366F1 0%, #A855F7 100%);
            --text-white: #FFFFFF;
            --text-gray: #A1A1AA;
            --text-muted: #52525B;
            --radius-xl: 28px;
            --radius-lg: 20px;
            --radius-md: 14px;
            --transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        body {
            background: var(--bg-dark);
            font-family: 'Inter', sans-serif;
            color: var(--text-white);
            overflow-x: hidden;
        }

        /* ========== CUSTOM SCROLLBAR ========== */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--bg-card); }
        ::-webkit-scrollbar-thumb { background: var(--accent-primary); border-radius: 10px; }

        /* ========== HEADER ========== */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 0 5%;
            height: 74px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(5, 5, 10, 0.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(99, 102, 241, 0.15);
        }

        .logo {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.7rem;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.02em;
        }
        .logo span { 
            font-weight: 300; 
            font-size: 0.9rem; 
            background: none; 
            color: var(--text-muted);
        }

        .nav-links { 
            display: flex; 
            gap: 2rem; 
            align-items: center; 
        }
        .nav-links a {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-gradient);
            transition: width 0.25s;
        }
        .nav-links a:hover::after,
        .nav-links a.active::after {
            width: 100%;
        }
        .nav-links a:hover,
        .nav-links a.active {
            color: white;
        }

        .btn-outline-glass {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }
        .btn-outline-glass:hover {
            background: rgba(99, 102, 241, 0.25);
            border-color: var(--accent-primary);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: var(--accent-gradient);
            border: none;
            padding: 0.9rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(99, 102, 241, 0.5);
        }

        /* ========== HERO SECTION ========== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 5% 80px;
            position: relative;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute;
            top: -20%;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-bg-2 {
            position: absolute;
            bottom: -30%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            position: relative;
            z-index: 1;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(99, 102, 241, 0.15);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 50px;
            padding: 0.3rem 1rem;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--accent-glow);
            margin-bottom: 1.2rem;
        }
        .hero h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.4rem, 5vw, 4.2rem);
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: -0.02em;
        }
        .gradient-text {
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .hero p {
            color: var(--text-gray);
            margin: 1.5rem 0 2rem;
            max-width: 480px;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* ========== 360 VIEWER CARD ========== */
        .viewer-card {
            background: var(--bg-card);
            border: 1px solid var(--border-glow);
            border-radius: var(--radius-xl);
            overflow: hidden;
            backdrop-filter: blur(4px);
            transition: var(--transition);
        }
        .viewer-card:hover {
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }
        .viewer-header {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid var(--border-glow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .viewer-canvas {
            aspect-ratio: 1/1;
            position: relative;
            background: radial-gradient(ellipse at 50% 60%, rgba(99, 102, 241, 0.08), var(--bg-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: grab;
            overflow: hidden;
        }
        .viewer-canvas:active { cursor: grabbing; }
        .product-3d-stage {
            width: 80%;
            height: 80%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.02s linear;
            transform-style: preserve-3d;
        }
        .rotating-svg {
            width: 100%;
            user-select: none;
            pointer-events: none;
        }
        .viewer-controls {
            padding: 0.8rem 1.2rem;
            border-top: 1px solid var(--border-glow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .ctrl-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-glow);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: var(--text-gray);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .ctrl-btn:hover {
            background: var(--accent-primary);
            color: white;
            border-color: var(--accent-primary);
            transform: scale(1.05);
        }
        .ctrl-btn.active {
            background: var(--accent-primary);
            color: white;
        }
        .color-swatches {
            position: absolute;
            bottom: 16px;
            right: 16px;
            display: flex;
            gap: 10px;
            z-index: 10;
        }
        .swatch {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        .swatch.active { 
            border-color: white; 
            transform: scale(1.2);
            box-shadow: 0 0 10px rgba(99,102,241,0.5);
        }
        .drag-hint {
            position: absolute;
            bottom: 16px;
            left: 16px;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(8px);
            padding: 5px 14px;
            border-radius: 30px;
            font-size: 0.7rem;
            color: var(--text-gray);
            pointer-events: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ========== PRODUCTS SECTION ========== */
        .section-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 5rem 5%;
        }
        .section-header {
            margin-bottom: 2.5rem;
        }
        .section-tag {
            color: var(--accent-glow);
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            display: inline-block;
        }
        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1.8rem, 3.5vw, 3rem);
            font-weight: 700;
            line-height: 1.2;
        }
        .filter-bar {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin: 2rem 0 2.5rem;
        }
        .filter-chip {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border-glow);
            padding: 8px 20px;
            border-radius: 40px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }
        .filter-chip.active,
        .filter-chip:hover {
            background: var(--accent-primary);
            border-color: var(--accent-primary);
            color: white;
            transform: translateY(-2px);
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }
        .product-card {
            background: var(--bg-card);
            border: 1px solid var(--border-glow);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: var(--transition);
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-8px);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.4);
        }
        .product-thumb {
            aspect-ratio: 4/3;
            background: radial-gradient(ellipse at 50% 60%, rgba(99, 102, 241, 0.1), var(--bg-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .product-thumb svg { 
            width: 55%; 
            transition: transform 0.4s ease; 
        }
        .product-card:hover .product-thumb svg { 
            transform: scale(1.08) rotate(-2deg); 
        }
        .badge-360-small {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(0,0,0,0.7);
            border-radius: 30px;
            padding: 5px 12px;
            font-size: 0.7rem;
            font-weight: 600;
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .product-info { 
            padding: 1.3rem; 
        }
        .product-brand {
            color: var(--text-muted);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .product-name {
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0.3rem 0 0.4rem;
        }
        .product-price {
            font-weight: 800;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-size: 1.2rem;
        }

        /* ========== FEATURES SECTION ========== */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        .feature-card {
            background: var(--bg-card);
            border: 1px solid var(--border-glow);
            border-radius: var(--radius-lg);
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            border-color: rgba(99, 102, 241, 0.3);
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
            font-size: 1.8rem;
            color: var(--accent-primary);
        }
        .feature-card h3 {
            font-family: 'Space Grotesk', sans-serif;
            margin-bottom: 0.5rem;
        }
        .feature-card p {
            color: var(--text-gray);
            font-size: 0.85rem;
            line-height: 1.6;
        }

        /* ========== MODAL ========== */
        .modal-360 {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(5, 5, 10, 0.98);
            backdrop-filter: blur(24px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            width: 90%;
            max-width: 1100px;
            background: var(--bg-elevated);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: var(--radius-xl);
            overflow: hidden;
            animation: modalFadeIn 0.3s ease;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .modal-header {
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-glow);
        }
        .modal-body {
            display: grid;
            grid-template-columns: 1fr 340px;
            min-height: 520px;
        }
        .modal-viewer-area {
            background: radial-gradient(ellipse at 50% 60%, rgba(99, 102, 241, 0.08), var(--bg-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .modal-rotating-container {
            width: 70%;
            height: 70%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.02s linear;
        }
        .modal-sidebar {
            padding: 1.8rem;
            border-left: 1px solid var(--border-glow);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .modal-color-picker {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin: 0.5rem 0;
        }
        .modal-swatch {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s;
        }
        .modal-swatch.active { 
            border-color: white; 
            transform: scale(1.1);
        }
        .close-modal {
            background: none;
            border: none;
            color: var(--text-gray);
            font-size: 1.2rem;
            cursor: pointer;
            transition: var(--transition);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .close-modal:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #EF4444;
        }
        .toast {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(80px);
            background: #1A1A24;
            border: 1px solid var(--accent-primary);
            padding: 12px 28px;
            border-radius: 50px;
            color: white;
            transition: 0.3s;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }
        .toast.show { transform: translateX(-50%) translateY(0); }

        /* ========== FOOTER ========== */
        footer {
            text-align: center;
            padding: 2.5rem;
            border-top: 1px solid var(--border-glow);
            color: var(--text-muted);
            background: var(--bg-card);
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 900px) {
            .hero-grid { 
                grid-template-columns: 1fr; 
                gap: 2rem;
            }
            .nav-links { display: none; }
            .modal-body { 
                grid-template-columns: 1fr; 
            }
            .modal-sidebar {
                border-left: none;
                border-top: 1px solid var(--border-glow);
            }
            .hero {
                padding-top: 100px;
            }
        }

        @media (max-width: 480px) {
            .section-container {
                padding: 3rem 5%;
            }
            .products-grid {
                grid-template-columns: 1fr;
            }
            .btn-outline-glass {
                display: none;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">VIZION<span>360</span></div>
    <div class="nav-links">
        <a href="#" class="active" onclick="scrollToSection('hero')">Home</a>
        <a href="#" onclick="scrollToSection('products')">Products</a>
        <a href="#" onclick="scrollToSection('features')">Features</a>
        <a href="#" onclick="scrollToSection('contact')">Contact</a>
    </div>
    <button class="btn-outline-glass" onclick="scrollToSection('products')">
        <i class="fas fa-cube"></i> Explore 360°
    </button>
</header>

<!-- Hero Section -->
<section id="hero" class="hero">
    <div class="hero-bg"></div>
    <div class="hero-bg-2"></div>
    <div class="hero-grid">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-vr-cardboard"></i> Immersive 360° Experience
            </div>
            <h1>Turn your product into an <span class="gradient-text">interactive</span> masterpiece</h1>
            <p>Spin, zoom, and explore every angle. Our patent-pending 360° viewer gives customers the confidence to buy instantly.</p>
            <button class="btn-primary" onclick="scrollToSection('products')">
                <i class="fas fa-rotate-right"></i> View Collection
            </button>
        </div>
        <div class="viewer-card">
            <div class="viewer-header">
                <span><i class="fas fa-sync-alt" style="color:#6366F1"></i> Live Demo</span>
                <span style="font-size:0.7rem; color:var(--text-muted);"><i class="fas fa-mouse-pointer"></i> Drag to rotate</span>
            </div>
            <div class="viewer-canvas" id="heroCanvas">
                <div class="product-3d-stage" id="heroStage">
                    <svg class="rotating-svg" id="heroSVG" viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="watchGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#6366F1"/>
                                <stop offset="100%" stop-color="#A855F7"/>
                            </linearGradient>
                            <filter id="glow">
                                <feGaussianBlur stdDeviation="3" result="blur"/>
                                <feMerge>
                                    <feMergeNode in="blur"/>
                                    <feMergeNode in="SourceGraphic"/>
                                </feMerge>
                            </filter>
                        </defs>
                        <!-- Watch Strap Top -->
                        <rect x="118" y="20" width="64" height="55" rx="10" fill="#1A1A2E"/>
                        <rect x="124" y="24" width="52" height="47" rx="8" fill="#2A2A3E"/>
                        <!-- Watch Strap Bottom -->
                        <rect x="118" y="225" width="64" height="55" rx="10" fill="#1A1A2E"/>
                        <rect x="124" y="229" width="52" height="47" rx="8" fill="#2A2A3E"/>
                        <!-- Watch Body -->
                        <rect x="75" y="70" width="150" height="160" rx="36" fill="#2A2A3E" filter="url(#glow)"/>
                        <rect x="79" y="74" width="142" height="152" rx="33" fill="#16133A"/>
                        <!-- Screen -->
                        <rect x="92" y="87" width="116" height="126" rx="24" fill="#080820"/>
                        <rect x="92" y="87" width="116" height="126" rx="24" fill="url(#watchGrad)" opacity="0.08"/>
                        <!-- Time Display -->
                        <text x="150" y="138" text-anchor="middle" fill="white" font-size="28" font-weight="bold" font-family="'Space Grotesk', sans-serif">10:09</text>
                        <text x="150" y="158" text-anchor="middle" fill="#A78BFA" font-size="10" font-family="'Inter', sans-serif">MON, 19 MAY</text>
                        <!-- Steps Bar -->
                        <rect x="108" y="172" width="84" height="6" rx="3" fill="#1E1B4B"/>
                        <rect x="108" y="172" width="54" height="6" rx="3" fill="url(#watchGrad)"/>
                        <text x="150" y="195" text-anchor="middle" fill="#6B7280" font-size="8">8,453 steps</text>
                        <!-- Crown & Buttons -->
                        <rect x="225" y="128" width="14" height="22" rx="5" fill="#2A2A3E" stroke="#8B5CF6" stroke-width="1.5"/>
                        <rect x="225" y="158" width="14" height="14" rx="4" fill="#2A2A3E" stroke="rgba(139,92,246,0.4)" stroke-width="1"/>
                        <!-- Bezel -->
                        <rect x="75" y="70" width="150" height="160" rx="36" fill="none" stroke="url(#watchGrad)" stroke-width="1.5" opacity="0.6"/>
                    </svg>
                </div>
                <div class="color-swatches" id="heroSwatches"></div>
                <div class="drag-hint">
                    <i class="fas fa-hand-pointer"></i> Drag to rotate
                </div>
            </div>
            <div class="viewer-controls">
                <button class="ctrl-btn" id="resetBtn" title="Reset View">
                    <i class="fas fa-undo"></i>
                </button>
                <span id="angleLabel" style="font-size:0.75rem; font-family: monospace;">0°</span>
                <button class="ctrl-btn" id="autoRotateBtn" title="Auto Rotate">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="section-container">
    <div class="section-header">
        <div class="section-tag">PREMIUM COLLECTION 2026</div>
        <h2 class="section-title">Explore <span class="gradient-text">every detail</span> in 360°</h2>
        <p style="color: var(--text-gray); margin-top: 1rem; max-width: 600px;">Click any product to open the immersive 360° viewer. Rotate, zoom, and inspect every angle.</p>
    </div>
    <div class="filter-bar" id="filterBar"></div>
    <div class="products-grid" id="productsGrid"></div>
</section>

<!-- Features Section -->
<section id="features" class="section-container">
    <div class="section-header" style="text-align: center;">
        <div class="section-tag">WHY CHOOSE US</div>
        <h2 class="section-title">Revolutionizing <span class="gradient-text">product experience</span></h2>
        <p style="color: var(--text-gray); margin-top: 1rem;">Experience products like never before with cutting-edge 360° technology</p>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-rotate"></i></div>
            <h3>360° Rotation</h3>
            <p>Fluid rotation at 60fps - drag to inspect every angle of your product</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-magnifying-glass-plus"></i></div>
            <h3>Deep Zoom</h3>
            <p>Zoom in up to 4x to examine textures, stitching, and fine details</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-palette"></i></div>
            <h3>Color Variants</h3>
            <p>Switch between all available colors in real-time without leaving the viewer</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-bolt"></i></div>
            <h3>Instant Load</h3>
            <p>Progressive loading ensures your 360° experience starts in milliseconds</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-mobile-screen"></i></div>
            <h3>Mobile Native</h3>
            <p>Touch-drag on mobile works exactly like mouse-drag on desktop</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-shield"></i></div>
            <h3>Secure Shopping</h3>
            <p>SSL encrypted checkout with multiple payment options</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section-container" style="background: rgba(99,102,241,0.03); border-radius: 40px; margin-bottom: 2rem;">
    <div class="section-header" style="text-align: center;">
        <div class="section-tag">GET IN TOUCH</div>
        <h2 class="section-title">Ready to <span class="gradient-text">experience</span> the difference?</h2>
        <p style="color: var(--text-gray); max-width: 500px; margin: 1rem auto;">Join thousands of customers who shop smarter with our 360° interactive product viewer</p>
        <button class="btn-primary" style="margin-top: 1.5rem;" onclick="showToastMessage('Demo contact form would open here')">
            <i class="fas fa-envelope"></i> Contact Us
        </button>
    </div>
</section>

<footer>
    <p>© 2026 VIZION360 — Premium Interactive Showcase. All rights reserved.</p>
    <div style="margin-top: 1rem; display: flex; gap: 1.5rem; justify-content: center;">
        <a href="#" style="color: var(--text-muted); text-decoration: none;">Privacy Policy</a>
        <a href="#" style="color: var(--text-muted); text-decoration: none;">Terms of Service</a>
        <a href="#" style="color: var(--text-muted); text-decoration: none;">Returns</a>
    </div>
</footer>

<!-- Modal -->
<div class="modal-360" id="productModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Product Name</h3>
            <button class="close-modal" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-viewer-area" id="modalViewerArea">
                <div class="modal-rotating-container" id="modalRotatingDiv">
                    <svg id="modalSVG" viewBox="0 0 300 300" width="100%"></svg>
                </div>
                <button class="ctrl-btn" id="modalAutoBtn" onclick="toggleModalAuto()" style="position:absolute; bottom:16px; left:16px;">
                    <i class="fas fa-play"></i>
                </button>
                <div class="drag-hint" style="position:absolute; bottom:16px; right:16px; left:auto;">
                    <i class="fas fa-hand-pointer"></i> Drag
                </div>
            </div>
            <div class="modal-sidebar" id="modalSidebar"></div>
        </div>
    </div>
</div>

<div class="toast" id="toast">
    <i class="fas fa-check-circle" style="color: #10B981;"></i>
    <span id="toastMsg">Product added to cart!</span>
</div>

<script>
    // ==================== PRODUCT DATABASE ====================
    const products = [
        { id: 1, cat: "watch", name: "Apex Quantum", brand: "LuxeTech", price: "$399", desc: "Titanium smartwatch with AMOLED display, heart rate monitoring, GPS, and 7-day battery life. Aerospace-grade materials with sapphire crystal.", colors: ["purple", "gold", "cyan"], svgType: "watch" },
        { id: 2, cat: "bag", name: "Orbit Tote", brand: "Atelier", price: "$249", desc: "Handcrafted full-grain leather tote bag with anti-scratch lining, laptop compartment, and magnetic closure. Made in Italy.", colors: ["black", "rose", "gold"], svgType: "bag" },
        { id: 3, cat: "shoe", name: "Vortex Runner", brand: "Strider", price: "$189", desc: "Ultralight carbon fiber running shoes with responsive foam midsole, breathable mesh upper, and energy return technology.", colors: ["cyan", "purple", "black"], svgType: "shoe" },
        { id: 4, cat: "tech", name: "Aura Buds Pro", brand: "AudioPhile", price: "$129", desc: "Active noise cancelling earbuds with 32-hour total battery life, spatial audio, custom EQ tuning, and Bluetooth 5.3.", colors: ["white", "black", "purple"], svgType: "buds" }
    ];

    // Color configurations for SVG
    const colorConfig = {
        purple: { a1: "#6366F1", a2: "#A855F7", b1: "#1A1A2E", b2: "#2A2A3E" },
        gold: { a1: "#F59E0B", a2: "#FDE68A", b1: "#2D1F00", b2: "#3E2A10" },
        cyan: { a1: "#06B6D4", a2: "#67E8F9", b1: "#00181C", b2: "#002A30" },
        rose: { a1: "#F43F5E", a2: "#FB7185", b1: "#1C0010", b2: "#2D0018" },
        black: { a1: "#6B7280", a2: "#9CA3AF", b1: "#0A0A0A", b2: "#1A1A1A" },
        white: { a1: "#D1D5DB", a2: "#F3F4F6", b1: "#E5E5E5", b2: "#F9F9F9" }
    };

    // SVG Generator function
    function getProductSVG(type, colorName) {
        const c = colorConfig[colorName] || colorConfig.purple;
        
        if (type === "watch") {
            return `<svg viewBox="0 0 300 300"><defs><linearGradient id="g1"><stop offset="0%" stop-color="${c.a1}"/><stop offset="100%" stop-color="${c.a2}"/></linearGradient></defs><rect x="118" y="20" width="64" height="55" rx="10" fill="${c.b1}"/><rect x="124" y="24" width="52" height="47" rx="8" fill="${c.b2}"/><rect x="118" y="225" width="64" height="55" rx="10" fill="${c.b1}"/><rect x="124" y="229" width="52" height="47" rx="8" fill="${c.b2}"/><rect x="75" y="70" width="150" height="160" rx="36" fill="${c.b2}"/><rect x="79" y="74" width="142" height="152" rx="33" fill="#16133A"/><rect x="92" y="87" width="116" height="126" rx="24" fill="#080820"/><text x="150" y="138" text-anchor="middle" fill="white" font-size="28" font-weight="bold">10:09</text><text x="150" y="158" text-anchor="middle" fill="${c.a1}" font-size="10">MONDAY</text><rect x="108" y="172" width="84" height="6" rx="3" fill="${c.b1}"/><rect x="108" y="172" width="54" height="6" rx="3" fill="url(#g1)"/><rect x="225" y="128" width="14" height="22" rx="5" fill="${c.b2}" stroke="${c.a1}" stroke-width="1.5"/><rect x="75" y="70" width="150" height="160" rx="36" fill="none" stroke="url(#g1)" stroke-width="2"/></svg>`;
        }
        if (type === "bag") {
            return `<svg viewBox="0 0 300 300"><path d="M110 95 Q110 55 150 55 Q190 55 190 95" fill="none" stroke="${c.a1}" stroke-width="10" stroke-linecap="round"/><rect x="60" y="93" width="180" height="160" rx="20" fill="${c.b2}"/><rect x="64" y="97" width="172" height="152" rx="18" fill="${c.b1}"/><rect x="80" y="130" width="140" height="90" rx="12" fill="${c.b2}" stroke="${c.a1}" stroke-width="0.8" stroke-opacity="0.4"/><line x1="90" y1="130" x2="210" y2="130" stroke="${c.a1}" stroke-width="2"/><circle cx="150" cy="130" r="5" fill="${c.a1}" opacity="0.8"/><circle cx="150" cy="175" r="22" fill="${c.b1}" stroke="${c.a1}" stroke-width="1.5"/><text x="150" y="180" text-anchor="middle" fill="${c.a2}" font-size="14" font-weight="bold">L</text><rect x="108" y="90" width="18" height="12" rx="4" fill="${c.a1}" opacity="0.7"/><rect x="174" y="90" width="18" height="12" rx="4" fill="${c.a1}" opacity="0.7"/></svg>`;
        }
        if (type === "shoe") {
            return `<svg viewBox="0 0 300 300"><path d="M50 220 Q52 240 100 245 L250 242 Q270 240 268 228 L50 220Z" fill="${c.a1}" opacity="0.9"/><path d="M50 220 L240 216 Q260 214 258 206 Q255 198 230 196 L70 200 Q52 202 50 212Z" fill="${c.b2}"/><path d="M70 200 L80 155 Q90 130 120 120 L185 115 Q220 112 240 135 L248 196 L230 196 L70 200Z" fill="${c.b1}"/><path d="M80 155 L90 130 Q100 118 130 115" fill="none" stroke="${c.a1}" stroke-width="1.5"/><line x1="115" y1="140" x2="185" y2="137" stroke="white" stroke-width="2"/><line x1="117" y1="152" x2="187" y2="149" stroke="white" stroke-width="2"/><path d="M90 175 Q140 155 215 168" fill="none" stroke="${c.a2}" stroke-width="3"/><text x="150" y="235" text-anchor="middle" fill="white" font-size="7" opacity="0.6">LUXE STEP</text></svg>`;
        }
        if (type === "buds") {
            return `<svg viewBox="0 0 300 300"><rect x="75" y="90" width="150" height="120" rx="30" fill="${c.b2}"/><rect x="79" y="94" width="142" height="112" rx="28" fill="${c.b1}"/><line x1="79" y1="150" x2="221" y2="150" stroke="${c.a1}" stroke-width="0.8" opacity="0.4"/><ellipse cx="117" cy="140" rx="22" ry="28" fill="${c.b2}" stroke="${c.a1}" stroke-width="0.8"/><ellipse cx="117" cy="140" rx="16" ry="22" fill="#080820"/><circle cx="117" cy="140" r="6" fill="${c.a1}" opacity="0.5"/><ellipse cx="183" cy="140" rx="22" ry="28" fill="${c.b2}" stroke="${c.a1}" stroke-width="0.8"/><ellipse cx="183" cy="140" rx="16" ry="22" fill="#080820"/><circle cx="183" cy="140" r="6" fill="${c.a1}" opacity="0.5"/><circle cx="136" cy="195" r="4" fill="${c.a1}" opacity="0.9"/><circle cx="150" cy="195" r="4" fill="${c.a1}" opacity="0.5"/><circle cx="164" cy="195" r="4" fill="${c.a1}" opacity="0.3"/><rect x="138" y="87" width="24" height="8" rx="4" fill="${c.a1}" opacity="0.4"/></svg>`;
        }
        return `<svg viewBox="0 0 300 300"><circle cx="150" cy="150" r="50" fill="${c.a1}"/></svg>`;
    }

    // ==================== RENDER PRODUCTS ====================
    function renderProducts(filter = "all") {
        const grid = document.getElementById("productsGrid");
        const filtered = filter === "all" ? products : products.filter(p => p.cat === filter);
        grid.innerHTML = filtered.map(p => `
            <div class="product-card" onclick="openProductModal(${p.id})">
                <div class="product-thumb">
                    ${getProductSVG(p.svgType, p.colors[0])}
                    <div class="badge-360-small">
                        <i class="fas fa-rotate"></i> 360°
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-brand">${p.brand}</div>
                    <div class="product-name">${p.name}</div>
                    <div class="product-price">${p.price}</div>
                </div>
            </div>
        `).join("");
    }

    function initFilters() {
        const cats = ["all", ...new Set(products.map(p => p.cat))];
        document.getElementById("filterBar").innerHTML = cats.map(c => `
            <div class="filter-chip ${c === 'all' ? 'active' : ''}" data-cat="${c}" onclick="filterProducts('${c}')">
                ${c === 'all' ? 'All Products' : c.toUpperCase()}
            </div>
        `).join("");
    }

    window.filterProducts = (cat) => {
        document.querySelectorAll(".filter-chip").forEach(ch => ch.classList.remove("active"));
        document.querySelector(`.filter-chip[data-cat="${cat}"]`).classList.add("active");
        renderProducts(cat);
    };

    // ==================== HERO 360 VIEWER ====================
    let heroAngle = 0, heroDragging = false, heroLastX = 0, heroAuto = false, heroAnimId = null;
    const heroStage = document.getElementById("heroStage");
    const heroSVG = document.getElementById("heroSVG");

    function applyHeroTransform() {
        heroStage.style.transform = `perspective(600px) rotateY(${heroAngle}deg)`;
        document.getElementById("angleLabel").innerHTML = Math.round(heroAngle % 360) + "°";
    }

    const heroCanvas = document.getElementById("heroCanvas");
    heroCanvas.addEventListener("mousedown", (e) => { heroDragging = true; heroLastX = e.clientX; if (heroAuto) toggleHeroAuto(); });
    document.addEventListener("mousemove", (e) => { if (heroDragging) { heroAngle += (e.clientX - heroLastX) * 0.6; heroLastX = e.clientX; applyHeroTransform(); } });
    document.addEventListener("mouseup", () => { heroDragging = false; });
    heroCanvas.addEventListener("touchstart", (e) => { heroDragging = true; heroLastX = e.touches[0].clientX; if (heroAuto) toggleHeroAuto(); });
    document.addEventListener("touchmove", (e) => { if (heroDragging) { heroAngle += (e.touches[0].clientX - heroLastX) * 0.6; heroLastX = e.touches[0].clientX; applyHeroTransform(); } });
    document.addEventListener("touchend", () => { heroDragging = false; });

    function toggleHeroAuto() {
        heroAuto = !heroAuto;
        const btn = document.getElementById("autoRotateBtn");
        btn.innerHTML = heroAuto ? '<i class="fas fa-pause"></i>' : '<i class="fas fa-play"></i>';
        btn.classList.toggle("active", heroAuto);
        if (heroAuto) startHeroAuto();
        else if (heroAnimId) cancelAnimationFrame(heroAnimId);
    }

    function startHeroAuto() {
        function loop() {
            if (heroAuto && !heroDragging) { heroAngle += 0.5; applyHeroTransform(); }
            heroAnimId = requestAnimationFrame(loop);
        }
        loop();
    }

    document.getElementById("resetBtn").onclick = () => { heroAngle = 0; applyHeroTransform(); };
    document.getElementById("autoRotateBtn").onclick = toggleHeroAuto;

    function initHeroSwatches() {
        const colorList = [
            { name: "purple", bg: "#6366F1" },
            { name: "gold", bg: "#F59E0B" },
            { name: "cyan", bg: "#06B6D4" },
            { name: "rose", bg: "#F43F5E" }
        ];
        document.getElementById("heroSwatches").innerHTML = colorList.map(c => `
            <div class="swatch" style="background:${c.bg}" onclick="changeHeroColor('${c.name}', this)"></div>
        `).join("");
        document.querySelectorAll("#heroSwatches .swatch")[0]?.classList.add("active");
    }

    window.changeHeroColor = (color, el) => {
        document.querySelectorAll("#heroSwatches .swatch").forEach(s => s.classList.remove("active"));
        el.classList.add("active");
        const newSVG = getProductSVG("watch", color);
        heroSVG.outerHTML = newSVG;
        const newHeroSVG = document.getElementById("heroSVG");
        if (newHeroSVG) {
            Object.assign(heroSVG, newHeroSVG);
        }
    };

    // ==================== MODAL 360 VIEWER ====================
    let currentProduct = null, modalAngle = 0, modalDragging = false, modalLastX = 0, modalAuto = false, modalAnimId = null;
    let currentModalColor = "";

    window.openProductModal = (id) => {
        currentProduct = products.find(p => p.id === id);
        if (!currentProduct) return;
        currentModalColor = currentProduct.colors[0];
        modalAngle = 0;
        modalAuto = false;
        document.getElementById("modalTitle").innerText = currentProduct.name;
        updateModalSVG();
        
        document.getElementById("modalSidebar").innerHTML = `
            <div style="color:var(--text-muted); font-size:0.75rem; letter-spacing:0.08em;">${currentProduct.brand}</div>
            <h2 style="font-family:'Space Grotesk',sans-serif; font-size:1.5rem;">${currentProduct.name}</h2>
            <p style="color:var(--text-gray); line-height:1.6;">${currentProduct.desc}</p>
            <div style="font-size:2rem; font-weight:800; background:var(--accent-gradient); -webkit-background-clip:text; background-clip:text; color:transparent;">${currentProduct.price}</div>
            <div>
                <div style="margin-bottom:10px; font-size:0.85rem; color:var(--text-muted);">Available Colors</div>
                <div class="modal-color-picker" id="modalColorPicker"></div>
            </div>
            <button class="btn-primary" onclick="showToastMessage('${currentProduct.name} added to cart!')" style="margin-top:0.5rem; width:100%;">
                <i class="fas fa-shopping-bag"></i> Add to Cart
            </button>
        `;
        
        const colorHtml = currentProduct.colors.map(c => `
            <div class="modal-swatch" style="background:${c==='purple'?'#6366F1':c==='gold'?'#F59E0B':c==='cyan'?'#06B6D4':c==='rose'?'#F43F5E':c==='black'?'#1A1A1A':'#E5E5E5'}" onclick="changeModalColor('${c}', this)"></div>
        `).join("");
        document.getElementById("modalColorPicker").innerHTML = colorHtml;
        document.querySelectorAll(".modal-swatch")[0]?.classList.add("active");
        
        document.getElementById("productModal").style.display = "flex";
        document.body.style.overflow = "hidden";
        startModalAuto();
    };

    window.changeModalColor = (color, el) => {
        document.querySelectorAll(".modal-swatch").forEach(s => s.classList.remove("active"));
        el.classList.add("active");
        currentModalColor = color;
        updateModalSVG();
    };

    function updateModalSVG() {
        const svgElement = document.getElementById("modalSVG");
        svgElement.innerHTML = getProductSVG(currentProduct.svgType, currentModalColor);
        applyModalTransform();
    }

    function applyModalTransform() {
        document.getElementById("modalRotatingDiv").style.transform = `perspective(600px) rotateY(${modalAngle}deg)`;
    }

    const modalViewerArea = document.getElementById("modalViewerArea");
    modalViewerArea.addEventListener("mousedown", (e) => { modalDragging = true; modalLastX = e.clientX; if (modalAuto) toggleModalAuto(); });
    document.addEventListener("mousemove", (e) => { if (modalDragging) { modalAngle += (e.clientX - modalLastX) * 0.5; modalLastX = e.clientX; applyModalTransform(); } });
    document.addEventListener("mouseup", () => { modalDragging = false; });
    modalViewerArea.addEventListener("touchstart", (e) => { modalDragging = true; modalLastX = e.touches[0].clientX; if (modalAuto) toggleModalAuto(); });
    document.addEventListener("touchmove", (e) => { if (modalDragging) { modalAngle += (e.touches[0].clientX - modalLastX) * 0.5; modalLastX = e.touches[0].clientX; applyModalTransform(); } });
    document.addEventListener("touchend", () => { modalDragging = false; });

    window.toggleModalAuto = () => {
        modalAuto = !modalAuto;
        const btn = document.getElementById("modalAutoBtn");
        btn.innerHTML = modalAuto ? '<i class="fas fa-pause"></i>' : '<i class="fas fa-play"></i>';
        if (!modalAuto && modalAnimId) cancelAnimationFrame(modalAnimId);
    };

    function startModalAuto() {
        function loop() {
            if (modalAuto && !modalDragging) { modalAngle += 0.5; applyModalTransform(); }
            modalAnimId = requestAnimationFrame(loop);
        }
        loop();
    }

    window.closeModal = () => {
        document.getElementById("productModal").style.display = "none";
        document.body.style.overflow = "";
        modalAuto = false;
        if (modalAnimId) cancelAnimationFrame(modalAnimId);
    };

    window.showToastMessage = (msg) => {
        const toast = document.getElementById("toast");
        document.getElementById("toastMsg").innerText = msg;
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 3000);
    };

    window.scrollToSection = (id) => {
        document.getElementById(id)?.scrollIntoView({ behavior: "smooth" });
    };

    // Initialize everything
    renderProducts();
    initFilters();
    initHeroSwatches();
    startHeroAuto();
</script>
</body>
</html>