<?php
session_start();

require_once 'koneksi.php';

function tanggalIndonesia($datetime)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $timestamp = strtotime($datetime);

    return date('d', $timestamp) . ' ' .
        $bulan[(int)date('n', $timestamp)] . ' ' .
        date('Y', $timestamp);
}

/*
|--------------------------------------------------------------------------
| GET DATA
|--------------------------------------------------------------------------
*/
$slug = mysqli_real_escape_string($conn, $_GET['slug'] ?? '');

$postQuery = mysqli_query($conn, "
    SELECT
    p.*,
    pc.name_category,
    pc.slug AS category_slug,

    u.id AS author_id,
    u.user_type,

    up.full_name,
    up.photo_profile,
    up.gender,
    up.slug AS author_slug

    FROM post p

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    LEFT JOIN users u
        ON u.id = p.user_id

    LEFT JOIN user_profile up
        ON up.user_id = u.id

    WHERE p.slug = '$slug'
    AND p.status = 'publish'

    LIMIT 1
");

if (!$postQuery || mysqli_num_rows($postQuery) == 0) {
    header("Location: 404.php");
    exit;
}

$post = mysqli_fetch_assoc($postQuery);

/*
|--------------------------------------------------------------------------
| RECORD VIEW
|--------------------------------------------------------------------------
*/
$userId = !empty($_SESSION['user_id'])
    ? (int)$_SESSION['user_id']
    : 0;

$ipAddress =
    mysqli_real_escape_string(
        $conn,
        $_SERVER['REMOTE_ADDR'] ?? ''
    );

$userAgent =
    mysqli_real_escape_string(
        $conn,
        $_SERVER['HTTP_USER_AGENT'] ?? ''
    );

$postId = (int)$post['id'];

// ANTI SPAM VIEW
$viewCheck = mysqli_query($conn, "
    SELECT id
    FROM post_views
    WHERE post_id = $postId
    AND ip_address = '$ipAddress'
    AND viewed_at >= DATE_SUB(NOW(), INTERVAL 1 HOUR)
    LIMIT 1
");

//SIMPAN VIEW
if (mysqli_num_rows($viewCheck) == 0) {

    mysqli_query($conn, "
        INSERT INTO post_views(
            post_id,
            user_id,
            ip_address,
            user_agent,
            viewed_at
        )
        VALUES(
            $postId,
            $userId,
            '$ipAddress',
            '$userAgent',
            NOW()
        )
    ");

    mysqli_query($conn, "
        UPDATE post
        SET total_views = total_views + 1
        WHERE id = $postId
    ");
}

/*
|--------------------------------------------------------------------------
| GET AUTHOR PHOTO
|--------------------------------------------------------------------------
*/

$defaultMale =
    'dashboard/assets/images/avatar/avatar-men.png';

$defaultFemale =
    'dashboard/assets/images/avatar/avatar-women.png';

$authorPhotoName = trim($post['photo_profile'] ?? '');

if (
    !empty($authorPhotoName) &&
    $authorPhotoName != 'avatar-men.png' &&
    $authorPhotoName != 'avatar-women.png'
) {

    $authorPhoto =
        'dashboard/assets/images/uploads/user_photos/' .
        $authorPhotoName;
} else {

    $authorPhoto =
        ($post['gender'] == 'Perempuan')
        ? $defaultFemale
        : $defaultMale;
}

/*
|--------------------------------------------------------------------------
| RANDOM PREV & NEXT POST
|--------------------------------------------------------------------------
*/

$randomPosts = mysqli_query($conn, "
    SELECT
        id,
        post_title,
        slug
    FROM post
    WHERE status = 'publish'
    AND id != $postId
    AND slug != '" . mysqli_real_escape_string($conn, $post['slug']) . "'
    ORDER BY RAND()
    LIMIT 2
");

$navPosts = [];

while ($row = mysqli_fetch_assoc($randomPosts)) {
    $navPosts[] = $row;
}

$prevPost = $navPosts[0] ?? null;
$nextPost = $navPosts[1] ?? null;

/*
|--------------------------------------------------------------------------
| HITUNG BOOKMARK
|--------------------------------------------------------------------------
*/
$bookmarkQuery = mysqli_query($conn, "
    SELECT COUNT(*) total
    FROM post_bookmarks
    WHERE post_id = $postId
");

$totalBookmarks = mysqli_fetch_assoc($bookmarkQuery)['total'];

/*
|--------------------------------------------------------------------------
| HITUNG LIKE
|--------------------------------------------------------------------------
*/
$likeQuery = mysqli_query($conn, "
    SELECT COUNT(*) total
    FROM post_likes
    WHERE post_id = $postId
");

$totalLikes = mysqli_fetch_assoc($likeQuery)['total'];

/*
|--------------------------------------------------------------------------
| STATUS LIKE & BOOKMARK
|--------------------------------------------------------------------------
*/
$isLiked = false;
$isBookmarked = false;

if (!empty($_SESSION['user_id'])) {

    $userId = (int)$_SESSION['user_id'];

    $likeCheck = mysqli_query($conn, "
        SELECT id
        FROM post_likes
        WHERE post_id = $postId
        AND user_id = $userId
        LIMIT 1
    ");

    $bookmarkCheck = mysqli_query($conn, "
        SELECT id
        FROM post_bookmarks
        WHERE post_id = $postId
        AND user_id = $userId
        LIMIT 1
    ");

    $isLiked = mysqli_num_rows($likeCheck) > 0;
    $isBookmarked = mysqli_num_rows($bookmarkCheck) > 0;
}
/*
|--------------------------------------------------------------------------
| HITUNG KOMENTAR & BALAS KOMENTAR
|--------------------------------------------------------------------------
*/
$commentQuery = mysqli_query($conn, "
    SELECT COUNT(*) total
    FROM post_comments
    WHERE post_id = $postId
    AND status = 'approved'
");

$totalComments = mysqli_fetch_assoc($commentQuery)['total'];

$replyQuery = mysqli_query($conn, "
    SELECT COUNT(*) total
    FROM post_comment_reply r
    INNER JOIN post_comments c
        ON c.id = r.comment_id
    WHERE c.post_id = $postId
    AND r.status = 'approved'
");

$totalReplies = mysqli_fetch_assoc($replyQuery)['total'];

$totalDiscussion = $totalComments + $totalReplies;

/*
|--------------------------------------------------------------------------
| GET KOMENTAR
|--------------------------------------------------------------------------
*/
$commentsQuery = mysqli_query($conn, "
    SELECT
        c.*,

        u.user_type,
        u.role_id,

        pp.full_name AS public_name,
        pp.gender AS public_gender,
        pp.photo_profile AS public_photo,

        up.full_name AS admin_name,
        up.gender AS admin_gender,
        up.photo_profile AS admin_photo,
        up.slug AS admin_slug,

        r.role_name

    FROM post_comments c

    INNER JOIN users u
        ON u.id = c.user_id

    LEFT JOIN public_profile pp
        ON pp.user_id = u.id

    LEFT JOIN user_profile up
        ON up.user_id = u.id

    LEFT JOIN roles r
        ON r.id = u.role_id

    WHERE c.post_id = $postId
    AND c.status = 'approved'

    ORDER BY c.created_at DESC
");

// AVATAR KOMENTAR
function getPublicAvatar($photo, $gender)
{
    if (!empty($photo)) {

        return 'dashboard/assets/images/uploads/public_photos/' . $photo;
    }

    return ($gender == 'Perempuan')
        ? 'dashboard/assets/images/avatar/avatar-women.png'
        : 'dashboard/assets/images/avatar/avatar-men.png';
}

/*
|--------------------------------------------------------------------------
| HITUNG VIEW
|--------------------------------------------------------------------------
*/
$postRefresh = mysqli_query($conn, "
    SELECT total_views
    FROM post
    WHERE id = $postId
    LIMIT 1
");

$postRefreshData = mysqli_fetch_assoc($postRefresh);

$totalViews = (int)$postRefreshData['total_views'];

function formatViews($views)
{
    if ($views >= 1000000) {
        return round($views / 1000000, 1) . 'M';
    }

    if ($views >= 1000) {
        return round($views / 1000, 1) . 'K';
    }

    return number_format($views);
}

/*
|--------------------------------------------------------------------------
| GET TAGS
|--------------------------------------------------------------------------
*/
$tagsQuery = mysqli_query($conn, "
    SELECT
        t.*
    FROM post_tags pt
    INNER JOIN tags t
        ON t.id = pt.tag_id
    WHERE pt.post_id = $postId
");

/*
|--------------------------------------------------------------------------
| AVATAR UNIVERSAL
|--------------------------------------------------------------------------
*/
function getUserAvatar($user)
{
    $defaultMale =
        'dashboard/assets/images/avatar/avatar-men.png';

    $defaultFemale =
        'dashboard/assets/images/avatar/avatar-women.png';

    if ($user['user_type'] == 'public') {

        $photo  = $user['public_photo'] ?? '';
        $gender = $user['public_gender'] ?? 'Laki-laki';

        if (
            !empty($photo) &&
            $photo != 'avatar-men.png' &&
            $photo != 'avatar-women.png'
        ) {
            return
                'dashboard/assets/images/uploads/public_photos/' .
                $photo;
        }

        return ($gender == 'Perempuan')
            ? $defaultFemale
            : $defaultMale;
    }

    $photo  = $user['admin_photo'] ?? '';
    $gender = $user['admin_gender'] ?? 'Laki-laki';

    if (
        !empty($photo) &&
        $photo != 'avatar-men.png' &&
        $photo != 'avatar-women.png'
    ) {
        return
            'dashboard/assets/images/uploads/user_photos/' .
            $photo;
    }

    return ($gender == 'Perempuan')
        ? $defaultFemale
        : $defaultMale;
}

/*
|--------------------------------------------------------------------------
| RELATED RANDOM POST
|--------------------------------------------------------------------------
*/

$currentSlug  = mysqli_real_escape_string($conn, $post['slug']);
$currentTitle = mysqli_real_escape_string($conn, $post['post_title']);

$relatedPostsQuery = mysqli_query($conn, "
    SELECT
        p.id,
        p.slug,
        p.post_title,
        p.post_image,
        p.created_at,

        up.full_name

    FROM post p

    LEFT JOIN user_profile up
        ON up.user_id = p.user_id

    WHERE p.status = 'publish'
    AND p.id != $postId
    AND p.slug != '$currentSlug'
    AND p.post_title != '$currentTitle'

    ORDER BY RAND()

    LIMIT 8
");

/*
|--------------------------------------------------------------------------
| SIDEBAR POST MIX
|--------------------------------------------------------------------------
*/

$postMixQuery = mysqli_query($conn, "
    SELECT
        p.id,
        p.slug,
        p.post_title,
        p.post_desc,
        p.post_image,
        p.created_at,
        pc.name_category,
        pc.slug AS category_slug,
        up.full_name

    FROM post p

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    LEFT JOIN user_profile up
        ON up.user_id = p.user_id

    WHERE p.status = 'publish'

    AND p.id != $postId
    AND p.slug != '$currentSlug'
    AND p.post_title != '$currentTitle'

    ORDER BY RAND()

    LIMIT 4
");

$postMix = [];

while ($row = mysqli_fetch_assoc($postMixQuery)) {
    $postMix[] = $row;
}

/*
|--------------------------------------------------------------------------
| SOCIAL MEDIA
|--------------------------------------------------------------------------
*/

$socialMediaQuery = mysqli_query($conn, "
    SELECT
        sm.account_name,
        sm.link_platform,
        ls.name_platform
    FROM social_media sm
    INNER JOIN list_socmed ls
        ON ls.id = sm.platform_id
    ORDER BY sm.id ASC
");

if (!$socialMediaQuery) {
    die(mysqli_error($conn));
}

/*
|--------------------------------------------------------------------------
| TAGS SIDEBAR
|--------------------------------------------------------------------------
*/

$sidebarTagsQuery = mysqli_query($conn, "
    SELECT
        id,
        tag_name,
        tag_slug
    FROM tags
    ORDER BY created_at DESC
");

$sidebarTags = [];

while ($row = mysqli_fetch_assoc($sidebarTagsQuery)) {
    $sidebarTags[] = $row;
}

$totalTagsSidebar = count($sidebarTags);

/*
|--------------------------------------------------------------------------
| CATEGORIES SIDEBAR
|--------------------------------------------------------------------------
*/

$sidebarCategoryQuery = mysqli_query($conn, "
    SELECT
        id,
        name_category,
        slug
    FROM post_category
    ORDER BY RAND()
");

$sidebarCategories = [];

while ($row = mysqli_fetch_assoc($sidebarCategoryQuery)) {
    $sidebarCategories[] = $row;
}

$totalCategoriesSidebar = count($sidebarCategories);

/*
|--------------------------------------------------------------------------
| RANDOM ADS
|--------------------------------------------------------------------------
*/

$adsQuery = mysqli_query($conn, "
    SELECT
        id,
        ad_title,
        ad_img,
        ad_link
    FROM ads
    ORDER BY RAND()
    LIMIT 1
");

$adsData = mysqli_fetch_assoc($adsQuery);

/*
|--------------------------------------------------------------------------
| SHARE
|--------------------------------------------------------------------------
*/
$currentUrl = urlencode(
    (isset($_SERVER['HTTPS']) ? 'https' : 'http')
        . '://' .
        $_SERVER['HTTP_HOST'] .
        $_SERVER['REQUEST_URI']
);

$shareTitle = urlencode($post['post_title']);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($post['post_title']); ?> &ndash; Hukuminfo.id | Media Informasi dan Edukasi Tentang Hukum </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    <meta name="theme-color" content="#030303">
    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <link href="./css/styles.css?537a1bbd0e5129401d28" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/v4-shims.min.css">

</head>

<body>
    <!-- loading -->
    <!-- loading -->
    <div class="loading-container">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <ul class="list-unstyled">
                <li>
                    <img src="images/placeholder/loading.png" alt="Alternate Text" height="100" />

                </li>
                <li>

                    <div class="spinner">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>

                    </div>

                </li>
                <li>
                    <p>Loading</p>
                </li>
            </ul>
        </div>
    </div>
    <!-- End loading -->

    <!-- header -->
    <header>
        <!-- Navbar  Top-->
        <div class="topbar d-none d-sm-block">
            <?php include 'includes/top-header.php'; ?>
        </div>
        <!-- End Navbar Top  -->
        <!-- navbar -->
        <!-- Navbar menu  -->
        <div class="navigation-wrap navigation-shadow bg-white">
            <?php include 'includes/navbar.php'; ?>
        </div>
        <!-- End Navbar menu  -->

        <!-- Navbar sidebar menu  -->
        <?php include 'includes/mobile_menu.php'; ?>
        <!-- End Navbar sidebar menu  -->
        <!-- end navbar -->
    </header>
    <!-- end header -->


    <section class="pb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- breaddcrumb -->
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="/" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> Beranda</a>
                        </li>
                        <li class="breadcrumbs__item breadcrumbs__item--current">
                            <?= $post['post_title']; ?>
                        </li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>
                <div class="col-md-8">
                    <!-- content article detail -->
                    <!-- Article Detail -->
                    <div class="wrap__article-detail">
                        <div class="wrap__article-detail-title">
                            <h1>
                                <?= $post['post_title']; ?>
                            </h1>
                            <h3>
                                <?= $post['post_sub_title']; ?>
                            </h3>
                        </div>
                        <hr>
                        <div class="wrap__article-detail-info">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">

                                <!-- Kiri -->
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <figure class="image-profile">
                                            <img src="<?= $authorPhoto; ?>"
                                                alt="<?= htmlspecialchars($post['full_name']); ?>">
                                        </figure>
                                    </li>

                                    <li class="list-inline-item">
                                        <span>Penulis :</span>

                                        <a href="redaksi=<?= urlencode($post['author_slug']); ?>"
                                            class="text-primary text-capitalize">

                                            <?= htmlspecialchars($post['full_name']); ?>

                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <span class="text-dark text-capitalize ml-1">
                                            <?= tanggalIndonesia($post['created_at']); ?>
                                        </span>
                                    </li>

                                    <li class="list-inline-item">
                                        <span class="text-dark text-capitalize">
                                            &mdash; Kategori :
                                        </span>
                                        <a href="kategori=<?= urlencode($post['category_slug']); ?>">
                                            <?= htmlspecialchars($post['name_category']); ?>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Kanan -->
                                <div class="article-actions">

                                    <a href="javascript:void(0)"
                                        id="bookmarkBtn"
                                        class="action-btn bookmark-btn <?= $isBookmarked ? 'active-bookmark' : '' ?>"
                                        data-post-id="<?= $postId ?>">
                                        <i class="fa fa-bookmark"></i>
                                        <strong id="bookmarkCount">
                                            <?= $totalBookmarks ?>
                                        </strong>
                                    </a>

                                    <a href="javascript:void(0)"
                                        id="likeBtn"
                                        class="action-btn like-btn <?= $isLiked ? 'active-like' : '' ?>"
                                        data-post-id="<?= $postId ?>">
                                        <i class="fa fa-heart"></i>
                                        <strong id="likeCount">
                                            <?= $totalLikes ?>
                                        </strong>
                                    </a>

                                </div>

                            </div>
                        </div>

                        <div class="wrap__article-detail-image mt-4">
                            <figure>
                                <img src="dashboard/assets/images/uploads/posts/<?= $post['post_image']; ?>"
                                    alt="<?= htmlspecialchars($post['post_title']); ?>"
                                    class="img-fluid">
                            </figure>
                        </div>
                        <div class="wrap__article-detail-content">
                            <div class="total-views">
                                <div class="total-views-read">
                                    <?= formatViews($totalViews) ?>
                                    <span>
                                        views
                                    </span>
                                </div>


                                <ul class="list-inline">

                                    <span class="share">share on:</span>

                                    <li class="list-inline-item">
                                        <a
                                            class="btn btn-social-o facebook"
                                            target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u=<?= $currentUrl ?>">

                                            <i class="fa-brands fa-facebook-f"></i>
                                            <span>facebook</span>

                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a
                                            class="btn btn-social-o twitter"
                                            target="_blank"
                                            href="https://twitter.com/intent/tweet?url=<?= $currentUrl ?>&text=<?= $shareTitle ?>">

                                            <i class="fa-brands fa-x-twitter"></i>
                                            <span></span>

                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a
                                            class="btn btn-social-o whatsapp"
                                            target="_blank"
                                            href="https://wa.me/?text=<?= $shareTitle ?>%20<?= $currentUrl ?>">

                                            <i class="fa-brands fa-whatsapp"></i>
                                            <span>whatsapp</span>

                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a
                                            class="btn btn-social-o telegram"
                                            target="_blank"
                                            href="https://t.me/share/url?url=<?= $currentUrl ?>&text=<?= $shareTitle ?>">

                                            <i class="fa-brands fa-telegram"></i>
                                            <span>telegram</span>

                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a
                                            class="btn btn-linkedin-o linkedin"
                                            target="_blank"
                                            href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $currentUrl ?>">

                                            <i class="fa-brands fa-linkedin-in"></i>
                                            <span>linkedin</span>

                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <p class="has-drop-cap-fluid"><?= $post['post_desc']; ?></p>


                        </div>


                    </div>
                    <!-- end content article detail -->


                    <!-- News Tags -->
                    <div class="blog-tags">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <i class="fa fa-tags">
                                </i>
                            </li>
                            <?php while ($tag = mysqli_fetch_assoc($tagsQuery)) : ?>
                                <li class="list-inline-item">
                                    <a href="tags=<?= $tag['tag_slug']; ?>">
                                        #<?= htmlspecialchars($tag['tag_name']); ?>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <!-- end NEWS Tags-->

                    <!-- comment -->
                    <!-- Comment  -->
                    <div id="comments" class="comments-area">
                        <h3 class="comments-title"><?= $totalDiscussion; ?> Komentar:</h3>

                        <ol class="comment-list">

                            <?php while ($comment = mysqli_fetch_assoc($commentsQuery)) : ?>

                                <?php

                                $commentAvatar = getUserAvatar($comment);

                                if ($comment['user_type'] == 'public') {

                                    $commentName = $comment['public_name'];
                                } else {

                                    $commentName =
                                        $comment['admin_name'] .
                                        ' - ' .
                                        $comment['role_name'];
                                }

                                $commentId = (int)$comment['id'];

                                $replyQuery = mysqli_query($conn, "
    SELECT
        r.*,

        u.user_type,
        u.role_id,

        pp.full_name AS public_name,
        pp.gender AS public_gender,
        pp.photo_profile AS public_photo,

        up.full_name AS admin_name,
        up.gender AS admin_gender,
        up.photo_profile AS admin_photo,
        up.slug AS admin_slug,

        ro.role_name

    FROM post_comment_reply r

    INNER JOIN users u
        ON u.id = r.user_id

    LEFT JOIN public_profile pp
        ON pp.user_id = u.id

    LEFT JOIN user_profile up
        ON up.user_id = u.id

    LEFT JOIN roles ro
        ON ro.id = u.role_id

    WHERE r.comment_id = $commentId
    AND r.status = 'approved'

    ORDER BY r.created_at ASC
");

                                $commentAvatar = getUserAvatar($comment);

                                if ($comment['user_type'] == 'public') {

                                    $commentName = $comment['public_name'];
                                } else {

                                    $commentName =
                                        $comment['admin_name'] .
                                        ' - ' .
                                        $comment['role_name'];
                                }

                                ?>

                                <li class="comment">

                                    <aside class="comment-body">

                                        <div class="comment-meta">

                                            <div class="comment-author vcard">

                                                <img
                                                    src="<?= $commentAvatar; ?>"
                                                    class="avatar"
                                                    alt="<?= htmlspecialchars($commentName); ?>">

                                                <b class="fn">

                                                    <?php if ($comment['user_type'] == 'public') : ?>

                                                        <?= htmlspecialchars($commentName); ?>

                                                    <?php else : ?>

                                                        <a href="redaksi-detail.php?slug=<?= $comment['admin_slug']; ?>">
                                                            <?= htmlspecialchars($commentName); ?>
                                                        </a>

                                                    <?php endif; ?>

                                                </b>

                                                <span class="says">
                                                    says:
                                                </span>

                                            </div>

                                            <div class="comment-metadata">

                                                <span>
                                                    <?= tanggalIndonesia($comment['created_at']); ?>
                                                </span>

                                            </div>

                                        </div>

                                        <div class="comment-content">

                                            <p>
                                                <?= nl2br(htmlspecialchars($comment['comment'])); ?>
                                            </p>

                                        </div>

                                        <?php if (!empty($_SESSION['logged_in'])) : ?>

                                            <div class="reply">

                                                <a
                                                    href="javascript:void(0)"
                                                    class="comment-reply-link"
                                                    data-comment-id="<?= $commentId; ?>"
                                                    data-comment-name="<?= htmlspecialchars($commentName); ?>">

                                                    Reply

                                                </a>

                                            </div>

                                        <?php endif; ?>

                                    </aside>

                                    <?php if (mysqli_num_rows($replyQuery) > 0) : ?>

                                        <ol class="children">

                                            <?php while ($reply = mysqli_fetch_assoc($replyQuery)) :

                                                $replyAvatar = getUserAvatar($reply);

                                                if ($reply['user_type'] == 'public') {

                                                    $replyName = $reply['public_name'];
                                                } else {

                                                    $replyName =
                                                        $reply['admin_name'] .
                                                        ' - ' .
                                                        $reply['role_name'];
                                                }
                                            ?>


                                                <?php

                                                $replyAvatar = getUserAvatar($reply);

                                                if ($reply['user_type'] == 'public') {

                                                    $replyName = $reply['public_name'];
                                                } else {

                                                    $replyName =
                                                        $reply['admin_name'] .
                                                        ' - ' .
                                                        $reply['role_name'];
                                                }

                                                if ($comment['user_type'] == 'public') {

                                                    $commentName = $comment['public_name'];
                                                } else {

                                                    $commentName =
                                                        $comment['admin_name'] .
                                                        ' - ' .
                                                        $comment['role_name'];
                                                }

                                                $commentAvatar = getUserAvatar($comment);

                                                $replyAvatar = getUserAvatar($reply);

                                                if ($reply['user_type'] == 'public') {

                                                    $replyName = $reply['public_name'];
                                                } else {

                                                    $replyName =
                                                        $reply['admin_name'] .
                                                        ' - ' .
                                                        $reply['role_name'];
                                                }
                                                ?>

                                                <li class="comment">

                                                    <aside class="comment-body">

                                                        <div class="comment-meta">

                                                            <div class="comment-author vcard">

                                                                <img
                                                                    src="<?= $replyAvatar; ?>"
                                                                    class="avatar"
                                                                    alt="<?= htmlspecialchars($replyName); ?>">

                                                                <b class="fn">

                                                                    <?php if ($reply['user_type'] == 'public') : ?>

                                                                        <?= htmlspecialchars($replyName); ?>

                                                                    <?php else : ?>

                                                                        <a href="redaksi-detail.php?slug=<?= $reply['admin_slug']; ?>">
                                                                            <?= htmlspecialchars($replyName); ?>
                                                                        </a>

                                                                    <?php endif; ?>

                                                                </b>

                                                                <span class="says">
                                                                    replied:
                                                                </span>

                                                            </div>

                                                            <div class="comment-metadata">

                                                                <span>
                                                                    <?= tanggalIndonesia($reply['created_at']); ?>
                                                                </span>

                                                            </div>

                                                        </div>

                                                        <div class="comment-content">

                                                            <p>
                                                                <?= nl2br(htmlspecialchars($reply['reply'])); ?>
                                                            </p>

                                                        </div>

                                                    </aside>

                                                </li>

                                            <?php endwhile; ?>

                                        </ol>

                                    <?php endif; ?>

                                </li>

                            <?php endwhile; ?>

                        </ol>

                        <?php if (!empty($_SESSION['logged_in'])) : ?>

                            <div class="comment-respond" id="commentFormArea">

                                <h3 class="comment-reply-title" id="commentFormTitle">
                                    Tinggalkan Komentar
                                </h3>

                                <div
                                    id="replyInfo"
                                    style="display:none;margin-bottom:15px;">

                                    <span id="replyText"></span>

                                    <button
                                        type="button"
                                        id="cancelReply"
                                        class="btn btn-sm btn-danger ml-2">

                                        Hapus Balasan

                                    </button>

                                </div>

                                <form
                                    method="POST"
                                    action="logic/proses-komentar.php">

                                    <input
                                        type="hidden"
                                        name="post_id"
                                        value="<?= $postId; ?>">

                                    <input
                                        type="hidden"
                                        name="comment_id"
                                        id="comment_id"
                                        value="">

                                    <p class="comment-form-comment">

                                        <label id="commentLabel">
                                            Komentar
                                        </label>

                                        <textarea
                                            name="comment"
                                            id="commentText"
                                            required></textarea>

                                    </p>

                                    <p class="form-submit">

                                        <button
                                            type="submit"
                                            class="submit btn btn-primary">

                                            Kirim Komentar

                                        </button>

                                    </p>

                                </form>

                            </div>

                        <?php else : ?>

                            <div class="alert alert-info mt-4">

                                Silakan login terlebih dahulu untuk memberikan komentar.

                                <br><br>

                                <a href="login.php"
                                    class="btn btn-primary btn-sm">
                                    Login
                                </a>

                            </div>

                        <?php endif; ?>
                    </div>
                    <!-- Comment -->
                    <!-- end comment -->

                    <!-- NEXT PREV POST -->
                    <div class="row">

                        <div class="col-md-6">

                            <?php if ($prevPost): ?>

                                <div class="single_navigation-prev">
                                    <a href="<?= $prevPost['slug']; ?>">

                                        <span>previous post</span>

                                        <?= htmlspecialchars($prevPost['post_title']); ?>

                                    </a>
                                </div>

                            <?php endif; ?>

                        </div>

                        <div class="col-md-6">

                            <?php if ($nextPost): ?>

                                <div class="single_navigation-next text-left text-md-right">
                                    <a href="<?= $nextPost['slug']; ?>">

                                        <span>next post</span>

                                        <?= htmlspecialchars($nextPost['post_title']); ?>

                                    </a>
                                </div>

                            <?php endif; ?>

                        </div>

                    </div>
                    <div class="clearfix"></div>

                    <div class="related-article">
                        <h4>
                            Mungkin Ini Anda Sukai
                        </h4>

                        <!-- RELATED POST -->
                        <div class="article__entry-carousel-three">

                            <?php while ($related = mysqli_fetch_assoc($relatedPostsQuery)) : ?>

                                <div class="item">

                                    <div class="article__entry">

                                        <div class="article__image">

                                            <a href="<?= $related['slug']; ?>">

                                                <img
                                                    src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($related['post_image']); ?>"
                                                    alt="<?= htmlspecialchars($related['post_title']); ?>"
                                                    class="img-fluid">

                                            </a>

                                        </div>

                                        <div class="article__content">

                                            <ul class="list-inline">

                                                <li class="list-inline-item">

                                                    <span class="text-primary">

                                                        <?= htmlspecialchars($related['full_name']); ?>

                                                    </span>

                                                </li>

                                                <li class="list-inline-item">

                                                    <span>

                                                        <?= tanggalIndonesia($related['created_at']); ?>

                                                    </span>

                                                </li>

                                            </ul>

                                            <h5>

                                                <a href="<?= $related['slug']; ?>">

                                                    <?= htmlspecialchars($related['post_title']); ?>

                                                </a>

                                            </h5>

                                        </div>

                                    </div>

                                </div>

                            <?php endwhile; ?>

                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="sticky-top">
                        <aside class="wrapper__list__article ">
                            <h4 class="border_section">Artikel Lainnya</h4>
                            <div class="mb-4">
                                <div class="widget__form-search-bar position-relative">

                                    <div class="row no-gutters">

                                        <div class="col">

                                            <input
                                                type="text"
                                                id="searchInput"
                                                class="form-control border-secondary border-right-0 rounded-0"
                                                placeholder="Cari artikel...">

                                            <div id="searchResult"></div>

                                        </div>

                                        <div class="col-auto">

                                            <button
                                                id="searchBtn"
                                                class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">

                                                <i class="fa fa-search"></i>

                                            </button>

                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- POST ARTICLE MIX -->
                            <div class="wrapper__list__article-small">
                                <?php for ($i = 0; $i < 3; $i++): ?>

                                    <?php if (!isset($postMix[$i])) continue; ?>

                                    <div class="mb-3">

                                        <div class="card__post card__post-list">

                                            <div class="image-sm">

                                                <a href="<?= $postMix[$i]['slug']; ?>">

                                                    <img
                                                        src="dashboard/assets/images/uploads/posts/<?= $postMix[$i]['post_image']; ?>"
                                                        class="img-fluid"
                                                        alt="<?= htmlspecialchars($postMix[$i]['post_title']); ?>">

                                                </a>

                                            </div>

                                            <div class="card__post__body">

                                                <div class="card__post__content">

                                                    <div class="card__post__author-info mb-2">

                                                        <ul class="list-inline">

                                                            <li class="list-inline-item">

                                                                <span class="text-primary">

                                                                    <?= htmlspecialchars($postMix[$i]['full_name']); ?>

                                                                </span>

                                                            </li>

                                                            <li class="list-inline-item">

                                                                <span class="text-dark">

                                                                    <?= tanggalIndonesia($postMix[$i]['created_at']); ?>

                                                                </span>

                                                            </li>

                                                        </ul>

                                                    </div>

                                                    <div class="card__post__title">

                                                        <h6>

                                                            <a href="<?= $postMix[$i]['slug']; ?>">

                                                                <?= htmlspecialchars($postMix[$i]['post_title']); ?>

                                                            </a>

                                                        </h6>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                <?php endfor; ?>


                                <!-- Post Article BIG-->
                                <?php if (isset($postMix[3])): ?>

                                    <div class="article__entry">

                                        <div class="article__image">

                                            <a href="<?= $postMix[3]['slug']; ?>">

                                                <img
                                                    src="dashboard/assets/images/uploads/posts/<?= $postMix[3]['post_image']; ?>"
                                                    alt="<?= htmlspecialchars($postMix[3]['post_title']); ?>"
                                                    class="img-fluid">

                                            </a>

                                        </div>

                                        <div class="article__content">

                                            <div class="article__category">

                                                <a href="kategori=<?= urlencode($postMix[3]['category_slug']); ?>" class="text-white">

                                                    <?= htmlspecialchars($postMix[3]['name_category']); ?>

                                                </a>

                                            </div>

                                            <ul class="list-inline">

                                                <li class="list-inline-item">

                                                    <span class="text-primary">

                                                        <?= htmlspecialchars($postMix[3]['full_name']); ?>

                                                    </span>

                                                </li>

                                                <li class="list-inline-item">

                                                    <span class="text-dark">

                                                        <?= tanggalIndonesia($postMix[3]['created_at']); ?>

                                                    </span>

                                                </li>

                                            </ul>

                                            <h5>

                                                <a href="<?= $postMix[3]['slug']; ?>">

                                                    <?= htmlspecialchars($postMix[3]['post_title']); ?>

                                                </a>

                                            </h5>

                                            <p>

                                                <?= mb_substr(strip_tags($postMix[3]['post_desc']), 0, 120) . '...'; ?>

                                            </p>

                                            <a
                                                href="<?= $postMix[3]['slug']; ?>"
                                                class="btn btn-outline-primary mb-4 text-capitalize">

                                                baca selengkapnya

                                            </a>

                                        </div>

                                    </div>

                                <?php endif; ?>
                            </div>
                        </aside>

                        <!-- social media -->
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">Follow Akun Kami</h4>

                            <div class="wrap__social__media">

                                <?php while ($socmed = mysqli_fetch_assoc($socialMediaQuery)): ?>

                                    <?php

                                    $platform = strtolower(trim($socmed['name_platform']));

                                    switch ($platform) {

                                        case 'facebook':
                                            $class  = 'facebook';
                                            $icon   = 'fa-facebook';
                                            $action = 'like';
                                            break;

                                        case 'twitter':
                                        case 'x':
                                            $class  = 'twitter';
                                            $icon   = 'fa-x-twitter';
                                            $action = 'follow';
                                            break;

                                        case 'youtube':
                                            $class  = 'youtube';
                                            $icon   = 'fa-youtube';
                                            $action = 'subscribe';
                                            break;

                                        case 'instagram':
                                            $class  = 'instagram';
                                            $icon   = 'fa-instagram';
                                            $action = 'follow';
                                            break;

                                        case 'linkedin':
                                            $class  = 'linkedin';
                                            $icon   = 'fa-linkedin';
                                            $action = 'follow';
                                            break;

                                        case 'tiktok':
                                            $class  = 'tiktok';
                                            $icon   = 'fa-tiktok';
                                            $action = 'follow';
                                            break;

                                        default:
                                            $class  = 'facebook';
                                            $icon   = 'fa-globe';
                                            $action = 'visit';
                                    }

                                    ?>

                                    <a
                                        href="<?= htmlspecialchars($socmed['link_platform']); ?>"
                                        target="_blank">

                                        <div class="social__media__widget <?= $class; ?>">

                                            <span class="social__media__widget-icon">
                                                <i class="fab <?= $icon; ?>"></i>
                                            </span>

                                            <span class="social__media__widget-counter">
                                                <?= htmlspecialchars($socmed['account_name']); ?>
                                            </span>

                                            <span class="social__media__widget-name">
                                                <?= ucfirst($action); ?>
                                            </span>

                                        </div>

                                    </a>

                                <?php endwhile; ?>

                            </div>
                        </aside>
                        <!-- End social media -->

                        <!-- TAGS SIDEBAR -->
                        <aside class="wrapper__list__article">

                            <h4 class="border_section">
                                Tags
                            </h4>

                            <div class="blog-tags p-0">

                                <ul class="list-inline">

                                    <?php

                                    $maxTags = 15;

                                    foreach (array_slice($sidebarTags, 0, $maxTags) as $tag):

                                    ?>

                                        <li class="list-inline-item">

                                            <a href="tags=<?= urlencode($tag['tag_slug']); ?>">

                                                #<?= htmlspecialchars($tag['tag_name']); ?>

                                            </a>

                                        </li>

                                    <?php endforeach; ?>

                                    <?php if ($totalTagsSidebar > $maxTags): ?>

                                        <li class="list-inline-item">

                                            <a href="tags.php">

                                                +<?= $totalTagsSidebar - $maxTags; ?> Lainnya

                                            </a>

                                        </li>

                                    <?php endif; ?>

                                </ul>

                            </div>

                        </aside>

                        <!-- POST CATEGORIES -->
                        <aside class="wrapper__list__article">

                            <h4 class="border_section">
                                Kategori
                            </h4>

                            <div class="blog-tags p-0">

                                <ul class="list-inline">

                                    <?php

                                    $maxCategories = 15;

                                    foreach (
                                        array_slice(
                                            $sidebarCategories,
                                            0,
                                            $maxCategories
                                        ) as $category
                                    ) :

                                    ?>

                                        <li class="list-inline-item">

                                            <a href="kategori=<?= urlencode($category['slug']); ?>">
                                                <?= htmlspecialchars($category['name_category']); ?>
                                            </a>

                                        </li>

                                    <?php endforeach; ?>

                                    <?php if ($totalCategoriesSidebar > $maxCategories): ?>

                                        <li class="list-inline-item">

                                            <a href="kategori.php">

                                                +<?= $totalCategoriesSidebar - $maxCategories; ?> Lainnya

                                            </a>

                                        </li>

                                    <?php endif; ?>

                                </ul>

                            </div>

                        </aside>

                        <!-- ADVERTISE -->
                        <?php if ($adsData): ?>

                            <aside class="wrapper__list__article">

                                <h4 class="border_section">
                                    Iklan
                                </h4>

                                <a
                                    href="<?= htmlspecialchars($adsData['ad_link']); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    title="<?= htmlspecialchars($adsData['ad_title']); ?>">

                                    <figure class="mb-0">

                                        <img
                                            src="dashboard/assets/images/uploads/ads/<?= htmlspecialchars($adsData['ad_img']); ?>"
                                            alt="<?= htmlspecialchars($adsData['ad_title']); ?>"
                                            title="<?= htmlspecialchars($adsData['ad_title']); ?>"
                                            class="img-fluid w-100">

                                    </figure>

                                </a>

                            </aside>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="wrapper__section p-0">
        <div class="wrapper__section__components">
            <footer>
                <?php include 'includes/footer.php'; ?>
            </footer>
        </div>
    </section>


    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="./js/index.bundle.js?537a1bbd0e5129401d28"></script>
    <script type="text/javascript" src="js/navbar-search.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const replyLinks =
                document.querySelectorAll('.comment-reply-link');

            const title =
                document.getElementById('commentFormTitle');

            const label =
                document.getElementById('commentLabel');

            const hiddenCommentId =
                document.getElementById('comment_id');

            const replyInfo =
                document.getElementById('replyInfo');

            const replyText =
                document.getElementById('replyText');

            const cancelReply =
                document.getElementById('cancelReply');

            const formArea =
                document.getElementById('commentFormArea');

            replyLinks.forEach(link => {

                link.addEventListener('click', function() {

                    const commentId =
                        this.dataset.commentId;

                    const commentName =
                        this.dataset.commentName;

                    hiddenCommentId.value =
                        commentId;

                    title.innerHTML =
                        'Balas Komentar';

                    label.innerHTML =
                        'Balas Komentar';

                    replyInfo.style.display =
                        'block';

                    replyText.innerHTML =
                        'Sedang membalas komentar <strong>' +
                        commentName +
                        '</strong>';

                    formArea.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                });

            });

            cancelReply.addEventListener('click', function() {

                hiddenCommentId.value = '';

                title.innerHTML =
                    'Tinggalkan Komentar';

                label.innerHTML =
                    'Komentar';

                replyInfo.style.display =
                    'none';

            });

        });
    </script>

    <script>
        const likeBtn = document.getElementById('likeBtn');

        if (likeBtn) {

            likeBtn.addEventListener('click', function() {

                const postId = this.dataset.postId;

                fetch('logic/proses-like.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'post_id=' + postId
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (data.status === 'login') {
                            window.location = 'login.php';
                            return;
                        }

                        document.getElementById('likeCount').innerHTML =
                            data.count;

                        this.classList.toggle('active-like');

                        this.classList.add('like-animation');

                        setTimeout(() => {
                            this.classList.remove('like-animation');
                        }, 400);

                    });

            });

        }

        const bookmarkBtn = document.getElementById('bookmarkBtn');

        if (bookmarkBtn) {

            bookmarkBtn.addEventListener('click', function() {

                const postId = this.dataset.postId;

                fetch('logic/proses-bookmark.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'post_id=' + postId
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (data.status === 'login') {
                            window.location = 'login.php';
                            return;
                        }

                        document.getElementById('bookmarkCount').innerHTML =
                            data.count;

                        this.classList.toggle('active-bookmark');

                        this.classList.add('bookmark-animation');

                        setTimeout(() => {
                            this.classList.remove('bookmark-animation');
                        }, 400);

                    });

            });

        }
    </script>

    <script>
        const searchInput =
            document.getElementById('searchInput');

        const searchResult =
            document.getElementById('searchResult');

        searchInput.addEventListener('keyup', function() {

            let keyword = this.value.trim();

            if (keyword.length < 2) {

                searchResult.style.display = 'none';
                searchResult.innerHTML = '';

                return;
            }

            fetch(
                    'logic/search-post.php?keyword=' +
                    encodeURIComponent(keyword)
                )

                .then(res => res.text())

                .then(data => {

                    searchResult.innerHTML = data;

                    searchResult.style.display =
                        data.trim() !== '' ?
                        'block' :
                        'none';

                });

        });

        document.addEventListener('click', function(e) {

            if (!e.target.closest('.widget__form-search-bar')) {

                searchResult.style.display = 'none';

            }

        });

        function goSearch() {

            let keyword =
                searchInput.value.trim();

            if (keyword === '') {
                return;
            }

            window.location =
                'pencarian.php?q=' +
                encodeURIComponent(keyword);
        }

        document
            .getElementById('searchBtn')
            .addEventListener('click', goSearch);

        searchInput.addEventListener('keypress', function(e) {

            if (e.key === 'Enter') {

                e.preventDefault();

                goSearch();
            }

        });
    </script>

</body>

</html>