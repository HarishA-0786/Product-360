<?php
require_once __DIR__ . '/db.php';

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
}

function getCategories($pdo) {
    $stmt = $pdo->query("SELECT * FROM categories WHERE status = 1 ORDER BY name");
    return $stmt->fetchAll();
}

function getProducts($pdo, $limit = null, $category = null) {
    $sql = "SELECT p.*, c.name as category_name FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.status = 1";
    if ($category) {
        $sql .= " AND c.slug = :category";
    }
    $sql .= " ORDER BY p.created_at DESC";
    if ($limit) {
        $sql .= " LIMIT " . intval($limit);
    }
    $stmt = $pdo->prepare($sql);
    if ($category) {
        $stmt->bindParam(':category', $category);
    }
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProductBySlug($pdo, $slug) {
    $stmt = $pdo->prepare("SELECT p.*, c.name as category_name, c.slug as category_slug 
                           FROM products p 
                           LEFT JOIN categories c ON p.category_id = c.id 
                           WHERE p.slug = :slug AND p.status = 1");
    $stmt->execute(['slug' => $slug]);
    return $stmt->fetch();
}

function getProductColors($pdo, $product_id) {
    $stmt = $pdo->prepare("SELECT * FROM product_colors WHERE product_id = :product_id ORDER BY sort_order");
    $stmt->execute(['product_id' => $product_id]);
    return $stmt->fetchAll();
}

function getProductSpecs($pdo, $product_id) {
    $stmt = $pdo->prepare("SELECT * FROM product_specs WHERE product_id = :product_id");
    $stmt->execute(['product_id' => $product_id]);
    return $stmt->fetchAll();
}

function uploadFile($file, $target_dir, $allowed_types = ['jpg', 'jpeg', 'png', 'webp']) {
    $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
    $target_file = $target_dir . $filename;
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (!in_array($extension, $allowed_types)) {
        return ['error' => 'File type not allowed'];
    }
    
    if ($file['size'] > 5000000) {
        return ['error' => 'File too large (max 5MB)'];
    }
    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return ['success' => true, 'filename' => $filename];
    }
    return ['error' => 'Upload failed'];
}

function formatPrice($price) {
    return '$' . number_format($price, 2);
}

function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_username']);
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}
?>