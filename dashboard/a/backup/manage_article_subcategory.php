<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Sub-Kategori Artikel - Dashboard | Konig Guard Bureau</title>


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
                                    <tbody id="tableBody"></tbody>
                                </table>
                            </div>

                            <!-- PAGINATION -->
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-danger" id="deleteSelected">Hapus Terpilih</button>
                                <ul class="pagination" id="pagination"></ul>
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
        <app-settings
            layout-active="fluid"
            :layout-location="{
      'default': 'index.html',
      'fixed': 'fixed-dashboard.html',
      'fluid': 'fluid-dashboard.html',
      'mini': 'mini-dashboard.html'
    }"></app-settings>
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

                <div class="modal-body">
                    <label>Pilih Kategori</label>
                    <select id="kategoriTambah" class="form-control mb-3">
                        <option value="">-- Pilih Kategori --</option>
                        <option>Berita</option>
                        <option>Artikel</option>
                    </select>

                    <label>Tambah Sub-Kategori</label>
                    <input type="text" id="subkategoriTambah" class="form-control mb-3" placeholder="Nama Kategori Artikel">

                    <label>Tambah Deskripsi</label>
                    <textarea type="text" id="deskripsiTambah" class="form-control" placeholder="Deskripsi Kategori Artikel"></textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="tambahData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Data</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editIndex">

                    <label>Pilih Kategori</label>
                    <select id="kategoriEdit" class="form-control mb-3">
                        <option>Berita</option>
                        <option>Artikel</option>
                    </select>

                    <label>Edit Kategori</label>
                    <input type="text"
                        id="subkategoriEdit"
                        class="form-control mb-3"
                        placeholder="Nama Kategori Artikel">

                    <label>Edit Deskripsi</label>
                    <textarea
                        id="deskripsiEdit"
                        class="form-control"
                        placeholder="Deskripsi Kategori Artikel"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="updateData()">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- =========================
    MODAL VALIDASI SUKSES
========================= -->

    <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content border-0"
                style="
                border-radius:18px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#ecfdf3;
                    ">

                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#16a34a;
                        ">
                            check_circle
                        </span>

                    </div>

                    <!-- TITLE -->
                    <h4 class="font-weight-bold mb-2" id="successTitle">
                        Berhasil
                    </h4>

                    <!-- TEXT -->
                    <p class="text-muted mb-4" id="successText">
                        Data berhasil disimpan
                    </p>

                    <!-- BUTTON -->
                    <button type="button"
                        class="btn btn-success px-4"
                        data-dismiss="modal"
                        style="
                        border-radius:10px;
                        min-width:120px;
                        height:45px;
                    ">
                        Okay
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
        let data = [{
                nama: "Artikel",
                subkategori: "Keamanan",
                deskripsi: "ini hanya text"
            },
            {
                nama: "Berita",
                subkategori: "Publikasi",
                deskripsi: "ini hanya text"
            }
        ];

        let currentPage = 1;
        let rowsPerPage = 5;

        function renderTable() {
            let tbody = document.getElementById("tableBody");
            tbody.innerHTML = "";

            let search = document.getElementById("searchInput").value.toLowerCase();

            let filtered = data.filter(d =>
                d.nama.toLowerCase().includes(search)
            );

            let start = (currentPage - 1) * rowsPerPage;
            let paginated = filtered.slice(start, start + rowsPerPage);

            paginated.forEach((item, index) => {
                tbody.innerHTML += `
            <tr>
                <td><input type="checkbox" class="rowCheck" data-index="${start + index}"></td>
                <td>${start + index + 1}</td>
                <td>${item.nama}</td>
                <td>${item.subkategori}</td>
                <td>${item.deskripsi}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editData(${start + index})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="hapusData(${start + index})">Hapus</button>
                </td>
            </tr>
        `;
            });

            renderPagination(filtered.length);
        }

        function renderPagination(total) {
            let pageCount = Math.ceil(total / rowsPerPage);
            let pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            if (pageCount <= 1) return;

            // PREV BUTTON
            pagination.innerHTML += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" onclick="changePage(${currentPage - 1})">Prev</a>
        </li>
    `;

            let maxVisible = 5;
            let start = Math.max(1, currentPage - 2);
            let end = Math.min(pageCount, currentPage + 2);

            // FIX kalau di awal
            if (currentPage <= 3) {
                start = 1;
                end = Math.min(pageCount, maxVisible);
            }

            // FIX kalau di akhir
            if (currentPage >= pageCount - 2) {
                start = Math.max(1, pageCount - (maxVisible - 1));
                end = pageCount;
            }

            // FIRST PAGE + DOTS
            if (start > 1) {
                pagination.innerHTML += `
            <li class="page-item"><a class="page-link" onclick="changePage(1)">1</a></li>
        `;
                if (start > 2) {
                    pagination.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
            }

            // PAGE NUMBERS
            for (let i = start; i <= end; i++) {
                pagination.innerHTML += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" onclick="changePage(${i})">${i}</a>
            </li>
        `;
            }

            // LAST PAGE + DOTS
            if (end < pageCount) {
                if (end < pageCount - 1) {
                    pagination.innerHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
                pagination.innerHTML += `
            <li class="page-item"><a class="page-link" onclick="changePage(${pageCount})">${pageCount}</a></li>
        `;
            }

            // NEXT BUTTON
            pagination.innerHTML += `
        <li class="page-item ${currentPage === pageCount ? 'disabled' : ''}">
            <a class="page-link" onclick="changePage(${currentPage + 1})">Next</a>
        </li>
    `;
        }

        function changePage(page) {
            currentPage = page;
            renderTable();
        }

        function tambahData() {

            let kategoriInput = document.getElementById("kategoriTambah");
            let subkategoriInput = document.getElementById("subkategoriTambah");
            let deskripsiInput = document.getElementById("deskripsiTambah");

            let kategori = kategoriInput.value.trim();
            let subkategori = subkategoriInput.value.trim();
            let deskripsi = deskripsiInput.value.trim();

            // VALIDASI
            if (kategori === "") {
                alert("Kategori wajib dipilih!");
                kategoriInput.focus();
                return;
            }

            if (subkategori === "") {
                alert("Sub-kategori wajib diisi!");
                subkategoriInput.focus();
                return;
            }

            if (deskripsi === "") {
                alert("Deskripsi wajib diisi!");
                deskripsiInput.focus();
                return;
            }

            // TAMBAH DATA
            data.push({
                nama: kategori,
                subkategori: subkategori,
                deskripsi: deskripsi
            });

            // RESET
            kategoriInput.value = "";
            subkategoriInput.value = "";
            deskripsiInput.value = "";

            // REFRESH
            renderTable();

            // CLOSE MODAL
            $('#modalTambah').modal('hide');

            // RESET CHECKBOX
            document.getElementById("checkAll").checked = false;

            // MODAL SUCCESS TAMBAH
            document.getElementById("successTitle").innerText = "Tambah Berhasil";

            document.getElementById("successText").innerHTML =
                `<b>${subkategori}</b> berhasil ditambahkan`;

            $('#modalSuccess').modal('show');
        }

        function editData(index) {

            document.getElementById("editIndex").value = index;

            document.getElementById("kategoriEdit").value = data[index].nama;

            document.getElementById("subkategoriEdit").value = data[index].subkategori;

            document.getElementById("deskripsiEdit").value = data[index].deskripsi;

            $('#modalEdit').modal('show');
        }

        function updateData() {

            let index = document.getElementById("editIndex").value;

            let kategoriInput = document.getElementById("kategoriEdit");
            let subkategoriInput = document.getElementById("subkategoriEdit");
            let deskripsiInput = document.getElementById("deskripsiEdit");

            let kategori = kategoriInput.value.trim();
            let subkategori = subkategoriInput.value.trim();
            let deskripsi = deskripsiInput.value.trim();

            // VALIDASI
            if (kategori === "") {
                alert("Kategori wajib dipilih!");
                kategoriInput.focus();
                return;
            }

            if (subkategori === "") {
                alert("Sub-kategori wajib diisi!");
                subkategoriInput.focus();
                return;
            }

            if (deskripsi === "") {
                alert("Deskripsi wajib diisi!");
                deskripsiInput.focus();
                return;
            }

            // UPDATE DATA
            data[index].nama = kategori;
            data[index].subkategori = subkategori;
            data[index].deskripsi = deskripsi;

            // REFRESH
            renderTable();

            // CLOSE MODAL
            $('#modalEdit').modal('hide');

            // RESET CHECKBOX
            document.getElementById("checkAll").checked = false;

            // MODAL SUCCESS EDIT
            document.getElementById("successTitle").innerText = "Edit Berhasil";

            document.getElementById("successText").innerHTML =
                `<b>${subkategori}</b> berhasil di edit`;

            $('#modalSuccess').modal('show');
        }

        $('#modalTambah').on('hidden.bs.modal', function() {

            document.getElementById("kategoriTambah").value = "";
            document.getElementById("subkategoriTambah").value = "";
            document.getElementById("deskripsiTambah").value = "";
        });

        $('#modalEdit').on('hidden.bs.modal', function() {

            document.getElementById("kategoriEdit").value = "";
            document.getElementById("subkategoriEdit").value = "";
            document.getElementById("deskripsiEdit").value = "";
        });

        function hapusData(index) {
            if (confirm("Yakin hapus data ini?")) {
                data.splice(index, 1);
                renderTable();
            }
        }

        document.getElementById("deleteSelected").onclick = function() {
            let checks = document.querySelectorAll(".rowCheck:checked");

            if (checks.length === 0) {
                alert("Pilih data dulu!");
                return;
            }

            if (confirm("Hapus data terpilih?")) {
                let indexes = [...checks].map(c => c.dataset.index).sort((a, b) => b - a);
                indexes.forEach(i => data.splice(i, 1));
                renderTable();
            }
        };

        document.getElementById("checkAll").onclick = function() {
            document.querySelectorAll(".rowCheck").forEach(c => c.checked = this.checked);
        };

        document.getElementById("searchInput").onkeyup = renderTable;

        document.getElementById("showEntries").onchange = function() {
            rowsPerPage = parseInt(this.value);
            currentPage = 1;
            renderTable();
        };

        renderTable();
    </script>
</body>

</html>