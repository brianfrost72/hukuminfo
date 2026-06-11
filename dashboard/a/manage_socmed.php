<?php
session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . "/../koneksi.php";


/*
|--------------------------------------------------------------------------
| LOGIC SIMPAN
|--------------------------------------------------------------------------
*/
if (
    $_SERVER['REQUEST_METHOD'] == 'POST'
    &&
    $_POST['aksi'] == 'add'
) {

    $platform_id = (int) $_POST['platform_id'];
    $name_platform = trim($_POST['name_platform']);
    $url = trim($_POST['url']);

    $cek = mysqli_query(
        $conn,
        "SELECT id
         FROM social_media
         WHERE platform_id='$platform_id'
         LIMIT 1"
    );

    if (mysqli_num_rows($cek) > 0) {

        echo "
        <script>
            alert('Platform sudah pernah ditambahkan');
            window.location='manage_socmed.php';
        </script>";
        exit;
    }

    mysqli_query(
        $conn,
        "INSERT INTO social_media
        (
            platform_id,
            name_platform,
            link_platform
        )
        VALUES
        (
            '$platform_id',
            '" . mysqli_real_escape_string($conn, $name_platform) . "',
            '" . mysqli_real_escape_string($conn, $url) . "'
        )"
    );

    header("Location: manage_socmed.php?success=add");
    exit;
}
/*
|--------------------------------------------------------------------------
| LOGIC UPDATE
|--------------------------------------------------------------------------
*/
if (
    $_SERVER['REQUEST_METHOD'] == 'POST'
    &&
    $_POST['aksi'] == 'edit'
) {
    
    $id = (int) $_POST['id'];
    $name_platform = trim($_POST['name_platform']);
    $url = trim($_POST['url']);

    mysqli_query(
        $conn,
        "UPDATE social_media
     SET
        name_platform='" . mysqli_real_escape_string($conn, $name_platform) . "',
        link_platform='" . mysqli_real_escape_string($conn, $url) . "'
     WHERE id='$id'"
    );

    echo "
    <script>
        window.location='manage_socmed.php?success=edit';
    </script>";
    exit;
}

/*
|--------------------------------------------------------------------------
| LOGIC DELETE
|--------------------------------------------------------------------------
*/
if (
    $_SERVER['REQUEST_METHOD'] == 'POST'
    &&
    $_POST['aksi'] == 'delete'
) {

    $id = (int) $_POST['id'];

    mysqli_query(
        $conn,
        "DELETE FROM social_media
        WHERE id='$id'
    "
    );

    echo "
    <script>
        window.location='manage_socmed.php?success=delete';
    </script>";
    exit;
}

/*
|--------------------------------------------------------------------------
| GET DATA
|--------------------------------------------------------------------------
*/

$qSisaPlatform = mysqli_query($conn, "
                            SELECT COUNT(*) total
                            FROM list_socmed ls
                            WHERE ls.id NOT IN (
                            SELECT platform_id
                            FROM social_media
                            )
                            ");

$sisaPlatform = mysqli_fetch_assoc($qSisaPlatform);
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Social Media - Dashboard | Hukuminfo.id</title>

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
                                    Kelola Social Media
                                </h4>

                                <p class="text-muted mb-0">
                                    Mengelola link social media yang tampil di situs Hukuminfo.
                                </p>

                            </div>

                            <?php if ($sisaPlatform['total'] > 0): ?>

                                <button class="btn btn-primary"
                                    onclick="openAddModal()">

                                    <i class="fa fa-plus mr-1"></i>
                                    Tambah Social Media

                                </button>

                            <?php endif; ?>

                        </div>

                        <!-- TABLE -->
                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="bg-light">

                                    <tr>
                                        <th width="60">No</th>
                                        <th width="80">Icon</th>
                                        <th>Nama Social Media</th>
                                        <th>Platform</th>
                                        <th>URL</th>
                                        <th width="150" class="text-center">
                                            Aksi
                                        </th>
                                    </tr>

                                </thead>

                                <tbody id="socmedBody">

                                    <?php

                                    $qSocmed = mysqli_query($conn, "
    SELECT
        sm.id,
        sm.platform_id,
    sm.name_platform AS socmed_name,
        sm.link_platform,
        ls.name_platform AS platform_name
    FROM social_media sm
    INNER JOIN list_socmed ls
        ON ls.id = sm.platform_id
    ORDER BY ls.name_platform ASC
");

                                    if (!$qSocmed) {
                                        die(mysqli_error($conn));
                                    }

                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($qSocmed)) :

                                    ?>
                                        <tr>

                                            <td><?= $no++; ?></td>

                                            <td>
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                                    style="width:40px;height:40px;">

                                                    <?php
                                                    $platform = strtolower($row['platform_name']);

                                                    switch ($platform) {

                                                        case 'instagram':
                                                            echo '<i class="fab fa-instagram text-danger"></i>';
                                                            break;

                                                        case 'facebook':
                                                            echo '<i class="fab fa-facebook text-primary"></i>';
                                                            break;

                                                        case 'youtube':
                                                            echo '<i class="fab fa-youtube text-danger"></i>';
                                                            break;

                                                        case 'linkedin':
                                                            echo '<i class="fab fa-linkedin text-info"></i>';
                                                            break;

                                                        case 'tiktok':
                                                            echo '<i class="fab fa-tiktok"></i>';
                                                            break;

                                                        default:
                                                            echo '<i class="fa fa-globe"></i>';
                                                            break;
                                                    }
                                                    ?>

                                                </div>
                                            </td>

                                            <td class="font-weight-bold">
                                                <?= htmlspecialchars($row['platform_name']); ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['socmed_name']); ?>
                                            </td>

                                            <td style="max-width:250px;">
                                                <?= htmlspecialchars($row['link_platform']); ?>
                                            </td>

                                            <td class="text-center">

                                                <button
                                                    class="btn btn-sm btn-primary mr-1 editBtn"
                                                    data-id="<?= $row['id']; ?>"
                                                    data-platform="<?= htmlspecialchars($row['platform_name']); ?>"
                                                    data-name="<?= htmlspecialchars($row['socmed_name']); ?>"
                                                    data-url="<?= htmlspecialchars($row['link_platform']); ?>">

                                                    <i class="fa fa-pen"></i>

                                                </button>

                                                <button
                                                    class="btn btn-sm btn-danger deleteBtn"
                                                    data-id="<?= $row['id']; ?>"
                                                    data-platform="<?= htmlspecialchars($row['socmed_name']); ?>">

                                                    <i class="fa fa-trash"></i>

                                                </button>

                                            </td>

                                        </tr>
                                    <?php endwhile; ?>

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

                            <select
                                name="platform_id"
                                class="form-control"
                                required>

                                <option value="">
                                    -- pilih --
                                </option>

                                <?php

                                $platform = mysqli_query($conn, "
    SELECT
        ls.*
    FROM list_socmed ls
    WHERE ls.id NOT IN (
        SELECT platform_id
        FROM social_media
    )
    ORDER BY ls.name_platform ASC
");

                                while ($p = mysqli_fetch_assoc($platform)) :

                                ?>

                                    <option value="<?= $p['id']; ?>">
                                        <?= htmlspecialchars($p['name_platform']); ?>
                                    </option>

                                <?php endwhile; ?>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Nama Social Media</label>

                            <input type="text"
                                name="name_platform"
                                class="form-control"
                                maxlength="100"
                                required>

                        </div>

                        <div class="form-group">

                            <label>Link URL</label>

                            <input type="url"
                                name="url"
                                class="form-control"
                                placeholder="https://..."
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

        <input
            type="hidden"
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

                        <div class="form-group">

                            <label>Nama Social Media</label>

                            <input type="text"
                                id="editNamePlatform"
                                name="name_platform"
                                class="form-control"
                                required>

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

                        <h4 class="font-weight-bold mb-3 delete-title"></h4>

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
                        © 2026 Hukuminfo.id. All rights reserved.
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

    <!-- Toastr -->
    <script src="../assets/vendor/toastr.min.js"></script>
    <script src="../assets/js/toastr.js"></script>

    <?php if (isset($_GET['success'])) : ?>

        <script>
            $(function() {

                toastr.options = {
                    closeButton: true,
                    progressBar: false,
                };

                <?php if ($_GET['success'] == 'add'): ?>

                    toastr.success('Social media berhasil ditambahkan');

                <?php elseif ($_GET['success'] == 'edit'): ?>

                    toastr.success('Social media berhasil diperbarui');

                <?php elseif ($_GET['success'] == 'delete'): ?>

                    toastr.success('Social media berhasil dihapus');

                <?php endif; ?>

            });
        </script>

    <?php endif; ?>

    <script>
        $(document).on('click', '.editBtn', function() {

            $('#edit_id').val($(this).data('id'));
            $('#editPlatform').val($(this).data('platform'));
            $('#editNamePlatform').val($(this).data('name'));
            $('#editUrl').val($(this).data('url'));

            $('#editModal').modal('show');

        });

        $(document).on('click', '.deleteBtn', function() {

            let id = $(this).data('id');
            let platform = $(this).data('platform');

            $('#delete_id').val(id);

            $('.delete-title').html(
                'Hapus <b>' + platform + '</b>?'
            );

            $('.delete-desc').html(
                'Data social media ' +
                '<b>' + platform + '</b> akan dihapus permanen.'
            );

            $('#deleteModal').modal('show');

        });

        function openAddModal() {

            $('#addModal').modal('show');

        }
    </script>
</body>

</html>