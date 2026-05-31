<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Pesan Masuk - Dashboard | Konig Guard Bureau</title>


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
                                        Pesan Masuk
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Pesan Masuk</h1>
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
                        <h3 class="mb-1 font-weight-bold">Pesan Masuk</h3>
                        <p class="text-muted mb-0">
                            Daftar pesan masuk dari form contact us website
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
                                        <th>ID Tiket</th>
                                        <th>Pengirim</th>
                                        <th>Jasa Layanan</th>
                                        <th>Pesan</th>
                                        <th>Attachment</th>
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
                                            170226#1
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

                                        <td style="max-width:350px;">
                                            <div class="font-weight-500 mb-1">
                                                Permintaan Pembuatan Website Company Profile
                                            </div>

                                            <div class="text-muted small">
                                                Halo admin, saya ingin menanyakan estimasi
                                                biaya pembuatan website company profile
                                                lengkap dengan halaman layanan dan contact us.
                                            </div>
                                        </td>

                                        <td>
                                            <a href="#"
                                                class="btn btn-light border btn-sm d-inline-flex align-items-center text-primary" title="Lihat File" target="_blank">

                                                <span class="material-icons mr-1"
                                                    style="font-size:18px;">
                                                    attach_file
                                                </span>

                                                proposal.pdf
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

                                                <button class="btn btn-sm btn-success mr-2"
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
                                            180226#2
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

                                        <td style="max-width:350px;">
                                            <div class="font-weight-500 mb-1">
                                                Konsultasi Aplikasi Mobile
                                            </div>

                                            <div class="text-muted small">
                                                Saya ingin membuat aplikasi mobile Android
                                                dan iOS untuk kebutuhan booking layanan
                                                online.
                                            </div>
                                        </td>

                                        <td>
                                            <a href="#"
                                                class="btn btn-light border btn-sm d-inline-flex align-items-center text-primary" title="Lihat File" target="_blank">

                                                <span class="material-icons mr-1"
                                                    style="font-size:18px;">
                                                    image
                                                </span>

                                                mockup.jpg
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

                                                <button class="btn btn-sm btn-success mr-2"
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
                                Pesan masuk dari Contact Us
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
                                            <span class="material-icons text-primary">
                                                assignment_ind
                                            </span>
                                        </div>

                                        <div>
                                            <div class="small text-muted">
                                                Tiket Keluhan
                                            </div>

                                            <div class="font-weight-500">
                                                170226#1
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

                                    <!-- ATTACHMENT -->
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

                            <!-- RIGHT SIDE -->
                            <div class="col-lg-8">

                                <div class="p-4">

                                    <!-- SUBJECT -->
                                    <div class="mb-4">

                                        <div class="small text-muted mb-2">
                                            Subject Pesan
                                        </div>

                                        <h4 class="font-weight-bold mb-0">
                                            Permintaan Pembuatan Website Company Profile
                                        </h4>

                                    </div>

                                    <!-- MESSAGE -->
                                    <div class="card border-0"
                                        style="
                                        background:#f8fafc;
                                        border-radius:16px;
                                    ">

                                        <div class="card-body p-4">

                                            <div class="d-flex align-items-center mb-4">

                                                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                                    style="
                                                    width:45px;
                                                    height:45px;
                                                    background:#eef2ff;
                                                    color:var(--primary);
                                                    font-weight:600;
                                                ">
                                                    A
                                                </div>

                                                <div>
                                                    <div class="font-weight-bold">
                                                        Andi Saputra
                                                    </div>

                                                    <div class="small text-muted">
                                                        12 Mei 2026 • 08:15 WIB
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="text-muted"
                                                style="
                                                line-height:1.9;
                                                font-size:15px;
                                            ">

                                                Halo admin,<br><br>

                                                Saya ingin menanyakan estimasi biaya
                                                pembuatan website company profile
                                                lengkap dengan halaman layanan,
                                                gallery project, dan halaman contact us.

                                                <br><br>

                                                Selain itu saya juga ingin website
                                                memiliki fitur responsive mobile dan
                                                sistem admin dashboard untuk mengelola
                                                artikel berita perusahaan.

                                                <br><br>

                                                Saya sudah melampirkan file referensi
                                                design yang diinginkan pada attachment.

                                                <br><br>

                                                Terima kasih.

                                            </div>

                                        </div>

                                    </div>

                                    <!-- ACTION -->
                                    <!-- <div class="d-flex justify-content-end mt-4">

                                        <button class="btn btn-light mr-2">
                                            <span class="material-icons mr-1">
                                                close
                                            </span>
                                            Tutup
                                        </button>

                                    </div> -->

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

                                            <select class="form-control border-0 bg-light">

                                                <option>Security</option>
                                                <option>Pengacara</option>
                                                <option>Bodyguard</option>
                                                <option>Cyber Security</option>

                                            </select>

                                        </div>

                                    </div>

                                    <!-- ID TIKET -->
                                    <div class="mb-3">

                                        <label class="small text-muted mb-2">
                                            Tiket Keluhan
                                        </label>

                                        <div class="input-group">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-0">
                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        assignment_ind
                                                    </span>
                                                </span>
                                            </div>

                                            <input type="text"
                                                class="form-control border-0 bg-light"
                                                value="170226#1"
                                                readonly>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-lg-8">

                            <div class="card border-0 shadow-sm"
                                style="border-radius:16px;">

                                <div class="card-body">

                                    <h6 class="font-weight-bold mb-4">
                                        Form Balasan
                                    </h6>

                                    <!-- JUDUL -->
                                    <div class="form-group">

                                        <label class="font-weight-500">
                                            Judul Pesan
                                        </label>

                                        <input type="text"
                                            class="form-control"
                                            placeholder="Masukkan judul pesan">

                                    </div>

                                    <!-- KONFIRMASI EMAIL -->
                                    <div class="form-group">

                                        <label class="font-weight-500">
                                            Konfirmasi Email Tujuan
                                        </label>

                                        <div class="input-group">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-0">
                                                    <span class="material-icons"
                                                        style="font-size:18px;">
                                                        email
                                                    </span>
                                                </span>
                                            </div>

                                            <input type="email"
                                                class="form-control"
                                                id="confirmReplyEmail"
                                                placeholder="Ketik ulang email tujuan">

                                        </div>

                                        <small class="text-danger d-none"
                                            id="confirmEmailError">

                                            Email konfirmasi tidak sama

                                        </small>

                                    </div>

                                    <!-- ISI -->
                                    <div class="form-group">

                                        <label class="font-weight-500">
                                            Isi Pesan
                                        </label>

                                        <textarea class="form-control"
                                            rows="9"
                                            placeholder="Tulis balasan pesan..."></textarea>

                                    </div>

                                    <!-- ATTACHMENT -->
                                    <div class="form-group mb-4">

                                        <label class="font-weight-500 d-block mb-3">
                                            Attachment File
                                        </label>

                                        <!-- UPLOAD BOX -->
                                        <label for="replyAttachmentInput"
                                            class="upload-reply-box w-100 text-center p-4">

                                            <input type="file"
                                                id="replyAttachmentInput"
                                                hidden>

                                            <span class="material-icons upload-icon mb-2">
                                                upload_file
                                            </span>

                                            <div class="font-weight-bold text-dark mb-1">
                                                Upload Attachment
                                            </div>

                                            <div class="small text-muted">
                                                PDF, DOCX, JPG, PNG, ZIP
                                            </div>

                                        </label>

                                        <!-- PREVIEW FILE -->
                                        <div id="replyAttachmentPreview"
                                            class="mt-3 d-none">

                                            <div class="card border-0 shadow-sm"
                                                style="
                border-radius:16px;
                overflow:hidden;
            ">

                                                <div class="card-body p-3">

                                                    <div class="d-flex align-items-center">

                                                        <!-- ICON -->
                                                        <div id="replyPreviewIcon"
                                                            class="rounded d-flex align-items-center justify-content-center mr-3"
                                                            style="
                            width:60px;
                            height:60px;
                            background:#eef2ff;
                            color:var(--primary);
                        ">

                                                            <span class="material-icons">
                                                                description
                                                            </span>

                                                        </div>

                                                        <!-- FILE INFO -->
                                                        <div class="flex-grow-1">

                                                            <div class="font-weight-bold text-dark"
                                                                id="replyFileName">

                                                                nama-file.pdf

                                                            </div>

                                                            <div class="small text-muted"
                                                                id="replyFileSize">

                                                                0 KB

                                                            </div>

                                                        </div>

                                                        <!-- REMOVE -->
                                                        <button type="button"
                                                            class="btn btn-light border rounded-circle ml-2"
                                                            id="removeReplyAttachment"
                                                            style="
                            width:42px;
                            height:42px;
                        ">

                                                            <span class="material-icons text-danger"
                                                                style="font-size:20px;">
                                                                close
                                                            </span>

                                                        </button>

                                                    </div>

                                                    <!-- IMAGE PREVIEW -->
                                                    <div id="replyImagePreviewWrapper"
                                                        class="mt-3 d-none">

                                                        <img id="replyImagePreview"
                                                            class="img-fluid rounded shadow-sm"
                                                            style="
                            max-height:260px;
                            object-fit:cover;
                            width:100%;
                        ">
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- ACTION -->
                                    <div class="d-flex justify-content-end">

                                        <button type="submit"
                                            class="btn btn-success"
                                            id="btnSendReply">

                                            <span class="material-icons mr-1">
                                                send
                                            </span>

                                            Kirim Balasan

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

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

    <!-- ===================================== -->
    <!-- LOADING KIRIM EMAIL -->
    <!-- ===================================== -->
    <div class="modal fade"
        id="sendingReplyModal"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow"
                style="border-radius:22px; overflow:hidden;">

                <div class="modal-body text-center py-5">

                    <div class="mb-4">

                        <div class="position-relative d-inline-flex align-items-center justify-content-center">

                            <div class="spinner-border text-success"
                                style="width:5rem;height:5rem;">
                            </div>

                            <span class="material-icons position-absolute text-success"
                                style="font-size:34px;">
                                send
                            </span>

                        </div>

                    </div>

                    <h4 class="font-weight-bold mb-2">
                        Pesan Sedang Dikirim...
                    </h4>

                    <p class="text-muted mb-0">
                        Mohon tunggu sebentar
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- ===================================== -->
    <!-- MODAL SUKSES BALAS PESAN -->
    <!-- ===================================== -->
    <div class="modal fade"
        id="successReplyModal"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow"
                style="border-radius:22px; overflow:hidden;">

                <div class="modal-body text-center p-5">

                    <div class="mb-4">

                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="
                        width:95px;
                        height:95px;
                        background:#ecfdf3;
                    ">

                            <span class="material-icons text-success"
                                style="font-size:52px;">
                                check_circle
                            </span>

                        </div>

                    </div>

                    <h3 class="font-weight-bold mb-3">
                        Pesan Berhasil Dikirim
                    </h3>

                    <p class="text-muted mb-4"
                        id="successReplyText"
                        style="
                    line-height:1.8;
                    font-size:15px;
                ">
                        Pesan berhasil dikirim
                    </p>

                    <button class="btn btn-success px-4"
                        data-dismiss="modal">

                        Oke

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
                tiket: "170226#01",
                nama: "Andi Saputra",
                email: "andi@gmail.com",
                phone: "+62 812-3344-5566",
                layanan: "Security",
                subject: "Permintaan Website Company Profile",
                pesan: "Halo admin, saya ingin menanyakan estimasi biaya website company profile.",
                attachment: "proposal.pdf",
                tanggal: "12/05/2026",
                jam: "08:15 WIB",
                isNew: true
            },
            {
                id: 2,
                tiket: "170226#02",
                nama: "Sarah Wijaya",
                email: "sarah@gmail.com",
                phone: "+62 878-1111-2222",
                layanan: "Pengacara",
                subject: "Konsultasi Aplikasi Mobile",
                pesan: "Saya ingin membuat aplikasi Android dan iOS.",
                attachment: "mockup.jpg",
                tanggal: "11/05/2026",
                jam: "16:42 WIB",
                isNew: false
            },
            {
                id: 3,
                tiket: "170226#03",
                nama: "Jonathan",
                email: "jonathan@gmail.com",
                phone: "+62 812-8888-1111",
                layanan: "Cyber Security",
                subject: "Audit Sistem Keamanan",
                pesan: "Kami membutuhkan audit keamanan jaringan perusahaan.",
                attachment: "security.pdf",
                tanggal: "10/05/2026",
                jam: "11:00 WIB",
                isNew: true
            },
            {
                id: 4,
                tiket: "170226#04",
                nama: "Michael",
                email: "michael@gmail.com",
                phone: "+62 811-2222-9999",
                layanan: "Bodyguard",
                subject: "Permintaan Bodyguard VIP",
                pesan: "Membutuhkan bodyguard untuk event pribadi.",
                attachment: "event.docx",
                tanggal: "09/05/2026",
                jam: "14:10 WIB",
                isNew: false
            },
            {
                id: 5,
                tiket: "170226#05",
                nama: "Rina Putri",
                email: "rina@gmail.com",
                phone: "+62 813-1111-8888",
                layanan: "Security",
                subject: "Penawaran Kerjasama",
                pesan: "Kami tertarik bekerjasama dalam bidang keamanan.",
                attachment: "kerjasama.pdf",
                tanggal: "08/05/2026",
                jam: "09:45 WIB",
                isNew: true
            },
            {
                id: 6,
                tiket: "170226#06",
                nama: "Kevin",
                email: "kevin@gmail.com",
                phone: "+62 821-3333-1111",
                layanan: "Pengacara",
                subject: "Konsultasi Hukum",
                pesan: "Butuh konsultasi hukum perusahaan.",
                attachment: "legal.pdf",
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
                        <div class="d-flex align-items-center">
                            ${item.tiket}
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

                        <a href="uploads/${item.attachment}"
                            target="_blank" title="Lihat File" 
                            class="btn btn-light border btn-sm d-inline-flex align-items-center">

                            <span class="material-icons mr-1"
                                style="font-size:16px;">
                                attach_file
                            </span>

                            ${item.attachment}

                        </a>

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

            selectedDeleteRow = $(this).closest("tr");

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
                tiket: "170226#07",
                nama: "Client Baru",
                email: "clientbaru@gmail.com",
                phone: "+62 811-7777-8888",
                layanan: "Security",
                subject: "Request Penawaran",
                pesan: "Halo admin, saya ingin penawaran harga.",
                attachment: "penawaran.pdf"
            },

            {
                tiket: "170226#08",
                nama: "Budi",
                email: "budi@gmail.com",
                phone: "+62 878-2222-1111",
                layanan: "Cyber Security",
                subject: "Audit Server",
                pesan: "Kami membutuhkan audit server perusahaan.",
                attachment: "audit.pdf"
            }

        ];

        setInterval(() => {

            const random =
                simulasiPesanBaru[Math.floor(Math.random() * simulasiPesanBaru.length)];

            const now = new Date();

            const newMessage = {

                id: pesanMasukData.length + 1,

                tiket: random.tiket,

                nama: random.nama,

                email: random.email,

                phone: random.phone,

                layanan: random.layanan,

                subject: random.subject,

                pesan: random.pesan,

                attachment: random.attachment,

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
    </script>

    <script>
        // =====================================
        // KIRIM BALASAN EMAIL
        // =====================================
        $("#btnSendReply").on("click", function() {

            // ambil data
            const targetEmail =
                $("#replyPesanModal input[type='email']").first().val();

            const confirmEmail =
                $("#confirmReplyEmail").val();

            const judulPesan =
                $("#replyPesanModal input[type='text'][placeholder='Masukkan judul pesan']").val();

            const isiPesan =
                $("#replyPesanModal textarea").val();

            // reset error
            $("#confirmEmailError").addClass("d-none");

            // validasi kosong
            if (
                judulPesan.trim() === "" ||
                isiPesan.trim() === "" ||
                confirmEmail.trim() === ""
            ) {

                alert("Lengkapi form balasan terlebih dahulu");
                return;
            }

            // validasi email sama
            if (targetEmail !== confirmEmail) {

                $("#confirmEmailError").removeClass("d-none");

                $("#confirmReplyEmail").focus();

                return;
            }

            // tutup modal balasan
            $("#replyPesanModal").modal("hide");

            // tampilkan loading
            $("#sendingReplyModal").modal("show");

            // simulasi proses kirim
            setTimeout(() => {

                // tutup loading
                $("#sendingReplyModal").modal("hide");

                // isi text sukses
                $("#successReplyText").html(`
            Pesan balasan
            <b>"${judulPesan}"</b>
            telah dikirim ke email
            <b>${targetEmail}</b>
        `);

                // tampilkan modal sukses
                $("#successReplyModal").modal("show");

                // reset form
                $("#confirmReplyEmail").val("");

                $("#replyPesanModal input[type='text'][placeholder='Masukkan judul pesan']").val("");

                $("#replyPesanModal textarea").val("");

            }, 2200);

        });
    </script>

    <script>
        // =====================================
        // PREVIEW ATTACHMENT BALASAN
        // =====================================
        const replyAttachmentInput =
            document.getElementById("replyAttachmentInput");

        const replyAttachmentPreview =
            document.getElementById("replyAttachmentPreview");

        const replyFileName =
            document.getElementById("replyFileName");

        const replyFileSize =
            document.getElementById("replyFileSize");

        const replyPreviewIcon =
            document.getElementById("replyPreviewIcon");

        const removeReplyAttachment =
            document.getElementById("removeReplyAttachment");

        const replyImagePreviewWrapper =
            document.getElementById("replyImagePreviewWrapper");

        const replyImagePreview =
            document.getElementById("replyImagePreview");

        // =====================================
        // FILE CHANGE
        // =====================================
        replyAttachmentInput.addEventListener("change", function(e) {

            const file = e.target.files[0];

            if (!file) return;

            // tampilkan preview
            replyAttachmentPreview.classList.remove("d-none");

            // nama file
            replyFileName.textContent = file.name;

            // ukuran file
            const fileSize =
                (file.size / 1024).toFixed(1);

            replyFileSize.textContent =
                `${fileSize} KB`;

            // reset preview image
            replyImagePreviewWrapper.classList.add("d-none");

            // extension
            const extension =
                file.name.split('.').pop().toLowerCase();

            // default icon
            let icon = "description";
            let bg = "#eef2ff";
            let color = "#4f46e5";

            // PDF
            if (extension === "pdf") {
                icon = "picture_as_pdf";
                bg = "#fee2e2";
                color = "#dc2626";
            }

            // IMAGE
            else if (
                ["jpg", "jpeg", "png", "webp"].includes(extension)
            ) {

                icon = "image";
                bg = "#ecfdf3";
                color = "#16a34a";

                // preview image
                const reader = new FileReader();

                reader.onload = function(event) {

                    replyImagePreview.src =
                        event.target.result;

                    replyImagePreviewWrapper.classList.remove("d-none");

                };

                reader.readAsDataURL(file);

            }

            // DOC / DOCX
            else if (
                ["doc", "docx"].includes(extension)
            ) {

                icon = "description";
                bg = "#eff6ff";
                color = "#2563eb";

            }

            // ZIP
            else if (
                ["zip", "rar"].includes(extension)
            ) {

                icon = "folder_zip";
                bg = "#fff7ed";
                color = "#ea580c";

            }

            // update icon
            replyPreviewIcon.innerHTML = `
        <span class="material-icons"
            style="font-size:30px;color:${color};">
            ${icon}
        </span>
    `;

            replyPreviewIcon.style.background = bg;

        });

        // =====================================
        // REMOVE FILE
        // =====================================
        removeReplyAttachment.addEventListener("click", function() {

            // reset input
            replyAttachmentInput.value = "";

            // hide preview
            replyAttachmentPreview.classList.add("d-none");

            // reset image
            replyImagePreview.src = "";

        });
    </script>

</body>

</html>