<?php
session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . "/../koneksi.php";


/*
|--------------------------------------------------------------------------
| AMBIL KOMENTAR MASUK
|--------------------------------------------------------------------------
*/
$sqlKomentarMasuk = "
SELECT
    pc.id,
    pc.comment,
    pc.status,
    pc.created_at,

    p.post_title,

    u.email,

    pp.full_name,
    pp.photo_profile,

    (
        SELECT COUNT(*)
        FROM post_comment_reply pr
        WHERE pr.comment_id = pc.id
    ) AS total_reply

FROM post_comments pc

INNER JOIN post p
    ON p.id = pc.post_id

INNER JOIN users u
    ON u.id = pc.user_id

LEFT JOIN public_profile pp
    ON pp.user_id = u.id

WHERE pc.status = 'approved'

ORDER BY pc.created_at DESC
";

$resultKomentarMasuk = mysqli_query($conn, $sqlKomentarMasuk);

/*
|--------------------------------------------------------------------------
| AMBIL KOMENTAR DISEMBUNYIKAN
|--------------------------------------------------------------------------
*/
$sqlKomentarHidden = "
SELECT
    pc.id,
    pc.comment,
    pc.status,
    pc.reason_status,
    pc.created_at,

    p.post_title,

    u.email,

    pp.full_name,
    pp.photo_profile,

    (
        SELECT COUNT(*)
        FROM post_comment_reply pr
        WHERE pr.comment_id = pc.id
    ) AS total_reply

FROM post_comments pc

INNER JOIN post p
    ON p.id = pc.post_id

INNER JOIN users u
    ON u.id = pc.user_id

LEFT JOIN public_profile pp
    ON pp.user_id = u.id

WHERE pc.status = 'rejected'

ORDER BY pc.created_at DESC
";

$resultKomentarHidden = mysqli_query($conn, $sqlKomentarHidden);

/*
|--------------------------------------------------------------------------
| AMBIL KOMENTAR REPLY
|--------------------------------------------------------------------------
*/
$sqlKomentarMasuk = "
SELECT
    pc.id,
    pc.comment,
    pc.status,
    pc.created_at,

    p.post_title,

    u.email,

    pp.full_name,
    pp.photo_profile,

    COUNT(pr.id) AS total_reply

FROM post_comments pc

INNER JOIN post p
    ON p.id = pc.post_id

INNER JOIN users u
    ON u.id = pc.user_id

LEFT JOIN public_profile pp
    ON pp.user_id = u.id

LEFT JOIN post_comment_reply pr
    ON pr.comment_id = pc.id

WHERE pc.status='approved'

GROUP BY pc.id

ORDER BY pc.created_at DESC
";

/*
|--------------------------------------------------------------------------
| FILTER TOTAL DATA
|--------------------------------------------------------------------------
*/
$countMasuk = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "
        SELECT COUNT(*) total
        FROM post_comments
        WHERE status='approved'
        "
    )
);

$totalMasuk = $countMasuk['total'];

?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Komentar - Dashboard | Hukuminfo.id</title>


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
                                        Manage Komentar
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Komentar</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- KOMENTAR MASUK -->
                <div class="card mt-4 mb-4 shadow-sm" style="border-radius:14px;">
                    <div class="card-body">

                        <!-- HEADER -->
                        <div class="d-flex align-items-center mb-4">
                            <span class="material-icons mr-2" style="font-size:30px; color:#6774df;">
                                forum
                            </span>
                            <h4 class="mb-0">Komentar Masuk</h4>
                        </div>

                        <!-- FILTER -->
                        <div class="row mb-4">

                            <div class="col-md-3">
                                <label>Waktu</label>
                                <select
                                    class="form-control"
                                    id="filterWaktu">

                                    <option value="baru">
                                        Terbaru ke Terlama
                                    </option>

                                    <option value="lama">
                                        Terlama ke Terbaru
                                    </option>

                                </select>
                            </div>

                            <div class="col-md-2 ml-auto">
                                <label>Show Entries</label>
                                <select
                                    class="form-control"
                                    id="showEntries">

                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>

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
                                        <th>Komentar</th>
                                        <th>Status</th>
                                        <th>Postingan</th>
                                        <th>Tanggal Komentar</th>
                                        <th width="130">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="approvedCommentTable">

                                    <?php while ($row = mysqli_fetch_assoc($resultKomentarMasuk)) : ?>

                                        <tr data-date="<?= strtotime($row['created_at']) ?>">

                                            <td>
                                                <?= htmlspecialchars($row['full_name'] ?? '-') ?>
                                            </td>

                                            <td>
                                                <?php

                                                if (!empty($row['photo_profile'])) {
                                                    $avatar =
                                                        "../assets/images/uploads/public_photos/" .
                                                        $row['photo_profile'];
                                                } else {
                                                    $avatar =
                                                        $row['gender'] == 'Perempuan'

                                                        ? "../assets/images/avatar/avatar_women.png"

                                                        : "../assets/images/avatar/avatar_men.png";
                                                }

                                                ?>
                                                <img
                                                    src="<?= $avatar ?>"
                                                    width="45"
                                                    height="45"
                                                    style="border-radius:50%;object-fit:cover;">
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['email']) ?>
                                            </td>

                                            <td>
                                                <?= nl2br(htmlspecialchars($row['comment'])) ?>

                                                <?php if ($row['total_reply'] > 0): ?>
                                                    <br>
                                                    <small class="text-primary">
                                                        <?= $row['total_reply'] ?> Reply
                                                    </small>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <span class="badge badge-success">
                                                    Approved
                                                </span>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['post_title']) ?>
                                            </td>

                                            <td>
                                                <?= date('d F Y H:i', strtotime($row['created_at'])) ?>
                                            </td>

                                            <td>

                                                <a
                                                    href="comment_hide.php?id=<?= $row['id'] ?>"
                                                    class="btn btn-sm btn-danger">

                                                    Sembunyikan

                                                </a>

                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-info btn-detail"
                                                    data-id="<?= $row['id'] ?>">

                                                    Detail

                                                </button>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="d-flex justify-content-between align-items-center mt-3">

                            <div id="paginationInfo"></div>

                            <ul
                                class="pagination mb-0"
                                id="paginationKomentar">
                            </ul>

                        </div>

                    </div>
                </div>


                <!-- SEMBUNYIKAN KOMENTAR -->
                <div class="card shadow-sm" style="border-radius:14px;">
                    <div class="card-body">

                        <!-- HEADER -->
                        <div class="d-flex align-items-center mb-4">
                            <span class="material-icons mr-2" style="font-size:30px; color:#ff7076;">
                                visibility_off
                            </span>
                            <h4 class="mb-0">Sembunyikan Komentar</h4>
                        </div>

                        <!-- FILTER -->
                        <div class="row mb-4">

                            <div class="col-md-3">
                                <label>Waktu</label>
                                <select
                                    class="form-control"
                                    id="filterWaktu">

                                    <option value="baru">
                                        Terbaru ke Terlama
                                    </option>

                                    <option value="lama">
                                        Terlama ke Terbaru
                                    </option>

                                </select>
                            </div>

                            <div class="col-md-2 ml-auto">
                                <label>Show Entries</label>
                                <select
                                    class="form-control"
                                    id="showEntries">

                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>

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
                                        <th>Komentar</th>
                                        <th>Status</th>
                                        <th>Postingan</th>
                                        <th>Tanggal Komentar</th>
                                        <th width="140">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="hiddenCommentTable">

                                    <?php while ($row = mysqli_fetch_assoc($resultKomentarHidden)) : ?>

                                        <tr data-date="<?= strtotime($row['created_at']) ?>">

                                            <td>
                                                <?= htmlspecialchars($row['full_name'] ?? '-') ?>
                                            </td>

                                            <td>
                                                <?php

                                                if (!empty($row['photo_profile'])) {
                                                    $avatar =
                                                        "../assets/images/uploads/public_photos/" .
                                                        $row['photo_profile'];
                                                } else {
                                                    $avatar =
                                                        $row['gender'] == 'Perempuan'

                                                        ? "../assets/images/avatar/avatar_women.png"

                                                        : "../assets/images/avatar/avatar_men.png";
                                                }

                                                ?>
                                                <img
                                                    src="<?= $avatar ?>"
                                                    width="45"
                                                    height="45"
                                                    style="border-radius:50%;object-fit:cover;">
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['email']) ?>
                                            </td>

                                            <td>

                                                <?= nl2br(htmlspecialchars($row['comment'])) ?>

                                                <?php if (!empty($row['reason_status'])) : ?>

                                                    <hr class="my-1">

                                                    <small class="text-danger">
                                                        Alasan: <?= htmlspecialchars($row['reason_status']) ?>
                                                    </small>

                                                <?php endif; ?>

                                            </td>

                                            <td>
                                                <span class="badge badge-danger">
                                                    Rejected
                                                </span>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['post_title']) ?>
                                            </td>

                                            <td>
                                                <?= date('d F Y H:i', strtotime($row['created_at'])) ?>
                                            </td>

                                            <td>

                                                <a
                                                    href="comment_show.php?id=<?= $row['id'] ?>"
                                                    class="btn btn-sm btn-success">

                                                    Tampilkan

                                                </a>

                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-info btn-detail"
                                                    data-id="<?= $row['id'] ?>">

                                                    Detail

                                                </button>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="d-flex justify-content-between align-items-center mt-3">

                            <div id="paginationInfo"></div>

                            <ul
                                class="pagination mb-0"
                                id="paginationKomentar">
                            </ul>

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
        id="detailKomentarModal"
        tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Detail Komentar
                    </h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        &times;

                    </button>

                </div>

                <div
                    class="modal-body"
                    id="detailKomentarContent">

                    Loading...

                </div>

            </div>

        </div>

    </div>

    <div
        class="modal fade"
        id="detailKomentar<?= $row['id']; ?>"
        tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Detail Komentar
                    </h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        &times;

                    </button>

                </div>

                <div class="modal-body">

                    <h6>Komentar</h6>

                    <div class="border p-3 mb-3">

                        <?= nl2br(htmlspecialchars($row['comment'])) ?>

                    </div>

                    <h6>Reply</h6>

                    <?php

                    $commentId = $row['id'];

                    $replyQuery = mysqli_query(
                        $conn,
                        "
                    SELECT
                        r.*,
                        u.email,
                        pp.full_name,
                        pp.gender,
                        pp.photo_profile

                    FROM post_comment_reply r

                    INNER JOIN users u
                        ON u.id = r.user_id

                    LEFT JOIN public_profile pp
                        ON pp.user_id = u.id

                    WHERE r.comment_id='$commentId'

                    ORDER BY r.created_at ASC
                    "
                    );

                    ?>

                    <?php if (mysqli_num_rows($replyQuery) > 0): ?>

                        <?php while ($reply = mysqli_fetch_assoc($replyQuery)): ?>

                            <div class="border rounded p-3 mb-2">

                                <div class="d-flex">

                                    <img
                                        src="../assets/images/profile/<?= $reply['photo_profile'] ?: 'default.png'; ?>"
                                        width="40"
                                        height="40"
                                        style="border-radius:50%;object-fit:cover;">

                                    <div class="ml-3">

                                        <strong>
                                            <?= htmlspecialchars($reply['full_name']) ?>
                                        </strong>

                                        <br>

                                        <small>
                                            <?= htmlspecialchars($reply['email']) ?>
                                        </small>

                                        <hr>

                                        <?= nl2br(htmlspecialchars($reply['reply'])) ?>

                                    </div>

                                </div>

                            </div>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <div class="alert alert-warning mb-0">

                            Belum ada reply.

                        </div>

                    <?php endif; ?>

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
        const tbody =
            document.getElementById(
                "approvedCommentTable"
            );

        const rows =
            Array.from(
                tbody.querySelectorAll("tr")
            );

        let currentPage = 1;
        let rowsPerPage = 10;

        function renderTable() {
            let data = [...rows];

            const sort =
                document.getElementById(
                    "filterWaktu"
                ).value;

            data.sort((a, b) => {

                let dateA =
                    parseInt(
                        a.dataset.date
                    );

                let dateB =
                    parseInt(
                        b.dataset.date
                    );

                return sort === 'baru' ?
                    dateB - dateA :
                    dateA - dateB;
            });

            rows.forEach(
                row => row.style.display = 'none'
            );

            const total =
                data.length;

            const start =
                (currentPage - 1) *
                rowsPerPage;

            const end =
                start + rowsPerPage;

            data
                .slice(start, end)
                .forEach(
                    row => row.style.display = ''
                );

            document
                .getElementById(
                    'paginationInfo'
                )
                .innerHTML =
                `Showing ${total===0?0:start+1}
    to ${Math.min(end,total)}
    of ${total} entries`;

            renderPagination(total);
        }
    </script>

    <script>
        function renderPagination(total) {
            const totalPages =
                Math.ceil(
                    total / rowsPerPage
                );

            let html = '';

            if (currentPage > 1) {
                html +=
                    `<li class="page-item">
            <a class="page-link"
               href="#"
               onclick="goPage(${currentPage-1})">
               Prev
            </a>
        </li>`;
            }

            for (let i = 1; i <= totalPages; i++) {
                if (
                    i === 1 ||
                    i === totalPages ||
                    (i >= currentPage - 2 &&
                        i <= currentPage + 2)
                ) {
                    html +=
                        `<li class="page-item
            ${i===currentPage?'active':''}">
                <a
                class="page-link"
                href="#"
                onclick="goPage(${i})">
                ${i}
                </a>
            </li>`;
                }
            }

            if (currentPage < totalPages) {
                html +=
                    `<li class="page-item">
            <a class="page-link"
               href="#"
               onclick="goPage(${currentPage+1})">
               Next
            </a>
        </li>`;
            }

            document
                .getElementById(
                    'paginationKomentar'
                )
                .innerHTML = html;
        }
    </script>

    <script>
        function goPage(page) {
            currentPage = page;
            renderTable();
        }

        document
            .getElementById(
                'filterWaktu'
            )
            .addEventListener(
                'change',
                () => {
                    currentPage = 1;
                    renderTable();
                }
            );

        document
            .getElementById(
                'showEntries'
            )
            .addEventListener(
                'change',
                function() {

                    rowsPerPage =
                        parseInt(
                            this.value
                        );

                    currentPage = 1;

                    renderTable();
                }
            );

        renderTable();
    </script>

    <script>
        $(document).on(
            'click',
            '.btn-detail',
            function() {

                let id =
                    $(this).data('id');

                $('#detailKomentarModal')
                    .modal('show');

                $('#detailKomentarContent')
                    .html('Loading...');

                $('#detailKomentarContent')
                    .load(
                        'logic/get_comment_detail.php?id=' +
                        id
                    );

            }
        );
    </script>

</body>

</html>