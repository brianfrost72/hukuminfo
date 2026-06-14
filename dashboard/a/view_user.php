<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>View User - Dashboard | Hukuminfo.id</title>
    
    <!-- favicon.ico in the root directory -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    <!-- Perfect Scrollbar -->
    <link
        type="text/css"
        href="../assets/vendor/perfect-scrollbar.css"
        rel="stylesheet" />

    <!-- App CSS -->
    <link type="text/css" href="../assets/css/app.css" rel="stylesheet" />

    <!-- Material Design Icons -->
    <link
        type="text/css"
        href="../assets/css/vendor-material-icons.css"
        rel="stylesheet" />

    <!-- Font Awesome FREE Icons -->
    <link
        type="text/css"
        href="../assets/css/vendor-fontawesome-free.css"
        rel="stylesheet" />

    <!-- Flatpickr -->
    <link
        type="text/css"
        href="../assets/css/vendor-flatpickr.css"
        rel="stylesheet" />
    <link
        type="text/css"
        href="../assets/css/vendor-flatpickr-airbnb.css"
        rel="stylesheet" />

    <!-- Toastr -->
    <link type="text/css"
        href="../assets/vendor/toastr.min.css"
        rel="stylesheet">
</head>

<body class="layout-fluid layout-sticky-subnav">
    <div class="preloader"></div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">
        <!-- **********************************Top Header********************************** -->
        <?php include 'includes/topheader.php'; ?>
        <!-- **********************************// END Top Header //********************************** -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page">
            <div class="page__header">
                <div class="container-fluid page__heading-container">
                    <div class="page__heading d-flex align-items-end">
                        <div class="flex">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Lihat User
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Lihat User</h1>
                        </div>
                        <a href="manage_users"
                            class="btn btn-primary ml-1">Kembali Manage User</a>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- Biodata User -->
                <div class="card my-4">
                    <div class="card-header">
                        <h4 class="mb-0">Biodata User</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <!-- Foto Profil -->
                            <div class="col-md-3 text-center mb-3">
                                <img src="../assets/images/avatar/default.jpg"
                                    class="rounded-circle img-thumbnail"
                                    style="width:180px;height:180px;object-fit:cover;"
                                    alt="Profile">
                            </div>

                            <!-- Biodata -->
                            <div class="col-md-9">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="220"><strong>Nama Lengkap</strong></td>
                                        <td>: John Doe</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tempat Lahir</strong></td>
                                        <td>: Jakarta</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Lahir</strong></td>
                                        <td>: 10 Januari 1995</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin</strong></td>
                                        <td>: Laki-Laki</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Alamat</strong></td>
                                        <td>: Jl. Sudirman No. 123, Jakarta</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nomor Telepon</strong></td>
                                        <td>: 081234567890</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Subscribe</strong></td>
                                        <td>: <span class="badge badge-danger">Tidak</span></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Tabel Likes -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0">Postingan yang Disukai (Likes)</h4>
                    </div>

                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">Show</span>
                                    <select class="form-control form-control-sm" style="width:80px;">
                                        <option>10</option>
                                        <option>25</option>
                                        <option>50</option>
                                        <option>100</option>
                                    </select>
                                    <span class="ml-2">entries</span>
                                </div>
                            </div>

                            <div class="col-md-6 text-right">
                                <input type="text"
                                    class="form-control form-control-sm d-inline-block"
                                    style="width:250px;"
                                    placeholder="Search...">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="80">No</th>
                                        <th>Judul Postingan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Peraturan Baru Tentang Hukum Siber Tahun 2026</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Hak dan Kewajiban Warga Negara Dalam Sistem Hukum Indonesia</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Proses Penyelesaian Sengketa Perdata di Pengadilan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <small>Showing 1 to 3 of 3 entries</small>

                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Tabel Bookmark -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Postingan yang Dibookmark</h4>
                    </div>

                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">Show</span>
                                    <select class="form-control form-control-sm" style="width:80px;">
                                        <option>10</option>
                                        <option>25</option>
                                        <option>50</option>
                                        <option>100</option>
                                    </select>
                                    <span class="ml-2">entries</span>
                                </div>
                            </div>

                            <div class="col-md-6 text-right">
                                <input type="text"
                                    class="form-control form-control-sm d-inline-block"
                                    style="width:250px;"
                                    placeholder="Search...">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="80">No</th>
                                        <th>Judul Postingan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Panduan Lengkap Membuat Gugatan Perdata</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Peran Advokat Dalam Sistem Peradilan Indonesia</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Perkembangan Hukum Teknologi Informasi di Indonesia</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <small>Showing 1 to 3 of 3 entries</small>

                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <!-- ********************************** //END page-content ********************************** -->
            </div>
            <!-- ********************************** //END page-content ********************************** -->
        </div>
    </div>
    <!-- // END header-layout -->

    <!-- App Settings FAB -->
    <div id="app-settings" style="display: none">
        <app-settings layout-active="fluid"></app-settings>
    </div>

    <!-- ********************************** // MENU-Drawer ********************************** -->
    <?php include 'includes/drawer_menu.php'; ?>
    <!-- ********************************** //END MENU-drawer ********************************** -->

    <footer class="dashboard-footer mt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- LEFT -->
                <div class="col-md-6 text-md-left text-center mb-2 mb-md-0">
                    <span class="footer-text">
                        © 2026 Hukuminfo.id. All rights reserved.
                    </span>
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

    <!-- Flatpickr -->
    <script src="../assets/vendor/flatpickr/flatpickr.min.js"></script>
    <script src="../assets/js/flatpickr.js"></script>

    <!-- Toastr -->
    <script src="assets/vendor/toastr.min.js"></script>
    <script src="assets/js/toastr.js"></script>

</body>

</html>