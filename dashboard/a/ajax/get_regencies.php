<?php

require_once __DIR__ . "/../../koneksi.php";

$province_id = (int)$_GET['province_id'];

$data = [];

$query = mysqli_query($conn,"
    SELECT id,name
    FROM regencies
    WHERE province_id = '$province_id'
    ORDER BY name ASC
");

while($row = mysqli_fetch_assoc($query))
{
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);