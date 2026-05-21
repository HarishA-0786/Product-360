<?php
require_once 'includes/auth-check.php';
require_once 'includes/admin-header.php';
require_once 'includes/admin-sidebar.php';

// Get stats
$total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$total_categories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$total_enquiries = $pdo->query("SELECT COUNT(*) FROM enquiries WHERE status = 'unread'")->fetchColumn();
?>
<div class="admin-main">
    <div class="admin-header">
        <h1>Dashboard</h1>
        <p>Welcome back, <?php echo htmlspecialchars($_SESSION['admin_name']); ?></p>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-box"></i></div>
            <div class="stat-info">
                <h3><?php echo $total_products; ?></h3>
                <p>Total Products</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-tags"></i></div>
            <div class="stat-info">
                <h3><?php echo $total_categories; ?></h3>
                <p>Categories</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-envelope"></i></div>
            <div class="stat-info">
                <h3><?php echo $total_enquiries; ?></h3>
                <p>Unread Enquiries</p>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/admin-footer.php'; ?>