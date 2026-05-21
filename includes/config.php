<?php
// Site configuration
define('SITE_NAME', 'VIZION360');
define('SITE_URL', 'http://localhost/project/');
define('ADMIN_URL', SITE_URL . 'admin/');
define('UPLOAD_PATH', dirname(__DIR__) . '/uploads/');
define('PRODUCT_IMG_PATH', UPLOAD_PATH . 'products/');
define('THUMBNAIL_PATH', PRODUCT_IMG_PATH . 'thumbnails/');
define('FRAMES360_PATH', UPLOAD_PATH . 'frames360/');

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>