<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Klien Korporat - Dashboard | Konig Guard Bureau</title>

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
                                        Manage Klien Korporat
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Klien Korporat</h1>
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
                            <h4 class="card-title">Manage Klien Korporat</h4>
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
                                            <th>No.</th>
                                            <th>ID Klien</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Tlp</th>
                                            <th>Status</th>
                                            <th>Dibuat Pada</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody"></tbody>
                                </table>
                            </div>

                            <!-- PAGINATION -->
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-danger" id="inactiveSelected">Non Aktifkan Terpilih</button>
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

    <div class="modal fade" id="modalView">
        <div class="modal-dialog modal-md">
            <div class="modal-content border-0">

                <div class="modal-body p-0">

                    <!-- LOADING -->
                    <div id="loadingView" class="text-center p-5">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-2">Loading profile...</p>
                    </div>

                    <!-- PROFILE -->
                    <div id="contentView" style="display:none;">

                        <!-- HEADER COVER -->
                        <div class="profile-cover">
                            <div class="avatar-wrapper">
                                <img id="viewPhoto" class="profile-avatar">
                            </div>
                        </div>

                        <!-- BODY -->
                        <div class="profile-body text-center">

                            <!-- NAME -->
                            <h4 id="viewNama" class="mt-2 mb-1"></h4>
                            <span id="viewRoles" class="badge badge-pill badge-primary px-3 py-1"></span>

                            <!-- INFO GRID -->
                            <div class="profile-grid mt-4">

                                <div>
                                    <small>ID Klien</small>
                                    <p id="viewClientID"></p>
                                </div>

                                <div>
                                    <small>PIC</small>
                                    <p id="viewPic"></p>
                                </div>

                                <div>
                                    <small>No. Telepon PIC</small>
                                    <p id="viewPictelepon"></p>
                                </div>

                                <div>
                                    <small>Email Perusahaan</small>
                                    <p id="viewEmailcorporate"></p>
                                </div>

                                <div>
                                    <small>No. Telepon Perusahaan</small>
                                    <p id="viewTeleponCorporate"></p>
                                </div>

                                <div>
                                    <small>NPWP</small>
                                    <p id="viewNpwp"></p>
                                </div>

                                <div>
                                    <small>Instagram</small>
                                    <p id="viewIg"></p>
                                </div>

                                <div>
                                    <small>Facebook</small>
                                    <p id="viewFb"></p>
                                </div>

                                <div>
                                    <small>LinkedIn</small>
                                    <p id="viewLinkedIn"></p>
                                </div>

                                <div>
                                    <small>Link Perusahaan</small>
                                    <p id="viewCorporateLink"></p>
                                </div>

                                <div>
                                    <small>Alamat</small>
                                    <p id="viewAlamat"></p>
                                </div>
                            </div>

                        </div>

                    </div>

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
        let data = [{
                clientID: "C0001",
                nama: "PT. BRIAN CORPORATE",
                pic: "Peter",
                picTelepon: "081234567891",
                email: "brian@mail.com",
                telepon: "081234567890",
                npwp: "1234567890",
                instagram: "@brian72",
                facebook: "brian72",
                linkedin: "brian72",
                corporatelink: "www.wow.com",
                status: "Aktif",
                tanggal: "10/05/2026"
            },
            {
                clientID: "C0002",
                nama: "PT. Steven CORPORATE",
                pic: "Steven",
                picTelepon: "081234567891",
                email: "steven@mail.com",
                telepon: "081234567891",
                npwp: "1234567890",
                instagram: "@steven72",
                facebook: "steven72",
                linkedin: "steven72",
                corporatelink: "www.wow.com",
                status: "Aktif",
                tanggal: "10/05/2026"
            
            }
        ];

        let currentPage = 1;
        let rowsPerPage = 5;

        function renderTable() {
            let tbody = document.getElementById("tableBody");
            tbody.innerHTML = "";

            let search = document.getElementById("searchInput").value.toLowerCase();

            let filtered = data.filter(d =>
                d.nama.toLowerCase().includes(search) ||
                d.email.toLowerCase().includes(search) ||
                d.no_tlp.toLowerCase().includes(search)
            );

            let start = (currentPage - 1) * rowsPerPage;
            let paginated = filtered.slice(start, start + rowsPerPage);

            paginated.forEach((item, index) => {
                tbody.innerHTML += `
<tr>
    <td><input type="checkbox" class="rowCheck" data-index="${start + index}"></td>
    <td>${start + index + 1}</td>

    <td>${item.clientID}</td>

    <td class="d-flex align-items-center">
        <img src="${item.photo || 'assets/images/avatars/foto-sushi-128246.jpg'}" alt="Photo"
             class="rounded-circle mr-2" width="40" height="40"
             style="object-fit:cover;">
        ${item.nama}
    </td>

    <td>${item.email}</td>
    <td>${item.telepon}</td>
    <td>
        <span class="badge ${item.status === 'Aktif' ? 'bg-success' : 'bg-secondary'}">
            ${item.status || 'Aktif'}
        </span>
    </td>

    <td>${item.tanggal}</td>

    <td>
        <button class="btn btn-info btn-sm" onclick="viewData(${start + index})">
            <i class="material-icons">remove_red_eye</i>
        </button>

        <select class="form-control form-control-sm d-inline w-auto"
                onchange="changeStatus(${start + index}, this.value)">
            <option value="Aktif" ${item.status === 'Aktif' ? 'selected' : ''}>Aktif</option>
            <option value="Nonaktif" ${item.status === 'Nonaktif' ? 'selected' : ''}>Nonaktif</option>
        </select>
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

        function changeStatus(index, value) {

            // Validasi index
            if (index === undefined || !data[index]) {
                console.error("Index tidak valid:", index);
                alert("Data tidak ditemukan!");
                return;
            }

            // Validasi value
            const allowedStatus = ["Aktif", "Nonaktif"];
            if (!allowedStatus.includes(value)) {
                console.error("Status tidak valid:", value);
                alert("Status tidak valid!");
                return;
            }

            // Kalau status sama, skip
            if (data[index].status === value) {
                return;
            }

            // Konfirmasi user
            let confirmMsg = value === "Nonaktif" ?
                "Yakin ingin menonaktifkan klien ini?" :
                "Aktifkan kembali klien ini?";

            if (!confirm(confirmMsg)) {
                renderTable(); // balikin dropdown ke semula
                return;
            }

            // Update status
            data[index].status = value;

            // Render ulang
            renderTable();
        }


        document.getElementById("inactiveSelected").onclick = function() {
            let checks = document.querySelectorAll(".rowCheck:checked");

            if (checks.length === 0) {
                alert("Pilih data dulu!");
                return;
            }

            if (confirm("Nonaktifkan data terpilih?")) {
                checks.forEach(c => {
                    let index = c.dataset.index;
                    data[index].status = "Nonaktif";
                });

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

    <script>
        function viewData(index) {
            $('#modalView').modal('show');

            document.getElementById("loadingView").style.display = "block";
            document.getElementById("contentView").style.display = "none";

            setTimeout(() => {
                let user = data[index];

                document.getElementById("viewPhoto").src = user.photo || 'assets/images/avatars/foto-sushi-128246.jpg';
                document.getElementById("viewClientID").innerText = user.clientID;
                document.getElementById("viewPic").innerText = user.pic;
                document.getElementById("viewPictelepon").innerText = user.picTelepon;
                document.getElementById("viewNama").innerText = user.nama;
                document.getElementById("viewEmailcorporate").innerText = user.email;
                document.getElementById("viewTeleponCorporate").innerText = user.telepon || '-';
                document.getElementById("viewNpwp").innerText = user.npwp || '-';
                document.getElementById("viewIg").innerText = user.instagram || '-';
                document.getElementById("viewFb").innerText = user.facebook || '-';
                document.getElementById("viewLinkedIn").innerText = user.linkedin || '-';
                document.getElementById("viewCorporateLink").innerText = user.corporatelink || '-';
                document.getElementById("viewAlamat").innerText = user.alamat || '-';

                let cover = user.cover || "https://images.unsplash.com/photo-1496307042754-b4aa456c4a2d";

                document.querySelector(".profile-cover").style.backgroundImage = `url('${cover}')`;

                document.getElementById("loadingView").style.display = "none";
                document.getElementById("contentView").style.display = "block";
            }, 600);
        }
    </script>

    <script>
        // TIDAK AUTO FILL SEARCH INPUT OLEH BROWSER
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.getElementById("searchInput");

            // kosongkan paksa
            input.value = "";

            // trick supaya chrome gak inject value
            input.setAttribute("readonly", true);

            setTimeout(() => {
                input.removeAttribute("readonly");
            }, 100);
        });
    </script>

    <script>
        function generateClientId(index) {
            let now = new Date();

            let year = now.getFullYear().toString().slice(-2); // 26
            let day = String(now.getDate()).padStart(2, '0'); // 05
            let month = String(now.getMonth() + 1).padStart(2, '0'); // 12

            let urut = index + 1;

            return `PRS${year}${day}${month}${urut}`;
        }
    </script>
</body>

</html>