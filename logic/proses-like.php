<?php

session_start();
require_once __DIR__ . '/../koneksi.php';

header('Content-Type: application/json');

if(empty($_SESSION['user_id'])){
    echo json_encode([
        'status' => 'login'
    ]);
    exit;
}

$userId = (int)$_SESSION['user_id'];
$postId = (int)$_POST['post_id'];

$check = mysqli_query($conn,"
    SELECT id
    FROM post_likes
    WHERE post_id = $postId
    AND user_id = $userId
");

if(mysqli_num_rows($check)>0){

    mysqli_query($conn,"
        DELETE FROM post_likes
        WHERE post_id = $postId
        AND user_id = $userId
    ");

    $liked = false;

}else{

    mysqli_query($conn,"
        INSERT INTO post_likes(
            post_id,
            user_id
        )
        VALUES(
            $postId,
            $userId
        )
    ");

    $liked = true;
}

$count = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT COUNT(*) total
        FROM post_likes
        WHERE post_id = $postId
    ")
);

echo json_encode([
    'liked'=>$liked,
    'count'=>$count['total']
]);