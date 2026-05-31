<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Kebijakan Privasi - Hukuminfo.id</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="icon.png">

    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <link href="./css/styles.css?537a1bbd0e5129401d28" rel="stylesheet">

    <style>
        /* =========================
   REDAKSI DETAIL
========================= */

        .redaksi-profile {
            background: #d09e44;
            border-radius: 20px;
            overflow: hidden;
            color: #fff;
            padding-bottom: 30px;
        }

        .redaksi-cover {
            height: 120px;
            background: linear-gradient(135deg, #cc0000, #8b0000);
        }

        .redaksi-content {
            padding: 0 20px 30px;
            text-align: center;
        }

        .redaksi-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #fff;
            object-fit: cover;
            margin-top: -60px;
            background: #fff;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .redaksi-name {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .redaksi-role {
            display: inline-block;
            background: #cc0000;
            color: #fff;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .redaksi-company {
            color: #ffffff;
            margin: 0;
            font-size: 15px;
        }

        /* tab */

        .btn-redaksi {
            display: inline-block;
            padding: 12px 35px;
            border-radius: 40px;
            background: #e5e5e5;
            color: #333;
            font-weight: 700;
            margin-right: 10px;
        }

        .btn-redaksi:hover {
            text-decoration: none;
        }

        .btn-redaksi.active {
            background: #cc0000;
            color: #fff;
        }

        /* berita */

        .redaksi-news-item {
            margin-bottom: 30px;
        }

        .news-thumb {
            width: 100%;
            height: 110px;
            border-radius: 12px;
            object-fit: cover;
        }

        .news-category {
            color: #cc0000;
            font-weight: 700;
            font-size: 13px;
        }

        .news-title {
            font-size: 30px;
            line-height: 1.4;
        }

        .news-title a {
            color: #111;
        }

        .news-title a:hover {
            color: #cc0000;
        }

        /* redaksi lainnya */

        .redaksi-card {
            background: #fff;
            border-radius: 16px;
            padding: 25px 15px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .08);
            transition: .3s;
            height: 100%;
        }

        .redaksi-card:hover {
            transform: translateY(-5px);
        }

        .redaksi-card-photo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .redaksi-card-role {
            display: inline-block;
            background: #cc0000;
            color: #fff;
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .redaksi-card h5 {
            margin: 0;
            color: #222;
            font-size: 16px;
        }
    </style>
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
                <a href="redaksi.php">Redaksi</a>
                <span class="mx-2">›</span>
                <strong>Detail</strong>
            </div>

            <div class="row">

                <!-- PROFIL REDAKSI -->
                <div class="col-lg-3 mb-4">

                    <div class="redaksi-profile">

                        <div class="redaksi-cover"></div>

                        <div class="text-center redaksi-content">

                            <img src="images/avatar/default.png"
                                class="redaksi-avatar"
                                alt="Indira Utomo">

                            <h4 class="redaksi-name">
                                Indira Utomo
                            </h4>

                            <span class="redaksi-role">
                                Reporter
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

                        <a href="?tab=terbaru"
                            class="btn-redaksi active">
                            Terbaru
                        </a>

                        <a href="?tab=terpopuler"
                            class="btn-redaksi">
                            Terpopuler
                        </a>

                    </div>

                    <!-- Item Berita -->
                    <div class="redaksi-news-item">

                        <div class="row">

                            <div class="col-md-3">
                                <img src="images/placeholder/600x400.jpg"
                                    class="news-thumb"
                                    alt="">
                            </div>

                            <div class="col-md-9">

                                <div class="d-flex justify-content-between mb-2">

                                    <span class="news-category">
                                        Nasional
                                    </span>

                                    <small class="text-muted">
                                        23 hari lalu
                                    </small>

                                </div>

                                <h3 class="news-title">
                                    <a href="#">
                                        Silaturahmi Lewat Bulutangkis, Kakorlantas
                                        Ungkap Operasi Ketupat Berhasil karena
                                        Peran Media
                                    </a>
                                </h3>

                            </div>

                        </div>

                    </div>

                    <!-- Loop berita lainnya -->

                </div>

            </div>

            <!-- REDAKSI LAINNYA -->
            <div class="mt-5">

                <h2 class="mb-4">
                    Redaksi Lainnya
                </h2>

                <div class="row">

                    <?php for ($i = 1; $i <= 4; $i++): ?>

                        <div class="col-lg-3 col-md-4 col-6 mb-4">

                            <a href="#" class="text-decoration-none">

                                <div class="redaksi-card">

                                    <img src="images/avatar/default.png"
                                        class="redaksi-card-photo"
                                        alt="">

                                    <span class="redaksi-card-role">
                                        Reporter
                                    </span>

                                    <h5>
                                        Budi Santoso
                                    </h5>

                                </div>

                            </a>

                        </div>

                    <?php endfor; ?>

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
</body>

</html>