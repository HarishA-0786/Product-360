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
        $db->prepare("UPDATE products SET category_id = NULL WHERE category_id = ?")->execute([$id]);
        $db->prepare("DELETE FROM categories WHERE id = ?")->execute([$id]);
        $message = "Category deleted successfully!";
    } catch (Exception $e) {
        $error = "Delete failed: " . $e->getMessage();
    }
}

// Handle add/edit
$editCat = null;
if (isset($_GET['edit'])) {
    $stmt = $db->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editCat = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $name), '-'));
    $description = $_POST['description'];
    $status = (int)($_POST['status'] ?? 1);
    
    try {
        if ($editCat) {
            $stmt = $db->prepare("UPDATE categories SET name=?, slug=?, description=?, status=? WHERE id=?");
            $stmt->execute([$name, $slug, $description, $status, $editCat['id']]);
            $message = "Category updated!";
        } else {
            $stmt = $db->prepare("INSERT INTO categories (name, slug, description, status) VALUES (?,?,?,?)");
            $stmt->execute([$name, $slug, $description, $status]);
            $message = "Category added!";
        }
        header("Location: categories.php?success=1");
        exit();
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}

$categories = $db->query("SELECT * FROM categories ORDER BY name")->fetchAll();

$page_title = $editCat ? 'Edit Category' : 'Categories';
include 'layout_head.php';
?>

<?php if ($message): ?>
    <div class="success"><?= $message ?></div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>

<div class="card">
    <h3><?= $editCat ? 'Edit Category' : 'Add New Category' ?></h3>
    <form method="POST">
        <div class="form-group">
            <label>Category Name *</label>
            <input type="text" name="name" required value="<?= $editCat ? sanitize($editCat['name']) : '' ?>">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="3"><?= $editCat ? sanitize($editCat['description']) : '' ?></textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="1" <?= $editCat && $editCat['status'] == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= $editCat && $editCat['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?= $editCat ? 'Update' : 'Add Category' ?></button>
        <?php if ($editCat): ?>
            <a href="categories.php" class="btn" style="margin-left:0.5rem;">Cancel</a>
        <?php endif; ?>
    </form>
</div>

<div class="card">
    <h3>All Categories</h3>
    <?php if ($categories): ?>
    <table>
        <thead>
            <tr><th>ID</th><th>Name</th><th>Slug</th><th>Description</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= sanitize($c['name']) ?></td>
                <td><?= $c['slug'] ?></td>
                <td><?= sanitize($c['description']) ?></td>
                <td><?= $c['status'] ? 'Active' : 'Inactive' ?></td>
                <td>>
                    <a href="categories.php?edit=<?= $c['id'] ?>" class="btn btn-edit"><i class="fas fa-edit"></i> Edit</a>
                    <a href="categories.php?delete=<?= $c['id'] ?>" class="btn btn-delete" onclick="return confirm('Delete this category?')"><i class="fas fa-trash"></i> Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No categories yet. Add your first category above.</p>
    <?php endif; ?>
</div>

<?php include 'layout_foot.php'; ?>