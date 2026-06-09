<?php
session_start();
require_once __DIR__ . "/../koneksi.php";

$query = mysqli_query($conn, "
    SELECT
        u.id,
        u.email,
        u.created_at,

        p.full_name,
        p.phone_number,
        p.photo_profile,
        p.status

    FROM users u
    LEFT JOIN public_profile p
        ON p.user_id = u.id

    WHERE u.user_type = 'public'
    ORDER BY u.id DESC
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
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    Show
                                    <select id="showEntries" class="form-control d-inline w-auto">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>20</option>
                                    </select>
                                    entries
                                </div>

                                <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">
                            </div>

                            <!-- TABLE -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>No.</th>
                                            <th>ID Klien</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Tlp</th>
                                            <th>Status</th>
                                            <th>Dibuat Pada</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;

                                        while ($row = mysqli_fetch_assoc($query)) :

                                            $statusBadge = ($row['status'] == 1)
                                                ? '<span class="badge bg-success">Aktif</span>'
                                                : '<span class="badge bg-danger">Nonaktif</span>';

                                            $foto = !empty($row['photo_profile'])
                                                ? "../uploads/profile/" . $row['photo_profile']
                                                : "../assets/images/avatar.png";
                                        ?>
                                            <tr>

                                                <td>
                                                    <input type="checkbox"
                                                        class="rowCheck"
                                                        data-index="<?= $row['id']; ?>">
                                                </td>

                                                <td><?= $no++; ?></td>

                                                <td>
                                                    HI#<?= str_pad($row['id'], 4, '0', STR_PAD_LEFT); ?>
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
                                                    <?= $statusBadge; ?>
                                                </td>

                                                <td>
                                                    <?= date('d/m/Y', strtotime($row['created_at'])); ?>
                                                </td>

                                                <td>

                                                    <a href="view_user.php?id=<?= $row['id']; ?>"
                                                        class="btn btn-info btn-sm">
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>

                                                    <select
                                                        class="form-control form-control-sm d-inline w-auto changeStatus"
                                                        data-id="<?= $row['id']; ?>">

                                                        <option value="1"
                                                            <?= ($row['status'] == 1) ? 'selected' : ''; ?>>
                                                            Aktif
                                                        </option>

                                                        <option value="0"
                                                            <?= ($row['status'] == 0) ? 'selected' : ''; ?>>
                                                            Nonaktif
                                                        </option>

                                                    </select>

                                                </td>

                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- PAGINATION -->
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-danger" id="inactiveSelected">Non Aktifkan Terpilih</button>
                                <ul class="pagination" id="pagination"></ul>
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
    <script src="assets/vendor/toastr.min.js"></script>
    <script src="assets/js/toastr.js"></script>

</body>

</html>