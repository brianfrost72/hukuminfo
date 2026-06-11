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

$q = trim($_GET['q'] ?? '');

$qEscaped = mysqli_real_escape_string($conn, $q);

/* 
|---------------------------------------------------------------------------
| PAGINATION
|---------------------------------------------------------------------------
*/
$perPage = 10;

$page = isset($_GET['page'])
    ? max(1, (int)$_GET['page'])
    : 1;

$offset = ($page - 1) * $perPage;

// HITUNG SEMUA ARTIKEL
$countQuery = mysqli_query($conn, "
    SELECT COUNT(DISTINCT p.id) AS total

    FROM post p

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    LEFT JOIN users u
        ON u.id = p.user_id

    LEFT JOIN user_profile up
        ON up.user_id = u.id

    LEFT JOIN post_tags pt
        ON pt.post_id = p.id

    LEFT JOIN tags t
        ON t.id = pt.tag_id

    WHERE p.status='publish'
    AND (
        p.post_title LIKE '%$qEscaped%'
        OR p.post_sub_title LIKE '%$qEscaped%'
        OR p.post_desc LIKE '%$qEscaped%'
        OR pc.name_category LIKE '%$qEscaped%'
        OR up.full_name LIKE '%$qEscaped%'
        OR t.tag_name LIKE '%$qEscaped%'
    )
");

$totalResult =
    mysqli_fetch_assoc($countQuery)['total'];

$totalPages =
    ceil($totalResult / $perPage);

// UBAH SEMUA SEARCH
$searchQuery = mysqli_query($conn, "
    SELECT
        p.*,
        pc.name_category,

        COALESCE(
            up.full_name,
            'Administrator'
        ) AS author_name

    FROM post p

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    LEFT JOIN users u
        ON u.id = p.user_id

    LEFT JOIN user_profile up
        ON up.user_id = u.id

    WHERE p.status='publish'
    AND (
        p.post_title LIKE '%$qEscaped%'
        OR p.post_sub_title LIKE '%$qEscaped%'
        OR p.post_desc LIKE '%$qEscaped%'
    )

    ORDER BY p.created_at DESC

    LIMIT $offset,$perPage
");

/* 
|---------------------------------------------------------------------------
| QUERY
|---------------------------------------------------------------------------
*/

$searchQuery = mysqli_query($conn, "
    SELECT DISTINCT

        p.*,

        pc.name_category,

        COALESCE(
            up.full_name,
            'Administrator'
        ) AS author_name

    FROM post p

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    LEFT JOIN users u
        ON u.id = p.user_id

    LEFT JOIN user_profile up
        ON up.user_id = u.id

    LEFT JOIN post_tags pt
        ON pt.post_id = p.id

    LEFT JOIN tags t
        ON t.id = pt.tag_id

    WHERE p.status='publish'
    AND (
        p.post_title LIKE '%$qEscaped%'
        OR p.post_sub_title LIKE '%$qEscaped%'
        OR p.post_desc LIKE '%$qEscaped%'
        OR pc.name_category LIKE '%$qEscaped%'
        OR up.full_name LIKE '%$qEscaped%'
        OR t.tag_name LIKE '%$qEscaped%'
    )

    ORDER BY p.created_at DESC

    LIMIT $offset,$perPage
");

$totalResult = mysqli_num_rows($searchQuery);

/* 
|---------------------------------------------------------------------------
| AUTHOR SEARCH
|---------------------------------------------------------------------------
*/
$authorCheck = mysqli_query($conn, "
    SELECT *
    FROM user_profile
    WHERE full_name LIKE '%$qEscaped%'
    LIMIT 1
");

$isAuthorSearch =
    mysqli_num_rows($authorCheck) > 0;

/* 
|---------------------------------------------------------------------------
| ADVERTISMENT
|---------------------------------------------------------------------------
*/
$adsResult = mysqli_query($conn, "
    SELECT *
    FROM ads
    ORDER BY RAND()
");

$adsData = [];

while ($ad = mysqli_fetch_assoc($adsResult)) {
    $adsData[] = $ad;
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title><?= !empty($q) ? 'Pencarian: ' . htmlspecialchars($q) : 'Pencarian'; ?> — Hukuminfo.id</title>
    <meta name="description" content="Hasil pencarian artikel untuk <?= htmlspecialchars($q); ?> di Hukuminfo.id">
    <meta
        property="og:title"
        content="Pencarian: <?= htmlspecialchars($q); ?> — Hukuminfo.id">
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
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <!-- Search result -->
                    <div class="wrap__search-result">
                        <div class="wrap__search-result-keyword">
                            <h5>

                                Hasil pencarian untuk:

                                <span class="text-primary">

                                    "<?= htmlspecialchars($q); ?>"

                                </span>

                                ditemukan

                                <strong>
                                    <?= number_format($totalResult); ?>
                                </strong>

                                artikel.

                            </h5>
                        </div>

                        <!-- Post Article List -->
                        <?php if ($totalResult > 0): ?>

                            <?php while ($row = mysqli_fetch_assoc($searchQuery)): ?>

                                <div class="card__post card__post-list card__post__transition mt-30">

                                    <div class="row">

                                        <div class="col-md-5">

                                            <div class="card__post__transition">

                                                <a href="artikel-detail.php?slug=<?= $row['slug']; ?>">

                                                    <img
                                                        src="dashboard/assets/images/uploads/posts/<?= htmlspecialchars($row['post_image']); ?>"
                                                        class="img-fluid w-100"
                                                        alt="<?= htmlspecialchars($row['post_title']); ?>">

                                                </a>

                                            </div>

                                        </div>

                                        <div class="col-md-7 my-auto pl-0">

                                            <div class="card__post__body">

                                                <div class="card__post__content">

                                                    <div class="card__post__category">

                                                        <?= htmlspecialchars($row['name_category']); ?>

                                                    </div>

                                                    <div class="card__post__author-info mb-2">

                                                        <ul class="list-inline">

                                                            <li class="list-inline-item">

                                                                <span class="text-primary">

                                                                    by <?= htmlspecialchars($row['author_name']); ?>

                                                                </span>

                                                            </li>

                                                            <li class="list-inline-item">

                                                                <span class="text-dark">

                                                                    <?= tanggalIndonesia($row['created_at']); ?>

                                                                </span>

                                                            </li>

                                                        </ul>

                                                    </div>

                                                    <div class="card__post__title">

                                                        <h5>

                                                            <a href="artikel-detail.php?slug=<?= $row['slug']; ?>">

                                                                <?= htmlspecialchars($row['post_title']); ?>

                                                            </a>

                                                        </h5>

                                                        <p>

                                                            <?= mb_substr(
                                                                strip_tags($row['post_desc']),
                                                                0,
                                                                180
                                                            ); ?>...

                                                        </p>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            <?php endwhile; ?>

                        <?php else: ?>

                            <?php if ($isAuthorSearch): ?>

                                <div class="alert alert-info mt-4">

                                    Penulis

                                    <strong>
                                        <?= htmlspecialchars($q); ?>
                                    </strong>

                                    belum menulis artikel.

                                </div>

                            <?php else: ?>

                                <div class="alert alert-warning mt-4">

                                    Tidak ditemukan artikel untuk kata kunci:

                                    <strong>
                                        <?= htmlspecialchars($q); ?>
                                    </strong>

                                </div>

                            <?php endif; ?>

                        <?php endif; ?>
                    </div>

                    <!-- pagination -->
                    <div class="mt-4">
                        <!-- Pagination -->
                        <div class="pagination-area">
                            <?php if ($totalPages > 1): ?>

                                <div class="pagination wow fadeIn animated">

                                    <!-- PREV -->

                                    <?php if ($page > 1): ?>

                                        <a href="?q=<?= urlencode($q); ?>&page=<?= $page - 1; ?>">

                                            <i class="fa fa-angle-left"></i>

                                        </a>

                                    <?php endif; ?>

                                    <?php

                                    $start = max(1, $page - 2);
                                    $end   = min($totalPages, $page + 2);

                                    ?>

                                    <!-- PAGE 1 -->

                                    <?php if ($start > 1): ?>

                                        <a href="?q=<?= urlencode($q); ?>&page=1">

                                            1

                                        </a>

                                        <?php if ($start > 2): ?>

                                            <span class="mx-2">...</span>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                    <!-- PAGE RANGE -->

                                    <?php for ($i = $start; $i <= $end; $i++): ?>

                                        <a
                                            href="?q=<?= urlencode($q); ?>&page=<?= $i; ?>"
                                            class="<?= $i == $page ? 'active' : ''; ?>">

                                            <?= $i; ?>

                                        </a>

                                    <?php endfor; ?>

                                    <!-- LAST PAGE -->

                                    <?php if ($end < $totalPages): ?>

                                        <?php if ($end < $totalPages - 1): ?>

                                            <span class="mx-2">...</span>

                                        <?php endif; ?>

                                        <a href="?q=<?= urlencode($q); ?>&page=<?= $totalPages; ?>">

                                            <?= $totalPages; ?>

                                        </a>

                                    <?php endif; ?>

                                    <!-- NEXT -->

                                    <?php if ($page < $totalPages): ?>

                                        <a href="?q=<?= urlencode($q); ?>&page=<?= $page + 1; ?>">

                                            <i class="fa fa-angle-right"></i>

                                        </a>

                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>
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
        const ads = <?= json_encode($adsData); ?>;

        let usedAds = [];
        let currentIndex = 0;

        function getUniqueAd() {

            if (usedAds.length >= ads.length) {
                usedAds = [];
            }

            let ad;

            do {
                ad = ads[currentIndex % ads.length];
                currentIndex++;
            }
            while (
                usedAds.includes(ad.id) &&
                usedAds.length < ads.length
            );

            usedAds.push(ad.id);

            return ad;
        }

        function renderAd(slotId) {

            const slot = document.getElementById(slotId);

            const ad = getUniqueAd();

            slot.innerHTML = `
        <button class="ad-close">&times;</button>

        <a href="${ad.ad_link}" target="_blank">

            <img src="dashboard/assets/images/uploads/ads/${ad.ad_img}"
                 alt="${ad.ad_title}">

        </a>
    `;

            slot.style.display = 'block';

            slot.querySelector('.ad-close')
                .addEventListener('click', function() {

                    slot.style.display = 'none';

                    setTimeout(() => {

                        renderAd(slotId);

                    }, 120000); // 2 menit
                });
        }

        renderAd('ad-slot-1');

        setTimeout(() => {
            renderAd('ad-slot-2');
        }, 30000);

        setTimeout(() => {
            renderAd('ad-slot-3');
        }, 60000);

        setTimeout(() => {
            renderAd('ad-slot-4');
        }, 90000);
    </script>
</body>

</html>