<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Laporan Pengeluaran - Dashboard | Konig Guard Bureau</title>

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
                                        Manage Laporan Pengeluaran
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Laporan Pengeluaran</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- ================= FORM INPUT ================= -->
                <div class="card mb-4">
                    <div class="card-body">

                        <h4 class="mb-3">
                            <span class="material-icons">add_circle</span>
                            Tambah Laporan Pengeluaran
                        </h4>

                        <div class="row">
                            <div class="col-md-3">
                                <label>Tanggal</label>
                                <input type="date" id="tanggal" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label>Type Pengeluaran</label>
                                <select id="typePengeluaran" class="form-control">
                                    <option value="opex">Biaya Operasional (Opex)</option>
                                    <option value="non">Non-Operasional</option>
                                    <option value="capex">Belanja Modal (Capex)</option>
                                    <option value="fixed">Biaya Tetap</option>
                                    <option value="variable">Biaya Variabel</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Judul Pengeluaran</label>
                                <input type="text" id="judulPengeluaran" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label>Jumlah (Rp)</label>
                                <input type="text" id="jumlah" class="form-control" onkeyup="formatInputRupiah(this)">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Penjelasan Pengeluaran</label>
                                <textarea id="deskripsi" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label>Upload Bukti (PDF / Image)</label>
                                <input type="file" id="file" class="form-control" accept=".pdf,image/*">
                                <small class="form-text text-muted">Format file yang diterima: PDF, JPG, PNG. Jika Laporan Banyak, silakan merge gambar menjadi file PDF</small>
                            </div>
                        </div>

                        <div class="mt-3 text-right">
                            <button onclick="addData()" class="btn btn-primary">
                                <span class="material-icons">save</span>
                                Simpan
                            </button>
                        </div>

                    </div>
                </div>


                <!-- ================= TABLE ================= -->
                <div class="card">
                    <div class="card-body">

                        <!-- HEADER + TOTAL -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>
                                <span class="material-icons">receipt</span>
                                Daftar Laporan Pengeluaran
                            </h4>

                            <div style="text-align:right; min-width:250px;">

                                <div>
                                    <small>Total Pendapatan</small><br>
                                    <strong id="totalPendapatanText">Rp. 0,-</strong>
                                </div>

                                <div class="mt-2">
                                    <small>Total Pengeluaran</small><br>
                                    <strong id="totalPengeluaranText">Rp. 0,-</strong>
                                </div>

                                <hr style="margin:6px 0;">

                                <div>
                                    <small>Sisa Saldo</small><br>
                                    <strong id="sisaSaldoText">Rp. 0,-</strong>
                                </div>

                            </div>

                        </div>

                        <!-- FILTER -->
                        <div class="row mb-3 align-items-center">

                            <!-- LEFT: FILTER -->
                            <div class="col-md-6 d-flex gap-2">
                                <select id="filterBulan" class="form-control mr-2" onchange="renderTable()">
                                    <option value="">Semua Bulan</option>
                                    <option value="0">Jan</option>
                                    <option value="1">Feb</option>
                                    <option value="2">Mar</option>
                                    <option value="3">Apr</option>
                                    <option value="4">Mei</option>
                                    <option value="5">Jun</option>
                                    <option value="6">Jul</option>
                                    <option value="7">Agu</option>
                                    <option value="8">Sep</option>
                                    <option value="9">Okt</option>
                                    <option value="10">Nov</option>
                                    <option value="11">Des</option>
                                </select>

                                <select id="filterTahun" class="form-control" onchange="renderTable()">
                                    <option value="">Semua Tahun</option>
                                </select>
                            </div>

                            <!-- RIGHT: SHOW + SEARCH -->
                            <div class="col-md-6 d-flex justify-content-end align-items-center">

                                <!-- SHOW ENTRIES -->
                                <div class="d-flex align-items-center mr-3">
                                    <span class="mr-2">Show</span>
                                    <select id="showEntries" class="form-control" style="width:80px;" onchange="renderTable()">
                                        <option>5</option>
                                        <option selected>10</option>
                                        <option>25</option>
                                    </select>
                                    <span class="ml-2">entries</span>
                                </div>

                                <!-- SEARCH -->
                                <input type="text" id="searchInput" placeholder="Search..."
                                    class="form-control" style="width:200px;" onkeyup="renderTable()">

                            </div>

                        </div>

                        <!-- TABLE -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Type Pengeluaran</th>
                                        <th>Sumber</th>
                                        <th>Jumlah</th>
                                        <th>Deskripsi</th>
                                        <th>Bukti</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody"></tbody>
                            </table>
                            <div id="pagination" class="mt-3 text-center"></div>
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
    <!-- MODAL EDIT -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content p-3">

                <h4>Edit Laporan</h4>

                <input type="hidden" id="editIndex">

                <input type="date" id="editTanggal" class="form-control mb-2">
                <input type="text" id="editSumber" class="form-control mb-2">

                <input type="text" id="editJumlah" class="form-control mb-2"
                    onkeyup="formatInputRupiah(this)">

                <select id="editMetode" class="form-control mb-2">
                    <option>Transfer Bank</option>
                    <option>Tunai</option>
                    <option>E-Wallet</option>
                </select>

                <!-- PREVIEW FILE LAMA -->
                <div id="oldPreview" class="mb-2"></div>

                <!-- PREVIEW FILE BARU -->
                <div id="newPreview" class="mb-2"></div>

                <input type="file" id="editFile" class="form-control mb-2" accept=".pdf,image/*">

                <button onclick="updateData()" class="btn btn-primary">Update</button>

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
    <script src="../assets/js/costume-dom/m.ex-reports.js"></script>

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