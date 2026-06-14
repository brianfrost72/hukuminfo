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
| REDAKSI
|--------------------------------------------------------------------------
*/

$redaksi = [];

$queryRedaksi = mysqli_query($conn, "
    SELECT
    u.id,
    u.role_id,
    u.account_status,
    r.id AS role_order,
    r.role_name,
    up.full_name,
    up.slug,
    up.gender,
    up.photo_profile

    FROM users u
    INNER JOIN roles r
        ON r.id = u.role_id

    INNER JOIN user_profile up
        ON up.user_id = u.id

    WHERE
        u.account_status = 'Active'

    ORDER BY
        r.id ASC,
        up.full_name ASC
");

while ($row = mysqli_fetch_assoc($queryRedaksi)) {

    $photo = '';

    if (
        !empty($row['photo_profile']) &&
        file_exists(
            __DIR__ .
                '/dashboard/assets/images/uploads/user_photos/' .
                $row['photo_profile']
        )
    ) {

        $photo =
            'dashboard/assets/images/uploads/user_photos/' .
            $row['photo_profile'];
    } else {

        if ($row['gender'] == 'Perempuan') {

            $photo =
                'dashboard/assets/images/avatar/avatar-women.png';
        } else {

            $photo =
                'dashboard/assets/images/avatar/avatar-men.png';
        }
    }

    $row['photo'] = $photo;

    $redaksi[$row['role_name']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>
        Redaksi | Hukuminfo.id - Media Informasi dan Edukasi Tentang Hukum
    </title>

    <meta name="description"
        content="Susunan redaksi Hukuminfo.id yang terdiri dari pembina, pemimpin redaksi, redaktur, reporter, fotografer, editor, dan tim manajemen media. Kenali jajaran pengelola serta penanggung jawab pemberitaan Hukuminfo.id.">

    <meta name="keywords"
        content="redaksi hukuminfo, susunan redaksi, tim redaksi, pemimpin redaksi, reporter hukum, media hukum indonesia, dewan redaksi, hukuminfo.id">

    <meta name="author" content="Hukuminfo.id">

    <meta name="robots" content="index, follow">

    <link rel="canonical" href="https://hukuminfo.id/redaksi">
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

                <!-- CONTENT -->
                <div class="col-lg-8">

                    <div class="position-relative mb-4">

                        <img src="images/banner/bg.png"
                            class="img-fluid w-100"
                            alt="Redaksi"
                            style="height:250px; width:100%; object-fit:cover; border-radius: 10px;">

                        <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center"
                            style="top:0;left:0;">

                            <h2 class="text-white text-center mb-0">
                                Redaksi
                            </h2>

                        </div>

                    </div>

                    <p>
                        Susunan redaksi dan manajemen Hukuminfo.id.
                    </p>

                    <?php if (!empty($redaksi)): ?>

                        <?php foreach ($redaksi as $roleName => $members): ?>

                            <details class="mb-3">

                                <summary>
                                    <strong><?= htmlspecialchars($roleName); ?></strong>
                                </summary>

                                <?php if (count($members) == 1): ?>

                                    <?php $member = $members[0]; ?>

                                    <div class="mt-3">

                                        <a href="redaksi/<?= urlencode($member['slug']); ?>"
                                            class="text-dark text-decoration-none">


                                            <div class="media">

                                                <img src="<?= $member['photo']; ?>"
                                                    class="rounded-circle mr-3"
                                                    width="80"
                                                    height="80"
                                                    style="object-fit:cover;"
                                                    alt="<?= htmlspecialchars($member['full_name']); ?>">

                                                <div>

                                                    <h5 class="mb-1">
                                                        <?= htmlspecialchars($member['full_name']); ?>
                                                    </h5>

                                                    <p class="mb-0">
                                                        <?= htmlspecialchars($roleName); ?>
                                                    </p>

                                                </div>

                                            </div>

                                        </a>

                                    </div>

                                <?php else: ?>

                                    <div class="row mt-3">

                                        <?php foreach ($members as $member): ?>

                                            <div class="col-lg-4 col-md-4 col-6 mb-3">

                                                <a href="redaksi=<?= urlencode($member['slug']); ?>"
                                                    class="text-decoration-none text-dark">

                                                    <div class="text-center">

                                                        <img src="<?= $member['photo']; ?>"
                                                            class="rounded-circle mb-2"
                                                            width="90"
                                                            height="90"
                                                            style="object-fit:cover;"
                                                            alt="<?= htmlspecialchars($member['full_name']); ?>">

                                                        <h6 class="mb-1">
                                                            <?= htmlspecialchars($member['full_name']); ?>
                                                        </h6>

                                                        <small class="text-muted">
                                                            <?= htmlspecialchars($roleName); ?>
                                                        </small>

                                                    </div>

                                                </a>

                                            </div>

                                        <?php endforeach; ?>

                                    </div>

                                <?php endif; ?>

                            </details>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="alert alert-warning">
                            Belum ada data redaksi.
                        </div>

                    <?php endif; ?>

                    <hr>

                    <h4>Alamat Redaksi</h4>

                    <p>
                        Puri Botanical Residence Blok H9 No.11, Jakarta - Indonesia.
                    </p>

                    <h4>Email Redaksi</h4>

                    <p>
                        <a href="mailto:redaksi@hukuminfo.id">
                            redaksi@hukuminfo.id
                        </a>
                    </p>

                </div>

                <!-- SIDEBAR -->
                <div class="col-lg-4">

                    <div class="sticky-top" style="top:170px;">

                        <div class="card">
                            <div class="card-body">
                                <?php
                               $current_page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
                                ?>

                                <h4 class="mb-3">Informasi</h4>

                                <ul class="list-group">

                                    <li class="list-group-item">
                                        <a href="tentang-kami">
                                            <?php if ($current_page == 'tentang-kami'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Tentang Kami
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="redaksi">
                                            <?php if ($current_page == 'redaksi'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Redaksi
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="pedoman-media-siber">
                                            <?php if ($current_page == 'pedoman-media-siber'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Pedoman Media Siber
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="disclaimer">
                                            <?php if ($current_page == 'disclaimer'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Disclaimer
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="terms-of-service">
                                            <?php if ($current_page == 'terms-of-service'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Terms of Service
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="privacy-policy">
                                            <?php if ($current_page == 'privacy-policy'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Kebijakan Privasi
                                        </a>
                                    </li>

                                </ul>

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

</body>
</html>