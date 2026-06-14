<?php
session_start();

require_once __DIR__ . '/../../../PHPMailer/comment_hidden_email.php';

require_once __DIR__ . '/../../../koneksi.php';

if (
    !isset($_POST['comment_id']) ||
    !is_numeric($_POST['comment_id'])
) {

    header(
        "Location: ../manage_comments.php?hidden=failed"
    );

    exit;
}

$commentId = (int) $_POST['comment_id'];

$reasonStatus =
    trim($_POST['reason_status']);

$hideDescription =
    trim($_POST['hide_description']);

$query = mysqli_query(
    $conn,
    "
    SELECT
        pc.id,
        pc.comment,

        u.email,

        pp.full_name

    FROM post_comments pc

    INNER JOIN users u
        ON u.id = pc.user_id

    LEFT JOIN public_profile pp
        ON pp.user_id = u.id

    WHERE pc.id='$commentId'
    "
);

$data =
    mysqli_fetch_assoc($query);

$email =
    $data['email'];

$fullName =
    $data['full_name'];

$comment =
    $data['comment'];

mysqli_query(
    $conn,
    "
    UPDATE post_comments
    SET
        status='rejected',
        reason_status='" . mysqli_real_escape_string($conn, $reasonStatus) . "',
        hide_description='" . mysqli_real_escape_string($conn, $hideDescription) . "'
    WHERE id='$commentId'
    "
);

if (
    sendCommentHiddenEmail(
        $email,
        $fullName,
        $comment,
        $reasonStatus,
        $hideDescription
    )
) {

    header(
        "Location: ../manage_comments.php?hidden=success"
    );
} else {

    header(
        "Location: ../manage_comments.php?hidden=failed"
    );
}

exit;
