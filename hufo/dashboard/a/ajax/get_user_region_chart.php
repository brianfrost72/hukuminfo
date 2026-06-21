<?php

require_once __DIR__ . "/../../koneksi.php";

$province_id = (int)($_GET['province_id'] ?? 0);
$regency_id  = (int)($_GET['regency_id'] ?? 0);

$where = "";

if ($province_id > 0) {
    $where .= " AND pp.provinces_id = '$province_id' ";
}

if ($regency_id > 0) {
    $where .= " AND pp.regencies_id = '$regency_id' ";
}

$query = mysqli_query($conn, "
    SELECT
        r.name,
        COUNT(*) total
    FROM public_profile pp

    INNER JOIN users u
        ON u.id = pp.user_id

    INNER JOIN regencies r
        ON r.id = pp.regencies_id

    WHERE u.user_type='public'

    $where

    GROUP BY r.id
    ORDER BY total DESC
");

$labels = [];
$values = [];

while ($row = mysqli_fetch_assoc($query)) {
    $labels[] = $row['name'];
    $values[] = (int)$row['total'];
}

echo json_encode([
    'labels' => $labels,
    'values' => $values
]);
