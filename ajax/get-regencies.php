<?php

require_once __DIR__ . "/../koneksi.php";

$province_id = (int) $_POST['province_id'];

$query = mysqli_query(
    $conn,
    "SELECT id,name
     FROM regencies
     WHERE province_id = '$province_id'
     ORDER BY name ASC"
);

echo '<option value="">Pilih Kabupaten</option>';

while($row = mysqli_fetch_assoc($query)) {

    echo '<option value="'.$row['id'].'">'
        .$row['name'].
    '</option>';
}