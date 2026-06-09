<?php
session_start();

require_once __DIR__ . '/../../../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: ../manage_post");
    exit;
}

$post_id = (int) $_GET['id'];

$current_user_id = (int) $_SESSION['user_id'];
$current_role_id = (int) $_SESSION['role_id'];

$isAdmin = in_array($current_role_id, [1, 2]);

/*
|--------------------------------------------------------------------------
| AMBIL PEMILIK POST
|--------------------------------------------------------------------------
*/
$post = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "
        SELECT
            id,
            user_id,
            post_title
        FROM post
        WHERE id = '{$post_id}'
        LIMIT 1
        "
    )
);

if (!$post) {
    header("Location: ../manage_post");
    exit;
}

/*
|--------------------------------------------------------------------------
| PROTEKSI HAK AKSES
|--------------------------------------------------------------------------
|
| Role 1 & 2 = boleh hapus semua
| Selain itu hanya pemilik post
|
*/
if (
    !$isAdmin &&
    $post['user_id'] != $current_user_id
) {
    $_SESSION['toast_type'] = 'error';
    $_SESSION['toast_message'] = 'Anda tidak memiliki hak menghapus postingan ini';

    header("Location: ../manage_post");
    exit;
}

/*
|--------------------------------------------------------------------------
| HAPUS RELASI TERLEBIH DAHULU
|--------------------------------------------------------------------------
*/
mysqli_query(
    $conn,
    "DELETE FROM post_comments WHERE post_id = '{$post_id}'"
);

mysqli_query(
    $conn,
    "DELETE FROM post_likes WHERE post_id = '{$post_id}'"
);

mysqli_query(
    $conn,
    "DELETE FROM post_bookmarks WHERE post_id = '{$post_id}'"
);

mysqli_query(
    $conn,
    "DELETE FROM post_views WHERE post_id = '{$post_id}'"
);

mysqli_query(
    $conn,
    "DELETE FROM post_tags WHERE post_id = '{$post_id}'"
);

/*
|--------------------------------------------------------------------------
| HAPUS POST
|--------------------------------------------------------------------------
*/
$delete = mysqli_query(
    $conn,
    "DELETE FROM post WHERE id = '{$post_id}' LIMIT 1"
);

if ($delete) {

    $_SESSION['toast_type'] = 'success';
    $_SESSION['toast_message'] = 'Postingan berhasil dihapus';

} else {

    $_SESSION['toast_type'] = 'error';
    $_SESSION['toast_message'] = 'Postingan gagal dihapus';

}

header("Location: ../manage_post");
exit;