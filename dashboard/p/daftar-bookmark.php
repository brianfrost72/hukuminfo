<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
        content="">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daftar Bookmark - Konig Guard Bureau</title>

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
    <link type="text/css"
        href="assets/css/vendor-fontawesome-free.css"
        rel="stylesheet">
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
                                <li class="breadcrumb-item active"
                                    aria-current="page">Daftar Bookmark</li>
                            </ol>
                        </nav>
                        <h1 class="m-0">Daftar Bookmark</h1>
                    </div>
                </div>
            </div>

            <div class="container page__container">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Daftar Bookmark</h4>
                    </div>

                    <div class="card-body">

                        <!-- Show Entries + Search -->
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">Show</span>
                                    <select class="form-control form-control-sm"
                                        style="width:80px;">
                                        <option>10</option>
                                        <option>25</option>
                                        <option>50</option>
                                        <option>100</option>
                                    </select>
                                    <span class="ml-2">entries</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control float-right"
                                    placeholder="Cari judul postingan...">
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="70">No</th>
                                        <th width="90">Foto</th>
                                        <th>Judul Postingan</th>
                                        <th width="180">Tanggal Bookmark</th>
                                        <th width="120" class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td>1</td>

                                        <td>
                                            <img src=""
                                                class="rounded"
                                                width="70"
                                                height="50"
                                                style="object-fit:cover;">
                                        </td>

                                        <td>
                                            Perubahan Undang-Undang ITE Tahun 2025 dan Dampaknya
                                        </td>

                                        <td>01 Juni 2026</td>

                                        <td class="text-center">
                                            <a href="#"
                                                class="btn btn-primary btn-sm"
                                                title="Lihat Postingan">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>

                                        <td>
                                            <img src=""
                                                class="rounded"
                                                width="70"
                                                height="50"
                                                style="object-fit:cover;">
                                        </td>

                                        <td>
                                            Panduan Lengkap Gugatan Perdata di Pengadilan Negeri
                                        </td>

                                        <td>30 Mei 2026</td>

                                        <td class="text-center">
                                            <a href="#"
                                                class="btn btn-primary btn-sm"
                                                title="Lihat Postingan">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <!-- Footer -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <nav>
                                    <ul class="pagination justify-content-end mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#">Previous</a>
                                        </li>

                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
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