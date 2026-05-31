<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Gaji Karyawan - Dashboard | Konig Guard Bureau</title>

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
                                        Manage Gaji Karyawan
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Gaji Karyawan</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- TITLE -->
                <div class="mt-4 mb-3">
                    <h4>Tambah Penggajian Karyawan</h4>
                    <small class="text-muted">Input data gaji, bonus, lembur dan potongan</small>
                </div>

                <!-- FORM -->
                <div class="card p-3 mb-4" style="background:#fff;border-radius:8px;">

                    <!-- TOP FORM -->
                    <div class="row mb-4 pb-3" style="border-bottom:1px solid #ECEEF0;">

                        <div class="col-md-3">
                            <label>Karyawan</label>
                            <select class="form-control">
                                <option>Pilih Karyawan</option>
                                <option>Andi</option>
                                <option>Budi</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Periode</label>
                            <input type="month" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Tanggal Bayar</label>
                            <input type="date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Metode Pembayaran</label>
                            <select class="form-control">
                                <option>Transfer Bank</option>
                                <option>Cash</option>
                            </select>
                        </div>

                    </div>

                    <!-- MAIN CONTENT -->
                    <div class="row">

                        <!-- PENDAPATAN -->
                        <div class="col-md-4" style="border-right:1px solid #ECEEF0;">
                            <h6 class="mb-3 text-success">Pendapatan</h6>

                            <label>Gaji Pokok</label>
                            <input type="number" class="form-control mb-2 rupiah-input pendapatan-input">

                            <label>Tunjangan</label>
                            <input type="number" class="form-control mb-2 rupiah-input pendapatan-input">

                            <label>Bonus</label>
                            <input type="number" class="form-control mb-2 rupiah-input pendapatan-input">

                            <label>Lembur</label>
                            <input type="number" class="form-control mb-3 rupiah-input pendapatan-input">

                            <div class="p-2" style="background:#FAFBFE;border-radius:6px;">
                                <strong>Total Pendapatan</strong>
                                <span id="totalPendapatan" class="float-right text-success">Rp 0</span>
                            </div>
                        </div>

                        <!-- POTONGAN -->
                        <div class="col-md-4" style="border-right:1px solid #ECEEF0;">
                            <h6 class="mb-3 text-danger">Potongan</h6>

                            <label>BPJS Kesehatan</label>
                            <input type="number" class="form-control mb-2 rupiah-input potongan-input">

                            <label>BPJS Ketenagakerjaan</label>
                            <input type="number" class="form-control mb-2 rupiah-input potongan-input">

                            <label>PPh 21</label>
                            <input type="number" class="form-control mb-2 rupiah-input potongan-input">

                            <label>Lain-lain</label>
                            <input type="number" class="form-control mb-3 rupiah-input potongan-input">

                            <div class="p-2" style="background:#FAFBFE;border-radius:6px;">
                                <strong>Total Potongan</strong>
                                <span id="totalPotongan" class="float-right text-danger">Rp 0</span>
                            </div>
                        </div>

                        <!-- RINGKASAN -->
                        <div class="col-md-4">
                            <h6 class="mb-3">Ringkasan</h6>

                            <div class="p-3 mb-3" style="background:#FAFBFE;border-radius:8px;">
                                <p>Total Pendapatan
                                    <span id="summaryPendapatan" class="float-right text-success">Rp 0</span>
                                </p>
                                <p>Total Potongan
                                    <span id="summaryPotongan" class="float-right text-danger">Rp 0</span>
                                </p>

                                <hr>

                                <h5>Take Home Pay
                                    <span id="takeHomePay" class="float-right text-primary">Rp 0</span>
                                </h5>
                            </div>

                            <textarea class="form-control mb-3" placeholder="Catatan..."></textarea>

                            <div class="text-right">
                                <button
                                    id="btnResetPayroll"
                                    class="btn btn-light">
                                    Reset
                                </button>
                                <button
                                    id="btnSimpanPayroll"
                                    class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- TABLE -->
                <div class="card p-3" style="background:#fff;border-radius:8px;">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">

                        <!-- TITLE -->
                        <div>
                            <h6 class="mb-0">List Penggajian</h6>
                        </div>

                        <!-- FILTER -->
                        <div class="d-flex align-items-center flex-wrap">

                            <!-- SHOW ENTRIES -->
                            <div class="mr-2">
                                <select id="showEntries"
                                    class="form-control"
                                    style="width:90px;">

                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>

                                </select>
                            </div>

                            <!-- FILTER DIVISI -->
                            <div class="mr-2">
                                <select id="filterDivisi"
                                    class="form-control"
                                    style="width:170px;">

                                    <option value="">Semua Divisi</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="IT">IT</option>
                                    <option value="Finance">Finance</option>
                                    <option value="HRD">HRD</option>

                                </select>
                            </div>

                            <!-- FILTER PERIODE -->
                            <div class="mr-2">
                                <input type="month"
                                    id="filterPeriode"
                                    class="form-control"
                                    style="width:170px;">
                            </div>

                            <!-- SEARCH -->
                            <div>
                                <input type="text"
                                    id="searchInput"
                                    class="form-control"
                                    style="width:200px;"
                                    placeholder="Cari...">
                            </div>

                        </div>

                    </div>

                    <!-- TABLE -->
                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Karyawan</th>
                                    <th>Divisi</th>
                                    <th>Periode</th>
                                    <th>Tgl Bayar</th>
                                    <th>Total</th>
                                    <th>Potongan</th>
                                    <th>Take Home Pay</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody id="tableBody">

                                <tr>
                                    <td>1</td>
                                    <td>Andi</td>
                                    <td>Marketing</td>
                                    <td>Mei 2025</td>
                                    <td>31/05/2025</td>

                                    <td class="text-success">
                                        Rp 8.000.000
                                    </td>

                                    <td class="text-danger">
                                        Rp 1.000.000
                                    </td>

                                    <td class="text-primary">
                                        Rp 7.000.000
                                    </td>

                                    <td>
                                        <button class="btn btn-sm btn-primary">
                                            View
                                        </button>

                                        <button class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                        <!-- PAGINATION -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">

                            <!-- INFO -->
                            <div id="paginationInfo" class="mb-2">
                                Menampilkan 1 sampai 10 dari 100 data
                            </div>

                            <!-- PAGINATION -->
                            <div class="d-flex align-items-center flex-wrap" id="pagination">

                                <!-- generated by js -->

                            </div>

                        </div>

                        <!-- EXPORT -->
                        <button class="btn btn-primary"
                            onclick="exportExcel()">

                            Export Excel

                        </button>
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

    <!-- DETAIL VIEW -->
    <div id="detailPayrollCard"
        class="card p-3 mt-4"
        style="display:none;background:#fff;border-radius:8px;">

        <!-- TITLE -->
        <div class="mb-3">
            <h4>Detail Penggajian Karyawan</h4>

            <small class="text-muted">
                Informasi lengkap data penggajian
            </small>
        </div>

        <!-- FORM -->
        <div class="card p-3"
            style="background:#fff;border-radius:8px;">

            <!-- TOP FORM -->
            <div class="row mb-4 pb-3"
                style="border-bottom:1px solid #ECEEF0;">

                <div class="col-md-3">
                    <label>Karyawan</label>

                    <input type="text" id="detailNama"
                        class="form-control" readonly>
                    </input>
                </div>

                <div class="col-md-3">
                    <label>Periode</label>

                    <input type="text" id="detailPeriode"
                        class="form-control" readonly>
                    </input>
                </div>

                <div class="col-md-3">
                    <label>Tanggal Bayar</label>

                    <input type="date" id="detailTanggal"
                        class="form-control" readonly>
                    </input>
                </div>

                <div class="col-md-3">
                    <label>Metode Pembayaran</label>

                    <select id="detailMetode"
                        class="form-control" disabled>
                        <option>Transfer Bank</option>
                        <option>Cash</option>
                    </select>
                </div>

            </div>

            <!-- MAIN CONTENT -->
            <div class="row">

                <!-- PENDAPATAN -->
                <div class="col-md-4"
                    style="border-right:1px solid #ECEEF0;">

                    <h6 class="mb-3 text-success">
                        Pendapatan
                    </h6>

                    <label>Gaji Pokok</label>

                    <input type="text" id="detailGaji"
                        class="form-control mb-2 detail-rupiah" readonly>
                    </input>

                    <label>Tunjangan</label>

                    <input type="text" id="detailTunjangan"
                        class="form-control mb-2 detail-rupiah" readonly>
                    </input>

                    <label>Bonus</label>

                    <input type="text" id="detailBonus"
                        class="form-control mb-2 detail-rupiah" readonly>
                    </input>

                    <label>Lembur</label>

                    <input type="text" id="detailLembur"
                        class="form-control mb-3 detail-rupiah" readonly>
                    </input>

                    <div class="p-2"
                        style="background:#FAFBFE;border-radius:6px;">

                        <strong>Total Pendapatan</strong>

                        <span id="detailTotalPendapatan"
                            class="float-right text-success">

                        </span>

                    </div>

                </div>

                <!-- POTONGAN -->
                <div class="col-md-4"
                    style="border-right:1px solid #ECEEF0;">

                    <h6 class="mb-3 text-danger">
                        Potongan
                    </h6>

                    <label>BPJS Kesehatan</label>

                    <input type="text" id="detailBPJS"
                        class="form-control mb-2 detail-rupiah" readonly>
                    </input>

                    <label>BPJS Ketenagakerjaan</label>

                    <input type="text" id="detailBPJSTK"
                        class="form-control mb-2 detail-rupiah" readonly>
                    </input>

                    <label>PPh 21</label>

                    <input type="text" id="detailPPH"
                        class="form-control mb-2 detail-rupiah" readonly>
                    </input>

                    <label>Lain-lain</label>

                    <input type="text" id="detailLain"
                        class="form-control mb-3 detail-rupiah" readonly>
                    </input>

                    <div class="p-2"
                        style="background:#FAFBFE;border-radius:6px;">

                        <strong>Total Potongan</strong>

                        <span id="detailTotalPotongan"
                            class="float-right text-danger">

                        </span>

                    </div>

                </div>

                <!-- RINGKASAN -->
                <div class="col-md-4">

                    <h6 class="mb-3">
                        Ringkasan
                    </h6>

                    <div class="p-3 mb-3"
                        style="background:#FAFBFE;border-radius:8px;">

                        <p>
                            Total Pendapatan

                            <span id="summaryPendapatanView"
                                class="float-right text-success">

                            </span>
                        </p>

                        <p>
                            Total Potongan

                            <span id="summaryPotonganView"
                                class="float-right text-danger">

                            </span>
                        </p>

                        <hr>

                        <h5>
                            Take Home Pay

                            <span id="summaryTakeHomeView"
                                class="float-right text-primary">

                            </span>
                        </h5>

                    </div>

                    <label>Catatan</label>

                    <textarea id="detailCatatan"
                        class="form-control mb-3"
                        readonly>
                </textarea>

                    <div class="text-right">

                        <!-- EDIT -->
                        <button id="btnEditPayroll"
                            class="btn btn-warning"
                            onclick="toggleEditPayroll()">

                            Edit

                        </button>

                        <!-- CANCEL -->
                        <button id="btnCancelEdit"
                            class="btn btn-light"
                            onclick="cancelEditPayroll()"
                            style="display:none;">

                            Batal

                        </button>

                        <button class="btn btn-secondary"
                            onclick="printSlipGaji()">

                            Print Slip

                        </button>

                        <button class="btn btn-light"
                            onclick="closeDetailPayroll()">

                            Tutup

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- =========================
    MODAL SUCCESS
========================= -->

    <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0"
                style="
                border-radius:18px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#ecfdf3;
                    ">

                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#16a34a;
                        ">
                            check_circle
                        </span>

                    </div>

                    <!-- TITLE -->
                    <h4 class="font-weight-bold mb-2" id="modalSuccessTitle">
                        Berhasil
                    </h4>

                    <!-- TEXT -->
                    <p class="text-muted mb-4" id="modalSuccessText">
                        Data berhasil disimpan
                    </p>

                    <!-- BUTTON -->
                    <button type="button"
                        class="btn btn-success px-4"
                        data-dismiss="modal"
                        style="
                        min-width:120px;
                        height:45px;
                        border-radius:10px;
                    ">
                        Okay
                    </button>

                </div>

            </div>

        </div>
    </div>

    <!-- =========================
    MODAL RESET
========================= -->

    <div class="modal fade" id="modalReset" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0"
                style="
                border-radius:18px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#fff4e6;
                    ">

                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#f59e0b;
                        ">
                            refresh
                        </span>

                    </div>

                    <!-- TITLE -->
                    <h4 class="font-weight-bold mb-2">
                        Reset Form?
                    </h4>

                    <!-- TEXT -->
                    <p class="text-muted mb-4">
                        Semua data input akan dihapus
                    </p>

                    <!-- BUTTON -->
                    <div class="d-flex justify-content-center">

                        <button type="button"
                            class="btn btn-light mr-2"
                            data-dismiss="modal"
                            style="
                            min-width:120px;
                            height:45px;
                            border-radius:10px;
                        ">
                            Batal
                        </button>

                        <button type="button"
                            id="btnConfirmReset"
                            class="btn btn-warning"
                            style="
                            min-width:120px;
                            height:45px;
                            border-radius:10px;
                            color:#fff;
                        ">
                            Reset
                        </button>

                    </div>

                </div>

            </div>

        </div>
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
    <script src="../assets/js/costume-dom/m.emp-pt.js"></script>
    <script src="../assets/js/costume-dom/export-data.js"></script>

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