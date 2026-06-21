<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>View Log - Dashboard | Hukuminfo.id</title>
    
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
                                        Lihat logs
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Lihat Logs</h1>
                        </div>
                        <a href="list_subscriber"
                            class="btn btn-primary ml-1">Kembali List Subscriber</a>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Informasi Subscriber</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-3 text-center">
                                        <img src="../assets/images/avatar.png"
                                            class="rounded-circle img-fluid"
                                            width="120">
                                    </div>

                                    <div class="col-md-9">
                                        <table class="table table-borderless mb-0">
                                            <tr>
                                                <th width="200">ID Subscriber</th>
                                                <td>: SUBS-001</td>
                                            </tr>

                                            <tr>
                                                <th>Email</th>
                                                <td>: budisantoso@gmail.com</td>
                                            </tr>

                                            <tr>
                                                <th>No. Telepon</th>
                                                <td>: 083197503720</td>
                                            </tr>

                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    :
                                                    <span class="badge bg-success">
                                                        Aktif
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Tipe Subscriber</th>
                                                <td>
                                                    :
                                                    <span class="badge bg-primary">
                                                        Account
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Tanggal Subscribe</th>
                                                <td>: 12 Mei 2026</td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mb-4">

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Total Newsletter</h6>
                                <h2>124</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Berhasil</h6>
                                <h2 class="text-success">120</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Gagal</h6>
                                <h2 class="text-danger">4</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Success Rate</h6>
                                <h2>96%</h2>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            Riwayat Pengiriman Newsletter
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                Show
                                <select class="form-control d-inline w-auto">
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                </select>
                                entries
                            </div>

                            <input type="text"
                                class="form-control w-25"
                                placeholder="Search...">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">

                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Campaign</th>
                                        <th>Subject Newsletter</th>
                                        <th>Status</th>
                                        <th>SMTP Response</th>
                                        <th>Tanggal Kirim</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td>1</td>

                                        <td>NC-001</td>

                                        <td>
                                            Breaking News:
                                            Korupsi Dana Hibah
                                        </td>

                                        <td>
                                            <span class="badge bg-success">
                                                Success
                                            </span>
                                        </td>

                                        <td>
                                            Email Sent Successfully
                                        </td>

                                        <td>
                                            30/05/2026 10:30
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>

                                        <td>NC-002</td>

                                        <td>
                                            Update Peraturan Baru
                                        </td>

                                        <td>
                                            <span class="badge bg-danger">
                                                Failed
                                            </span>
                                        </td>

                                        <td>
                                            Mailbox Not Found
                                        </td>

                                        <td>
                                            29/05/2026 09:00
                                        </td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <ul class="pagination">
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
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