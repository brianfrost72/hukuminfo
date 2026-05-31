<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage User Role - Dashboard | Hukuminfo.id</title>

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

    <!-- Toastr -->
    <link type="text/css"
        href="../assets/vendor/toastr.min.css"
        rel="stylesheet">
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
                                        Manage User Role
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage User Role</h1>
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
                            <h4 class="card-title">Manage Roles</h4>
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
                                            <th>Role ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="rowCheck" data-index=""></td>
                                            <td>1</td>

                                            <td>170226</td>

                                            <td class="d-flex align-items-center">
                                                <img src="../assets/images/avatars/foto-sushi-128246.jpg" alt="Photo"
                                                    class="rounded-circle mr-2" width="40" height="40"
                                                    style="object-fit:cover;">
                                                Joko Wi
                                            </td>

                                            <td>brian@gmail.com</td>
                                            <td>Pembina</td>

                                            <td>
                                                <a href="https://www.hukuminfo.id/redaksi" class="btn btn-info btn-sm">
                                                    <i class="material-icons">remove_red_eye</i>
                                                </a>
                                                <button class="btn btn-warning btn-sm" onclick="editData()">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" onclick="hapusData()">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
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

    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah User</h5>
                </div>

                <div class="modal-body row">
                    <div class="col-md-6">

                        <!-- NAMA -->
                        <div class="form-group">
                            <label>Nama Lengkap</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">person</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="namaTambah"
                                    class="form-control"
                                    placeholder="Andy Lau">
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="form-group">
                            <label>Email</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">email</span>
                                    </span>
                                </div>

                                <input type="email"
                                    id="emailTambah"
                                    class="form-control"
                                    placeholder="contoh@gmail.com">
                            </div>
                        </div>

                        <!-- PASSWORD -->
                        <div class="form-group">
                            <label>Password</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">person</span>
                                    </span>
                                </div>

                                <input type="password"
                                    id="passwordTambah"
                                    class="form-control"
                                    placeholder="Password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" onclick="togglePassword()"><span class="material-icons">remove_red_eye</span></button>
                                </div>
                            </div>
                        </div>

                        <!-- TEMPAT LAHIR -->
                        <div class="form-group">
                            <label>Tempat Lahir</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">location_city</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="tempatLahirTambah"
                                    class="form-control"
                                    placeholder="Jakarta">
                            </div>
                        </div>

                        <!-- TANGGAL LAHIR -->
                        <div class="form-group">

                            <label>Tanggal Lahir</label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">
                                            date_range
                                        </span>
                                    </span>
                                </div>

                                <input type="date"
                                    id="tanggalLahirTambah"
                                    class="form-control">

                            </div>

                            <!-- TEXT UMUR -->
                            <small id="umurText"
                                class="text-muted d-block mt-2"
                                style="
            font-size:13px;
        ">

                                Umur akan muncul di sini

                            </small>

                        </div>

                    </div>

                    <div class="col-md-6">
                        <!-- TELEPON -->
                        <div class="form-group">
                            <label>No Telp / HP</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">call</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="teleponTambah"
                                    class="form-control"
                                    placeholder="081xxxxxxxx">
                            </div>
                        </div>

                        <!-- GENDER -->
                        <div class="form-group">
                            <label>Jenis Kelamin</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">wc</span>
                                    </span>
                                </div>

                                <select id="genderTambah" class="form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <!-- STATUS -->
                        <div class="form-group">
                            <label>Status Perkawinan</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">favorite</span>
                                    </span>
                                </div>

                                <select id="statusTambah" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option>Belum Nikah</option>
                                    <option>Menikah</option>
                                </select>
                            </div>
                        </div>

                        <!-- ROLES -->
                        <div class="form-group">
                            <label>Role</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">group</span>
                                    </span>
                                </div>

                                <select id="rolesTambah" class="form-control">
                                    <option value="">Pilih Roles</option>
                                    <option>Super Admin</option>
                                    <option>Admin</option>
                                    <option>User</option>
                                </select>
                            </div>
                        </div>

                        <textarea id="alamatTambah" class="form-control mb-2" placeholder="Alamat"></textarea>

                        <input type="file" id="photoTambah" class="form-control mb-2">

                        <img id="previewPhoto" class="rounded mt-2" width="100">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="tambahData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit User</h5>
                </div>

                <div class="modal-body row">
                    <input type="hidden" id="editIndex">

                    <div class="col-md-6">

                        <!-- NAMA -->
                        <div class="form-group">
                            <label>Nama Lengkap</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">person</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="namaEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="form-group">
                            <label>Email</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">email</span>
                                    </span>
                                </div>

                                <input type="email"
                                    id="emailEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- PASSWORD -->
                        <div class="form-group">
                            <label>Password</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">person</span>
                                    </span>
                                </div>

                                <input type="password"
                                    id="passwordEdit"
                                    class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" onclick="togglePasswordEdit()"><span class="material-icons">remove_red_eye</span></button>
                                </div>
                            </div>
                        </div>

                        <!-- TEMPAT LAHIR -->
                        <div class="form-group">
                            <label>Tempat Lahir</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">location_city</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="tempatLahirEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- TANGGAL LAHIR -->
                        <div class="form-group">

                            <label>Tanggal Lahir</label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">
                                            date_range
                                        </span>
                                    </span>
                                </div>

                                <input type="date"
                                    id="tanggalLahirEdit"
                                    class="form-control">

                            </div>

                            <!-- TEXT UMUR -->
                            <small id="umurTextEdit"
                                class="text-muted d-block mt-2"
                                style="
            font-size:13px;
        ">

                                Umur akan muncul di sini

                            </small>

                        </div>

                    </div>

                    <div class="col-md-6">


                        <!-- TELEPON -->
                        <div class="form-group">
                            <label>No Telp / HP</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">call</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="teleponEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- GENDER -->
                        <div class="form-group">
                            <label>Jenis Kelamin</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">wc</span>
                                    </span>
                                </div>

                                <select id="genderEdit" class="form-control">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <!-- STATUS -->
                        <div class="form-group">
                            <label>Status Perkawinan</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">favorite</span>
                                    </span>
                                </div>

                                <select id="statusEdit" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option>Belum Nikah</option>
                                    <option>Menikah</option>
                                </select>
                            </div>
                        </div>

                        <!-- ROLES -->
                        <div class="form-group">
                            <label>Role</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">group</span>
                                    </span>
                                </div>

                                <select id="rolesEdit" class="form-control">
                                    <option value="">Pilih Roles</option>
                                    <option>Super Admin</option>
                                    <option>Admin</option>
                                    <option>User</option>
                                </select>
                            </div>
                        </div>

                        <textarea id="alamatEdit" class="form-control mb-2"></textarea>

                        <input type="file" id="photoEdit" class="form-control mb-2">

                        <img id="previewPhotoEdit" class="rounded mt-2" width="100">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success" onclick="updateData()">Update</button>
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
                        © 2026 Hukuminfo.id. All rights reserved.
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
    <script src="../assets/js/costume-dom/m.roles.js"></script>

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
    <script src="assets/js/flatpickr.js"></script>

    <!-- Global Settings -->
    <script src="../assets/js/settings.js"></script>

    <!-- Moment.js -->
    <script src="../assets/vendor/moment.min.js"></script>
    <script src="../assets/vendor/moment-range.js"></script>

    <!-- Toastr -->
    <script src="assets/vendor/toastr.min.js"></script>
    <script src="assets/js/toastr.js"></script>

</body>

</html>