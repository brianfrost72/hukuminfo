<?php
session_start();

$tab = $_GET['tab'] ?? 'terbaru';

$userId = $_SESSION['user_id'] ?? 0;

if (!$userId) {
    die('Silakan login terlebih dahulu');
}

require_once __DIR__ . '/../koneksi.php';


/*
|--------------------------------------------------------------------------
| GET USER DATA
|--------------------------------------------------------------------------
*/
$profileQuery = mysqli_query($conn, "
    SELECT
        pp.*,
        u.email
    FROM public_profile pp
    INNER JOIN users u
        ON u.id = pp.user_id
    WHERE pp.user_id = {$userId}
    LIMIT 1
");

$userPublic = mysqli_fetch_assoc($profileQuery);

if (!$userPublic) {
    die('Profil tidak ditemukan');
}

/*
|--------------------------------------------------------------------------
| GET ARTICLES
|--------------------------------------------------------------------------
*/
$userPublicPhoto = '';

if (
    !empty($userPublic['photo_profile']) &&
    file_exists(
        __DIR__ . '/../assets/images/uploads/public_photos/' .
            $userPublic['photo_profile']
    )
) {

    $userPublicPhoto =
        '../assets/images/uploads/public_photos/' .
        $userPublic['photo_profile'];
} else {

    if ($userPublic['gender'] == 'Perempuan') {

        $userPublicPhoto =
            '../assets/images/avatar/avatar-women.png';
    } else {

        $userPublicPhoto =
            '../assets/images/avatar/avatar-men.png';
    }
}


/*
|--------------------------------------------------------------------------
| GET NEW ARTICLES
|--------------------------------------------------------------------------
*/
if ($tab == 'terbaru') {

    $queryNews = mysqli_query($conn, "
    SELECT
        p.*,
        pc.name_category,
        pc.slug AS category_slug
    FROM post p

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    WHERE p.status='publish'

    ORDER BY p.id DESC

    LIMIT 10
");

    if (!$queryNews) {
        die(mysqli_error($conn));
    }
} else {

    $queryNews = mysqli_query($conn, "
    SELECT
        p.*,
        pc.name_category,
        pc.slug AS category_slug,

        COUNT(DISTINCT pl.id) AS total_like,
        COUNT(DISTINCT pv.id) AS total_view

    FROM post p

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    LEFT JOIN post_likes pl
        ON pl.post_id = p.id

    LEFT JOIN post_views pv
        ON pv.post_id = p.id

    WHERE p.status='publish'

    GROUP BY p.id

    ORDER BY
        total_like DESC,
        total_view DESC,
        p.id DESC

    LIMIT 10
");

    if (!$queryNews) {
        die(mysqli_error($conn));
    }
}


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
        content="">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Konig Guard Bureau</title>

    <!-- Perfect Scrollbar -->
    <link type="text/css"
        href="../assets/vendor/perfect-scrollbar.css"
        rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css"
        href="../assets/css/app.css"
        rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles.css">

    <!-- Material Design Icons -->
    <link type="text/css"
        href="../assets/css/vendor-material-icons.css"
        rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        .news-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
            overflow: hidden;
            height: 100%;
        }

        .news-card-header {
            padding: 15px 20px;
            font-size: 18px;
            font-weight: 600;
            border-bottom: 1px solid #eee;
        }

        .news-list {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .news-item {
            border-bottom: 1px solid #f1f1f1;
        }

        .news-item:last-child {
            border-bottom: none;
        }

        .news-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            text-decoration: none !important;
            transition: all .25s ease;
        }

        .news-link:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }

        .news-number {
            width: 35px;
            min-width: 35px;
            font-size: 22px;
            font-weight: 700;
            color: #6774df;
            text-align: center;
            margin-right: 12px;
        }

        .news-thumb {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 12px;
        }

        .news-title {
            color: #333;
            font-size: 14px;
            font-weight: 500;
            line-height: 1.4;
        }

        .news-link:hover .news-title {
            color: #6774df;
        }

        @media(max-width:768px) {
            .news-thumb {
                width: 70px;
                height: 50px;
            }

            .news-number {
                width: 30px;
                min-width: 30px;
                font-size: 18px;
            }
        }
    </style>
</head>

<body class="layout-fixed">

    <div class="preloader"></div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        <div id="header"
            class="mdk-header js-mdk-header m-0"
            data-fixed
            data-effects="waterfall">
            <?php include 'includes/topheader.php'; ?>
        </div>

        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page">
            <div class="page__header mb-0">
                <?php include 'includes/navbar.php'; ?>
            </div>

            <div class="container page__heading-container">
                <div class="page__heading d-flex align-items-center">
                    <div class="flex">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="/"><i class="material-icons icon-20pt">home</i></a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">Beranda</li>
                            </ol>
                        </nav>
                        <h1 class="m-0">Beranda</h1>
                    </div>
                </div>
            </div>

            <div class="container page__container">
                <div class="row">

                    <!-- PROFIL PUBLIC -->
                    <div class="col-lg-3 mb-4">

                        <div class="redaksi-profile">

                            <div class="redaksi-cover"></div>

                            <div class="text-center redaksi-content">

                                <img src="<?= $userPublicPhoto; ?>"
                                    class="redaksi-avatar"
                                    alt="<?= htmlspecialchars($userPublic['full_name']); ?>">

                                <h4 class="redaksi-name">
                                    <?= htmlspecialchars($userPublic['full_name']); ?>
                                </h4>

                                <p class="redaksi-company">
                                    <?= htmlspecialchars($userPublic['email']); ?>
                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- BERITA REDAKSI -->
                    <div class="col-lg-9">

                        <!-- Tab -->
                        <div class="mb-4">

                            <a href="?tab=terbaru"
                                class="btn-redaksi <?= $tab == 'terbaru' ? 'active' : ''; ?>">
                                Terbaru
                            </a>

                            <a href="?tab=terpopuler"
                                class="btn-redaksi <?= $tab == 'terpopuler' ? 'active' : ''; ?>">
                                Terpopuler
                            </a>

                        </div>

                        <!-- Item Berita -->
                        <aside class="wrapper__list__article">

                            <div class="wrapp__list__article-responsive">

                                <?php if (mysqli_num_rows($queryNews) > 0): ?>

                                    <?php while ($news = mysqli_fetch_assoc($queryNews)): ?>

                                        <?php

                                        $postImage = 'images/placeholder/500x400.jpg';

                                        if (
                                            !empty($news['post_image']) &&
                                            file_exists(
                                                __DIR__ .
                                                    '/../assets/images/uploads/posts/' .
                                                    $news['post_image']
                                            )
                                        ) {

                                            $postImage =
                                                '../assets/images/uploads/posts/' .
                                                $news['post_image'];
                                        }

                                        $excerpt = strip_tags($news['post_desc']);

                                        if (strlen($excerpt) > 180) {
                                            $excerpt = substr($excerpt, 0, 180) . '...';
                                        }

                                        ?>

                                        <div class="card__post card__post-list card__post__transition mt-30">

                                            <div class="row">

                                                <div class="col-md-5">

                                                    <div class="card__post__transition">

                                                        <a href="<?= urlencode($news['slug']); ?>">

                                                            <img src="<?= $postImage; ?>"
                                                                class="img-fluid w-100"
                                                                alt="<?= htmlspecialchars($news['post_title']); ?>">

                                                        </a>

                                                    </div>

                                                </div>

                                                <div class="col-md-7 my-auto pl-0">

                                                    <div class="card__post__body">

                                                        <div class="card__post__content">

                                                            <div class="card__post__category">

                                                                <a href="kategori=<?= urlencode($news['category_slug']); ?>" class="text-white">

                                                                    <?= htmlspecialchars($news['name_category']); ?>

                                                                </a>

                                                            </div>

                                                            <div class="card__post__author-info mb-2">

                                                                <ul class="list-inline">

                                                                    <li class="list-inline-item">

                                                                        <span class="text-primary">

                                                                            <?= htmlspecialchars($userPublic['full_name']); ?>

                                                                        </span>

                                                                    </li>

                                                                    <li class="list-inline-item">

                                                                        <span class="text-dark text-capitalize">
                                                                            <?= date('d M Y', strtotime($news['created_at'])); ?>

                                                                        </span>

                                                                    </li>

                                                                </ul>

                                                            </div>

                                                            <div class="card__post__title">

                                                                <h5>

                                                                    <a href="<?= urlencode($news['slug']); ?>">

                                                                        <?= htmlspecialchars($news['post_title']); ?>

                                                                    </a>

                                                                </h5>

                                                                <p class="d-none d-lg-block d-xl-block mb-0">

                                                                    <?= htmlspecialchars($excerpt); ?>

                                                                </p>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <div class="alert alert-warning mt-3">
                                        Artikel Belum ada.
                                    </div>

                                <?php endif; ?>

                            </div>
                            <div class="mx-auto">
                                <!-- Pagination -->

                                <div class="pagination-area">

                                    <div class="pagination">



                                    </div>

                                </div>
                            </div>
                        </aside>
                    </div>

                </div>
            </div>

        </div>
        <!-- // END Header Layout Content -->

    </div>
    <!-- // END Header Layout -->

    <!-- App Settings FAB -->
    <div id="app-settings" style="display: none;">
        <app-settings layout-active="fixed"></app-settings>
    </div>

    <?php include 'includes/mobile_menu.php'; ?>

    <footer class="dashboard-footer mt-4">
        <div class="container-fluid">
            <div class="row align-items-center">

                <!-- LEFT -->
                <div class="col-md-6 text-md-left text-center mb-2 mb-md-0">
                    <span class="footer-text">
                        © 2026 Hukuminfo.id. All rights reserved.
                    </span>
                </div>

                <!-- RIGHT -->
                <div class="col-md-6 text-md-right text-center">

                    <span class="follow-text">Follow Our Social Media : </span>

                    <a href="#" class="footer-social">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="#" class="footer-social">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="#" class="footer-social">
                        <i class="fab fa-x-twitter"></i>
                    </a>

                    <a href="#" class="footer-social">
                        <i class="fab fa-youtube"></i>
                    </a>

                    <a href="#" class="footer-social">
                        <i class="fab fa-tiktok"></i>
                    </a>

                </div>

            </div>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="../assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="../assets/vendor/popper.min.js"></script>
    <script src="../assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="../assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="../assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="../assets/vendor/material-design-kit.js"></script>

    <!-- App -->
    <script src="../assets/js/toggle-check-all.js"></script>
    <script src="../assets/js/check-selected-row.js"></script>
    <script src="../assets/js/dropdown.js"></script>
    <script src="../assets/js/sidebar-mini.js"></script>
    <script src="../assets/js/app.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="../assets/js/app-settings.js"></script>


</body>

</html>