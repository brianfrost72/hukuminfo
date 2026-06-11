<?php
session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . "/../koneksi.php";

/*
|--------------------------------------------------------------------------
| AMBIL POST
|--------------------------------------------------------------------------
*/
$sql = "
SELECT
    p.id,
    p.user_id,
    p.post_title,
    p.post_desc,
    p.post_image,
    p.slug,
    p.status,
    p.created_at,

    pc.name_category,
    ps.name_subcategory,

    up.full_name,

    COUNT(DISTINCT pv.id) AS total_views,
    COUNT(DISTINCT pl.id) AS total_likes,
    COUNT(DISTINCT pb.id) AS total_bookmarks,
    COUNT(DISTINCT pco.id) AS total_comments,
    COUNT(DISTINCT pt.id) AS total_tags

FROM post p

LEFT JOIN post_category pc
    ON pc.id = p.post_category_id

LEFT JOIN post_subcategory ps
    ON ps.id = p.post_subcategory_id

LEFT JOIN users u
    ON u.id = p.user_id

LEFT JOIN user_profile up
    ON up.user_id = u.id

LEFT JOIN post_views pv
    ON pv.post_id = p.id

LEFT JOIN post_likes pl
    ON pl.post_id = p.id

LEFT JOIN post_bookmarks pb
    ON pb.post_id = p.id

LEFT JOIN post_comments pco
    ON pco.post_id = p.id
    AND pco.status = 'approved'

LEFT JOIN post_tags pt
    ON pt.post_id = p.id

GROUP BY p.id

ORDER BY p.created_at DESC
";

$result = mysqli_query($conn, $sql);
$current_user_id = $_SESSION['user_id'];
$current_role_id = $_SESSION['role_id'];

$isAdmin =
    in_array($current_role_id, [1, 2]);

// TOTAL POSTINGAN
$total_post = mysqli_fetch_assoc(
    mysqli_query($conn, "
        SELECT COUNT(*) total
        FROM post
    ")
)['total'];

// TOTAL KATEGORI
$total_category = mysqli_fetch_assoc(
    mysqli_query($conn, "
        SELECT COUNT(DISTINCT post_category_id) total
        FROM post
    ")
)['total'];

// TOTAL PENULIS
$total_author = mysqli_fetch_assoc(
    mysqli_query($conn, "
        SELECT COUNT(DISTINCT user_id) total
        FROM post
    ")
)['total'];

// TOTAL TAGS
$total_tags = mysqli_fetch_assoc(
    mysqli_query($conn, "
        SELECT COUNT(DISTINCT tag_id) total
        FROM post_tags
    ")
)['total'];

/*
|--------------------------------------------------------------------------
| AMBIL FILTER KATEGORI
|--------------------------------------------------------------------------
*/
$categories = mysqli_query($conn, "
    SELECT DISTINCT
        pc.id,
        pc.name_category
    FROM post_category pc
    INNER JOIN post p
        ON p.post_category_id = pc.id
    ORDER BY pc.name_category ASC
");
/*
|--------------------------------------------------------------------------
| AMBIL FILTER PENULIS
|--------------------------------------------------------------------------
*/
$authors = mysqli_query($conn, "
    SELECT DISTINCT
        up.full_name
    FROM user_profile up
    INNER JOIN post p
        ON p.user_id = up.user_id
    ORDER BY up.full_name ASC
");
/*
|--------------------------------------------------------------------------
| AMBIL POST
|--------------------------------------------------------------------------
*/
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Daftar Postingan - Dashboard | Hukuminfo.id</title>

    <!-- Select2 -->
    <link rel="stylesheet" href="../assets/vendor/select2/select2.min.css">

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

    <style>
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            min-width: 1600px;
        }

        .desc-col {
            width: 350px;
            min-width: 350px;
            max-width: 350px;

            line-height: 22px;
        }

        .desc-text {
            display: block;

            overflow: hidden;

            height: 44px;

            line-height: 22px;

            word-break: break-word;

            text-overflow: ellipsis;
        }
    </style>
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
                        <a href="add_post"
                            class="btn btn-primary ml-1">Tambah Postingan</a>
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
                                    list
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
                                    <span class="material-icons" style="color:var(--success);font-size:30px;">
                                        cast
                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0"><?= $total_post ?></h3>
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
                                        layers
                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0"><?= $total_category ?></h3>
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
                                    <span class="fa fa-hashtag" style="color:var(--primary);font-size:30px;">

                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0"><?= $total_tags ?></h3>
                                    <small class="text-muted">Total Tags</small>
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
                                    <span class="fa fa-user" style="color:var(--primary);font-size:30px;">

                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0"><?= $total_author ?></h3>
                                    <small class="text-muted">Total Penulis</small>
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
                                        <option>5</option>
                                        <option>10</option>
                                        <option>15</option>
                                        <option>20</option>
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
                            <div class="d-flex align-items-center"
                                style="gap:15px;">

                                <div style="width:220px;">
                                    <!-- TYPE -->
                                    <select id="categoryFilter" class="form-control select2">
                                        <option value="">Semua Kategori</option>

                                        <?php while ($cat = mysqli_fetch_assoc($categories)): ?>
                                            <option value="<?= htmlspecialchars($cat['name_category']) ?>">
                                                <?= htmlspecialchars($cat['name_category']) ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div style="width:220px;">
                                    <!-- PENULIS -->
                                    <select id="authorFilter" class="form-control select2">
                                        <option value="">Semua Penulis</option>

                                        <?php while ($author = mysqli_fetch_assoc($authors)): ?>
                                            <option value="<?= htmlspecialchars($author['full_name']) ?>">
                                                <?= htmlspecialchars($author['full_name']) ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <!-- TABLE CONTAIN -->
                        <div class="table-responsive">

                            <table class="table table-hover">

                                <thead style="background:#f8f9fc;">
                                    <tr>
                                        <th style="min-width:350px;">Judul Postingan</th>
                                        <th style="min-width:300px;">Penulis</th>
                                        <th style="min-width:150px;">Kategori</th>
                                        <th>Gambar</th>
                                        <th style="min-width:350px;">Deskripsi</th>
                                        <th>Komentar</th>
                                        <th>#Tags</th>
                                        <th>Views</th>
                                        <th>Like</th>
                                        <th>Bookmark</th>
                                        <th style="text-align:center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="jobTable">

                                    <?php while ($row = mysqli_fetch_assoc($result)) :
                                        $canManage =
                                            $isAdmin ||
                                            ($current_user_id == $row['user_id']);
                                    ?>

                                        <tr class="post-row">

                                            <td>
                                                <strong>
                                                    <?= htmlspecialchars($row['post_title']) ?>
                                                </strong>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['full_name']) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['name_category']) ?>
                                            </td>

                                            <td>
                                                <img
                                                    src="../assets/images/uploads/posts/<?= htmlspecialchars($row['post_image']) ?>"
                                                    alt="<?= htmlspecialchars($row['post_title']) ?>"
                                                    style="
        width:90px;
        height:60px;
        object-fit:cover;
        border-radius:8px;
        border:1px solid #e5e7eb;
    ">
                                            </td>

                                            <td class="desc-col">
                                                <div class="desc-text">
                                                    <?= mb_strimwidth(
                                                        strip_tags($row['post_desc']),
                                                        0,
                                                        80,
                                                        '...'
                                                    ) ?>
                                                </div>
                                            </td>

                                            <td>
                                                <?= $row['total_comments'] ?>
                                            </td>

                                            <td>
                                                <?= $row['total_tags'] ?>
                                            </td>

                                            <td>
                                                <?= $row['total_views'] ?>
                                            </td>

                                            <td>
                                                <?= $row['total_likes'] ?>
                                            </td>

                                            <td>
                                                <?= $row['total_bookmarks'] ?>
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center">

                                                    <?php if ($canManage): ?>

                                                        <a
                                                            href="edit_post?id=<?= $row['id'] ?>"
                                                            class="mr-2">

                                                            <button
                                                                class="btn btn-outline-primary btn-sm">

                                                                <span class="material-icons"
                                                                    style="font-size:16px;">
                                                                    edit
                                                                </span>

                                                            </button>

                                                        </a>

                                                        <button
                                                            class="btn btn-outline-danger btn-sm"
                                                            onclick="deleteRow(this)"
                                                            data-id="<?= $row['id'] ?>"
                                                            data-url="logic/delete_post.php?id=<?= $row['id'] ?>">

                                                            <span class="material-icons"
                                                                style="font-size:16px;">
                                                                delete
                                                            </span>

                                                        </button>

                                                    <?php else: ?>

                                                        <button
                                                            class="btn btn-outline-secondary btn-sm"
                                                            disabled>

                                                            <span class="material-icons"
                                                                style="font-size:16px;">
                                                                lock
                                                            </span>

                                                        </button>

                                                    <?php endif; ?>

                                                </div>
                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

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
        <app-settings layout-active="fluid"></app-settings>
    </div>

    <!-- ********************************** // MENU-Drawer ********************************** -->
    <?php include 'includes/drawer_menu.php'; ?>
    <!-- ********************************** //END MENU-drawer ********************************** -->

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

    <!-- Select2 -->
    <script src="../assets/vendor/select2/select2.min.js"></script>

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

    <script>
        let currentPage = 1;
        let perPage = 10;

        const searchInput = document.getElementById("searchInput");
        const categoryFilter = document.getElementById("categoryFilter");
        const authorFilter = document.getElementById("authorFilter");
        const showEntries = document.getElementById("showEntries");

        function getFilteredRows() {

            const search =
                searchInput.value.toLowerCase();

            const category =
                categoryFilter.value.toLowerCase();

            const author =
                authorFilter.value.toLowerCase();

            const rows =
                document.querySelectorAll(".post-row");

            return Array.from(rows).filter(row => {

                const title =
                    row.children[0].innerText.toLowerCase();

                const penulis =
                    row.children[1]
                    .innerText
                    .trim()
                    .toLowerCase();

                const kategori =
                    row.children[2]
                    .innerText
                    .trim()
                    .toLowerCase();

                const matchCategory =
                    category === "" ||
                    kategori.includes(category);

                const matchSearch =
                    title.includes(search);

                const matchAuthor =
                    author === "" ||
                    penulis.includes(author);

                return (
                    matchSearch &&
                    matchCategory &&
                    matchAuthor
                );
            });
        }

        function renderTable() {

            const rows = getFilteredRows();

            perPage =
                parseInt(showEntries.value);

            const totalData =
                rows.length;

            const totalPages =
                Math.ceil(totalData / perPage);

            document
                .querySelectorAll(".post-row")
                .forEach(row => {
                    row.style.display = "none";
                });

            const start =
                (currentPage - 1) * perPage;

            const end =
                start + perPage;

            rows.slice(start, end)
                .forEach(row => {
                    row.style.display = "";
                });

            renderPagination(
                totalPages,
                totalData
            );
        }

        function addPage(page, pagination) {

            const btn =
                document.createElement("button");

            btn.className =
                "page-btn";

            if (page === currentPage) {
                btn.classList.add("active");
            }

            btn.innerText = page;

            btn.onclick = () => {
                currentPage = page;
                renderTable();
            };

            pagination.appendChild(btn);
        }

        function renderPagination(
            totalPages,
            totalData
        ) {
            const pagination =
                document.getElementById(
                    "pagination"
                );

            pagination.innerHTML = "";

            const prev =
                document.createElement("button");

            prev.className = "page-btn";
            prev.innerHTML = "Prev";

            prev.disabled =
                currentPage === 1;

            prev.onclick = () => {
                currentPage--;
                renderTable();
            };

            pagination.appendChild(prev);

            let start =
                Math.max(
                    1,
                    currentPage - 2
                );

            let end =
                Math.min(
                    totalPages,
                    currentPage + 2
                );

            if (start > 1) {

                addPage(
                    1,
                    pagination
                );

                if (start > 2) {

                    pagination.innerHTML +=
                        "<span>...</span>";
                }
            }

            for (
                let i = start; i <= end; i++
            ) {
                addPage(
                    i,
                    pagination
                );
            }

            if (end < totalPages) {

                if (end < totalPages - 1) {

                    pagination.innerHTML +=
                        "<span>...</span>";
                }

                addPage(
                    totalPages,
                    pagination
                );
            }

            const next =
                document.createElement("button");

            next.className =
                "page-btn";

            next.innerHTML =
                "Next";

            next.disabled =
                currentPage === totalPages;

            next.onclick = () => {
                currentPage++;
                renderTable();
            };

            pagination.appendChild(next);

            const startData =
                totalData === 0 ?
                0 :
                ((currentPage - 1) * perPage) + 1;

            let endData =
                currentPage * perPage;

            if (endData > totalData) {
                endData = totalData;
            }

            document
                .getElementById(
                    "paginationInfo"
                ).innerText =
                `Menampilkan ${startData} - ${endData} dari ${totalData} data`;
        }

        // DELETE
        let deleteUrl = '';

        function deleteRow(button) {

            selectedRow = button.closest('tr');

            deleteUrl = button.dataset.url;

            const title =
                selectedRow.children[0].innerText.trim();

            document.getElementById(
                "deletePostTitle"
            ).innerText = `"${title}"`;

            $("#confirmDeleteModal").modal("show");
        }

        document
            .getElementById("btnConfirmDelete")
            .addEventListener("click", function() {

                window.location.href = deleteUrl;

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

        authorFilter.addEventListener("change", () => {
            currentPage = 1;
            renderTable();
        });

        showEntries.addEventListener("change", () => {
            currentPage = 1;
            renderTable();
        });

        $('.select2').select2();

        $('#categoryFilter').on('change', function() {

            currentPage = 1;
            renderTable();

        });

        $('#authorFilter').on('change', function() {

            currentPage = 1;
            renderTable();

        });

        /* INIT */
        renderTable();
    </script>
</body>

</html>