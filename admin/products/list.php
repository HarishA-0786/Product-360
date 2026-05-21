<?php
require_once '../includes/auth-check.php';
require_once '../includes/admin-header.php';
require_once '../includes/admin-sidebar.php';

$products = $pdo->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC")->fetchAll();
?>
<div class="admin-main">
    <div class="admin-header">
        <h1>Products Management</h1>
        <a href="add.php" class="btn-primary">+ Add New Product</a>
    </div>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>360° View</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach($products as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo htmlspecialchars($p['name']); ?></td>
                    <td><?php echo htmlspecialchars($p['category_name']); ?></td>
                    <td><?php echo formatPrice($p['price']); ?></td>
                    <td><?php echo $p['has_360_view'] ? '<span class="badge-success">Yes</span>' : '<span class="badge-muted">No</span>'; ?></td>
                    <td><?php echo $p['status'] ? '<span class="badge-success">Active</span>' : '<span class="badge-danger">Inactive</span>'; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $p['id']; ?>" class="btn-sm">Edit</a>
                        <a href="delete.php?id=<?php echo $p['id']; ?>" class="btn-sm danger" onclick="return confirm('Delete this product?')">Delete</a>
                        <a href="upload-360.php?id=<?php echo $p['id']; ?>" class="btn-sm">360° Frames</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once '../includes/admin-footer.php'; ?>