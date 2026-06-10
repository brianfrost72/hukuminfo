<?php

require_once __DIR__ . '/../../../koneksi.php';

$id = (int)$_GET['id'];

$query = mysqli_query(
    $conn,
    "
    SELECT
        pc.*,
        p.post_title,
        u.email,
        pp.full_name,
        pp.gender,
        pp.photo_profile
    FROM post_comments pc
    INNER JOIN post p
        ON p.id = pc.post_id
    INNER JOIN users u
        ON u.id = pc.user_id
    LEFT JOIN public_profile pp
        ON pp.user_id = u.id
    WHERE pc.id='$id'
    LIMIT 1
    "
);

$data = mysqli_fetch_assoc($query);

echo '<h5>' . $data['post_title'] . '</h5>';
echo '<hr>';
echo nl2br(htmlspecialchars($data['comment']));
