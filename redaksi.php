<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Redaksi - Hukuminfo.id</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
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

                    <!-- Pembina -->
                    <details class="mb-3">
                        <summary><strong>Pembina</strong></summary>
                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">
                                    <img src="images/redaksi/pembina.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80"
                                        alt="Pembina">

                                    <div>
                                        <h5 class="mb-1">Nama Pembina</h5>
                                        <p class="mb-0">Pembina</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <!-- Pemimpin Redaksi -->
                    <details class="mb-3">
                        <summary><strong>Pemimpin Redaksi</strong></summary>

                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">
                                    <img src="images/redaksi/pemred.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80"
                                        alt="Pemimpin Redaksi">

                                    <div>
                                        <h5 class="mb-1">Nama Pemimpin Redaksi</h5>
                                        <p class="mb-0">Pemimpin Redaksi</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <!-- Wakil Pemimpin Redaksi -->
                    <details class="mb-3">
                        <summary><strong>Wakil Pemimpin Redaksi</strong></summary>

                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">
                                    <img src="images/redaksi/wapemred.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80">

                                    <div>
                                        <h5 class="mb-1">Nama Wakil Pemimpin Redaksi</h5>
                                        <p class="mb-0">Wakil Pemimpin Redaksi</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <!-- KaDiv -->
                    <details class="mb-3">
                        <summary><strong>KaDiv Liputan Gathering</strong></summary>

                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">
                                    <img src="images/redaksi/kadiv.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80">

                                    <div>
                                        <h5 class="mb-1">Nama KaDiv</h5>
                                        <p class="mb-0">KaDiv Liputan Gathering</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <!-- Manager -->
                    <details class="mb-3">
                        <summary><strong>Manager Liputan Gathering Digital</strong></summary>

                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">
                                    <img src="images/redaksi/manager.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80">

                                    <div>
                                        <h5 class="mb-1">Nama Manager</h5>
                                        <p class="mb-0">Manager Liputan Gathering Digital</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <!-- Redaktur Pelaksana -->
                    <details class="mb-3">
                        <summary><strong>Redaktur Pelaksana</strong></summary>

                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">

                                    <img src="images/redaksi/redpel.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80">

                                    <div>
                                        <h5 class="mb-1">Nama Redpel</h5>
                                        <p class="mb-0">Redaktur Pelaksana</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <!-- Redaktur -->
                    <details class="mb-3">
                        <summary><strong>Redaktur</strong></summary>

                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">

                                    <img src="images/redaksi/redaktur.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80">

                                    <div>
                                        <h5 class="mb-1">Nama Redaktur</h5>
                                        <p class="mb-0">Redaktur</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <!-- Koordinator Liputan -->
                    <details class="mb-3">
                        <summary><strong>Koordinator Liputan</strong></summary>

                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">


                                    <img src="images/redaksi/korlip.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80">

                                    <div>
                                        <h5 class="mb-1">Nama Koordinator Liputan</h5>
                                        <p class="mb-0">Koordinator Liputan</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <!-- Reporter -->
                    <details class="mb-3">
                        <summary><strong>Reporter</strong></summary>

                        <div class="row mt-3">

                            <div class="col-md-4 col-6 mb-3">
                                <a href="redaksi-detail.php" class="text-decoration-none text-dark">
                                    <div class="text-center">
                                        <img src="images/redaksi/reporter1.jpg"
                                            class="rounded-circle mb-2"
                                            width="90"
                                            height="90"
                                            style="object-fit:cover;">
                                        <h6 class="mb-1">Nama Reporter 1</h6>
                                        <small class="text-muted">Reporter</small>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-6 mb-3">
                                <a href="redaksi-detail.php" class="text-decoration-none text-dark">
                                    <div class="text-center">
                                        <img src="images/redaksi/reporter2.jpg"
                                            class="rounded-circle mb-2"
                                            width="90"
                                            height="90"
                                            style="object-fit:cover;">
                                        <h6 class="mb-1">Nama Reporter 2</h6>
                                        <small class="text-muted">Reporter</small>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-6 mb-3">
                                <a href="redaksi-detail.php" class="text-decoration-none text-dark">
                                    <div class="text-center">
                                        <img src="images/redaksi/reporter3.jpg"
                                            class="rounded-circle mb-2"
                                            width="90"
                                            height="90"
                                            style="object-fit:cover;">
                                        <h6 class="mb-1">Nama Reporter 3</h6>
                                        <small class="text-muted">Reporter</small>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-6 mb-3">
                                <a href="redaksi-detail.php" class="text-decoration-none text-dark">
                                    <div class="text-center">
                                        <img src="images/redaksi/reporter4.jpg"
                                            class="rounded-circle mb-2"
                                            width="90"
                                            height="90"
                                            style="object-fit:cover;">
                                        <h6 class="mb-1">Nama Reporter 4</h6>
                                        <small class="text-muted">Reporter</small>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-6 mb-3">
                                <a href="redaksi-detail.php" class="text-decoration-none text-dark">
                                    <div class="text-center">
                                        <img src="images/redaksi/reporter5.jpg"
                                            class="rounded-circle mb-2"
                                            width="90"
                                            height="90"
                                            style="object-fit:cover;">
                                        <h6 class="mb-1">Nama Reporter 5</h6>
                                        <small class="text-muted">Reporter</small>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-6 mb-3">
                                <a href="redaksi-detail.php" class="text-decoration-none text-dark">
                                    <div class="text-center">
                                        <img src="images/redaksi/reporter6.jpg"
                                            class="rounded-circle mb-2"
                                            width="90"
                                            height="90"
                                            style="object-fit:cover;">
                                        <h6 class="mb-1">Nama Reporter 6</h6>
                                        <small class="text-muted">Reporter</small>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </details>

                    <!-- Fotografer -->
                    <details class="mb-3">
                        <summary><strong>Koordinator Fotografer</strong></summary>

                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">

                                    <img src="images/redaksi/fotografer.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80">

                                    <div>
                                        <h5 class="mb-1">Nama Koordinator Fotografer</h5>
                                        <p class="mb-0">Koordinator Fotografer</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <!-- Video Editor -->
                    <details class="mb-3">
                        <summary><strong>Video Editor</strong></summary>

                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">
                                    <img src="images/redaksi/editor.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80">

                                    <div>
                                        <h5 class="mb-1">Nama Video Editor</h5>
                                        <p class="mb-0">Video Editor</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <!-- Desainer -->
                    <details class="mb-4">
                        <summary><strong>Desainer Grafis</strong></summary>

                        <div class="mt-3">
                            <a href="redaksi-detail.php" class="text-dark text-decoration-none">
                                <div class="media">
                                    <img src="images/redaksi/desainer.jpg"
                                        class="rounded-circle mr-3"
                                        width="80"
                                        height="80">

                                    <div>
                                        <h5 class="mb-1">Nama Desainer</h5>
                                        <p class="mb-0">Desainer Grafis</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </details>

                    <hr>

                    <h4>Alamat Redaksi</h4>

                    <p>
                        Jl. Contoh No. 123, Jakarta Selatan, DKI Jakarta 12345
                    </p>

                    <h4>Email Redaksi</h4>

                    <p>
                        <a href="mailto:redaksi@retnews.id">
                            redaksi@retnews.id
                        </a>
                    </p>

                </div>

                <!-- SIDEBAR -->
                <div class="col-lg-4">

                    <div class="sticky-top" style="top:170px;">

                        <div class="card">
                            <div class="card-body">
                                <?php
                                $current_page = basename($_SERVER['PHP_SELF']);
                                ?>

                                <h4 class="mb-3">Informasi</h4>

                                <ul class="list-group">

                                    <li class="list-group-item">
                                        <a href="tentang-kami.php">
                                            <?php if ($current_page == 'tentang-kami.php'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Tentang Kami
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="redaksi.php">
                                            <?php if ($current_page == 'redaksi.php'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Redaksi
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="pedoman-media-siber.php">
                                            <?php if ($current_page == 'pedoman-media-siber.php'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Pedoman Media Siber
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="disclaimer.php">
                                            <?php if ($current_page == 'disclaimer.php'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Disclaimer
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="terms-of-service.php">
                                            <?php if ($current_page == 'terms-of-service.php'): ?>
                                                <i class="fa fa-angle-right mr-2"></i>
                                            <?php endif; ?>
                                            Terms of Service
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="privacy-policy.php">
                                            <?php if ($current_page == 'privacy-policy.php'): ?>
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
</body>

</html>