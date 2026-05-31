<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Legalitas - Dashboard | Konig Guard Bureau</title>

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
                                        Manage Legalitas
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Legalitas</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <!-- TITLE -->
                <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
                    <div>
                        <h4 class="mb-1">Dashboard Dokumen</h4>
                        <small class="text-muted">
                            Kelola seluruh dokumen legalitas perusahaan
                        </small>
                    </div>

                    <button id="btnToggleForm" class="btn btn-warning d-flex align-items-center">
                        <span class="material-icons mr-2" style="font-size:20px;">
                            add
                        </span>
                        Tambah Dokumen
                    </button>
                </div>

                <div class="row">

                    <!-- TABLE -->
                    <div class="col-lg-8 mb-4">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body">

                                <!-- TOP -->
                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <h5 class="mb-0">
                                        Daftar Dokumen
                                    </h5>

                                    <div class="d-flex">

                                        <div class="position-relative mr-2">

                                            <span class="material-icons"
                                                style="
                                    position:absolute;
                                    top:9px;
                                    left:10px;
                                    font-size:18px;
                                    color:#999;
                                ">
                                                search
                                            </span>

                                            <input id="searchDokumen" type="text"
                                                class="form-control"
                                                placeholder="Cari dokumen..."
                                                style="padding-left:38px; width:250px;">

                                        </div>

                                    </div>

                                </div>

                                <!-- TABLE -->
                                <div class="table-responsive">

                                    <table class="table table-hover align-middle">

                                        <thead
                                            style="
                                background:#c9a461;
                                color:white;
                            ">
                                            <tr>
                                                <th width="70">NO</th>
                                                <th>DOKUMEN</th>
                                                <th>NOMOR DOKUMEN</th>
                                                <th width="130">AKSI</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tableBody">

                                            <!-- <tr>
                                                <td>02</td>
                                                <td>Pengesahan Akta Pendirian Perusahaan</td>
                                                <td>0000000000</td>

                                                <td>
                                                    <button class="btn btn-sm btn-light">
                                                        <span class="material-icons"
                                                            style="font-size:18px;">
                                                            edit
                                                        </span>
                                                    </button>

                                                    <button class="btn btn-sm btn-light text-danger">
                                                        <span class="material-icons"
                                                            style="font-size:18px;">
                                                            delete
                                                        </span>
                                                    </button>

                                                </td>
                                            </tr> ini di pindahkan ke JS DOM-->

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- FORM -->
                    <div class="col-lg-4 mb-4" id="formDokumen">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body">

                                <h5 class="mb-1">
                                    Tambah Dokumen
                                </h5>

                                <small class="text-muted">
                                    Lengkapi data dokumen berikut
                                </small>

                                <hr>

                                <!-- FORM -->
                                <div class="form-group">
                                    <label>Nama Dokumen</label>

                                    <input id="namaDokumen" type="text"
                                        class="form-control"
                                        placeholder="Masukkan nama dokumen">
                                </div>

                                <div class="form-group">
                                    <label>Nomor Dokumen</label>

                                    <input id="nomorDokumen" type="text"
                                        class="form-control"
                                        placeholder="Masukkan nomor dokumen">
                                </div>

                                <!-- BUTTON -->
                                <div class="d-flex justify-content-end mt-4">

                                    <button id="btnCloseForm" class="btn btn-light border mr-2">
                                        Tutup
                                    </button>

                                    <button id="btnSimpan" class="btn btn-warning">
                                        Simpan
                                    </button>

                                </div>

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
        // =========================
        // ELEMENT
        // =========================

        const tableBody = document.getElementById('tableBody');

        const btnToggleForm = document.getElementById('btnToggleForm');
        const btnCloseForm = document.getElementById('btnCloseForm');

        const formDokumen = document.getElementById('formDokumen');

        const namaDokumen = document.getElementById('namaDokumen');
        const nomorDokumen = document.getElementById('nomorDokumen');
        const searchDokumen = document.getElementById('searchDokumen');

        const btnSimpan = document.getElementById('btnSimpan');

        // =========================
        // DATA ARRAY
        // =========================

        let dataDokumen = [{
                nama: 'Management ISO',
                nomor: '0000000000'
            },
            {
                nama: 'Pengesahan Akta Pendirian Perusahaan',
                nomor: '0000000000'
            }
        ];

        // =========================
        // EDIT INDEX
        // =========================

        let editIndex = null;

        // =========================
        // FORM AWAL
        // =========================

        formDokumen.style.display = 'none';

        // =========================
        // RENDER TABLE
        // =========================

        function renderTable(keyword = '') {

            tableBody.innerHTML = '';

            // filter data
            const filteredData = dataDokumen.filter((item) => {

                return (
                    item.nama.toLowerCase().includes(keyword.toLowerCase()) ||
                    item.nomor.toLowerCase().includes(keyword.toLowerCase())
                );

            });

            // looping data
            filteredData.forEach((item, index) => {

                const nomorUrut = String(index + 1).padStart(2, '0');

                tableBody.innerHTML += `

            <tr>

                <td>${nomorUrut}</td>

                <td>${item.nama}</td>

                <td>${item.nomor}</td>

                <td>

                    <button class="btn btn-sm btn-light btnEdit"
                        data-index="${dataDokumen.indexOf(item)}">

                        <span class="material-icons"
                            style="font-size:18px;">
                            edit
                        </span>

                    </button>

                    <button class="btn btn-sm btn-light text-danger btnDelete"
                        data-index="${dataDokumen.indexOf(item)}">

                        <span class="material-icons"
                            style="font-size:18px;">
                            delete
                        </span>

                    </button>

                </td>

            </tr>

        `;

            });

            // jika kosong
            if (filteredData.length === 0) {

                tableBody.innerHTML = `

            <tr>
                <td colspan="4" class="text-center text-muted py-4">
                    Data tidak ditemukan
                </td>
            </tr>

        `;

            }

        }

        searchDokumen.addEventListener('keyup', function() {

            const keyword = this.value;

            renderTable(keyword);

        });

        // =========================
        // LOAD AWAL
        // =========================

        renderTable();

        // =========================
        // TOGGLE FORM
        // =========================

        btnToggleForm.addEventListener('click', function() {

            formDokumen.style.display = 'block';

            document.querySelector('#formDokumen h5').innerText =
                'Tambah Dokumen';

            clearForm();

            editIndex = null;

        });

        // =========================
        // TUTUP FORM
        // =========================

        btnCloseForm.addEventListener('click', function() {

            formDokumen.style.display = 'none';

        });

        // =========================
        // SIMPAN DATA
        // =========================

        btnSimpan.addEventListener('click', function() {

            const nama = namaDokumen.value.trim();
            const nomor = nomorDokumen.value.trim();

            // VALIDASI
            if (nama === '' || nomor === '') {

                alert('Form wajib diisi');

                return;

            }

            // =====================
            // EDIT
            // =====================

            if (editIndex !== null) {

                dataDokumen[editIndex].nama = nama;
                dataDokumen[editIndex].nomor = nomor;

                alert('Data berhasil diupdate');

            }

            // =====================
            // TAMBAH
            // =====================
            else {

                dataDokumen.push({
                    nama: nama,
                    nomor: nomor
                });

                alert('Data berhasil ditambahkan');

            }

            // RENDER ULANG
            renderTable();

            // RESET
            clearForm();

            formDokumen.style.display = 'none';

        });

        // =========================
        // EVENT TABLE
        // =========================

        tableBody.addEventListener('click', function(e) {

            // =====================
            // EDIT
            // =====================

            if (e.target.closest('.btnEdit')) {

                const index =
                    e.target.closest('.btnEdit').dataset.index;

                editIndex = index;

                namaDokumen.value =
                    dataDokumen[index].nama;

                nomorDokumen.value =
                    dataDokumen[index].nomor;

                formDokumen.style.display = 'block';

                document.querySelector('#formDokumen h5').innerText =
                    'Edit Dokumen';

            }

            // =====================
            // DELETE
            // =====================

            if (e.target.closest('.btnDelete')) {

                const index =
                    e.target.closest('.btnDelete').dataset.index;

                const confirmDelete =
                    confirm('Yakin ingin menghapus data?');

                if (confirmDelete) {

                    dataDokumen.splice(index, 1);

                    renderTable();

                }

            }

        });

        // =========================
        // CLEAR FORM
        // =========================

        function clearForm() {

            namaDokumen.value = '';
            nomorDokumen.value = '';

        }
    </script>
</body>

</html>