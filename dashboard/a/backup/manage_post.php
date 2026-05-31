<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Daftar Postingan - Dashboard | Konig Guard Bureau</title>


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
                                        Daftar Postingan
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Daftar Postingan</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- HEADER -->
                <div class="card mt-4 mb-4" style="border-radius:12px;">
                    <div class="card-body d-flex justify-content-between align-items-center flex-wrap">

                        <div class="d-flex align-items-center">
                            <div style="width:65px;height:65px;border-radius:12px;background:#eef2ff;
                display:flex;align-items:center;justify-content:center;margin-right:18px;">
                                <span class="material-icons" style="font-size:34px;color:var(--primary);">
                                    add_box
                                </span>
                            </div>

                            <div>
                                <h3 class="mb-1">Daftar Postingan</h3>
                                <small class="text-muted">
                                    Kelola semua postingan.
                                </small>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- STATISTIC -->
                <div class="row mb-4">

                    <div class="col-md-3">
                        <div class="card stats-card" style="border-radius:12px;">
                            <div class="card-body d-flex align-items-center">

                                <div style="width:60px;height:60px;border-radius:12px;
                    background:#eef2ff;display:flex;align-items:center;
                    justify-content:center;margin-right:15px;">
                                    <span class="material-icons" style="color:var(--primary);font-size:30px;">
                                        layers
                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0">12</h3>
                                    <small class="text-muted">Total Postingan</small>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stats-card" style="border-radius:12px;">
                            <div class="card-body d-flex align-items-center">

                                <div style="width:60px;height:60px;border-radius:12px;
                    background:#eafaf1;display:flex;align-items:center;
                    justify-content:center;margin-right:15px;">
                                    <span class="material-icons" style="color:var(--primary);font-size:30px;">
                                        collections
                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0">8</h3>
                                    <small class="text-muted">Kategori</small>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stats-card" style="border-radius:12px;">
                            <div class="card-body d-flex align-items-center">

                                <div style="width:60px;height:60px;border-radius:12px;
                    background:#f3f4f6;display:flex;align-items:center;
                    justify-content:center;margin-right:15px;">
                                    <span class="material-icons" style="color:var(--success);font-size:30px;">
                                        cast_connected
                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0">4</h3>
                                    <small class="text-muted">Postingan Aktif</small>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stats-card" style="border-radius:12px;">
                            <div class="card-body d-flex align-items-center">

                                <div style="width:60px;height:60px;border-radius:12px;
                    background:#f3f4f6;display:flex;align-items:center;
                    justify-content:center;margin-right:15px;">
                                    <span class="material-icons" style="color:var(--danger);font-size:30px;">
                                        cast
                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0">4</h3>
                                    <small class="text-muted">Postingan Tidak Aktif</small>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- TABLE HEAD -->
                <div class="card" style="border-radius:12px;">
                    <div class="card-body">

                        <!-- FILTER -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4"
                            style="gap:15px;">

                            <!-- LEFT FILTER -->
                            <div class="d-flex align-items-center flex-wrap"
                                style="gap:15px;">

                                <!-- SHOW ENTRIES -->
                                <div class="d-flex align-items-center">
                                    <label class="mb-0 mr-2 text-muted" style="white-space:nowrap;">
                                        Show
                                    </label>

                                    <select id="showEntries" class="form-control"
                                        style="width:80px;">
                                        <option>10</option>
                                        <option>25</option>
                                        <option>50</option>
                                        <option>100</option>
                                    </select>

                                    <label class="mb-0 ml-2 text-muted" style="white-space:nowrap;">
                                        entries
                                    </label>
                                </div>

                                <!-- SEARCH -->
                                <div style="position:relative;">
                                    <span class="material-icons"
                                        style="position:absolute;
                left:12px;
                top:50%;
                transform:translateY(-50%);
                color:#999;
                font-size:20px;">
                                        search
                                    </span>

                                    <input id="searchInput" type="text"
                                        class="form-control"
                                        placeholder="Cari Postingan..."
                                        style="padding-left:40px;width:260px;">
                                </div>

                            </div>

                            <!-- RIGHT FILTER -->
                            <div class="d-flex align-items-center flex-wrap"
                                style="gap:15px;">

                                <!-- TYPE -->
                                <select id="categoryFilter" class="form-control"
                                    style="width:190px;">
                                    <option>--Pilih Kategori--</option>
                                    <option>Semua Tipe</option>
                                    <option>Berita</option>
                                    <option>Artikel</option>
                                    <option>Blog</option>
                                </select>

                                <!-- LOKASI -->
                                <select id="subCategoryFilter" class="form-control"
                                    style="width:190px;">
                                    <option>--Pilih Sub Kategori--</option>
                                    <option>Semua Sub Kategori</option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>

                                <!-- STATUS -->
                                <select id="statusFilter" class="form-control"
                                    style="width:170px;">
                                    <option>--Status--</option>
                                    <option>Semua Status</option>
                                    <option>Aktif</option>
                                    <option>Tidak Aktif</option>
                                </select>

                            </div>

                        </div>

                        <!-- TABLE CONTAIN -->
                        <div class="table-responsive">

                            <table class="table table-hover">

                                <thead style="background:#f8f9fc;">
                                    <tr>
                                        <th>Judul Postingan</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Gambar</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th style="text-align:center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="jobTable">

                                    <tr class="post-row">
                                        <td>
                                            <strong>Kisah Pengalaman Kerja</strong>
                                        </td>

                                        <td>Berita</td>
                                        <td>Pembobolan</td>
                                        <td>
                                            <img src="assets/images/posts/luke-chesser-2347.jpg"
                                                alt="Thumbnail"
                                                style="
            width:70px;
            height:50px;
            object-fit:cover;
            border-radius:8px;
            border:1px solid #e5e7eb;
        ">
                                        </td>
                                        <td>
                                            Kejadian ini terjadi pada tahun 2010. Setelah sekitar 5 tahun lalu, saya terlibat dalam pembobolan di sebuah perusahaan.
                                        </td>

                                        <td>
                                            <span class="badge badge-success"
                                                style="padding:8px 14px;border-radius:8px;">
                                                Aktif
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center">

                                                <button class="btn btn-outline-primary btn-sm mr-2"
                                                    onclick="toggleStatus(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        block
                                                    </span>
                                                    Tidak Aktif
                                                </button>

                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteRow(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        delete
                                                    </span>
                                                    Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="post-row">
                                        <td>
                                            <strong>Telah terjadi kerusuhan</strong><br>
                                        </td>

                                        <td>Artikel</td>
                                        <td>Kisah Nyata</td>
                                        <td>
                                            <img src="assets/images/posts/linkedin-sales-navigator-402873.jpg"
                                                alt="Thumbnail"
                                                style="
            width:70px;
            height:50px;
            object-fit:cover;
            border-radius:8px;
            border:1px solid #e5e7eb;
        ">
                                        </td>
                                        <td>
                                            Kejadian ini terjadi pada tahun 2010. Setelah sekitar 5 tahun lalu, saya terlibat dalam pembobolan di sebuah perusahaan.
                                        </td>

                                        <td>
                                            <span class="badge badge-danger"
                                                style="padding:8px 14px;border-radius:8px;">
                                                Tidak Aktif
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center">

                                                <button class="btn btn-outline-primary btn-sm mr-2"
                                                    onclick="toggleStatus(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        block
                                                    </span>
                                                    Tidak Aktif
                                                </button>

                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteRow(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        delete
                                                    </span>
                                                    Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="post-row">
                                        <td>
                                            <strong>Ini Blog saya</strong><br>
                                        </td>

                                        <td>Blog</td>
                                        <td>Kisah Pengalaman Kerja</td>
                                        <td>
                                            <img src="assets/images/posts/fabian-irsara-92113.jpg"
                                                alt="Thumbnail"
                                                style="
            width:70px;
            height:50px;
            object-fit:cover;
            border-radius:8px;
            border:1px solid #e5e7eb;
        ">
                                        </td>
                                        <td>
                                            Ini adalah kisah saya. Setelah sekitar 5 tahun lalu, saya terlibat dalam pembobolan di sebuah perusahaan.
                                        </td>

                                        <td>
                                            <span class="badge badge-success"
                                                style="padding:8px 14px;border-radius:8px;">
                                                Aktif
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center">

                                                <button class="btn btn-outline-primary btn-sm mr-2"
                                                    onclick="toggleStatus(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        block
                                                    </span>
                                                    Tidak Aktif
                                                </button>

                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteRow(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        delete
                                                    </span>
                                                    Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        <!-- PAGINATION -->
                        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap"
                            style="gap:15px;">

                            <!-- INFO -->
                            <small class="text-muted" id="paginationInfo">
                                Menampilkan 1 - 10 dari 120 data
                            </small>

                            <!-- PAGINATION -->
                            <div id="pagination"
                                class="d-flex align-items-center flex-wrap"
                                style="gap:6px; max-width:100%; overflow-x:auto; padding-bottom:4px;">

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

    <!-- =========================
    MODAL KONFIRMASI AKTIFKAN
========================= -->
    <div class="modal fade" id="confirmAktifModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0"
                style="border-radius:20px;overflow:hidden;">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#ecfdf3;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                    ">
                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#16a34a;
                        ">
                            help
                        </span>
                    </div>

                    <h3 class="mb-2">
                        Aktifkan Postingan?
                    </h3>

                    <p class="text-muted mb-4">
                        Apakah postingan
                        <strong id="aktifPostTitle"></strong>
                        ingin diaktifkan?
                    </p>

                    <div class="d-flex justify-content-center"
                        style="gap:12px;">

                        <button type="button"
                            class="btn btn-light"
                            data-dismiss="modal"
                            style="
                            height:45px;
                            border-radius:10px;
                            min-width:110px;
                            font-weight:600;
                        ">
                            Batal
                        </button>

                        <button type="button"
                            class="btn btn-success"
                            id="btnConfirmAktif"
                            style="
                            height:45px;
                            border-radius:10px;
                            min-width:110px;
                            font-weight:600;
                        ">
                            Ya, Aktifkan
                        </button>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- =========================
    MODAL KONFIRMASI NONAKTIF
========================= -->
    <div class="modal fade" id="confirmNonaktifModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0"
                style="border-radius:20px;overflow:hidden;">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#fff1f2;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                    ">
                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#dc2626;
                        ">
                            help
                        </span>
                    </div>

                    <h3 class="mb-2">
                        Nonaktifkan Postingan?
                    </h3>

                    <p class="text-muted mb-4">
                        Apakah postingan
                        <strong id="nonaktifPostTitle"></strong>
                        ingin dinonaktifkan?
                    </p>

                    <div class="d-flex justify-content-center"
                        style="gap:12px;">

                        <button type="button"
                            class="btn btn-light"
                            data-dismiss="modal"
                            style="
                            height:45px;
                            border-radius:10px;
                            min-width:110px;
                            font-weight:600;
                        ">
                            Batal
                        </button>

                        <button type="button"
                            class="btn btn-danger"
                            id="btnConfirmNonaktif"
                            style="
                            height:45px;
                            border-radius:10px;
                            min-width:110px;
                            font-weight:600;
                        ">
                            Ya, Nonaktifkan
                        </button>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- =========================
    MODAL VALIDASI AKTIF
========================= -->
    <div class="modal fade" id="modalAktif" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0"
                style="border-radius:20px;overflow:hidden;">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#ecfdf3;
                        display:flex;
                        align-items:center;
                        justify-content:center;
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
                    <p class="text-muted mb-4">
                        Postingan
                        <strong id="successAktifTitle"></strong>
                        berhasil diaktifkan.
                    </p>

                    <!-- DESC -->
                    <p class="text-muted mb-4">
                        Status postingan telah berhasil diubah menjadi aktif.
                    </p>

                    <!-- BUTTON -->
                    <button type="button"
                        class="btn btn-success px-4"
                        data-dismiss="modal"
                        style="
                        border-radius:10px;
                        height:45px;
                        font-weight:600;
                    ">
                        Oke
                    </button>

                </div>

            </div>
        </div>
    </div>

    <!-- =========================
    MODAL VALIDASI TIDAK AKTIF
========================= -->
    <div class="modal fade" id="modalNonaktif" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0"
                style="border-radius:20px;overflow:hidden;">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#fff1f2;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                    ">
                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#dc2626;
                        ">
                            block
                        </span>
                    </div>

                    <!-- TITLE -->
                    <p class="text-muted mb-4">
                        Postingan
                        <strong id="successNonaktifTitle"></strong>
                        berhasil dinonaktifkan.
                    </p>

                    <!-- DESC -->
                    <p class="text-muted mb-4">
                        Status postingan berhasil diubah menjadi tidak aktif.
                    </p>

                    <!-- BUTTON -->
                    <button type="button"
                        class="btn btn-danger px-4"
                        data-dismiss="modal"
                        style="
                        border-radius:10px;
                        height:45px;
                        font-weight:600;
                    ">
                        Oke
                    </button>

                </div>

            </div>
        </div>
    </div>

    <!-- =========================
    MODAL KONFIRMASI HAPUS
========================= -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0"
                style="border-radius:20px;overflow:hidden;">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#fff1f2;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                    ">
                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#dc2626;
                        ">
                            delete
                        </span>
                    </div>

                    <h3 class="mb-2">
                        Hapus Postingan?
                    </h3>

                    <p class="text-muted mb-4">
                        Apakah postingan
                        <strong id="deletePostTitle"></strong>
                        ingin dihapus?
                    </p>

                    <div class="d-flex justify-content-center"
                        style="gap:12px;">

                        <button type="button"
                            class="btn btn-light"
                            data-dismiss="modal"
                            style="
                            height:45px;
                            border-radius:10px;
                            min-width:110px;
                            font-weight:600;
                        ">
                            Batal
                        </button>

                        <button type="button"
                            class="btn btn-danger"
                            id="btnConfirmDelete"
                            style="
                            height:45px;
                            border-radius:10px;
                            min-width:110px;
                            font-weight:600;
                        ">
                            Ya, Hapus
                        </button>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- =========================
    MODAL SUKSES HAPUS
========================= -->
    <div class="modal fade" id="modalDeleteSuccess" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0"
                style="border-radius:20px;overflow:hidden;">

                <div class="modal-body text-center p-5">

                    <div class="mx-auto mb-4"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#fff1f2;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                    ">
                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#dc2626;
                        ">
                            delete_forever
                        </span>
                    </div>

                    <h3 class="mb-2">
                        Postingan Berhasil Dihapus
                    </h3>

                    <p class="text-muted mb-4">
                        Postingan
                        <strong id="deletedPostTitle"></strong>
                        telah dihapus.
                    </p>

                    <button type="button"
                        class="btn btn-danger px-4"
                        data-dismiss="modal"
                        style="
                        border-radius:10px;
                        height:45px;
                        font-weight:600;
                    ">
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
        let currentPage = 1;
        let perPage = 10;

        const searchInput = document.getElementById("searchInput");
        const categoryFilter = document.getElementById("categoryFilter");
        const subCategoryFilter = document.getElementById("subCategoryFilter");
        const statusFilter = document.getElementById("statusFilter");
        const showEntries = document.getElementById("showEntries");

        function getFilteredRows() {

            const search = searchInput.value.toLowerCase();
            const category = categoryFilter.value.toLowerCase();
            const subCategory = subCategoryFilter.value.toLowerCase();
            const status = statusFilter.value.toLowerCase();

            const rows = document.querySelectorAll(".post-row");

            return Array.from(rows).filter((row) => {

                const title = row.children[0].innerText.toLowerCase();
                const kategori = row.children[1].innerText.toLowerCase();
                const subkategori = row.children[2].innerText.toLowerCase();
                const statusText = row.children[5].innerText.trim().toLowerCase();

                const matchSearch =
                    title.includes(search);

                const matchCategory =
                    category.includes("--pilih") ||
                    category.includes("semua") ||
                    kategori.includes(category);

                const matchSubCategory =
                    subCategory.includes("--pilih") ||
                    subCategory.includes("semua") ||
                    subkategori.includes(subCategory);

                const matchStatus =
                    status.includes("--status") ||
                    status.includes("semua") ||
                    statusText.includes(status);

                return (
                    matchSearch &&
                    matchCategory &&
                    matchSubCategory &&
                    matchStatus
                );
            });
        }

        function renderTable() {

            const rows = getFilteredRows();

            perPage = parseInt(showEntries.value);

            const totalData = rows.length;
            const totalPages = Math.ceil(totalData / perPage);

            if (currentPage > totalPages) {
                currentPage = 1;
            }

            document.querySelectorAll(".post-row")
                .forEach((row) => {
                    row.style.display = "none";
                });

            const start = (currentPage - 1) * perPage;
            const end = start + perPage;

            rows.slice(start, end)
                .forEach((row) => {
                    row.style.display = "";
                });

            renderPagination(totalPages, totalData);
        }

        function renderPagination(totalPages, totalData) {

            const pagination =
                document.getElementById("pagination");

            pagination.innerHTML = "";

            /* PREV */
            const prevBtn = document.createElement("button");

            prevBtn.className = "page-btn";
            prevBtn.innerHTML = "«";

            prevBtn.disabled = currentPage === 1;

            prevBtn.onclick = () => {
                currentPage--;
                renderTable();
            };

            pagination.appendChild(prevBtn);

            /* NUMBER */
            for (let i = 1; i <= totalPages; i++) {

                const btn =
                    document.createElement("button");

                btn.className = "page-btn";

                if (i === currentPage) {
                    btn.classList.add("active");
                }

                btn.innerText = i;

                btn.onclick = () => {
                    currentPage = i;
                    renderTable();
                };

                pagination.appendChild(btn);
            }

            /* NEXT */
            const nextBtn = document.createElement("button");

            nextBtn.className = "page-btn";
            nextBtn.innerHTML = "»";

            nextBtn.disabled =
                currentPage === totalPages ||
                totalPages === 0;

            nextBtn.onclick = () => {
                currentPage++;
                renderTable();
            };

            pagination.appendChild(nextBtn);

            /* INFO */
            const startData =
                totalData === 0 ?
                0 :
                ((currentPage - 1) * perPage) + 1;

            let endData = currentPage * perPage;

            if (endData > totalData) {
                endData = totalData;
            }

            document.getElementById("paginationInfo")
                .innerText =
                `Menampilkan ${startData} - ${endData} dari ${totalData} data`;
        }

        let selectedButton = null;
        let selectedRow = null;

        /* TOGGLE STATUS */
        function toggleStatus(button) {

            selectedButton = button;

            const row = button.closest("tr");

            const title =
                row.children[0].innerText.trim();

            const badge =
                row.children[5].querySelector(".badge");

            const currentStatus =
                badge.innerText.trim();

            if (currentStatus === "Aktif") {

                document.getElementById(
                    "nonaktifPostTitle"
                ).innerText = `"${title}"`;

                $("#confirmNonaktifModal").modal("show");

            } else {

                document.getElementById(
                    "aktifPostTitle"
                ).innerText = `"${title}"`;

                $("#confirmAktifModal").modal("show");
            }
        }

        /* KONFIRMASI AKTIFKAN */
        document.getElementById("btnConfirmAktif")
            .addEventListener("click", function() {

                const row =
                    selectedButton.closest("tr");

                const title =
                    row.children[0].innerText.trim();

                const badge =
                    row.children[5].querySelector(".badge");

                badge.classList.remove("badge-danger");
                badge.classList.add("badge-success");

                badge.innerText = "Aktif";

                selectedButton.innerHTML = `
                <span class="material-icons"
                    style="font-size:16px;vertical-align:middle;">
                    block
                </span>
                Tidak Aktif
            `;

                document.getElementById(
                    "successAktifTitle"
                ).innerText = `"${title}"`;

                $("#confirmAktifModal").modal("hide");

                setTimeout(() => {
                    $("#modalAktif").modal("show");
                }, 400);

                renderTable();
            });

        /* KONFIRMASI NONAKTIF */
        document.getElementById("btnConfirmNonaktif")
            .addEventListener("click", function() {

                const row =
                    selectedButton.closest("tr");

                const title =
                    row.children[0].innerText.trim();

                const badge =
                    row.children[5].querySelector(".badge");

                badge.classList.remove("badge-success");
                badge.classList.add("badge-danger");

                badge.innerText = "Tidak Aktif";

                selectedButton.innerHTML = `
                <span class="material-icons"
                    style="font-size:16px;vertical-align:middle;">
                    check
                </span>
                Aktifkan
            `;

                document.getElementById(
                    "successNonaktifTitle"
                ).innerText = `"${title}"`;

                $("#confirmNonaktifModal").modal("hide");

                setTimeout(() => {
                    $("#modalNonaktif").modal("show");
                }, 400);

                renderTable();
            });

        /* DELETE */
        function deleteRow(button) {

            selectedRow =
                button.closest("tr");

            const title =
                selectedRow.children[0].innerText.trim();

            document.getElementById(
                "deletePostTitle"
            ).innerText = `"${title}"`;

            $("#confirmDeleteModal").modal("show");
        }

        /* KONFIRMASI DELETE */
        document.getElementById("btnConfirmDelete")
            .addEventListener("click", function() {

                const title =
                    selectedRow.children[0].innerText.trim();

                document.getElementById(
                    "deletedPostTitle"
                ).innerText = `"${title}"`;

                $("#confirmDeleteModal").modal("hide");

                selectedRow.style.transition =
                    "all .3s ease";

                selectedRow.style.opacity = "0";

                selectedRow.style.transform =
                    "translateX(30px)";

                setTimeout(() => {

                    selectedRow.remove();

                    renderTable();

                    $("#modalDeleteSuccess").modal("show");

                }, 300);
            });

        /* EVENTS */
        searchInput.addEventListener("keyup", () => {
            currentPage = 1;
            renderTable();
        });

        categoryFilter.addEventListener("change", () => {
            currentPage = 1;
            renderTable();
        });

        subCategoryFilter.addEventListener("change", () => {
            currentPage = 1;
            renderTable();
        });

        statusFilter.addEventListener("change", () => {
            currentPage = 1;
            renderTable();
        });

        showEntries.addEventListener("change", () => {
            currentPage = 1;
            renderTable();
        });

        /* INIT */
        renderTable();
    </script>
</body>

</html>