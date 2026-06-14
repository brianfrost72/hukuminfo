<?php
session_start();

require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../koneksi.php';

$userId = $_SESSION['user_id'] ?? 0;


if (!$userId) {
    die('Silakan login terlebih dahulu.');
}

$sql = "
SELECT
    pb.created_at AS bookmark_date,
    p.id,
    p.post_title,
    p.post_image,
    p.slug,
    p.created_at,
    pp.full_name,
    pp.photo_profile
FROM post_bookmarks pb
INNER JOIN post p
    ON p.id = pb.post_id
LEFT JOIN users u
    ON u.id = p.user_id
LEFT JOIN public_profile pp
    ON pp.user_id = u.id
WHERE pb.user_id = ?
    AND p.status = 'publish'
ORDER BY pb.created_at DESC
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$bookmarks = [];

while ($row = mysqli_fetch_assoc($result)) {
    $bookmarks[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
        content="">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daftar Bookmark - Konig Guard Bureau</title>

    <!-- Perfect Scrollbar -->
    <link type="text/css"
        href="../assets/vendor/perfect-scrollbar.css"
        rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css"
        href="../assets/css/app.css"
        rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css"
        href="../assets/css/vendor-material-icons.css"
        rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css"
        href="assets/css/vendor-fontawesome-free.css"
        rel="stylesheet">
</head>

<body class="layout-fixed">

    <div class="preloader"></div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        <div id="header"
            class="mdk-header js-mdk-header m-0"
            data-fixed
            data-effects="waterfall">
            <?php include 'includes/topheader.php'; ?>
        </div>

        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content page">
            <div class="page__header mb-0">
                <?php include 'includes/navbar.php'; ?>
            </div>

            <div class="container page__heading-container">
                <div class="page__heading d-flex align-items-center">
                    <div class="flex">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="/"><i class="material-icons icon-20pt">home</i></a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page"><a href="/">Beranda</a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">Daftar Bookmark</li>
                            </ol>
                        </nav>
                        <h1 class="m-0">Daftar Bookmark</h1>
                    </div>
                </div>
            </div>

            <div class="container page__container">

                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <i class="material-icons mr-2 text-white">bookmark</i>
                        <h4 class="card-title mb-0 text-white">Daftar Bookmark</h4>
                    </div>

                    <div class="card-body">

                        <!-- Show Entries + Search -->
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <span class="mr-2">Show</span>
                                    <select id="entriesPerPage" class="form-control form-control-sm"
                                        style="width:80px;">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>25</option>
                                        <option>50</option>
                                        <option>100</option>
                                    </select>
                                    <span class="ml-2">entries</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <input type="text" id="searchInput"
                                    class="form-control float-right"
                                    placeholder="Cari judul postingan...">
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="70">No</th>
                                        <th width="90">Foto</th>
                                        <th>Judul Postingan</th>
                                        <th width="180">Tanggal Bookmark</th>
                                        <th width="120" class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="bookmarkTableBody">

                                    <?php if (!empty($bookmarks)): ?>
                                        <?php $no = 1; ?>

                                        <?php foreach ($bookmarks as $row): ?>

                                            <?php
                                            $gambar = !empty($row['post_image'])
                                                ? "../assets/images/uploads/posts/" . $row['post_image']
                                                : "../assets/images/no-image.png";
                                            ?>

                                            <tr>

                                                <td><?= $no++; ?></td>

                                                <td>
                                                    <img src="<?= htmlspecialchars($gambar); ?>"
                                                        class="rounded"
                                                        width="70"
                                                        height="50"
                                                        style="object-fit:cover;">
                                                </td>

                                                <td>
                                                    <strong><?= htmlspecialchars($row['post_title']); ?></strong>

                                                    <?php if (!empty($row['full_name'])): ?>
                                                        <br>
                                                        <small class="text-muted">
                                                            Oleh <?= htmlspecialchars($row['full_name']); ?>
                                                        </small>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <?= date('d F Y H:i', strtotime($row['bookmark_date'])); ?> WIB
                                                </td>

                                                <td class="text-center">
                                                    <a href="https://hukuminfo.id/<?= urlencode($row['slug']); ?>"
                                                        target="_blank"
                                                        class="btn btn-primary btn-sm"
                                                        title="Lihat Postingan">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                </td>

                                            </tr>

                                        <?php endforeach; ?>

                                    <?php else: ?>

                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <i class="material-icons text-muted" style="font-size:48px;">
                                                    bookmark_border
                                                </i>
                                                <br>
                                                Belum ada artikel yang dibookmark.
                                            </td>
                                        </tr>

                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="row mt-3 align-items-center">

                            <div class="col-md-6 mb-2 mb-md-0">
                                <small id="tableInfo">
                                    Menampilkan 0 dari 0 data
                                </small>
                            </div>

                            <div class="col-md-6">
                                <nav>
                                    <ul id="pagination" class="pagination justify-content-end mb-0"></ul>
                                </nav>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>
        <!-- // END Header Layout Content -->

    </div>
    <!-- // END Header Layout -->

    <!-- App Settings FAB -->
    <div id="app-settings" style="display: none;">
        <app-settings layout-active="fixed"></app-settings>
    </div>

    <!-- ********************************** // MENU-Drawer ********************************** -->
    <?php include 'includes/mobile_menu.php'; ?>
    <!-- ********************************** //END MENU-drawer ********************************** -->

    <footer class="dashboard-footer mt-4">
        <?php include 'includes/footer.php'; ?>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const searchInput = document.getElementById('searchInput');
            const entriesSelect = document.getElementById('entriesPerPage');
            const tbody = document.getElementById('bookmarkTableBody');
            const pagination = document.getElementById('pagination');
            const tableInfo = document.getElementById('tableInfo');

            let currentPage = 1;

            function renderTable() {

                const keyword = searchInput.value.toLowerCase();

                const rows = [...tbody.querySelectorAll('tr')];

                const filteredRows = rows.filter(row => {
                    return row.innerText.toLowerCase().includes(keyword);
                });

                const perPage = parseInt(entriesSelect.value);

                const totalRows = filteredRows.length;
                const totalPages = Math.max(1, Math.ceil(totalRows / perPage));

                if (currentPage > totalPages) {
                    currentPage = totalPages;
                }

                rows.forEach(row => row.style.display = 'none');

                const start = (currentPage - 1) * perPage;
                const end = start + perPage;

                filteredRows.slice(start, end).forEach(row => {
                    row.style.display = '';
                });

                const showing = filteredRows.slice(start, end).length;

                tableInfo.innerHTML =
                    `Menampilkan ${showing} dari ${totalRows} data`;

                renderPagination(totalPages);
            }

            function renderPagination(totalPages) {

                pagination.innerHTML = '';

                const addItem = (label, page, active = false, disabled = false) => {

                    const li = document.createElement('li');

                    li.className =
                        `page-item ${active ? 'active' : ''} ${disabled ? 'disabled' : ''}`;

                    li.innerHTML =
                        `<a href="#" class="page-link">${label}</a>`;

                    if (!disabled) {
                        li.addEventListener('click', function(e) {
                            e.preventDefault();
                            currentPage = page;
                            renderTable();
                        });
                    }

                    pagination.appendChild(li);
                };

                addItem(
                    '<i class="material-icons" style="font-size:18px">chevron_left</i>',
                    currentPage - 1,
                    false,
                    currentPage === 1
                );

                let startPage = Math.max(1, currentPage - 2);
                let endPage = Math.min(totalPages, currentPage + 2);

                if (startPage > 1) {
                    addItem(1, 1);

                    if (startPage > 2) {
                        const dots = document.createElement('li');
                        dots.className = 'page-item disabled';
                        dots.innerHTML =
                            '<span class="page-link">...</span>';
                        pagination.appendChild(dots);
                    }
                }

                for (let i = startPage; i <= endPage; i++) {
                    addItem(i, i, i === currentPage);
                }

                if (endPage < totalPages) {

                    if (endPage < totalPages - 1) {
                        const dots = document.createElement('li');
                        dots.className = 'page-item disabled';
                        dots.innerHTML =
                            '<span class="page-link">...</span>';
                        pagination.appendChild(dots);
                    }

                    addItem(totalPages, totalPages);
                }

                addItem(
                    '<i class="material-icons" style="font-size:18px">chevron_right</i>',
                    currentPage + 1,
                    false,
                    currentPage === totalPages
                );
            }

            searchInput.addEventListener('keyup', function() {
                currentPage = 1;
                renderTable();
            });

            entriesSelect.addEventListener('change', function() {
                currentPage = 1;
                renderTable();
            });

            renderTable();

        });
    </script>
</body>

</html>