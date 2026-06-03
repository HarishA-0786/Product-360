<?php
require_once __DIR__ . '/config.php';

function verifyAdminLogin($email, $password) {
    // For demo - check against defined credentials
    if ($email === ADMIN_EMAIL && password_verify($password, ADMIN_PASSWORD_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        $_SESSION['admin_login_time'] = time();
        return true;
    }
    return false;
}

function adminLogout() {
    session_destroy();
    redirect(ADMIN_URL . '/login.php');
}

function checkSessionTimeout() {
    $timeout = 3600; // 1 hour
    if (isset($_SESSION['admin_login_time']) && (time() - $_SESSION['admin_login_time'] > $timeout)) {
        adminLogout();
    }
    $_SESSION['admin_login_time'] = time();
}
?>