<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Struktur Perusahaan - Dashboard | Konig Guard Bureau</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
                                        Manage Struktur Perusahaan
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Struktur Perusahaan</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">

                <!-- FORM -->
                <div class="card p-4 mb-4" style="border-radius:12px;">
                    <h5 class="mb-3">Form Struktur Perusahaan</h5>

                    <div class="row">
                        <!-- Departemen -->
                        <div class="col-md-6 mb-3">
                            <label>Departemen</label>
                            <select id="deptInput" class="form-control">
                                <option>Pilih Departemen</option>
                                <option>Manajemen</option>
                                <option>IT</option>
                                <option>Marketing</option>
                            </select>
                        </div>

                        <!-- Jabatan -->
                        <div class="col-md-6 mb-3">
                            <label>Jabatan</label>
                            <select id="jabatanInput" class="form-control">
                                <option>Pilih Jabatan</option>
                                <option>Direktur</option>
                                <option>Manager</option>
                                <option>Staff</option>
                            </select>
                        </div>

                        <!-- Nama -->
                        <div class="col-md-6 mb-3">
                            <label>Nama</label>
                            <input type="text" id="namaInput" class="form-control" placeholder="Masukkan nama">
                        </div>

                        <!-- Social Media -->
                        <div class="col-md-6 mb-3">
                            <label>Social Media</label>
                            <div class="d-flex">
                                <input type="text" id="socialInput" class="form-control" placeholder="@username / link">

                                <select id="platformSelect" class="form-control ml-2" style="max-width:150px;">
                                    <option value="instagram">Instagram</option>
                                    <option value="tiktok">TikTok</option>
                                    <option value="linkedin">LinkedIn</option>
                                    <option value="other">Lainnya</option>
                                </select>

                                <button onclick="addSocial()" class="btn ml-2" style="background:var(--primary); color:white;">
                                    <span class="material-icons" style="font-size:18px;">add</span>
                                </button>
                            </div>

                            <!-- LIST SOCIAL -->
                            <div id="socialList" class="mt-2"></div>
                        </div>

                        <!-- Upload -->
                        <div class="col-md-12 mb-3">
                            <label>Upload Gambar</label>

                            <div id="uploadBox" style="
        border:2px dashed var(--light-gray);
        border-radius:10px;
        padding:30px;
        text-align:center;
        background:#fafbfe;
        cursor:pointer;
    ">
                                <span class="material-icons" style="font-size:40px; color:var(--primary);">
                                    cloud_upload
                                </span>
                                <p class="mb-0">Klik atau drag gambar</p>

                                <!-- preview -->
                                <img id="previewImage" style="max-width:120px; display:none; margin-top:10px; border-radius:8px;">
                            </div>

                            <!-- hidden input -->
                            <input type="file" id="fileInput" accept="image/*" style="display:none;">
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <div class="text-right">
                        <button onclick="resetForm()" class="btn mr-2" style="border:1px solid #ddd;">Reset</button>
                        <button onclick="saveData()" class="btn" style="background:var(--primary); color:white;">Simpan</button>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="card p-4" style="border-radius:12px;">
                    <h5 class="mb-3">Daftar Struktur</h5>

                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

                        <!-- LEFT -->
                        <div class="d-flex align-items-center">
                            <label class="mr-2 mb-0">Show</label>
                            <select id="showEntries" class="form-control form-control-sm mr-3" style="width:80px;">
                                <option>5</option>
                                <option>10</option>
                                <option>25</option>
                            </select>

                            <!-- Filter Departemen -->
                            <select id="filterDept" class="form-control form-control-sm mr-2">
                                <option value="">Semua Departemen</option>
                            </select>

                            <!-- Filter Jabatan -->
                            <select id="filterJabatan" class="form-control form-control-sm">
                                <option value="">Semua Jabatan</option>
                            </select>
                        </div>

                        <!-- RIGHT -->
                        <div>
                            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search..." style="width:200px;">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Departemen</th>
                                    <th>Jabatan</th>
                                    <th>Nama</th>
                                    <th>Social Media</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small id="infoText"></small>
                            <div id="pagination" class="d-flex"></div>
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

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0" style="border-radius:18px; overflow:hidden;">

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
                    <h4 class="font-weight-bold mb-2" id="modalTitle">
                        Berhasil
                    </h4>

                    <!-- TEXT -->
                    <p class="text-muted mb-4" id="modalText">
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
        let socials = [];

        function getIcon(platform) {
            switch (platform) {
                case "instagram":
                    return '<i class="fab fa-instagram" style="color:#E4405F;"></i>';
                case "tiktok":
                    return '<i class="fab fa-tiktok"></i>';
                case "linkedin":
                    return '<i class="fab fa-linkedin" style="color:#0A66C2;"></i>';
                default:
                    return '<i class="fas fa-globe"></i>';
            }
        }

        function addSocial() {
            let input = document.getElementById("socialInput");
            let platform = document.getElementById("platformSelect").value;

            if (input.value.trim() === "") return;

            socials.push({
                name: input.value,
                platform: platform
            });

            input.value = "";
            renderSocial();
        }

        function renderSocial() {
            let container = document.getElementById("socialList");
            container.innerHTML = "";

            socials.forEach((item, index) => {
                container.innerHTML += `
            <div class="d-flex justify-content-between align-items-center mb-2 p-2"
                 style="border:1px solid var(--light-gray); border-radius:8px;">

                <div class="d-flex align-items-center">
                    ${getIcon(item.platform)}
                    <span class="ml-2">${item.name}</span>
                </div>

                <button onclick="removeSocial(${index})"
                        class="btn btn-sm"
                        style="color:var(--danger);">
                    <span class="material-icons" style="font-size:16px;">delete</span>
                </button>
            </div>
        `;
            });
        }

        function removeSocial(index) {
            socials.splice(index, 1);
            renderSocial();
        }
    </script>

    <script>
        let selectedFile = null;

        const uploadBox = document.getElementById("uploadBox");
        const fileInput = document.getElementById("fileInput");
        const preview = document.getElementById("previewImage");

        // klik box = buka file
        uploadBox.addEventListener("click", () => fileInput.click());

        // pilih file
        fileInput.addEventListener("change", function() {
            handleFile(this.files[0]);
        });

        // drag over
        uploadBox.addEventListener("dragover", (e) => {
            e.preventDefault();
            uploadBox.style.borderColor = "var(--primary)";
        });

        // drag leave
        uploadBox.addEventListener("dragleave", () => {
            uploadBox.style.borderColor = "var(--light-gray)";
        });

        // drop file
        uploadBox.addEventListener("drop", (e) => {
            e.preventDefault();
            uploadBox.style.borderColor = "var(--light-gray)";
            const file = e.dataTransfer.files[0];
            handleFile(file);
        });

        // handle file
        function handleFile(file) {
            if (!file) return;

            // validasi tipe
            if (!file.type.startsWith("image/")) {
                alert("File harus berupa gambar!");
                return;
            }

            selectedFile = file;

            // preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    </script>

    <script>
        let data = [{
                dept: "IT",
                jabatan: "Developer",
                nama: "Brian",
                social: [{
                    name: "@brian.dev",
                    platform: "instagram"
                }],
                img: "assets/images/avatars/avatar-1.jpg"
            },
            {
                dept: "Marketing",
                jabatan: "Manager",
                nama: "Siti",
                social: [{
                    name: "@siti.mkt",
                    platform: "instagram"
                }],
                img: "assets/images/avatars/avatar-2.jpg"
            }
        ];

        let currentPage = 1;

        function initFilter() {
            let deptSet = new Set();
            let jabatanSet = new Set();

            data.forEach(d => {
                deptSet.add(d.dept);
                jabatanSet.add(d.jabatan);
            });

            let deptSelect = document.getElementById("filterDept");
            let jabatanSelect = document.getElementById("filterJabatan");

            deptSet.forEach(d => deptSelect.innerHTML += `<option value="${d}">${d}</option>`);
            jabatanSet.forEach(j => jabatanSelect.innerHTML += `<option value="${j}">${j}</option>`);
        }

        function renderTable() {
            let tbody = document.getElementById("tableBody");
            tbody.innerHTML = "";

            let search = document.getElementById("searchInput").value.toLowerCase();
            let deptFilter = document.getElementById("filterDept").value;
            let jabatanFilter = document.getElementById("filterJabatan").value;
            let show = parseInt(document.getElementById("showEntries").value);

            let filtered = data.filter(d =>
                (d.nama.toLowerCase().includes(search) ||
                    d.dept.toLowerCase().includes(search) ||
                    d.jabatan.toLowerCase().includes(search)) &&
                (deptFilter === "" || d.dept === deptFilter) &&
                (jabatanFilter === "" || d.jabatan === jabatanFilter)
            );

            let totalPages = Math.ceil(filtered.length / show);
            if (currentPage > totalPages) currentPage = 1;

            let start = (currentPage - 1) * show;
            let paginated = filtered.slice(start, start + show);

            paginated.forEach((d, i) => {
                tbody.innerHTML += `
        <tr>
            <td>${start + i + 1}</td>
            <td>${d.dept}</td>
            <td>${d.jabatan}</td>
            <td>${d.nama}</td>
            <td>
    ${d.social.map(s => `
        <div class="d-flex align-items-center">
            ${getIcon(s.platform)}
            <small class="ml-1">${s.name}</small>
        </div>
    `).join("")}
</td>
            <td><img src="${d.img}" width="40" style="border-radius:8px;"></td>
            <td>
                <button  onclick="toggleView(${start+i})" class="btn btn-sm mr-1" style="border:1px solid var(--primary); color:var(--primary);">
                    <span class="material-icons" style="font-size:16px;">visibility</span>
                </button>
                <button onclick="deleteData(${start+i})" class="btn btn-sm" style="border:1px solid var(--danger); color:var(--danger);">
                    <span class="material-icons" style="font-size:16px;">delete</span>
                </button>
            </td>
        <tr id="view-${start+i}" style="display:none;">
<td colspan="7">
<div style="
    background:#f8f9ff;
    padding:15px;
    border-radius:10px;
    border:1px solid var(--light-gray);
">

<div class="row">

<!-- Departemen -->
<div class="col-md-3">
<label>Departemen</label>
<select class="form-control form-control-sm" id="dept-${start+i}" disabled>
    <option ${d.dept=="IT"?"selected":""}>IT</option>
    <option ${d.dept=="Marketing"?"selected":""}>Marketing</option>
    <option ${d.dept=="HR"?"selected":""}>HR</option>
    <option ${d.dept=="Finance"?"selected":""}>Finance</option>
</select>
</div>

<!-- Jabatan -->
<div class="col-md-3">
<label>Jabatan</label>
<select class="form-control form-control-sm" id="jabatan-${start+i}" disabled>
    <option ${d.jabatan=="Developer"?"selected":""}>Developer</option>
    <option ${d.jabatan=="Manager"?"selected":""}>Manager</option>
    <option ${d.jabatan=="Staff"?"selected":""}>Staff</option>
    <option ${d.jabatan=="Support"?"selected":""}>Support</option>
</select>
</div>

<!-- Nama -->
<div class="col-md-3">
<label>Nama</label>
<input type="text" class="form-control form-control-sm"
id="nama-${start+i}" value="${d.nama}" disabled>
</div>

<!-- Social Media -->
<div class="col-md-3">
<label>Social Media</label>

<div class="d-flex mb-1">
    <input type="text" class="form-control form-control-sm"
        id="socialInput-${start+i}" placeholder="@username" disabled>

    <select id="platform-${start+i}" class="form-control form-control-sm ml-1" disabled>
        <option value="instagram">IG</option>
        <option value="tiktok">TT</option>
        <option value="linkedin">IN</option>
    </select>

    <button onclick="addSocialEdit(${start+i})"
        class="btn btn-sm ml-1"
        style="background:var(--primary); color:white;" disabled>
        +
    </button>
</div>

<div id="socialList-${start+i}">
    ${renderSocialHTML(d.social)}
</div>

</div>

<!-- GAMBAR -->
<div class="col-md-6 mt-2">
<label>Gambar</label>

<div class="d-flex align-items-center">
    <img src="${d.img}" width="50" style="border-radius:8px;">

    <span class="material-icons mx-2">arrow_forward</span>

    <img id="preview-${start+i}" src="${d.img}" width="50" style="border-radius:8px;">
</div>

<input type="file" id="file-${start+i}" style="display:none;">
<button onclick="selectImage(${start+i})"
    class="btn btn-sm mt-2"
    style="border:1px solid var(--primary); color:var(--primary);" disabled>
    Ganti Gambar
</button>
</div>

<!-- BUTTON -->
<div class="col-md-6 mt-4 text-right">
    <button onclick="toggleEdit(${start+i})"
        id="editBtn-${start+i}"
        class="btn btn-sm"
        style="border:1px solid var(--primary); color:var(--primary);">
        Edit
    </button>

    <button onclick="cancelEdit(${start+i})"
        id="cancelBtn-${start+i}"
        class="btn btn-sm"
        style="display:none; border:1px solid #ccc;">
        Batal
    </button>
</div>

</div>
</div>
</td>
</tr>`;
            });

            renderPagination(totalPages);
            renderInfo(filtered.length, start, show);
        }

        function renderSocialHTML(socials, index) {
            if (!socials || socials.length === 0) return "";

            return socials.map((s, i) => `
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div class="d-flex align-items-center">
                ${getIcon(s.platform)}
                <small class="ml-2">${s.name}</small>
            </div>

            <button onclick="removeSocialEdit(${index}, ${i})"
                class="btn btn-sm p-0"
                style="color:var(--danger);">
                <span class="material-icons" style="font-size:16px;">close</span>
            </button>
        </div>
    `).join("");
        }

        function removeSocialEdit(rowIndex, socialIndex) {
            // hapus dari data asli
            data[rowIndex].social.splice(socialIndex, 1);

            // re-render hanya bagian social (biar ringan)
            document.getElementById(`socialList-${rowIndex}`).innerHTML =
                renderSocialHTML(data[rowIndex].social, rowIndex);
        }

        function addSocialEdit(index) {
            let input = document.getElementById(`socialInput-${index}`);
            let platform = document.getElementById(`platform-${index}`);

            if (input.disabled || input.value.trim() === "") return;

            // simpan ke data
            data[index].social.push({
                name: input.value,
                platform: platform.value
            });

            // render ulang
            document.getElementById(`socialList-${index}`).innerHTML =
                renderSocialHTML(data[index].social, index);

            input.value = "";
        }

        function selectImage(index) {
            let fileInput = document.getElementById(`file-${index}`);
            fileInput.click();

            fileInput.onchange = function() {
                let file = this.files[0];
                if (!file) return;

                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(`preview-${index}`).src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function renderPagination(totalPages) {
            let container = document.getElementById("pagination");
            container.innerHTML = "";

            let maxVisible = 5;

            let start = Math.max(1, currentPage - 2);
            let end = Math.min(totalPages, start + maxVisible - 1);

            if (start > 1) {
                container.innerHTML += `<button class="btn btn-sm mr-1" onclick="changePage(1)">1</button>`;
                if (start > 2) container.innerHTML += `<span class="mr-1">...</span>`;
            }

            for (let i = start; i <= end; i++) {
                container.innerHTML += `
            <button class="btn btn-sm mr-1 ${i===currentPage?'btn-primary':''}" 
                onclick="changePage(${i})">${i}</button>`;
            }

            if (end < totalPages) {
                if (end < totalPages - 1) container.innerHTML += `<span class="mr-1">...</span>`;
                container.innerHTML += `<button class="btn btn-sm" onclick="changePage(${totalPages})">${totalPages}</button>`;
            }
        }

        function renderInfo(total, start, show) {
            let text = document.getElementById("infoText");
            let end = Math.min(start + show, total);
            text.innerHTML = `Menampilkan ${start+1} - ${end} dari ${total} data`;
        }

        function changePage(page) {
            currentPage = page;
            renderTable();
        }

        function deleteData(index) {
            let confirmDelete = confirm("Yakin ingin menghapus data ini?");

            if (!confirmDelete) return;

            data.splice(index, 1);

            // reset halaman kalau data habis di page terakhir
            let show = parseInt(document.getElementById("showEntries").value);
            let totalPages = Math.ceil(data.length / show);

            if (currentPage > totalPages) currentPage = totalPages || 1;

            renderTable();
        }

        /* EVENT */
        document.getElementById("searchInput").addEventListener("input", () => {
            currentPage = 1;
            renderTable();
        });
        document.getElementById("filterDept").addEventListener("change", renderTable);
        document.getElementById("filterJabatan").addEventListener("change", renderTable);
        document.getElementById("showEntries").addEventListener("change", renderTable);

        /* INIT */
        initFilter();
        renderTable();
    </script>

    <script>
        function saveData() {
            let dept = document.getElementById("deptInput").value;
            let jabatan = document.getElementById("jabatanInput").value;
            let nama = document.getElementById("namaInput").value;

            if (dept === "Pilih Departemen" || jabatan === "Pilih Jabatan" || nama.trim() === "") {
                alert("Lengkapi semua field!");
                return;
            }

            // SOCIAL
            let socialData = socials.map(s => ({
                name: s.name,
                platform: s.platform
            }));

            // GAMBAR
            let imgPath = "assets/images/default.png";

            if (selectedFile) {
                imgPath = URL.createObjectURL(selectedFile);
            }

            // PUSH DATA
            data.push({
                dept,
                jabatan,
                nama,
                social: socialData,
                img: imgPath
            });

            // RESET
            resetForm();

            // REFRESH
            renderTable();

            // MODAL TAMBAH
            document.getElementById("modalTitle").innerText = "Tambah Berhasil";
            document.getElementById("modalText").innerHTML =
                `<b>${nama}</b> berhasil ditambahkan`;

            $('#successModal').modal('show');
        }
    </script>

    <script>
        function resetForm() {
            document.getElementById("deptInput").selectedIndex = 0;
            document.getElementById("jabatanInput").selectedIndex = 0;
            document.getElementById("namaInput").value = "";

            socials = [];
            renderSocial();

            selectedFile = null;
            document.getElementById("previewImage").style.display = "none";
        }
    </script>

    <script>
        // toggle buka tutup detail
        function toggleView(index) {
            let row = document.getElementById(`view-${index}`);

            if (row.style.display === "none") {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        }

        // toggle edit → simpan
        function toggleEdit(index) {

            let isEdit = document.getElementById(`nama-${index}`).disabled;

            let fields = [
                `dept-${index}`,
                `jabatan-${index}`,
                `nama-${index}`,
                `socialInput-${index}`,
                `platform-${index}`
            ];

            fields.forEach(id => {
                document.getElementById(id).disabled = !isEdit;
            });

            document.querySelector(`[onclick="addSocialEdit(${index})"]`).disabled = !isEdit;
            document.querySelector(`[onclick="selectImage(${index})"]`).disabled = !isEdit;

            let btn = document.getElementById(`editBtn-${index}`);
            let cancelBtn = document.getElementById(`cancelBtn-${index}`);

            if (isEdit) {

                btn.innerText = "Simpan";
                btn.style.background = "var(--primary)";
                btn.style.color = "white";

                cancelBtn.style.display = "inline-block";

            } else {

                // SIMPAN DATA
                data[index].dept = document.getElementById(`dept-${index}`).value;
                data[index].jabatan = document.getElementById(`jabatan-${index}`).value;
                data[index].nama = document.getElementById(`nama-${index}`).value;

                let nama = data[index].nama;

                btn.innerText = "Edit";
                btn.style.background = "transparent";
                btn.style.color = "var(--primary)";

                cancelBtn.style.display = "none";

                renderTable();

                // MODAL EDIT
                document.getElementById("modalTitle").innerText = "Edit Berhasil";
                document.getElementById("modalText").innerHTML =
                    `<b>${nama}</b> berhasil di edit`;

                $('#successModal').modal('show');
            }
        }

        // batal edit
        function cancelEdit(index) {
            renderTable();
        }
    </script>
</body>

</html>