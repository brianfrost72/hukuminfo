<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Profil - Dashboard | Konig Guard Bureau</title>


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
                                        Edit Profil
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Edit Profil</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="row">

                    <!-- LEFT CONTENT -->
                    <div class="col-lg-8 my-4">

                        <div class="card border-0 shadow-sm" style="border-radius:20px;">
                            <div class="card-body p-4">

                                <!-- TITLE -->
                                <div class="d-flex align-items-start mb-4">

                                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                        style="
                                width:60px;
                                height:60px;
                                background:#edf3ff;
                                color:#4a6cf7;
                            ">

                                        <span class="material-icons">
                                            person_outline
                                        </span>

                                    </div>

                                    <div>

                                        <h4 class="mb-1 font-weight-bold">
                                            Informasi Pribadi & Data Karyawan
                                        </h4>

                                        <p class="text-muted mb-0">
                                            Lengkapi dan perbarui informasi data diri Anda.
                                        </p>

                                    </div>

                                </div>

                                <div class="row">

                                    <!-- NAMA -->
                                    <div class="col-12 mb-4">

                                        <label class="font-weight-medium">
                                            Nama Lengkap
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                person
                                            </span>

                                            <input type="text"
                                                class="form-control"
                                                placeholder="Masukkan nama lengkap"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                        </div>

                                    </div>

                                    <!-- TEMPAT LAHIR -->
                                    <div class="col-md-6 mb-4">

                                        <label class="font-weight-medium">
                                            Tempat Lahir
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                location_on
                                            </span>

                                            <input type="text"
                                                class="form-control"
                                                placeholder="Masukkan tempat lahir"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                        </div>

                                    </div>

                                    <!-- TANGGAL LAHIR -->
                                    <div class="col-md-6 mb-4">

                                        <label class="font-weight-medium">
                                            Tanggal Lahir
                                        </label>

                                        <div class="position-relative tanggal-lahir-wrapper">



                                            <!-- INPUT -->
                                            <input type="text"
                                                id="tanggalLahir"
                                                class="form-control"
                                                placeholder="Pilih tanggal lahir"
                                                style="
                height:55px;
                border-radius:12px;
                background:#fff;
                border:1px solid #dfe5ef;
                box-shadow:none;
            ">

                                        </div>

                                        <!-- UMUR -->
                                        <div class="mt-3"
                                            style="
            background:#f5f8ff;
            border:1px solid #dfe7ff;
            border-radius:12px;
            padding:14px 18px;
        ">

                                            <div class="text-muted mb-1"
                                                style="font-size:13px;">
                                                Umur
                                            </div>

                                            <div id="hasilUmur"
                                                style="
                font-size:22px;
                font-weight:700;
                color:#2962ff;
                line-height:1;
            ">
                                                -
                                            </div>

                                        </div>

                                    </div>

                                    <!-- JENIS KELAMIN -->
                                    <div class="col-md-6 mb-4">

                                        <label class="font-weight-medium">
                                            Jenis Kelamin
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                        z-index:2;
                                    ">
                                                groups
                                            </span>

                                            <select class="form-control"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                                <option>Pilih jenis kelamin</option>
                                                <option>Laki-Laki</option>
                                                <option>Perempuan</option>

                                            </select>

                                        </div>

                                    </div>

                                    <!-- STATUS -->
                                    <div class="col-md-6 mb-4">

                                        <label class="font-weight-medium">
                                            Status Pernikahan
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                        z-index:2;
                                    ">
                                                favorite_border
                                            </span>

                                            <select class="form-control"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                                <option>Pilih status pernikahan</option>
                                                <option>Menikah</option>
                                                <option>Belum Menikah</option>

                                            </select>

                                        </div>

                                    </div>

                                    <!-- NO HP -->
                                    <div class="col-12 mb-4">

                                        <label class="font-weight-medium">
                                            No. Hp
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                call
                                            </span>

                                            <input type="text"
                                                class="form-control"
                                                placeholder="08xxxxxxxxxx"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                        </div>

                                    </div>

                                    <!-- ALAMAT -->
                                    <div class="col-12 mb-4">

                                        <label class="font-weight-medium">
                                            Alamat
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:18px;
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                home
                                            </span>

                                            <textarea class="form-control"
                                                rows="4"
                                                placeholder="Masukkan alamat lengkap"
                                                style="
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                        resize:none;
                                    "></textarea>

                                        </div>

                                    </div>

                                    <!-- DEPARTEMEN -->
                                    <div class="col-md-4 mb-4">

                                        <label class="font-weight-medium">
                                            Departemen
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                        z-index:2;
                                    ">
                                                business_center
                                            </span>

                                            <select class="form-control"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                                <option>Pilih departemen</option>

                                            </select>

                                        </div>

                                    </div>

                                    <!-- JABATAN -->
                                    <div class="col-md-4 mb-4">

                                        <label class="font-weight-medium">
                                            Jabatan
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                        z-index:2;
                                    ">
                                                work
                                            </span>

                                            <select class="form-control"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                                <option>Pilih jabatan</option>

                                            </select>

                                        </div>

                                    </div>

                                    <!-- CABANG -->
                                    <div class="col-md-4 mb-4">

                                        <label class="font-weight-medium">
                                            Cabang
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                        z-index:2;
                                    ">
                                                domain
                                            </span>

                                            <select class="form-control"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                                <option>Pilih cabang</option>

                                            </select>

                                        </div>

                                    </div>

                                    <!-- KTP -->
                                    <div class="col-12 mb-4">

                                        <label class="font-weight-medium">
                                            Nomor KTP
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                credit_card
                                            </span>

                                            <input type="text"
                                                class="form-control"
                                                placeholder="Masukkan nomor KTP"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                        </div>

                                    </div>

                                    <!-- NPWP -->
                                    <div class="col-12 mb-4">

                                        <label class="font-weight-medium">
                                            Nomor NPWP
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                description
                                            </span>

                                            <input type="text"
                                                class="form-control"
                                                placeholder="Masukkan nomor NPWP"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                        </div>

                                    </div>

                                    <!-- BPJS KESEHATAN -->
                                    <div class="col-12 mb-4">

                                        <label class="font-weight-medium">
                                            No. BPJS Kesehatan
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                credit_card
                                            </span>

                                            <input type="text"
                                                class="form-control"
                                                placeholder="Masukkan nomor BPJS Kesehatan"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                        </div>

                                    </div>

                                    <!-- BPJS KETENAGAKERJAAN -->
                                    <div class="col-12 mb-4">

                                        <label class="font-weight-medium">
                                            No. BPJS Ketenagakerjaan
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                credit_card
                                            </span>

                                            <input type="text"
                                                class="form-control"
                                                placeholder="Masukkan nomor BPJS Ketenagakerjaan"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                        </div>

                                    </div>

                                    <!-- REKENING -->
                                    <div class="col-12 mb-4">

                                        <label class="font-weight-medium">
                                            No. Rekening
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                account_balance
                                            </span>

                                            <input type="text"
                                                class="form-control"
                                                placeholder="Masukkan nomor rekening"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                        </div>

                                    </div>

                                    <!-- LINKEDIN -->
                                    <div class="col-12 mb-4">

                                        <label class="font-weight-medium">
                                            LinkedIn
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                insert_link
                                            </span>

                                            <input type="text"
                                                class="form-control"
                                                placeholder="Masukkan link linkedin"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                        </div>

                                    </div>

                                    <!-- IG -->
                                    <div class="col-12 mb-4">

                                        <label class="font-weight-medium">
                                            Instagram
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="
                                        left:15px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        color:#8b95a7;
                                        font-size:21px;
                                    ">
                                                insert_link
                                            </span>

                                            <input type="text"
                                                class="form-control"
                                                placeholder="Masukkan link Instagram"
                                                style="
                                        height:55px;
                                        padding-left:52px;
                                        border-radius:12px;
                                        background:#fff;
                                        border:1px solid #dfe5ef;
                                        box-shadow:none;
                                    ">

                                        </div>

                                    </div>

                                    <!-- BUTTON -->
                                    <div class="col-12 text-right">

                                        <button
                                            id="btnSubmitInformasi"
                                            class="btn text-white px-5 btn-submit-profile"
                                            style="height:55px; border-radius:12px; background:linear-gradient(90deg,#3f7cff,#2962ff); font-weight:500; min-width:220px; border:0;">

                                            <span class="material-icons align-middle mr-2"
                                                style="font-size:19px;">
                                                send
                                            </span>

                                            SUBMIT

                                        </button>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- RIGHT CONTENT -->
                    <div class="col-lg-4">

                        <!-- EMAIL PASSWORD -->
                        <div class="card border-0 shadow-sm my-4"
                            style="border-radius:20px;">

                            <div class="card-body p-4">

                                <div class="d-flex align-items-start mb-4">

                                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                        style="
                                width:55px;
                                height:55px;
                                background:#edf3ff;
                                color:#4a6cf7;
                            ">

                                        <span class="material-icons">
                                            mail
                                        </span>

                                    </div>

                                    <div>

                                        <h4 class="mb-1 font-weight-bold">
                                            Email & Password
                                        </h4>

                                        <p class="text-muted mb-0">
                                            Perbarui email dan password akun Anda.
                                        </p>

                                    </div>

                                </div>

                                <!-- EMAIL -->
                                <div class="mb-4">

                                    <label class="font-weight-medium">
                                        Email
                                    </label>

                                    <div class="position-relative">

                                        <span class="material-icons position-absolute"
                                            style="
                                    left:15px;
                                    top:50%;
                                    transform:translateY(-50%);
                                    color:#8b95a7;
                                    font-size:21px;
                                ">
                                            mail
                                        </span>

                                        <input type="email"
                                            class="form-control"
                                            placeholder="Masukkan email"
                                            style="
                                    height:55px;
                                    padding-left:52px;
                                    border-radius:12px;
                                    background:#fff;
                                    border:1px solid #dfe5ef;
                                    box-shadow:none;
                                ">

                                    </div>

                                </div>

                                <!-- PASSWORD -->
                                <div class="mb-4">

                                    <label class="font-weight-medium">
                                        Password
                                    </label>

                                    <div class="position-relative">

                                        <span class="material-icons position-absolute"
                                            style="
                left:15px;
                top:50%;
                transform:translateY(-50%);
                color:#8b95a7;
                font-size:21px;
                z-index:2;
            ">
                                            lock
                                        </span>

                                        <input type="password"
                                            id="passwordInput"
                                            class="form-control"
                                            placeholder="Masukkan password"
                                            style="
                height:55px;
                padding-left:52px;
                padding-right:55px;
                border-radius:12px;
                background:#fff;
                border:1px solid #dfe5ef;
                box-shadow:none;
            ">

                                        <!-- TOGGLE -->
                                        <span class="material-icons"
                                            onclick="togglePassword('passwordInput', this)"
                                            style="
                position:absolute;
                right:16px;
                top:50%;
                transform:translateY(-50%);
                color:#8b95a7;
                font-size:22px;
                cursor:pointer;
                z-index:2;
            ">
                                            visibility_off
                                        </span>

                                    </div>

                                </div>

                                <!-- RE PASSWORD -->
                                <div class="mb-5">

                                    <label class="font-weight-medium">
                                        Re-enter Password
                                    </label>

                                    <div class="position-relative">

                                        <span class="material-icons position-absolute"
                                            style="
                left:15px;
                top:50%;
                transform:translateY(-50%);
                color:#8b95a7;
                font-size:21px;
                z-index:2;
            ">
                                            lock
                                        </span>

                                        <input type="password"
                                            id="rePasswordInput"
                                            class="form-control"
                                            placeholder="Masukkan ulang password"
                                            style="
                height:55px;
                padding-left:52px;
                padding-right:55px;
                border-radius:12px;
                background:#fff;
                border:1px solid #dfe5ef;
                box-shadow:none;
            ">

                                        <!-- TOGGLE -->
                                        <span class="material-icons"
                                            onclick="togglePassword('rePasswordInput', this)"
                                            style="
                position:absolute;
                right:16px;
                top:50%;
                transform:translateY(-50%);
                color:#8b95a7;
                font-size:22px;
                cursor:pointer;
                z-index:2;
            ">
                                            visibility_off
                                        </span>

                                    </div>

                                </div>

                                <!-- BUTTON -->
                                <button
                                    id="btnSubmitEmail"
                                    class="btn text-white px-5 btn-submit-profile"
                                    style="height:55px; border-radius:12px; background:linear-gradient(90deg,#3f7cff,#2962ff); font-weight:500; min-width:220px; transition:.25s ease; border:0;">

                                    <span class="material-icons align-middle mr-2"
                                        style="font-size:19px;">
                                        send
                                    </span>

                                    SUBMIT

                                </button>

                            </div>

                        </div>

                        <!-- PHOTO PROFILE -->
                        <div class="upload-photo-wrapper">

                            <!-- INPUT -->
                            <input type="file"
                                id="uploadFoto"
                                accept="image/*"
                                hidden>

                            <!-- AREA -->
                            <div id="uploadArea"
                                class="d-flex flex-column align-items-center justify-content-center mb-4"
                                style="
            border:2px dashed #d9deea;
            border-radius:30px;
            min-height:320px;
            cursor:pointer;
            transition:.25s ease;
            overflow:hidden;
            position:relative;
        ">

                                <!-- PREVIEW -->
                                <img src=""
                                    id="previewFoto"
                                    style="
                width:100%;
                height:320px;
                object-fit:cover;
                display:none;
            ">

                                <!-- PLACEHOLDER -->
                                <div id="uploadPlaceholder"
                                    class="text-center">

                                    <span class="material-icons mb-3"
                                        style="
                    font-size:70px;
                    color:#6f7687;
                ">
                                        cloud_upload
                                    </span>

                                    <h6 class="font-weight-bold mb-2">
                                        Klik untuk upload foto
                                    </h6>

                                    <p class="text-muted text-center mb-1">
                                        atau seret & lepas file di sini
                                    </p>

                                    <small class="text-muted">
                                        JPG, PNG maks. 2MB
                                    </small>

                                </div>

                            </div>

                            <!-- BUTTON -->
                            <button
                                id="btnSubmitFoto"
                                class="btn btn-block text-white btn-submit-profile"
                                style=" height:55px; border-radius:12px; background:linear-gradient(90deg,#3f7cff,#2962ff); font-weight:500; transition:.25s ease; border:0;">

                                <span class="material-icons align-middle mr-2"
                                    style="font-size:19px;">
                                    check
                                </span>

                                SUBMIT

                            </button>

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

    <!-- =========================
    MODAL LOADING
========================= -->

    <div class="modal fade"
        id="modalLoading"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0"
                style="
                border-radius:20px;
                overflow:hidden;
            ">

                <div class="modal-body text-center p-5">

                    <!-- SPINNER -->
                    <div class="spinner-border text-primary mb-4"
                        style="
                        width:4rem;
                        height:4rem;
                    ">
                    </div>

                    <h5 class="font-weight-bold mb-2">
                        Sedang Mengirim...
                    </h5>

                    <p class="text-muted mb-0">
                        Mohon tunggu sebentar
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- =========================
    MODAL SUCCESS
========================= -->

    <div class="modal fade"
        id="modalSuccess"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0"
                style="
                border-radius:20px;
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
                        Berhasil
                    </h4>

                    <!-- TEXT -->
                    <p class="text-muted mb-4"
                        id="successMessage">

                        Data berhasil diperbarui

                    </p>

                    <!-- BUTTON -->
                    <button type="button"
                        class="btn btn-success px-4"
                        data-dismiss="modal"
                        style="
                        min-width:120px;
                        height:48px;
                        border-radius:12px;
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
        // =========================
        // FLATPICKR DATEPICKER
        // =========================

        flatpickr("#tanggalLahir", {
            altInput: true,
            altFormat: "d F Y",
            dateFormat: "Y-m-d",
            maxDate: "today",
            onChange: function(selectedDates) {

                if (selectedDates.length > 0) {

                    const birthDate = selectedDates[0];
                    const today = new Date();

                    let umur = today.getFullYear() - birthDate.getFullYear();

                    const m = today.getMonth() - birthDate.getMonth();

                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        umur--;
                    }

                    document.getElementById('hasilUmur').innerHTML =
                        umur + ' Tahun';

                }

            }
        });

        // =========================
        // TOGGLE PASSWORD
        // =========================

        function togglePassword(id, icon) {

            const input = document.getElementById(id);

            if (input.type === "password") {

                input.type = "text";
                icon.innerHTML = "visibility";

            } else {

                input.type = "password";
                icon.innerHTML = "visibility_off";

            }

        }

        // =========================
        // DRAG & DROP FOTO
        // =========================

        const uploadArea = document.getElementById('uploadArea');
        const uploadFoto = document.getElementById('uploadFoto');
        const previewFoto = document.getElementById('previewFoto');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');

        uploadArea.addEventListener('click', () => {
            uploadFoto.click();
        });

        uploadFoto.addEventListener('change', function(e) {

            const file = e.target.files[0];

            if (file) {
                tampilkanPreview(file);
            }

        });

        uploadArea.addEventListener('dragover', function(e) {

            e.preventDefault();

            uploadArea.classList.add('dragover');

        });

        uploadArea.addEventListener('dragleave', function() {

            uploadArea.classList.remove('dragover');

        });

        uploadArea.addEventListener('drop', function(e) {

            e.preventDefault();

            uploadArea.classList.remove('dragover');

            const file = e.dataTransfer.files[0];

            if (file) {

                uploadFoto.files = e.dataTransfer.files;

                tampilkanPreview(file);

            }

        });

        function tampilkanPreview(file) {

            const reader = new FileReader();

            reader.onload = function(e) {

                previewFoto.src = e.target.result;

                previewFoto.style.display = 'block';

                uploadPlaceholder.style.display = 'none';

            }

            reader.readAsDataURL(file);

        }
    </script>

    <script>
        // FUNCTION LOADING
        function showLoading(callback) {

            $('#modalLoading').modal('show');

            setTimeout(() => {

                $('#modalLoading').modal('hide');

                setTimeout(() => {

                    callback();

                }, 300);

            }, 1500);

        }

        // =========================
        // VALIDASI INPUT KOSONG
        // =========================

        function isEmpty(value) {

            return value.trim() === "";

        }


        // =========================
        // INFORMASI PRIBADI
        // =========================

        document.getElementById('btnSubmitInformasi')
            .addEventListener('click', function() {

                // INPUT
                const inputs = document.querySelectorAll(
                    '.col-lg-8 input[type="text"], .col-lg-8 textarea'
                );

                // SELECT
                const selects = document.querySelectorAll(
                    '.col-lg-8 select'
                );

                // VALIDASI INPUT
                for (let input of inputs) {

                    if (isEmpty(input.value)) {

                        alert(input.placeholder + ' wajib diisi!');

                        input.focus();

                        return;
                    }

                }

                // VALIDASI SELECT
                for (let select of selects) {

                    if (
                        select.value.includes('Pilih')
                    ) {

                        alert('Semua pilihan wajib dipilih!');

                        select.focus();

                        return;

                    }

                }

                // VALIDASI TANGGAL
                if (
                    isEmpty(document.getElementById('tanggalLahir').value)
                ) {

                    alert('Tanggal lahir wajib dipilih!');

                    return;

                }

                // LOADING
                showLoading(() => {

                    document.getElementById('successMessage').innerHTML =
                        'Informasi Pribadi berhasil diperbarui';

                    $('#modalSuccess').modal('show');

                });

            });

        // =========================
        // EMAIL PASSWORD
        // =========================

        document.getElementById('btnSubmitEmail')
            .addEventListener('click', function() {

                const emailInput =
                    document.querySelector('input[type="email"]');

                const passwordInput =
                    document.getElementById('passwordInput');

                const rePasswordInput =
                    document.getElementById('rePasswordInput');

                // VALIDASI EMAIL
                if (isEmpty(emailInput.value)) {

                    alert('Email wajib diisi!');

                    emailInput.focus();

                    return;

                }

                // VALIDASI PASSWORD
                if (isEmpty(passwordInput.value)) {

                    alert('Password wajib diisi!');

                    passwordInput.focus();

                    return;

                }

                // VALIDASI RE PASSWORD
                if (isEmpty(rePasswordInput.value)) {

                    alert('Re-enter password wajib diisi!');

                    rePasswordInput.focus();

                    return;

                }

                // VALIDASI PASSWORD SAMA
                if (
                    passwordInput.value !==
                    rePasswordInput.value
                ) {

                    alert('Password tidak sama!');

                    rePasswordInput.focus();

                    return;

                }

                // LOADING
                showLoading(() => {

                    document.getElementById('successMessage').innerHTML =
                        'Email & Password berhasil diperbarui';

                    $('#modalSuccess').modal('show');

                });

            });

        // =========================
        // FOTO PROFILE
        // =========================

        document.getElementById('btnSubmitFoto')
            .addEventListener('click', function() {

                // VALIDASI FOTO
                if (
                    uploadFoto.files.length === 0
                ) {

                    alert('Foto profile wajib diupload!');

                    return;

                }

                // LOADING
                showLoading(() => {

                    document.getElementById('successMessage').innerHTML =
                        'Foto profile berhasil diperbarui';

                    $('#modalSuccess').modal('show');

                });

            });
    </script>

</body>

</html>