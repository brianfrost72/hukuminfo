<?php
session_start();

require_once __DIR__ . '/../koneksi.php';

// Update status user sebelum logout
if (!empty($_SESSION['user_id'])) {

    $user_id = (int) $_SESSION['user_id'];

    mysqli_query(
        $conn,
        "UPDATE users
         SET
            is_online = 0,
            logout_at = NOW()
         WHERE id = '$user_id'"
    );
}

// Hapus semua data session
$_SESSION = [];

// Hapus cookie session PHP
if (ini_get('session.use_cookies')) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destroy session
session_destroy();

// Cegah browser menyimpan halaman login/dashboard di cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");

// Redirect ke homepage
header("Location: /hukuminfo");
exit;
