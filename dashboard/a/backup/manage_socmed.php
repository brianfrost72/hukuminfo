<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Social Media - Dashboard | Konig Guard Bureau</title>

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
                                        Manage Social Media
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Social Media</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="card shadow-sm border-0 my-4">

                    <div class="card-body">

                        <!-- HEADER -->
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

                            <div class="mb-3 mb-md-0">

                                <h4 class="font-weight-bold text-primary mb-1">
                                    Kelola Social Media Footer
                                </h4>

                                <p class="text-muted mb-0">
                                    Mengelola link social media yang tampil di footer situs.
                                </p>

                            </div>

                            <button class="btn btn-primary"
                                onclick="openAddModal()">

                                <i class="fa fa-plus mr-1"></i>
                                Tambah Social Media

                            </button>

                        </div>

                        <!-- TABLE -->
                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="bg-light">

                                    <tr>
                                        <th width="60">No</th>
                                        <th width="80">Icon</th>
                                        <th>Platform</th>
                                        <th>URL</th>
                                        <th width="140">Status</th>
                                        <th width="150" class="text-center">
                                            Aksi
                                        </th>
                                    </tr>

                                </thead>

                                <tbody id="socmedBody">

                                    <tr>

                                        <td class="align-middle">
                                            1
                                        </td>

                                        <td class="align-middle">

                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                                style="width:40px; height:40px;">

                                                <i class="fab fa-instagram text-danger"></i>

                                            </div>

                                        </td>

                                        <td class="align-middle font-weight-bold">
                                            Instagram
                                        </td>

                                        <td class="align-middle text-truncate"
                                            style="max-width:250px;">

                                            https://instagram.com/example

                                        </td>

                                        <td class="align-middle">

                                            <span class="badge badge-success px-3 py-2">
                                                Aktif
                                            </span>

                                        </td>

                                        <td class="align-middle text-center">

                                            <!-- EDIT -->
                                            <button onclick="openEditModal(this)"
                                                class="btn btn-sm btn-primary mr-1">

                                                <i class="fa fa-pen"></i>

                                            </button>

                                            <!-- DELETE -->
                                            <button onclick="openDeleteModal(this)"
                                                class="btn btn-sm btn-danger">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

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

    <!-- =========================
     TAMBAH SOCIAL MEDIA
========================= -->
    <form method="post" action="">

        <input type="hidden" name="aksi" value="add">

        <div class="modal fade"
            id="addModal"
            tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 shadow">

                    <!-- HEADER -->
                    <div class="modal-header">

                        <h5 class="modal-title font-weight-bold">
                            Tambah Social Media
                        </h5>

                        <button type="button"
                            class="close"
                            data-dismiss="modal">

                            <span>&times;</span>

                        </button>

                    </div>

                    <!-- BODY -->
                    <div class="modal-body">

                        <div class="form-group">

                            <label>Platform</label>

                            <select name="platform"
                                class="form-control"
                                required>

                                <option value="">
                                    -- pilih --
                                </option>

                                <option value="instagram">
                                    Instagram
                                </option>

                                <option value="linkedin">
                                    LinkedIn
                                </option>

                                <option value="youtube">
                                    YouTube
                                </option>

                                <option value="facebook">
                                    Facebook
                                </option>

                                <option value="tiktok">
                                    TikTok
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Link URL</label>

                            <input type="url"
                                name="url"
                                class="form-control"
                                placeholder="https://..."
                                required>

                        </div>

                        <div class="form-group mb-0">

                            <label>Urutan</label>

                            <input type="number"
                                name="urutan"
                                class="form-control"
                                value="1">

                            <small class="text-danger d-block mt-1 urutan-error">
                            </small>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer border-0">

                        <button type="button"
                            class="btn btn-light"
                            data-dismiss="modal">

                            Batal

                        </button>

                        <button type="submit"
                            class="btn btn-primary">

                            Simpan

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

    <!-- LOADING MODAL -->
    <div class="modal fade"
        id="loadingModal"
        tabindex="-1"
        data-backdrop="static"
        data-keyboard="false">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow">

                <div class="modal-body text-center p-5">

                    <div class="spinner-border text-primary mb-4"
                        style="width:4rem; height:4rem;">
                    </div>

                    <h5 class="font-weight-bold mb-2">
                        Loading...
                    </h5>

                    <p class="text-muted mb-0">
                        Mohon tunggu sebentar
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- =========================
     EDIT SOCIAL MEDIA
========================= -->
    <form method="post" action="">

        <input type="hidden" name="aksi" value="edit">

        <input type="hidden"
            name="id"
            id="edit_id">

        <div class="modal fade"
            id="editModal"
            tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 shadow">

                    <!-- HEADER -->
                    <div class="modal-header">

                        <h5 class="modal-title font-weight-bold">
                            Edit Link Social Media
                        </h5>

                        <button type="button"
                            class="close"
                            data-dismiss="modal">

                            <span>&times;</span>

                        </button>

                    </div>

                    <!-- BODY -->
                    <div class="modal-body">

                        <div class="form-group">

                            <label>Platform</label>

                            <input type="text"
                                id="editPlatform"
                                class="form-control"
                                readonly>

                        </div>

                        <div class="form-group mb-0">

                            <label>Link Baru</label>

                            <input type="url"
                                name="url"
                                id="editUrl"
                                class="form-control"
                                required>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer border-0">

                        <button type="button"
                            class="btn btn-light"
                            data-dismiss="modal">

                            Batal

                        </button>

                        <button type="submit"
                            class="btn btn-primary">

                            Update

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

    <!-- =========================
     DELETE SOCIAL MEDIA
========================= -->
    <form method="post" action="">

        <input type="hidden" name="aksi" value="delete">

        <input type="hidden"
            name="id"
            id="delete_id">

        <div class="modal fade"
            id="deleteModal"
            tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 shadow">

                    <!-- BODY -->
                    <div class="modal-body text-center p-5">

                        <div class="mb-4">

                            <i class="fa fa-trash text-danger"
                                style="font-size:60px;"></i>

                        </div>

                        <h4 class="font-weight-bold mb-3 delete-title">
                            Hapus Social Media?
                        </h4>

                        <p class="text-muted mb-4 delete-desc">
                            Data tidak bisa dikembalikan.
                        </p>

                        <div class="d-flex justify-content-center">

                            <button type="button"
                                class="btn btn-light mr-2"
                                data-dismiss="modal">

                                Batal

                            </button>

                            <button type="submit"
                                class="btn btn-danger">

                                Hapus

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

    <!-- SUCCESS MODAL -->
    <div class="modal fade"
        id="successModal"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow">

                <div class="modal-body text-center p-5">

                    <div class="mb-4">

                        <i class="fa fa-check-circle text-success"
                            style="font-size:70px;"></i>

                    </div>

                    <h4 class="font-weight-bold mb-3 success-title">
                        Success
                    </h4>

                    <p class="text-muted mb-4 success-desc">
                        Berhasil
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
        let editRow = null;
        let deleteRow = null;

        // =========================
        // ICON PLATFORM
        // =========================
        function getPlatformIcon(platform) {

            switch (platform) {

                case 'instagram':
                    return 'fab fa-instagram text-danger';

                case 'linkedin':
                    return 'fab fa-linkedin text-primary';

                case 'youtube':
                    return 'fab fa-youtube text-danger';

                case 'facebook':
                    return 'fab fa-facebook text-primary';

                case 'tiktok':
                    return 'fab fa-tiktok text-dark';

                default:
                    return 'fa fa-globe';

            }

        }

        // =========================
        // UPDATE NOMOR
        // =========================
        function updateTableNumber() {

            $('#socmedBody tr').each(function(index) {

                $(this)
                    .find('td:first')
                    .text(index + 1);

            });

        }

        // =========================
        // SUCCESS MODAL
        // =========================
        function showSuccess(title, message) {

            $('.success-title').text(title);

            $('.success-desc').text(message);

            $('#successModal').modal('show');

        }

        // =========================
        // OPEN MODAL
        // =========================
        function openAddModal() {

            $('#addModal').modal('show');

        }

        // =========================
        // EDIT
        // =========================
        function openEditModal(button) {

            $('#loadingModal').modal('show');

            setTimeout(function() {

                $('#loadingModal').modal('hide');

                editRow = $(button).closest('tr');

                const platform = editRow
                    .find('td:eq(2)')
                    .text()
                    .trim();

                const url = editRow
                    .find('td:eq(3)')
                    .text()
                    .trim();

                $('#editPlatform').val(platform);

                $('#editUrl').val(url);

                $('#editModal').modal('show');

            }, 800);

        }

        // =========================
        // DELETE
        // =========================
        function openDeleteModal(button) {

            $('#loadingModal').modal('show');

            setTimeout(function() {

                $('#loadingModal').modal('hide');

                deleteRow = $(button).closest('tr');

                const platform = deleteRow
                    .find('td:eq(2)')
                    .text()
                    .trim();

                $('.delete-title').text(
                    'Hapus ' + platform + '?'
                );

                $('.delete-desc').text(
                    'Social media ' +
                    platform +
                    ' akan dihapus permanen'
                );

                $('#deleteModal').modal('show');

            }, 800);

        }

        // =========================
        // ADD DATA
        // =========================
        $('#addModal form, form').submit(function(e) {

            e.preventDefault();

        });

        // =========================
        // DISABLE PLATFORM
        // =========================
        function refreshPlatformOption() {

            const usedPlatforms = [];

            $('#socmedBody tr').each(function() {

                const platform = $(this)
                    .find('td:eq(2)')
                    .text()
                    .trim()
                    .toLowerCase();

                usedPlatforms.push(platform);

            });

            $('select[name="platform"] option').each(function() {

                const value = $(this).val();

                if (usedPlatforms.includes(value)) {

                    $(this).prop('disabled', true);

                } else {

                    $(this).prop('disabled', false);

                }

            });

        }

        // =========================
        // SIMPAN
        // =========================
        $('#addModal .btn-primary').on('click', function() {

            const platform = $('select[name="platform"]').val();

            const url = $('input[name="url"]').val().trim();

            const urutan = parseInt(
                $('input[name="urutan"]').val()
            );

            $('.urutan-error').text('');

            // VALIDASI
            if (
                platform === '' ||
                url === '' ||
                !urutan
            ) {

                showSuccess(
                    'Validasi Gagal',
                    'Silahkan isi semua data'
                );

                return;

            }

            // TIDAK BOLEH MINUS
            if (urutan < 1) {

                $('.urutan-error')
                    .text('Urutan tidak boleh minus atau 0');

                return;

            }

            // VALIDASI LOMPAT
            const totalData =
                $('#socmedBody tr').length;

            const maxUrutan = totalData + 1;

            if (urutan > maxUrutan) {

                $('.urutan-error')
                    .text(
                        'Urutan tidak boleh lompat. Maksimal urutan ' +
                        maxUrutan
                    );

                return;

            }

            // VALIDASI DUPLIKAT
            let duplicate = false;

            $('#socmedBody tr').each(function() {

                const no = parseInt(
                    $(this)
                    .find('td:eq(0)')
                    .text()
                );

                if (no === urutan) {

                    duplicate = true;

                }

            });

            if (duplicate) {

                $('.urutan-error')
                    .text(
                        'Urutan sudah dipakai'
                    );

                return;

            }

            $('#addModal').modal('hide');

            $('#loadingModal').modal('show');

            setTimeout(function() {

                $('#loadingModal').modal('hide');

                const iconClass = getPlatformIcon(platform);

                const platformName =
                    platform.charAt(0).toUpperCase() +
                    platform.slice(1);

                const row = `
        <tr>

            <td class="align-middle">
                ${urutan}
            </td>

            <td class="align-middle">

                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                    style="width:40px; height:40px;">

                    <i class="${iconClass}"></i>

                </div>

            </td>

            <td class="align-middle font-weight-bold">
                ${platformName}
            </td>

            <td class="align-middle text-truncate"
                style="max-width:250px;">

                ${url}

            </td>

            <td class="align-middle">

                <span class="badge badge-success px-3 py-2">
                    Aktif
                </span>

            </td>

            <td class="align-middle text-center">

                <button type="button"
                    onclick="openEditModal(this)"
                    class="btn btn-sm btn-primary mr-1">

                    <i class="fa fa-pen"></i>

                </button>

                <button type="button"
                    onclick="openDeleteModal(this)"
                    class="btn btn-sm btn-danger">

                    <i class="fa fa-trash"></i>

                </button>

            </td>

        </tr>
        `;

                $('#socmedBody').append(row);

                // SORT
                const rows =
                    $('#socmedBody tr').get();

                rows.sort(function(a, b) {

                    return parseInt(
                            $(a).find('td:eq(0)').text()
                        ) -
                        parseInt(
                            $(b).find('td:eq(0)').text()
                        );

                });

                $.each(rows, function(index, row) {

                    $('#socmedBody').append(row);

                });

                refreshPlatformOption();

                showSuccess(
                    'Tambah Berhasil',
                    platformName +
                    ' berhasil ditambahkan'
                );

                // RESET
                $('select[name="platform"]').val('');

                $('input[name="url"]').val('');

                $('input[name="urutan"]').val(
                    $('#socmedBody tr').length + 1
                );

            }, 800);

        });

        // =========================
        // UPDATE DATA
        // =========================
        $('#editModal .btn-primary').on('click', function() {

            const newUrl = $('#editUrl').val();

            if (newUrl === '') {

                showSuccess(
                    'Validasi Gagal',
                    'Link social media wajib diisi'
                );

                return;

            }

            $('#editModal').modal('hide');

            $('#loadingModal').modal('show');

            setTimeout(function() {

                $('#loadingModal').modal('hide');

                editRow
                    .find('td:eq(3)')
                    .text(newUrl);

                showSuccess(
                    'Update Berhasil',
                    'Social media berhasil diperbarui'
                );

            }, 800);

        });

        // =========================
        // HAPUS DATA
        // =========================
        $('#deleteModal .btn-danger').on('click', function() {

            $('#deleteModal').modal('hide');

            $('#loadingModal').modal('show');

            setTimeout(function() {

                $('#loadingModal').modal('hide');

                deleteRow.remove();

                updateTableNumber();

                showSuccess(
                    'Hapus Berhasil',
                    'Social media berhasil dihapus'
                );

            }, 800);

        });

        refreshPlatformOption();
    </script>

</body>

</html>