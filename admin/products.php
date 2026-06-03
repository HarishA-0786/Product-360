<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();

$db = getDB();
$message = '';
$error = '';

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    try {
        $stmt = $db->prepare("SELECT image_path FROM product_images WHERE product_id = ?");
        $stmt->execute([$id]);
        $images = $stmt->fetchAll();
        foreach ($images as $img) {
            $filepath = UPLOADS_PATH . $img['image_path'];
            if (file_exists($filepath)) unlink($filepath);
        }
        $db->prepare("DELETE FROM product_images WHERE product_id = ?")->execute([$id]);
        $db->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);
        $message = "Product deleted successfully!";
        header("Location: products.php?deleted=1");
        exit();
    } catch (Exception $e) {
        $error = "Delete failed: " . $e->getMessage();
    }
}

// Handle add/edit
$editProduct = null;
if (isset($_GET['edit'])) {
    $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editProduct = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    
    // Check for duplicate name when adding new product
    if (!$editProduct) {
        $checkStmt = $db->prepare("SELECT COUNT(*) FROM products WHERE name = ?");
        $checkStmt->execute([$name]);
        $exists = $checkStmt->fetchColumn();
        if ($exists > 0) {
            $error = "Product with name '" . $name . "' already exists!";
        }
    }
    
    if (empty($error)) {
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $name), '-'));
        $category_id = (int)$_POST['category_id'];
        $brand = $_POST['brand'];
        $short_desc = $_POST['short_desc'];
        $description = $_POST['description'];
        $price = (float)$_POST['price'];
        $original_price = (float)($_POST['original_price'] ?? 0);
        $featured = isset($_POST['featured']) ? 1 : 0;
        $status = $_POST['status'];
        $colors = json_encode(array_filter(explode(',', $_POST['colors'] ?? '')));
        $features = json_encode(array_filter(explode("\n", $_POST['features'] ?? '')));
        
        try {
            if ($editProduct) {
                $stmt = $db->prepare("UPDATE products SET name=?, slug=?, category_id=?, brand=?, short_desc=?, description=?, price=?, original_price=?, featured=?, status=?, colors=?, features=? WHERE id=?");
                $stmt->execute([$name, $slug, $category_id, $brand, $short_desc, $description, $price, $original_price, $featured, $status, $colors, $features, $editProduct['id']]);
                $productId = $editProduct['id'];
                $message = "Product updated successfully!";
            } else {
                $stmt = $db->prepare("INSERT INTO products (name, slug, category_id, brand, short_desc, description, price, original_price, featured, status, colors, features) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->execute([$name, $slug, $category_id, $brand, $short_desc, $description, $price, $original_price, $featured, $status, $colors, $features]);
                $productId = $db->lastInsertId();
                $message = "Product added successfully!";
            }
            
            // Handle single product image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0 && is_uploaded_file($_FILES['image']['tmp_name'])) {
                if ($editProduct) {
                    $oldImgs = $db->prepare("SELECT image_path FROM product_images WHERE product_id = ?");
                    $oldImgs->execute([$productId]);
                    foreach ($oldImgs->fetchAll() as $old) {
                        $oldPath = UPLOADS_PATH . $old['image_path'];
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                    $db->prepare("DELETE FROM product_images WHERE product_id = ?")->execute([$productId]);
                }
                
                $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                
                if (in_array($ext, $allowed)) {
                    $newName = time() . '_' . uniqid() . '.' . $ext;
                    $dest = UPLOADS_PATH . $newName;
                    
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                        $stmt = $db->prepare("INSERT INTO product_images (product_id, image_path, frame_order, is_main) VALUES (?, ?, 0, 1)");
                        $stmt->execute([$productId, $newName]);
                        $message = ($editProduct ? "Product updated" : "Product added") . " with image!";
                    } else {
                        $error = "Failed to upload image.";
                    }
                } else {
                    $error = "Invalid file type. Allowed: JPG, PNG, WEBP, GIF";
                }
            }
            
            if (empty($error)) {
                header("Location: products.php?success=1");
                exit();
            }
            
        } catch (Exception $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}

// Get products - GROUP BY to ensure no duplicates
$products = $db->query("
    SELECT p.*, c.name as cat_name 
    FROM products p 
    LEFT JOIN categories c ON c.id = p.category_id 
    GROUP BY p.id 
    ORDER BY p.created_at DESC
")->fetchAll();

$categories = $db->query("SELECT * FROM categories ORDER BY name")->fetchAll();

$page_title = $editProduct ? 'Edit Product' : 'Products';
include 'layout_head.php';
?>

<style>
    .image-preview { margin-top: 1rem; padding: 1rem; background: #f8f9fa; border-radius: 8px; text-align: center; }
    .image-preview img { max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .info-box { background: #e8f4f8; border-left: 4px solid #17a2b8; padding: 1rem; margin: 1rem 0; border-radius: 8px; }
    .info-box i { color: #17a2b8; margin-right: 0.5rem; }
    .product-count { background: #28a745; color: white; padding: 2px 8px; border-radius: 20px; font-size: 0.75rem; margin-left: 0.5rem; }
</style>

<?php if ($message): ?>
    <div class="success"><i class="fas fa-check-circle"></i> <?= $message ?></div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="error"><i class="fas fa-exclamation-triangle"></i> <?= $error ?></div>
<?php endif; ?>

<!-- Add/Edit Product Form -->
<div class="card">
    <h3><?= $editProduct ? '✏️ Edit Product' : '➕ Add New Product' ?></h3>
    <form method="POST" enctype="multipart/form-data">
        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;">
            <div class="form-group">
                <label><i class="fas fa-tag"></i> Product Name *</label>
                <input type="text" name="name" required value="<?= $editProduct ? sanitize($editProduct['name']) : '' ?>" placeholder="e.g., Premium Camera X100">
            </div>
            <div class="form-group">
                <label><i class="fas fa-building"></i> Brand</label>
                <input type="text" name="brand" value="<?= $editProduct ? sanitize($editProduct['brand']) : '' ?>" placeholder="e.g., Sony, Nikon, Apple">
            </div>
            <div class="form-group">
                <label><i class="fas fa-folder"></i> Category *</label>
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $editProduct && $editProduct['category_id'] == $c['id'] ? 'selected' : '' ?>><?= sanitize($c['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label><i class="fas fa-rupee-sign"></i> Price (₹) *</label>
                <input type="number" step="0.01" name="price" required value="<?= $editProduct ? $editProduct['price'] : '' ?>" placeholder="e.g., 29999">
            </div>
            <div class="form-group">
                <label><i class="fas fa-tag"></i> Original Price (₹)</label>
                <input type="number" step="0.01" name="original_price" value="<?= $editProduct ? $editProduct['original_price'] : '' ?>" placeholder="e.g., 39999">
            </div>
            <div class="form-group">
                <label><i class="fas fa-toggle-on"></i> Status</label>
                <select name="status">
                    <option value="active" <?= $editProduct && $editProduct['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= $editProduct && $editProduct['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label><i class="fas fa-align-left"></i> Short Description</label>
            <input type="text" name="short_desc" value="<?= $editProduct ? sanitize($editProduct['short_desc']) : '' ?>" placeholder="Brief description shown on product card">
        </div>
        
        <div class="form-group">
            <label><i class="fas fa-file-alt"></i> Full Description</label>
            <textarea name="description" rows="4" placeholder="Detailed product description..."><?= $editProduct ? sanitize($editProduct['description']) : '' ?></textarea>
        </div>
        
        <div class="form-group">
            <label><i class="fas fa-palette"></i> Colors (comma separated - hex codes)</label>
            <input type="text" name="colors" placeholder="#1a1a2e,#e94560,#c9a84c" value="<?= $editProduct ? implode(',', json_decode($editProduct['colors'] ?? '[]', true)) : '' ?>">
            <small>Example: #FF0000,#00FF00,#0000FF</small>
        </div>
        
        <div class="form-group">
            <label><i class="fas fa-list-check"></i> Features (one per line)</label>
            <textarea name="features" rows="3" placeholder="Premium quality&#10;Free shipping&#10;1 year warranty"><?= $editProduct ? implode("\n", json_decode($editProduct['features'] ?? '[]', true)) : '' ?></textarea>
        </div>
        
        <div class="form-group">
            <label><i class="fas fa-image"></i> Product Image (PNG/JPG - single image for 360° rotation)</label>
            <input type="file" name="image" accept="image/png,image/jpeg,image/jpg,image/webp" id="productImageInput">
            
            <?php 
            $currentImage = null;
            if ($editProduct) {
                $imgStmt = $db->prepare("SELECT image_path FROM product_images WHERE product_id = ? AND is_main = 1 LIMIT 1");
                $imgStmt->execute([$editProduct['id']]);
                $currentImage = $imgStmt->fetch();
            }
            ?>
            
            <?php if ($currentImage): ?>
            <div class="image-preview" id="currentImagePreview">
                <strong>Current Image:</strong><br>
                <img src="<?= UPLOADS_URL . $currentImage['image_path'] ?>" alt="Current product image">
                <p><small>This image will be replaced if you upload a new one.</small></p>
            </div>
            <?php endif; ?>
            
            <div class="image-preview" id="newImagePreview" style="display:none;">
                <strong>New Image Preview:</strong><br>
                <img id="previewImg" src="" alt="Preview">
            </div>
            
            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <strong>How 360° Rotation Works:</strong><br>
                • Simply upload <strong>ONE image</strong> of your product<br>
                • The system creates a smooth 360° turntable rotation effect<br>
                • Users can drag left/right to see product from all angles<br>
                • PNG with transparent background works best for professional look
            </div>
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="featured" value="1" <?= $editProduct && $editProduct['featured'] ? 'checked' : '' ?>>
                <i class="fas fa-star" style="color: #ffc107;"></i> Featured Product
            </label>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> <?= $editProduct ? 'Update Product' : 'Add Product' ?>
        </button>
        <?php if ($editProduct): ?>
            <a href="products.php" class="btn" style="margin-left:0.5rem;">
                <i class="fas fa-times"></i> Cancel
            </a>
        <?php endif; ?>
    </form>
</div>

<!-- Products List -->
<div class="card">
    <h3><i class="fas fa-boxes"></i> All Products <span class="product-count"><?= count($products) ?> total</span></h3>
    <?php if ($products): ?>
    <div style="overflow-x: auto;">
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>360° View</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $p): 
                    $imgStmt = $db->prepare("SELECT image_path FROM product_images WHERE product_id = ? AND is_main = 1 LIMIT 1");
                    $imgStmt->execute([$p['id']]);
                    $productImg = $imgStmt->fetch();
                ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td>
                        <?php if ($productImg): ?>
                            <img src="<?= UPLOADS_URL . $productImg['image_path'] ?>" style="width:50px;height:50px;object-fit:cover;border-radius:8px;">
                        <?php else: ?>
                            <div style="width:50px;height:50px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-image" style="color:#ccc;"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= sanitize($p['name']) ?></strong><br><small style="color:#666;"><?= sanitize($p['brand']) ?></small></td>
                    <td><?= sanitize($p['cat_name'] ?? 'Uncategorized') ?></td>
                    <td>
                        <strong>₹<?= number_format($p['price']) ?></strong>
                        <?php if ($p['original_price'] > 0): ?>
                            <br><small style="text-decoration:line-through;color:#999;">₹<?= number_format($p['original_price']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($productImg): ?>
                            <span style="background:#28a745; color:white; padding:4px 10px; border-radius:20px; font-size:0.7rem;">
                                <i class="fas fa-sync-alt"></i> 360° Ready
                            </span>
                        <?php else: ?>
                            <span style="background:#ffc107; color:#333; padding:4px 10px; border-radius:20px; font-size:0.7rem;">
                                <i class="fas fa-exclamation-triangle"></i> No Image
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span style="background:<?= $p['status'] == 'active' ? '#28a745' : '#dc3545' ?>; color:white; padding:2px 8px; border-radius:20px; font-size:0.7rem;">
                            <?= $p['status'] ?>
                        </span>
                    </td>
                    <td>
                        <a href="products.php?edit=<?= $p['id'] ?>" class="btn btn-edit" style="padding:4px 10px; font-size:0.75rem;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="products.php?delete=<?= $p['id'] ?>" class="btn btn-delete" style="padding:4px 10px; font-size:0.75rem;" onclick="return confirm('Delete this product?')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p>No products yet. Add your first product above.</p>
    <?php endif; ?>
</div>

<script>
var imageInput = document.getElementById('productImageInput');
var newPreviewDiv = document.getElementById('newImagePreview');
var previewImg = document.getElementById('previewImg');

if (imageInput) {
    imageInput.addEventListener('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                previewImg.src = event.target.result;
                newPreviewDiv.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            newPreviewDiv.style.display = 'none';
        }
    });
}
</script>

<?php include 'layout_foot.php'; ?>