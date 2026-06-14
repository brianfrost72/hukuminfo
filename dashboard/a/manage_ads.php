<?php
session_start();
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . "/../koneksi.php";

/*
|--------------------------------------------------------------------------
| LOGIC SIMPAN
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ad_title   = trim($_POST['ad_title'] ?? '');
    $ad_link    = trim($_POST['ad_link'] ?? '');
    $ad_request = trim($_POST['ad_request'] ?? '');

    if (
        empty($ad_title) ||
        empty($ad_link) ||
        empty($ad_request)
    ) {
        $_SESSION['error'] = 'Semua field wajib diisi.';
    } else {

        if (
            !isset($_FILES['ad_img']) ||
            $_FILES['ad_img']['error'] != 0
        ) {

            $_SESSION['error'] = 'Gambar iklan wajib diupload.';
        } else {

            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            $fileName = $_FILES['ad_img']['name'];
            $tmpName  = $_FILES['ad_img']['tmp_name'];
            $fileSize = $_FILES['ad_img']['size'];

            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {

                $_SESSION['error'] = 'Format gambar tidak didukung.';
            } elseif ($fileSize > 5 * 1024 * 1024) {

                $_SESSION['error'] = 'Ukuran gambar maksimal 5MB.';
            } else {

                $uploadDir = __DIR__ . '/../assets/images/uploads/ads/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $newName = time() . '_' . uniqid() . '.' . $ext;

                if (move_uploaded_file(
                    $tmpName,
                    $uploadDir . $newName
                )) {

                    $stmt = mysqli_prepare(
                        $conn,
                        "INSERT INTO ads
                        (
                            ad_title,
                            ad_img,
                            ad_link,
                            ad_request
                        )
                        VALUES
                        (?, ?, ?, ?)"
                    );

                    mysqli_stmt_bind_param(
                        $stmt,
                        "ssss",
                        $ad_title,
                        $newName,
                        $ad_link,
                        $ad_request
                    );

                    if (mysqli_stmt_execute($stmt)) {

                        $_SESSION['success'] = 'Iklan berhasil disimpan.';

                        header("Location: manage_ads.php");
                        exit;
                    }

                    $_SESSION['error'] = 'Gagal menyimpan data.';
                } else {

                    $_SESSION['error'] = 'Upload gambar gagal.';
                }
            }
        }
    }
}

/*
|--------------------------------------------------------------------------
| GET DATA
|--------------------------------------------------------------------------
*/
$ads = mysqli_query(
    $conn,
    "SELECT *
     FROM ads
     ORDER BY id DESC"
);

/*
|--------------------------------------------------------------------------
| DELETE DATA
|--------------------------------------------------------------------------
*/
if (isset($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    $q = mysqli_query(
        $conn,
        "SELECT ad_title, ad_img
         FROM ads
         WHERE id='$id'"
    );

    if ($row = mysqli_fetch_assoc($q)) {

        $title = $row['ad_title'];

        $file =
            __DIR__ .
            '/../assets/images/uploads/ads/' .
            $row['ad_img'];

        if (file_exists($file)) {
            unlink($file);
        }

        mysqli_query(
            $conn,
            "DELETE FROM ads
             WHERE id='$id'"
        );

        $_SESSION['success'] =
            'Iklan "' . $title . '" berhasil dihapus.';
    } else {

        $_SESSION['error'] =
            'Iklan tidak ditemukan.';
    }

    header("Location: manage_ads.php");
    exit;
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Iklan Popup - Dashboard | Hukuminfo.id</title>

    <!-- favicon.ico in the root directory -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

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
                                        Manage Iklan
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Iklan</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="container mt-4">

                    <!-- FORM TAMBAH IKLAN -->
                    <form id="formIklan" method="POST" enctype="multipart/form-data">

                        <div class="card p-4 mb-4" style="border-radius:12px;">
                            <h6 class="mb-3">Tambah Iklan</h6>

                            <!-- JUDUL IKLAN -->
                            <div class="form-group">
                                <label>Judul Iklan <span style="color:red">*</span></label>
                                <input type="text" name="ad_title" class="form-control" placeholder="Contoh: Iklan Hukum Info">
                            </div>

                            <!-- UPLOAD -->
                            <div class="form-group">
                                <label>Upload Gambar Iklan <span style="color:red">*</span></label>

                                <div id="dropArea" style="
            border:2px dashed #dbe5ee;
            border-radius:10px;
            padding:40px;
            text-align:center;
            background:#fafbfe;
            cursor:pointer;
        ">
                                    <span class="material-icons" style="font-size:40px; color:#939fad;">
                                        cloud_upload
                                    </span>
                                    <p class="mt-2 mb-1">Klik atau drag & drop gambar di sini</p>
                                    <small class="text-muted">Format: JPG, PNG, WEBP (Max 5MB)</small>

                                    <input type="file" name="ad_img" id="fileInput" multiple hidden>
                                </div>

                                <!-- PREVIEW -->
                                <div id="preview" class="mt-2"></div>
                            </div>

                            <!-- LINK IKLAN -->
                            <div class="form-group">
                                <label>Link Iklan <span style="color:red">*</span></label>
                                <input type="text" name="ad_link" id="linkIklan" class="form-control" placeholder="Contoh: https://example.com">
                            </div>

                            <!-- DARI PENGIKLAN -->
                            <div class="form-group">
                                <label>Nama Request Pengiklan <span style="color:red">*</span></label>
                                <input type="text" name="ad_request" class="form-control" placeholder="Contoh: PT. Sekian sekian">
                            </div>

                            <!-- BUTTON -->
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    <span class="material-icons" style="font-size:16px; vertical-align:middle;">
                                        save
                                    </span>
                                    Simpan Iklan
                                </button>
                            </div>
                        </div>

                    </form>

                    <!-- LIST Iklan -->
                    <div class="card p-4" style="border-radius:12px;">
                        <h6 class="mb-3">List Iklan</h6>

                        <!-- TOP CONTROL -->
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                Show
                                <select id="entriesSelect" class="form-control d-inline-block" style="width:70px;">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                </select> entries
                            </div>

                            <div>
                                <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="width:200px;">
                            </div>
                        </div>

                        <!-- TABLE -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="min-width: 220px;">Judul Iklan</th>
                                        <th>Gambar</th>
                                        <th>Link Iklan</th>
                                        <th>Nama Request Pengiklan</th>
                                        <th>Dibuat Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">

                                    <?php
                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($ads)):
                                    ?>

                                        <tr>

                                            <td><?= $no++ ?></td>

                                            <td><?= htmlspecialchars($row['ad_title']) ?></td>

                                            <td>
                                                <img
                                                    src="../assets/images/uploads/ads/<?= htmlspecialchars($row['ad_img']) ?>"
                                                    style="width:120px;height:auto;border-radius:8px;">
                                            </td>

                                            <td>
                                                <a href="<?= htmlspecialchars($row['ad_link']) ?>"
                                                    target="_blank">
                                                    <?= htmlspecialchars($row['ad_link']) ?>
                                                </a>
                                            </td>

                                            <td><?= htmlspecialchars($row['ad_request']) ?></td>

                                            <td>
                                                <?= date(
                                                    'd M Y H:i',
                                                    strtotime($row['created_at'])
                                                ) ?>
                                            </td>

                                            <td>

                                                <button
                                                    type="button"
                                                    class="btn btn-danger btn-sm deleteAds"
                                                    data-id="<?= $row['id'] ?>"
                                                    data-title="<?= htmlspecialchars($row['ad_title']) ?>">
                                                    Hapus
                                                </button>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small id="infoText">Showing 1 to 1 of 1 entries</small>

                            <div id="pagination"></div>
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

    <div
        class="modal fade"
        id="modalDeleteAds"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0"
                style="border-radius:16px;">

                <div class="modal-body text-center p-4">

                    <div
                        class="mx-auto mb-3"
                        style="
                        width:80px;
                        height:80px;
                        border-radius:50%;
                        background:#fff3f3;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                    ">

                        <span
                            class="material-icons"
                            style="
                            color:#dc3545;
                            font-size:42px;
                        ">
                            delete
                        </span>

                    </div>

                    <h4 class="mb-3">
                        Hapus Iklan
                    </h4>

                    <p id="deleteText" class="text-muted mb-4">
                    </p>

                    <div class="d-flex justify-content-center">

                        <button
                            type="button"
                            class="btn btn-light mr-2"
                            data-dismiss="modal">
                            Batal
                        </button>

                        <a
                            href="#"
                            id="confirmDeleteBtn"
                            class="btn btn-danger">
                            Ya, Hapus
                        </a>

                    </div>

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

    <?php if (isset($_SESSION['success'])): ?>

        <script>
            $(function() {

                toastr.options = {

                    closeButton: true,
                    progressBar: false,

                    newestOnTop: true,

                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",

                    preventDuplicates: true
                };

                toastr.success(
                    <?= json_encode($_SESSION['success']) ?>,
                    "Berhasil"
                );

            });
        </script>

    <?php
        unset($_SESSION['success']);
    endif;
    ?>

    <?php if (isset($_SESSION['error'])): ?>

        <script>
            $(function() {

                toastr.options = {

                    closeButton: true,
                    progressBar: false,

                    newestOnTop: true,

                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",

                    preventDuplicates: true
                };

                toastr.error(
                    <?= json_encode($_SESSION['error']) ?>,
                    "Gagal"
                );

            });
        </script>

    <?php
        unset($_SESSION['error']);
    endif;
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const tableBody = document.getElementById("tableBody");
            const rows = Array.from(tableBody.querySelectorAll("tr"));

            const searchInput = document.getElementById("searchInput");
            const entriesSelect = document.getElementById("entriesSelect");
            const pagination = document.getElementById("pagination");
            const infoText = document.getElementById("infoText");

            let currentPage = 1;
            let filteredRows = [...rows];

            function renderTable() {

                const perPage = parseInt(entriesSelect.value);
                const totalRows = filteredRows.length;
                const totalPages = Math.ceil(totalRows / perPage) || 1;

                if (currentPage > totalPages) {
                    currentPage = totalPages;
                }

                rows.forEach(row => row.style.display = "none");

                const start = (currentPage - 1) * perPage;
                const end = start + perPage;

                filteredRows.slice(start, end).forEach(row => {
                    row.style.display = "";
                });

                updateInfo(start, end, totalRows);
                renderPagination(totalPages);
            }

            function updateInfo(start, end, totalRows) {

                if (totalRows === 0) {

                    infoText.innerHTML =
                        "Showing 0 to 0 of 0 entries";

                    return;
                }

                infoText.innerHTML =
                    `Showing ${start + 1} to ${Math.min(end, totalRows)} of ${totalRows} entries`;
            }

            function renderPagination(totalPages) {

                pagination.innerHTML = "";

                let html = "";

                html += `
        <button
            class="btn btn-sm btn-light mr-1"
            ${currentPage === 1 ? "disabled" : ""}
            onclick="changePage(${currentPage - 1})">
            Prev
        </button>
    `;

                let pages = [];

                if (totalPages <= 7) {

                    for (let i = 1; i <= totalPages; i++) {
                        pages.push(i);
                    }

                } else {

                    pages.push(1);

                    if (currentPage > 3) {
                        pages.push("...");
                    }

                    let start = Math.max(2, currentPage - 1);
                    let end = Math.min(totalPages - 1, currentPage + 1);

                    for (let i = start; i <= end; i++) {
                        pages.push(i);
                    }

                    if (currentPage < totalPages - 2) {
                        pages.push("...");
                    }

                    pages.push(totalPages);
                }

                pages.forEach(page => {

                    if (page === "...") {

                        html += `
                <span class="mx-1">
                    ...
                </span>
            `;

                    } else {

                        html += `
                <button
                    class="btn btn-sm ${
                        page === currentPage
                        ? 'btn-primary'
                        : 'btn-light'
                    } mr-1"
                    onclick="changePage(${page})">
                    ${page}
                </button>
            `;
                    }
                });

                html += `
        <button
            class="btn btn-sm btn-light"
            ${currentPage === totalPages ? "disabled" : ""}
            onclick="changePage(${currentPage + 1})">
            Next
        </button>
    `;

                pagination.innerHTML = html;
            }

            window.changePage = function(page) {

                currentPage = page;

                renderTable();
            }

            searchInput.addEventListener("keyup", function() {

                const keyword =
                    this.value.toLowerCase().trim();

                filteredRows = rows.filter(row => {

                    return row.innerText
                        .toLowerCase()
                        .includes(keyword);

                });

                currentPage = 1;

                renderTable();
            });

            entriesSelect.addEventListener("change", function() {

                currentPage = 1;

                renderTable();
            });

            renderTable();
        });

        const dropArea = document.getElementById('dropArea');
        const fileInput = document.getElementById('fileInput');

        dropArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {

            const preview = document.getElementById('preview');

            preview.innerHTML = '';

            if (!this.files.length) return;

            const file = this.files[0];

            if (!file.type.startsWith('image/')) {

                toastr.error('File harus berupa gambar');
                this.value = '';

                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {

                preview.innerHTML = `
            <div style="
                position:relative;
                display:inline-block;
                margin-top:15px;
            ">

                <img
                    src="${e.target.result}"
                    style="
                        width:250px;
                        max-width:100%;
                        border-radius:12px;
                        border:1px solid #ddd;
                        padding:5px;
                        background:#fff;
                    "
                >

                <button
                    type="button"
                    id="removePreview"
                    style="
                        position:absolute;
                        top:-10px;
                        right:-10px;
                        width:28px;
                        height:28px;
                        border:none;
                        border-radius:50%;
                        background:#dc3545;
                        color:#fff;
                        cursor:pointer;
                        font-weight:bold;
                    ">
                    ×
                </button>

                <div
                    style="
                        margin-top:8px;
                        font-size:13px;
                        color:#666;
                    ">
                    ${file.name}
                </div>

            </div>
        `;

                document
                    .getElementById('removePreview')
                    .addEventListener('click', function() {

                        fileInput.value = '';
                        preview.innerHTML = '';

                    });
            };

            reader.readAsDataURL(file);

        });

        // MODAL DELETE
        document.addEventListener('click', function(e) {

            const btn = e.target.closest('.deleteAds');

            if (!btn) return;

            const id = btn.dataset.id;
            const title = btn.dataset.title;

            document.getElementById('deleteText').innerHTML =
                `Apakah Anda yakin ingin menghapus <b>"${title}"</b> ?`;

            document.getElementById('confirmDeleteBtn').href =
                '?delete=' + id;

            $('#modalDeleteAds').modal('show');

        });
    </script>
</body>

</html>