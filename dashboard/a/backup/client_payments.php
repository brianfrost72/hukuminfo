<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Pembayaran Jasa Konig - Dashboard | Konig Guard Bureau</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex" />

    <!-- Perfect Scrollbar -->
    <link
        type="text/css"
        href="assets/vendor/perfect-scrollbar.css"
        rel="stylesheet" />

    <!-- App CSS -->
    <link type="text/css" href="assets/css/app.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/app.rtl.css" rel="stylesheet" />

    <!-- Material Design Icons -->
    <link
        type="text/css"
        href="assets/css/vendor-material-icons.css"
        rel="stylesheet" />

    <!-- Font Awesome FREE Icons -->
    <link
        type="text/css"
        href="assets/css/vendor-fontawesome-free.css"
        rel="stylesheet" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script
        async
        src="https://www.googletagmanager.com/gtag/js?id=UA-133433427-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());
        gtag("config", "UA-133433427-1");
    </script>

    <!-- Flatpickr -->
    <link
        type="text/css"
        href="assets/css/vendor-flatpickr.css"
        rel="stylesheet" />
    <link
        type="text/css"
        href="assets/css/vendor-flatpickr-airbnb.css"
        rel="stylesheet" />

    <!-- Vector Maps -->
    <link
        type="text/css"
        href="assets/vendor/jqvmap/jqvmap.min.css"
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
                                        <a href="client_orders.php"
                                            class="btn btn-primary">Order In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="client_contracts.php"
                                            class="btn btn-primary">Ajukan Kontrak</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#"
                                            class="btn btn-primary">Pembayaran</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#"
                                            class="btn btn-primary">Invoice</a>
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
                        <h3 class="mb-1 font-weight-bold">Pembayaran Jasa</h3>
                        <p class="text-muted mb-0">
                            Daftar Pembayaran Dari Klien Order
                        </p>
                    </div>

                    <div class="d-flex align-items-center mt-3 mt-md-0">
                        <div class="input-group mr-2" style="max-width: 300px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-primary d-flex align-items-center">
                                    <span class="material-icons" style="font-size:20px;">search</span>
                                </button>
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
                                        <th>Nama</th>
                                        <th>Jasa Layanan</th>
                                        <th>Bukti Kontrak</th>
                                        <th>Tanggal</th>
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
                                            <a href="#"
                                                class="btn btn-light border btn-sm d-inline-flex align-items-center text-primary" title="Jumlah Personil">

                                                <span class="material-icons mr-1"
                                                    style="font-size:18px;">
                                                    person
                                                </span>

                                                3 Personil
                                            </a>
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

                                                <button class="btn btn-sm btn-light mr-2"
                                                    data-toggle="modal"
                                                    data-target="#detailPesanModal" title="Lihat Pesan">

                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        visibility
                                                    </span>
                                                </button>

                                                <button class="btn btn-sm btn-success mr-2 btn-open-reply"
                                                    data-toggle="modal"
                                                    data-target="#replyPesanModal" title="Balas Pesan">

                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        reply
                                                    </span>
                                                </button>

                                                <button class="btn btn-sm btn-danger btn-delete-message" title="Hapus Pesan">

                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        delete
                                                    </span>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                    <!-- ITEM -->
                                    <tr>
                                        <td>
                                            2
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
                                            <a href="#"
                                                class="btn btn-light border btn-sm d-inline-flex align-items-center text-primary" title="Jumlah Personil">

                                                <span class="material-icons mr-1"
                                                    style="font-size:18px;">
                                                    person
                                                </span>

                                                3 Personil
                                            </a>
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

                                                <button class="btn btn-sm btn-light mr-2"
                                                    data-toggle="modal"
                                                    data-target="#detailPesanModal" title="Lihat Pesan">
                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        visibility
                                                    </span>
                                                </button>

                                                <button class="btn btn-sm btn-success mr-2 btn-open-reply"
                                                    data-toggle="modal"
                                                    data-target="#replyPesanModal" title="Balas Pesan">
                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        reply
                                                    </span>
                                                </button>

                                                <!-- <button class="btn btn-sm btn-danger btn-delete-message" title="Hapus Pesan">
                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        delete
                                                    </span>
                                                </button> -->

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

    <!-- ========================= MODAL DETAIL PESAN ========================= -->
    <div class="modal fade"
        id="detailPesanModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="detailPesanModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-scrollable"
            role="document">

            <div class="modal-content border-0 shadow-lg"
                style="border-radius:18px; overflow:hidden;">

                <!-- HEADER -->
                <div class="modal-header border-0"
                    style="background:#f9fafc;">

                    <div class="d-flex align-items-center">

                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                            style="
                            width:60px;
                            height:60px;
                            background:#eef2ff;
                            color:var(--primary);
                            font-size:22px;
                            font-weight:700;
                        ">
                            A
                        </div>

                        <div>
                            <h4 class="mb-1 font-weight-bold">
                                Andi Saputra
                            </h4>

                            <div class="text-muted small">
                                Klien Order Jasa Konig
                            </div>
                        </div>

                    </div>

                    <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <!-- BODY -->
                <div class="modal-body p-0">

                    <div class="container-fluid">

                        <div class="row">

                            <!-- LEFT SIDE -->
                            <div class="col-lg-4 border-right"
                                style="background:#fbfcfd;">

                                <div class="p-4">

                                    <h6 class="font-weight-bold mb-4">
                                        Informasi Pengirim
                                    </h6>

                                    <!-- EMAIL -->
                                    <div class="d-flex mb-4">

                                        <div class="mr-3">
                                            <span class="material-icons text-primary">
                                                mail
                                            </span>
                                        </div>

                                        <div>
                                            <div class="small text-muted">
                                                Email
                                            </div>

                                            <div class="font-weight-500">
                                                andi@gmail.com
                                            </div>
                                        </div>

                                    </div>

                                    <!-- PHONE -->
                                    <div class="d-flex mb-4">

                                        <div class="mr-3">
                                            <span class="material-icons text-success">
                                                call
                                            </span>
                                        </div>

                                        <div>
                                            <div class="small text-muted">
                                                Nomor Telepon
                                            </div>

                                            <div class="font-weight-500">
                                                +62 812-3344-5566
                                            </div>
                                        </div>

                                    </div>

                                    <!-- SERVICE -->
                                    <div class="d-flex mb-4">

                                        <div class="mr-3">
                                            <span class="material-icons text-warning">
                                                business_center
                                            </span>
                                        </div>

                                        <div>
                                            <div class="small text-muted">
                                                Jasa Layanan
                                            </div>

                                            <div>
                                                <span class="badge badge-primary px-3 py-2">
                                                    Security
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- DATE -->
                                    <div class="d-flex mb-4">

                                        <div class="mr-3">
                                            <span class="material-icons text-danger">
                                                schedule
                                            </span>
                                        </div>

                                        <div>
                                            <div class="small text-muted">
                                                Tanggal Pesan
                                            </div>

                                            <div class="font-weight-500">
                                                12 Mei 2026 - 08:15 WIB
                                            </div>
                                        </div>

                                    </div>

                                    <!-- PERSONIL -->
                                    <div class="d-flex mb-4">

                                        <div class="mr-3">
                                            <span class="material-icons text-info">
                                                person
                                            </span>
                                        </div>

                                        <div>
                                            <div class="small text-muted">
                                                Jumlah Personil
                                            </div>

                                            <div class="font-weight-500">
                                                12 Personil
                                            </div>
                                        </div>

                                    </div>

                                    <!-- ID ORDER -->
                                    <div class="d-flex mb-4">

                                        <div class="mr-3">
                                            <span class="material-icons text-primary">
                                                shopping_cart
                                            </span>
                                        </div>

                                        <div>
                                            <div class="small text-muted">
                                                ID ORDER
                                            </div>

                                            <div class="font-weight-500">
                                                ORD17022601
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT SIDE -->
                            <div class="col-lg-8">

                                <!-- CARD EMAIL STYLE -->
                                <div class="card border-0 shadow-sm"
                                    style="
            border-radius:18px;
            overflow:hidden;
        ">

                                    <!-- TOP HEADER -->
                                    <div class="card-header border-0 d-flex justify-content-between align-items-center"
                                        style="
                background:linear-gradient(135deg,#6774df,#8a94f7);
                padding:20px 25px;
            ">

                                        <div class="text-white">

                                            <h5 class="mb-1 font-weight-bold">
                                                Kirim Kontrak Kerja
                                            </h5>

                                            <div style="opacity:.85; font-size:13px;">
                                                Upload file PDF dan kirim pesan ke customer
                                            </div>

                                        </div>

                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                            style="
                    width:55px;
                    height:55px;
                    background:rgba(255,255,255,.18);
                    backdrop-filter:blur(6px);
                ">

                                            <span class="material-icons text-white">
                                                attach_email
                                            </span>

                                        </div>

                                    </div>

                                    <!-- BODY -->
                                    <div class="card-body p-4">

                                        <!-- EMAIL INFO -->
                                        <div class="row mb-4">

                                            <!-- TO -->
                                            <div class="col-md-6 mb-3">

                                                <label class="small text-muted font-weight-bold">
                                                    Dari
                                                </label>

                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-light">
                                                            <span class="material-icons"
                                                                style="font-size:18px;">
                                                                email
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <input type="email"
                                                        class="form-control border-0 bg-light"
                                                        value="andi@gmail.com" disabled>

                                                </div>

                                            </div>

                                            <!-- SUBJECT -->
                                            <div class="col-md-6 mb-3">

                                                <label class="small text-muted font-weight-bold">
                                                    Subject
                                                </label>

                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-light">
                                                            <span class="material-icons"
                                                                style="font-size:18px;">
                                                                subject
                                                            </span>
                                                        </span>
                                                    </div>

                                                    <input type="text"
                                                        class="form-control border-0 bg-light"
                                                        value="Pengiriman Kontrak Kerja" disabled>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- TEMPLATE MESSAGE -->
                                        <div class="mb-4">

                                            <label class="small text-muted font-weight-bold mb-2">
                                                Isi Pesan
                                            </label>

                                            <div class="border-0 shadow-sm"
                                                style="
                        border-radius:16px;
                        background:#f8fafc;
                        overflow:hidden;
                    ">

                                                <!-- EMAIL TOP -->
                                                <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom bg-white">

                                                    <div class="d-flex align-items-center">

                                                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                                            style="
                                    width:45px;
                                    height:45px;
                                    background:#e8f0ff;
                                    color:#6774df;
                                ">

                                                            <span class="material-icons">
                                                                mail
                                                            </span>

                                                        </div>

                                                        <div>

                                                            <div class="font-weight-bold">
                                                                PT. Secure Guard Indonesia
                                                            </div>

                                                            <div class="small text-muted">
                                                                noreply@secureguard.id
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <!-- TEXTAREA -->
                                                <div class="p-4">

                                                    <textarea class="form-control border-0 bg-white shadow-none"
                                                        rows="10"
                                                        style="
                                resize:none;
                                border-radius:14px;
                                padding:20px;
                                line-height:1.8;
                            " disabled>Halo Bapak/Ibu Andi Saputra,

Terima kasih telah menghubungi layanan kami.

Bersama email ini kami lampirkan dokumen kontrak kerja dalam format PDF untuk ditinjau lebih lanjut. Silakan membaca seluruh isi dokumen sebelum proses persetujuan dilakukan.

Apabila terdapat pertanyaan atau revisi data, silakan membalas email ini atau hubungi tim kami.

Hormat kami,
PT. Secure Guard Indonesia</textarea>

                                                </div>

                                            </div>

                                        </div>

                                        <!-- ATTACHMENT PREVIEW -->
                                        <div class="card border-0 shadow-sm" style="border-radius:12px;">

                                            <a href="uploads/proposal.pdf"
                                                target="_blank"
                                                class="btn btn-light border d-flex align-items-center justify-content-between w-100 p-3 shadow-sm text-decoration-none btn-attachment"
                                                style="
            border-radius:14px;
            transition:all .25s ease;
        ">

                                                <div class="d-flex align-items-center">

                                                    <div class="mr-3">

                                                        <div class="rounded d-flex align-items-center justify-content-center"
                                                            style="
                        width:50px;
                        height:50px;
                        background:#fff3e0;
                    ">

                                                            <span class="material-icons text-warning">
                                                                description
                                                            </span>

                                                        </div>

                                                    </div>

                                                    <div class="text-left">

                                                        <div class="font-weight-bold text-dark">
                                                            proposal.pdf
                                                        </div>

                                                        <div class="small text-muted">
                                                            2.4 MB Document
                                                        </div>

                                                    </div>

                                                </div>

                                                <span class="material-icons text-muted">
                                                    open_in_new
                                                </span>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <!-- END RIGHT -->

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- ========================= END MODAL DETAIL PESAN ========================= -->

    <!-- ========================= MODAL BALAS PESAN ========================= -->
    <div class="modal fade"
        id="replyPesanModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="replyPesanModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-scrollable"
            role="document">

            <div class="modal-content border-0 shadow-lg"
                style="border-radius:18px; overflow:hidden;">

                <!-- HEADER -->
                <div class="modal-header border-0"
                    style="background:#f8fafc;">

                    <div class="d-flex align-items-center">

                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                            style="
                            width:55px;
                            height:55px;
                            background:#e8f5e9;
                            color:#28a745;
                        ">

                            <span class="material-icons">
                                reply
                            </span>

                        </div>

                        <div>
                            <h4 class="mb-1 font-weight-bold">
                                Balas Pesan
                            </h4>

                            <div class="small text-muted">
                                Kirim balasan email kepada customer
                            </div>
                        </div>

                    </div>

                    <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <!-- BODY -->
                <div class="modal-body p-4">

                    <div class="row">

                        <!-- LEFT -->
                        <div class="col-lg-4">

                            <div class="card border-0 shadow-sm mb-4"
                                style="border-radius:16px;">

                                <div class="card-body">

                                    <h6 class="font-weight-bold mb-4">
                                        Informasi Pengirim
                                    </h6>

                                    <!-- NAMA -->
                                    <div class="mb-3">

                                        <label class="small text-muted mb-2">
                                            Nama
                                        </label>

                                        <div class="input-group">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-0">
                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        person
                                                    </span>
                                                </span>
                                            </div>

                                            <input type="text"
                                                class="form-control border-0 bg-light"
                                                value="Andi Saputra"
                                                readonly>

                                        </div>

                                    </div>

                                    <!-- EMAIL -->
                                    <div class="mb-3">

                                        <label class="small text-muted mb-2">
                                            Email
                                        </label>

                                        <div class="input-group">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-0">
                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        mail
                                                    </span>
                                                </span>
                                            </div>

                                            <input type="email"
                                                class="form-control border-0 bg-light"
                                                value="andi@gmail.com"
                                                readonly>

                                        </div>

                                    </div>

                                    <!-- PHONE -->
                                    <div class="mb-3">

                                        <label class="small text-muted mb-2">
                                            Nomor Telepon
                                        </label>

                                        <div class="input-group">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-0">
                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        call
                                                    </span>
                                                </span>
                                            </div>

                                            <input type="text"
                                                class="form-control border-0 bg-light"
                                                value="+62 812-3344-5566"
                                                readonly>

                                        </div>

                                    </div>

                                    <!-- LAYANAN -->
                                    <div class="mb-0">

                                        <label class="small text-muted mb-2">
                                            Layanan Yang Ditanyakan
                                        </label>

                                        <div class="input-group">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-0">
                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        business_center
                                                    </span>
                                                </span>
                                            </div>

                                            <select class="form-control border-0 bg-light" disabled>

                                                <option>Security</option>
                                                <option>Pengacara</option>
                                                <option>Bodyguard</option>
                                                <option>Cyber Security</option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->

                        <!-- END RIGHT -->
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- ========================= END MODAL BALAS PESAN ========================= -->

    <!-- ========================= MODAL HAPUS PESAN ========================= -->
    <div class="modal fade"
        id="deleteModal"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow"
                style="border-radius:20px;">

                <div class="modal-body text-center p-5">

                    <div class="mb-4">

                        <div class="rounded-circle bg-danger-light d-inline-flex align-items-center justify-content-center"
                            style="
                            width:80px;
                            height:80px;
                            background:#fee2e2;
                        ">

                            <span class="material-icons text-danger"
                                style="font-size:40px;">
                                delete
                            </span>

                        </div>

                    </div>

                    <h4 class="font-weight-bold mb-3">
                        Hapus Pesan?
                    </h4>

                    <p class="text-muted mb-4">
                        Pesan yang dihapus tidak dapat dikembalikan.
                    </p>

                    <div class="d-flex justify-content-center">

                        <button class="btn btn-light border mr-2"
                            data-dismiss="modal">
                            Batal
                        </button>

                        <button class="btn btn-danger"
                            id="confirmDeleteBtn">

                            Ya, Hapus

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- ========================= END MODAL HAPUS PESAN ========================= -->

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
    <!-- MODAL LOADING SEND -->
    <!-- ========================================= -->
    <div class="modal fade"
        id="sendingEmailModal"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg"
                style="border-radius:22px; overflow:hidden;">

                <div class="modal-body text-center py-5 px-4">

                    <!-- ANIMATION -->
                    <div class="mail-loader mx-auto mb-4">

                        <div class="mail-loader-circle"></div>

                        <div class="mail-loader-icon">

                            <span class="material-icons">
                                mail
                            </span>

                        </div>

                    </div>

                    <h4 class="font-weight-bold mb-2">
                        Mengirim Kontrak...
                    </h4>

                    <div class="text-muted">
                        Mohon tunggu, sistem sedang mengirim email
                    </div>

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
                        Berhasil Dikirim
                    </h3>

                    <p class="text-muted mb-4">
                        Kontrak kerja berhasil dikirim ke email customer
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
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="assets/vendor/material-design-kit.js"></script>

    <!-- App -->
    <script src="assets/js/toggle-check-all.js"></script>
    <script src="assets/js/check-selected-row.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/sidebar-mini.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="assets/js/app-settings.js"></script>

    <!-- Flatpickr -->
    <script src="assets/vendor/flatpickr/flatpickr.min.js"></script>
    <script src="assets/js/flatpickr.js"></script>

    <!-- Global Settings -->
    <script src="assets/js/settings.js"></script>

    <!-- Moment.js -->
    <script src="assets/vendor/moment.min.js"></script>
    <script src="assets/vendor/moment-range.js"></script>


    <!-- Vector Maps -->
    <script src="assets/vendor/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="assets/js/vector-maps.js"></script>



    <script>
        // ===============================
        // DATA SIMULASI PESAN MASUK
        // ===============================
        const pesanMasukData = [{
                id: 1,
                orderID: "ORD17022601",
                nama: "Andi Saputra",
                email: "andi@gmail.com",
                phone: "+62 812-3344-5566",
                layanan: "Security",
                subject: "Permintaan Website Company Profile",
                pesan: "Halo admin, saya ingin menanyakan estimasi biaya website company profile.",
                personil: "2 Personil",
                tanggal: "12/05/2026",
                jam: "08:15 WIB",
                isNew: true
            },
            {
                id: 2,
                nama: "Sarah Wijaya",
                email: "sarah@gmail.com",
                phone: "+62 878-1111-2222",
                layanan: "Pengacara",
                subject: "Konsultasi Aplikasi Mobile",
                pesan: "Saya ingin membuat aplikasi Android dan iOS.",
                personil: "15 Personil",
                status: "Bersedia",
                tanggal: "11/05/2026",
                jam: "16:42 WIB",
                isNew: false
            },
            {
                id: 3,
                nama: "Jonathan",
                email: "jonathan@gmail.com",
                phone: "+62 812-8888-1111",
                layanan: "Cyber Security",
                subject: "Audit Sistem Keamanan",
                pesan: "Kami membutuhkan audit keamanan jaringan perusahaan.",
                personil: "1 Personil",
                status: "Bersedia",
                tanggal: "10/05/2026",
                jam: "11:00 WIB",
                isNew: true
            },
            {
                id: 4,
                nama: "Michael",
                email: "michael@gmail.com",
                phone: "+62 811-2222-9999",
                layanan: "Bodyguard",
                subject: "Permintaan Bodyguard VIP",
                pesan: "Membutuhkan bodyguard untuk event pribadi.",
                personil: "3 Personil",
                status: "Tidak Bersedia",
                tanggal: "09/05/2026",
                jam: "14:10 WIB",
                isNew: false
            },
            {
                id: 5,
                nama: "Rina Putri",
                email: "rina@gmail.com",
                phone: "+62 813-1111-8888",
                layanan: "Security",
                subject: "Penawaran Kerjasama",
                pesan: "Kami tertarik bekerjasama dalam bidang keamanan.",
                personil: "5 Personil",
                status: "Bersedia",
                tanggal: "08/05/2026",
                jam: "09:45 WIB",
                isNew: true
            },
            {
                id: 6,
                nama: "Kevin",
                email: "kevin@gmail.com",
                phone: "+62 821-3333-1111",
                layanan: "Pengacara",
                subject: "Konsultasi Hukum",
                pesan: "Butuh konsultasi hukum perusahaan.",
                personil: "1 Personil",
                status: "Tidak Bersedia",
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
                <tr class="${item.isNew ? 'table-warning' : ''}">

                    <td>
                        <div class="d-flex align-items-center">

                            ${item.isNew ? `
                                <span class="new-dot mr-2"></span>
                            ` : ''}

                            ${item.id}
                        </div>
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

                                    ${item.isNew ? `
                                        <span class="badge badge-danger badge-pill px-2 py-1">
                                            Baru
                                        </span>
                                    ` : ''}

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

                    <td style="max-width:350px;">

                        <div class="font-weight-bold mb-1">
                            ${item.subject}
                        </div>

                        <div class="small text-muted">
                            ${item.pesan}
                        </div>

                    </td>

                    <td>

                        <a href="#" title="Lihat File" 
                            class="btn btn-light border btn-sm d-inline-flex align-items-center">

                            <span class="material-icons mr-1"
                                style="font-size:16px;">
                                person
                            </span>

                            ${item.personil}

                        </a>

                    </td>

                    <td>

    ${
        item.status === "Bersedia"
        ?

        `
        <div class="status-badge text-success">

            <span class="material-icons status-icon">
                check_circle
            </span>

            <span>
                Bersedia
            </span>

        </div>
        `

        :

        `
        <div class="status-badge text-danger">

            <span class="material-icons status-icon">
                cancel
            </span>

            <span>
                Tidak Bersedia
            </span>

        </div>
        `
    }

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

                            <button class="btn btn-sm btn-light mr-2 btn-view-message"
                                data-id="${item.id}" title="Lihat Pesan">

                                <span class="material-icons"
                                    style="font-size:18px;">
                                    visibility
                                </span>

                            </button>

                            <button class="btn btn-sm btn-success mr-2 btn-open-reply" title="Balas Pesan">

                                <span class="material-icons"
                                    style="font-size:18px;">
                                    reply
                                </span>

                            </button>

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

            // icon refresh
            const icon =
                refreshBtn.querySelector(".material-icons");

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

        // =====================================
        // DELETE MESSAGE
        // =====================================
        let selectedDeleteRow = null;

        $(document).on("click", ".btn-delete-message", function() {

            selectedDeleteRow =
                $(this).closest("tr");

            openModalWithLoading("#deleteModal");

        });

        // =====================================
        // CONFIRM DELETE
        // =====================================
        $("#confirmDeleteBtn").on("click", function() {

            const row = selectedDeleteRow;

            const rowIndex = row.index();

            const globalIndex =
                ((currentPage - 1) * rowsPerPage) + rowIndex;

            // loading lagi
            $("#deleteModal").modal("hide");

            $("#loadingModal").modal("show");

            setTimeout(() => {

                // hapus data
                pesanMasukData.splice(globalIndex, 1);

                filteredData = [...pesanMasukData];

                const totalPages =
                    Math.ceil(filteredData.length / rowsPerPage);

                if (currentPage > totalPages) {
                    currentPage = totalPages || 1;
                }

                renderTable();
                renderPagination();
                renderTableInfo();

                $("#loadingModal").modal("hide");

            }, 800);

        });

        // =========================================================
        // AUTO SIMULASI PESAN MASUK
        // =========================================================
        // NOTE:
        // Aman dihapus jika backend realtime sudah tersedia
        // Script ini hanya simulasi frontend dashboard admin
        // =========================================================
        const simulasiPesanBaru = [

            {
                nama: "Client Baru",
                email: "clientbaru@gmail.com",
                phone: "+62 811-7777-8888",
                layanan: "Security",
                subject: "Request Penawaran",
                pesan: "Halo admin, saya ingin penawaran harga.",
                personil: "1 Personil",
                status: "Bersedia",
            },

            {
                nama: "Budi",
                email: "budi@gmail.com",
                phone: "+62 878-2222-1111",
                layanan: "Cyber Security",
                subject: "Audit Server",
                pesan: "Kami membutuhkan audit server perusahaan.",
                personil: "5 Personil",
                status: "Tidak Bersedia",
            }

        ];

        setInterval(() => {

            const random =
                simulasiPesanBaru[Math.floor(Math.random() * simulasiPesanBaru.length)];

            const now = new Date();

            const newMessage = {

                id: pesanMasukData.length + 1,

                nama: random.nama,

                email: random.email,

                phone: random.phone,

                layanan: random.layanan,

                subject: random.subject,

                pesan: random.pesan,

                personil: random.personil,

                status: random.status,

                tanggal: now.toLocaleDateString('id-ID'),

                jam: now.toLocaleTimeString('id-ID'),

                isNew: true

            };

            // tambah data paling atas
            pesanMasukData.unshift(newMessage);

            filteredData = [...pesanMasukData];

            // render ulang TANPA reload page
            renderTable();
            renderPagination();
            renderTableInfo();

            // contoh notif kecil
            console.log("Pesan baru masuk");

        }, 15000);

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

            // hitung pesan baru
            const totalPesanBaru =
                pesanMasukData.filter(item => item.isNew).length;

            let newBadge = "";

            if (totalPesanBaru > 0) {

                newBadge = `
            •
            <span class="text-danger font-weight-bold">
                ${totalPesanBaru} pesan baru
            </span>
        `;
            }

            document.getElementById("tableInfo").innerHTML = `
        Menampilkan ${start} - ${end}
        dari ${totalData} pesan
        ${newBadge}
    `;
        }

        // ===============================
        // INIT
        // ===============================
        renderTable();
        renderPagination();
        renderTableInfo();

        // =====================================
        // OPEN MODAL WITH LOADING
        // =====================================
        function openModalWithLoading(targetModal, callback = null) {

            // tampilkan loading
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

        // =====================================
        // OPEN REPLY MODAL
        // =====================================
        $(document).on("click", ".btn-open-reply", function(e) {

            e.preventDefault();

            openModalWithLoading("#replyPesanModal");

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

        // ===============================
        // VIEW MESSAGE
        // ===============================
        $(document).on("click", ".btn-view-message", function() {

            const id = $(this).data("id");

            const selected =
                pesanMasukData.find(item => item.id == id);

            if (selected) {

                selected.isNew = false;

                renderTable();
                renderPagination();
                renderTableInfo();

                openModalWithLoading("#detailPesanModal");

            }

        });

        // =====================================
        // OPEN REPLY MODAL
        // =====================================
        $(document).on("click", ".btn-open-reply", function(e) {

            e.preventDefault();

            openModalWithLoading("#replyPesanModal");

        });
    </script>

    <script>
        // =========================================
        // MULTIPLE PDF UPLOAD
        // =========================================
        const pdfUploadInput =
            document.getElementById("pdfUploadInput");

        const attachmentList =
            document.getElementById("attachmentList");

        let uploadedFiles = [];

        // =========================================
        // FORMAT FILE SIZE
        // =========================================
        function formatFileSize(bytes) {

            if (bytes < 1024) {
                return bytes + " B";
            } else if (bytes < 1024 * 1024) {
                return (bytes / 1024).toFixed(1) + " KB";
            } else {
                return (bytes / (1024 * 1024)).toFixed(1) + " MB";
            }

        }

        // =========================================
        // RENDER ATTACHMENT
        // =========================================
        function renderAttachments() {

            attachmentList.innerHTML = "";

            if (uploadedFiles.length === 0) {

                attachmentList.innerHTML = `
            <div class="text-center text-muted py-4">
                Belum ada file PDF diupload
            </div>
        `;

                return;
            }

            uploadedFiles.forEach((file, index) => {

                attachmentList.innerHTML += `
        
        <div class="attachment-item d-flex align-items-center justify-content-between shadow-sm mb-3">

            <div class="d-flex align-items-center">

                <div class="rounded d-flex align-items-center justify-content-center mr-3"
                    style="
                        width:55px;
                        height:55px;
                        background:#ffe9ea;
                        color:#dc3545;
                    ">

                    <span class="material-icons">
                        picture_as_pdf
                    </span>

                </div>

                <div>

                    <div class="font-weight-bold">
                        ${file.name}
                    </div>

                    <div class="small text-muted">
                        ${formatFileSize(file.size)} • PDF Document
                    </div>

                </div>

            </div>

            <button class="btn btn-light rounded-pill px-3 btn-delete-file"
                data-index="${index}">

                <span class="material-icons"
                    style="font-size:18px;">
                    delete
                </span>

            </button>

        </div>
        
        `;

            });

        }

        // =========================================
        // UPLOAD FILE
        // =========================================
        pdfUploadInput.addEventListener("change", function() {

            const files = Array.from(this.files);

            files.forEach(file => {

                // VALIDASI PDF
                if (file.type !== "application/pdf") {

                    alert("Hanya file PDF yang diperbolehkan");

                    return;
                }

                uploadedFiles.push(file);

            });

            renderAttachments();

            // reset input
            this.value = "";

        });

        // =========================================
        // DELETE FILE
        // =========================================
        $(document).on("click", ".btn-delete-file", function() {

            const index =
                $(this).data("index");

            uploadedFiles.splice(index, 1);

            renderAttachments();

        });

        // =========================================
        // SEND EMAIL
        // =========================================
        const btnSendContract =
            document.getElementById("btnSendContract");

        btnSendContract.addEventListener("click", function() {

            // VALIDASI
            if (uploadedFiles.length === 0) {

                alert("Upload minimal 1 file PDF");

                return;
            }

            // TUTUP MODAL BALAS
            $("#replyPesanModal").modal("hide");

            // SHOW LOADING
            $("#sendingEmailModal").modal("show");

            // SIMULASI SEND EMAIL
            setTimeout(() => {

                // HIDE LOADING
                $("#sendingEmailModal").modal("hide");

                // SHOW SUCCESS
                $("#successSendModal").modal("show");

                // RESET FILE
                uploadedFiles = [];

                renderAttachments();

            }, 2500);

        });

        // =========================================
        // INIT
        // =========================================
        renderAttachments();
    </script>

</body>

</html>