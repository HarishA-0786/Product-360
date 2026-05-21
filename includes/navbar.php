<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header>
    <div class="logo">VIZION<span>360</span></div>
    <div class="nav-links">
        <a href="<?php echo SITE_URL; ?>index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a>
        <a href="<?php echo SITE_URL; ?>products.php" class="<?php echo $current_page == 'products.php' ? 'active' : ''; ?>">Products</a>
        <a href="<?php echo SITE_URL; ?>about.php">About</a>
        <a href="<?php echo SITE_URL; ?>contact.php">Contact</a>
        <?php if(isset($_SESSION['admin_id'])): ?>
        <a href="<?php echo ADMIN_URL; ?>dashboard.php">Admin</a>
        <?php endif; ?>
    </div>
    <button class="btn-outline-glass" onclick="location.href='<?php echo SITE_URL; ?>products.php'">
        <i class="fas fa-cube"></i> Explore 360°
    </button>
    <div class="hamburger" onclick="toggleMobileMenu()">
        <span></span><span></span><span></span>
    </div>
</header>