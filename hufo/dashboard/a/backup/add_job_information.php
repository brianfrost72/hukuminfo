<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Info Loker - Dashboard | Konig Guard Bureau</title>

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
                                        Tambah Info Lowongan Kerja
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Tambah Info Lowongan Kerja</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="card mt-4" style="border-radius:10px;">
                    <div class="card-body">

                        <!-- TITLE -->
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <h4 class="mb-0">Tambah Info Lowongan Kerja</h4>
                                <small class="text-muted">Lengkapi informasi lowongan kerja di bawah ini</small>
                            </div>
                        </div>

                        <!-- FORM -->
                        <form>

                            <!-- JUDUL -->
                            <div class="form-group">
                                <label>Judul Lowongan Kerja <span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="Contoh: Frontend Developer">
                            </div>

                            <!-- LOKASI -->
                            <div class="form-group">
                                <label>Lokasi <span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="Contoh: Jakarta">
                            </div>

                            <!-- JENIS -->
                            <div class="form-group">
                                <label>Jenis Lowongan <span style="color:red">*</span></label>
                                <select class="form-control">
                                    <option value="">Pilih jenis lowongan</option>
                                    <option>Full Time</option>
                                    <option>Part Time</option>
                                    <option>Freelance</option>
                                    <option>Magang</option>
                                </select>
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="form-group">
                                <label>Deskripsi Lowongan <span style="color:red">*</span></label>

                                <!-- TOOLBAR SIMPLE -->
                                <div style="border:1px solid #dbe5ee; border-bottom:none; padding:8px; background:#f5f7fb;">
                                    <span class="material-icons" style="font-size:18px; cursor:pointer;">format_bold</span>
                                    <span class="material-icons" style="font-size:18px; cursor:pointer;">format_italic</span>
                                    <span class="material-icons" style="font-size:18px; cursor:pointer;">format_underlined</span>
                                    <span class="material-icons" style="font-size:18px; cursor:pointer;">format_list_bulleted</span>
                                    <span class="material-icons" style="font-size:18px; cursor:pointer;">format_align_left</span>
                                </div>

                                <textarea class="form-control" rows="5" placeholder="Tulis deskripsi lowongan kerja di sini..."></textarea>
                            </div>

                            <!-- KOUTA -->
                            <div class="form-group">
                                <label>Kuota Pelamar <span style="color:red">*</span></label>
                                <input type="number" class="form-control" placeholder="Contoh: 5">
                            </div>

                            <!-- TANGGAL -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Post <span style="color:red">*</span></label>
                                        <div class="d-flex align-items-center">
                                            <input type="date" class="form-control">
                                            <span class="material-icons ml-2">calendar_today</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Tutup Loker <span style="color:red">*</span></label>
                                        <div class="d-flex align-items-center">
                                            <input type="date" class="form-control">
                                            <span class="material-icons ml-2">event_busy</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- LINK -->
                            <div class="form-group">
                                <label>Link Loker <span style="color:red">*</span></label>
                                <div class="d-flex align-items-center">
                                    <span class="material-icons mr-2">link</span>
                                    <input type="url" class="form-control" placeholder="https://example.com/lowongan">
                                </div>
                            </div>

                            <!-- BUTTON -->
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="material-icons" style="font-size:18px; vertical-align:middle;">send</span>
                                    Submit
                                </button>
                            </div>

                        </form>

                        <!-- ALERT -->
                        <div class="mt-4 p-3" style="background:#eef3ff; border-radius:8px;">
                            <span class="material-icons mr-2" style="vertical-align:middle; color:var(--primary);">info</span>
                            Pastikan semua informasi sudah benar sebelum menekan tombol Submit.
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

    <!-- MODAL SUKSES POSTING -->
    <div class="modal fade" id="modalPostingBerhasil" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0" style="border-radius:18px; overflow:hidden;">

                <!-- BODY -->
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
                    <h4 class="mb-2 font-weight-bold">
                        Posting Berhasil
                    </h4>

                    <!-- TEXT -->
                    <p class="text-muted mb-4" id="textPostingBerhasil">
                        Lowongan berhasil di posting
                    </p>

                    <!-- BUTTON -->
                    <button type="button"
                        class="btn btn-success px-4"
                        id="btnOkayPosting"
                        style="
                        border-radius:10px;
                        height:45px;
                        min-width:120px;
                    ">
                        Okay
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
        // FORM SUBMIT
        $('form').on('submit', function(e) {
            e.preventDefault();

            // AMBIL JUDUL LOWONGAN
            let judul = $('input[type="text"]').first().val();

            // VALIDASI TEXT
            if (judul.trim() === '') {
                judul = 'Lowongan';
            }

            // SET TEXT MODAL
            $('#textPostingBerhasil').html(
                '<b>' + judul + '</b> berhasil di posting'
            );

            // SHOW MODAL
            $('#modalPostingBerhasil').modal('show');
        });

        // BUTTON OKAY
        $('#btnOkayPosting').on('click', function() {
            location.reload();
        });
    </script>
</body>

</html>