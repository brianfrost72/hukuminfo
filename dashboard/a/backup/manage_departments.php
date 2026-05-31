<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Departemen - Dashboard | Konig Guard Bureau</title>

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

    <!-- Vector Maps -->
    <link
        type="text/css"
        href="../assets/vendor/jqvmap/jqvmap.min.css"
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
                                        Manage Departemen
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Departemen</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Manage Departemen</h4>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah</button>
                        </div>

                        <div class="card-body">
                            <!-- FILTER -->
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    Show
                                    <select id="showEntries" class="form-control d-inline w-auto">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>20</option>
                                    </select>
                                    entries
                                </div>

                                <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">
                            </div>

                            <!-- TABLE -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>No</th>
                                            <th>Nama Departemen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody"></tbody>
                                </table>
                            </div>

                            <!-- PAGINATION -->
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-danger" id="deleteSelected">Hapus Terpilih</button>
                                <ul class="pagination" id="pagination"></ul>
                            </div>
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

    <!-- ********************************** // MODAL ********************************** -->
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Data</h5>
                </div>
                <div class="modal-body">
                    <input type="text" id="departemenTambah" class="form-control mb-2" placeholder="Nama Departemen">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="tambahData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Data</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editIndex">
                    <input type="text" id="departemenEdit" class="form-control mb-2" placeholder="Nama Departemen">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="updateData()">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL VALIDASI -->
    <div class="modal fade" id="modalValidasi">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg"
                style="
                border-radius:22px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#fff4e5;
                    ">

                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#ff9800;
                        ">
                            error_outline
                        </span>

                    </div>

                    <h3 class="font-weight-bold mb-2">
                        Validasi
                    </h3>

                    <p class="text-muted mb-4"
                        id="validasiText">

                        Nama departemen wajib diisi

                    </p>

                    <button class="btn btn-warning px-4"
                        data-dismiss="modal"
                        style="
                        border-radius:12px;
                        height:45px;
                        min-width:130px;
                        color:white;
                    ">
                        Mengerti
                    </button>

                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SUKSES -->
    <div class="modal fade" id="modalSuccess">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg"
                style="
                border-radius:22px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center"
                        style="
                        width:95px;
                        height:95px;
                        border-radius:50%;
                        background:#eafaf1;
                    ">

                        <span class="material-icons"
                            style="
                            font-size:55px;
                            color:#28a745;
                        ">
                            check_circle
                        </span>

                    </div>

                    <h3 class="font-weight-bold mb-2"
                        id="successTitle">

                        Berhasil

                    </h3>

                    <p class="text-muted mb-4"
                        id="successText">

                        Data berhasil disimpan

                    </p>

                    <button class="btn btn-success px-4"
                        data-dismiss="modal"
                        style="
                        border-radius:12px;
                        height:45px;
                        min-width:130px;
                    ">
                        OK
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!-- ********************************** // MODAL ********************************** -->

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
    <script src="../assets/js/costume-dom/m.department.js"></script>

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

    <!-- Moment.js -->
    <script src="../assets/vendor/moment.min.js"></script>
    <script src="../assets/vendor/moment-range.js"></script>
</body>

</html>