<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();

$db = getDB();

// Get stats
$totalProducts = $db->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalCategories = $db->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$totalImages = $db->query("SELECT COUNT(*) FROM product_images")->fetchColumn();
$featuredProducts = $db->query("SELECT COUNT(*) FROM products WHERE featured = 1")->fetchColumn();
$activeProducts = $db->query("SELECT COUNT(*) FROM products WHERE status = 'active'")->fetchColumn();

$page_title = 'Dashboard';
include 'layout_head.php';
?>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-box"></i></div>
        <div class="stat-number"><?= $totalProducts ?></div>
        <div class="stat-label">Total Products</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-tags"></i></div>
        <div class="stat-number"><?= $totalCategories ?></div>
        <div class="stat-label">Categories</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-images"></i></div>
        <div class="stat-number"><?= $totalImages ?></div>
        <div class="stat-label">Product Images</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-star"></i></div>
        <div class="stat-number"><?= $featuredProducts ?></div>
        <div class="stat-label">Featured Products</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
        <div class="stat-number"><?= $activeProducts ?></div>
        <div class="stat-label">Active Products</div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <a href="products.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product
        </a>
        <a href="categories.php" class="btn btn-primary">
            <i class="fas fa-tag"></i> Manage Categories
        </a>
        <a href="../public/index.php" target="_blank" class="btn btn-primary">
            <i class="fas fa-eye"></i> View Website
        </a>
    </div>
</div>

<!-- Recent Products -->
<div class="card">
    <h3><i class="fas fa-clock"></i> Recent Products</h3>
    <?php
    $recent = $db->query("SELECT p.*, c.name as cat_name FROM products p LEFT JOIN categories c ON c.id = p.category_id ORDER BY p.created_at DESC LIMIT 5")->fetchAll();
    if ($recent): ?>
    <div class="table-container">
        <table>
            <thead>
                <tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Status</th><th>Created</th></tr>
            </thead>
            <tbody>
                <?php foreach ($recent as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><strong><?= sanitize($p['name']) ?></strong><br><small style="color:#6c757d;"><?= sanitize($p['brand']) ?></small></td>
                    <td><?= sanitize($p['cat_name'] ?? 'Uncategorized') ?></td>
                    <td>₹<?= number_format($p['price']) ?></td>
                    <td><span style="background:<?= $p['status'] == 'active' ? '#00c853' : '#dc2626' ?>; color:white; padding:2px 8px; border-radius:20px; font-size:0.7rem;"><?= $p['status'] ?></span></td>
                    <td><?= date('d M Y', strtotime($p['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p>No products yet. <a href="products.php">Add your first product</a></p>
    <?php endif; ?>
</div>

<?php include 'layout_foot.php'; ?>