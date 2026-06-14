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
| REDAKSI DETAIL
|--------------------------------------------------------------------------
*/

$slug = mysqli_real_escape_string(
    $conn,
    $_GET['slug'] ?? ''
);

if (empty($slug)) {
    header('Location: redaksi.php');
    exit;
}

$queryAuthor = mysqli_query($conn, "
    SELECT
        u.id AS user_id,
        u.role_id,
        u.email,

        r.role_name,

        up.full_name,
        up.birth_place,
        up.date_birth,
        up.gender,
        up.marital_status,
        up.address,
        up.phone_number,
        up.linkedin,
        up.instagram,
        up.photo_profile,
        up.slug

    FROM user_profile up

    INNER JOIN users u
        ON u.id = up.user_id

    LEFT JOIN roles r
        ON r.id = u.role_id

   WHERE
    up.slug = '{$slug}'
    AND u.account_status = 'Active'

    LIMIT 1
");

if (mysqli_num_rows($queryAuthor) == 0) {
    header("HTTP/1.0 404 Not Found");
    exit('Redaksi tidak ditemukan');
}

$author = mysqli_fetch_assoc($queryAuthor);

/*
|--------------------------------------------------------------------------
| FOTO PROFIL
|--------------------------------------------------------------------------
*/

if (
    !empty($author['photo_profile']) &&
    file_exists(
        __DIR__ .
            '/dashboard/assets/images/uploads/user_photos/' .
            $author['photo_profile']
    )
) {

    $authorPhoto =
        'dashboard/assets/images/uploads/user_photos/' .
        $author['photo_profile'];
} else {

    $authorPhoto =
        ($author['gender'] == 'Perempuan')
        ? 'dashboard/assets/images/avatar/avatar-women.png'
        : 'dashboard/assets/images/avatar/avatar-men.png';
}

$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 10;
$offset = ($page - 1) * $limit;

/*
|--------------------------------------------------------------------------
| TOTAL POST
|--------------------------------------------------------------------------
*/
$totalPostQuery = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM post
    WHERE
        user_id = {$author['user_id']}
        AND status = 'publish'
");

$totalPost = mysqli_fetch_assoc($totalPostQuery)['total'];
$totalPages = ceil($totalPost / $limit);

/*
|--------------------------------------------------------------------------
| TAB BERITA BARU & TERPOPULER
|--------------------------------------------------------------------------
*/
$tab = $_GET['tab'] ?? 'terbaru';

$orderBy = "p.created_at DESC";

if ($tab == 'terpopuler') {

    $orderBy = "
        (
            SELECT COUNT(*)
            FROM post_views pv
            WHERE pv.post_id = p.id
        ) DESC,
        p.created_at DESC
    ";
}

/*
|--------------------------------------------------------------------------
| AMBIL POSTINGAN BERDASARKAN AUTHOR
|--------------------------------------------------------------------------
*/
$queryNews = mysqli_query($conn, "
    SELECT
        p.*,
        pc.name_category,
        pc.slug AS category_slug

    FROM post p

    LEFT JOIN post_category pc
        ON pc.id = p.post_category_id

    WHERE
        p.user_id = {$author['user_id']}
        AND p.status = 'publish'

    ORDER BY {$orderBy}

    LIMIT {$limit}
    OFFSET {$offset}
");

/*
|--------------------------------------------------------------------------
| REDAKSI LAINNYA
|--------------------------------------------------------------------------
*/
$queryOthers = mysqli_query($conn, "
    SELECT
        u.id,
        r.role_name,

        up.full_name,
        up.slug,
        up.gender,
        up.photo_profile

    FROM users u

    INNER JOIN user_profile up
        ON up.user_id = u.id

    LEFT JOIN roles r
        ON r.id = u.role_id

    WHERE
        u.account_status = 'Active'
        AND up.slug <> '{$slug}'

    ORDER BY RAND()

    LIMIT 8
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>
        <?= htmlspecialchars($author['full_name']); ?> - <?= htmlspecialchars($author['role_name']); ?> | Hukuminfo.id
    </title>

    <meta name="description"
        content="Profil <?= htmlspecialchars($author['full_name']); ?> sebagai <?= htmlspecialchars($author['role_name']); ?> di Hukuminfo.id.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- favicon.ico in the root directory -->
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

    <!-- Swiper -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

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

            <!-- Breadcrumb -->
            <div class="mb-4">
                <a href="redaksi">Redaksi</a>
                <span class="mx-2">›</span>
                <strong>Detail</strong>
            </div>

            <div class="row">

                <!-- PROFIL REDAKSI -->
                <div class="col-lg-3 mb-4">

                    <div class="redaksi-profile">

                        <div class="redaksi-cover"></div>

                        <div class="text-center redaksi-content">

                            <img src="<?= $authorPhoto; ?>"
                                class="redaksi-avatar"
                                alt="<?= htmlspecialchars($author['full_name']); ?>">

                            <h4 class="redaksi-name">
                                <?= htmlspecialchars($author['full_name']); ?>
                            </h4>

                            <span class="redaksi-role">
                                <?= htmlspecialchars($author['role_name']); ?>
                            </span>

                            <p class="redaksi-company">
                                Hukuminfo.id
                            </p>

                        </div>

                    </div>

                </div>

                <!-- BERITA REDAKSI -->
                <div class="col-lg-9">

                    <!-- Tab -->
                    <div class="mb-4">

                        <a href="redaksi=<?= urlencode($author['slug']); ?>&tab=terbaru"
                            class="btn-redaksi <?= $tab == 'terbaru' ? 'active' : ''; ?>">
                            Terbaru
                        </a>

                        <a href="redaksi=<?= urlencode($author['slug']); ?>&tab=terpopuler"
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
                                                '/dashboard/assets/images/uploads/posts/' .
                                                $news['post_image']
                                        )
                                    ) {

                                        $postImage =
                                            'dashboard/assets/images/uploads/posts/' .
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

                                                                        <?= htmlspecialchars($author['full_name']); ?>

                                                                    </span>

                                                                </li>

                                                                <li class="list-inline-item">

                                                                    <span class="text-dark text-capitalize">

                                                                        <?= tanggalIndonesia($news['created_at']); ?>

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
                                    Penulis ini belum memiliki artikel.
                                </div>

                            <?php endif; ?>

                        </div>
                        <div class="mx-auto">
                            <!-- Pagination -->
                            <?php if ($totalPages > 1): ?>

                                <div class="pagination-area">

                                    <div class="pagination">

                                        <?php if ($page > 1): ?>

                                            <a href="redaksi=<?= urlencode($author['slug']); ?>&tab=<?= $tab; ?>&page=<?= ($page - 1); ?>">
                                                <i class="fa fa-angle-left"></i>
                                            </a>

                                        <?php endif; ?>

                                        <?php

                                        $start = max(1, $page - 2);
                                        $end   = min($totalPages, $page + 2);

                                        if ($start > 1) {
                                            echo '<a href="redaksi=' . urlencode($author['slug']) . '&tab=' . $tab . '&page=1">1</a>';

                                            if ($start > 2) {
                                                echo '<span class="mx-2">...</span>';
                                            }
                                        }

                                        for ($i = $start; $i <= $end; $i++):

                                        ?>

                                            <a
                                                class="<?= ($i == $page ? 'active' : ''); ?>"
                                                href="redaksi=<?= urlencode($author['slug']); ?>&tab=<?= $tab; ?>&page=<?= $i; ?>">
                                                <?= $i; ?>
                                            </a>

                                        <?php endfor; ?>

                                        <?php

                                        if ($end < $totalPages) {

                                            if ($end < ($totalPages - 1)) {
                                                echo '<span class="mx-2">...</span>';
                                            }

                                            echo '<a href="redaksi=' . urlencode($author['slug']) . '&tab=' . $tab . '&page=' . $totalPages . '">' . $totalPages . '</a>';
                                        }

                                        ?>

                                        <?php if ($page < $totalPages): ?>

                                            <a href="redaksi=<?= urlencode($author['slug']); ?>&tab=<?= $tab; ?>&page=<?= ($page + 1); ?>">
                                                <i class="fa fa-angle-right"></i>
                                            </a>

                                        <?php endif; ?>

                                    </div>

                                </div>

                            <?php endif; ?>
                        </div>
                    </aside>
                </div>

            </div>

            <!-- REDAKSI LAINNYA -->
            <div class="mt-5">

                <h2 class="mb-4">
                    Redaksi Lainnya
                </h2>

                <div class="swiper redaksiSwiper">

                    <div class="swiper-wrapper">

                        <?php while ($other = mysqli_fetch_assoc($queryOthers)): ?>

                            <?php

                            if (
                                !empty($other['photo_profile']) &&
                                file_exists(
                                    __DIR__ .
                                        '/dashboard/assets/images/uploads/user_photos/' .
                                        $other['photo_profile']
                                )
                            ) {

                                $otherPhoto =
                                    'dashboard/assets/images/uploads/user_photos/' .
                                    $other['photo_profile'];
                            } else {

                                $otherPhoto =
                                    ($other['gender'] == 'Perempuan')
                                    ? 'dashboard/assets/images/avatar/avatar-women.png'
                                    : 'dashboard/assets/images/avatar/avatar-men.png';
                            }

                            ?>

                            <div class="swiper-slide">

                                <a href="redaksi=<?= urlencode($other['slug']); ?>"
                                    class="text-decoration-none">

                                    <div class="redaksi-card">

                                        <img src="<?= $otherPhoto; ?>"
                                            class="redaksi-card-photo"
                                            alt="<?= htmlspecialchars($other['full_name']); ?>">

                                        <span class="redaksi-card-role">
                                            <?= htmlspecialchars($other['role_name']); ?>
                                        </span>

                                        <h5>
                                            <?= htmlspecialchars($other['full_name']); ?>
                                        </h5>

                                    </div>

                                </a>

                            </div>

                        <?php endwhile; ?>

                    </div>

                    <div class="swiper-button-prev redaksi-prev"></div>
                    <div class="swiper-button-next redaksi-next"></div>

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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        new Swiper('.redaksiSwiper', {

            slidesPerView: 4,
            spaceBetween: 20,

            grabCursor: true,

            navigation: {
                nextEl: '.redaksi-next',
                prevEl: '.redaksi-prev'
            },

            breakpoints: {

                0: {
                    slidesPerView: 1.3
                },

                576: {
                    slidesPerView: 2
                },

                768: {
                    slidesPerView: 3
                },

                1200: {
                    slidesPerView: 4
                }
            }
        });
    </script>

</body>

</html>