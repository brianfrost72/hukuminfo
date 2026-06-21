<?php

require_once __DIR__ . "/../../koneksi.php";

$ids = $_POST['ids'] ?? [];
$status = (int)($_POST['status'] ?? 0);

if (empty($ids)) {
    echo json_encode([
        'success' => false
    ]);
    exit;
}

$ids = array_map('intval', $ids);

$idList = implode(',', $ids);

mysqli_query($conn, "
    UPDATE public_profile
    SET status = '$status'
    WHERE user_id IN ($idList)
");

$account_status =
    $status == 1
    ? 'Active'
    : 'Inactive';

mysqli_query($conn, "
    UPDATE users
    SET account_status = '$account_status'
    WHERE id IN ($idList)
");

echo json_encode([
    'success' => true
]);
