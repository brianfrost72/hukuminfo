<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Komentar - Dashboard | Konig Guard Bureau</title>


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
                                <label>Filter Postingan</label>
                                <select class="form-control" id="filterPostingan">
                                    <option value="Semua">Semua Postingan</option>
                                    <option value="Tips Produktivitas">Tips Produktivitas</option>
                                    <option value="Belajar Efektif">Belajar Efektif</option>
                                    <option value="Manajemen Waktu">Manajemen Waktu</option>
                                </select>
                            </div>

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
                                        <th>Komentar</th>
                                        <th>Status</th>
                                        <th>Postingan</th>
                                        <th>Tanggal Komentar</th>
                                        <th width="130">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="komentarMasukBody"></tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="d-flex justify-content-between align-items-center mt-3">

                            <div id="paginationInfo">
                                Showing 0 to 0 of 0 entries
                            </div>

                            <ul class="pagination mb-0" id="paginationKomentar"></ul>

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
                                <label>Filter Postingan</label>
                                <select class="form-control" id="hiddenFilterPostingan">
                                    <option value="Semua">Semua Postingan</option>
                                    <option value="Tips Produktivitas">Tips Produktivitas</option>
                                    <option value="Belajar Efektif">Belajar Efektif</option>
                                    <option value="Manajemen Waktu">Manajemen Waktu</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Waktu</label>
                                <select class="form-control" id="hiddenFilterWaktu">
                                    <option value="baru">Terbaru ke Terlama</option>
                                    <option value="lama">Terlama ke Terbaru</option>
                                </select>
                            </div>

                            <div class="col-md-2 ml-auto">
                                <label>Show Entries</label>
                                <select class="form-control" id="hiddenShowEntries">
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
                                        <th>Komentar</th>
                                        <th>Status</th>
                                        <th>Postingan</th>
                                        <th>Tanggal Komentar</th>
                                        <th width="140">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="hiddenKomentarBody"></tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="d-flex justify-content-between align-items-center mt-3">

                            <div id="hiddenPaginationInfo">
                                Showing 0 to 0 of 0 entries
                            </div>

                            <ul class="pagination mb-0" id="hiddenPagination"></ul>

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
        // =========================================
        // DATA
        // =========================================

        let komentarMasuk = [{
                id: 1,
                nama: "Budi Santoso",
                avatar: "https://i.pravatar.cc/50?img=1",
                email: "budi@example.com",
                komentar: "Artikelnya sangat membantu.",
                status: "Aktif",
                postingan: "Tips Produktivitas",
                tanggal: "2026-05-24 14:35"
            },
            {
                id: 2,
                nama: "Siti Nurhaliza",
                avatar: "https://i.pravatar.cc/50?img=5",
                email: "siti@example.com",
                komentar: "Kontennya bagus sekali.",
                status: "Aktif",
                postingan: "Belajar Efektif",
                tanggal: "2026-05-23 11:20"
            }
        ];


        let komentarHidden = [];



        // =========================================
        // PAGINATION STATE
        // =========================================

        let currentMasukPage = 1;
        let currentHiddenPage = 1;



        // =========================================
        // ELEMENT MASUK
        // =========================================

        const masukBody = document.getElementById("komentarMasukBody");

        const masukPagination = document.getElementById("paginationKomentar");

        const masukPaginationInfo = document.getElementById("paginationInfo");

        const filterPostingan = document.getElementById("filterPostingan");

        const filterWaktu = document.getElementById("filterWaktu");

        const showEntries = document.getElementById("showEntries");



        // =========================================
        // ELEMENT HIDDEN
        // =========================================

        const hiddenBody = document.getElementById("hiddenKomentarBody");

        const hiddenPagination =
            document.getElementById("hiddenPagination");

        const hiddenPaginationInfo =
            document.getElementById("hiddenPaginationInfo");

        const hiddenFilterPostingan =
            document.getElementById("hiddenFilterPostingan");

        const hiddenFilterWaktu =
            document.getElementById("hiddenFilterWaktu");

        const hiddenShowEntries =
            document.getElementById("hiddenShowEntries");



        // =========================================
        // FORMAT TANGGAL
        // =========================================

        function formatTanggal(dateString) {

            const date = new Date(dateString);

            return date.toLocaleString("id-ID", {
                day: "2-digit",
                month: "long",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit"
            });
        }



        // =========================================
        // RENDER KOMENTAR MASUK
        // =========================================

        function renderKomentarMasuk() {

            let data = [...komentarMasuk];


            // FILTER
            if (filterPostingan.value !== "Semua") {

                data = data.filter(item =>
                    item.postingan === filterPostingan.value
                );
            }


            // SORT
            data.sort((a, b) => {

                const dateA = new Date(a.tanggal);
                const dateB = new Date(b.tanggal);

                return filterWaktu.value === "baru" ?
                    dateB - dateA :
                    dateA - dateB;
            });


            // PAGINATION
            const limit = parseInt(showEntries.value);

            const start = (currentMasukPage - 1) * limit;

            const end = start + limit;

            const paginatedData = data.slice(start, end);


            masukBody.innerHTML = "";


            paginatedData.forEach(item => {

                masukBody.innerHTML += `
                <tr class="${item.new ? 'new-comment-highlight' : ''}">

                    <td>${item.nama}</td>

                    <td>
                        <img src="${item.avatar}"
                             width="45"
                             height="45"
                             style="border-radius:50%; object-fit:cover;">
                    </td>

                    <td>${item.email}</td>

                    <td>${item.komentar}</td>

                    <td>
                        <span class="badge badge-success px-3 py-2">
                            Aktif
                        </span>
                    </td>

                    <td>${item.postingan}</td>

                    <td>${formatTanggal(item.tanggal)}</td>

                    <td>
                        <button
                            class="btn btn-sm btn-primary d-flex align-items-center"
                            onclick="arsipkanKomentar(${item.id})">

                            <span class="material-icons mr-1"
                                  style="font-size:18px;">
                                archive
                            </span>

                            Arsipkan
                        </button>
                    </td>

                </tr>
            `;

                item.new = false;

            });


            renderMasukPagination(data.length, limit);


            masukPaginationInfo.innerHTML =
                `Showing ${data.length === 0 ? 0 : start + 1}
            to ${Math.min(end, data.length)}
            of ${data.length} entries`;
        }



        // =========================================
        // PAGINATION MASUK
        // =========================================

        function renderMasukPagination(totalData, limit) {

            const totalPages = Math.ceil(totalData / limit);

            masukPagination.innerHTML = "";

            // PREV
            masukPagination.innerHTML += `
        <li class="page-item ${currentMasukPage === 1 ? 'disabled' : ''}">
            <a class="page-link"
               href="#"
               onclick="changeMasukPage(${currentMasukPage - 1})">

                &laquo;

            </a>
        </li>
    `;


            const visiblePages = [];

            // PAGE AWAL
            visiblePages.push(1);

            // PAGE TENGAH
            for (
                let i = currentMasukPage - 1; i <= currentMasukPage + 1; i++
            ) {

                if (i > 1 && i < totalPages) {
                    visiblePages.push(i);
                }
            }

            // PAGE AKHIR
            if (totalPages > 1) {
                visiblePages.push(totalPages);
            }


            // HAPUS DUPLIKAT
            const uniquePages = [...new Set(visiblePages)];


            let lastPage = 0;

            uniquePages.forEach(page => {

                // TITIK TITIK
                if (page - lastPage > 1) {

                    masukPagination.innerHTML += `
                <li class="page-item disabled">

                    <span class="page-link">
                        ...
                    </span>

                </li>
            `;
                }

                // PAGE
                masukPagination.innerHTML += `
            <li class="page-item ${currentMasukPage === page ? 'active' : ''}">

                <a class="page-link"
                   href="#"
                   onclick="changeMasukPage(${page})">

                    ${page}

                </a>

            </li>
        `;

                lastPage = page;
            });


            // NEXT
            masukPagination.innerHTML += `
        <li class="page-item ${currentMasukPage === totalPages ? 'disabled' : ''}">

            <a class="page-link"
               href="#"
               onclick="changeMasukPage(${currentMasukPage + 1})">

                &raquo;

            </a>

        </li>
    `;
        }



        function changeMasukPage(page) {

            currentMasukPage = page;

            renderKomentarMasuk();
        }



        // =========================================
        // RENDER KOMENTAR HIDDEN
        // =========================================

        function renderKomentarHidden() {

            let data = [...komentarHidden];


            // FILTER
            if (hiddenFilterPostingan.value !== "Semua") {

                data = data.filter(item =>
                    item.postingan === hiddenFilterPostingan.value
                );
            }


            // SORT
            data.sort((a, b) => {

                const dateA = new Date(a.tanggal);
                const dateB = new Date(b.tanggal);

                return hiddenFilterWaktu.value === "baru" ?
                    dateB - dateA :
                    dateA - dateB;
            });


            // PAGINATION
            const limit = parseInt(hiddenShowEntries.value);

            const start = (currentHiddenPage - 1) * limit;

            const end = start + limit;

            const paginatedData = data.slice(start, end);


            hiddenBody.innerHTML = "";


            paginatedData.forEach(item => {

                hiddenBody.innerHTML += `
                <tr>

                    <td>${item.nama}</td>

                    <td>
                        <img src="${item.avatar}"
                             width="45"
                             height="45"
                             style="border-radius:50%; object-fit:cover;">
                    </td>

                    <td>${item.email}</td>

                    <td>${item.komentar}</td>

                    <td>
                        <span class="badge badge-danger px-3 py-2">
                            Disembunyikan
                        </span>
                    </td>

                    <td>${item.postingan}</td>

                    <td>${formatTanggal(item.tanggal)}</td>

                    <td>

                        <button
                            class="btn btn-sm btn-success d-flex align-items-center"
                            onclick="upKomentar(${item.id})">

                            <span class="material-icons mr-1"
                                  style="font-size:18px;">
                                arrow_upward
                            </span>

                            Up Komentar

                        </button>

                    </td>

                </tr>
            `;
            });


            renderHiddenPagination(data.length, limit);


            hiddenPaginationInfo.innerHTML =
                `Showing ${data.length === 0 ? 0 : start + 1}
            to ${Math.min(end, data.length)}
            of ${data.length} entries`;
        }



        // =========================================
        // PAGINATION HIDDEN
        // =========================================

        function renderHiddenPagination(totalData, limit) {

            const totalPages = Math.ceil(totalData / limit);

            hiddenPagination.innerHTML = "";


            // PREV
            hiddenPagination.innerHTML += `
        <li class="page-item ${currentHiddenPage === 1 ? 'disabled' : ''}">

            <a class="page-link"
               href="#"
               onclick="changeHiddenPage(${currentHiddenPage - 1})">

                &laquo;

            </a>

        </li>
    `;


            const visiblePages = [];

            // PAGE AWAL
            visiblePages.push(1);

            // PAGE TENGAH
            for (
                let i = currentHiddenPage - 1; i <= currentHiddenPage + 1; i++
            ) {

                if (i > 1 && i < totalPages) {
                    visiblePages.push(i);
                }
            }

            // PAGE AKHIR
            if (totalPages > 1) {
                visiblePages.push(totalPages);
            }


            const uniquePages = [...new Set(visiblePages)];

            let lastPage = 0;


            uniquePages.forEach(page => {

                // TITIK TITIK
                if (page - lastPage > 1) {

                    hiddenPagination.innerHTML += `
                <li class="page-item disabled">

                    <span class="page-link">
                        ...
                    </span>

                </li>
            `;
                }


                // PAGE
                hiddenPagination.innerHTML += `
            <li class="page-item ${currentHiddenPage === page ? 'active' : ''}">

                <a class="page-link"
                   href="#"
                   onclick="changeHiddenPage(${page})">

                    ${page}

                </a>

            </li>
        `;

                lastPage = page;
            });


            // NEXT
            hiddenPagination.innerHTML += `
        <li class="page-item ${currentHiddenPage === totalPages ? 'disabled' : ''}">

            <a class="page-link"
               href="#"
               onclick="changeHiddenPage(${currentHiddenPage + 1})">

                &raquo;

            </a>

        </li>
    `;
        }



        function changeHiddenPage(page) {

            currentHiddenPage = page;

            renderKomentarHidden();
        }



        // =========================================
        // ARSIPKAN KOMENTAR
        // =========================================

        function arsipkanKomentar(id) {

            const confirmArsip =
                confirm("Yakin ingin menyembunyikan komentar ini?");

            if (!confirmArsip) return;


            const index =
                komentarMasuk.findIndex(item => item.id === id);

            if (index === -1) return;


            const komentar = komentarMasuk[index];


            komentarHidden.unshift(komentar);


            komentarMasuk.splice(index, 1);


            renderKomentarMasuk();

            renderKomentarHidden();
        }



        // =========================================
        // UP KOMENTAR
        // =========================================

        function upKomentar(id) {

            const confirmUp =
                confirm("Tampilkan kembali komentar ini?");

            if (!confirmUp) return;


            const index =
                komentarHidden.findIndex(item => item.id === id);

            if (index === -1) return;


            const komentar = komentarHidden[index];


            komentar.new = true;


            komentarMasuk.unshift(komentar);


            komentarHidden.splice(index, 1);


            currentMasukPage = 1;


            renderKomentarMasuk();

            renderKomentarHidden();
        }



        // =========================================
        // EVENT FILTER MASUK
        // =========================================

        filterPostingan.addEventListener("change", () => {

            currentMasukPage = 1;

            renderKomentarMasuk();
        });

        filterWaktu.addEventListener("change", () => {

            currentMasukPage = 1;

            renderKomentarMasuk();
        });

        showEntries.addEventListener("change", () => {

            currentMasukPage = 1;

            renderKomentarMasuk();
        });



        // =========================================
        // EVENT FILTER HIDDEN
        // =========================================

        hiddenFilterPostingan.addEventListener("change", () => {

            currentHiddenPage = 1;

            renderKomentarHidden();
        });

        hiddenFilterWaktu.addEventListener("change", () => {

            currentHiddenPage = 1;

            renderKomentarHidden();
        });

        hiddenShowEntries.addEventListener("change", () => {

            currentHiddenPage = 1;

            renderKomentarHidden();
        });



        // =========================================
        // SIMULASI KOMENTAR BARU
        // =========================================

        function simulasiPesanMasuk() {

            const randomId = Math.floor(Math.random() * 70);

            komentarMasuk.unshift({

                id: Date.now(),

                nama: "Komentar Baru",

                avatar: `https://i.pravatar.cc/50?img=${randomId}`,

                email: "baru@example.com",

                komentar: "Ini simulasi komentar baru masuk.",

                status: "Aktif",

                postingan: "Tips Produktivitas",

                tanggal: new Date(),

                new: true
            });


            currentMasukPage = 1;


            renderKomentarMasuk();
        }



        // AUTO SIMULASI
        setInterval(() => {

            simulasiPesanMasuk();

        }, 10000);



        // =========================================
        // INITIAL
        // =========================================

        renderKomentarMasuk();

        renderKomentarHidden();
    </script>

</body>

</html>