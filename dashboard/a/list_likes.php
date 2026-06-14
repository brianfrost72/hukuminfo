<?php
session_start();
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . "/../koneksi.php";


/*
|--------------------------------------------------------------------------
| Ambil Data Like
|--------------------------------------------------------------------------
*/

$sql = "
SELECT
    pl.id,
    pl.created_at,

    p.post_title,
    p.slug,

    u.email,

    pp.full_name,
    pp.gender,
    pp.photo_profile

FROM post_likes pl

LEFT JOIN post p
    ON p.id = pl.post_id

LEFT JOIN users u
    ON u.id = pl.user_id

LEFT JOIN public_profile pp
    ON pp.user_id = u.id

ORDER BY pl.created_at DESC
";

$query = mysqli_query($conn, $sql);

$listLikes = [];

while ($row = mysqli_fetch_assoc($query)) {

    $avatar = '';

    if (
        !empty($row['photo_profile']) &&
        file_exists(
            __DIR__ . '/../assets/images/uploads/public_photos/' . $row['photo_profile']
        )
    ) {

        $avatar = '../assets/images/uploads/public_photos/' . $row['photo_profile'];
    } else {

        if (strtolower($row['gender']) == 'perempuan') {

            $avatar = '../assets/images/avatar/avatar-women.png';
        } else {

            $avatar = '../assets/images/avatar/avatar-men.png';
        }
    }

    $listLikes[] = [
        'nama'       => $row['full_name'] ?: '-',
        'avatar'     => $avatar,
        'email'      => $row['email'],
        'postingan'  => $row['post_title'],
        'slug'       => $row['slug'],
        'tanggal'    => date('d M Y H:i', strtotime($row['created_at'])),
        'timestamp'  => strtotime($row['created_at'])
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
    <title>Daftar Like - Dashboard | Hukuminfo.id</title>

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
                                        Daftar Like
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Daftar Like</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- LIKES -->
                <div class="card mt-4 mb-4 shadow-sm" style="border-radius:14px;">
                    <div class="card-body">

                        <!-- HEADER -->
                        <div class="d-flex align-items-center mb-4">
                            <span class="material-icons mr-2" style="font-size:30px; color:#6774df;">
                                favorite
                            </span>
                            <h4 class="mb-0">Like</h4>
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
                                    <option value="5" selected>5</option>
                                    <option value="10">10</option>
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
                                        <th>Tanggal Like</th>
                                        <th width="130">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="bookmarkBody"></tbody>
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
        const likesData = <?= json_encode($listLikes, JSON_UNESCAPED_UNICODE); ?>;

        let currentPage = 1;
        let rowsPerPage = 5;

        function renderTable() {

            let data = [...likesData];

            const waktu = $('#filterWaktu').val();

            data.sort((a, b) => {

                if (waktu === 'lama') {
                    return a.timestamp - b.timestamp;
                }

                return b.timestamp - a.timestamp;
            });

            const totalRows = data.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage);

            if (currentPage > totalPages) {
                currentPage = 1;
            }

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            const rows = data.slice(start, end);

            let html = '';

            if (rows.length === 0) {

                html = `
        <tr>
           <td colspan="6" class="text-center">
                Tidak ada data
            </td>
        </tr>
        `;

            } else {

                rows.forEach(item => {

                    html += `
            <tr>

                <td>${item.nama}</td>

                <td class="text-center">
                    <img
                        src="${item.avatar}"
                        width="55"
                        height="55"
                        style="
                            object-fit:cover;
                            border-radius:50%;
                        ">
                </td>

                <td>${item.email}</td>

                <td>${item.postingan}</td>

                <td>${item.tanggal}</td>

                <td class="text-center">

    <a
        href="https://hukuminfo.id/${item.slug}"
        target="_blank"
        class="btn btn-sm btn-info"
        title="Lihat Artikel">

        <i class="fa fa-eye"></i>

    </a>

</td>
            </tr>
            `;
                });

            }

            $('#bookmarkBody').html(html);

            const showingFrom = totalRows === 0 ? 0 : start + 1;
            const showingTo = Math.min(end, totalRows);

            $('#paginationInfo').html(
                `Showing ${showingFrom} to ${showingTo} of ${totalRows} entries`
            );

            renderPagination(totalPages);
        }

        function renderPagination(totalPages) {

            let html = '';

            html += `
    <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" data-page="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
    </li>
    `;

            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, currentPage + 2);

            if (startPage > 1) {

                html += `
        <li class="page-item">
            <a class="page-link" href="#" data-page="1">1</a>
        </li>
        `;

                if (startPage > 2) {

                    html += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            `;
                }
            }

            for (let i = startPage; i <= endPage; i++) {

                html += `
        <li class="page-item ${currentPage === i ? 'active' : ''}">
            <a class="page-link" href="#" data-page="${i}">
                ${i}
            </a>
        </li>
        `;
            }

            if (endPage < totalPages) {

                if (endPage < totalPages - 1) {

                    html += `
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            `;
                }

                html += `
        <li class="page-item">
            <a class="page-link" href="#" data-page="${totalPages}">
                ${totalPages}
            </a>
        </li>
        `;
            }

            html += `
    <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
        <a class="page-link" href="#" data-page="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </li>
    `;

            $('#paginationBookmark').html(html);
        }

        $(document).on('click', '#paginationBookmark a', function(e) {

            e.preventDefault();

            const page = $(this).data('page');

            const totalPages = Math.ceil(
                likesData.length / rowsPerPage
            );

            if (page === 'prev') {

                if (currentPage > 1) {
                    currentPage--;
                }

            } else if (page === 'next') {

                if (currentPage < totalPages) {
                    currentPage++;
                }

            } else {

                currentPage = parseInt(page);
            }

            renderTable();
        });

        $('#showEntries').on('change', function() {

            rowsPerPage = parseInt($(this).val());
            currentPage = 1;

            renderTable();
        });

        $('#filterWaktu').on('change', function() {

            currentPage = 1;
            renderTable();
        });

        $(document).ready(function() {

            renderTable();

        });
    </script>
</body>

</html>