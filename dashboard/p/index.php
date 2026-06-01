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

<body>

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

                    <!-- Berita Terpopuler -->
                    <div class="col-lg-6 mb-4">
                        <div class="news-card">
                            <div class="news-card-header">
                                Berita Terpopuler
                            </div>

                            <ul class="news-list">

                                <?php for ($i = 1; $i <= 7; $i++): ?>
                                    <li class="news-item">
                                        <a href="#" class="news-link">
                                            <div class="news-number">
                                                <?= $i ?>
                                            </div>

                                            <img src="https://picsum.photos/120/80?random=<?= $i ?>"
                                                class="news-thumb"
                                                alt="">

                                            <div class="news-title">
                                                Judul Berita Terpopuler <?= $i ?> yang sedang ramai dibaca masyarakat Indonesia
                                            </div>
                                        </a>
                                    </li>
                                <?php endfor; ?>

                            </ul>
                        </div>
                    </div>

                    <!-- Berita Terbaru -->
                    <div class="col-lg-6 mb-4">
                        <div class="news-card">
                            <div class="news-card-header">
                                Berita Terbaru
                            </div>

                            <ul class="news-list">

                                <?php for ($i = 1; $i <= 7; $i++): ?>
                                    <li class="news-item">
                                        <a href="#" class="news-link">

                                            <img src="https://picsum.photos/120/80?random=<?= $i + 10 ?>"
                                                class="news-thumb"
                                                alt="">

                                            <div class="news-title">
                                                Judul Berita Terbaru <?= $i ?> yang baru saja dipublikasikan hari ini
                                            </div>
                                        </a>
                                    </li>
                                <?php endfor; ?>

                            </ul>
                        </div>
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