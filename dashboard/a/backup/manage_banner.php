<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Member - Dashboard | Konig Guard Bureau</title>

    <!-- Perfect Scrollbar -->
    <link
        type="text/css"
        href="../assets/vendor/perfect-scrollbar.css"
        rel="stylesheet" />

    <!-- SELECT2 -->
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
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
                                        Manage Banner
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Banner</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="card shadow-sm border-0 my-4">
                    <div class="card-body">

                        <h4 class="font-weight-bold text-primary mb-4">
                            Kelola Banner Pengumuman
                        </h4>

                        <!-- SLIDE -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0 font-weight-bold">
                                        Slide 1
                                    </h5>

                                    <span class="badge badge-success px-3 py-2">
                                        Banner Aktif
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label>Judul Banner</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan judul banner">
                                </div>

                                <div class="form-group">
                                    <label>Teks Pertama</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan teks banner">
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi Banner</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan deskripsi banner">
                                </div>

                                <div class="form-group">
                                    <label>Link Banner</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan link banner">
                                </div>

                                <div class="row">

                                    <!-- LEFT -->
                                    <div class="col-lg-5">

                                        <div class="form-group">
                                            <label>Upload Banner</label>

                                            <!-- INPUT FILE -->
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input banner-input"
                                                    accept="image/*">

                                                <label class="custom-file-label">
                                                    Pilih gambar...
                                                </label>
                                            </div>

                                            <small class="text-muted">
                                                Ukuran disarankan 1920x1080 px
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Update</label>

                                            <input type="date"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Jam Update</label>

                                            <input type="time"
                                                class="form-control">
                                        </div>

                                    </div>

                                    <!-- RIGHT -->
                                    <div class="col-lg-7">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label class="font-weight-bold text-muted">
                                                    Preview Aktif
                                                </label>

                                                <div class="border rounded overflow-hidden shadow-sm">
                                                    <img src="../assets/images/default-banner.jpg"
                                                        class="img-fluid w-100 banner-active-preview"
                                                        style="height:180px; object-fit:cover;">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="font-weight-bold text-muted">
                                                    Preview Baru
                                                </label>

                                                <div class="border rounded overflow-hidden shadow-sm">
                                                    <img src="../assets/images/default-banner.jpg"
                                                        class="img-fluid w-100 banner-new-preview"
                                                        style="height:180px; object-fit:cover;">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex flex-wrap align-items-center mt-3">

                                            <button type="button"
                                                class="btn btn-success btn-update-now px-4 mr-2 mb-2">
                                                Update Sekarang
                                            </button>

                                            <button type="button"
                                                class="btn btn-primary btn-update-schedule px-4 mr-2 mb-2">
                                                Update Dengan Jadwal
                                            </button>

                                            <button type="button"
                                                class="btn btn-danger btn-stop-banner px-4 mb-2">
                                                Stop Banner
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">

                        <h4 class="font-weight-bold text-primary mb-4">
                            Kelola Banner Pengumuman
                        </h4>

                        <!-- SLIDE -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0 font-weight-bold">
                                        Slide 2
                                    </h5>

                                    <span class="badge badge-secondary px-3 py-2">
                                        Banner Tidak Aktif
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label>Judul Banner</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan judul banner">
                                </div>

                                <div class="form-group">
                                    <label>Teks Pertama</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan teks banner">
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi Banner</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan deskripsi banner">
                                </div>

                                <div class="form-group">
                                    <label>Link Banner</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan link banner">
                                </div>

                                <div class="row">

                                    <!-- LEFT -->
                                    <div class="col-lg-5">

                                        <div class="form-group">
                                            <label>Upload Banner</label>

                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input banner-input"
                                                    accept="image/*">

                                                <label class="custom-file-label">
                                                    Pilih gambar...
                                                </label>
                                            </div>

                                            <small class="text-muted">
                                                Ukuran disarankan 1920x1080 px
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Update</label>

                                            <input type="date"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Jam Update</label>

                                            <input type="time"
                                                class="form-control">
                                        </div>

                                    </div>

                                    <!-- RIGHT -->
                                    <div class="col-lg-7">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label class="font-weight-bold text-muted">
                                                    Preview Aktif
                                                </label>

                                                <div class="border rounded overflow-hidden shadow-sm">
                                                    <img src="../assets/images/default-banner.jpg"
                                                        class="img-fluid w-100 banner-active-preview"
                                                        style="height:180px; object-fit:cover;">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="font-weight-bold text-muted">
                                                    Preview Baru
                                                </label>

                                                <div class="border rounded overflow-hidden shadow-sm">
                                                    <img src="../assets/images/default-banner.jpg"
                                                        class="img-fluid w-100 banner-new-preview"
                                                        style="height:180px; object-fit:cover;">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex flex-wrap align-items-center mt-3">

                                            <button type="button"
                                                class="btn btn-success btn-update-now px-4 mr-2 mb-2">
                                                Update Sekarang
                                            </button>

                                            <button type="button"
                                                class="btn btn-primary btn-update-schedule px-4 mr-2 mb-2">
                                                Update Dengan Jadwal
                                            </button>

                                            <button type="button"
                                                class="btn btn-danger btn-stop-banner px-4 mb-2">
                                                Stop Banner
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">

                        <h4 class="font-weight-bold text-primary mb-4">
                            Kelola Banner Pengumuman
                        </h4>

                        <!-- SLIDE -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0 font-weight-bold">
                                        Slide 3
                                    </h5>

                                    <span class="badge badge-secondary px-3 py-2">
                                        Banner Tidak Aktif
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label>Judul Banner</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan judul banner">
                                </div>

                                <div class="form-group">
                                    <label>Teks Pertama</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan teks banner">
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi Banner</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan deskripsi banner">
                                </div>

                                <div class="form-group">
                                    <label>Link Banner</label>

                                    <input type="text"
                                        class="form-control"
                                        placeholder="Masukkan link banner">
                                </div>

                                <div class="row">

                                    <!-- LEFT -->
                                    <div class="col-lg-5">

                                        <div class="form-group">
                                            <label>Upload Banner</label>

                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input banner-input"
                                                    accept="image/*">

                                                <label class="custom-file-label">
                                                    Pilih gambar...
                                                </label>
                                            </div>

                                            <small class="text-muted">
                                                Ukuran disarankan 1920x1080 px
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Update</label>

                                            <input type="date"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Jam Update</label>

                                            <input type="time"
                                                class="form-control">
                                        </div>

                                    </div>

                                    <!-- RIGHT -->
                                    <div class="col-lg-7">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label class="font-weight-bold text-muted">
                                                    Preview Aktif
                                                </label>

                                                <div class="border rounded overflow-hidden shadow-sm">
                                                    <img src="../assets/images/default-banner.jpg"
                                                        class="img-fluid w-100 banner-active-preview"
                                                        style="height:180px; object-fit:cover;">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="font-weight-bold text-muted">
                                                    Preview Baru
                                                </label>

                                                <div class="border rounded overflow-hidden shadow-sm">
                                                    <img src="../assets/images/default-banner.jpg"
                                                        class="img-fluid w-100 banner-new-preview"
                                                        style="height:180px; object-fit:cover;">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex flex-wrap align-items-center mt-3">

                                            <button type="button"
                                                class="btn btn-success btn-update-now px-4 mr-2 mb-2">
                                                Update Sekarang
                                            </button>

                                            <button type="button"
                                                class="btn btn-primary btn-update-schedule px-4 mr-2 mb-2">
                                                Update Dengan Jadwal
                                            </button>

                                            <button type="button"
                                                class="btn btn-danger btn-stop-banner px-4 mb-2">
                                                Stop Banner
                                            </button>

                                        </div>

                                    </div>

                                </div>

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

    <!-- MODAL -->
    <div class="modal fade"
        id="bannerModal"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow">

                <div class="modal-body text-center p-5">

                    <div class="mb-4">
                        <i class="material-icons text-success"
                            style="font-size:70px;">
                            check_circle
                        </i>
                    </div>

                    <h4 class="font-weight-bold modal-title-banner mb-3">
                        Success
                    </h4>

                    <p class="text-muted modal-desc-banner mb-4">
                        Banner berhasil diperbarui
                    </p>

                    <button class="btn btn-primary px-4"
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
    <!-- SELECT2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

    <!-- Global Settings -->
    <script src="../assets/js/settings.js"></script>

    <script>
        $(document).ready(function() {

            $('.banner-input').on('change', function(e) {

                const file = e.target.files[0];

                if (!file) return;

                const reader = new FileReader();

                const card = $(this).closest('.card-body');

                const previewNew = card.find('.banner-new-preview');

                const fileLabel = $(this)
                    .next('.custom-file-label');

                // nama file
                fileLabel.text(file.name);

                reader.onload = function(event) {

                    // preview baru
                    previewNew.attr('src', event.target.result);

                };

                reader.readAsDataURL(file);

            });

            // UPDATE SEKARANG
            $('.btn-success').on('click', function() {

                const card = $(this).closest('.card-body');

                const previewNew = card.find('.banner-new-preview');
                const previewActive = card.find('.banner-active-preview');

                // pindahkan preview baru ke aktif
                previewActive.attr('src', previewNew.attr('src'));

            });

        });
    </script>

    <script>
        $(document).ready(function() {

            // =========================
            // PREVIEW IMAGE
            // =========================
            $('.banner-input').each(function() {

                $(this).on('change', function(e) {

                    const file = e.target.files[0];

                    if (!file) return;

                    const input = $(this);

                    const card = input.closest('.card-body');

                    const previewNew = card
                        .find('.banner-new-preview')
                        .last();

                    const label = input
                        .next('.custom-file-label');

                    const img = new Image();

                    const reader = new FileReader();

                    reader.onload = function(event) {

                        img.src = event.target.result;

                        img.onload = function() {

                            // VALIDASI SIZE
                            if (
                                img.width !== 1920 ||
                                img.height !== 1080
                            ) {

                                input.val('');

                                label.text('Pilih gambar...');

                                previewNew.attr(
                                    'src',
                                    '../assets/images/default-banner.jpg'
                                );

                                showBannerModal(
                                    'Ukuran Gambar Salah',
                                    'Ukuran gambar wajib 1920 x 1080 pixel'
                                );

                                return;

                            }

                            // PREVIEW
                            previewNew.attr(
                                'src',
                                event.target.result
                            );

                            label.text(file.name);

                        };

                    };

                    reader.readAsDataURL(file);

                });

            });

            // =========================
            // VALIDASI
            // =========================
            function validateBanner(card, type = 'now') {

                let valid = true;

                // RESET
                card.find('.form-control').removeClass('is-invalid');

                // TEXT INPUT
                card.find('input[type="text"]').each(function() {

                    if ($(this).val().trim() === '') {

                        $(this).addClass('is-invalid');

                        valid = false;

                    }

                });

                // FILE
                const fileInput = card.find('.banner-input');

                if (fileInput[0].files.length === 0) {

                    fileInput.addClass('is-invalid');

                    valid = false;

                }

                // JADWAL
                if (type === 'schedule') {

                    card.find('input[type="date"], input[type="time"]').each(function() {

                        if ($(this).val().trim() === '') {

                            $(this).addClass('is-invalid');

                            valid = false;

                        }

                    });

                }

                if (!valid) {

                    $('.modal-title-banner')
                        .text('Silahkan Isi Semua');

                    $('.modal-desc-banner')
                        .text('Lengkapi semua data banner terlebih dahulu');

                    $('#bannerModal').modal('show');

                }

                return valid;

            }

            // =========================
            // MODAL FUNCTION
            // =========================
            function showBannerModal(title, desc) {

                $('.modal-title-banner')
                    .text(title);

                $('.modal-desc-banner')
                    .text(desc);

                $('#bannerModal').modal('show');

            }

            // =========================
            // UPDATE SEKARANG
            // =========================
            $('.btn-update-now').on('click', function() {

                const card = $(this)
                    .closest('.card-body');

                if (!validateBanner(card, 'now')) return;

                const slideName = card.find('h5').text();

                const previewNew = card
                    .find('.banner-new-preview')
                    .last();

                const previewActive = card
                    .find('.banner-active-preview')
                    .first();

                // PINDAH PREVIEW
                previewActive.attr(
                    'src',
                    previewNew.attr('src')
                );

                // STATUS
                const badge = card.find('.badge');

                badge
                    .removeClass('badge-secondary')
                    .addClass('badge-success')
                    .text('Banner Aktif');

                // MODAL
                showBannerModal(
                    slideName + ' Sukses Update Sekarang',
                    'Banner berhasil diperbarui dan aktif sekarang'
                );

            });

            // =========================
            // UPDATE JADWAL
            // =========================
            $('.btn-update-schedule').on('click', function() {

                const card = $(this)
                    .closest('.card-body');

                if (!validateBanner(card, 'schedule')) return;

                const slideName = card.find('h5').text();

                // STATUS
                const badge = card.find('.badge');

                badge
                    .removeClass('badge-secondary')
                    .addClass('badge-success')
                    .text('Banner Aktif');

                // MODAL
                showBannerModal(
                    slideName + ' Sukses Update Dengan Jadwal',
                    'Banner berhasil dijadwalkan'
                );

            });

            // =========================
            // STOP BANNER
            // =========================
            $('.btn-stop-banner').on('click', function() {

                const card = $(this)
                    .closest('.card-body');

                const slideName = card.find('h5').text();

                // STATUS
                const badge = card.find('.badge');

                badge
                    .removeClass('badge-success')
                    .addClass('badge-secondary')
                    .text('Banner Tidak Aktif');

                // MODAL
                showBannerModal(
                    slideName + ' Berhasil Dihentikan',
                    'Banner sekarang tidak aktif'
                );

            });

        });
    </script>

</body>

</html>