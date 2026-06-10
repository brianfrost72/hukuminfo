<?php

session_start();
require_once __DIR__ . "/../../koneksi.php";

$user_id = (int)($_POST['user_id'] ?? 0);
$status  = (int)($_POST['status'] ?? 0);

if (!$user_id) {
    echo json_encode([
        'success' => false,
        'message' => 'User tidak ditemukan'
    ]);
    exit;
}

mysqli_begin_transaction($conn);

try {

    mysqli_query($conn, "
        UPDATE public_profile
        SET status = '$status'
        WHERE user_id = '$user_id'
    ");

    $account_status = ($status == 1)
        ? 'Active'
        : 'Inactive';

    mysqli_query($conn, "
        UPDATE users
        SET account_status = '$account_status'
        WHERE id = '$user_id'
    ");

    mysqli_commit($conn);

    echo json_encode([
        'success' => true,
        'status' => $status
    ]);
} catch (Exception $e) {

    mysqli_rollback($conn);

    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
