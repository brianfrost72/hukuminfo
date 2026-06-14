<?php
session_start();
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . "/../koneksi.php";

$query = mysqli_query($conn, "
    SELECT
        u.id AS user_id,
        u.email,
        u.created_at,

        p.id AS profile_id,
        p.full_name,
        p.phone_number,
        p.photo_profile,
        p.gender,
        p.status,
        p.provinces_id,
        p.regencies_id,

        prov.name AS province_name,
        reg.name AS regency_name

    FROM users u

    LEFT JOIN public_profile p
        ON p.user_id = u.id

    LEFT JOIN provinces prov
        ON prov.id = p.provinces_id

    LEFT JOIN regencies reg
        ON reg.id = p.regencies_id

    WHERE u.user_type = 'public'

    ORDER BY p.id DESC
");

if (!$query) {
    die(mysqli_error($conn));
}

// AMBIL DATA PROVINSI
$provinces = mysqli_query($conn, "
    SELECT id,name
    FROM provinces
    ORDER BY name ASC
");
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage User - Dashboard | Hukuminfo.id</title>

    <!-- favicon.ico in the root directory -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

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

    <!-- Toastr -->
    <link type="text/css"
        href="../assets/vendor/toastr.min.css"
        rel="stylesheet">
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
                                        Manage User
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage User</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Manage User</h4>
                        </div>

                        <div class="card-body">
                            <!-- FILTER -->
                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div>
                                    Show
                                    <select id="showEntries" class="form-control d-inline w-auto">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>20</option>
                                    </select>
                                    entries
                                </div>

                                <div class="d-flex align-items-center" style="gap:10px;">

                                    <select id="statusFilter" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>

                                    <select id="provinceFilter" class="form-control">
                                        <option value="">Semua Provinsi</option>

                                        <?php while ($prov = mysqli_fetch_assoc($provinces)) : ?>
                                            <option value="<?= $prov['id']; ?>">
                                                <?= htmlspecialchars($prov['name']); ?>
                                            </option>
                                        <?php endwhile; ?>

                                    </select>

                                    <select id="regencyFilter" class="form-control">
                                        <option value="">Semua Kabupaten/Kota</option>
                                    </select>

                                    <input
                                        type="text"
                                        id="searchInput"
                                        class="form-control"
                                        placeholder="Search..."
                                        style="width:250px;">

                                </div>

                            </div>

                            <!-- TABLE -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>No.</th>
                                            <th style="min-width: 200px;">ID Klien</th>
                                            <th style="min-width: 200px;">Nama</th>
                                            <th style="min-width: 200px;">Email</th>
                                            <th>No Tlp</th>
                                            <th style="min-width: 200px;">Provinsi</th>
                                            <th style="min-width: 200px;">Kabupaten / Kota</th>
                                            <th>Status</th>
                                            <th style="min-width: 200px;">Dibuat Pada</th>
                                            <th style="min-width: 200px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;

                                        while ($row = mysqli_fetch_assoc($query)) :

                                            $statusBadge = ($row['status'] == 1)
                                                ? '<span class="badge bg-success">Active</span>'
                                                : '<span class="badge bg-danger">Inactive</span>';

                                            if (!empty($row['photo_profile'])) {

                                                $foto = "../assets/images/uploads/public_photos/" . $row['photo_profile'];
                                            } else {

                                                if (strtolower($row['gender']) == 'perempuan') {
                                                    $foto = "../assets/images/avatar/avatar-women.png";
                                                } else {
                                                    $foto = "../assets/images/avatar/avatar-men.png";
                                                }
                                            }
                                        ?>
                                            <tr
                                                data-status="<?= $row['status']; ?>"
                                                data-province="<?= $row['provinces_id']; ?>"
                                                data-regency="<?= $row['regencies_id']; ?>">

                                                <td>
                                                    <input type="checkbox"
                                                        class="rowCheck"
                                                        data-index="<?= $row['user_id']; ?>">
                                                </td>

                                                <td><?= $no++; ?></td>

                                                <td style="min-width: 200px;">
                                                    HI#<?= str_pad($row['profile_id'], 4, '0', STR_PAD_LEFT); ?>
                                                </td>

                                                <td class="d-flex align-items-center">

                                                    <img src="<?= $foto; ?>"
                                                        class="rounded-circle mr-2"
                                                        width="40"
                                                        height="40"
                                                        style="object-fit:cover;">

                                                    <?= htmlspecialchars($row['full_name']); ?>

                                                </td>

                                                <td>
                                                    <?= htmlspecialchars($row['email']); ?>
                                                </td>

                                                <td>
                                                    <?= htmlspecialchars($row['phone_number']); ?>
                                                </td>

                                                <td>
                                                    <?= htmlspecialchars($row['province_name'] ?? '-'); ?>
                                                </td>

                                                <td>
                                                    <?= htmlspecialchars($row['regency_name'] ?? '-'); ?>
                                                </td>

                                                <td>

                                                    <span
                                                        class="userStatusBadge badge <?= ($row['status'] == 1 ? 'bg-success' : 'bg-danger'); ?>">
                                                        <?= ($row['status'] == 1 ? 'Active' : 'Inactive'); ?>
                                                    </span>

                                                </td>

                                                <td>
                                                    <?= date('d/m/Y H:i:s', strtotime($row['created_at'])); ?>
                                                </td>

                                                <td>

                                                    <a href="view_user.php?id=<?= $row['profile_id']; ?>"
                                                        class="btn btn-info btn-sm">
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>

                                                    <select
                                                        class="form-control form-control-sm d-inline w-auto changeStatus"
                                                        data-id="<?= $row['user_id']; ?>">

                                                        <option value="1"
                                                            <?= ($row['status'] == 1) ? 'selected' : ''; ?>>
                                                            Active
                                                        </option>

                                                        <option value="0"
                                                            <?= ($row['status'] == 0) ? 'selected' : ''; ?>>
                                                            inactive
                                                        </option>

                                                    </select>

                                                </td>

                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- PAGINATION -->
                            <div class="row mt-3 align-items-center">

                                <div class="col-md-4">
                                    <button
                                        id="bulkActionBtn"
                                        class="btn btn-danger"
                                        style="display:none;">
                                        Nonaktifkan Akun
                                    </button>
                                </div>

                                <div class="col-md-4 text-center">
                                    <span id="entriesInfo">
                                        Showing 0 to 0 of 0 entries
                                    </span>
                                </div>

                                <div class="col-md-4">
                                    <ul
                                        class="pagination justify-content-end mb-0"
                                        id="pagination">
                                    </ul>
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

    <footer class="dashboard-footer mt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- LEFT -->
                <div class="col-md-6 text-md-left text-center mb-2 mb-md-0">
                    <span class="footer-text">
                        © 2026 Hukuminfo.id. All rights reserved.
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

    <!-- Toastr -->
    <script src="../assets/vendor/toastr.min.js"></script>
    <script src="../assets/js/toastr.js"></script>

    <script>
        $('#provinceFilter').on('change', function() {

            let province_id = $(this).val();

            $('#regencyFilter').html(
                '<option value="">Semua Kabupaten/Kota</option>'
            );

            if (province_id == '') {
                filterTable();
                return;
            }

            $.ajax({
                url: 'ajax/get_regencies.php',
                type: 'GET',
                data: {
                    province_id: province_id
                },
                dataType: 'json',

                success: function(response) {
                    $.each(response, function(i, row) {

                        $('#regencyFilter').append(
                            '<option value="' + row.id + '">' + row.name + '</option>'
                        );

                    });

                    filterTable();
                }
            });

        });

        let currentPage = 1;

        function filterTable() {
            let status = $('#statusFilter').val();
            let province = $('#provinceFilter').val();
            let regency = $('#regencyFilter').val();
            let keyword = $('#searchInput').val().toLowerCase();

            let rows = [];

            $('#dataTable tbody tr').each(function() {

                let row = $(this);

                let rowStatus = String(row.data('status'));
                let rowProvince = String(row.data('province'));
                let rowRegency = String(row.data('regency'));

                let text = row.text().toLowerCase();

                let show = true;

                if (status && rowStatus !== status)
                    show = false;

                if (province && rowProvince !== province)
                    show = false;

                if (regency && rowRegency !== regency)
                    show = false;

                if (keyword && !text.includes(keyword))
                    show = false;

                row.toggle(false);

                if (show)
                    rows.push(row);

            });

            paginate(rows);
        }

        $('#regencyFilter').on('change', filterTable);
        $('#searchInput').on('keyup', filterTable);


        function paginate(rows) {
            let perPage = parseInt($('#showEntries').val());

            let totalRows = rows.length;

            let totalPages = Math.ceil(totalRows / perPage);

            if (totalPages < 1)
                totalPages = 1;

            if (currentPage > totalPages)
                currentPage = totalPages;

            let start = (currentPage - 1) * perPage;
            let end = start + perPage;

            rows.forEach(function(row, index) {

                if (index >= start && index < end) {
                    row.show();
                } else {
                    row.hide();
                }

            });

            $('#entriesInfo').html(
                'Showing ' +
                (totalRows === 0 ? 0 : start + 1) +
                ' to ' +
                Math.min(end, totalRows) +
                ' of ' +
                totalRows +
                ' entries'
            );

            buildPagination(totalPages);
        }
        // PAGINATION
        function buildPagination(totalPages) {
            let html = '';

            html += `
        <li class="page-item">
            <a class="page-link pagePrev" href="#">
                Prev
            </a>
        </li>
    `;

            for (let i = 1; i <= totalPages; i++) {
                html += `
            <li class="page-item ${i===currentPage?'active':''}">
                <a
                    class="page-link pageNumber"
                    data-page="${i}"
                    href="#">
                    ${i}
                </a>
            </li>
        `;
            }

            html += `
        <li class="page-item">
            <a class="page-link pageNext" href="#">
                Next
            </a>
        </li>
    `;

            $('#pagination').html(html);
        }

        // EVENT FILTER
        $('#statusFilter').on('change', function() {
            currentPage = 1;
            filterTable();
        });

        $('#provinceFilter').on('change', function() {
            currentPage = 1;
        });

        $('#regencyFilter').on('change', function() {
            currentPage = 1;
            filterTable();
        });

        $('#searchInput').on('keyup', function() {
            currentPage = 1;
            filterTable();
        });

        $('#showEntries').on('change', function() {
            currentPage = 1;
            filterTable();
        });

        // EVENT PAGINATION
        $(document).on('click', '.pageNumber', function(e) {

            e.preventDefault();

            currentPage = parseInt($(this).data('page'));

            filterTable();

        });

        $(document).on('click', '.pagePrev', function(e) {

            e.preventDefault();

            if (currentPage > 1) {
                currentPage--;
                filterTable();
            }

        });

        $(document).on('click', '.pageNext', function(e) {

            e.preventDefault();

            currentPage++;

            filterTable();

        });

        // CHECKALL & BULK ACTION
        $('#checkAll').on('change', function() {

            let checked = $(this).prop('checked');

            $('.rowCheck:visible').prop(
                'checked',
                checked
            );

            updateBulkButton();

        });

        $(document).on('change', '.rowCheck', function() {

            let total =
                $('.rowCheck:visible').length;

            let checked =
                $('.rowCheck:visible:checked').length;

            $('#checkAll').prop(
                'checked',
                total > 0 && total === checked
            );

            updateBulkButton();

        });

        // TOMBOL AKTIF & INACTIVE
        function updateBulkButton() {
            let checkedRows =
                $('.rowCheck:checked');

            if (checkedRows.length === 0) {
                $('#bulkActionBtn').hide();
                return;
            }

            let hasActive = false;
            let hasInactive = false;

            checkedRows.each(function() {

                let status =
                    $(this)
                    .closest('tr')
                    .data('status');

                if (status == 1)
                    hasActive = true;

                if (status == 0)
                    hasInactive = true;

            });

            $('#bulkActionBtn').show();

            if (hasActive) {
                $('#bulkActionBtn')
                    .removeClass('btn-success')
                    .addClass('btn-danger')
                    .text('Nonaktifkan Akun');
            } else {
                $('#bulkActionBtn')
                    .removeClass('btn-danger')
                    .addClass('btn-success')
                    .text('Aktifkan Akun');
            }
        }

        $(document).on('change', '.rowCheck,#checkAll', updateBulkButton);

        filterTable();
        updateBulkButton();
    </script>

    <script>
        $('.changeStatus').on('change', function() {

            let select = $(this);

            let user_id = select.data('id');
            let status = select.val();

            $.ajax({

                url: 'ajax/update_user_status.php',
                type: 'POST',

                data: {
                    user_id: user_id,
                    status: status
                },

                dataType: 'json',

                success: function(res) {

                    if (!res.success) {

                        toastr.error(
                            res.message || 'Gagal mengubah status akun'
                        );

                        return;
                    }

                    let badge = select
                        .closest('tr')
                        .find('.userStatusBadge');

                    if (status == 1) {

                        badge
                            .removeClass('bg-danger')
                            .addClass('bg-success')
                            .text('Active');

                        toastr.success(
                            'Akun berhasil diaktifkan'
                        );

                    } else {

                        badge
                            .removeClass('bg-success')
                            .addClass('bg-danger')
                            .text('Inactive');

                        toastr.warning(
                            'Akun berhasil dinonaktifkan'
                        );

                    }

                },

                error: function() {

                    toastr.error(
                        'Terjadi kesalahan server'
                    );

                }

            });

        });
    </script>

    <script>
        $('#bulkActionBtn').on('click', function() {

            let ids = [];

            $('.rowCheck:checked').each(function() {

                ids.push(
                    $(this).data('index')
                );

            });

            if (ids.length === 0)
                return;

            let action =
                $(this).text().includes('Aktifkan') ?
                1 :
                0;

            $.ajax({

                url: 'ajax/bulk_user_status.php',

                type: 'POST',

                dataType: 'json',

                data: {
                    ids: ids,
                    status: action
                },

                success: function(res) {

                    if (!res.success) {

                        toastr.error(
                            'Gagal update akun'
                        );

                        return;
                    }

                    if (action == 1) {
                        toastr.success(
                            ids.length + ' akun berhasil diaktifkan'
                        );
                    } else {
                        toastr.warning(
                            ids.length + ' akun berhasil dinonaktifkan'
                        );
                    }

                    setTimeout(function() {

                        location.reload();

                    }, 1200);

                }

            });

        });
    </script>
</body>

</html>