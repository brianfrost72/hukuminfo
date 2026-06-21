<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Layanan - Dashboard | Konig Guard Bureau</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex" />

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
                                        Tambah Layanan
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Tambah Layanan</h1>
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
                            <h4 class="card-title">Tambah Layanan</h4>
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
                                            <th>Nama Layanan</th>
                                            <th>Gambar</th>
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
        <app-settings layout-active="fluid"></app-settings>
    </div>

    <!-- ********************************** // MENU-Drawer ********************************** -->
    <?php include 'includes/drawer_menu.php'; ?>
    <!-- ********************************** //END MENU-drawer ********************************** -->

    <!-- ********************************** // MODAL ********************************** -->
    <!-- =========================
    MODAL LOADING
========================= -->

    <div class="modal fade"
        id="modalLoading"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0"
                style="
                border-radius:20px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <div class="spinner-border text-primary mb-4"
                        style="
                        width:4rem;
                        height:4rem;
                    ">
                    </div>

                    <h5 class="font-weight-bold mb-2">
                        Sedang Memproses...
                    </h5>

                    <p class="text-muted mb-0">
                        Mohon tunggu sebentar
                    </p>

                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Tambah Data</h5>
                </div>

                <div class="modal-body">

                    <label>Nama Layanan</label>
                    <input type="text"
                        id="layananTambah"
                        class="form-control mb-3"
                        placeholder="Nama Layanan">

                    <label>Upload Gambar</label>

                    <input type="file"
                        id="gambarTambah"
                        class="form-control mb-3"
                        accept="image/*"
                        onchange="previewTambah(event)">

                    <img id="previewTambah"
                        src=""
                        class="img-fluid mb-3 d-none"
                        style="
                        width:100%;
                        height:220px;
                        object-fit:cover;
                        border-radius:15px;
                    ">

                    <label>Deskripsi</label>

                    <textarea id="deskripsiTambah"
                        class="form-control"
                        rows="5"
                        placeholder="Masukkan deskripsi layanan"></textarea>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary"
                        onclick="tambahData()">
                        Simpan
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Edit Data</h5>
                </div>

                <div class="modal-body"
                    style="max-height:70vh; overflow-y:auto;">

                    <input type="hidden" id="editIndex">

                    <label>Nama Layanan</label>
                    <input type="text"
                        id="layananEdit"
                        class="form-control mb-3"
                        placeholder="Nama Layanan">

                    <label>Upload Gambar</label>

                    <input type="file"
                        id="gambarEdit"
                        class="form-control mb-3"
                        accept="image/*"
                        onchange="previewEdit(event)">

                    <img id="previewEdit"
                        src=""
                        class="img-fluid mb-3"
                        style="
                        width:100%;
                        height:220px;
                        object-fit:cover;
                        border-radius:15px;
                    ">

                    <label>Deskripsi</label>

                    <textarea id="deskripsiEdit"
                        class="form-control"
                        rows="5"
                        placeholder="Masukkan deskripsi"></textarea>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success"
                        onclick="updateData()">
                        Update
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL VIEW -->
    <div class="modal fade" id="modalView">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Detail Layanan</h5>
                </div>

                <div class="modal-body text-center">

                    <img id="viewGambar"
                        src=""
                        class="img-fluid mb-4"
                        style="width:100%; height:300px;
                                object-fit:cover; border-radius:20px;
                                box-shadow:0 5px 15px rgba(0,0,0,.15);">

                    <h4 id="viewNama"></h4>

                    <div id="viewDeskripsi"
                        class="text-muted"
                        style="line-height:1.8; text-align:justify;">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary"
                        data-dismiss="modal">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- =========================
    MODAL HAPUS SINGLE
========================= -->

    <div class="modal fade"
        id="modalHapus"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0"
                style="
                border-radius:20px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#fff1f2;
                    ">

                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#dc3545;
                        ">
                            delete
                        </span>

                    </div>

                    <h4 class="font-weight-bold mb-2">
                        Hapus Data?
                    </h4>

                    <p class="text-muted mb-4"
                        id="textHapus">

                        Data akan dihapus permanen

                    </p>

                    <div class="d-flex justify-content-center">

                        <button class="btn btn-light mr-2 px-4"
                            data-dismiss="modal"
                            style="
                            height:45px;
                            border-radius:10px;
                        ">

                            Batal

                        </button>

                        <button class="btn btn-danger px-4"
                            id="btnConfirmHapus"
                            style="
                            height:45px;
                            border-radius:10px;
                        ">

                            Hapus

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- =========================
    MODAL HAPUS TERPILIH
========================= -->

    <div class="modal fade"
        id="modalHapusSelected"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0"
                style="
                border-radius:20px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center"
                        style="
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#fff1f2;
                    ">

                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#dc3545;
                        ">
                            delete_sweep
                        </span>

                    </div>

                    <h4 class="font-weight-bold mb-2">
                        Hapus Data Terpilih?
                    </h4>

                    <p class="text-muted mb-4">

                        Semua data yang dipilih akan dihapus permanen

                    </p>

                    <div class="d-flex justify-content-center">

                        <button class="btn btn-light mr-2 px-4"
                            data-dismiss="modal"
                            style="
                            height:45px;
                            border-radius:10px;
                        ">

                            Batal

                        </button>

                        <button class="btn btn-danger px-4"
                            id="btnConfirmDeleteSelected"
                            style="
                            height:45px;
                            border-radius:10px;
                        ">

                            Hapus

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- ********************************** // MODAL ********************************** -->

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

    <!-- Global Settings -->
    <script src="../assets/js/settings.js"></script>

    <!-- Moment.js -->
    <script src="../assets/vendor/moment.min.js"></script>
    <script src="../assets/vendor/moment-range.js"></script>

    <script>
        let data = [{
                nama: "Security",
                gambar: "../assets/images/posts/fabian-irsara-92113.jpg",
                deskripsi: "Keamanan solid adalah landasan utama dalam kelangsungan operasional sebuah perusahaan. Konig Guard Bureau menyediakan layanan Jasa Security dengan standar profesional tinggi untuk memastikan setiap area kerja, fasilitas, dan aset perusahaan terlindungi dari berbagai potensi ancaman. Petugas keamanan kami telah melalui pelatihan intensif dalam prosedur pengamanan modern, analisa risiko, hingga komunikasi taktis. Mereka tidak hanya menjaga lingkungan tetap aman, namun juga menghadirkan ketenangan bagi seluruh pihak di dalamnya. Dengan kehadiran satpam Konig Guard Bureau yang sigap, disiplin, dan berintegritas, produktivitas perusahaan akan meningkat karena seluruh kegiatan dapat berlangsung tanpa gangguan."

            },
            {
                nama: "Pengacara",
                gambar: "../assets/images/posts/fabian-irsara-92113.jpg",
                deskripsi: "Perlindungan personal merupakan kebutuhan penting bagi eksekutif perusahaan, tokoh publik, atau tamu kehormatan. Konig Guard Bureau menghadirkan layanan Jasa Bodyguard yang mengutamakan keselamatan, kenyamanan, dan kepercayaan penuh bagi setiap klien, tanpa membatasi aktivitas mereka dalam pekerjaan maupun kehidupan sehari-hari. Bodyguard kami memiliki keahlian dalam bela diri, pengamatan ancaman, protokol keselamatan, serta pengaturan rute pengawalan. Setiap pengawalan direncanakan melalui analisa risiko yang matang dan metode pengamanan yang selalu disesuaikan dengan kondisi di lapangan."
            }
        ];

        let currentPage = 1;
        let rowsPerPage = 5;
        let deleteIndex = null;

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
            <td>
                <input type="checkbox" class="rowCheck" data-index="${start + index}">
            </td>

            <td>${start + index + 1}</td>

            <td>${item.nama}</td>

            <td>
                <img src="${item.gambar}" 
                     width="80"
                     height="60"
                     style="object-fit:cover; border-radius:10px;">
            </td>

            <td>
                <div style=" max-width:250px;
                            white-space:nowrap;
                            overflow:hidden;
                            text-overflow:ellipsis;">
                                ${item.deskripsi}
                </div>
            </td>

            <td>
                <button class="btn btn-info btn-sm mb-1"
                    onclick="viewData(${start + index})">
                    View
                </button>

                <button class="btn btn-warning btn-sm mb-1"
                    onclick="editData(${start + index})">
                    Edit
                </button>

                <button class="btn btn-danger btn-sm"
                    onclick="hapusData(${start + index})">
                    Hapus
                </button>
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

        function previewTambah(event) {

            let reader = new FileReader();

            reader.onload = function() {

                let output = document.getElementById('previewTambah');

                output.src = reader.result;

                output.classList.remove('d-none');
            }

            reader.readAsDataURL(event.target.files[0]);
        }

        function previewEdit(event) {

            let reader = new FileReader();

            reader.onload = function() {

                document.getElementById('previewEdit').src =
                    reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        }

        // =========================
        // LOADING FUNCTION
        // =========================

        function showLoading(callback) {

            // SHOW LOADING
            $('#modalLoading').modal('show');

            // DELAY
            setTimeout(() => {

                // HIDE LOADING
                $('#modalLoading').modal('hide');

                // OPEN MODAL
                setTimeout(() => {

                    callback();

                }, 300);

            }, 1200);

        }

        function tambahData() {

            let nama =
                document.getElementById("layananTambah").value;

            let deskripsi =
                document.getElementById("deskripsiTambah").value;

            let file =
                document.getElementById("gambarTambah").files[0];

            if (!nama || !deskripsi || !file) {
                alert("Semua wajib diisi!");
                return;
            }

            let reader = new FileReader();

            reader.onload = function(e) {

                data.push({
                    nama: nama,
                    gambar: e.target.result,
                    deskripsi: deskripsi
                });

                renderTable();

                $('#modalTambah').modal('hide');

                document.getElementById("layananTambah").value = "";
                document.getElementById("deskripsiTambah").value = "";
                document.getElementById("gambarTambah").value = "";

                document.getElementById("previewTambah")
                    .classList.add("d-none");
            }

            reader.readAsDataURL(file);
        }

        function editData(index) {

            showLoading(() => {

                document.getElementById("editIndex").value = index;

                document.getElementById("layananEdit").value =
                    data[index].nama;

                document.getElementById("deskripsiEdit").value =
                    data[index].deskripsi;

                document.getElementById("previewEdit").src =
                    data[index].gambar;

                $('#modalEdit').modal('show');

            });

        }

        function updateData() {

            let index =
                document.getElementById("editIndex").value;

            let nama =
                document.getElementById("layananEdit").value;

            let deskripsi =
                document.getElementById("deskripsiEdit").value;

            let file =
                document.getElementById("gambarEdit").files[0];

            if (!nama || !deskripsi) {
                alert("Semua wajib diisi!");
                return;
            }

            data[index].nama = nama;
            data[index].deskripsi = deskripsi;

            if (file) {

                let reader = new FileReader();

                reader.onload = function(e) {

                    data[index].gambar = e.target.result;

                    renderTable();

                    $('#modalEdit').modal('hide');
                }

                reader.readAsDataURL(file);

            } else {

                renderTable();

                $('#modalEdit').modal('hide');
            }
        }

        function viewData(index) {

            showLoading(() => {

                document.getElementById("viewNama").innerText =
                    data[index].nama;

                document.getElementById("viewDeskripsi").innerText =
                    data[index].deskripsi;

                document.getElementById("viewGambar").src =
                    data[index].gambar;

                $('#modalView').modal('show');

            });

        }

        function hapusData(index) {

            deleteIndex = index;

            showLoading(() => {

                document.getElementById("textHapus").innerHTML =
                    `<b>${data[index].nama}</b> akan dihapus permanen`;

                $('#modalHapus').modal('show');

            });

        }

        document.getElementById("deleteSelected")
            .addEventListener("click", function() {

                let checks =
                    document.querySelectorAll(".rowCheck:checked");

                // VALIDASI
                if (checks.length === 0) {

                    alert("Pilih data terlebih dahulu!");

                    return;

                }

                // SHOW LOADING
                showLoading(() => {

                    $('#modalHapusSelected').modal('show');

                });

            });

        // =========================
        // CONFIRM DELETE SINGLE
        // =========================

        document.getElementById("btnConfirmHapus")
            .addEventListener("click", function() {

                // VALIDASI
                if (deleteIndex === null) return;

                // HAPUS DATA
                data.splice(deleteIndex, 1);

                // RESET
                deleteIndex = null;

                // TUTUP MODAL
                $('#modalHapus').modal('hide');

                // RESET CHECK ALL
                document.getElementById("checkAll").checked = false;

                // REFRESH TABLE
                renderTable();
            });

        // CONFIRM DELETE SELECTED
        document.getElementById("btnConfirmDeleteSelected")
            .addEventListener("click", function() {

                // AMBIL SEMUA CHECKBOX YANG DICENTANG
                let checks =
                    document.querySelectorAll(".rowCheck:checked");

                // AMBIL INDEX
                let indexes = [...checks]
                    .map(c => parseInt(c.dataset.index))
                    .sort((a, b) => b - a);

                // HAPUS DATA
                indexes.forEach(index => {

                    data.splice(index, 1);

                });

                // CLOSE MODAL
                $('#modalHapusSelected').modal('hide');

                // RESET CHECK ALL
                document.getElementById("checkAll").checked = false;

                // REFRESH TABLE
                renderTable();

            });


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