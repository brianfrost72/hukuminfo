<?php
session_start();
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . "/../koneksi.php";

/*
|--------------------------------------------------------------------------
| TAMBAH DATA
|--------------------------------------------------------------------------
*/
if (isset($_POST['action']) && $_POST['action'] == 'add') {

    $post_category_id = (int)$_POST['post_category_id'];

    $name_subcategory = mysqli_real_escape_string(
        $conn,
        trim($_POST['name_subcategory'])
    );

    $desc_subcategory = mysqli_real_escape_string(
        $conn,
        trim($_POST['desc_subcategory'])
    );

    $cek = mysqli_query($conn, "
        SELECT id
        FROM post_subcategory
        WHERE post_category_id='$post_category_id'
        AND LOWER(TRIM(name_subcategory))
            = LOWER(TRIM('$name_subcategory'))
        LIMIT 1
    ");

    if (mysqli_num_rows($cek) > 0) {
        header("Location: manage_post_subcategory.php?error=duplicate");
        exit;
    }

    mysqli_query($conn, "
        INSERT INTO post_subcategory
        (
            post_category_id,
            name_subcategory,
            desc_subcategory
        )
        VALUES
        (
            '$post_category_id',
            '$name_subcategory',
            '$desc_subcategory'
        )
    ");

    header("Location: manage_post_subcategory.php?success=add");
    exit;
}

/*
|--------------------------------------------------------------------------
| EDIT DATA
|--------------------------------------------------------------------------
*/
if (isset($_POST['action']) && $_POST['action'] == 'edit') {

    $id = (int)$_POST['id'];

    $post_category_id = (int)$_POST['post_category_id'];

    $name_subcategory = mysqli_real_escape_string(
        $conn,
        trim($_POST['name_subcategory'])
    );

    $desc_subcategory = mysqli_real_escape_string(
        $conn,
        trim($_POST['desc_subcategory'])
    );

    $cek = mysqli_query($conn, "
        SELECT id
        FROM post_subcategory
        WHERE post_category_id='$post_category_id'
        AND LOWER(TRIM(name_subcategory))
            = LOWER(TRIM('$name_subcategory'))
        AND id != '$id'
        LIMIT 1
    ");

    if (mysqli_num_rows($cek) > 0) {
        header("Location: manage_post_subcategory.php?error=duplicate");
        exit;
    }

    mysqli_query($conn, "
        UPDATE post_subcategory
        SET
            post_category_id='$post_category_id',
            name_subcategory='$name_subcategory',
            desc_subcategory='$desc_subcategory'
        WHERE id='$id'
    ");

    header("Location: manage_post_subcategory.php?success=edit");
    exit;
}

/*
|--------------------------------------------------------------------------
| TAMPILKAN DATA
|--------------------------------------------------------------------------
*/

$qSubCategory = mysqli_query($conn, "
    SELECT
        ps.*,
        pc.name_category
    FROM post_subcategory ps
    INNER JOIN post_category pc
        ON pc.id = ps.post_category_id
    ORDER BY
        pc.name_category ASC,
        ps.name_subcategory ASC
");

/*
|--------------------------------------------------------------------------
| HAPUS
|--------------------------------------------------------------------------
*/
if (
    isset($_POST['action'])
    &&
    $_POST['action'] == 'delete_selected'
) {

    $ids =
        explode(
            ',',
            $_POST['selected_ids']
        );

    $ids =
        array_map(
            'intval',
            $ids
        );

    if (count($ids) > 0) {

        mysqli_query(
            $conn,
            "DELETE FROM post_subcategory
             WHERE id IN (" . implode(',', $ids) . ")"
        );
    }

    header(
        "Location: manage_post_subcategory.php?success=delete"
    );
    exit;
}

if (
    isset($_POST['action'])
    &&
    $_POST['action'] == 'delete_single'
) {

    $id = (int)$_POST['id'];

    mysqli_query(
        $conn,
        "DELETE FROM post_subcategory
         WHERE id='$id'"
    );

    header(
        "Location: manage_post_subcategory.php?success=delete"
    );
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
    <title>Manage Sub-Kategori Artikel - Dashboard | Hukuminfo.id</title>

    <!-- favicon.ico in the root directory -->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

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
                                        Manage Sub-Kategori Artikel
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Sub-Kategori Artikel</h1>
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
                            <h4 class="card-title">Manage Sub-Kategori Artikel</h4>
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
                                            <th>Nama Sub-Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;

                                        while ($row = mysqli_fetch_assoc($qSubCategory)) :
                                        ?>
                                            <tr class="data-row">
                                                <td>
                                                    <input type="checkbox"
                                                        class="rowCheck"
                                                        value="<?= $row['id']; ?>">
                                                </td>

                                                <td><?= $no++; ?></td>

                                                <td><?= htmlspecialchars($row['name_category']); ?></td>

                                                <td><?= htmlspecialchars($row['name_subcategory']); ?></td>

                                                <td><?= htmlspecialchars($row['desc_subcategory']); ?></td>

                                                <td>
                                                    <button
                                                        class="btn btn-warning btn-sm btn-edit"

                                                        data-id="<?= $row['id']; ?>"

                                                        data-category="<?= $row['post_category_id']; ?>"

                                                        data-name="<?= htmlspecialchars($row['name_subcategory']); ?>"

                                                        data-desc="<?= htmlspecialchars($row['desc_subcategory']); ?>">

                                                        Edit
                                                    </button>

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm btn-delete"

                                                        data-id="<?= $row['id']; ?>"

                                                        data-name="<?= htmlspecialchars($row['name_subcategory']); ?>">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- PAGINATION -->
                            <div class="row mt-3 align-items-center">

                                <div class="col-md-6">

                                    <form id="deleteSelectedForm"
                                        method="POST">

                                        <input
                                            type="hidden"
                                            name="action"
                                            value="delete_selected">

                                        <input
                                            type="hidden"
                                            name="selected_ids"
                                            id="selectedIds">

                                    </form>

                                    <button
                                        type="button"
                                        class="btn btn-danger d-none mb-2"
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
                <div class="modal-header">
                    <h5>Tambah Data</h5>
                </div>

                <form method="POST">

                    <input type="hidden"
                        name="action"
                        value="add">

                    <div class="modal-body">

                        <label>Pilih Kategori</label>

                        <select
                            name="post_category_id" id="kategoriTambah"
                            class="mb-5"
                            required>

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            <?php
                            $qKategori = mysqli_query($conn, "
                SELECT *
                FROM post_category
                ORDER BY name_category ASC
            ");

                            while ($kat = mysqli_fetch_assoc($qKategori)):
                            ?>

                                <option value="<?= $kat['id']; ?>">
                                    <?= htmlspecialchars($kat['name_category']); ?>
                                </option>

                            <?php endwhile; ?>

                        </select>

                        <label>Tambah Sub-Kategori</label>

                        <input
                            type="text"
                            name="name_subcategory"
                            class="form-control mb-3"
                            required>

                        <label>Tambah Deskripsi</label>

                        <textarea
                            name="desc_subcategory"
                            class="form-control"
                            required></textarea>

                    </div>

                    <div class="modal-footer">
                        <button
                            type="submit"
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
                <div class="modal-header">
                    <h5>Edit Data</h5>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input
                            type="hidden"
                            name="action"
                            value="edit">

                        <input
                            type="hidden"
                            name="id"
                            id="editId">

                        <label>Pilih Kategori</label>
                        <select
                            id="kategoriEdit"
                            name="post_category_id"
                            class="mb-3">

                            <?php
                            $qKategoriEdit = mysqli_query($conn, "
        SELECT *
        FROM post_category
        ORDER BY name_category ASC
    ");

                            while ($kat = mysqli_fetch_assoc($qKategoriEdit)):
                            ?>

                                <option value="<?= $kat['id']; ?>">
                                    <?= htmlspecialchars($kat['name_category']); ?>
                                </option>

                            <?php endwhile; ?>

                        </select>

                        <label>Edit Kategori</label>
                        <input
                            type="text"
                            name="name_subcategory"
                            id="subkategoriEdit"
                            class="form-control">

                        <label>Edit Deskripsi</label>
                        <textarea
                            name="desc_subcategory"
                            id="deskripsiEdit"
                            class="form-control">
                        </textarea>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="submit"
                            class="btn btn-success">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade"
        id="deleteModal">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <form method="POST">

                    <input
                        type="hidden"
                        name="action"
                        value="delete_single">

                    <input
                        type="hidden"
                        name="id"
                        id="deleteId">

                    <div class="modal-body text-center">

                        <h5 id="deleteText"></h5>

                    </div>

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="btn btn-danger">
                            Hapus
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <div class="modal fade" id="deleteSelectedModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body text-center">

                    <h5 id="deleteSelectedText"></h5>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Batal
                    </button>

                    <button
                        type="button"
                        id="confirmDeleteSelected"
                        class="btn btn-danger">
                        Hapus
                    </button>

                </div>

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

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

    <?php if (isset($_GET['success']) && $_GET['success'] == 'add'): ?>
        <script>
            toastr.success('Sub-Kategori berhasil ditambahkan');
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['success']) && $_GET['success'] == 'edit'): ?>
        <script>
            toastr.success('Sub-Kategori berhasil diperbarui');
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['success']) && $_GET['success'] == 'delete'): ?>
        <script>
            toastr.success('Sub-Kategori berhasil dihapus');
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'duplicate'): ?>
        <script>
            toastr.error('Sub-Kategori sudah tersedia');
        </script>
    <?php endif; ?>

    <script>
        $(document).on("click", ".btn-edit", function() {

            $("#editId").val($(this).data("id"));

            $("#kategoriEdit")
                .val($(this).data("category"))
                .trigger("change");

            $("#subkategoriEdit").val(
                $(this).data("name")
            );

            $("#deskripsiEdit").val(
                $(this).data("desc")
            );

            $("#modalEdit").modal("show");

        });

        // SELECT2
        $(function() {

            $('#kategoriTambah').select2({
                dropdownParent: $('#modalTambah'),
                width: '100%'
            });

            $('#kategoriEdit').select2({
                dropdownParent: $('#modalEdit'),
                width: '100%'
            });

        });

        // MODAL HAPUS
        $(document).on(
            'click',
            '.btn-delete',
            function() {

                $('#deleteId')
                    .val(
                        $(this).data('id')
                    );

                $('#deleteText')
                    .html(
                        'Subkategori "<b>' +
                        $(this).data('name') +
                        '</b>" dihapus ?'
                    );

                $('#deleteModal')
                    .modal('show');

            }
        );
    </script>

    <script>
        let currentPage = 1;
        let rowsPerPage = 5;

        function renderTable() {

            const rows =
                Array.from(
                    document.querySelectorAll('.data-row')
                );

            const keyword =
                document.getElementById('searchInput')
                .value
                .toLowerCase();

            const filteredRows =
                rows.filter(row =>
                    row.innerText
                    .toLowerCase()
                    .includes(keyword)
                );

            rows.forEach(row => {
                row.style.display = 'none';
            });

            const total =
                filteredRows.length;

            const start =
                (currentPage - 1) * rowsPerPage;

            const end =
                start + rowsPerPage;

            filteredRows
                .slice(start, end)
                .forEach(row => {
                    row.style.display = '';
                });

            document.getElementById('showingInfo')
                .innerHTML =
                `Showing ${
            total === 0 ? 0 : start + 1
        } to ${
            Math.min(end,total)
        } of ${total} entries`;

            renderPagination(total);
        }

        // SHOW ENTRIES
        document.getElementById('showEntries')
            .addEventListener('change', function() {

                rowsPerPage =
                    parseInt(this.value);

                currentPage = 1;

                renderTable();

            });

        // HAPUS SELECTED
        function toggleDeleteButton() {

            const checked =
                document.querySelectorAll(
                    '.rowCheck:checked'
                );

            const btn =
                document.getElementById(
                    'deleteSelected'
                );

            if (checked.length > 0) {

                btn.classList.remove('d-none');

            } else {

                btn.classList.add('d-none');

            }
        }

        document.addEventListener(
            'change',
            function(e) {

                if (
                    e.target.classList.contains('rowCheck') ||
                    e.target.id === 'checkAll'
                ) {
                    toggleDeleteButton();
                }

            }
        );

        $('#deleteSelected').on('click', function() {

            let ids = [];
            let names = [];

            $('.rowCheck:checked').each(function() {

                ids.push($(this).val());

                names.push(
                    $(this)
                    .closest('tr')
                    .find('td:eq(3)')
                    .text()
                    .trim()
                );

            });

            $('#selectedIds').val(
                ids.join(',')
            );

            $('#deleteSelectedText').html(
                'Subkategori "<b>' +
                names.join(', ') +
                '</b>" dihapus ?'
            );

            $('#deleteSelectedModal').modal('show');

        });

        $('#confirmDeleteSelected').on('click', function() {

            $('#deleteSelectedForm').submit();

        });

        // PAGINATION
        function renderPagination(totalRows) {

            const totalPages =
                Math.ceil(
                    totalRows / rowsPerPage
                );

            let html = '';

            html += `
        <li class="page-item ${
            currentPage===1?'disabled':''
        }">
            <a class="page-link"
               href="#"
               onclick="changePage(${currentPage-1})">
                Prev
            </a>
        </li>
    `;

            for (let i = 1; i <= totalPages; i++) {

                if (
                    i === 1 ||
                    i === totalPages ||
                    (
                        i >= currentPage - 2 &&
                        i <= currentPage + 2
                    )
                ) {

                    html += `
                <li class="page-item ${
                    currentPage===i
                    ? 'active'
                    : ''
                }">

                <a class="page-link"
                   href="#"
                   onclick="changePage(${i})">
                   ${i}
                </a>

                </li>
            `;

                } else if (
                    i === 2 ||
                    i === totalPages - 1
                ) {

                    html += `
                <li class="page-item disabled">
                    <span class="page-link">
                        ...
                    </span>
                </li>
            `;
                }

            }

            html += `
        <li class="page-item ${
            currentPage===totalPages
            ?'disabled':''
        }">

            <a class="page-link"
               href="#"
               onclick="changePage(${currentPage+1})">
                Next
            </a>

        </li>
    `;

            document.getElementById('pagination')
                .innerHTML = html;
        }

        function changePage(page) {

            const totalPages =
                Math.ceil(
                    document.querySelectorAll(
                        '.data-row'
                    ).length /
                    rowsPerPage
                );

            if (page < 1) return;

            if (page > totalPages) return;

            currentPage = page;

            renderTable();
        }

        // SEARCH
        document.getElementById('searchInput')
            .addEventListener('keyup', function() {

                currentPage = 1;

                renderTable();

            });

        renderTable();

        // CHECKLIST
        $('#checkAll').on('change', function() {

            $('.rowCheck').prop(
                'checked',
                $(this).prop('checked')
            );

            toggleDeleteButton();

        });
    </script>
</body>

</html>