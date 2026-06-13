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
| CATEGORIES
|--------------------------------------------------------------------------
*/

$selectedSlug = mysqli_real_escape_string(
    $conn,
    $_GET['slug'] ?? ''
);

$categoriesPerPage = 10;
$categoryPage = isset($_GET['category_page'])
    ? max(1, (int) $_GET['category_page'])
    : 1;

$categoryOffset = ($categoryPage - 1) * $categoriesPerPage;

$totalCategoriesQuery = mysqli_query($conn, "
    SELECT COUNT(*) total
FROM post_category
");

$totalCategories = mysqli_fetch_assoc($totalCategoriesQuery)['total'];

$totalCategoryPages = ceil(
    $totalCategories / $categoriesPerPage
);

$categoriesQuery = mysqli_query($conn, "
    SELECT
        pc.id,
        pc.slug,
        pc.name_category,
        pc.desc_category,
        COUNT(DISTINCT p.id) total_posts
    FROM post_category pc
    LEFT JOIN post p
        ON p.post_category_id = pc.id
        AND p.status='publish'
    GROUP BY pc.id
    ORDER BY
        (pc.slug = '" . mysqli_real_escape_string($conn, $selectedSlug) . "') DESC,
        total_posts DESC,
        pc.name_category ASC
    LIMIT $categoryOffset,$categoriesPerPage
");

/*
|--------------------------------------------------------------------------
| POSTS BY CATEGORY
|--------------------------------------------------------------------------
*/

$postsPerPage = 10;

$postPage = isset($_GET['page'])
    ? max(1, (int)$_GET['page'])
    : 1;

$postOffset = ($postPage - 1) * $postsPerPage;

$selectedCategoryData = null;
$categoryPosts = [];
$totalPostPages = 0;
$selectedCategory = 0;

if (!empty($selectedSlug)) {

    $categoryQuery = mysqli_query($conn, "
        SELECT *
        FROM post_category
        WHERE slug='$selectedSlug'
        LIMIT 1
    ");

    $selectedCategoryData = mysqli_fetch_assoc($categoryQuery);

    if ($selectedCategoryData) {

        $selectedCategory = (int)$selectedCategoryData['id'];

        $countPostQuery = mysqli_query($conn, "
        SELECT COUNT(*) total
        FROM post
        WHERE post_category_id='$selectedCategory'
        AND status='publish'
    ");

        $totalPosts = mysqli_fetch_assoc(
            $countPostQuery
        )['total'];

        $totalPostPages = ceil(
            $totalPosts / $postsPerPage
        );
        $postQuery = mysqli_query($conn, "
            SELECT
                p.*,
                COALESCE(
                    up.full_name,
                    'Administrator'
                ) author_name
            FROM post p
            LEFT JOIN user_profile up
                ON up.user_id = p.user_id
            WHERE p.post_category_id='$selectedCategory'
            AND p.status='publish'
            ORDER BY p.created_at DESC
            LIMIT $postOffset,$postsPerPage
        ");

        while ($row = mysqli_fetch_assoc($postQuery)) {
            $categoryPosts[] = $row;
        }
    }
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
    ORDER BY RAND()
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
| SEO
|-------------------------------------------------------------------------- 
 */
$siteTagline = 'Media Informasi dan Edukasi Tentang Hukum';

if (!empty($selectedCategoryData)) {

    $metaTitle =
        'Kategori: ' .
        $selectedCategoryData['name_category'] .
        ' | Hukuminfo.id - ' .
        $siteTagline;
} else {

    $metaTitle =
        'Kategori | Hukuminfo.id - ' .
        $siteTagline;
}

if (!empty($selectedCategoryData)) {

    $metaDescription =
        'Baca kumpulan artikel kategori ' .
        $selectedCategoryData['name_category'] .
        ' di Hukuminfo.id. ' .
        strip_tags(
            mb_substr(
                $selectedCategoryData['desc_category'],
                0,
                140
            )
        );
} else {

    $metaDescription =
        'Jelajahi berbagai kategori artikel hukum, peraturan, litigasi, pidana, perdata, bisnis, dan informasi hukum terbaru di Hukuminfo.id.';
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($metaTitle); ?></title>
    <meta
        name="description"
        content="<?= htmlspecialchars($metaDescription); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
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

                            <!-- Kategori -->
                            <div class="mb-4">
                                <h3 class="border_section mb-4">Kategori</h3>

                                <div class="d-flex flex-wrap gap-2">
                                    <?php while ($category = mysqli_fetch_assoc($categoriesQuery)): ?>

                                        <?php
                                        $isActive = (
                                            $selectedCategory ==
                                            $category['id']
                                        );
                                        ?>

                                        <a
                                            href="kategori=<?= urlencode($category['slug']); ?>&category_page=<?= $categoryPage; ?>"
                                            class="btn <?= $isActive ? 'btn-primary' : 'btn-outline-primary'; ?> rounded-pill mb-2">

                                            <?= htmlspecialchars($category['name_category']); ?>

                                            <span class="badge badge-light ml-1">
                                                <?= number_format($category['total_posts']); ?>
                                            </span>

                                        </a>

                                    <?php endwhile; ?>

                                </div>
                            </div>

                            <!-- Pagination -->
                            <nav class="mt-4">
                                <ul class="pagination justify-content-center" id="categoryPagination"></ul>
                            </nav>

                            <aside class="wrapper__list__article mb-0">

                                <?php if (empty($selectedCategoryData)): ?>

                                    <div class="alert alert-info mb-0">
                                        Silakan pilih Kategori terlebih dahulu untuk melihat daftar artikel.
                                    </div>

                                <?php else: ?>

                                    <h4 class="border_section">
                                        <?= htmlspecialchars($selectedCategoryData['name_category']); ?>
                                    </h4>

                                    <div class="row">

                                        <?php foreach ($categoryPosts as $post): ?>

                                            <div class="col-md-6">

                                                <div class="mb-4">
                                                    <div class="article__entry">

                                                        <div class="article__image">
                                                            <a href="<?= $post['slug']; ?>">

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
                                                                        <?= htmlspecialchars($post['author_name']); ?>
                                                                    </span>
                                                                </li>

                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        <?= tanggalIndonesia($post['created_at']); ?>
                                                                    </span>
                                                                </li>

                                                            </ul>

                                                            <h5>

                                                                <a href="<?= $post['slug']; ?>">

                                                                    <?= htmlspecialchars($post['post_title']); ?>

                                                                </a>

                                                            </h5>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        <?php endforeach; ?>

                                    </div>

                                <?php endif; ?>
                                <!-- Pagination Detail Category -->
                                <nav aria-label="category pagination" class="mt-4">

                                    <ul
                                        class="pagination justify-content-center d-flex flex-row"
                                        id="detailCategoryPagination">

                                    </ul>

                                </nav>
                            </aside>
                        </div>

                        <div class="col-md-4">
                            <div class="sticky-top">
                                <!-- SOCIAL MEDIA -->
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
                                    <h4 class="border_section">tags</h4>
                                    <div class="blog-tags p-0">

                                        <ul class="list-inline">

                                            <?php

                                            $maxTags = 15;

                                            foreach (
                                                array_slice(
                                                    $sidebarTags,
                                                    0,
                                                    $maxTags
                                                ) as $tags
                                            ) :

                                            ?>

                                                <li class="list-inline-item">

                                                    <a href="tags=<?= urlencode($tags['tag_slug']); ?>">

                                                        #<?= htmlspecialchars($tags['tag_name']); ?>

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
        const currentPostPage = <?= $postPage ?>;
        const totalPostPages = <?= $totalPostPages ?>;

        function renderDetailPagination() {

            const ul = document.getElementById('detailCategoryPagination');

            if (!ul || totalPostPages <= 1) return;

            let html = '';

            html += `
    <li class="page-item ${currentPostPage == 1 ? 'disabled' : ''}">
        <a class="page-link"
           href="kategori=<?= urlencode($selectedSlug) ?>&category_page=<?= $categoryPage ?>&page=${currentPostPage-1}">
            <i class="fa fa-angle-left"></i>
        </a>
    </li>`;

            for (let i = 1; i <= totalPostPages; i++) {

                html += `
        <li class="page-item ${i == currentPostPage ? 'active' : ''}">
            <a class="page-link"
               href="kategori=<?= urlencode($selectedSlug) ?>&category_page=<?= $categoryPage ?>&page=${i}">
                ${i}
            </a>
        </li>`;
            }

            html += `
    <li class="page-item ${currentPostPage == totalPostPages ? 'disabled' : ''}">
        <a class="page-link"
           href="kategori=<?= urlencode($selectedSlug) ?>&category_page=<?= $categoryPage ?>&page=${currentPostPage+1}">
            <i class="fa fa-angle-right"></i>
        </a>
    </li>`;

            ul.innerHTML = html;
        }

        renderDetailPagination();
    </script>

    <script>
        const currentCategoryPage = <?= $categoryPage ?>;
        const totalCategoryPages = <?= $totalCategoryPages ?>;
        const selectedSlug = "<?= urlencode($selectedSlug) ?>";

        function renderCategoryPagination() {

            const ul = document.getElementById('categoryPagination');

            if (!ul || totalCategoryPages <= 1) return;

            let html = '';

            html += `
    <li class="page-item ${currentCategoryPage == 1 ? 'disabled' : ''}">
        <a class="page-link"
           href="kategori=${selectedSlug}&category_page=${currentCategoryPage-1}">
            <i class="fa fa-angle-left"></i>
        </a>
    </li>`;

            let start = Math.max(1, currentCategoryPage - 2);
            let end = Math.min(totalCategoryPages, currentCategoryPage + 2);

            for (let i = start; i <= end; i++) {

                html += `
        <li class="page-item ${i == currentCategoryPage ? 'active' : ''}">
            <a class="page-link"
               href="kategori=${selectedSlug}&category_page=${i}">
                ${i}
            </a>
        </li>`;
            }

            html += `
    <li class="page-item ${currentCategoryPage == totalCategoryPages ? 'disabled' : ''}">
        <a class="page-link"
           href="kategori=${selectedSlug}&category_page=${currentCategoryPage+1}">
            <i class="fa fa-angle-right"></i>
        </a>
    </li>`;

            ul.innerHTML = html;
        }

        renderCategoryPagination();
    </script>

</body>

</html>