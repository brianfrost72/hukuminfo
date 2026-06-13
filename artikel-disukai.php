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
| ARTIKEL PALING DISUKAI
|--------------------------------------------------------------------------
*/

$limit = 10;

$page = isset($_GET['page'])
    ? max(1, (int)$_GET['page'])
    : 1;

$offset = ($page - 1) * $limit;

/*
|--------------------------------------------------------------------------
| TOTAL DATA
|--------------------------------------------------------------------------
*/

$totalQuery = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM post p
    WHERE p.status = 'publish'
");

$totalData = mysqli_fetch_assoc($totalQuery)['total'];

$totalPages = ceil($totalData / $limit);

/*
|--------------------------------------------------------------------------
| MOST LIKED POSTS
|--------------------------------------------------------------------------
*/

$likedQuery = mysqli_query($conn, "
    SELECT
        p.id,
        p.post_title,
        p.slug,
        p.post_image,
        p.created_at,

        up.full_name,
        up.slug AS author_slug,

        COUNT(pl.id) AS total_likes

    FROM post p

    LEFT JOIN post_likes pl
        ON pl.post_id = p.id

    LEFT JOIN users u
        ON u.id = p.user_id

    LEFT JOIN user_profile up
        ON up.user_id = u.id

    WHERE p.status = 'publish'

    GROUP BY p.id

    ORDER BY
        total_likes DESC,
        p.created_at DESC

    LIMIT $offset, $limit
");

$likedPosts = [];

while ($row = mysqli_fetch_assoc($likedQuery)) {
    $likedPosts[] = $row;
}

/*
|--------------------------------------------------------------------------
| SEO
|--------------------------------------------------------------------------
*/
$seoTitle = 'Artikel Paling Disukai | Hukuminfo.id - Media Informasi dan Edukasi Tentang Hukum';

$seoDescription = 'Kumpulan artikel hukum paling disukai pembaca Hukuminfo.id. Temukan berita hukum, regulasi, opini, analisis, dan informasi hukum Indonesia yang mendapatkan apresiasi tertinggi dari pembaca.';

$seoKeywords = 'artikel paling disukai, artikel hukum populer, berita hukum indonesia, informasi hukum indonesia, regulasi hukum, edukasi hukum, hukuminfo, artikel hukum terbaik';

$seoUrl = 'https://hukuminfo.id/artikel-disukai';

$seoImage = 'https://hukuminfo.id/images/logo-hukuminfo.png';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($seoTitle); ?></title>

    <meta name="description" content="<?= htmlspecialchars($seoDescription); ?>">
    <meta name="keywords" content="<?= htmlspecialchars($seoKeywords); ?>">
    <meta name="author" content="Hukuminfo.id">
    <meta name="robots" content="index, follow">
    <meta name="language" content="id">
    <meta name="revisit-after" content="1 days">

    <link rel="canonical" href="<?= $seoUrl; ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Hukuminfo.id">
    <meta property="og:title" content="<?= htmlspecialchars($seoTitle); ?>">
    <meta property="og:description" content="<?= htmlspecialchars($seoDescription); ?>">
    <meta property="og:url" content="<?= $seoUrl; ?>">
    <meta property="og:image" content="<?= $seoImage; ?>">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($seoTitle); ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($seoDescription); ?>">
    <meta name="twitter:image" content="<?= $seoImage; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

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
        <!-- navbar -->
        <div class="topbar d-none d-sm-block">
            <?php include 'includes/top-header.php'; ?>
        </div>
        <!-- Navbar menu  -->
        <div class="navigation-wrap navigation-shadow bg-white">
            <?php include 'includes/navbar.php'; ?>
        </div>
        <!-- End Navbar menu  -->

        <!-- Navbar sidebar menu  -->
        <?php include 'includes/mobile_menu.php'; ?>
        <!-- End Navbar sidebar menu  -->
        <!-- End Navabr -->
    </header>
    <!-- End header -->
    <section class="wrapper__section my-5">
        <div class="container">
            <div class="mt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">

                            <aside class="wrapper__list__article mb-0">

                                <h4 class="border_section">
                                    ARTIKEL PALING DISUKAI
                                </h4>

                                <div class="row">

                                    <?php foreach ($likedPosts as $post): ?>

                                        <div class="col-md-6">

                                            <div class="mb-4">

                                                <div class="article__entry">

                                                    <div class="article__image">

                                                        <a href="<?= htmlspecialchars($post['slug']); ?>">

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

                                                                    <?= htmlspecialchars($post['full_name']); ?>

                                                                </span>

                                                            </li>

                                                            <li class="list-inline-item">

                                                                <span>

                                                                    <?= tanggalIndonesia($post['created_at']); ?>

                                                                </span>

                                                            </li>

                                                        </ul>

                                                        <div class="mb-2">

                                                            <span class="text-danger">

                                                                <i class="fa fa-heart"></i>

                                                                <?= number_format($post['total_likes']); ?>

                                                            </span>

                                                        </div>

                                                        <h5>

                                                            <a href="<?= htmlspecialchars($post['slug']); ?>">

                                                                <?= htmlspecialchars($post['post_title']); ?>

                                                            </a>

                                                        </h5>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    <?php endforeach; ?>

                                </div>
                                <!-- Pagination -->
                                <nav aria-label="likes pagination" class="mt-4">

                                    <ul
                                        class="pagination justify-content-center d-flex flex-row"
                                        id="mostLikePagination">

                                    </ul>

                                </nav>
                            </aside>
                        </div>

                        <div class="col-md-4">
                            <div class="sticky-top">
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

                                                    <a href="kategori">

                                                        +<?= $totalCategoriesSidebar - $maxCategories; ?> Lainnya

                                                    </a>

                                                </li>

                                            <?php endif; ?>

                                        </ul>

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
            </div>
        </div>
    </section>



    <section class="wrapper__section p-0">
        <div class="wrapper__section__components">
            <?php include 'includes/footer.php'; ?>
        </div>
    </section>


    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="./js/index.bundle.js?537a1bbd0e5129401d28"></script>
    <script type="text/javascript" src="js/navbar-search.js"></script>

    <script>
        const currentPage = <?= $page ?>;
        const totalPages = <?= $totalPages ?>;

        function renderPagination() {

            const ul = document.getElementById('mostLikePagination');

            if (!ul || totalPages <= 1) return;

            let html = '';

            html += `
        <li class="page-item ${currentPage == 1 ? 'disabled' : ''}">
            <a class="page-link"
               href="?page=${currentPage - 1}">
                <i class="fa fa-chevron-left"></i>
            </a>
        </li>
    `;

            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, currentPage + 2);

            if (startPage > 1) {

                html += `
            <li class="page-item">
                <a class="page-link" href="?page=1">1</a>
            </li>
        `;

                if (startPage > 2) {
                    html += `
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            `;
                }
            }

            for (let i = startPage; i <= endPage; i++) {

                html += `
            <li class="page-item ${i == currentPage ? 'active' : ''}">
                <a class="page-link"
                   href="?page=${i}">
                    ${i}
                </a>
            </li>
        `;
            }

            if (endPage < totalPages) {

                if (endPage < totalPages - 1) {
                    html += `
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            `;
                }

                html += `
            <li class="page-item">
                <a class="page-link"
                   href="?page=${totalPages}">
                    ${totalPages}
                </a>
            </li>
        `;
            }

            html += `
        <li class="page-item ${currentPage == totalPages ? 'disabled' : ''}">
            <a class="page-link"
               href="?page=${currentPage + 1}">
                <i class="fa fa-chevron-right"></i>
            </a>
        </li>
    `;

            ul.innerHTML = html;
        }

        renderPagination();
    </script>
</body>

</html>