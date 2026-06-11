<?php
session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . "/../koneksi.php";

/*
|--------------------------------------------------------------------------
| GET BOOKMARKS
|--------------------------------------------------------------------------
*/
$bookmarks = [];

$sql = "
SELECT
    pb.id,
    pb.created_at,

    p.post_title,

    u.email,

    pp.full_name,
    pp.gender,
    pp.photo_profile

FROM post_bookmarks pb

INNER JOIN post p
    ON p.id = pb.post_id

INNER JOIN users u
    ON u.id = pb.user_id

LEFT JOIN public_profile pp
    ON pp.user_id = u.id

ORDER BY pb.created_at DESC
";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {

    $avatar = '';

    if (!empty($row['photo_profile'])) {

        $avatar = '../assets/images/uploads/public_photos/' . $row['photo_profile'];
    } else {

        if ($row['gender'] === 'Perempuan') {
            $avatar = '../assets/images/avatar/avatar_women.png';
        } else {
            $avatar = '../assets/images/avatar/avatar_men.png';
        }
    }

    $bookmarks[] = [
        'id' => $row['id'],
        'full_name' => $row['full_name'] ?: '-',
        'email' => $row['email'],
        'post_title' => $row['post_title'],
        'avatar' => $avatar,
        'created_at' => $row['created_at'],
        'created_at_format' => date(
            'd/m/Y H:i',
            strtotime($row['created_at'])
        ) . ' WIB'
    ];
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>List Bookmark - Dashboard | Hukuminfo.id</title>


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
                                        Daftar Bookmark
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Daftar Bookmark</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- BOOKMARKS -->
                <div class="card mt-4 mb-4 shadow-sm" style="border-radius:14px;">
                    <div class="card-body">

                        <!-- HEADER -->
                        <div class="d-flex align-items-center mb-4">
                            <span class="material-icons mr-2" style="font-size:30px; color:#6774df;">
                                bookmark
                            </span>
                            <h4 class="mb-0">Bookmark</h4>
                        </div>

                        <!-- FILTER -->
                        <div class="row mb-4">

                            <div class="col-md-3">
                                <label>Waktu</label>
                                <select class="form-control" id="filterWaktu">
                                    <option value="baru">Terbaru ke Terlama</option>
                                    <option value="lama">Terlama ke Terbaru</option>
                                </select>
                            </div>

                            <div class="col-md-2 ml-auto">
                                <label>Show Entries</label>
                                <select class="form-control" id="showEntries">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                </select>
                            </div>

                        </div>

                        <!-- TABLE -->
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Avatar / Photo</th>
                                        <th>Email</th>
                                        <th>Postingan</th>
                                        <th>Tanggal Bookmark</th>
                                    </tr>
                                </thead>

                                <tbody id="bookmarks"></tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="d-flex justify-content-between align-items-center mt-3">

                            <div id="paginationInfo">
                                Showing 0 to 0 of 0 entries
                            </div>

                            <ul class="pagination mb-0" id="paginationBookmark"></ul>

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
    <script src="assets/vendor/toastr.min.js"></script>
    <script src="assets/js/toastr.js"></script>


    <script>
        const allBookmarks = <?= json_encode(
                                    $bookmarks,
                                    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                                ); ?>;

        let currentPage = 1;
        let perPage = 10;

        function renderBookmarks() {

            let data = [...allBookmarks];

            const filterWaktu = document.getElementById('filterWaktu').value;

            if (filterWaktu === 'baru') {

                data.sort((a, b) =>
                    new Date(b.created_at) - new Date(a.created_at)
                );

            } else {

                data.sort((a, b) =>
                    new Date(a.created_at) - new Date(b.created_at)
                );
            }

            const totalRows = data.length;
            const totalPages = Math.ceil(totalRows / perPage);

            if (currentPage > totalPages) {
                currentPage = 1;
            }

            const start = (currentPage - 1) * perPage;
            const end = start + perPage;

            const rows = data.slice(start, end);

            let html = '';

            if (rows.length === 0) {

                html = `
        <tr>
            <td colspan="5" class="text-center">
                Tidak ada data bookmark
            </td>
        </tr>
        `;

            } else {

                rows.forEach(item => {

                    html += `
            <tr>

                <td>${item.full_name}</td>

                <td>
                    <img
                        src="${item.avatar}"
                        width="45"
                        height="45"
                        style="border-radius:50%;object-fit:cover;"
                    >
                </td>

                <td>${item.email}</td>

                <td>${item.post_title}</td>

                <td>${item.created_at_format}</td>

            </tr>
            `;
                });
            }

            document.getElementById('bookmarks').innerHTML = html;

            renderPagination(totalPages, totalRows);
        }

        function renderPagination(totalPages, totalRows) {

            const pagination = document.getElementById('paginationBookmark');

            let html = '';

            if (totalPages > 1) {

                html += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link"
               href="#"
               onclick="changePage(${currentPage - 1})">
                Prev
            </a>
        </li>
        `;

                for (let i = 1; i <= totalPages; i++) {

                    html += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link"
                   href="#"
                   onclick="changePage(${i})">
                    ${i}
                </a>
            </li>
            `;
                }

                html += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link"
               href="#"
               onclick="changePage(${currentPage + 1})">
                Next
            </a>
        </li>
        `;
            }

            pagination.innerHTML = html;

            const startEntry =
                totalRows === 0 ?
                0 :
                ((currentPage - 1) * perPage) + 1;

            const endEntry =
                Math.min(currentPage * perPage, totalRows);

            document.getElementById('paginationInfo').innerHTML =
                `Showing ${startEntry} to ${endEntry} of ${totalRows} entries`;
        }

        function changePage(page) {

            event.preventDefault();

            currentPage = page;

            renderBookmarks();
        }

        document
            .getElementById('filterWaktu')
            .addEventListener('change', function() {

                currentPage = 1;

                renderBookmarks();
            });

        document
            .getElementById('showEntries')
            .addEventListener('change', function() {

                perPage = parseInt(this.value);

                currentPage = 1;

                renderBookmarks();
            });

        renderBookmarks();
    </script>
</body>

</html>