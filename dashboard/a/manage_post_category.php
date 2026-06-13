<?php
session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . "/../koneksi.php";

function generateSlug($text)
{
    $text = strtolower(trim($text));

    $text = preg_replace('/[^a-z0-9]+/', '-', $text);

    return trim($text, '-');
}
/*
|--------------------------------------------------------------------------
| TAMBAH DATA
|--------------------------------------------------------------------------
*/
if (isset($_POST['action']) && $_POST['action'] == 'add') {

    $name_category = mysqli_real_escape_string(
        $conn,
        trim($_POST['name_category'])
    );

    $desc_category = mysqli_real_escape_string(
        $conn,
        trim($_POST['desc_category'])
    );

    if ($name_category != '' && $desc_category != '') {

        $cek = mysqli_query($conn, "
    SELECT id
    FROM post_category
    WHERE LOWER(TRIM(name_category))
          = LOWER(TRIM('$name_category'))
    LIMIT 1
");

        if (mysqli_num_rows($cek) > 0) {

            header("Location: manage_post_category.php?error=duplicate");
            exit;
        }

        $slug = generateSlug($name_category);

        mysqli_query($conn, "
    INSERT INTO post_category
    (
        name_category,
        slug,
        desc_category
    )
    VALUES
    (
        '$name_category',
        '$slug',
        '$desc_category'
    )
");

        header("Location: manage_post_category.php?success=add");
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| HAPUS DATA
|--------------------------------------------------------------------------
*/
if (isset($_GET['delete'])) {

    $id = (int)$_GET['delete'];

    mysqli_query($conn, "
        DELETE FROM post_category
        WHERE id='$id'
    ");

    header("Location: manage_post_category.php?success=delete");
    exit;
}

/*
|--------------------------------------------------------------------------
| UPDATE DATA
|--------------------------------------------------------------------------
*/
if (isset($_POST['action']) && $_POST['action'] == 'edit') {

    $id = (int)$_POST['id'];

    $name_category = mysqli_real_escape_string(
        $conn,
        trim($_POST['name_category'])
    );

    $desc_category = mysqli_real_escape_string(
        $conn,
        trim($_POST['desc_category'])
    );

    $cek = mysqli_query($conn, "
        SELECT id
        FROM post_category
        WHERE LOWER(TRIM(name_category))
              = LOWER(TRIM('$name_category'))
        AND id != '$id'
        LIMIT 1
    ");

    if (mysqli_num_rows($cek) > 0) {

        header("Location: manage_post_category.php?error=duplicate");
        exit;
    }

    $slug = generateSlug($name_category);

    mysqli_query($conn, "
        UPDATE post_category
SET
    name_category='$name_category',
    slug='$slug',
    desc_category='$desc_category'
WHERE id='$id'
    ");

    header("Location: manage_post_category.php?success=edit");
    exit;
}

/*
|--------------------------------------------------------------------------
| GET DATA ASC
|--------------------------------------------------------------------------
*/
$qCategory = mysqli_query($conn, "
    SELECT *
    FROM post_category
    ORDER BY name_category ASC
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
    <title>Manage Kategori Artikel - Dashboard | Hukuminfo.id</title>


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
                                        Manage Kategori Artikel
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Kategori Artikel</h1>
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
                            <h4 class="card-title">Manage Kategori Artikel</h4>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah</button>
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
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;

                                        while ($row = mysqli_fetch_assoc($qCategory)) :
                                        ?>
                                            <tr class="data-row">
                                                <td>
                                                    <input type="checkbox"
                                                        class="rowCheck"
                                                        value="<?= $row['id']; ?>">
                                                </td>

                                                <td><?= $no++; ?></td>

                                                <td><?= htmlspecialchars($row['name_category']); ?></td>

                                                <td><?= htmlspecialchars($row['desc_category']); ?></td>

                                                <td>
                                                    <button
                                                        class="btn btn-warning btn-sm btn-edit"
                                                        data-id="<?= $row['id']; ?>"
                                                        data-name="<?= htmlspecialchars($row['name_category']); ?>"
                                                        data-desc="<?= htmlspecialchars($row['desc_category']); ?>">
                                                        Edit
                                                    </button>

                                                    <a href="?delete=<?= $row['id']; ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin hapus data ini?')">
                                                        Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- PAGINATION -->
                            <div class="row mt-3 align-items-center">

                                <div class="col-md-6">

                                    <button
                                        class="btn btn-danger d-none"
                                        id="deleteSelected">
                                        Hapus Terpilih
                                    </button>

                                    <div
                                        id="showingInfo"
                                        class="mt-2 text-muted">
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <nav>
                                        <ul
                                            class="pagination justify-content-end mb-0"
                                            id="pagination">
                                        </ul>
                                    </nav>

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

    <!-- ********************************** // MODAL ********************************** -->
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST">

                    <input type="hidden" name="action" value="add">

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori</h5>
                        <button type="button"
                            class="close"
                            data-dismiss="modal">
                            &times;
                        </button>
                    </div>

                    <div class="modal-body">

                        <label>Nama Kategori</label>
                        <input type="text"
                            name="name_category"
                            class="form-control"
                            required>

                        <label class="mt-3">Deskripsi</label>
                        <textarea
                            name="desc_category"
                            class="form-control"
                            required></textarea>

                    </div>

                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST">

                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" id="editId">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kategori</h5>
                    </div>

                    <div class="modal-body">

                        <label>Nama Kategori</label>
                        <input type="text"
                            name="name_category"
                            id="kategoriEdit"
                            class="form-control">

                        <label class="mt-3">Deskripsi</label>
                        <textarea
                            name="desc_category"
                            id="deskripsiEdit"
                            class="form-control"></textarea>

                    </div>

                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-success">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- ********************************** // MODAL END ********************************** -->

    <footer class="dashboard-footer mt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- LEFT -->
                <div class="col-md-6 text-md-left text-center mb-2 mb-md-0">
                    <span class="footer-text">
                        © 2026 Hukuminfo. All rights reserved.
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
        toastr.options = {
            closeButton: true,
            progressBar: false,
            newestOnTop: true,
            timeOut: 0,
            extendedTimeOut: 0,
            tapToDismiss: false,
            preventDuplicates: true
        };

        <?php if (isset($_GET['success']) && $_GET['success'] == 'add'): ?>

            toastr.success(
                'Kategori berhasil ditambahkan',
                'Berhasil'
            );

        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] == 'edit'): ?>

            toastr.success(
                'Kategori berhasil diperbarui',
                'Berhasil'
            );

        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] == 'delete'): ?>

            toastr.success(
                'Kategori berhasil dihapus',
                'Berhasil'
            );

        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == 'duplicate'): ?>

            toastr.error(
                'Nama kategori sudah digunakan',
                'Duplikat Data'
            );

        <?php endif; ?>
    </script>

    <script>
        $(document).on("click", ".btn-edit", function() {

            $("#editId").val($(this).data("id"));

            $("#kategoriEdit").val($(this).data("name"));

            $("#deskripsiEdit").val($(this).data("desc"));

            $("#modalEdit").modal("show");
        });

        let currentPage = 1;
        let rowsPerPage = 5;

        const searchInput = document.getElementById('searchInput');
        const showEntries = document.getElementById('showEntries');

        function renderTable() {

            const rows =
                Array.from(document.querySelectorAll('.data-row'));

            const keyword =
                searchInput.value.toLowerCase();

            let filteredRows = rows.filter(row => {

                return row.innerText
                    .toLowerCase()
                    .includes(keyword);

            });

            rows.forEach(row => row.style.display = 'none');

            const totalRows = filteredRows.length;

            const start =
                (currentPage - 1) * rowsPerPage;

            const end =
                start + rowsPerPage;

            filteredRows
                .slice(start, end)
                .forEach(row => {

                    row.style.display = '';

                });

            document.getElementById("showingInfo")
                .innerHTML =
                `Showing ${totalRows == 0 ? 0 : start + 1}
         to ${Math.min(end,totalRows)}
         of ${totalRows} entries`;

            renderPagination(totalRows);
        }

        function renderPagination(totalRows) {

            const pageCount =
                Math.ceil(totalRows / rowsPerPage);

            let html = '';

            html += `
        <li class="page-item ${currentPage==1?'disabled':''}">
            <a class="page-link"
               href="#"
               onclick="changePage(${currentPage-1})">
               Prev
            </a>
        </li>
    `;

            let start =
                Math.max(1, currentPage - 2);

            let end =
                Math.min(pageCount, currentPage + 2);

            if (start > 1) {

                html += `
            <li class="page-item">
                <a class="page-link"
                   href="#"
                   onclick="changePage(1)">
                   1
                </a>
            </li>
        `;

                if (start > 2) {

                    html += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            `;

                }
            }

            for (let i = start; i <= end; i++) {

                html += `
            <li class="page-item ${i==currentPage?'active':''}">
                <a class="page-link"
                   href="#"
                   onclick="changePage(${i})">
                    ${i}
                </a>
            </li>
        `;

            }

            if (end < pageCount) {

                if (end < pageCount - 1) {

                    html += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            `;

                }

                html += `
            <li class="page-item">
                <a class="page-link"
                   href="#"
                   onclick="changePage(${pageCount})">
                   ${pageCount}
                </a>
            </li>
        `;
            }

            html += `
        <li class="page-item ${currentPage==pageCount?'disabled':''}">
            <a class="page-link"
               href="#"
               onclick="changePage(${currentPage+1})">
               Next
            </a>
        </li>
    `;

            document.getElementById("pagination").innerHTML = html;
        }

        function changePage(page) {

            const totalRows =
                document.querySelectorAll('.data-row').length;

            const pageCount =
                Math.ceil(totalRows / rowsPerPage);

            if (page < 1 || page > pageCount)
                return;

            currentPage = page;

            renderTable();
        }

        searchInput.addEventListener("keyup", function() {

            currentPage = 1;

            renderTable();

        });

        showEntries.addEventListener("change", function() {

            rowsPerPage =
                parseInt(this.value);

            currentPage = 1;

            renderTable();

        });

        document.addEventListener("change", function() {

            const checked =
                document.querySelectorAll('.rowCheck:checked');

            const btn =
                document.getElementById('deleteSelected');

            if (checked.length > 0) {

                btn.classList.remove('d-none');

            } else {

                btn.classList.add('d-none');

            }

        });

        document.getElementById('checkAll')
            .addEventListener('change', function() {

                document.querySelectorAll('.rowCheck')
                    .forEach(cb => {

                        cb.checked = this.checked;

                    });

                document.dispatchEvent(
                    new Event('change')
                );

            });

        renderTable();
    </script>
</body>

</html>