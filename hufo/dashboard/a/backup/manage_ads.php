<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Iklan - Dashboard | Konig Guard Bureau</title>

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
                                        Manage Iklan
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Iklan</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="container mt-4">

                    <!-- FORM TAMBAH IKLAN -->
                    <form id="formIklan">

                        <div class="card p-4 mb-4" style="border-radius:12px;">
                            <h6 class="mb-3">Tambah Iklan</h6>

                            <!-- JUDUL IKLAN -->
                            <div class="form-group">
                                <label>Judul Iklan <span style="color:red">*</span></label>
                                <input type="text" id="judulIklan" class="form-control" placeholder="Contoh: Iklan Hukum Info">
                            </div>

                            <!-- UPLOAD -->
                            <div class="form-group">
                                <label>Upload Gambar Iklan <span style="color:red">*</span></label>

                                <div id="dropArea" style="
            border:2px dashed #dbe5ee;
            border-radius:10px;
            padding:40px;
            text-align:center;
            background:#fafbfe;
            cursor:pointer;
        ">
                                    <span class="material-icons" style="font-size:40px; color:#939fad;">
                                        cloud_upload
                                    </span>
                                    <p class="mt-2 mb-1">Klik atau drag & drop gambar di sini</p>
                                    <small class="text-muted">Format: JPG, PNG, WEBP (Max 5MB)</small>

                                    <input type="file" id="fileInput" multiple hidden>
                                </div>

                                <!-- PREVIEW -->
                                <div id="preview" class="mt-2"></div>
                            </div>

                            <!-- LINK IKLAN -->
                            <div class="form-group">
                                <label>Link Iklan <span style="color:red">*</span></label>
                                <input type="text" id="linkIklan" class="form-control" placeholder="Contoh: https://example.com">
                            </div>

                            <!-- BUTTON -->
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    <span class="material-icons" style="font-size:16px; vertical-align:middle;">
                                        save
                                    </span>
                                    Simpan Iklan
                                </button>
                            </div>
                        </div>

                    </form>

                    <!-- LIST Iklan -->
                    <div class="card p-4" style="border-radius:12px;">
                        <h6 class="mb-3">List Iklan</h6>

                        <!-- TOP CONTROL -->
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                Show
                                <select id="entriesSelect" class="form-control d-inline-block" style="width:70px;">
                                    <option>10</option>
                                    <option>25</option>
                                </select> entries
                            </div>

                            <div>
                                <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="width:200px;">
                            </div>
                        </div>

                        <!-- TABLE -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Iklan</th>
                                        <th>Gambar</th>
                                        <th>Link Iklan</th>
                                        <th>Dibuat Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody"></tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small id="infoText">Showing 1 to 1 of 1 entries</small>

                            <div id="pagination"></div>
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

    <!-- =========================
    MODAL SUKSES SIMPAN IKLAN
========================= -->

    <div class="modal fade" id="modalSuksesIklan" tabindex="-1" role="dialog">
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
                    <h4 class="font-weight-bold mb-2">
                        Simpan Berhasil
                    </h4>

                    <!-- TEXT -->
                    <p class="text-muted mb-4" id="textIklanBerhasil">
                        Iklan berhasil disimpan
                    </p>

                    <!-- BUTTON -->
                    <button type="button"
                        class="btn btn-success px-4"
                        data-dismiss="modal"
                        style="
                        min-width:120px;
                        height:45px;
                        border-radius:10px;
                    ">
                        Okay
                    </button>

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
        let filesArray = [];

        // klik upload
        document.getElementById("dropArea").addEventListener("click", () => {
            document.getElementById("fileInput").click();
        });

        // drag & drop
        const dropArea = document.getElementById("dropArea");

        dropArea.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropArea.style.background = "#eef2ff";
        });

        dropArea.addEventListener("dragleave", () => {
            dropArea.style.background = "#fafbfe";
        });

        dropArea.addEventListener("drop", (e) => {
            e.preventDefault();
            dropArea.style.background = "#fafbfe";
            handleFiles(e.dataTransfer.files);
        });

        // input file
        document.getElementById("fileInput").addEventListener("change", function() {
            handleFiles(this.files);
        });

        // handle file
        function handleFiles(files) {
            for (let file of files) {
                filesArray.push(file);
            }
            renderPreview();
        }

        // preview
        function renderPreview() {
            const preview = document.getElementById("preview");
            preview.innerHTML = "";

            filesArray.forEach(file => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.width = "60px";
                    img.style.margin = "5px";
                    img.style.borderRadius = "6px";
                    preview.appendChild(img);
                }

                reader.readAsDataURL(file);
            });
        }

        // submit form
        document.getElementById("formIklan").addEventListener("submit", function(e) {
            e.preventDefault();

            const judul = document.getElementById("judulIklan").value.trim();
            const link = document.getElementById("linkIklan").value.trim();

            // validasi
            if (!judul || !link || filesArray.length === 0) {
                alert("Lengkapi judul, gambar dan link iklan!");
                return;
            }

            // buat gambar preview untuk tabel
            let imagesHTML = "";

            filesArray.forEach(file => {
                const url = URL.createObjectURL(file);

                imagesHTML += `
                <img 
                    src="${url}" 
                    width="55"
                    height="55"
                    style="
                        object-fit:cover;
                        border-radius:8px;
                        margin:2px;
                        border:1px solid #e5e7eb;
                    "
                >
            `;
            });

            // data row
            const rowHTML = `
    <td>
        <div style="
            font-weight:600;
            min-width:180px;
        ">
            ${judul}
        </div>
    </td>

    <td>
        <div class="d-flex align-items-center justify-content-center">
            ${imagesHTML}
        </div>
    </td>

    <td>
        <a href="${link}" 
           target="_blank"
           style="
                max-width:350px;
                display:inline-block;
                overflow:hidden;
                text-overflow:ellipsis;
                white-space:nowrap;
           ">
            ${link}
        </a>
    </td>

    <td>
        ${new Date().toLocaleDateString('id-ID')}
    </td>

    <td class="text-center">
        <button class="btn btn-sm btn-light text-danger btn-delete">
            <span class="material-icons" style="font-size:18px;">
                delete
            </span>
        </button>
    </td>
`;

            // simpan ke array utama
            tableData.unshift({
                html: rowHTML,
                text: `${judul} ${link}`.toLowerCase()
            });

            // refresh filtered data
            filteredData = [...tableData];

            // kembali ke page pertama
            currentPage = 1;

            // render ulang tabel
            renderTable();

            // reset form
            filesArray = [];
            document.getElementById("preview").innerHTML = "";
            document.getElementById("formIklan").reset();

            // modal sukses
            document.getElementById("textIklanBerhasil").innerHTML =
                `<b>${judul}</b> berhasil disimpan`;

            $('#modalSuksesIklan').modal('show');
        });

        // DELETE dengan konfirmasi
        document.addEventListener("click", function(e) {

            if (e.target.closest(".btn-delete")) {

                const row = e.target.closest("tr");

                const confirmDelete = confirm("Yakin mau hapus iklan ini?");

                if (!confirmDelete) return;

                // ambil index asli
                const visibleIndex = Array.from(row.parentNode.children).indexOf(row);

                const realIndex = ((currentPage - 1) * rowsPerPage) + visibleIndex;

                // hapus data
                filteredData.splice(realIndex, 1);

                tableData = [...filteredData];

                // cek halaman
                const totalPages = Math.ceil(filteredData.length / rowsPerPage);

                if (currentPage > totalPages) {
                    currentPage = totalPages || 1;
                }

                renderTable();
            }

        });
    </script>

    <script>
        let tableData = [];
        let currentPage = 1;
        let rowsPerPage = 10;
        let filteredData = [];

        // ambil data awal dari tabel
        function initData() {
            const rows = document.querySelectorAll("#tableBody tr");

            tableData = Array.from(rows).map(row => {
                return {
                    html: row.innerHTML,
                    text: row.innerText.toLowerCase()
                }
            });

            filteredData = [...tableData];
        }

        initData();

        // render table
        function renderTable() {
            const table = document.getElementById("tableBody");
            table.innerHTML = "";

            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            const pageData = filteredData.slice(start, end);

            pageData.forEach((row, index) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `<td>${start + index + 1}</td>` + row.html.replace(/^<td>.*?<\/td>/, '');
                table.appendChild(tr);
            });

            renderPagination();
            updateInfo();
        }

        // pagination
        function renderPagination() {
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            const pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            if (totalPages <= 1) return;

            // prev
            pagination.innerHTML += `
        <button class="btn btn-light btn-sm mr-1" ${currentPage===1?'disabled':''}
            onclick="changePage(${currentPage-1})">Previous</button>
    `;

            for (let i = 1; i <= totalPages; i++) {
                pagination.innerHTML += `
            <button class="btn btn-sm ${i===currentPage?'btn-primary':'btn-light'} mr-1"
                onclick="changePage(${i})">${i}</button>
        `;
            }

            // next
            pagination.innerHTML += `
        <button class="btn btn-light btn-sm ml-1" ${currentPage===totalPages?'disabled':''}
            onclick="changePage(${currentPage+1})">Next</button>
    `;
        }

        // ganti halaman
        function changePage(page) {
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            if (page < 1 || page > totalPages) return;

            currentPage = page;
            renderTable();
        }

        // show entries
        document.getElementById("entriesSelect").addEventListener("change", function() {
            rowsPerPage = parseInt(this.value);
            currentPage = 1;
            renderTable();
        });

        // search
        document.getElementById("searchInput").addEventListener("keyup", function() {
            const keyword = this.value.toLowerCase();

            filteredData = tableData.filter(row => row.text.includes(keyword));
            currentPage = 1;
            renderTable();
        });

        // info text
        function updateInfo() {
            const info = document.getElementById("infoText");

            const start = filteredData.length === 0 ? 0 : (currentPage - 1) * rowsPerPage + 1;
            const end = Math.min(currentPage * rowsPerPage, filteredData.length);

            info.innerText = `Showing ${start} to ${end} of ${filteredData.length} entries`;
        }

        // first render
        renderTable();
    </script>
</body>

</html>