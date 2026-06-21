<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Klien Kami - Dashboard | Konig Guard Bureau</title>

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
                                        Manage Klien Kami
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Klien Kami</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="container mt-4">

                    <form id="formKlien" enctype="multipart/form-data">
                        <!-- FORM -->
                        <div class="card p-4 mb-4" style="border-radius:12px;">
                            <h5 class="mb-3 d-flex align-items-center">
                                <span class="material-icons mr-2" style="color: var(--primary);">image</span>
                                Form Data Gambar Klien
                            </h5>

                            <div class="row">
                                <!-- Nama Klien -->
                                <div class="col-md-12 mb-3">
                                    <label>Nama Klien</label>
                                    <input type="text" id="namaKlien" class="form-control" placeholder="Masukkan nama klien">
                                </div>

                                <!-- Upload Gambar -->
                                <div class="col-md-12 mb-3">
                                    <label>Upload Gambar</label>
                                    <div class="border p-4 text-center" style="border-radius:10px; border-style:dashed;">
                                        <span class="material-icons" style="font-size:40px; color: var(--gray);">cloud_upload</span>
                                        <p class="mb-2">Klik untuk upload gambar</p>
                                        <input type="file" id="gambarKlien" class="form-control-file">
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div class="col-md-12 mb-3">
                                    <label>Deskripsi Gambar</label>
                                    <textarea class="form-control" id="deskripsi" rows="3" placeholder="Masukkan deskripsi gambar"></textarea>
                                </div>

                                <!-- BUTTON -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn" style="background: var(--primary); color:#fff;">
                                        <span class="material-icons" style="font-size:18px;">save</span>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- TABLE -->
                    <div class="card p-4" style="border-radius:12px;">
                        <h6 class="mb-3">List Data Gambar</h6>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Klien</th>
                                        <th>Gambar</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal Upload</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody"></tbody>
                            </table>
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
    MODAL VALIDASI
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
        const form = document.getElementById("formKlien");
        const tableBody = document.getElementById("tableBody");

        form.addEventListener("submit", function(e) {
            e.preventDefault();

            // AMBIL VALUE
            const nama = document.getElementById("namaKlien").value;
            const deskripsi = document.getElementById("deskripsi").value;
            const gambarInput = document.getElementById("gambarKlien");

            // VALIDASI
            if (!nama || !deskripsi || gambarInput.files.length === 0) {
                alert("Semua field wajib diisi!");
                return;
            }

            // AMBIL FILE GAMBAR
            const file = gambarInput.files[0];

            // BUAT URL PREVIEW
            const imageURL = URL.createObjectURL(file);

            // TANGGAL
            const tanggal = new Date().toLocaleDateString("id-ID", {
                day: "2-digit",
                month: "long",
                year: "numeric"
            });

            // NOMOR
            const nomor = tableBody.rows.length + 1;

            // ROW TABLE
            const row = `
            <tr>
                <td>${nomor}</td>
                <td>${nama}</td>

                <td>
                    <img src="${imageURL}" 
                         width="80" 
                         height="80"
                         style="object-fit:cover; border-radius:8px;">
                </td>

                <td>${deskripsi}</td>

                <td>${tanggal}</td>

                <td>
                    <button 
                        class="btn btn-sm mr-1"
                        style="background: var(--primary); color:#fff;"
                        onclick="editRow(this)">
                        <span class="material-icons" style="font-size:16px;">edit</span>
                    </button>

                    <button 
                        class="btn btn-sm"
                        style="background: var(--danger); color:#fff;"
                        onclick="hapusRow(this)">
                        <span class="material-icons" style="font-size:16px;">delete</span>
                    </button>
                </td>
            </tr>
        `;

            // MASUKKAN KE TABLE
            tableBody.innerHTML += row;

            // RESET FORM
            form.reset();

            // MODAL TAMBAH
            document.getElementById("successTitle").innerText = "Tambah Berhasil";

            document.getElementById("successText").innerHTML =
                `<b>${nama}</b> berhasil ditambahkan`;

            $('#modalSuccess').modal('show');
        });

        // HAPUS ROW
        function hapusRow(btn) {
            if (confirm("Yakin ingin hapus data ini?")) {
                btn.closest("tr").remove();

                // RESET NOMOR
                [...tableBody.rows].forEach((row, index) => {
                    row.cells[0].innerText = index + 1;
                });
            }
        }

        // EDIT 
        function editRow(btn) {

            // HAPUS EDIT YANG SUDAH TERBUKA
            document.querySelectorAll(".edit-row").forEach(el => el.remove());

            const tr = btn.closest("tr");

            const nama = tr.cells[1].innerText;
            const gambar = tr.cells[2].querySelector("img").src;
            const deskripsi = tr.cells[3].innerText;

            // BUAT ROW EDIT
            const editHTML = `
        <tr class="edit-row">
            <td colspan="6">

                <div class="card p-4 mt-2" style="background:#f9fafc; border-radius:12px;">

                    <h6 class="mb-4 d-flex align-items-center">
                        <span class="material-icons mr-2" style="color:var(--primary);">
                            edit
                        </span>
                        Edit Data Klien
                    </h6>

                    <div class="row">

                        <!-- NAMA -->
                        <div class="col-md-12 mb-3">
                            <label>Nama Klien</label>
                            <input 
                                type="text" 
                                class="form-control editNama" 
                                value="${nama}">
                        </div>

                        <!-- PREVIEW -->
                        <div class="col-md-12 mb-3">

                            <label>Ganti Gambar</label>

                            <div class="d-flex align-items-center">

                                <!-- GAMBAR LAMA -->
                                <div class="text-center">
                                    <small class="d-block mb-2">Gambar Lama</small>

                                    <img 
                                        src="${gambar}" 
                                        class="oldPreview"
                                        width="100"
                                        height="100"
                                        style="object-fit:cover; border-radius:10px;">
                                </div>

                                <!-- ARROW -->
                                <div class="px-4">
                                    <span class="material-icons" style="font-size:40px; color:var(--primary);">
                                        arrow_forward
                                    </span>
                                </div>

                                <!-- GAMBAR BARU -->
                                <div class="text-center">
                                    <small class="d-block mb-2">Gambar Baru</small>

                                    <img 
                                        src="${gambar}" 
                                        class="newPreview"
                                        width="100"
                                        height="100"
                                        style="object-fit:cover; border-radius:10px; border:2px dashed #ddd;">
                                </div>

                            </div>

                            <!-- INPUT FILE -->
                            <input 
                                type="file"
                                class="form-control-file mt-3 editGambar"
                                accept="image/*">

                        </div>

                        <!-- DESKRIPSI -->
                        <div class="col-md-12 mb-3">
                            <label>Deskripsi</label>

                            <textarea 
                                class="form-control editDeskripsi"
                                rows="3">${deskripsi}</textarea>
                        </div>

                        <!-- BUTTON -->
                        <div class="col-md-12">

                            <button 
                                class="btn mr-2"
                                style="background:var(--primary); color:#fff;"
                                onclick="simpanEdit(this)">
                                <span class="material-icons" style="font-size:16px;">
                                    save
                                </span>
                                Simpan
                            </button>

                            <button 
                                class="btn btn-light"
                                onclick="batalEdit(this)">
                                Batal
                            </button>

                        </div>

                    </div>

                </div>

            </td>
        </tr>
        `;

            // INSERT SETELAH ROW
            tr.insertAdjacentHTML("afterend", editHTML);

            // PREVIEW GAMBAR BARU
            const editRowElement = tr.nextElementSibling;

            const fileInput = editRowElement.querySelector(".editGambar");
            const preview = editRowElement.querySelector(".newPreview");

            fileInput.addEventListener("change", function() {

                if (this.files && this.files[0]) {

                    preview.src = URL.createObjectURL(this.files[0]);

                }

            });
        }

        // SIMPAN EDIT
        // SIMPAN EDIT
        function simpanEdit(btn) {

            const editRow = btn.closest(".edit-row");
            const mainRow = editRow.previousElementSibling;

            const nama = editRow.querySelector(".editNama").value;
            const deskripsi = editRow.querySelector(".editDeskripsi").value;

            const fileInput = editRow.querySelector(".editGambar");

            // UPDATE TEXT
            mainRow.cells[1].innerText = nama;
            mainRow.cells[3].innerText = deskripsi;

            // UPDATE GAMBAR
            if (fileInput.files.length > 0) {

                const newImage = URL.createObjectURL(fileInput.files[0]);

                mainRow.cells[2].querySelector("img").src = newImage;
            }

            // HAPUS FORM EDIT
            editRow.remove();

            // MODAL EDIT
            document.getElementById("successTitle").innerText = "Edit Berhasil";

            document.getElementById("successText").innerHTML =
                `<b>${nama}</b> berhasil di edit`;

            $('#modalSuccess').modal('show');
        }

        // BATAL EDIT
        function batalEdit(btn) {

            btn.closest(".edit-row").remove();

        }
    </script>
</body>

</html>