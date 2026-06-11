<?php

session_start();

require_once __DIR__ . '/../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: ../');
    exit;
}

/*
|--------------------------------------------------------------------------
| CEK LOGIN
|--------------------------------------------------------------------------
*/
if (
    empty($_SESSION['logged_in']) ||
    empty($_SESSION['user_id'])
) {

    $_SESSION['error'] =
        'Silakan login terlebih dahulu';

    header('Location: ../login.php');
    exit;
}

$userId  = (int) $_SESSION['user_id'];
$postId  = (int) ($_POST['post_id'] ?? 0);
$commentId = (int) ($_POST['comment_id'] ?? 0);
$comment = trim($_POST['comment'] ?? '');

/*
|--------------------------------------------------------------------------
| VALIDASI
|--------------------------------------------------------------------------
*/
if ($postId <= 0) {

    $_SESSION['error'] =
        'Postingan tidak ditemukan';

    header('Location: ../');
    exit;
}

if ($comment === '') {

    $_SESSION['error'] =
        'Komentar tidak boleh kosong';

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (mb_strlen($comment) < 3) {

    $_SESSION['error'] =
        'Komentar minimal 3 karakter';

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

/*
|--------------------------------------------------------------------------
| CEK POST
|--------------------------------------------------------------------------
*/
$postQuery = mysqli_query($conn, "
    SELECT
        id,
        slug
    FROM post
    WHERE id = $postId
    LIMIT 1
");

if (!$postQuery || mysqli_num_rows($postQuery) == 0) {

    $_SESSION['error'] =
        'Postingan tidak ditemukan';

    header('Location: ../');
    exit;
}

$post = mysqli_fetch_assoc($postQuery);

/*
|--------------------------------------------------------------------------
| ESCAPE KOMENTAR
|--------------------------------------------------------------------------
*/
$commentEsc = mysqli_real_escape_string(
    $conn,
    $comment
);

/*
|--------------------------------------------------------------------------
| SIMPAN REPLY
|--------------------------------------------------------------------------
*/
if ($commentId > 0) {

    $insertReply = mysqli_query($conn, "
        INSERT INTO post_comment_reply (
            comment_id,
            user_id,
            reply,
            status,
            created_at
        )
        VALUES (
            $commentId,
            $userId,
            '$commentEsc',
            'approved',
            NOW()
        )
    ");

    if (!$insertReply) {

        $_SESSION['error'] =
            'Gagal mengirim balasan';

        header(
            'Location: ../artikel-detail.php?slug=' .
                $post['slug']
        );
        exit;
    }

    $_SESSION['success'] =
        'Balasan berhasil ditambahkan';

    header(
        'Location: ../artikel-detail.php?slug=' .
            $post['slug']
    );
    exit;
}

/*
|--------------------------------------------------------------------------
| SIMPAN KOMENTAR UTAMA
|--------------------------------------------------------------------------
*/
$insertComment = mysqli_query($conn, "
    INSERT INTO post_comments (
        post_id,
        user_id,
        comment,
        status,
        created_at
    )
    VALUES (
        $postId,
        $userId,
        '$commentEsc',
        'approved',
        NOW()
    )
");

if (!$insertComment) {

    $_SESSION['error'] =
        'Gagal mengirim komentar';

    header(
        'Location: ../artikel-detail.php?slug=' .
            $post['slug']
    );
    exit;
}

/*
|--------------------------------------------------------------------------
| SUCCESS
|--------------------------------------------------------------------------
*/
$_SESSION['success'] =
    'Komentar berhasil ditambahkan';

header(
    'Location: ../artikel-detail.php?slug=' .
        $post['slug']
);
exit;
