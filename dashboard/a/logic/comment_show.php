<?php

require_once __DIR__ . '/../../../koneksi.php';

$id = (int)$_GET['id'];

mysqli_query(
    $conn,
    "UPDATE post_comments
     SET status='approved'
     WHERE id='$id'"
);

header("Location: manage_comments.php");
exit;