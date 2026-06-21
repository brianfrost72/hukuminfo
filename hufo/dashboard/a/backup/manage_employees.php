<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manage Personel - Dashboard | Konig Guard Bureau</title>

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
                                        Manage Personel
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Personel</h1>
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
                            <h4 class="card-title">Manage Personel</h4>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah</button>
                        </div>

                        <div class="card-body">
                            <!-- FILTER -->
                            <div class="row align-items-end mb-4">

                                <!-- SHOW ENTRIES -->
                                <div class="col-lg-2 col-md-3 mb-2">
                                    <label class="small text-muted d-block mb-1">
                                        Show Entries
                                    </label>

                                    <select id="showEntries" class="form-control">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>20</option>
                                    </select>
                                </div>

                                <!-- FILTER DEPARTEMEN -->
                                <div class="col-lg-2 col-md-3 mb-2">
                                    <label class="small text-muted d-block mb-1">
                                        Departemen
                                    </label>

                                    <select id="filterDepartment" class="form-control">
                                        <option value="">Semua</option>
                                        <option>HR</option>
                                        <option>Admin</option>
                                        <option>IT</option>
                                        <option>Akuntansi</option>
                                    </select>
                                </div>

                                <!-- FILTER JABATAN -->
                                <div class="col-lg-2 col-md-3 mb-2">
                                    <label class="small text-muted d-block mb-1">
                                        Jabatan
                                    </label>

                                    <select id="filterJabatan" class="form-control">
                                        <option value="">Semua</option>
                                        <option>Manager</option>
                                        <option>Supervisor</option>
                                        <option>Staff</option>
                                        <option>Admin</option>
                                    </select>
                                </div>

                                <!-- FILTER GENDER -->
                                <div class="col-lg-2 col-md-3 mb-2">
                                    <label class="small text-muted d-block mb-1">
                                        Jenis Kelamin
                                    </label>

                                    <select id="filterGender" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                    </select>
                                </div>

                                <!-- SEARCH -->
                                <div class="col-lg-4 col-md-12 mb-2">
                                    <label class="small text-muted d-block mb-1">
                                        Search
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light">
                                                <span class="material-icons">search</span>
                                            </span>
                                        </div>

                                        <input type="text"
                                            id="searchInput"
                                            class="form-control"
                                            placeholder="Cari personel...">
                                    </div>
                                </div>

                            </div>

                            <!-- TABLE -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkAll"></th>
                                            <th>No</th>
                                            <th>NIK Karyawan</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin (L/P)</th>
                                            <th>Departemen</th>
                                            <th>Jabatan</th>
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
                    <h5>Tambah Personel</h5>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- LEFT -->
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
                                        placeholder="email@gmail.com">
                                </div>
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

                                    <select id="jabatanTambah" class="form-control">
                                        <option value="">Pilih Jabatan</option>
                                        <option>Manager</option>
                                        <option>Supervisor</option>
                                        <option>Staff</option>
                                    </select>
                                </div>
                            </div>

                            <!-- KTP -->
                            <div class="form-group">
                                <label>Nomor KTP</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <span class="material-icons">credit_card</span>
                                        </span>
                                    </div>

                                    <input type="text"
                                        id="ktpTambah"
                                        class="form-control"
                                        placeholder="Nomor KTP">
                                </div>
                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-md-6">

                            <!-- NPWP -->
                            <div class="form-group">
                                <label>Nomor NPWP</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <span class="material-icons">credit_card</span>
                                        </span>
                                    </div>

                                    <input type="text"
                                        id="npwpTambah"
                                        class="form-control"
                                        placeholder="Nomor NPWP">
                                </div>
                            </div>

                            <!-- BPJS KESEHATAN -->
                            <div class="form-group">
                                <label>Nomor BPJS Kesehatan</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <span class="material-icons">credit_card</span>
                                        </span>
                                    </div>

                                    <input type="text"
                                        id="bpjsTambah"
                                        class="form-control"
                                        placeholder="Nomor BPJS Kesehatan">
                                </div>
                            </div>

                            <!-- BPJS TK -->
                            <div class="form-group">
                                <label>Nomor BPJS KetenagaKerjaan</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <span class="material-icons">credit_card</span>
                                        </span>
                                    </div>

                                    <input type="text"
                                        id="bpjsTKTambah"
                                        class="form-control"
                                        placeholder="Nomor BPJS TK">
                                </div>
                            </div>

                            <!-- KTA -->
                            <div class="form-group">
                                <label>Nomor KTA Petugas</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <span class="material-icons">assignment_ind</span>
                                        </span>
                                    </div>

                                    <input type="text"
                                        id="ktaTambah"
                                        class="form-control"
                                        placeholder="Nomor KTA">
                                </div>
                            </div>

                            <!-- NO. REKENING -->
                            <div class="form-group">
                                <label>No Rekening</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <span class="material-icons">account_balance</span>
                                        </span>
                                    </div>

                                    <input type="text"
                                        id="rekeningTambah"
                                        class="form-control"
                                        placeholder="BCA 123456789">
                                </div>
                            </div>

                            <!-- ALAMAT -->
                            <div class="form-group">
                                <label>Alamat</label>

                                <div class="input-group">
                                    <div class="input-group-prepend align-items-stretch">
                                        <span class="input-group-text bg-light">
                                            <span class="material-icons">home</span>
                                        </span>
                                    </div>

                                    <textarea id="alamatTambah"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Masukkan alamat lengkap"></textarea>
                                </div>
                            </div>

                            <!-- FOTO -->
                            <div class="form-group">
                                <label>Upload Foto</label>

                                <div class="custom-file">
                                    <input type="file"
                                        id="photoTambah"
                                        class="custom-file-input">

                                    <label class="custom-file-label">
                                        Pilih Foto
                                    </label>
                                </div>
                            </div>

                            <!-- PREVIEW -->
                            <div class="mt-4 text-center">

                                <img id="previewPhoto"
                                    src=""
                                    class="rounded-circle shadow-sm border"
                                    style="
                        width:120px;
                        height:120px;
                        object-fit:cover;
                    ">

                            </div>

                        </div>

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
                    <h5>Edit Personel</h5>
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

                                <select id="jabatanEdit" class="form-control">
                                    <option value="">Pilih Jabatan</option>
                                    <option>Manager</option>
                                    <option>Supervisor</option>
                                    <option>Staff</option>
                                </select>
                            </div>
                        </div>

                        <!-- KTP -->
                        <div class="form-group">
                            <label>Nomor KTP</label>

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
                    </div>

                    <div class="col-md-6">

                        <!-- NPWP -->
                        <div class="form-group">
                            <label>Nomor NPWP</label>

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
                            <label>Nomor BPJS Kesehatan</label>

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
                            <label>Nomor BPJS KetenagaKerjaan</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">credit_card</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="bpjsTKEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- KTA -->
                        <div class="form-group">
                            <label>Nomor KTA Petugas</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">assignment_ind</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="ktaEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- REKENING -->
                        <div class="form-group">
                            <label>No Rekening</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">account_balance</span>
                                    </span>
                                </div>

                                <input type="text"
                                    id="rekeningEdit"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- ALAMAT -->
                        <div class="form-group">
                            <label>Alamat</label>

                            <div class="input-group">
                                <div class="input-group-prepend align-items-stretch">
                                    <span class="input-group-text bg-light">
                                        <span class="material-icons">home</span>
                                    </span>
                                </div>

                                <textarea id="alamatEdit"
                                    class="form-control"
                                    rows="5"></textarea>
                            </div>
                        </div>

                        <!-- FOTO -->
                        <div class="form-group">
                            <label>Upload Foto</label>

                            <div class="custom-file">
                                <input type="file"
                                    id="photoEdit"
                                    class="custom-file-input">

                                <label class="custom-file-label">
                                    Pilih Foto
                                </label>
                            </div>
                        </div>

                        <!-- PREVIEW -->
                        <div class="mt-4 text-center">

                            <img id="previewPhotoEdit"
                                src=""
                                class="rounded-circle shadow-sm border"
                                style="
                        width:120px;
                        height:120px;
                        object-fit:cover;
                    ">

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success" onclick="updateData()">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ------------------------------------- MODAL VIEW ------------------------------------- -->
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

                            <!-- AVATAR -->
                            <!-- <img id="viewPhoto" class="profile-avatar"> -->

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
                                    <p id="viewTanggallahir"></p>
                                </div>

                                <div>
                                    <small>Email</small>
                                    <p id="viewEmail"></p>
                                </div>

                                <div>
                                    <small>No. Telepon/HP</small>
                                    <p id="viewTelp"></p>
                                </div>

                                <div>
                                    <small>Status</small>
                                    <p id="viewStatus"></p>
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
                                    <small>Jenis Kelamin</small>
                                    <p id="viewGender"></p>
                                </div>

                                <div>
                                    <small>Alamat</small>
                                    <p id="viewAlamat"></p>
                                </div>

                                <div>
                                    <small>No. KTP</small>
                                    <p id="viewKtp"></p>
                                </div>

                                <div>
                                    <small>No. KTA</small>
                                    <p id="viewKta"></p>
                                </div>

                                <div>
                                    <small>No. NPWP</small>
                                    <p id="viewNpwp"></p>
                                </div>

                                <div>
                                    <small>No. BPJS Kesehatan</small>
                                    <p id="viewBpjs"></p>
                                </div>

                                <div>
                                    <small>No. BPJS TK</small>
                                    <p id="viewBpjsTK"></p>
                                </div>

                                <div>
                                    <small>No. Rekening</small>
                                    <p id="viewRekening"></p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- MODAL VALIDASI -->
    <div class="modal fade" id="modalValidasi">
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
                        width:90px;
                        height:90px;
                        border-radius:50%;
                        background:#fff4e5;
                    ">

                        <span class="material-icons"
                            style="
                            font-size:50px;
                            color:#ff9800;
                        ">
                            error_outline
                        </span>

                    </div>

                    <h3 class="font-weight-bold mb-2">
                        Validasi
                    </h3>

                    <p class="text-muted mb-4"
                        id="validasiText">

                        Data wajib diisi

                    </p>

                    <button class="btn btn-warning px-4"
                        data-dismiss="modal"
                        style="
                        border-radius:12px;
                        height:45px;
                        min-width:130px;
                        color:white;
                    ">
                        Mengerti
                    </button>

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
    <script src="../assets/js/costume-dom/m.emp.js"></script>

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
    
</body>

</html>