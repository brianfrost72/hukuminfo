<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Riwayat Order - Dashboard | Konig Guard Bureau</title>

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
                <div class="page__header page__header-nav">
                    <div class="container-fluid page__container">
                        <div class="navbar navbar-secondary navbar-light navbar-expand-sm p-0">
                            <button class="navbar-toggler navbar-toggler-right"
                                data-toggle="collapse"
                                data-target="#navbarsExample03"
                                type="button">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="navbar-collapse collapse"
                                id="navbarsExample03">
                                <ul class="nav navbar-nav">
                                    <li class="nav-item">
                                        <a href="manage_orders.php"
                                            class="btn btn-primary">Order In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="orders_history.php"
                                            class="btn btn-primary">Riwayat Order</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- HEADER -->
                <div class="d-flex justify-content-between align-items-center mt-3 mb-4 flex-wrap">
                    <div>
                        <h3 class="mb-1 font-weight-bold">Riwayat Order Masuk</h3>
                        <p class="text-muted mb-0">
                            Daftar Riwayat Order Masuk Dari Klien
                        </p>
                    </div>

                    <div class="d-flex align-items-center mt-3 mt-md-0">
                        <div class="input-group mr-2" style="max-width: 300px;">
                            <div class="input-group-prepend">
                                <span class="btn btn-primary d-flex align-items-center">
                                    <span class="material-icons" style="font-size:20px;">search</span>
                                </span>
                            </div>

                            <input type="text"
                                class="form-control border-left-0"
                                placeholder="Cari pesan...">
                        </div>

                        <button class="btn btn-primary d-flex align-items-center btn-refresh">
                            <span class="material-icons mr-1">refresh</span>
                            Refresh
                        </button>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3">

                    <span class="mr-2 small text-muted">
                        Show
                    </span>

                    <select id="showEntries"
                        class="form-control form-control-sm"
                        style="width:80px;">

                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>

                    </select>

                    <span class="ml-2 small text-muted">
                        entries
                    </span>

                </div>

                <!-- CARD LIST -->
                <div class="card" style="border-radius:14px;">
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">

                                <thead class="bg-light">
                                    <tr>
                                        <th width="60">#</th>
                                        <th>No. Order</th>
                                        <th>Tipe Klien</th>
                                        <th>Nama</th>
                                        <th>Jasa Layanan</th>
                                        <th>Tanggal Selesai</th>
                                        <th width="150">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="tablePesanMasuk">

                                    <!-- ITEM -->
                                    <tr>
                                        <td>
                                            1
                                        </td>

                                        <td>
                                            <span class="text-primary px-3 py-2">
                                                Perusahaan
                                            </span>
                                        </td>

                                        <td>
                                            ORD17022601
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-start">

                                                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                                    style="
                                            width:48px;
                                            height:48px;
                                            background:#eef2ff;
                                            color:var(--primary);
                                            font-weight:600;
                                            font-size:18px;
                                        ">
                                                    A
                                                </div>

                                                <div>
                                                    <h6 class="mb-1 font-weight-bold">
                                                        Andi Saputra
                                                    </h6>

                                                    <div class="small text-muted mb-1">
                                                        <span class="material-icons mr-1"
                                                            style="font-size:15px;">
                                                            mail
                                                        </span>
                                                        andi@gmail.com
                                                    </div>

                                                    <div class="small text-muted">
                                                        <span class="material-icons mr-1"
                                                            style="font-size:15px;">
                                                            call
                                                        </span>
                                                        +62 812-3344-5566
                                                    </div>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge badge-primary px-3 py-2">
                                                Security
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge badge-primary px-3 py-2">
                                                Security
                                            </span>
                                        </td>

                                        <td>
                                            <div class="small">
                                                12 Mei 2026
                                            </div>

                                            <div class="text-muted small">
                                                08:15 WIB
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">

                                                <a href="detail_order_history.php" class="btn btn-sm btn-light mr-2" title="Lihat Pesan">

                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        visibility
                                                    </span>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>

                                    <!-- ITEM -->
                                    <tr>
                                        <td>
                                            2
                                        </td>

                                        <td>
                                            <span class="text-primary px-3 py-2">
                                                Perusahaan
                                            </span>
                                        </td>

                                        <td>
                                            ORD17022602
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-start">

                                                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                                    style="
                                            width:48px;
                                            height:48px;
                                            background:#fff4e8;
                                            color:#f5b666;
                                            font-weight:600;
                                            font-size:18px;
                                        ">
                                                    S
                                                </div>

                                                <div>
                                                    <h6 class="mb-1 font-weight-bold">
                                                        Sarah Wijaya
                                                    </h6>

                                                    <div class="small text-muted mb-1">
                                                        <span class="material-icons mr-1"
                                                            style="font-size:15px;">
                                                            mail
                                                        </span>
                                                        sarah@gmail.com
                                                    </div>

                                                    <div class="small text-muted">
                                                        <span class="material-icons mr-1"
                                                            style="font-size:15px;">
                                                            call
                                                        </span>
                                                        +62 878-1111-2222
                                                    </div>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge badge-success px-3 py-2">
                                                Pengacara
                                            </span>
                                        </td>

                                        <td>
                                            <div class="small">
                                                11 Mei 2026
                                            </div>

                                            <div class="text-muted small">
                                                16:42 WIB
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">

                                                <a href="detail_order_history.php" class="btn btn-sm btn-light mr-2" title="Lihat Detail Pesan">
                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        visibility
                                                    </span>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

                <!-- PAGINATION -->
                <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">

                    <div class="text-muted small mb-2 mb-md-0" id="tableInfo">
                        Menampilkan 1 - 10 dari 120 pesan
                    </div>

                    <div class="d-flex align-items-center" id="pagination">

                        <button class="page-btn icon-btn mr-2">
                            <span class="material-icons" style="font-size:18px;">
                                chevron_left
                            </span>
                        </button>

                        <button class="page-btn active mr-2">1</button>
                        <button class="page-btn mr-2">2</button>
                        <button class="page-btn mr-2">3</button>

                        <span class="page-dots mr-2">...</span>

                        <button class="page-btn mr-2">12</button>

                        <button class="page-btn icon-btn">
                            <span class="material-icons" style="font-size:18px;">
                                chevron_right
                            </span>
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
        <app-settings
            layout-active="fluid"
            :layout-location="{
      'default': 'index.html',
      'fixed': 'fixed-dashboard.html',
      'fluid': 'fluid-dashboard.html',
      'mini': 'mini-dashboard.html'
    }"></app-settings>
    </div>

    <!-- ********************************** // MENU-Drawer ********************************** -->
    <?php include 'includes/drawer_menu.php'; ?>
    <!-- ********************************** //END MENU-drawer ********************************** -->

    <!-- ========================= MODAL STATUS PESANAN ========================= -->
    <div class="modal fade"
        id="doneOrderModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="doneOrderModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered"
            role="document">

            <div class="modal-content border-0 shadow-lg"
                style="border-radius:22px; overflow:hidden;">

                <!-- HEADER -->
                <div class="modal-header border-0 pb-0">

                    <div class="d-flex align-items-center">

                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                            style="
                            width:60px;
                            height:60px;
                            background:#eef2ff;
                            color:var(--primary);
                        ">

                            <span class="material-icons"
                                style="font-size:30px;">
                                check
                            </span>

                        </div>

                        <div>

                            <h4 class="mb-1 font-weight-bold">
                                Status Penyelesaian Pesanan
                            </h4>

                            <div class="text-muted small">
                                Tentukan status akhir pesanan klien
                            </div>

                        </div>

                    </div>

                    <button type="button"
                        class="close"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <!-- BODY -->
                <div class="modal-body pt-4">

                    <div class="alert border-0"
                        style="
                        background:#f8fafc;
                        border-radius:14px;
                    ">

                        <div class="d-flex align-items-start">

                            <span class="material-icons mr-3 text-primary">
                                info
                            </span>

                            <div class="small text-muted">

                                Apakah pesanan ini sudah selesai?
                                Pilih status penyelesaian sesuai kondisi order.

                            </div>

                        </div>

                    </div>

                    <!-- OPTION -->
                    <div class="row mt-4">

                        <!-- SUKSES -->
                        <div class="col-md-6 mb-3">

                            <button type="button"
                                class="btn btn-block text-left border-0 p-4 btn-order-finish-success"
                                style="
                border-radius:20px;
                background:#eefaf2;
                min-height:190px;
                transition:.25s;
            "

                                onmouseover="
                this.style.transform='translateY(-3px)';
                this.style.boxShadow='0 10px 25px rgba(40,167,69,.12)';
            "

                                onmouseout="
                this.style.transform='translateY(0px)';
                this.style.boxShadow='none';
            ">

                                <div class="d-flex flex-column h-100">

                                    <!-- ICON -->
                                    <div class="mb-4">

                                        <div class="d-flex align-items-center justify-content-center"
                                            style="
                            width:58px;
                            height:58px;
                            border-radius:16px;
                            background:#dff5e7;
                            color:#28a745;
                        ">

                                            <span class="material-icons"
                                                style="font-size:28px;">
                                                check
                                            </span>

                                        </div>

                                    </div>

                                    <!-- CONTENT -->
                                    <div>

                                        <h4 class="font-weight-bold text-success mb-3">
                                            Sukses
                                        </h4>

                                        <div class="text-muted"
                                            style="
                            line-height:1.7;
                            font-size:14px;
                        ">

                                            Pesanan selesai dengan normal dan layanan berhasil diberikan kepada klien.

                                        </div>

                                    </div>

                                </div>

                            </button>

                        </div>

                        <!-- DIBATALKAN -->
                        <div class="col-md-6 mb-3">

                            <button type="button"
                                class="btn btn-block text-left border-0 p-4 btn-order-finish-cancel"
                                style="
                border-radius:20px;
                background:#fff5f5;
                min-height:190px;
                transition:.25s;
            "

                                onmouseover="
                this.style.transform='translateY(-3px)';
                this.style.boxShadow='0 10px 25px rgba(220,53,69,.12)';
            "

                                onmouseout="
                this.style.transform='translateY(0px)';
                this.style.boxShadow='none';
            ">

                                <div class="d-flex flex-column h-100">

                                    <!-- ICON -->
                                    <div class="mb-4">

                                        <div class="d-flex align-items-center justify-content-center"
                                            style="
                            width:58px;
                            height:58px;
                            border-radius:16px;
                            background:#ffe5e5;
                            color:#dc3545;
                        ">

                                            <span class="material-icons"
                                                style="font-size:26px;">
                                                close
                                            </span>

                                        </div>

                                    </div>

                                    <!-- CONTENT -->
                                    <div>

                                        <h4 class="font-weight-bold text-danger mb-3">
                                            Dibatalkan
                                        </h4>

                                        <div class="text-muted"
                                            style="
                            line-height:1.7;
                            font-size:14px;
                        ">

                                            Pesanan dibatalkan namun klien telah menyelesaikan kewajiban pembayaran penalti pembatalan.

                                        </div>

                                    </div>

                                </div>

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- ========================= END MODAL STATUS PESANAN ========================= -->

    <!-- ===================================== -->
    <!-- LOADING MODAL -->
    <!-- ===================================== -->
    <div class="modal fade"
        id="loadingModal"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow"
                style="border-radius:20px;">

                <div class="modal-body text-center py-5">

                    <div class="mb-4">

                        <div class="spinner-border text-primary"
                            style="width:4rem;height:4rem;"
                            role="status">
                        </div>

                    </div>

                    <h5 class="font-weight-bold mb-2">
                        Memuat Data...
                    </h5>

                    <p class="text-muted mb-0">
                        Mohon tunggu sebentar
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- ========================================= -->
    <!-- MODAL SUCCESS -->
    <!-- ========================================= -->
    <div class="modal fade"
        id="successSendModal"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg"
                style="border-radius:22px; overflow:hidden;">

                <div class="modal-body text-center py-5 px-4">

                    <!-- SUCCESS ANIMATION -->
                    <div class="success-animation mx-auto mb-4">

                        <div class="success-checkmark">

                            <span class="material-icons">
                                check
                            </span>

                        </div>

                    </div>

                    <h3 class="font-weight-bold mb-3">
                        Status Berhasil Diperbarui
                    </h3>

                    <p class="text-muted mb-4">
                        Status penyelesaian pesanan berhasil diperbarui
                    </p>

                    <button class="btn btn-primary rounded-pill px-4"
                        data-dismiss="modal">

                        Tutup

                    </button>

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

    <script>
        // ===============================
        // DATA SIMULASI PESAN MASUK
        // ===============================
        const pesanMasukData = [{
                id: 1,
                orderID: "ORD17022601",
                type: "Personal",
                nama: "Andi Saputra",
                email: "andi@gmail.com",
                phone: "+62 812-3344-5566",
                layanan: "Security",
                subject: "Permintaan Website Company Profile",
                pesan: "Halo admin, saya ingin menanyakan estimasi biaya website company profile.",
                tanggal: "12/05/2026",
                jam: "08:15 WIB",
                isNew: true
            },
            {
                id: 2,
                orderID: "ORD17022602",
                type: "Perusahaan",
                nama: "Sarah Wijaya",
                email: "sarah@gmail.com",
                phone: "+62 878-1111-2222",
                layanan: "Pengacara",
                subject: "Konsultasi Aplikasi Mobile",
                pesan: "Saya ingin membuat aplikasi Android dan iOS.",
                tanggal: "11/05/2026",
                jam: "16:42 WIB",
                isNew: false
            },
            {
                id: 3,
                orderID: "ORD17022603",
                type: "Personal",
                nama: "Jonathan",
                email: "jonathan@gmail.com",
                phone: "+62 812-8888-1111",
                layanan: "Cyber Security",
                subject: "Audit Sistem Keamanan",
                pesan: "Kami membutuhkan audit keamanan jaringan perusahaan.",
                tanggal: "10/05/2026",
                jam: "11:00 WIB",
                isNew: true
            },
            {
                id: 4,
                orderID: "ORD17022604",
                type: "Perusahaan",
                nama: "Michael",
                email: "michael@gmail.com",
                phone: "+62 811-2222-9999",
                layanan: "Bodyguard",
                subject: "Permintaan Bodyguard VIP",
                pesan: "Membutuhkan bodyguard untuk event pribadi.",
                tanggal: "09/05/2026",
                jam: "14:10 WIB",
                isNew: false
            },
            {
                id: 5,
                orderID: "ORD17022605",
                type: "Perusahaan",
                nama: "Rina Putri",
                email: "rina@gmail.com",
                phone: "+62 813-1111-8888",
                layanan: "Security",
                subject: "Penawaran Kerjasama",
                pesan: "Kami tertarik bekerjasama dalam bidang keamanan.",
                tanggal: "08/05/2026",
                jam: "09:45 WIB",
                isNew: true
            },
            {
                id: 6,
                orderID: "ORD17022606",
                type: "Personal",
                nama: "Kevin",
                email: "kevin@gmail.com",
                phone: "+62 821-3333-1111",
                layanan: "Pengacara",
                subject: "Konsultasi Hukum",
                pesan: "Butuh konsultasi hukum perusahaan.",
                tanggal: "07/05/2026",
                jam: "13:20 WIB",
                isNew: false
            }
        ];

        // ===============================
        // CONFIG
        // ===============================
        let rowsPerPage = 10;
        let currentPage = 1;
        let filteredData = [...pesanMasukData];
        let selectedOrderId = null;

        const tableBody = document.getElementById("tablePesanMasuk");
        const pagination = document.getElementById("pagination");

        // ===============================
        // RENDER TABLE
        // ===============================
        function renderTable() {

            tableBody.innerHTML = "";

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            const paginatedItems = filteredData.slice(start, end);

            if (paginatedItems.length === 0) {

                tableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        Tidak ada pesan ditemukan
                    </td>
                </tr>
            `;

                return;
            }

            paginatedItems.forEach((item) => {

                const firstLetter = item.nama.charAt(0);

                const badgeColor =
                    item.layanan === "Security" ? "primary" :
                    item.layanan === "Pengacara" ? "success" :
                    item.layanan === "Cyber Security" ? "warning" :
                    "danger";

                const row = `
                <tr>

                    <td>
                        <div class="d-flex align-items-center">
                            ${item.id}
                        </div>
                    </td>

                    <td>
                        ${item.orderID}
                    </td>

                    <td>

    ${
        item.type === "Personal"
        ?

        `
        <div class="status-badge text-success">

            <span class="badge badge-pill badge-primary">
                Personal
            </span>

        </div>
        `

        :

        `
        <div class="status-badge text-danger">

            <span class="badge badge-pill badge-dark">
                Perusahaan
            </span>

        </div>
        `
    }

</td>

                    <td>

                        <div class="d-flex align-items-start">

                            <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                style="
                                    width:48px;
                                    height:48px;
                                    background:#eef2ff;
                                    color:var(--primary);
                                    font-weight:600;
                                    font-size:18px;
                                ">
                                ${firstLetter}
                            </div>

                            <div>

                                <div class="d-flex align-items-center">

                                    <h6 class="mb-1 font-weight-bold mr-2">
                                        ${item.nama}
                                    </h6>

                                </div>

                                <div class="small text-muted mb-1">
                                    ${item.email}
                                </div>

                                <div class="small text-muted">
                                    ${item.phone}
                                </div>

                            </div>

                        </div>

                    </td>

                    <td>
                        <span class="badge badge-${badgeColor} px-3 py-2">
                            ${item.layanan}
                        </span>
                    </td>

                    <td>

                        <div class="small">
                            ${item.tanggal}
                        </div>

                        <div class="small text-muted">
                            ${item.jam}
                        </div>

                    </td>

                    <td>

                        <div class="d-flex">

                            <a href="detail_order_history.php" class="btn btn-sm btn-light mr-2 btn-view-message" title="Lihat Pesan">

                                <span class="material-icons"
                                    style="font-size:18px;">
                                    visibility
                                </span>

                            </a>

                        </div>

                    </td>

                </tr>
            `;

                tableBody.insertAdjacentHTML("beforeend", row);

            });

        }

        // ===============================
        // PAGINATION
        // ===============================
        function renderPagination() {

            pagination.innerHTML = "";

            const totalPages =
                Math.ceil(filteredData.length / rowsPerPage);

            if (totalPages <= 1) return;

            // =========================
            // BUTTON PREV
            // =========================
            pagination.innerHTML += `
            <button class="page-btn mr-2"
                ${currentPage === 1 ? 'disabled' : ''}
                onclick="changePage(${currentPage - 1})">

                <span class="material-icons">
                    chevron_left
                </span>

            </button>
        `;

            // =========================
            // PAGE ARRAY
            // =========================
            let pages = [];

            // awal
            pages.push(1);

            // current area
            for (
                let i = currentPage - 1; i <= currentPage + 1; i++
            ) {

                if (
                    i > 1 &&
                    i < totalPages
                ) {
                    pages.push(i);
                }

            }

            // akhir
            if (totalPages > 1) {
                pages.push(totalPages);
            }

            // remove duplicate
            pages = [...new Set(pages)];

            // =========================
            // RENDER PAGE
            // =========================
            let lastPage = 0;

            pages.forEach(page => {

                // dots
                if (page - lastPage > 1) {

                    pagination.innerHTML += `
                    <span class="page-dots mr-2">
                        ...
                    </span>
                `;

                }

                // page button
                pagination.innerHTML += `
                <button class="page-btn mr-2
                    ${page === currentPage ? 'active' : ''}"

                    onclick="changePage(${page})">

                    ${page}

                </button>
            `;

                lastPage = page;

            });

            // =========================
            // BUTTON NEXT
            // =========================
            pagination.innerHTML += `
            <button class="page-btn"
                ${currentPage === totalPages ? 'disabled' : ''}
                onclick="changePage(${currentPage + 1})">

                <span class="material-icons">
                    chevron_right
                </span>

            </button>
        `;

        }

        function changePage(page) {

            const totalPages = Math.ceil(filteredData.length / rowsPerPage);

            if (page < 1 || page > totalPages) return;

            currentPage = page;

            renderTable();
            renderPagination();
            renderTableInfo();

        }

        // ===============================
        // SHOW ENTRIES
        // ===============================
        const showEntries = document.getElementById("showEntries");

        showEntries.addEventListener("change", function() {

            rowsPerPage = parseInt(this.value);

            currentPage = 1;

            renderTable();
            renderPagination();
            renderTableInfo();

        });

        // ===============================
        // SEARCH
        // ===============================
        const searchInput = document.querySelector('input[placeholder="Cari pesan..."]');

        searchInput.addEventListener("keyup", function() {

            const keyword = this.value.toLowerCase();

            filteredData = pesanMasukData.filter(item => {

                return (
                    item.nama.toLowerCase().includes(keyword) ||
                    item.email.toLowerCase().includes(keyword) ||
                    item.subject.toLowerCase().includes(keyword)
                );

            });

            currentPage = 1;

            renderTable();
            renderPagination();
            renderTableInfo();

        });

        // ===============================
        // REFRESH
        // ===============================
        const refreshBtn =
            document.querySelector(".btn-refresh");

        refreshBtn.addEventListener("click", function() {

            // tambah animasi loading
            refreshBtn.classList.add("btn-refresh-loading");

            // disable button sementara
            refreshBtn.disabled = true;

            // ubah text sementara
            const textNode =
                refreshBtn.childNodes[2];

            textNode.textContent = " Refreshing...";

            // simulasi loading
            setTimeout(() => {

                searchInput.value = "";

                filteredData = [...pesanMasukData];

                currentPage = 1;

                renderTable();
                renderPagination();
                renderTableInfo();

                // stop animasi
                refreshBtn.classList.remove("btn-refresh-loading");

                refreshBtn.disabled = false;

                textNode.textContent = " Refresh";

            }, 1200);

        });

        // ===============================
        // VIEW MESSAGE
        // ===============================
        $(document).on("click", ".btn-view-message", function() {

            const id = $(this).data("id");

            const selected = pesanMasukData.find(item => item.id == id);

            if (selected) {

                selected.isNew = false;

                renderTable();
                renderPagination();
                renderTableInfo();

                openModalWithLoading("#detailPesanModal");

            }

        });

        // ===============================
        // TABLE INFO
        // ===============================
        function renderTableInfo() {

            const totalData = filteredData.length;

            const start =
                totalData === 0 ?
                0 :
                ((currentPage - 1) * rowsPerPage) + 1;

            const end =
                Math.min(currentPage * rowsPerPage, totalData);

        }

        // ===============================
        // INIT
        // ===============================
        renderTable();
        renderPagination();
        renderTableInfo();

        // =====================================
        // MOVE ORDER TO HISTORY (SIMULATION)
        // =====================================
        function moveOrderToHistory(statusOrder) {

            // cari index data
            const orderIndex =
                pesanMasukData.findIndex(
                    item => item.id === selectedOrderId
                );

            if (orderIndex === -1) return;

            // OPTIONAL:
            // tambahkan status selesai
            pesanMasukData[orderIndex].finalStatus = statusOrder;

            // simulasi pindah ke riwayat:
            // hapus dari order masuk
            pesanMasukData.splice(orderIndex, 1);

            // update filtered data
            filteredData = [...pesanMasukData];

            // fix pagination jika page kosong
            const totalPages =
                Math.ceil(filteredData.length / rowsPerPage);

            if (currentPage > totalPages) {
                currentPage = totalPages || 1;
            }

            // render ulang table
            renderTable();
            renderPagination();
            renderTableInfo();

        }

        // =====================================
        // OPEN DONE ORDER MODAL
        // =====================================
        $(document).on("click", ".btn-done-order", function(e) {

            e.preventDefault();

            const row = $(this).closest("tr");

            selectedOrderId = parseInt(
                $(this).data("id")
            );

            openModalWithLoading("#doneOrderModal");

        });

        // =====================================
        // ORDER SUCCESS
        // =====================================
        $(document).on("click", ".btn-order-finish-success", function() {

            $("#doneOrderModal").modal("hide");

            $("#loadingModal").modal("show");

            setTimeout(() => {

                $("#loadingModal").modal("hide");

                moveOrderToHistory("Sukses");

                $("#successSendModal").modal("show");

                // OPTIONAL:
                // pindahkan ke riwayat order
                // update status order
                // ajax backend


                console.log("Pesanan selesai: SUKSES");

            }, 1000);

        });

        // =====================================
        // ORDER CANCELED
        // =====================================
        $(document).on("click", ".btn-order-finish-cancel", function() {

            $("#doneOrderModal").modal("hide");

            $("#loadingModal").modal("show");

            setTimeout(() => {

                $("#loadingModal").modal("hide");

                moveOrderToHistory("Dibatalkan");

                $("#successSendModal").modal("show");

                // OPTIONAL:
                // pindahkan ke riwayat order
                // update status pembatalan
                // ajax backend
                console.log("Pesanan selesai: DIBATALKAN");

            }, 1000);

        });

        // =====================================
        // OPEN MODAL WITH LOADING
        // =====================================
        function openModalWithLoading(targetModal, callback = null) {

            // tampilkan loading
            $("#loadingModal").modal({
                backdrop: 'static',
                keyboard: false
            });

            $("#loadingModal").modal("show");

            // simulasi loading
            setTimeout(() => {

                // tutup loading
                $("#loadingModal").modal("hide");

                // buka modal tujuan
                $(targetModal).modal("show");

                // callback optional
                if (callback) {
                    callback();
                }

            }, 800);

        }
    </script>

</body>

</html>