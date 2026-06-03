<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'product360_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Site Configuration
define('SITE_NAME', 'Luxury Vision');
define('SITE_TAGLINE', '360° Premium Product Experience');
define('SITE_URL', 'http://localhost/project360/');
define('ADMIN_URL', SITE_URL . 'admin');
define('UPLOADS_URL', SITE_URL . 'uploads/products/');
define('UPLOADS_PATH', $_SERVER['DOCUMENT_ROOT'] . '/project360/uploads/products/');

// Admin credentials (change these)
define('ADMIN_EMAIL', 'admin@luxuryvision.com');
define('ADMIN_PASSWORD_HASH', password_hash('Admin@123', PASSWORD_DEFAULT));

// Create uploads directory if not exists
if (!file_exists(UPLOADS_PATH)) {
    mkdir(UPLOADS_PATH, 0777, true);
}

// Database connection function
function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }
    return $pdo;
}

// Helper functions
function sanitize($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect(ADMIN_URL . '/login.php');
    }
}
?>