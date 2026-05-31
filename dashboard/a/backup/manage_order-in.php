<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Order In - Dashboard | Konig Guard Bureau</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex" />

    <!-- Perfect Scrollbar -->
    <link
        type="text/css"
        href="assets/vendor/perfect-scrollbar.css"
        rel="stylesheet" />

    <!-- App CSS -->
    <link type="text/css" href="assets/css/app.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/app.rtl.css" rel="stylesheet" />

    <!-- Material Design Icons -->
    <link
        type="text/css"
        href="assets/css/vendor-material-icons.css"
        rel="stylesheet" />

    <!-- Font Awesome FREE Icons -->
    <link
        type="text/css"
        href="assets/css/vendor-fontawesome-free.css"
        rel="stylesheet" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script
        async
        src="https://www.googletagmanager.com/gtag/js?id=UA-133433427-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());
        gtag("config", "UA-133433427-1");
    </script>

    <!-- Flatpickr -->
    <link
        type="text/css"
        href="assets/css/vendor-flatpickr.css"
        rel="stylesheet" />
    <link
        type="text/css"
        href="assets/css/vendor-flatpickr-airbnb.css"
        rel="stylesheet" />

    <!-- Vector Maps -->
    <link
        type="text/css"
        href="assets/vendor/jqvmap/jqvmap.min.css"
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

            <div class="page__header page__header-nav">
                <div class="container-fluid page__container">
                    <div class="navbar navbar-secondary navbar-light navbar-expand-sm p-0">
                        <button class="navbar-toggler navbar-toggler-right"
                            data-toggle="collapse"
                            data-target="#navbarsExample03"
                            type="button">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="navbar-collapse collapse"
                            id="navbarsExample03">
                            <ul class="nav navbar-nav">
                                <li class="nav-item">
                                    <a href="#"
                                        class="btn btn-primary">Order In</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#"
                                        class="btn btn-primary">Estimasi Biaya</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#"
                                        class="btn btn-primary">Ajukan Kontrak</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#"
                                        class="btn btn-primary">Pembayaran</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#"
                                        class="btn btn-primary">Invoice</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-chat-container">
                <div class="row h-100 m-0">
                    <div class="col-lg-4 py-3 px-0 d-lg-flex flex-column h-100">
                        <div class="search-form form-control-rounded search-form--light mx-3">
                            <input type="text"
                                class="form-control"
                                placeholder="What are you looking for?"
                                id="searchOrderIn">
                            <button class="btn"
                                type="button" id="btnSearch"><i class="material-icons">search</i></button>
                            <div id="searchResult" class="mt-3"></div>
                        </div>

                        <div class="flex pt-3" data-perfect-scrollbar>

                            <div class="list-group list-group-flush" id="orderList"
                                style="position: relative; z-index: 0;">

                                <div class="list-group-item d-flex align-items-start bg-transparent">
                                    <div class="mr-3 d-flex flex-column align-items-center">
                                        <a href="#"
                                            class="avatar avatar-xs mb-2">
                                            <img src="assets/images/256_daniel-gaffey-1060698-unsplash.jpg"
                                                alt="Avatar"
                                                class="avatar-img rounded-circle">
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column">

                                        <!-- HEADER -->
                                        <div class="d-flex align-items-center mb-1">
                                            <a href="#" class="text-dark-gray">
                                                <strong>Sherri J. Cardenas</strong>
                                            </a>

                                            <!-- STATUS -->
                                            <span class="badge badge-success ml-2">Dibaca</span>

                                            <small class="ml-auto text-muted">Today</small>
                                        </div>

                                        <!-- CONTENT -->
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="mr-2 text-bold"><b>Memesan Jasa:</b></span>
                                            <span class="badge badge-dark">Security</span>
                                        </div>

                                        <!-- DESKRIPSI -->
                                        <small class="text-muted"
                                            style="max-height: 2.5rem; overflow: hidden; display: inline-block;">
                                            Answer: Never. There is no Windows 11. Microsoft does not have a team of pro...

                                            <a class="d-flex align-items-center mb-1">
                                                <small class="text-muted mr-1">2</small>
                                                <i class="material-icons icon-16pt">attachment</i>
                                            </a>
                                        </small>

                                    </div>
                                </div>

                                <div class="list-group-item d-flex align-items-start border-right-3 border-right-primary">
                                    <div class="mr-3 d-flex flex-column align-items-center">
                                        <a href="#"
                                            class="avatar avatar-xs mb-2">
                                            <img src="assets/images/256_rsz_1andy-lee-642320-unsplash.jpg"
                                                alt="Avatar"
                                                class="avatar-img rounded-circle">
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column">

                                        <!-- HEADER -->
                                        <div class="d-flex align-items-center mb-1">
                                            <a href="#" class="text-dark-gray">
                                                <strong>Sherri J. Cardenas</strong>
                                            </a>

                                            <!-- STATUS -->
                                            <span class="badge badge-success ml-2">Dibaca</span>

                                            <small class="ml-auto text-muted">Today</small>
                                        </div>

                                        <!-- CONTENT -->
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="mr-2 text-bold"><b>Memesan Jasa:</b></span>
                                            <span class="badge badge-dark">Security</span>
                                        </div>

                                        <!-- DESKRIPSI -->
                                        <small class="text-muted"
                                            style="max-height: 2.5rem; overflow: hidden; display: inline-block;">
                                            Answer: Never. There is no Windows 11. Microsoft does not have a team of pro...
                                        </small>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 py-3 px-4 bg-white border-left d-flex flex-column h-100">

                        <div id="detailWrapper">
                            <div class="flex d-flex flex-column"
                                data-perfect-scrollbar>
                                <div class="d-flex align-items-center mb-3">
                                    <a href="#"
                                        class="avatar avatar-sm mr-3">
                                        <img src="assets/images/256_rsz_1andy-lee-642320-unsplash.jpg"
                                            alt="Avatar"
                                            class="avatar-img rounded-circle">
                                    </a>
                                    <div class="flex">
                                        <p class="m-0">
                                            <span class="d-flex align-items-center">
                                                <a href="#"
                                                    class="text-dark-gray"><strong>Jenell D. Matney</strong></a>
                                                <small class="ml-auto text-muted">March 24, 2025 - 10:30 WIB</small>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h1 class="h4 flex">Memesan Jasa: <strong class="badge badge-dark">Security</strong></h1>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0)"
                                            class="text-dark-gray ml-2" title="Tutup Pesan Ini" onclick="closeMessage()">
                                            <i class="material-icons">clear</i>
                                        </a>
                                        <a href=""
                                            class="text-dark-gray ml-2" title="Print">
                                            <i class="material-icons">print</i>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">

                                    <!-- ISI KONTEN PESANAN DISINI -->
                                    <div class="container-fluid mt-4" id="detailContent">
                                        <div class="card shadow-sm border-0">
                                            <div class="card-body">

                                                <!-- TITLE -->
                                                <div class="d-flex align-items-center justify-content-between mb-4 position-relative">

                                                    <!-- KIRI (ICON + TEXT) -->
                                                    <div class="d-flex align-items-center">
                                                        <span class="material-icons mr-3" style="font-size:32px;color:#6774DF;">assignment</span>
                                                        <div>
                                                            <h5 class="mb-0">Form Pemesanan Jasa</h5>
                                                            <small class="text-muted">Lengkapi data berikut untuk membuat pemesanan jasa baru.</small>
                                                        </div>
                                                    </div>

                                                    <!-- KANAN (GAMBAR) -->
                                                    <div class="d-none d-md-block">
                                                        <img src="assets/images/bg-form-1.png"
                                                            alt="illustration"
                                                            style="height:90px; opacity:0.9;">
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <!-- ID KLIEN -->
                                                    <div class="col-md-6 mb-3">
                                                        <label>ID Klien</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-light">
                                                                    <span class="material-icons">person_pin</span>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Contoh: KLN-2026-001">
                                                        </div>
                                                        <small class="text-muted">ID unik klien</small>
                                                    </div>

                                                    <!-- NAMA KLIEN -->
                                                    <div class="col-md-6 mb-3">
                                                        <label>Nama Klien</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-light">
                                                                    <span class="material-icons">person</span>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Masukkan nama klien">
                                                        </div>
                                                        <small class="text-muted">Nama lengkap / perusahaan</small>
                                                    </div>

                                                    <!-- TYPE KLIEN -->
                                                    <div class="col-md-6 mb-3">
                                                        <label>Tipe Klien</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-light">
                                                                    <span class="material-icons">business</span>
                                                                </span>
                                                            </div>
                                                            <select class="form-control">
                                                                <option selected disabled>Pilih tipe klien</option>
                                                                <option>Perusahaan</option>
                                                                <option>Perorangan</option>
                                                                <option>Pemerintah</option>
                                                            </select>
                                                        </div>
                                                        <small class="text-muted">Kategori klien</small>
                                                    </div>

                                                    <!-- JANGKA WAKTU -->
                                                    <div class="col-md-6 mb-3">
                                                        <label>Jangka Waktu Kontrak</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-light">
                                                                    <span class="material-icons">access_time</span>
                                                                </span>
                                                            </div>
                                                            <select class="form-control">
                                                                <option selected disabled>Pilih durasi</option>
                                                                <option>1 Bulan</option>
                                                                <option>3 Bulan</option>
                                                                <option>6 Bulan</option>
                                                                <option>1 Tahun</option>
                                                            </select>
                                                        </div>
                                                        <small class="text-muted">Durasi kontrak jasa</small>
                                                    </div>

                                                    <!-- LOKASI -->
                                                    <div class="col-md-12 mb-3">
                                                        <label>Lokasi Penempatan</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-light">
                                                                    <span class="material-icons">location_on</span>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Masukkan lokasi penempatan kerja">
                                                        </div>
                                                        <small class="text-muted">Alamat lengkap lokasi</small>
                                                    </div>

                                                    <!-- CATATAN -->
                                                    <div class="col-md-12 mb-3">
                                                        <label>Catatan</label>
                                                        <textarea class="form-control" rows="4" placeholder="Tuliskan catatan tambahan (opsional)"></textarea>
                                                        <small class="text-muted">Informasi tambahan terkait pesanan</small>
                                                    </div>

                                                    <!-- TABEL INPUT -->
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Jasa Yang Dipesan</th>
                                                                <th width="150">Jumlah Personil</th>
                                                                <th width="150">Biaya Satuan</th>
                                                                <th width="150">Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <input type="text" class="form-control desc" value="Konsultasi IT" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control jml-personil" value="2" inputmode="numeric" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control harga rupiah" inputmode="numeric"
                                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="">
                                                                </td>
                                                                <td class="subtotal text-right">Rp 0</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <div class="col-md-12 border rounded p-3">

                                                        <div class="row mb-2 align-items-center">
                                                            <div class="col-12">Subtotal</div>
                                                            <div class="col-12 text-right">
                                                                <strong id="totalSubtotal">Rp 0</strong>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-2 align-items-center">
                                                            <div class="col-6">Biaya Layanan</div>
                                                            <div class="col-6">
                                                                <input type="text" id="biayaLayanan"
                                                                    class="form-control form-control-sm rupiah text-right"
                                                                    inputmode="numeric"
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-2 align-items-center">
                                                            <div class="col-6">Biaya Tambahan (Opsional)</div>
                                                            <div class="col-6">
                                                                <input type="text" id="biayaTambahan"
                                                                    class="form-control form-control-sm rupiah text-right"
                                                                    inputmode="numeric"
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-2 align-items-center">
                                                            <div class="col-6">Pajak</div>
                                                            <div class="col-6">
                                                                <input type="text" id="pajakInput"
                                                                    class="form-control form-control-sm rupiah text-right"
                                                                    inputmode="numeric"
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <div class="row align-items-center">
                                                            <div class="col-6">
                                                                <strong>Total</strong>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <h5 class="mb-0 text-primary" id="grandTotal">Rp 0</h5>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="card-footer text-right">
                                                    <button class="btn btn-primary"><span class="material-icons mr-1" style="font-size:16px;">send</span>Kirim Biaya Estimasi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ISI PESAN END DISINI -->
                                </div>
                            </div>

                            <!-- ACTION -->
                            <div class="border-top pt-3 px-3 text-center">
                                Klik disini untuk <a class="btn btn-danger"
                                    href=""><span class="material-icons mr-1" style="font-size:16px;">clear</span>Tolak</a> Pesanan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- DOM Factory -->
    <script src="assets/vendor/dom-factory.js"></script>

    <!-- MDK -->
    <script src="assets/vendor/material-design-kit.js"></script>

    <!-- App -->
    <script src="assets/js/toggle-check-all.js"></script>
    <script src="assets/js/check-selected-row.js"></script>
    <script src="assets/js/dropdown.js"></script>
    <script src="assets/js/sidebar-mini.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="assets/js/app-settings.js"></script>

    <!-- Flatpickr -->
    <script src="assets/vendor/flatpickr/flatpickr.min.js"></script>
    <script src="assets/js/flatpickr.js"></script>

    <!-- Global Settings -->
    <script src="assets/js/settings.js"></script>

    <!-- Moment.js -->
    <script src="assets/vendor/moment.min.js"></script>
    <script src="assets/vendor/moment-range.js"></script>


    <!-- Vector Maps -->
    <script src="assets/vendor/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="assets/js/vector-maps.js"></script>

    <script>
        function formatRupiahInput(el) {
            let value = el.value.replace(/[^0-9]/g, '');
            if (value === '') {
                el.value = '';
                return;
            }
            el.value = 'Rp ' + parseInt(value).toLocaleString('id-ID');
        }

        function getAngka(el) {
            return parseInt(el.value.replace(/[^0-9]/g, '')) || 0;
        }
    </script>
    <script>
        function formatRupiahInput(el) {
            let angka = el.value.replace(/[^0-9]/g, '');
            if (angka === '') {
                el.value = '';
                return;
            }
            el.value = 'Rp ' + parseInt(angka).toLocaleString('id-ID');
        }

        function getAngka(el) {
            if (!el || el.value === '') return 0;
            return parseInt(el.value.replace(/[^0-9]/g, '')) || 0;
        }

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function hitung() {
            let subtotal = 0;

            document.querySelectorAll('tbody tr').forEach(row => {
                const personil = getAngka(row.querySelector('.jml-personil'));
                const harga = getAngka(row.querySelector('.harga'));

                const sub = personil * harga;
                row.querySelector('.subtotal').innerText = formatRupiah(sub);

                subtotal += sub;
            });

            document.getElementById('totalSubtotal').innerText = formatRupiah(subtotal);

            const biayaLayanan = getAngka(document.getElementById('biayaLayanan'));
            const biayaTambahan = getAngka(document.getElementById('biayaTambahan')); // OPSIONAL
            const pajak = getAngka(document.getElementById('pajakInput'));

            const total = subtotal + biayaLayanan + biayaTambahan + pajak;
            document.getElementById('grandTotal').innerText = formatRupiah(total);
        }

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('rupiah')) {
                formatRupiahInput(e.target);
            }
            hitung();
        });

        document.addEventListener('DOMContentLoaded', hitung);
    </script>

    <script>
        /* =========================
   DATA SAMPLE (BOLEH DIHAPUS NANTI)
   kalau sudah pakai backend → kosongkan []
========================= */
        let dataOrder = [{
                nama: "Sherri J. Cardenas",
                jasa: "Security",
                status: "Dibaca",
                waktu: "Today",
                deskripsi: "Pengamanan gedung kantor"
            },
            {
                nama: "Michael Tan",
                jasa: "Pengacara",
                status: "Belum Dibaca",
                waktu: "25 Maret 2023",
                deskripsi: "Konsultasi hukum"
            }
        ];

        /* =========================
           ELEMENT
        ========================= */
        const inputSearch = document.getElementById("searchOrderIn");
        const searchForm = document.querySelector(".search-form");
        const btnSearch = document.getElementById("btnSearch");
        const listContainer = document.getElementById("orderList");

        /* =========================
   STATE ACTIVE
========================= */
        let activeIndex = 0;

        /* =========================
           RENDER
        ========================= */
        function renderList(data) {

            // JIKA KOSONG
            if (data.length === 0) {
                listContainer.innerHTML = `
        <div class="list-group-item text-center">
            <strong>Data tidak ditemukan</strong>
        </div>`;
                return;
            }

            let html = "";

            data.forEach((item, index) => {
                html += `
        <div class="list-group-item d-flex align-items-start 
            ${index === activeIndex ? 'border-right-3 border-right-primary' : ''}"
            style="cursor:pointer;"
            onclick="setActive(${index})">
            
            <div class="mr-3">
                <img src="assets/images/256_rsz_1andy-lee-642320-unsplash.jpg"
                     class="avatar-img rounded-circle"
                     style="width:40px;">
            </div>

            <div class="flex">
                
                <div class="d-flex align-items-center mb-1">
                    <strong>${item.nama}</strong>

                    <span class="badge ${item.status === 'Dibaca' ? 'badge-success' : 'badge-primary'} ml-2">
                        ${item.status}
                    </span>

                    <small class="ml-auto text-muted">${item.waktu}</small>
                </div>

                <div class="mb-1">
                    <span class="text-muted">Memesan Jasa:</span>
                    <span class="badge badge-dark">${item.jasa}</span>
                </div>

                <small class="text-muted">${item.deskripsi}</small>

            </div>
        </div>
        `;
            });

            listContainer.innerHTML = html;
        }

        function setActive(index) {
            activeIndex = index;
            renderList(dataOrder); // re-render ulang

            showDetail(dataOrder[index]);
        }

        /* =========================
   EVENT (FIXED)
========================= */

        // ENTER
        inputSearch.addEventListener("keydown", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                searchData();
            }
        });

        // CLICK
        btnSearch.addEventListener("click", function(e) {
            e.preventDefault();
            searchData();
        });

        /* =========================
           SEARCH
        ========================= */
        function searchData() {
            let keyword = inputSearch.value.toLowerCase().trim();

            let hasil = dataOrder.filter(item =>
                item.nama.toLowerCase().includes(keyword) ||
                item.jasa.toLowerCase().includes(keyword) ||
                item.deskripsi.toLowerCase().includes(keyword)
            );

            renderList(hasil);
        }

        /* =========================
           LOAD AWAL
        ========================= */
        renderList(dataOrder);
    </script>

    <script>
        let originalDetail = document.getElementById("detailWrapper").innerHTML;

        function closeMessage() {
            document.getElementById("detailWrapper").innerHTML = `
        <div class="d-flex flex-column justify-content-center align-items-center text-center"
             style="height:500px; opacity:0.6;">
            
            <span class="material-icons mb-3" style="font-size:60px;">
                mail_outline
            </span>

            <h5 class="mb-1">Buka Pesanan</h5>
            <small class="text-muted">
                Pilih pesan di sebelah kiri untuk melihat detail
            </small>
        </div>
    `;
        }

        function showDetail(item) {
            document.getElementById("detailContent").innerHTML = `
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <h5>${item.nama}</h5>
                <p class="mb-2">
                    Memesan Jasa:
                    <span class="badge badge-dark">${item.jasa}</span>
                </p>

                <small class="text-muted">${item.deskripsi}</small>

            </div>
        </div>
    `;
        }
    </script>
</body>

</html>