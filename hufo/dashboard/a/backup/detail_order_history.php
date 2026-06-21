<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detail Riwayat Pesanan - Dashboard | Konig Guard Bureau</title>

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
                                        Detail Riwayat Pesanan
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Detail Riwayat Pesanan</h1>

                        </div>
                        <a href="orders_history.php"
                            class="btn btn-primary ml-1">Kembali List Order</a>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">

                <!-- HEADER -->
                <div class="card border-0 shadow-sm mt-4 mb-4"
                    style="border-radius:22px;">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">

                            <div>

                                <h3 class="font-weight-bold mb-2">
                                    Detail Pemesanan
                                </h3>

                                <div class="d-flex align-items-center flex-wrap">

                                    <span class="text-muted mr-3">
                                        Order ID : #ORD-250518-001
                                    </span>

                                    <span class="badge badge-success px-3 py-2"
                                        style="
                                border-radius:30px;
                                font-size:12px;
                            ">
                                        Transaksi Berhasil
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- PROGRESS -->
                <div class="card border-0 shadow-sm mb-4"
                    style="border-radius:22px;">

                    <div class="card-body p-4">

                        <h5 class="font-weight-bold mb-5">
                            Progress Pemesanan Jasa
                        </h5>

                        <div class="order-progress-wrapper">

                            <!-- LINE -->
                            <div class="order-progress-line"></div>

                            <!-- ACTIVE LINE -->
                            <div class="order-progress-line-active progress-step-4"></div>


                            <div class="row text-center">

                                <!-- SUCCESS -->
                                <div class="col progress-item success">

                                    <div class="progress-circle">

                                        <span class="material-icons">
                                            check
                                        </span>

                                    </div>

                                    <h6 class="mt-3 mb-1">
                                        Order Masuk
                                    </h6>

                                    <small class="text-muted">
                                        Form order diterima
                                    </small>

                                </div>


                                <!-- SUCCESS -->
                                <div class="col progress-item success">

                                    <div class="progress-circle">

                                        <span class="material-icons">
                                            check
                                        </span>

                                    </div>

                                    <h6 class="mt-3 mb-1">
                                        Simulasi Harga
                                    </h6>

                                    <small class="text-muted">
                                        Harga diberikan
                                    </small>

                                </div>


                                <!-- ON PROGRESS -->
                                <div class="col progress-item success">

                                    <div class="progress-circle">

                                        <span class="material-icons">
                                            check
                                        </span>

                                    </div>

                                    <h6 class="mt-3 mb-1">
                                        Kontrak
                                    </h6>

                                    <small class="text-muted">
                                        Sukses
                                    </small>

                                </div>


                                <!-- PENDING -->
                                <div class="col progress-item success">
                                    <!-- 
                                    <div class="progress-circle">
                                        4
                                    </div> -->

                                    <div class="progress-circle">

                                        <span class="material-icons">
                                            check
                                        </span>

                                    </div>

                                    <h6 class="mt-3 mb-1">
                                        Pembayaran
                                    </h6>

                                    <small class="text-muted">
                                        Sukses
                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- CONTENT -->
                <div class="row">

                    <!-- ORDER -->
                    <div class="col-xl-3 col-lg-6 mb-4">

                        <div class="card border-0 shadow-sm h-100"
                            style="border-radius:22px;">

                            <div class="card-body p-4"
                                style="
                overflow-y:auto;
                max-height:520px;
            ">

                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <h5 class="font-weight-bold mb-0">
                                        Order Masuk
                                    </h5>

                                    <span class="badge badge-success px-3 py-2"
                                        style="border-radius:20px;">
                                        Selesai
                                    </span>

                                </div>


                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        Nama Lengkap
                                    </small>

                                    <input class="form-control bg-light" type="text" value="Andi Saputra" disabled>

                                </div>
                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        Tipe Klien
                                    </small>

                                    <select class="form-control bg-light" disabled>
                                        <option value="1">Perusahaan</option>
                                    </select>

                                </div>


                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        Email
                                    </small>

                                    <input class="form-control bg-light" type="text" value="andi@gmail.com" disabled>

                                </div>


                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        No Telp
                                    </small>

                                    <input class="form-control bg-light" type="text" value="+628123456789" disabled>

                                </div>

                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        Jumlah Personil
                                    </small>

                                    <input class="form-control bg-light" type="text" value="5" disabled>

                                </div>


                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        Jenis Jasa
                                    </small>

                                    <select class="form-control bg-light" disabled>
                                        <option value="1">Security</option>
                                    </select>

                                </div>


                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        Lokasi Penempatan
                                    </small>

                                    <textarea class="form-control bg-light" rows="3" disabled>Jl. Pancaroba 15 Genteng, Jakarta Utara</textarea>

                                </div>

                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        Detail Kebutuhan
                                    </small>

                                    <textarea class="form-control bg-light" disabled>Ini Deskripsi</textarea>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- SIMULASI -->
                    <div class="col-xl-3 col-lg-6 mb-4 card-simulasi">

                        <div class="card border-0 shadow-sm w-100 h-100"
                            style="
            border-radius:22px;
        ">

                            <div class="card-body p-4"
                                style="
                overflow-y:auto;
                max-height:520px;
            ">

                                <!-- HEADER -->
                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <h5 class="font-weight-bold mb-0">
                                        Simulasi Harga
                                    </h5>

                                    <span class="badge badge-success px-3 py-2"
                                        style="border-radius:20px;">

                                        Selesai

                                    </span>

                                </div>


                                <!-- JASA -->
                                <div class="form-group">

                                    <label class="text-muted mb-2">
                                        Jasa Yang Dipesan
                                    </label>

                                    <input type="text"
                                        class="form-control"
                                        value="Pembuatan Website Company"
                                        disabled>

                                </div>


                                <!-- PERSONIL -->
                                <div class="form-group">

                                    <label class="text-muted mb-2">
                                        Jumlah Personil
                                    </label>

                                    <input type="text"
                                        class="form-control"
                                        value="5 Personil"
                                        disabled>

                                </div>


                                <!-- BIAYA SATUAN -->
                                <div class="form-group">

                                    <label class="text-muted mb-2">
                                        Biaya Satuan
                                    </label>

                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                Rp
                                            </span>

                                        </div>

                                        <input type="text"
                                            class="form-control rupiah biaya-satuan"
                                            value="1.500.000" disabled>

                                    </div>

                                </div>


                                <!-- SUBTOTAL -->
                                <div class="form-group">

                                    <label class="text-muted mb-2">
                                        Subtotal
                                    </label>

                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                Rp
                                            </span>

                                        </div>

                                        <input type="text"
                                            class="form-control subtotal" disabled>

                                    </div>

                                </div>


                                <!-- BIAYA LAYANAN -->
                                <div class="form-group">

                                    <label class="text-muted mb-2">
                                        Biaya Layanan
                                    </label>

                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                Rp
                                            </span>

                                        </div>

                                        <input type="text"
                                            class="form-control rupiah biaya-layanan"
                                            value="500.000" disabled>

                                    </div>

                                </div>


                                <!-- BIAYA TAMBAHAN -->
                                <div class="form-group">

                                    <label class="text-muted mb-2">
                                        Biaya Tambahan
                                    </label>

                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                Rp
                                            </span>

                                        </div>

                                        <input type="text"
                                            class="form-control rupiah biaya-tambahan"
                                            value="250.000" disabled>

                                    </div>

                                </div>


                                <!-- PAJAK -->
                                <div class="form-group">

                                    <label class="text-muted mb-2">
                                        Pajak
                                    </label>

                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text">
                                                Rp
                                            </span>

                                        </div>

                                        <input type="text"
                                            class="form-control rupiah biaya-pajak"
                                            value="825.000" disabled>

                                    </div>

                                </div>


                                <!-- TOTAL -->
                                <div class="form-group">

                                    <label class="font-weight-bold text-primary mb-2">
                                        Total Pembayaran
                                    </label>

                                    <div class="input-group">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text bg-primary text-white">
                                                Rp
                                            </span>

                                        </div>

                                        <input type="text"
                                            class="form-control font-weight-bold text-primary total-pembayaran"
                                            readonly>

                                    </div>

                                </div>


                                <!-- CATATAN -->
                                <div class="form-group mb-0">

                                    <label class="text-muted mb-2">
                                        Catatan
                                    </label>

                                    <textarea class="form-control"
                                        rows="4"
                                        placeholder="Tambahkan catatan simulasi harga..." disabled></textarea>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- KONTRAK -->
                    <div class="col-xl-3 col-lg-6 mb-4 card-kontrak">

                        <div class="card border-0 shadow-sm w-100 h-100"
                            style="
            border-radius:22px;
        ">

                            <div class="card-body p-4"
                                style="
                overflow-y:auto;
                max-height:520px;
            ">

                                <!-- HEADER -->
                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <h5 class="font-weight-bold mb-0">
                                        Kontrak
                                    </h5>

                                    <span class="badge badge-success px-3 py-2"
                                        style="border-radius:20px;">

                                        Sukses

                                    </span>

                                </div>



                                <!-- =========================
                 ADMIN UPLOAD
            ========================== -->

                                <label class="text-muted d-block mb-3">
                                    Upload Kontrak Dari Admin
                                </label>


                                <!-- FILE PREVIEW -->
                                <a href="assets/file/Kontrak.docx"
                                    target="_blank"
                                    class="text-decoration-none preview-kontrak-link">

                                    <div class="border p-3 mb-3"
                                        style="
                        border-radius:18px;
                        border-style:dashed !important;
                    ">

                                        <div class="d-flex align-items-center">

                                            <div class="mr-3 rounded d-flex align-items-center justify-content-center"
                                                style="
                                width:60px;
                                height:60px;
                                background:#edf4ff;
                                color:#4a90e2;
                            ">

                                                <span class="material-icons icon-preview-kontrak">
                                                    description
                                                </span>

                                            </div>

                                            <div class="flex-grow-1">

                                                <strong class="d-block text-dark nama-file-kontrak">
                                                    Nama File Muncul disini
                                                </strong>

                                                <small class="text-muted ukuran-file-kontrak">
                                                    Ukuran File Muncul disini
                                                </small>

                                            </div>

                                        </div>

                                    </div>

                                </a>

                                <!-- =========================
                 FILE DARI KLIEN
            ========================== -->

                                <label class="text-muted d-block mb-3">
                                    File Balasan Kontrak Dari Klien
                                </label>


                                <!-- FILE -->
                                <a href="assets/file/Kontrak_Klien.pdf"
                                    target="_blank"
                                    class="text-decoration-none">

                                    <div class="border p-3 mb-4"
                                        style="
                        border-radius:18px;
                        border-style:dashed !important;
                    ">

                                        <div class="d-flex align-items-center">

                                            <div class="mr-3 rounded d-flex align-items-center justify-content-center"
                                                style="
                                width:60px;
                                height:60px;
                                background:#e8fff2;
                                color:#28c76f;
                            ">

                                                <span class="material-icons">
                                                    description
                                                </span>

                                            </div>

                                            <div class="flex-grow-1">

                                                <strong class="d-block text-dark">
                                                    Kontrak_TTD_Klien.pdf
                                                </strong>

                                                <small class="text-muted">
                                                    1.8 MB
                                                </small>

                                            </div>

                                        </div>

                                    </div>

                                </a>

                            </div>

                        </div>

                    </div>

                    <!-- PEMBAYARAN -->
                    <div class="col-xl-3 col-lg-6 mb-4 card-pembayaran">

                        <div class="card border-0 shadow-sm w-100 h-100"
                            style="
            border-radius:22px;
        ">

                            <div class="card-body p-4"
                                style="
                overflow-y:auto;
                max-height:520px;
            ">

                                <!-- HEADER -->
                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <h5 class="font-weight-bold mb-0">
                                        Pembayaran
                                    </h5>

                                    <span class="badge badge-success px-3 py-2"
                                        style="border-radius:20px;">

                                        Sukses

                                    </span>

                                </div>



                                <!-- TOTAL PEMBAYARAN -->
                                <div class="p-4 mb-4"
                                    style="
                    background:#fff8e8;
                    border-radius:18px;
                ">

                                    <small class="text-muted d-block mb-2">
                                        Total Yang Harus Dibayarkan
                                    </small>

                                    <h3 class="font-weight-bold text-warning mb-0 pembayaran-total-text">
                                        0
                                    </h3>

                                </div>





                                <!-- INFORMASI BANK -->
                                <div class="border p-3 mb-4"
                                    style="
                    border-radius:18px;
                    border-style:dashed !important;
                ">

                                    <div class="d-flex align-items-center">

                                        <!-- LOGO -->
                                        <div class="mr-3 rounded d-flex align-items-center justify-content-center"
                                            style="
                            width:65px;
                            height:65px;
                            background:#edf4ff;
                        ">

                                            <img src="../assets/images/Bank_Central_Asia.svg"
                                                alt="BCA"
                                                style="
                                width:42px;
                            ">

                                        </div>


                                        <!-- DETAIL -->
                                        <div>

                                            <small class="text-muted d-block">
                                                Transfer Bank
                                            </small>

                                            <strong class="d-block">
                                                Bank BCA
                                            </strong>

                                            <small class="d-block">
                                                1234567890
                                            </small>

                                            <small class="text-muted">
                                                A/N PT DIGITAL INDONESIA
                                            </small>

                                        </div>

                                    </div>

                                </div>





                                <!-- NOTE -->
                                <div class="alert alert-warning mb-4"
                                    style="
                    border-radius:18px;
                ">

                                    <div class="d-flex align-items-start">

                                        <span class="material-icons mr-2">
                                            warning
                                        </span>

                                        <div>

                                            <strong class="d-block mb-1">
                                                Perhatian Pembayaran
                                            </strong>

                                            <small>
                                                Jika pesanan dibatalkan setelah proses berjalan,
                                                maka dikenakan biaya pinalti sebesar
                                                <strong>
                                                    Rp 500.000
                                                </strong>.
                                                Harap bijak dalam melakukan pemesanan
                                                di aplikasi kami.
                                            </small>

                                        </div>

                                    </div>

                                </div>

                                <!-- PREVIEW FILE -->
                                <a href="assets/file/Bukti_Transfer.pdf"
                                    target="_blank"
                                    class="text-decoration-none">

                                    <div class="border p-3 mb-4"
                                        style="
                        border-radius:18px;
                        border-style:dashed !important;
                    ">

                                        <div class="d-flex align-items-center">

                                            <div class="mr-3 rounded d-flex align-items-center justify-content-center"
                                                style="
                                width:60px;
                                height:60px;
                                background:#e8fff2;
                                color:#28c76f;
                            ">

                                                <span class="material-icons">
                                                    receipt
                                                </span>

                                            </div>

                                            <div class="flex-grow-1">

                                                <strong class="d-block text-dark">
                                                    Bukti_Transfer.pdf
                                                </strong>

                                                <small class="text-muted">
                                                    1.2 MB
                                                </small>

                                            </div>

                                        </div>

                                    </div>

                                </a>

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


</body>

</html>