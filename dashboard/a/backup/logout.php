<?php
session_start();
require_once "../koneksi.php";

/* cek apakah user login */
if (isset($_SESSION['user_id']) && isset($conn)) {

    $uid = (int) $_SESSION['user_id'];

    /* update status user */
    $stmt = $conn->prepare("
        UPDATE users 
        SET 
            is_online = 0,
            last_logout = NOW()
        WHERE id = ?
    ");
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $stmt->close();
}

/* hapus semua session */
$_SESSION = [];
session_unset();
session_destroy();

/* redirect */
header("Location: ../../index.php");
exit;
