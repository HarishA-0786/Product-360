<?php
require_once '../includes/auth-check.php';
require_once '../includes/admin-header.php';
require_once '../includes/admin-sidebar.php';

$categories = $pdo->query("SELECT * FROM categories WHERE status = 1 ORDER BY name")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $slug = slugify($name);
    $description = $_POST['description'];
    $short_desc = $_POST['short_description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $brand = $_POST['brand'];
    $has_360 = isset($_POST['has_360_view']) ? 1 : 0;
    
    $stmt = $pdo->prepare("INSERT INTO products (name, slug, description, short_description, price, category_id, brand, has_360_view, status) VALUES (:name, :slug, :desc, :short_desc, :price, :cat, :brand, :has_360, 1)");
    $stmt->execute([
        'name' => $name,
        'slug' => $slug,
        'desc' => $description,
        'short_desc' => $short_desc,
        'price' => $price,
        'cat' => $category_id,
        'brand' => $brand,
        'has_360' => $has_360
    ]);
    
    redirect('list.php');
}
?>
<div class="admin-main">
    <div class="admin-header">
        <h1>Add New Product</h1>
    </div>
    <form method="POST" class="admin-form">
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Short Description</label>
            <input type="text" name="short_description">
        </div>
        <div class="form-group">
            <label>Full Description</label>
            <textarea name="description" rows="5"></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Price ($)</label>
                <input type="number" step="0.01" name="price" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id">
                    <?php foreach($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Brand</label>
                <input type="text" name="brand">
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="has_360_view"> Enable 360° View
                </label>
            </div>
        </div>
        <button type="submit" class="btn-primary">Save Product</button>
    </form>
</div>
<?php require_once '../includes/admin-footer.php'; ?>