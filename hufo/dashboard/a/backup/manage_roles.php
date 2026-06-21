<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage User Role - Dashboard | Konig Guard Bureau</title>

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
                                            <th>Cabang</th>
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

                    </div>

                    <div class="col-md-6">

                        <!-- DEPARTEMEN -->
                        <div class="form-group">
                            <label>Departemen</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">domain</span>
                                    </span>
                                </div>

                                <select id="departmentTambah" class="form-control">
                                    <option value="">Pilih Departemen</option>
                                    <option>HR</option>
                                    <option>Admin</option>
                                    <option>Akuntansi</option>
                                </select>
                            </div>
                        </div>

                        <!-- JABATAN -->
                        <div class="form-group">
                            <label>Jabatan</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">work</span>
                                    </span>
                                </div>

                                <select id="jabatanTambah" class="form-control mb-2">
                                    <option value="">Pilih Jabatan</option>
                                    <option>Manager</option>
                                    <option>Supervisor</option>
                                    <option>Staff</option>
                                </select>
                            </div>
                        </div>

                        <!-- CABANG -->
                        <div class="form-group">
                            <label>Cabang</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">location_city</span>
                                    </span>
                                </div>

                                <select id="cabangTambah" class="form-control mb-2">
                                    <option value="">Pilih Cabang</option>
                                    <option>Jakarta</option>
                                    <option>Medan</option>
                                    <option>Surabaya</option>
                                </select>
                            </div>
                        </div>

                        <!-- KTP -->
                        <div class="form-group">
                            <label>KTP</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="ktpTambah"
                                    class="form-control"
                                    placeholder="3216221235646354">
                            </div>
                        </div>

                        <!-- NPWP -->
                        <div class="form-group">
                            <label>NPWP</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="npwpTambah"
                                    class="form-control"
                                    placeholder="3216221235646354">
                            </div>
                        </div>

                        <!-- BPJS KESEHATAN -->
                        <div class="form-group">
                            <label>BPJS Kesehatan</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="bpjsTambah"
                                    class="form-control"
                                    placeholder="3216221235646354">
                            </div>
                        </div>

                        <!-- BPJS TK -->
                        <div class="form-group">
                            <label>BPJS KetenagaKerjaan</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="bpjstkTambah"
                                    class="form-control"
                                    placeholder="3216221235646354">
                            </div>
                        </div>

                        <!-- REKENING -->
                        <div class="form-group">
                            <label>Rekening (WAJIB BCA)</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="rekeningTambah"
                                    class="form-control"
                                    placeholder="3216221235646354">
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

                    </div>

                    <div class="col-md-6">


                        <!-- DEPARTEMEN -->
                        <div class="form-group">
                            <label>Departemen</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">domain</span>
                                    </span>
                                </div>

                                <select id="departmentEdit" class="form-control">
                                    <option value="">Pilih Departemen</option>
                                    <option>HR</option>
                                    <option>Admin</option>
                                    <option>Akuntansi</option>
                                </select>
                            </div>
                        </div>

                        <!-- JABATAN -->
                        <div class="form-group">
                            <label>Jabatan</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">work</span>
                                    </span>
                                </div>

                                <select id="jabatanEdit" class="form-control mb-2">
                                    <option value="">Pilih Jabatan</option>
                                    <option>Manager</option>
                                    <option>Supervisor</option>
                                    <option>Staff</option>
                                </select>
                            </div>
                        </div>

                        <!-- CABANG -->
                        <div class="form-group">
                            <label>Cabang</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">location_city</span>
                                    </span>
                                </div>

                                <select id="cabangEdit" class="form-control mb-2">
                                    <option value="">Pilih Cabang</option>
                                    <option>Jakarta</option>
                                    <option>Medan</option>
                                    <option>Surabaya</option>
                                </select>
                            </div>
                        </div>

                        <!-- KTP -->
                        <div class="form-group">
                            <label>KTP</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="ktpEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- NPWP -->
                        <div class="form-group">
                            <label>NPWP</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="npwpEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- BPJS KESEHATAN -->
                        <div class="form-group">
                            <label>BPJS Kesehatan</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="bpjsEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- BPJS TK -->
                        <div class="form-group">
                            <label>BPJS KetenagaKerjaan</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="bpjstkEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- REKENING -->
                        <div class="form-group">
                            <label>Rekening (WAJIB BCA)</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="rekeningEdit"
                                    class="form-control">
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
                                    <small>Tempat Lahir</small>
                                    <p id="viewTempatlahir"></p>
                                </div>

                                <div>
                                    <small>Tanggal Lahir</small>
                                    <p id="viewTanggalLahir"></p>
                                </div>

                                <div>
                                    <small>No. Telepon</small>
                                    <p id="viewTelepon"></p>
                                </div>

                                <div>
                                    <small>Email</small>
                                    <p id="viewEmail"></p>
                                </div>

                                <div>
                                    <small>Jenis Kelamin</small>
                                    <p id="viewGender"></p>
                                </div>

                                <div>
                                    <small>Departemen</small>
                                    <p id="viewDepartment"></p>
                                </div>

                                <div>
                                    <small>Jabatan</small>
                                    <p id="viewJabatan"></p>
                                </div>

                                <div>
                                    <small>Status</small>
                                    <p id="viewStatus"></p>
                                </div>

                                <div>
                                    <small>NPWP</small>
                                    <p id="viewNpwp"></p>
                                </div>

                                <div>
                                    <small>BPJS</small>
                                    <p id="viewBpjs"></p>
                                </div>

                                <div>
                                    <small>BPJS TK</small>
                                    <p id="viewBpjstk"></p>
                                </div>

                                <div>
                                    <small>Rekening</small>
                                    <p id="viewRekening"></p>
                                </div>

                                <div>
                                    <small>Alamat</small>
                                    <p id="viewAlamat"></p>
                                </div>

                                <div>
                                    <small>Cabang</small>
                                    <p id="viewCabang"></p>
                                </div>

                                <div>
                                    <small>No KTP</small>
                                    <p id="viewKtp"></p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- MODAL SUKSES -->
    <div class="modal fade" id="modalSuccess">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg"
                style="border-radius:22px; overflow:hidden;">

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

                    <!-- TITLE -->
                    <h3 class="font-weight-bold mb-2">
                        User Berhasil Ditambahkan
                    </h3>

                    <!-- TEXT -->
                    <p class="text-muted mb-4" id="successText">
                        Nama dan role user berhasil ditambahkan
                    </p>

                    <!-- BUTTON -->
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

    <!-- MODAL VALIDASI EDIT -->
    <div class="modal fade" id="modalEditSuccess">
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

                    <!-- TITLE -->
                    <h3 class="font-weight-bold mb-2">
                        Edit Berhasil
                    </h3>

                    <!-- TEXT -->
                    <p class="text-muted mb-4"
                        id="editSuccessText">

                        Steven berhasil di edit

                    </p>

                    <!-- BUTTON -->
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

</body>

</html>