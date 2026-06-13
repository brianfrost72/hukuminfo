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
| TRENDING MIX NEWS TOP
|--------------------------------------------------------------------------
*/

$trendingQuery = mysqli_query($conn, "
    SELECT *
    FROM (
        SELECT
            p.id,
            p.post_title,
            p.slug,
            p.post_image,
            p.total_views,
            p.created_at,
            COALESCE(up.full_name, 'Administrator') AS author_name
        FROM post p
        LEFT JOIN user_profile up
            ON up.user_id = p.user_id
        WHERE p.status = 'publish'
        ORDER BY p.total_views DESC
        LIMIT 10
    ) trending
    ORDER BY RAND()
");

// DEBUG
$trendingQuery = mysqli_query($conn, "
    SELECT *
    FROM (
        SELECT
            p.id,
            p.post_title,
            p.slug,
            p.post_image,
            p.total_views,
            p.created_at,
            COALESCE(up.full_name, 'Administrator') AS author_name
        FROM post p
        LEFT JOIN user_profile up
            ON up.user_id = p.user_id
        WHERE p.status = 'publish'
        ORDER BY p.total_views DESC
        LIMIT 10
    ) trending
    ORDER BY RAND()
");

if (!$trendingQuery) {
    die(mysqli_error($conn));
}

/* 
|--------------------------------------------------------------------------
| HIGHLIGHT NEWS
|--------------------------------------------------------------------------
*/
$highlightQuery = mysqli_query($conn, "
    SELECT
        p.id,
        p.post_title,
        p.slug,
        p.post_image,
        p.created_at,
        COUNT(pv.id) AS total_views,

        pc.name_category,
        pc.slug AS category_slug,

        COALESCE(up.full_name,'Administrator') AS author_name

    FROM post p

    LEFT JOIN post_views pv
        ON pv.post_id = p.id

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    LEFT JOIN user_profile up
        ON up.user_id = p.user_id

    WHERE p.status='publish'

    GROUP BY p.id

    ORDER BY total_views DESC

    LIMIT 3
");

$highlights = [];

while ($row = mysqli_fetch_assoc($highlightQuery)) {
    $highlights[] = $row;
}

$highlight1 = $highlights[0] ?? null;
$highlight2 = $highlights[1] ?? null;
$highlight3 = $highlights[2] ?? null;

/* 
|--------------------------------------------------------------------------
| RANDOM POST CAROUSEL
|--------------------------------------------------------------------------
*/

$excludeIds = [];

foreach ($highlights as $item) {
    $excludeIds[] = (int)$item['id'];
}

$excludeSql = '';

if (!empty($excludeIds)) {
    $excludeSql = "AND p.id NOT IN (" . implode(',', $excludeIds) . ")";
}

$randomPostQuery = mysqli_query($conn, "
    SELECT
        p.id,
        p.post_title,
        p.slug,
        p.post_image,
        p.created_at,
        COALESCE(up.full_name,'Administrator') AS author_name
    FROM post p
    LEFT JOIN user_profile up
        ON up.user_id = p.user_id
    WHERE p.status='publish'
    $excludeSql
    ORDER BY RAND()
    LIMIT 12
");

if (!$randomPostQuery) {
    die(mysqli_error($conn));
}

/*
|--------------------------------------------------------------------------
| MOST BOOKMARKED POSTS
|--------------------------------------------------------------------------
*/

$bookmarkQuery = mysqli_query($conn, "
    SELECT
        p.id,
        p.post_title,
        p.slug,
        p.post_image,
        p.created_at,

        pc.name_category,
        pc.slug AS category_slug,

        COUNT(pb.id) AS total_bookmarks,

        COALESCE(up.full_name,'Administrator') AS author_name

    FROM post p

    LEFT JOIN post_bookmarks pb
        ON pb.post_id = p.id

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    LEFT JOIN user_profile up
        ON up.user_id = p.user_id

    WHERE p.status='publish'

    GROUP BY p.id

    HAVING total_bookmarks > 0

    ORDER BY total_bookmarks DESC

    LIMIT 6
");

$bookmarkPosts = [];

while ($row = mysqli_fetch_assoc($bookmarkQuery)) {
    $bookmarkPosts[] = $row;
}

$bookmarkHighlightLeft  = $bookmarkPosts[0] ?? null;
$bookmarkHighlightRight = $bookmarkPosts[1] ?? null;

$bookmarkLeftPosts = array_slice($bookmarkPosts, 2, 2);
$bookmarkRightPosts = array_slice($bookmarkPosts, 4, 2);

/*
|--------------------------------------------------------------------------
| MOST LIKED POSTS
|--------------------------------------------------------------------------
*/

$mostLikedQuery = mysqli_query($conn, "
    SELECT
        p.id,
        p.post_title,
        p.slug,
        COUNT(pl.id) AS total_likes,

        pc.name_category,
        pc.slug AS category_slug

    FROM post p

    INNER JOIN post_likes pl
        ON pl.post_id = p.id

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    WHERE p.status = 'publish'

    GROUP BY p.id

    ORDER BY total_likes DESC, p.created_at DESC

    LIMIT 4
");

if (!$mostLikedQuery) {
    die(mysqli_error($conn));
}
/*
|--------------------------------------------------------------------------
| CATEGORY PAGINATION (OPSI B)
|--------------------------------------------------------------------------
*/

$postPerCategory = 20;

$currentPage = isset($_GET['page'])
    ? max(1, (int)$_GET['page'])
    : 1;

/*
|--------------------------------------------------------------------------
| AMBIL SEMUA KATEGORI
|--------------------------------------------------------------------------
*/

$allCategoriesQuery = mysqli_query($conn, "
    SELECT
        id,
        name_category,
        slug
    FROM post_category
    ORDER BY id ASC
");

$allBlocks = [];

while ($category = mysqli_fetch_assoc($allCategoriesQuery)) {

    $totalPostQuery = mysqli_query($conn, "
        SELECT COUNT(*) total
        FROM post
        WHERE status='publish'
        AND post_category_id = {$category['id']}
    ");

    $totalPost =
        (int) mysqli_fetch_assoc($totalPostQuery)['total'];

    if ($totalPost <= 0) {
        continue;
    }

    $totalChunk = ceil($totalPost / $postPerCategory);

    for ($chunk = 0; $chunk < $totalChunk; $chunk++) {

        $allBlocks[] = [
            'category_id'   => $category['id'],
            'name_category' => $category['name_category'],
            'slug'          => $category['slug'],
            'offset'        => $chunk * $postPerCategory
        ];
    }
}

/*
|--------------------------------------------------------------------------
| TOTAL PAGE
|--------------------------------------------------------------------------
*/

$blockPerPage = 2;

$totalPages = ceil(
    count($allBlocks) / $blockPerPage
);

$pageOffset =
    ($currentPage - 1) * $blockPerPage;

$currentBlocks = array_slice(
    $allBlocks,
    $pageOffset,
    $blockPerPage
);

/*
|--------------------------------------------------------------------------
| ASIDE 1
|--------------------------------------------------------------------------
*/

$categoryAside1 = $currentBlocks[0] ?? null;
$categoryAside1Posts = [];

if ($categoryAside1) {

    $postAside1Query = mysqli_query($conn, "
        SELECT
            p.id,
            p.post_title,
            p.slug,
            p.post_image,
            p.created_at,

            COALESCE(
                up.full_name,
                'Administrator'
            ) AS author_name

        FROM post p

        LEFT JOIN user_profile up
            ON up.user_id = p.user_id

        WHERE p.status='publish'
        AND p.post_category_id =
            {$categoryAside1['category_id']}

        ORDER BY p.created_at DESC

        LIMIT $postPerCategory
        OFFSET {$categoryAside1['offset']}
    ");

    while ($row = mysqli_fetch_assoc($postAside1Query)) {
        $categoryAside1Posts[] = $row;
    }
}

/*
|--------------------------------------------------------------------------
| ASIDE 2
|--------------------------------------------------------------------------
*/

$categoryAside2 = $currentBlocks[1] ?? null;
$categoryAside2Posts = [];

if ($categoryAside2) {

    $postAside2Query = mysqli_query($conn, "
        SELECT
            p.id,
            p.post_title,
            p.slug,
            p.post_image,
            p.post_desc,
            p.created_at,

            COALESCE(
                up.full_name,
                'Administrator'
            ) AS author_name

        FROM post p

        LEFT JOIN user_profile up
            ON up.user_id = p.user_id

        WHERE p.status='publish'
        AND p.post_category_id =
            {$categoryAside2['category_id']}

        ORDER BY p.created_at DESC

        LIMIT $postPerCategory
        OFFSET {$categoryAside2['offset']}
    ");

    while ($row = mysqli_fetch_assoc($postAside2Query)) {
        $categoryAside2Posts[] = $row;
    }
}

/*
|--------------------------------------------------------------------------
| ARTIKEL TERBARU SIDEBAR
|--------------------------------------------------------------------------
*/

$latestPostsQuery = mysqli_query($conn, "
    SELECT
        p.id,
        p.post_title,
        p.slug,
        p.post_image,
        p.post_desc,
        p.created_at,

        pc.name_category,
        pc.slug AS category_slug,

        COALESCE(up.full_name,'Administrator') AS author_name

    FROM post p

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    LEFT JOIN user_profile up
        ON up.user_id = p.user_id

    WHERE p.status='publish'

    ORDER BY p.id DESC

    LIMIT 3
");

$latestPosts = [];

while ($row = mysqli_fetch_assoc($latestPostsQuery)) {
    $latestPosts[] = $row;
}

/*
|----------------------------------------------------
| 99 = BIG
| 98 = SMALL
| 97 = SMALL
|----------------------------------------------------
*/

$latestBig = $latestPosts[0] ?? null;

$latestSmallPosts = array_slice(
    $latestPosts,
    1,
    2
);
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
| 
|--------------------------------------------------------------------------
*/
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Hukuminfo.id | Media Informasi, Berita, dan Edukasi Hukum Indonesia</title>

    <meta name="description" content="Hukuminfo.id menyajikan berita hukum terbaru, regulasi, peraturan perundang-undangan, analisis hukum, edukasi hukum, dan informasi terpercaya seputar perkembangan hukum di Indonesia.">

    <meta name="keywords" content="berita hukum, hukum indonesia, informasi hukum, edukasi hukum, regulasi indonesia, peraturan hukum, berita hukum terbaru, artikel hukum, hukuminfo">

    <meta name="robots" content="index, follow">

    <meta property="og:type" content="website">
    <meta property="og:title" content="Hukuminfo.id | Media Informasi, Berita, dan Edukasi Hukum Indonesia">
    <meta property="og:description" content="Portal informasi hukum Indonesia yang menyajikan berita, regulasi, analisis, dan edukasi hukum secara terpercaya dan berimbang.">
    <meta property="og:url" content="https://hukuminfo.id/">
    <meta property="og:site_name" content="Hukuminfo.id">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Hukuminfo.id | Media Informasi, Berita, dan Edukasi Hukum Indonesia">
    <meta name="twitter:description" content="Portal informasi hukum Indonesia yang menyajikan berita, regulasi, analisis, dan edukasi hukum secara terpercaya dan berimbang.">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="canonical" href="https://hukuminfo.id/">
    <!-- favicon.ico in the root directory -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/v4-shims.min.css">

    <link href="./css/styles.css?537a1bbd0e5129401d28" rel="stylesheet">
</head>

<body>
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

    <!-- Header news -->
    <header>
        <!-- Navbar  Top-->
        <div class="topbar d-none d-sm-block">
            <?php include 'includes/top-header.php'; ?>
        </div>
        <!-- End Navbar Top  -->
        <!-- Navbar  -->
        <!-- Navbar menu  -->
        <div class="navigation-wrap navigation-shadow bg-white">
            <?php include 'includes/navbar.php'; ?>
        </div>
        <!-- End Navbar menu  -->

        <!-- Navbar sidebar menu  -->
        <?php include 'includes/mobile_menu.php'; ?>
        <!-- End Navbar  -->
    </header>
    <!-- End Header news -->
    <!-- MIX NEWS TOP carousel-->
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrapp__list__article-responsive wrapp__list__article-responsive-carousel">

                        <?php while ($trending = mysqli_fetch_assoc($trendingQuery)): ?>

                            <div class="item">

                                <div class="card__post card__post-list">

                                    <div class="image-sm">
                                        <a href="<?= urlencode($trending['slug']) ?>">
                                            <img
                                                src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($trending['post_image']) ?>"
                                                class="img-fluid"
                                                alt="<?= htmlspecialchars($trending['post_title']) ?>">
                                        </a>
                                    </div>

                                    <div class="card__post__body">

                                        <div class="card__post__content">

                                            <div class="card__post__author-info mb-2">
                                                <ul class="list-inline">

                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            <i class="fa fa-pen me-1"></i>
                                                            : <?= htmlspecialchars($trending['author_name']) ?>
                                                        </span>
                                                    </li>

                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                            <?= tanggalIndonesia($trending['created_at']) ?>
                                                        </span>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="card__post__title">
                                                <h6>
                                                    <a href="<?= urlencode($trending['slug']) ?>">
                                                        <?= htmlspecialchars($trending['post_title']) ?>
                                                    </a>
                                                </h6>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Tranding news carousel -->

    <!-- Popular news -->
    <section>
        <!-- HIGHLIGHT POST news  header-->
        <div class="popular__news-header">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-8 ">
                        <div class="card__post-carousel">

                            <?php foreach ($highlights as $highlight): ?>

                                <div class="item">

                                    <div class="card__post">
                                        <div class="card__post__body">

                                            <a href="<?= urlencode($highlight['slug']) ?>">
                                                <img
                                                    src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($highlight['post_image']) ?>"
                                                    class="img-fluid"
                                                    alt="<?= htmlspecialchars($highlight['post_title']) ?>">
                                            </a>

                                            <div class="card__post__content bg__post-cover">
                                                <div class="card__post__category">
                                                    <a href="kategori=<?= urlencode($highlight['category_slug']) ?>" class="text-white">
                                                        <?= htmlspecialchars($highlight['name_category']) ?>
                                                    </a>
                                                </div>
                                                <div class="card__post__title">
                                                    <h2>
                                                        <a href="<?= urlencode($highlight['slug']) ?>">
                                                            <?= htmlspecialchars($highlight['post_title']) ?>
                                                        </a>
                                                    </h2>
                                                </div>

                                                <div class="card__post__author-info">
                                                    <ul class="list-inline">

                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                <i class="fa fa-pen me-1"></i>
                                                                : <?= htmlspecialchars($highlight['author_name']) ?>
                                                            </span>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <span>
                                                                <?= tanggalIndonesia($highlight['created_at']) ?>
                                                            </span>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <span class="fa fa-eye">
                                                                <?= number_format($highlight['total_views']) ?>
                                                            </span>
                                                        </li>

                                                    </ul>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="popular__news-right">
                            <!-- Post Article Second Highlight  -->
                            <?php if ($highlight2): ?>
                                <div class="card__post">
                                    <div class="card__post__body card__post__transition">

                                        <a href="<?= urlencode($highlight2['slug']) ?>">
                                            <img
                                                src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($highlight2['post_image']) ?>"
                                                class="img-fluid"
                                                alt="<?= htmlspecialchars($highlight2['post_title']) ?>">
                                        </a>

                                        <div class="card__post__content bg__post-cover">
                                            <div class="card__post__category">
                                                <a href="kategori=<?= urlencode($highlight2['category_slug']) ?>" class="text-white">
                                                    <?= htmlspecialchars($highlight2['name_category']) ?>
                                                </a>
                                            </div>
                                            <div class="card__post__title">
                                                <h5>
                                                    <a href="<?= urlencode($highlight2['slug']) ?>">
                                                        <?= htmlspecialchars($highlight2['post_title']) ?>
                                                    </a>
                                                </h5>
                                            </div>

                                            <div class="card__post__author-info">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            <i class="fa fa-pen me-1"></i>
                                                            : <?= htmlspecialchars($highlight2['author_name']) ?>
                                                        </span>
                                                    </li>

                                                    <li class="list-inline-item">
                                                        <span>
                                                            <?= tanggalIndonesia($highlight2['created_at']) ?>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- Post Article Third Highlight -->
                            <?php if ($highlight3): ?>
                                <div class="card__post">
                                    <div class="card__post__body card__post__transition">

                                        <a href="<?= urlencode($highlight3['slug']) ?>">
                                            <img
                                                src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($highlight3['post_image']) ?>"
                                                class="img-fluid"
                                                alt="<?= htmlspecialchars($highlight3['post_title']) ?>">
                                        </a>

                                        <div class="card__post__content bg__post-cover">
                                            <div class="card__post__category">
                                                <a href="kategori=<?= urlencode($highlight3['category_slug']) ?>" class="text-white">
                                                    <?= htmlspecialchars($highlight3['name_category']) ?>
                                                </a>
                                            </div>
                                            <div class="card__post__title">
                                                <h5>
                                                    <a href="<?= urlencode($highlight3['slug']) ?>">
                                                        <?= htmlspecialchars($highlight3['post_title']) ?>
                                                    </a>
                                                </h5>
                                            </div>

                                            <div class="card__post__author-info">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            <i class="fa fa-pen me-1"></i>
                                                            : <?= htmlspecialchars($highlight3['author_name']) ?>
                                                        </span>
                                                    </li>

                                                    <li class="list-inline-item">
                                                        <span>
                                                            <?= tanggalIndonesia($highlight3['created_at']) ?>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Popular news header-->
        <!-- Random Post carousel -->
        <div class="popular__news-header-carousel">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top__news__slider">

                            <?php while ($post = mysqli_fetch_assoc($randomPostQuery)): ?>

                                <div class="item">

                                    <div class="article__entry">

                                        <div class="article__image">
                                            <a href="<?= urlencode($post['slug']) ?>">
                                                <img
                                                    src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($post['post_image']) ?>"
                                                    alt="<?= htmlspecialchars($post['post_title']) ?>"
                                                    class="img-fluid">
                                            </a>
                                        </div>

                                        <div class="article__content">

                                            <ul class="list-inline">

                                                <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        <i class="fa fa-pen me-1"></i>
                                                        : <?= htmlspecialchars($post['author_name']) ?>
                                                    </span>
                                                </li>

                                                <li class="list-inline-item">
                                                    <span>
                                                        <?= tanggalIndonesia($post['created_at']) ?>
                                                    </span>
                                                </li>

                                            </ul>

                                            <h5>
                                                <a href="<?= urlencode($post['slug']) ?>">
                                                    <?= htmlspecialchars($post['post_title']) ?>
                                                </a>
                                            </h5>

                                        </div>

                                    </div>

                                </div>

                            <?php endwhile; ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Popular news carousel -->
    </section>
    <!-- End Popular news -->

    <!-- NEWS -->
    <section class="pt-0">
        <div class="popular__section-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="wrapper__list__article">
                            <h4 class="border_section">Paling Diminati</h4>
                        </div>
                        <div class="row ">
                            <div class="col-sm-12 col-md-6 mb-4">
                                <!-- Post Article Highlight Most Bookmark Left -->
                                <?php if ($bookmarkHighlightLeft): ?>
                                    <div class="card__post">
                                        <div class="card__post__body card__post__transition">

                                            <a href="<?= urlencode($bookmarkHighlightLeft['slug']) ?>">
                                                <img
                                                    src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($bookmarkHighlightLeft['post_image']) ?>"
                                                    class="img-fluid"
                                                    alt="<?= htmlspecialchars($bookmarkHighlightLeft['post_title']) ?>">
                                            </a>

                                            <div class="card__post__content bg__post-cover">
                                                <div class="card__post__category">
                                                    <a href="kategori=<?= urlencode($bookmarkHighlightLeft['category_slug']) ?>" class="text-white">
                                                        <?= htmlspecialchars($bookmarkHighlightLeft['name_category']) ?>
                                                    </a>
                                                </div>
                                                <div class="card__post__title">
                                                    <h5>
                                                        <a href="<?= urlencode($bookmarkHighlightLeft['slug']) ?>">
                                                            <?= htmlspecialchars($bookmarkHighlightLeft['post_title']) ?>
                                                        </a>
                                                    </h5>
                                                </div>

                                                <div class="card__post__author-info">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span>
                                                                <i class="fa fa-pen me-1"></i>
                                                                : <?= htmlspecialchars($bookmarkHighlightLeft['author_name']) ?>
                                                            </span>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <span>
                                                                <?= tanggalIndonesia($bookmarkHighlightLeft['created_at']) ?>
                                                            </span>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <span class="fa fa-bookmark">
                                                                <?= number_format($bookmarkHighlightLeft['total_bookmarks']) ?>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-4">
                                <!-- Post Article Highlight Most Bookmark Right -->
                                <?php if ($bookmarkHighlightRight): ?>
                                    <div class="card__post">
                                        <div class="card__post__body card__post__transition">

                                            <a href="<?= urlencode($bookmarkHighlightRight['slug']) ?>">
                                                <img
                                                    src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($bookmarkHighlightRight['post_image']) ?>"
                                                    class="img-fluid"
                                                    alt="<?= htmlspecialchars($bookmarkHighlightRight['post_title']) ?>">
                                            </a>

                                            <div class="card__post__content bg__post-cover">
                                                <div class="card__post__category">
                                                    <a href="kategori=<?= urlencode($bookmarkHighlightRight['category_slug']) ?>" class="text-white">
                                                        <?= htmlspecialchars($bookmarkHighlightRight['name_category']) ?>
                                                    </a>
                                                </div>
                                                <div class="card__post__title">
                                                    <h5>
                                                        <a href="<?= urlencode($bookmarkHighlightRight['slug']) ?>">
                                                            <?= htmlspecialchars($bookmarkHighlightRight['post_title']) ?>
                                                        </a>
                                                    </h5>
                                                </div>

                                                <div class="card__post__author-info">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span>
                                                                <i class="fa fa-pen me-1"></i>
                                                                : <?= htmlspecialchars($bookmarkHighlightRight['author_name']) ?>
                                                            </span>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <span>
                                                                <?= tanggalIndonesia($bookmarkHighlightRight['created_at']) ?>
                                                            </span>
                                                        </li>

                                                        <li class="list-inline-item">
                                                            <span class="fa fa-bookmark">
                                                                <?= number_format($bookmarkHighlightRight['total_bookmarks']) ?>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-12 col-md-6">
                                <div class="wrapp__list__article-responsive">
                                    <div class="mb-3">
                                        <!-- Post Article Bookmark Left -->
                                        <?php foreach ($bookmarkLeftPosts as $post): ?>

                                            <div class="mb-3">

                                                <div class="card__post card__post-list">

                                                    <div class="image-sm">
                                                        <a href="<?= urlencode($post['slug']) ?>">
                                                            <img
                                                                src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($post['post_image']) ?>"
                                                                class="img-fluid"
                                                                alt="<?= htmlspecialchars($post['post_title']) ?>">
                                                        </a>
                                                    </div>

                                                    <div class="card__post__body">
                                                        <div class="card__post__content">

                                                            <div class="card__post__author-info mb-2">
                                                                <ul class="list-inline">

                                                                    <li class="list-inline-item">
                                                                        <span class="text-primary">
                                                                            <i class="fa fa-pen me-1"></i>
                                                                            : <?= htmlspecialchars($post['author_name']) ?>
                                                                        </span>
                                                                    </li>

                                                                    <li class="list-inline-item">
                                                                        <span class="text-dark">
                                                                            <?= tanggalIndonesia($post['created_at']) ?>
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>

                                                            <div class="card__post__title">
                                                                <h6>
                                                                    <a href="<?= urlencode($post['slug']) ?>">
                                                                        <?= htmlspecialchars($post['post_title']) ?>
                                                                    </a>
                                                                </h6>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 ">
                                <div class="wrapp__list__article-responsive">
                                    <div class="mb-3">
                                        <!-- Post Article Bookmark Right -->
                                        <?php foreach ($bookmarkRightPosts as $post): ?>

                                            <div class="mb-3">

                                                <div class="card__post card__post-list">

                                                    <div class="image-sm">
                                                        <a href="<?= urlencode($post['slug']) ?>">
                                                            <img
                                                                src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($post['post_image']) ?>"
                                                                class="img-fluid"
                                                                alt="<?= htmlspecialchars($post['post_title']) ?>">
                                                        </a>
                                                    </div>

                                                    <div class="card__post__body">
                                                        <div class="card__post__content">

                                                            <div class="card__post__author-info mb-2">
                                                                <ul class="list-inline">

                                                                    <li class="list-inline-item">
                                                                        <span class="text-primary">
                                                                            <i class="fa fa-pen me-1"></i>
                                                                            : <?= htmlspecialchars($post['author_name']) ?>
                                                                        </span>
                                                                    </li>

                                                                    <li class="list-inline-item">
                                                                        <span class="text-dark">
                                                                            <?= tanggalIndonesia($post['created_at']) ?>
                                                                        </span>
                                                                    </li>

                                                                </ul>
                                                            </div>

                                                            <div class="card__post__title">
                                                                <h6>
                                                                    <a href="<?= urlencode($post['slug']) ?>">
                                                                        <?= htmlspecialchars($post['post_title']) ?>
                                                                    </a>
                                                                </h6>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 col-lg-4">
                        <!-- POST MOST LIKES -->
                        <aside class="wrapper__list__article">
                            <h4 class="border_section">Paling Disukai</h4>
                            <div class="wrapper__list-number">

                                <?php
                                $rank = 1;

                                while ($like = mysqli_fetch_assoc($mostLikedQuery)):
                                ?>

                                    <div class="card__post__list">

                                        <div class="list-number">
                                            <span>
                                                <?= number_format($like['total_likes']) ?>
                                            </span>
                                        </div>

                                        <a
                                            href="kategori=<?= urlencode($like['category_slug']) ?>"
                                            class="category">

                                            <?= htmlspecialchars($like['name_category']) ?>

                                        </a>

                                        <ul class="list-inline">
                                            <li class="list-inline-item">

                                                <h5>
                                                    <a href="<?= urlencode($like['slug']) ?>">
                                                        <?= htmlspecialchars($like['post_title']) ?>
                                                    </a>
                                                </h5>

                                            </li>
                                        </ul>

                                    </div>

                                <?php
                                    $rank++;
                                endwhile;
                                ?>

                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>


        <!-- Post Category Aside -->
        <div class="mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Post Category Aside 1 -->
                        <?php if ($categoryAside1): ?>

                            <aside class="wrapper__list__article mb-0">

                                <h4 class="border_section">

                                    <a href="kategori=<?= urlencode($categoryAside1['slug']); ?>">

                                        <?= htmlspecialchars($categoryAside1['name_category']); ?>

                                    </a>

                                </h4>

                                <div class="row">

                                    <?php foreach ($categoryAside1Posts as $post): ?>

                                        <div class="col-md-6">

                                            <div class="mb-4">

                                                <div class="article__entry">

                                                    <div class="article__image">

                                                        <a href="<?= urlencode($post['slug']); ?>">

                                                            <img
                                                                src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($post['post_image']); ?>"
                                                                class="img-fluid"
                                                                alt="<?= htmlspecialchars($post['post_title']); ?>">

                                                        </a>

                                                    </div>

                                                    <div class="article__content">

                                                        <ul class="list-inline">

                                                            <li class="list-inline-item">
                                                                <span class="text-primary">
                                                                    <i class="fa fa-pen me-1"></i>
                                                                    : <?= htmlspecialchars($post['author_name']); ?>
                                                                </span>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <span>
                                                                    <?= tanggalIndonesia($post['created_at']); ?>
                                                                </span>
                                                            </li>

                                                        </ul>

                                                        <h5>

                                                            <a href="<?= urlencode($post['slug']); ?>">

                                                                <?= htmlspecialchars($post['post_title']); ?>

                                                            </a>

                                                        </h5>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    <?php endforeach; ?>

                                </div>

                            </aside>

                        <?php endif; ?>

                        <!-- Post Category Aside 2 -->
                        <?php if ($categoryAside2): ?>

                            <aside class="wrapper__list__article">

                                <h4 class="border_section">

                                    <a href="kategori=<?= urlencode($categoryAside2['slug']); ?>">

                                        <?= htmlspecialchars($categoryAside2['name_category']); ?>

                                    </a>

                                </h4>

                                <div class="wrapp__list__article-responsive">

                                    <?php foreach ($categoryAside2Posts as $post): ?>

                                        <div class="card__post card__post-list card__post__transition mt-30">

                                            <div class="row">

                                                <div class="col-md-5">

                                                    <div class="card__post__transition">

                                                        <a href="<?= urlencode($post['slug']); ?>">

                                                            <img
                                                                src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($post['post_image']); ?>"
                                                                class="img-fluid w-100"
                                                                alt="<?= htmlspecialchars($post['post_title']); ?>">

                                                        </a>

                                                    </div>

                                                </div>

                                                <div class="col-md-7 my-auto pl-0">

                                                    <div class="card__post__body">

                                                        <div class="card__post__content">

                                                            <div class="card__post__author-info mb-2">

                                                                <ul class="list-inline">

                                                                    <li class="list-inline-item">
                                                                        <span class="text-primary">
                                                                            <i class="fa fa-pen me-1"></i>
                                                                            : <?= htmlspecialchars($post['author_name']); ?>
                                                                        </span>
                                                                    </li>

                                                                    <li class="list-inline-item">
                                                                        <span class="text-dark text-capitalize">
                                                                            <?= tanggalIndonesia($post['created_at']); ?>
                                                                        </span>
                                                                    </li>

                                                                </ul>

                                                            </div>

                                                            <div class="card__post__title">

                                                                <h5>

                                                                    <a href="<?= urlencode($post['slug']); ?>">

                                                                        <?= htmlspecialchars($post['post_title']); ?>

                                                                    </a>

                                                                </h5>

                                                                <p class="d-none d-lg-block d-xl-block mb-0">

                                                                    <?= mb_substr(strip_tags($post['post_desc']), 0, 120); ?>

                                                                </p>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    <?php endforeach; ?>

                                </div>

                            </aside>

                        <?php endif; ?>
                    </div>
                    <!-- END ARTIKEL ALL -->

                    <!-- SIDEBAR -->
                    <div class="col-md-4">
                        <div class="sticky-top">
                            <!-- ARTIKEL BARU -->
                            <aside class="wrapper__list__article">
                                <h4 class="border_section">
                                    Artikel Terbaru</h4>
                                <div class="wrapper__list__article-small">

                                    <!-- Post New Big -->
                                    <?php if ($latestBig): ?>

                                        <div class="article__entry">

                                            <div class="article__image">
                                                <a href="<?= urlencode($latestBig['slug']) ?>">
                                                    <img
                                                        src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($latestBig['post_image']) ?>"
                                                        alt="<?= htmlspecialchars($latestBig['post_title']) ?>"
                                                        class="img-fluid">
                                                </a>
                                            </div>

                                            <div class="article__content">

                                                <div class="article__category">
                                                    <a href="kategori=<?= urlencode($latestBig['category_slug']) ?>" class="text-white">
                                                        <?= htmlspecialchars($latestBig['name_category']) ?>
                                                    </a>
                                                </div>

                                                <ul class="list-inline">

                                                    <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            <i class="fa fa-pen me-1"></i>
                                                            : <?= htmlspecialchars($latestBig['author_name']) ?>
                                                        </span>
                                                    </li>

                                                    <li class="list-inline-item">
                                                        <span>
                                                            <?= tanggalIndonesia($latestBig['created_at']) ?>
                                                        </span>
                                                    </li>

                                                </ul>

                                                <h5>
                                                    <a href="<?= urlencode($latestBig['slug']) ?>">
                                                        <?= htmlspecialchars($latestBig['post_title']) ?>
                                                    </a>
                                                </h5>

                                                <p>
                                                    <?= mb_substr(strip_tags($latestBig['post_desc']), 0, 120) ?>
                                                </p>

                                            </div>

                                        </div>

                                    <?php endif; ?>


                                    <!-- POST New Small 2 List Only -->
                                    <div class="mb-3">
                                        <?php foreach ($latestSmallPosts as $post): ?>

                                            <div class="mb-3">

                                                <div class="card__post card__post-list">

                                                    <div class="image-sm">

                                                        <a href="<?= urlencode($post['slug']) ?>">

                                                            <img
                                                                src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($post['post_image']) ?>"
                                                                class="img-fluid"
                                                                alt="<?= htmlspecialchars($post['post_title']) ?>">

                                                        </a>

                                                    </div>

                                                    <div class="card__post__body">

                                                        <div class="card__post__content">

                                                            <div class="card__post__author-info mb-2">

                                                                <ul class="list-inline">

                                                                    <li class="list-inline-item">
                                                                        <span class="text-primary">
                                                                            <i class="fa fa-pen me-1"></i>
                                                                            : <?= htmlspecialchars($post['author_name']) ?>
                                                                        </span>
                                                                    </li>

                                                                    <li class="list-inline-item">
                                                                        <span>
                                                                            <?= tanggalIndonesia($post['created_at']) ?>
                                                                        </span>
                                                                    </li>

                                                                </ul>

                                                            </div>

                                                            <div class="card__post__title">

                                                                <h6>

                                                                    <a href="<?= urlencode($post['slug']) ?>">

                                                                        <?= htmlspecialchars($post['post_title']) ?>

                                                                    </a>

                                                                </h6>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        <?php endforeach; ?>
                                    </div>
                            </aside>

                            <!-- SOCIAL MEDIA SIDEBAR -->
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

                                                <a href="tags">

                                                    +<?= $totalTagsSidebar - $maxTags; ?> Lainnya

                                                </a>

                                            </li>

                                        <?php endif; ?>

                                    </ul>

                                </div>

                            </aside>


                            <!-- IKLAN -->
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

                    <!-- Pagination -->
                    <div class="mx-auto">

                        <div class="pagination-area">

                            <ul class="pagination justify-content-center" id="homePagination"></ul>

                        </div>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Popular news category -->

    <section class="wrapper__section p-0">
        <div class="wrapper__section__components">
            <!-- Footer -->
            <?php include 'includes/footer.php'; ?>
        </div>
    </section>


    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="./js/index.bundle.js?537a1bbd0e5129401d28"></script>
    <script type="text/javascript" src="js/navbar-search.js"></script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsMediaOrganization",
            "name": "Hukuminfo.id",
            "url": "https://hukuminfo.id",
            "logo": "https://hukuminfo.id/favicon.png",
            "description": "Media informasi dan edukasi hukum Indonesia."
        }
    </script>

    <script>
        const currentPage = <?= $currentPage ?>;
        const totalPages = <?= $totalPages ?>;

        function buildPagination(current, total) {
            const pagination = document.getElementById('homePagination');

            if (!pagination || total <= 1) return;

            let html = '';

            // PREV
            html += `
        <li class="page-item ${current === 1 ? 'disabled' : ''}">
            <a class="page-link" href="?page=${current - 1}">
                <i class="fa fa-angle-left"></i>
            </a>
        </li>
    `;

            const pages = [];

            // awal
            for (let i = 1; i <= Math.min(5, total); i++) {
                pages.push(i);
            }

            // sekitar current
            for (let i = current - 1; i <= current + 1; i++) {
                if (i > 1 && i < total) {
                    pages.push(i);
                }
            }

            // akhir
            for (let i = Math.max(total - 2, 1); i <= total; i++) {
                pages.push(i);
            }

            // hapus duplikat
            const uniquePages = [...new Set(pages)].sort((a, b) => a - b);

            let prevPage = 0;

            uniquePages.forEach(page => {

                if (prevPage && page - prevPage > 1) {
                    html += `
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            `;
                }

                html += `
            <li class="page-item ${page === current ? 'active' : ''}">
                <a class="page-link" href="?page=${page}">
                    ${page}
                </a>
            </li>
        `;

                prevPage = page;
            });

            // NEXT
            html += `
        <li class="page-item ${current === total ? 'disabled' : ''}">
            <a class="page-link" href="?page=${current + 1}">
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    `;

            pagination.innerHTML = html;
        }

        buildPagination(currentPage, totalPages);
    </script>
</body>

</html>