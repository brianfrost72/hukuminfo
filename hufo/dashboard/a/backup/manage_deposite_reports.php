<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Laporan Deposit - Dashboard | Konig Guard Bureau</title>

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
                                        Manage Laporan Deposit
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Laporan Deposit</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- SUMMARY -->
                <div class="card p-4 text-center mt-4 mb-4">
                    <h5>Total Deposit</h5>
                    <h1 id="totalDeposit" style="font-weight:700;">Rp. 0</h1>

                    <hr>

                    <h6>Total Pengeluaran</h6>
                    <h4 id="totalPengeluaran" class="text-danger">Rp. 0</h4>
                </div>

                <!-- ===================== TABEL PEMASUKAN ===================== -->
                <div class="card p-3 mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <h5><span class="material-icons text-success">trending_up</span> Tabel Pemasukan</h5>

                        <div class="d-flex gap-2">
                            <select id="filterBulanMasuk" class="form-control">
                                <option value="">Bulan</option>
                            </select>

                            <select id="filterTahunMasuk" class="form-control">
                                <option value="">Tahun</option>
                            </select>

                            <input type="text" id="searchMasuk" class="form-control" placeholder="Search...">
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-2" style="gap:10px;">
                        <span>Show</span>
                        <select id="entriesMasuk" class="form-control" style="width:80px;">
                            <option>5</option>
                            <option>10</option>
                            <option>25</option>
                        </select>
                        <span>entries</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Sumber</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Bukti</th>
                                </tr>
                            </thead>
                            <tbody id="tableMasuk"></tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-2">
                            <div id="paginationMasuk"></div>
                        </div>
                    </div>
                </div>

                <!-- ===================== TABEL PENGELUARAN ===================== -->
                <div class="card p-3">
                    <div class="d-flex justify-content-between mb-2">
                        <h5><span class="material-icons text-danger">trending_down</span> Tabel Pengeluaran</h5>

                        <div class="d-flex gap-2">
                            <select id="filterBulanKeluar" class="form-control">
                                <option value="">Bulan</option>
                            </select>

                            <select id="filterTahunKeluar" class="form-control">
                                <option value="">Tahun</option>
                            </select>

                            <select id="filterTypeKeluar" class="form-control">
                                <option value="">Type</option>
                                <option>Opex</option>
                                <option>Non-Opex</option>
                            </select>

                            <input type="text" id="searchKeluar" class="form-control" placeholder="Search...">
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-2" style="gap:10px;">
                        <span>Show</span>
                        <select id="entriesKeluar" class="form-control" style="width:80px;">
                            <option>5</option>
                            <option>10</option>
                            <option>25</option>
                        </select>
                        <span>entries</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Type Pengeluaran</th>
                                    <th>Judul</th>
                                    <th>Jumlah</th>
                                    <th>Deskripsi</th>
                                    <th>Bukti</th>
                                </tr>
                            </thead>
                            <tbody id="tableKeluar"></tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-2">
                            <div id="paginationKeluar"></div>
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

    <div id="previewModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); justify-content:center; align-items:center;">
        <img id="previewImg" style="max-width:80%; max-height:80%;">
    </div>

    <footer class="dashboard-footer mt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- LEFT -->
                <div class="col-md-6 text-md-left text-center mb-2 mb-md-0">
                    <span class="footer-text">
                        © 2026 Konig Guard Bureau. All rights reserved.
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
    <script src="../assets/js/costume-dom/m.dep-rep.js"></script>

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

</body>

</html>