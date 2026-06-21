<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Member - Dashboard | Konig Guard Bureau</title>

    <!-- Perfect Scrollbar -->
    <link
        type="text/css"
        href="../assets/vendor/perfect-scrollbar.css"
        rel="stylesheet" />

    <!-- SELECT2 -->
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
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
                                        Manage Konig Guard Bureau Member
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Konig Guard Bureau Member</h1>
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
                            <h4 class="card-title">Tambah Member</h4>
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
                                            <th>No</th>
                                            <th>ID Member</th>
                                            <th>Nama Klien</th>
                                            <th>Tipe Klien</th>
                                            <th>Jasa Yang Dipesan</th>
                                            <th>Tanggal Mulai Kontrak</th>
                                            <th>Tanggal Habis Kontrak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody"></tbody>
                                </table>
                            </div>

                            <!-- PAGINATION -->
                            <div class="d-flex justify-content-between mt-3">
                                <div></div>
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
    <div class="modal fade" id="modalTambah" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg"
                style="
                border-radius:20px;
                overflow:hidden;
            ">

                <!-- HEADER -->
                <div class="modal-header border-0"
                    style="
                    background:linear-gradient(135deg,#556ee6,#6a7cff);
                    padding:25px 30px;
                ">

                    <div>

                        <h4 class="text-white font-weight-bold mb-1">
                            Tambah Calon Member
                        </h4>

                        <p class="text-white mb-0"
                            style="opacity:.8;">
                            Tambahkan data calon member baru
                        </p>

                    </div>

                    <button class="close text-white"
                        data-dismiss="modal"
                        style="
                        opacity:1;
                        font-size:30px;
                    ">
                        <span>&times;</span>
                    </button>

                </div>

                <!-- BODY -->
                <div class="modal-body p-4">

                    <div class="row">

                        <!-- NOMOR MEMBER -->
                        <div class="col-md-6 mb-4">

                            <label class="font-weight-bold">
                                Nomor Calon Member
                            </label>

                            <input
                                type="text"
                                id="nomorMemberTambah"
                                class="form-control"
                                value="KG2025121"
                                disabled
                                style="
                                height:48px;
                                border-radius:10px;
                                background:#f8f9fc;
                                font-weight:600;
                            ">

                        </div>

                        <!-- NAMA KLIEN -->
                        <div class="col-md-6 mb-4">

                            <label class="font-weight-bold">
                                Nama Klien
                            </label>

                            <div class="position-relative">

                                <span class="material-icons"
                                    style="
            position:absolute;
            top:12px;
            left:12px;
            z-index:20;
            color:#8c95a6;
            font-size:20px;
        ">
                                    search
                                </span>

                                <select
                                    id="namaKlienTambah"
                                    class="select2-klien">

                                    <option value=""></option>

                                    <option value="PT Maju Jaya">
                                        PT Maju Jaya
                                    </option>

                                    <option value="PT Sinar Abadi">
                                        PT Sinar Abadi
                                    </option>

                                    <option value="Budi Santoso">
                                        Budi Santoso
                                    </option>

                                    <option value="PT Nusantara Group">
                                        PT Nusantara Group
                                    </option>

                                </select>

                            </div>

                        </div>

                        <!-- LAYANAN -->
                        <div class="col-md-6 mb-4">

                            <label class="font-weight-bold">
                                Jenis Layanan
                            </label>

                            <select
                                id="layananTambah"
                                class="form-control"
                                style="
                                height:48px;
                                border-radius:10px;
                            ">

                                <option value="">
                                    Pilih Layanan
                                </option>

                                <option value="Security">
                                    Security
                                </option>

                                <option value="Bodyguard">
                                    Bodyguard
                                </option>

                                <option value="Pengawalan">
                                    Pengawalan
                                </option>

                                <option value="VIP Protection">
                                    VIP Protection
                                </option>

                            </select>

                        </div>

                        <!-- TANGGAL MULAI -->
                        <div class="col-md-6 mb-4">

                            <label class="font-weight-bold">
                                Tanggal Mulai
                            </label>

                            <div class="position-relative">

                                <span class="material-icons"
                                    style="
            position:absolute;
            top:12px;
            right:12px;
            z-index:10;
            color:#8c95a6;
            pointer-events:none;
        ">
                                    calendar_month
                                </span>

                                <input
                                    type="text"
                                    id="tglMulaiTambah"
                                    class="form-control datepicker"
                                    placeholder="Pilih tanggal mulai"
                                    readonly
                                    style="
            height:48px;
            border-radius:10px;
            background:white;
            cursor:pointer;
        ">

                            </div>

                        </div>

                        <!-- TANGGAL SELESAI -->
                        <div class="col-md-6 mb-2">

                            <label class="font-weight-bold">
                                Tanggal Selesai
                            </label>

                            <div class="position-relative">

                                <span class="material-icons"
                                    style="
            position:absolute;
            top:12px;
            right:12px;
            z-index:10;
            color:#8c95a6;
            pointer-events:none;
        ">
                                    calendar_month
                                </span>

                                <input
                                    type="text"
                                    id="tglSelesaiTambah"
                                    class="form-control datepicker"
                                    placeholder="Pilih tanggal selesai"
                                    readonly
                                    style="
            height:48px;
            border-radius:10px;
            background:white;
            cursor:pointer;
        ">

                            </div>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer border-0 px-4 pb-4">

                    <button class="btn btn-light px-4"
                        data-dismiss="modal"
                        style="
                        height:45px;
                        border-radius:10px;
                    ">
                        Batal
                    </button>

                    <button class="btn btn-primary px-4"
                        onclick="tambahData()"
                        style="
                        height:45px;
                        border-radius:10px;
                    ">

                        Simpan Data

                    </button>

                </div>

            </div>
        </div>

    </div>

    <!-- MODAL LOADING -->
    <div class="modal fade"
        id="modalLoading"
        data-backdrop="static"
        data-keyboard="false">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg"
                style="
                border-radius:22px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <!-- LOADER -->
                    <div class="spinner-border text-primary mb-4"
                        style="
                        width:70px;
                        height:70px;
                    ">
                    </div>

                    <h4 class="font-weight-bold mb-2">
                        Mohon Tunggu
                    </h4>

                    <p class="text-muted mb-0">
                        Sedang memproses data...
                    </p>

                </div>

            </div>
        </div>

    </div>

    <!-- MODAL SUKSES -->
    <div class="modal fade" id="modalSuccess">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg"
                style="
                border-radius:22px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <!-- ICON -->
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center"
                        style="
                        width:95px;
                        height:95px;
                        border-radius:50%;
                        background:#eafaf1;
                    ">

                        <span class="material-icons"
                            style="
                            font-size:55px;
                            color:#28a745;
                        ">
                            check_circle
                        </span>

                    </div>

                    <h3 class="font-weight-bold mb-2"
                        id="successTitle">

                        Berhasil

                    </h3>

                    <p class="text-muted mb-4"
                        id="successText">

                        Data berhasil disimpan

                    </p>

                    <button class="btn btn-success px-4"
                        data-dismiss="modal"
                        style="
                        border-radius:12px;
                        height:45px;
                        min-width:130px;
                    ">
                        OK
                    </button>

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
    <!-- SELECT2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

    <script>
        // ===================================== DOM JS =====================================
        let data = [{
                nomorMember: "KG2025121",
                namaKlien: "PT Maju Jaya",
                tipeKlien: "Perusahaan",
                layanan: "Security",
                tglMulai: "2026-05-01",
                tglSelesai: "2026-12-31",
                status: "Aktif"
            },
            {
                nomorMember: "KG2025122",
                namaKlien: "Budi Santoso",
                tipeKlien: "Pribadi",
                layanan: "Bodyguard",
                tglMulai: "2026-06-01",
                tglSelesai: "2026-11-01",
                status: "Aktif"
            }
        ];

        let currentPage = 1;
        let rowsPerPage = 5;

        // ===================================== SELECT2 =====================================
        $(document).ready(function() {

            // =====================================
            // SELECT2 SEARCH
            // =====================================
            $('#namaKlienTambah').select2({

                placeholder: "Cari nama klien...",

                allowClear: true,

                width: '100%',

                dropdownParent: $('#modalTambah')

            });

            // =====================================
            // DATEPICKER
            // =====================================
            flatpickr("#tglMulaiTambah", {

                enableTime: false,

                dateFormat: "d/m/Y",

                clickOpens: true

            });

            flatpickr("#tglSelesaiTambah", {

                enableTime: false,

                dateFormat: "d/m/Y",

                clickOpens: true

            });

        });


        function renderTable() {

            let tbody = document.getElementById("tableBody");

            tbody.innerHTML = "";

            let search = document
                .getElementById("searchInput")
                .value
                .toLowerCase();

            let filtered = data.filter((d) =>
                d.nomorMember.toLowerCase().includes(search) ||
                d.namaKlien.toLowerCase().includes(search) ||
                d.layanan.toLowerCase().includes(search)
            );

            let start = (currentPage - 1) * rowsPerPage;

            let paginated = filtered.slice(start, start + rowsPerPage);

            paginated.forEach((item, index) => {

                tbody.innerHTML += `
            <tr>

                <td>${start + index + 1}</td>

                <td>
                    <strong>${item.nomorMember}</strong>
                </td>

                <td>${item.namaKlien}</td>

                <td>
                    <span class="badge badge-primary">
                        ${item.tipeKlien}
                    </span>
                </td>
                

                <td class="text-center">
                    <span class="badge badge-primary">
                        ${item.layanan}
                    </span>
                </td>

                <td>${item.tglMulai}</td>

                <td>${item.tglSelesai}</td>

                <td>

                    <!-- VIEW -->
                    <a
                        href="view_member.php?id=${item.nomorMember}"
                        class="btn btn-info btn-sm" title="Lihat Member">


                        <span class="material-icons" style="font-size:16px;">
                            visibility
                        </span>
                    </a>

                    <!-- SELESAI -->
                    <button
                        class="btn btn-success btn-sm"
                        onclick="selesaiMember(${start + index})" title="Selesai Member">

                        <span class="material-icons" style="font-size:16px;">
                            check_circle
                        </span>
                    </button>

                </td>

            </tr>
        `;
            });

            renderPagination(filtered.length);
        }
        
        // ==================================== PAGINATION ====================================
        function renderPagination(total) {
            let pageCount = Math.ceil(total / rowsPerPage);
            let pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            if (pageCount <= 1) return;

            // PREV BUTTON
            pagination.innerHTML += `
        <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
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
            <li class="page-item ${i === currentPage ? "active" : ""}">
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
        <li class="page-item ${currentPage === pageCount ? "disabled" : ""}">
            <a class="page-link" onclick="changePage(${currentPage + 1})">Next</a>
        </li>
    `;
        }

        // ===================================== PERGANTIAN HALAMAN PAGINATION =================================
        function changePage(page) {
            currentPage = page;
            renderTable();
        }

        // ===================================== MODAL TAMBAH DATA =====================================
        function tambahData() {

            let nomorMember =
                document.getElementById("nomorMemberTambah").value;

            let namaKlien =
                document.getElementById("namaKlienTambah").value;

            let layanan =
                document.getElementById("layananTambah").value;

            let tglMulai =
                document.getElementById("tglMulaiTambah").value;

            let tglSelesai =
                document.getElementById("tglSelesaiTambah").value;

            // AUTO TIPE KLIEN
            let tipeKlien =
                namaKlien.includes("PT") ?
                "Perusahaan" :
                "Pribadi";

            // VALIDASI
            if (
                namaKlien === "" ||
                layanan === "" ||
                tglMulai === "" ||
                tglSelesai === ""
            ) {

                document.getElementById("validasiText").innerHTML =
                    "Semua data wajib diisi";

                $("#modalValidasi").modal("show");

                return;
            }

            // LOADING
            $("#modalLoading").modal("show");

            setTimeout(() => {

                // PUSH DATA
                data.unshift({

                    nomorMember: nomorMember,

                    namaKlien: namaKlien,

                    tipeKlien: tipeKlien,

                    layanan: layanan,

                    tglMulai: tglMulai,

                    tglSelesai: tglSelesai,

                    status: "Aktif"

                });

                // RESET PAGE
                currentPage = 1;

                // RENDER
                renderTable();

                // CLOSE
                $("#modalTambah").modal("hide");

                $("#modalLoading").modal("hide");

                // SUCCESS
                document.getElementById("successTitle").innerHTML =
                    "Berhasil";

                document.getElementById("successText").innerHTML =
                    `${namaKlien} berhasil ditambahkan`;

                $("#modalSuccess").modal("show");

                // RESET FORM
                $('#namaKlienTambah').val(null).trigger('change');

                document.getElementById("layananTambah").value = "";

                document.getElementById("tglMulaiTambah").value = "";

                document.getElementById("tglSelesaiTambah").value = "";

                // AUTO GENERATE NOMOR MEMBER
                let newNumber = 121 + data.length;

                document.getElementById("nomorMemberTambah").value =
                    "KG2025" + newNumber;

            }, 1200);

        }

        // ===================================== MODAL PINDAH DATA =====================================
        function selesaiMember(index) {

            $("#modalLoading").modal("show");

            setTimeout(() => {

                let member = data[index];

                // PINDAH STATUS
                member.status = "Selesai";

                // REMOVE DARI TABLE AKTIF
                data.splice(index, 1);

                renderTable();

                $("#modalLoading").modal("hide");

                document.getElementById("successTitle").innerHTML =
                    "Member Diselesaikan";

                document.getElementById("successText").innerHTML =
                    `${member.nomorMember} dipindahkan ke halaman riwayat member`;

                $("#modalSuccess").modal("show");

            }, 1500);

        }

        // ===================================== FIRST RENDER =====================================
        renderTable();

        // ===================================== SEARCH =====================================
        document
            .getElementById("searchInput")
            .addEventListener("keyup", function() {

                currentPage = 1;

                renderTable();

            });

        // ===================================== SHOW ENTRIES =====================================
        document
            .getElementById("showEntries")
            .addEventListener("change", function() {

                rowsPerPage = parseInt(this.value);

                currentPage = 1;

                renderTable();

            });
    </script>
</body>

</html>