<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Lowongan Kerja - Dashboard | Konig Guard Bureau</title>

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
                                        Manage Lowongan Kerja
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Lowongan Kerja</h1>
                        </div>
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
                                    work
                                </span>
                            </div>

                            <div>
                                <h3 class="mb-1">Daftar Lowongan Kerja</h3>
                                <small class="text-muted">
                                    Kelola semua informasi lowongan kerja yang telah diposting.
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
                                    <span class="material-icons" style="color:var(--primary);font-size:30px;">
                                        work
                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0">12</h3>
                                    <small class="text-muted">Total Lowongan</small>
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
                                    <span class="material-icons" style="color:var(--success);font-size:30px;">
                                        alarm_on
                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0">8</h3>
                                    <small class="text-muted">Lowongan Aktif</small>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stats-card" style="border-radius:12px;">
                            <div class="card-body d-flex align-items-center">

                                <div style="width:60px;height:60px;border-radius:12px;
                    background:#fff6e8;display:flex;align-items:center;
                    justify-content:center;margin-right:15px;">
                                    <span class="material-icons" style="color:#f5b666;font-size:30px;">
                                        alarm
                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0">3</h3>
                                    <small class="text-muted">Akan Berakhir</small>
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
                                    <span class="material-icons" style="color:#6c757d;font-size:30px;">
                                        check_circle
                                    </span>
                                </div>

                                <div>
                                    <h3 class="mb-0">4</h3>
                                    <small class="text-muted">Selesai</small>
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
                                        <option>10</option>
                                        <option>25</option>
                                        <option>50</option>
                                        <option>100</option>
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
                                        placeholder="Cari lowongan kerja..."
                                        style="padding-left:40px;width:260px;">
                                </div>

                            </div>

                            <!-- RIGHT FILTER -->
                            <div class="d-flex align-items-center flex-wrap"
                                style="gap:15px;">

                                <!-- TYPE -->
                                <select id="typeFilter" class="form-control"
                                    style="width:190px;">
                                    <option>--Type Pekerjaan--</option>
                                    <option>Semua Tipe</option>
                                    <option>Full Time</option>
                                    <option>Part Time</option>
                                    <option>Freelance</option>
                                    <option>Magang</option>
                                </select>

                                <!-- LOKASI -->
                                <select id="locationFilter" class="form-control"
                                    style="width:190px;">
                                    <option>--Lokasi Penempatan--</option>
                                    <option>Semua Lokasi</option>
                                    <option>Jakarta</option>
                                    <option>Bandung</option>
                                    <option>Bekasi</option>
                                </select>

                                <!-- STATUS -->
                                <select id="statusFilter" class="form-control"
                                    style="width:170px;">
                                    <option>--Status--</option>
                                    <option>Semua Status</option>
                                    <option>Aktif</option>
                                    <option>Selesai</option>
                                    <option>Akan Berakhir</option>
                                </select>

                            </div>

                        </div>

                        <!-- TABLE CONTAIN -->
                        <div class="table-responsive">

                            <table class="table table-hover">

                                <thead style="background:#f8f9fc;">
                                    <tr>
                                        <th>Judul Lowongan</th>
                                        <th>Tipe</th>
                                        <th>Tanggal Post</th>
                                        <th>Kuota Pelamar</th>
                                        <th>Tutup Loker</th>
                                        <th>Status</th>
                                        <th style="text-align:center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="jobTable">

                                    <tr class="job-row">
                                        <td>
                                            <strong>Frontend Developer</strong><br>
                                            <small class="text-muted">Bekasi</small>
                                        </td>

                                        <td>Full Time</td>
                                        <td>20 Mei 2025</td>
                                        <td>5</td>
                                        <td>20 Juni 2025</td>

                                        <td>
                                            <span class="badge badge-success"
                                                style="padding:8px 14px;border-radius:8px;">
                                                Aktif
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center">

                                                <button class="btn btn-outline-primary btn-sm mr-2"
                                                    onclick="showDetailLowongan(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        visibility
                                                    </span>
                                                    Lihat Lowongan
                                                </button>

                                                <button class="btn btn-outline-primary btn-sm mr-2"
                                                    onclick="toggleStatus(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        check
                                                    </span>
                                                    Selesai
                                                </button>

                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteRow(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        delete
                                                    </span>
                                                    Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="job-row">
                                        <td>
                                            <strong>UI/UX Designer</strong><br>
                                            <small class="text-muted">Jakarta</small>
                                        </td>

                                        <td>Part Time</td>
                                        <td>18 Mei 2025</td>
                                        <td>3</td>
                                        <td>18 Juni 2025</td>

                                        <td>
                                            <span class="badge badge-warning"
                                                style="padding:8px 14px;border-radius:8px;">
                                                Akan Berakhir
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center">

                                                <button class="btn btn-outline-primary btn-sm mr-2"
                                                    onclick="showDetailLowongan(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        visibility
                                                    </span>
                                                    Lihat Lowongan
                                                </button>

                                                <button class="btn btn-outline-primary btn-sm mr-2"
                                                    onclick="toggleStatus(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        check
                                                    </span>
                                                    Selesai
                                                </button>

                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteRow(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        delete
                                                    </span>
                                                    Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="job-row">
                                        <td>
                                            <strong>Backend Developer</strong><br>
                                            <small class="text-muted">Bandung</small>
                                        </td>

                                        <td>Kontrak</td>
                                        <td>15 Mei 2025</td>
                                        <td>2</td>
                                        <td>30 Mei 2025</td>

                                        <td>
                                            <span class="badge badge-secondary"
                                                style="padding:8px 14px;border-radius:8px;">
                                                Selesai
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center">

                                                <button class="btn btn-outline-primary btn-sm mr-2"
                                                    onclick="showDetailLowongan(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        visibility
                                                    </span>
                                                    Lihat Lowongan
                                                </button>

                                                <button class="btn btn-outline-primary btn-sm mr-2"
                                                    onclick="toggleStatus(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        check
                                                    </span>
                                                    Selesai
                                                </button>

                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteRow(this)">
                                                    <span class="material-icons"
                                                        style="font-size:16px;vertical-align:middle;">
                                                        delete
                                                    </span>
                                                    Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

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

    <!-- DETAIL LOWONGAN -->
    <div id="detailLowongan"
        class="card mt-4"
        style="border-radius:12px; display:none; overflow:hidden;">

        <div class="card-header d-flex justify-content-between align-items-center"
            style="background:#f8f9fc;">

            <div class="d-flex align-items-center">
                <span class="material-icons mr-2"
                    style="color:var(--primary);">
                    visibility
                </span>

                <h5 class="mb-0">
                    Detail Lowongan Kerja
                </h5>
            </div>

            <button class="btn btn-light btn-sm"
                onclick="closeDetailLowongan()">

                <span class="material-icons"
                    style="font-size:18px;vertical-align:middle;">
                    close
                </span>

            </button>

        </div>

        <div class="card-body">

            <form>

                <!-- JUDUL -->
                <div class="form-group">
                    <label>Judul Lowongan Kerja</label>
                    <input
                        id="detailTitle"
                        type="text"
                        class="form-control"
                        readonly>
                </div>

                <!-- LOKASI -->
                <div class="form-group">
                    <label>Lokasi</label>
                    <input
                        id="detailLocation"
                        type="text"
                        class="form-control"
                        readonly>
                </div>

                <!-- JENIS -->
                <div class="form-group">
                    <label>Jenis Lowongan</label>
                    <input
                        id="detailType"
                        type="text"
                        class="form-control"
                        readonly>
                </div>

                <!-- DESKRIPSI -->
                <div class="form-group">

                    <label>Deskripsi Lowongan</label>

                    <textarea
                        id="detailDescription"
                        class="form-control"
                        rows="5"
                        readonly></textarea>

                </div>

                <!-- KUOTA -->
                <div class="form-group">
                    <label>Kuota Pelamar</label>

                    <input
                        id="detailQuota"
                        type="number"
                        class="form-control"
                        readonly>
                </div>

                <!-- TANGGAL -->
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">

                            <label>Tanggal Post</label>

                            <input
                                id="detailPost"
                                type="date"
                                class="form-control"
                                readonly>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">

                            <label>Tanggal Tutup</label>

                            <input
                                id="detailClose"
                                type="date"
                                class="form-control"
                                readonly>

                        </div>
                    </div>

                </div>

                <!-- LINK -->
                <div class="form-group">

                    <label>Link Loker</label>

                    <input
                        id="detailLink"
                        type="text"
                        class="form-control"
                        readonly>

                </div>
                <!-- BUTTON ACTION -->
                <div class="d-flex justify-content-end mt-4">

                    <!-- BATAL -->
                    <button
                        type="button"
                        id="btnCancelDetail"
                        class="btn btn-light mr-2"
                        style="display:none;"
                        onclick="cancelEditDetail()">

                        <span class="material-icons"
                            style="font-size:18px;vertical-align:middle;">
                            close
                        </span>

                        Batal

                    </button>

                    <!-- EDIT / SIMPAN -->
                    <button
                        type="button"
                        id="btnEditDetail"
                        class="btn btn-primary"
                        onclick="toggleEditDetail()">

                        <span class="material-icons"
                            id="btnEditIcon"
                            style="font-size:18px;vertical-align:middle;">
                            edit
                        </span>

                        <span id="btnEditText">
                            Edit
                        </span>

                    </button>

                </div>
            </form>

        </div>

    </div>

    <footer class="dashboard-footer mt-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- LEFT -->
                <div class="col-md-6 text-md-left text-center mb-2 mb-md-0">
                    <span class="footer-text">
                        © 2026 Konig Guard Bureau. All rights reserved.
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

    <script>
        function filterTable() {

            const search =
                document.getElementById("searchInput")
                .value.toLowerCase();

            const type =
                document.getElementById("typeFilter")
                .value.toLowerCase();

            const location =
                document.getElementById("locationFilter")
                .value.toLowerCase();

            const status =
                document.getElementById("statusFilter")
                .value.toLowerCase();

            const show =
                parseInt(
                    document.getElementById("showEntries").value
                );

            const rows =
                document.querySelectorAll(".job-row");

            let visibleCount = 0;

            rows.forEach((row) => {

                const title =
                    row.querySelector("strong")
                    .innerText
                    .toLowerCase();

                const lokasi =
                    row.querySelector("small")
                    .innerText
                    .toLowerCase();

                const tipe =
                    row.children[1]
                    .innerText
                    .toLowerCase();

                const statusText =
                    row.children[5]
                    .innerText
                    .trim()
                    .toLowerCase();

                /* SEARCH */
                const matchSearch =
                    title.includes(search);

                /* TYPE */
                const matchType =
                    type === "" ||
                    type.includes("--type") ||
                    type.includes("semua") ||
                    tipe.includes(type);

                /* LOCATION */
                const matchLocation =
                    location === "" ||
                    location.includes("--lokasi") ||
                    location.includes("semua") ||
                    lokasi.includes(location);

                /* STATUS */
                const matchStatus =
                    status === "" ||
                    status.includes("--status") ||
                    status.includes("semua") ||
                    statusText.includes(status);

                /* FINAL FILTER */
                if (
                    matchSearch &&
                    matchType &&
                    matchLocation &&
                    matchStatus
                ) {

                    if (visibleCount < show) {

                        row.style.display = "";
                        visibleCount++;

                    } else {

                        row.style.display = "none";

                    }

                } else {

                    row.style.display = "none";

                }

            });

        }

        /* EVENTS */
        document
            .getElementById("searchInput")
            .addEventListener("keyup", filterTable);

        document
            .getElementById("typeFilter")
            .addEventListener("change", filterTable);

        document
            .getElementById("locationFilter")
            .addEventListener("change", filterTable);

        document
            .getElementById("statusFilter")
            .addEventListener("change", filterTable);

        document
            .getElementById("showEntries")
            .addEventListener("change", filterTable);

        /* INIT */
        window.onload = filterTable;
    </script>

    <script>
        let currentPage = 1;
        let perPage = 10;

        const searchInput =
            document.getElementById("searchInput");

        const typeFilter =
            document.getElementById("typeFilter");

        const locationFilter =
            document.getElementById("locationFilter");

        const statusFilter =
            document.getElementById("statusFilter");

        const showEntries =
            document.getElementById("showEntries");

        function getFilteredRows() {

            const search =
                searchInput.value.toLowerCase();

            const type =
                typeFilter.value.toLowerCase();

            const location =
                locationFilter.value.toLowerCase();

            const status =
                statusFilter.value.toLowerCase();

            const rows =
                document.querySelectorAll(".job-row");

            return Array.from(rows).filter((row) => {

                const title =
                    row.querySelector("strong")
                    .innerText
                    .toLowerCase();

                const lokasi =
                    row.querySelector("small")
                    .innerText
                    .toLowerCase();

                const tipe =
                    row.children[1]
                    .innerText
                    .toLowerCase();

                const statusText =
                    row.children[5]
                    .innerText
                    .trim()
                    .toLowerCase();

                const matchSearch =
                    title.includes(search);

                const matchType =
                    type === "" ||
                    type.includes("--type") ||
                    type.includes("semua") ||
                    tipe.includes(type);

                const matchLocation =
                    location === "" ||
                    location.includes("--lokasi") ||
                    location.includes("semua") ||
                    lokasi.includes(location);

                const matchStatus =
                    status === "" ||
                    status.includes("--status") ||
                    status.includes("semua") ||
                    statusText.includes(status);

                return (
                    matchSearch &&
                    matchType &&
                    matchLocation &&
                    matchStatus
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

            /* FIX PAGE OVERFLOW */
            if (currentPage > totalPages) {
                currentPage = totalPages || 1;
            }

            /* HIDE ALL */
            document
                .querySelectorAll(".job-row")
                .forEach((row) => {

                    row.style.display = "none";

                });

            /* SHOW CURRENT PAGE */
            const start =
                (currentPage - 1) * perPage;

            const end =
                start + perPage;

            rows.slice(start, end)
                .forEach((row) => {

                    row.style.display = "";

                });

            renderPagination(totalPages, totalData);

        }

        function renderPagination(totalPages, totalData) {

            const pagination =
                document.getElementById("pagination");

            pagination.innerHTML = "";

            /* PREV */
            const prevBtn =
                document.createElement("button");

            prevBtn.className =
                "page-btn icon-btn";

            prevBtn.disabled =
                currentPage === 1;

            prevBtn.innerHTML =
                '<span class="material-icons" style="font-size:18px;">chevron_left</span>';

            prevBtn.onclick = () => {

                if (currentPage > 1) {

                    currentPage--;
                    renderTable();

                }

            };

            pagination.appendChild(prevBtn);

            /* PAGE BUTTON */
            for (let i = 1; i <= totalPages; i++) {

                if (
                    i === 1 ||
                    i === totalPages ||
                    (i >= currentPage - 1 &&
                        i <= currentPage + 1)
                ) {

                    const btn =
                        document.createElement("button");

                    btn.className =
                        "page-btn";

                    if (i === currentPage) {
                        btn.classList.add("active");
                    }

                    btn.innerText = i;

                    btn.onclick = () => {

                        currentPage = i;
                        renderTable();

                    };

                    pagination.appendChild(btn);

                }

                /* DOTS */
                else if (
                    i === currentPage - 2 ||
                    i === currentPage + 2
                ) {

                    const dots =
                        document.createElement("span");

                    dots.className =
                        "page-dots";

                    dots.innerText = "...";

                    pagination.appendChild(dots);

                }

            }

            /* NEXT */
            const nextBtn =
                document.createElement("button");

            nextBtn.className =
                "page-btn icon-btn";

            nextBtn.disabled =
                currentPage === totalPages ||
                totalPages === 0;

            nextBtn.innerHTML =
                '<span class="material-icons" style="font-size:18px;">chevron_right</span>';

            nextBtn.onclick = () => {

                if (currentPage < totalPages) {

                    currentPage++;
                    renderTable();

                }

            };

            pagination.appendChild(nextBtn);

            /* INFO */
            const startData =
                totalData === 0 ?
                0 :
                ((currentPage - 1) * perPage) + 1;

            let endData =
                currentPage * perPage;

            if (endData > totalData) {
                endData = totalData;
            }

            document.getElementById("paginationInfo")
                .innerText =
                `Menampilkan ${startData} - ${endData} dari ${totalData} data`;

        }

        /* EVENTS */
        searchInput.addEventListener(
            "keyup",
            () => {

                currentPage = 1;
                renderTable();

            }
        );

        typeFilter.addEventListener(
            "change",
            () => {

                currentPage = 1;
                renderTable();

            }
        );

        locationFilter.addEventListener(
            "change",
            () => {

                currentPage = 1;
                renderTable();

            }
        );

        statusFilter.addEventListener(
            "change",
            () => {

                currentPage = 1;
                renderTable();

            }
        );

        showEntries.addEventListener(
            "change",
            () => {

                currentPage = 1;
                renderTable();

            }
        );

        /* DELETE */
        function deleteRow(button) {

            const row =
                button.closest("tr");

            const title =
                row.querySelector("strong")
                .innerText;

            if (
                !confirm(
                    `Yakin ingin menghapus lowongan "${title}" ?`
                )
            ) {
                return;
            }

            row.style.transition =
                "all .3s ease";

            row.style.opacity = "0";

            row.style.transform =
                "translateX(40px)";

            setTimeout(() => {

                row.remove();

                renderTable();

            }, 300);

        }

        /* INIT */
        renderTable();
    </script>

    <script>
        /* TOGGLE STATUS */
        function toggleStatus(button) {

            const row =
                button.closest("tr");

            const badge =
                row.children[5]
                .querySelector(".badge");

            const currentStatus =
                badge.innerText.trim();

            /* VALIDASI */
            if (
                !confirm(
                    "Yakin ingin mengubah status lowongan ini?"
                )
            ) {
                return;
            }

            /* AKTIF -> SELESAI */
            if (
                currentStatus === "Aktif" ||
                currentStatus === "Akan Berakhir"
            ) {

                badge.classList.remove(
                    "badge-success",
                    "badge-warning"
                );

                badge.classList.add(
                    "badge-secondary"
                );

                badge.innerText = "Selesai";

                button.innerHTML = `
            <span class="material-icons"
                style="font-size:16px;vertical-align:middle;">
                refresh
            </span>
            Aktifkan
        `;

            }

            /* SELESAI -> AKTIF */
            else {

                badge.classList.remove(
                    "badge-secondary"
                );

                badge.classList.add(
                    "badge-success"
                );

                badge.innerText = "Aktif";

                button.innerHTML = `
            <span class="material-icons"
                style="font-size:16px;vertical-align:middle;">
                check
            </span>
            Selesai
        `;

            }

        }

        /* DELETE */
        function deleteRow(button) {

            const row =
                button.closest("tr");

            const title =
                row.querySelector("strong")
                .innerText;

            /* VALIDASI */
            const confirmDelete =
                confirm(
                    `Yakin ingin menghapus lowongan "${title}" ?`
                );

            if (!confirmDelete) {
                return;
            }

            /* DELETE ANIMATION */
            row.style.transition =
                "all .3s ease";

            row.style.opacity = "0";

            row.style.transform =
                "translateX(40px)";

            setTimeout(() => {

                row.remove();

                /* UPDATE PAGINATION */
                renderPagination();

            }, 300);

        }
    </script>

    <script>
        function showDetailLowongan(button) {

            const row =
                button.closest("tr");

            /* DATA */
            const title =
                row.querySelector("strong")
                .innerText;

            const location =
                row.querySelector("small")
                .innerText;

            const type =
                row.children[1].innerText;

            const postDate =
                row.children[2].innerText;

            const quota =
                row.children[3].innerText;

            const closeDate =
                row.children[4].innerText;

            const status =
                row.children[5].innerText.trim();

            /* SET VALUE */
            document.getElementById("detailTitle")
                .value = title;

            document.getElementById("detailLocation")
                .value = location;

            document.getElementById("detailType")
                .value = type;

            document.getElementById("detailDescription")
                .value =
                "Deskripsi lowongan kerja untuk posisi " +
                title +
                ". Silakan membaca seluruh persyaratan dan ketentuan yang berlaku.";

            document.getElementById("detailQuota")
                .value = quota;

            document.getElementById("detailPost")
                .value = postDate;

            document.getElementById("detailClose")
                .value = closeDate;

            document.getElementById("detailLink")
                .value =
                "https://example.com/lowongan/" +
                title.toLowerCase().replace(/\s/g, "-");

            /* SHOW DROPDOWN */
            const detail =
                document.getElementById("detailLowongan");

            detail.style.display = "block";

            /* ANIMATION */
            detail.style.opacity = "0";
            detail.style.transform = "translateY(-20px)";

            setTimeout(() => {

                detail.style.transition =
                    "all .3s ease";

                detail.style.opacity = "1";
                detail.style.transform =
                    "translateY(0px)";

            }, 10);

            /* SCROLL */
            detail.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });

        }

        /* CLOSE */
        function closeDetailLowongan() {

            const detail =
                document.getElementById("detailLowongan");

            detail.style.opacity = "0";
            detail.style.transform =
                "translateY(-20px)";

            setTimeout(() => {

                detail.style.display = "none";

            }, 300);

        }
    </script>

    <script>
        let editMode = false;

        /* TOGGLE EDIT */
        function toggleEditDetail() {

            const inputs =
                document.querySelectorAll(
                    "#detailLowongan input, #detailLowongan textarea"
                );

            const btnText =
                document.getElementById("btnEditText");

            const btnIcon =
                document.getElementById("btnEditIcon");

            const btnCancel =
                document.getElementById("btnCancelDetail");

            /* EDIT MODE */
            if (!editMode) {

                inputs.forEach((input) => {

                    input.removeAttribute("readonly");

                });

                btnText.innerText = "Simpan";

                btnIcon.innerText = "save";

                btnCancel.style.display =
                    "inline-block";

                editMode = true;

            }

            /* SAVE MODE */
            else {

                if (
                    !confirm(
                        "Yakin ingin menyimpan perubahan?"
                    )
                ) {
                    return;
                }

                inputs.forEach((input) => {

                    input.setAttribute(
                        "readonly",
                        true
                    );

                });

                btnText.innerText = "Edit";

                btnIcon.innerText = "edit";

                btnCancel.style.display =
                    "none";

                editMode = false;

                alert(
                    "Perubahan berhasil disimpan"
                );

            }

        }

        /* CANCEL EDIT */
        function cancelEditDetail() {

            if (
                !confirm(
                    "Batalkan perubahan?"
                )
            ) {
                return;
            }

            const inputs =
                document.querySelectorAll(
                    "#detailLowongan input, #detailLowongan textarea"
                );

            inputs.forEach((input) => {

                input.setAttribute(
                    "readonly",
                    true
                );

            });

            document.getElementById(
                "btnEditText"
            ).innerText = "Edit";

            document.getElementById(
                "btnEditIcon"
            ).innerText = "edit";

            document.getElementById(
                "btnCancelDetail"
            ).style.display = "none";

            editMode = false;

        }
    </script>
</body>

</html>