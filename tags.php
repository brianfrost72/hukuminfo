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
| TAGS
|--------------------------------------------------------------------------
*/

$selectedTag = '';

if (isset($_GET['tag'])) {
    $selectedTag = trim($_GET['tag']);
} elseif (isset($_GET['slug'])) {
    $selectedTag = trim($_GET['slug']);
}

$tagsPerPage = 10;
$tagPage = isset($_GET['tag_page']) ? max(1, (int)$_GET['tag_page']) : 1;
$tagOffset = ($tagPage - 1) * $tagsPerPage;

$totalTagsQuery = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM tags
");

if (!$totalTagsQuery) {

    error_log(
        'Tags Query Error: ' .
            mysqli_error($conn)
    );

    $totalTags = 0;
} else {

    $row = mysqli_fetch_assoc($totalTagsQuery);

    $totalTags = (int)$row['total'];
}

$totalTagPages = ceil($totalTags / $tagsPerPage);

$tagsQuery = mysqli_query($conn, "
    SELECT
        t.id,
        t.tag_name,
        t.tag_slug,
        COUNT(DISTINCT p.id) total_posts
    FROM tags t
    LEFT JOIN post_tags pt
        ON pt.tag_id = t.id
    LEFT JOIN post p
        ON p.id = pt.post_id
        AND p.status='publish'
    GROUP BY t.id
    ORDER BY
        (t.tag_slug = '" . mysqli_real_escape_string($conn, $selectedTag) . "') DESC,
        total_posts DESC,
        t.tag_name ASC
    LIMIT $tagOffset,$tagsPerPage
");

// QUERY TAG 
$postsPerPage = 10;

$postPage = isset($_GET['page'])
    ? max(1, (int)$_GET['page'])
    : 1;

$postOffset = ($postPage - 1) * $postsPerPage;

$selectedTagData = null;
$tagPosts = [];
$totalPostPages = 0;

// TAG AKTIF SETELAH DIPILIH
if (!empty($selectedTag)) {
    $tagInfoQuery = mysqli_query($conn, "
        SELECT *
        FROM tags
        WHERE tag_slug='" . mysqli_real_escape_string($conn, $selectedTag) . "'
        LIMIT 1
    ");

    $selectedTagData = mysqli_fetch_assoc($tagInfoQuery);

    if ($selectedTagData) {
        $tagId = (int)$selectedTagData['id'];

        $countPostQuery = mysqli_query($conn, "
            SELECT COUNT(DISTINCT p.id) total
            FROM post p
            INNER JOIN post_tags pt
                ON pt.post_id = p.id
            WHERE pt.tag_id='$tagId'
            AND p.status='publish'
        ");

        $totalPosts = mysqli_fetch_assoc($countPostQuery)['total'];

        $totalPostPages = ceil($totalPosts / $postsPerPage);

        $postQuery = mysqli_query($conn, "
            SELECT
                p.*,
                COALESCE(up.full_name,'Administrator') author_name
            FROM post p
            INNER JOIN post_tags pt
                ON pt.post_id = p.id
            LEFT JOIN user_profile up
                ON up.user_id = p.user_id
            WHERE pt.tag_id='$tagId'
            AND p.status='publish'
            GROUP BY p.id
            ORDER BY p.created_at DESC
            LIMIT $postOffset,$postsPerPage
        ");

        while ($row = mysqli_fetch_assoc($postQuery)) {
            $tagPosts[] = $row;
        }
    }
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
| SEO OPTIMIZE
|--------------------------------------------------------------------------
*/
$metaTitle = 'Tags - Hukuminfo.id';
$metaDescription = 'Jelajahi berbagai topik hukum, berita terbaru, edukasi hukum, dan artikel informatif di Hukuminfo.id.';

if (!empty($selectedTagData)) {

    $metaTitle = 'Tag: ' . $selectedTagData['tag_name'] . ' - Hukuminfo.id';

    $totalArtikel = count($tagPosts);

    $metaDescription =
        'Kumpulan artikel dengan tag ' .
        $selectedTagData['tag_name'] .
        ' di Hukuminfo.id. Temukan berita, analisis, dan informasi hukum terbaru terkait ' .
        $selectedTagData['tag_name'] . '.';
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>
        <?php if (!empty($selectedTagData)): ?>
            Tags: <?= htmlspecialchars($selectedTagData['tag_name']); ?>
        <?php else: ?>
            Tags
        <?php endif; ?>
        &ndash; Hukuminfo.id
    </title>
    <meta
        name="keywords"
        content="<?= !empty($selectedTagData)
                        ? htmlspecialchars($selectedTagData['tag_name']) . ', hukum, berita hukum, hukuminfo'
                        : 'hukum, berita hukum, edukasi hukum, hukuminfo'; ?>">

    <meta name="robots" content="index,follow">

    <meta property="og:type" content="website">

    <meta
        property="og:title"
        content="<?= htmlspecialchars($metaTitle); ?>">

    <meta
        property="og:description"
        content="<?= htmlspecialchars($metaDescription); ?>">

    <meta
        property="og:url"
        content="https://hukuminfo.id/tags.php<?= !empty($selectedTagData) ? '?tag=' . urlencode($selectedTagData['tag_slug']) : ''; ?>">

    <meta
        property="og:site_name"
        content="Hukuminfo.id">
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

                            <!-- Tags -->
                            <div class="mb-4">
                                <h3 class="border_section mb-4">Tags</h3>

                                <div class="d-flex flex-wrap gap-2">

                                    <?php while ($tag = mysqli_fetch_assoc($tagsQuery)): ?>

                                        <?php
                                        $isActive = ($selectedTag == $tag['tag_slug']);
                                        ?>

                                        <a
                                            href="tags=<?= urlencode($tag['tag_slug']); ?>?tag_page=<?= $tagPage; ?>"
                                            class="btn <?= $isActive ? 'btn-primary' : 'btn-outline-primary'; ?> rounded-pill mb-2">

                                            #<?= htmlspecialchars($tag['tag_name']); ?>

                                            <span class="badge badge-light ml-1">
                                                <?= number_format($tag['total_posts']); ?>
                                            </span>

                                        </a>

                                    <?php endwhile; ?>

                                </div>
                            </div>

                            <!-- Pagination -->
                            <nav class="mt-4">
                                <ul class="pagination justify-content-center" id="tagPagination"></ul>
                            </nav>

                            <aside class="wrapper__list__article mb-0">

                                <?php if (empty($selectedTagData)): ?>

                                    <div class="alert alert-info mb-0">
                                        Silakan pilih tag terlebih dahulu untuk melihat daftar artikel.
                                    </div>

                                <?php else: ?>

                                    <h4 class="border_section">
                                        #<?= htmlspecialchars($selectedTagData['tag_name']); ?>
                                    </h4>

                                    <div class="row">

                                        <?php foreach ($tagPosts as $post): ?>

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
                                <!-- Pagination Detail Tags -->
                                <nav aria-label="tags pagination" class="mt-4">

                                    <ul
                                        class="pagination justify-content-center d-flex flex-row"
                                        id="detailTagPagination">

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
            const ul = document.getElementById('detailTagPagination');

            if (!ul || totalPostPages <= 1) return;

            let html = '';

            html += `
    <li class="page-item ${currentPostPage == 1 ? 'disabled':''}">
        <a class="page-link"
           href="tags=<?= urlencode($selectedTag) ?>?tag_page=<?= $tagPage ?>&tag_page=<?= $tagPage ?>&page=${currentPostPage-1}">
            <i class="fa fa-angle-left"></i>
        </a>
    </li>`;

           let start = 1;
let end = totalPostPages;

            if (start > 1) {
                html += `
        <li class="page-item">
            <a class="page-link"
               href="tags=<?= urlencode($selectedTag) ?>?tag_page=<?= $tagPage ?>&tag_page=<?= $tagPage ?>&page=1">
               1
            </a>
        </li>`;

                if (start > 2) {
                    html += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>`;
                }
            }

            for (let i = start; i <= end; i++) {
                html += `
        <li class="page-item ${i==currentPostPage?'active':''}">
            <a class="page-link"
               href="tags=<?= urlencode($selectedTag) ?>?tag_page=<?= $tagPage ?>&tag_page=<?= $tagPage ?>&page=${i}">
                ${i}
            </a>
        </li>`;
            }

            if (end < totalPostPages) {
                if (end < totalPostPages - 1) {
                    html += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>`;
                }

                html += `
        <li class="page-item">
            <a class="page-link"
               href="tags=<?= urlencode($selectedTag) ?>?tag_page=<?= $tagPage ?>&tag_page=<?= $tagPage ?>&page=${totalPostPages}">
                ${totalPostPages}
            </a>
        </li>`;
            }

            html += `
    <li class="page-item ${currentPostPage == totalPostPages ? 'disabled':''}">
        <a class="page-link"
           href="tags=<?= urlencode($selectedTag) ?>?tag_page=<?= $tagPage ?>&tag_page=<?= $tagPage ?>&page=${currentPostPage+1}">
            <i class="fa fa-angle-right"></i>
        </a>
    </li>`;

            ul.innerHTML = html;
        }

        renderDetailPagination();
    </script>

    <script>
        const currentTagPage = <?= $tagPage ?>;
        const totalTagPages = <?= $totalTagPages ?>;
        const selectedTag = "<?= urlencode($selectedTag) ?>";

        function renderTagPagination() {
            const ul = document.getElementById('tagPagination');

            if (!ul || totalTagPages <= 1) return;

            let html = '';

            html += `
    <li class="page-item ${currentTagPage == 1 ? 'disabled':''}">
        <a class="page-link"
           href="tags=${selectedTag}?tag_page=${currentTagPage-1}">
            <i class="fa fa-angle-left"></i>
        </a>
    </li>`;

            let start = Math.max(1, currentTagPage - 2);
            let end = Math.min(totalTagPages, currentTagPage + 2);

            if (start > 1) {
                html += `
        <li class="page-item">
            <a class="page-link"
               href="tags=${selectedTag}?tag_page=1">
               1
            </a>
        </li>`;

                if (start > 2) {
                    html += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>`;
                }
            }

            for (let i = start; i <= end; i++) {
                html += `
        <li class="page-item ${i==currentTagPage?'active':''}">
            <a class="page-link"
               href="tags=${selectedTag}?tag_page=${i}">
                ${i}
            </a>
        </li>`;
            }

            if (end < totalTagPages) {
                if (end < totalTagPages - 1) {
                    html += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>`;
                }

                html += `
        <li class="page-item">
            <a class="page-link"
               href="tags=${selectedTag}?tag_page=${totalTagPages}">
                ${totalTagPages}
            </a>
        </li>`;
            }

            html += `
    <li class="page-item ${currentTagPage == totalTagPages ? 'disabled':''}">
        <a class="page-link"
           href="tags=${selectedTag}?tag_page=${currentTagPage+1}">
            <i class="fa fa-angle-right"></i>
        </a>
    </li>`;

            ul.innerHTML = html;
        }

        renderTagPagination();
    </script>

</body>

</html>