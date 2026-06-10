<?php
session_start();
require_once __DIR__ . "/../koneksi.php";

/*
|--------------------------------------------------------------------------
| GET DATA
|--------------------------------------------------------------------------
*/
$user_id = $_SESSION['user_id'];

$qUser = mysqli_query($conn, "
    SELECT
        u.*,
        up.*
    FROM users u
    LEFT JOIN public_profile up
        ON up.user_id = u.id
    WHERE u.id = '$user_id'
");

$user = mysqli_fetch_assoc($qUser);

$avatarMen   = "../assets/images/avatar/avatar-men.png";
$avatarWomen = "../assets/images/avatar/avatar-women.png";

$photo = ($user['gender'] ?? '') == 'Perempuan'
    ? $avatarWomen
    : $avatarMen;

if (
    !empty($user['photo_profile']) &&
    file_exists(
        __DIR__ . "/../assets/images/uploads/public_photos/" .
            $user['photo_profile']
    )
) {
    $photo =
        "../assets/images/uploads/public_photos/" .
        $user['photo_profile'];
}

/*
|--------------------------------------------------------------------------
| SAVE INFORMATION DATA
|--------------------------------------------------------------------------
*/
if (isset($_POST['save_profile'])) {
    $full_name      = trim($_POST['full_name']);
    $birth_place    = trim($_POST['birth_place']);
    $date_birth     = $_POST['date_birth'];
    $gender         = $_POST['gender'];
    $hobby          = trim($_POST['hobby']);
    $address        = trim($_POST['address']);
    $phone_number   = trim($_POST['phone_number']);

    $cek = mysqli_query(
        $conn,
        "SELECT id FROM public_profile WHERE user_id='$user_id'"
    );

    if (mysqli_num_rows($cek)) {
        mysqli_query($conn, "
            UPDATE public_profile SET
                full_name='$full_name',
                birth_place='$birth_place',
                date_birth='$date_birth',
                gender='$gender',
                hobby='$hobby',
                address='$address',
                phone_number='$phone_number'
            WHERE user_id='$user_id'
        ");
    } else {
        mysqli_query($conn, "
            INSERT INTO public_profile
            (
                user_id,
                full_name,
                birth_place,
                date_birth,
                gender,
                hobby,
                address,
                phone_number
            )
            VALUES
            (
                '$user_id',
                '$full_name',
                '$birth_place',
                '$date_birth',
                '$gender',
                '$hobby',
                '$address',
                '$phone_number'
            )
        ");
    }

    $_SESSION['profile_success'] = 'Informasi pribadi berhasil diperbarui';

    header("Location: edit_profile.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| SAVE EMAIL & PASSWORD
|--------------------------------------------------------------------------
*/
if (isset($_POST['save_account'])) {
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if ($password != $repassword) {
        $_SESSION['account_error'] = 'Password tidak sama';
    } else {
        $update = "
            UPDATE users
            SET email='$email'
        ";

        if (!empty($password)) {
            $hash = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $update .= ",
                password='$hash'
            ";
        }

        $update .= "
            WHERE id='$user_id'
        ";

        mysqli_query($conn, $update);

        $_SESSION['account_success'] = 'Email & Password berhasil diperbarui';
    }

    header("Location: edit_profile.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| LOGIC PROFILE
|--------------------------------------------------------------------------
*/
if (isset($_POST['save_photo'])) {
    if (
        isset($_FILES['photo']) &&
        $_FILES['photo']['error'] == 0
    ) {
        $full_name = trim($user['full_name']);

        if (empty($full_name)) {
            $_SESSION['error'] =
                'Isi nama lengkap terlebih dahulu';

            header("Location: edit_profile.php");
            exit;
        }

        $folder =
            "../assets/images/uploads/public_photos/";

        $slugName = strtolower($full_name);

        $slugName = preg_replace(
            '/[^a-z0-9]+/',
            '-',
            $slugName
        );

        $slugName = trim($slugName, '-');

        $ext = strtolower(
            pathinfo(
                $_FILES['photo']['name'],
                PATHINFO_EXTENSION
            )
        );

        $allowed = [
            'jpg',
            'jpeg',
            'png'
        ];

        if (!in_array($ext, $allowed)) {
            $_SESSION['error'] =
                'Format foto harus JPG, JPEG atau PNG';

            header("Location: edit_profile.php");
            exit;
        }

        $maxSize = 2 * 1024 * 1024;

        if ($_FILES['photo']['size'] > $maxSize) {
            $_SESSION['error'] =
                'Ukuran foto maksimal 2 MB';

            header("Location: edit_profile.php");
            exit;
        }

        $fileName =
            $slugName . '.' . $ext;

        $newPath =
            $folder . $fileName;

        // hapus foto lama
        if (
            !empty($user['photo_profile']) &&
            file_exists(
                $folder . $user['photo_profile']
            )
        ) {
            unlink(
                $folder . $user['photo_profile']
            );
        }

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            $newPath
        );

        mysqli_query($conn, "
            UPDATE public_profile
            SET photo_profile='$fileName'
            WHERE user_id='$user_id'
        ");

        $_SESSION['photo_success'] = 'Foto profile berhasil diperbarui';
    }

    header("Location: edit_profile.php");
    exit;
}

if (isset($_POST['remove_photo'])) {
    $folder =
        "../assets/images/uploads/public_photos/";

    if (
        !empty($user['photo_profile'])
        &&
        file_exists(
            $folder . $user['photo_profile']
        )
    ) {
        unlink(
            $folder . $user['photo_profile']
        );
    }

    mysqli_query($conn, "
        UPDATE public_profile
        SET photo_profile=''
        WHERE user_id='$user_id'
    ");

    $_SESSION['success'] =
        'Foto profile berhasil dihapus';

    header("Location: edit_profile.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| DELETE ACCOUNT
|--------------------------------------------------------------------------
*/

if (isset($_POST['delete_account'])) {

    // cek cooldown 15 hari
    if (
        !empty($user['delete_cancel_until']) &&
        strtotime($user['delete_cancel_until']) > time()
    ) {

        die("Anda baru membatalkan penghapusan akun. Tunggu sampai " .
            date(
                'd F Y H:i',
                strtotime($user['delete_cancel_until'])
            ));
    }

    mysqli_query($conn, "
        UPDATE users
        SET
            pending_delete = 1,
            delete_requested_at = NOW(),
            delete_scheduled_at = DATE_ADD(NOW(), INTERVAL 30 DAY)
        WHERE id = '$user_id'
    ");

    session_destroy();

    header("Location: logout.php");
    exit;
}

// Menghitung Umur

$umur = '-';

if (!empty($user['date_birth'])) {

    $lahir = new DateTime($user['date_birth']);
    $hariIni = new DateTime();

    $umur = $hariIni->diff($lahir)->y . ' Tahun';
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Profil - Dashboard | Hukuminfo.id</title>


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
                                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
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
                            <form method="POST"
                                enctype="multipart/form-data">
                                <div class="card-body p-4">

                                    <!-- TITLE -->
                                    <div class="d-flex align-items-start mb-4">

                                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                            style="width:60px; height:60px; background:#edf3ff;
                                        color:#4a6cf7;">

                                            <span class="material-icons">
                                                person_outline
                                            </span>

                                        </div>

                                        <div>

                                            <h4 class="mb-1 font-weight-bold">
                                                Informasi Pribadi
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
                                                    style="left:15px; top:50%;
                                                transform:translateY(-50%); color:#8b95a7;
                                                font-size:21px;">
                                                    person
                                                </span>

                                                <input type="text"
                                                    class="form-control"
                                                    name="full_name"
                                                    value="<?= htmlspecialchars($user['full_name'] ?? '') ?>"
                                                    placeholder="Masukkan nama lengkap"
                                                    style="height:55px; padding-left:52px;
                                                border-radius:12px; background:#fff;
                                                border:1px solid #dfe5ef; box-shadow:none;">

                                            </div>

                                        </div>

                                        <!-- TEMPAT LAHIR -->
                                        <div class="col-md-6 mb-4">

                                            <label class="font-weight-medium">
                                                Tempat Lahir
                                            </label>

                                            <div class="position-relative">

                                                <span class="material-icons position-absolute"
                                                    style="left:15px; top:50%;
                                                transform:translateY(-50%); color:#8b95a7;
                                                font-size:21px;">
                                                    location_on
                                                </span>

                                                <input type="text"
                                                    class="form-control"
                                                    name="birth_place"
                                                    value="<?= htmlspecialchars($user['birth_place'] ?? '') ?>"
                                                    placeholder="Masukkan tempat lahir"
                                                    style="height:55px; padding-left:52px;
                                                border-radius:12px; background:#fff;
                                                border:1px solid #dfe5ef; box-shadow:none;">

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
                                                    name="date_birth"
                                                    value="<?= $user['date_birth'] ?? '' ?>"
                                                    placeholder="Pilih tanggal lahir"
                                                    style="height:55px; border-radius:12px;
                                                background:#fff; border:1px solid #dfe5ef;
                                                box-shadow:none;">

                                            </div>

                                            <!-- UMUR -->
                                            <div class="mt-3"
                                                style="background:#f5f8ff; border:1px solid #dfe7ff;
                                            border-radius:12px; padding:14px 18px;">

                                                <div class="text-muted mb-1"
                                                    style="font-size:13px;">
                                                    Umur
                                                </div>

                                                <div id="hasilUmur"
                                                    style="font-size:22px; font-weight:700;
                                                    color:#2962ff; line-height:1;">
                                                    <?= $umur ?>
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
                                                    style="left:15px; top:50%;
                                                transform:translateY(-50%);
                                                color:#8b95a7; font-size:21px; z-index:2;">
                                                    groups
                                                </span>

                                                <select
                                                    name="gender"
                                                    class="form-control"
                                                    style="height:55px; padding-left:52px;
                                                border-radius:12px; background:#fff;
                                                border:1px solid #dfe5ef;
                                                box-shadow:none;">

                                                    <option value="">Pilih jenis kelamin</option>

                                                    <option
                                                        value="Laki-laki"
                                                        <?= ($user['gender'] ?? '') == 'Laki-laki' ? 'selected' : '' ?>>
                                                        Laki-laki
                                                    </option>

                                                    <option
                                                        value="Perempuan"
                                                        <?= ($user['gender'] ?? '') == 'Perempuan' ? 'selected' : '' ?>>
                                                        Perempuan
                                                    </option>

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
                                                    name="phone_number"
                                                    value="<?= htmlspecialchars($user['phone_number'] ?? '') ?>"
                                                    placeholder="08xxxxxxxxxx"
                                                    style="height:55px; padding-left:52px;
                                                border-radius:12px; background:#fff;
                                                border:1px solid #dfe5ef;
                                                box-shadow:none;">

                                            </div>

                                        </div>

                                        <!-- Hobi -->
                                        <div class="col-12 mb-4">

                                            <label class="font-weight-medium">
                                                Hobi
                                            </label>

                                            <div class="position-relative">

                                                <span class="material-icons position-absolute"
                                                    style="left:15px; top:18px; color:#8b95a7;
                                                font-size:21px;">
                                                    mood
                                                </span>

                                                <textarea class="form-control"
                                                    rows="4"
                                                    name="hobby"
                                                    placeholder="Masukkan hobi anda"
                                                    style="padding-left:52px; border-radius:12px;
                                                background:#fff; border:1px solid #dfe5ef;
                                                box-shadow:none; resize:none;"><?= htmlspecialchars($user['hobby'] ?? '') ?></textarea>

                                            </div>

                                        </div>

                                        <!-- ALAMAT -->
                                        <div class="col-12 mb-4">

                                            <label class="font-weight-medium">
                                                Alamat
                                            </label>

                                            <div class="position-relative">

                                                <span class="material-icons position-absolute"
                                                    style="left:15px; top:18px; color:#8b95a7; font-size:21px;">
                                                    home
                                                </span>

                                                <textarea class="form-control"
                                                    rows="4"
                                                    name="address"
                                                    placeholder="Masukkan alamat lengkap"
                                                    style="padding-left:52px; border-radius:12px;
                                                background:#fff; border:1px solid #dfe5ef;
                                                box-shadow:none; resize:none;"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>

                                            </div>

                                        </div>

                                        <!-- BUTTON -->
                                        <div class="col-12 text-right">

                                            <button type="submit" name="save_profile"
                                                id="btnSubmitInformasi"
                                                class="btn text-white px-5 btn-submit-profile"
                                                style="height:55px; border-radius:12px; background:linear-gradient(90deg,#3f7cff,#2962ff); font-weight:500; min-width:220px; border:0;">

                                                <span class="material-icons align-middle mr-2"
                                                    style="font-size:19px;">
                                                    send
                                                </span>

                                                SUBMIT

                                            </button>

                                            <div class="mt-4 text-left">

                                                <?php if ($user['pending_delete'] == 0): ?>

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger"
                                                        data-toggle="modal"
                                                        data-target="#deleteAccountModal">

                                                        HAPUS AKUN

                                                    </button>

                                                <?php else: ?>

                                                    <div
                                                        class="alert alert-warning mt-3 mb-0">

                                                        Akun sedang menunggu penghapusan pada

                                                        <strong>
                                                            <?= date(
                                                                'd F Y H:i',
                                                                strtotime($user['delete_scheduled_at'])
                                                            ) ?>
                                                        </strong>

                                                    </div>

                                                <?php endif; ?>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>

                    <!-- RIGHT CONTENT -->
                    <div class="col-lg-4">

                        <!-- EMAIL PASSWORD -->
                        <div class="card border-0 shadow-sm my-4"
                            style="border-radius:20px;">
                            <form method="POST"
                                enctype="multipart/form-data">
                                <div class="card-body p-4">

                                    <div class="d-flex align-items-start mb-4">

                                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                            style="width:55px; height:55px;
                                        background:#edf3ff; color:#4a6cf7;">

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
                                                style="left:15px; top:50%;
                                            transform:translateY(-50%); color:#8b95a7;
                                            font-size:21px;">
                                                mail
                                            </span>

                                            <input type="email"
                                                class="form-control"
                                                name="email"
                                                value="<?= htmlspecialchars($user['email']) ?>"
                                                placeholder="Masukkan email"
                                                style="height:55px; padding-left:52px;
                                            border-radius:12px; background:#fff;
                                            border:1px solid #dfe5ef; box-shadow:none;">

                                        </div>

                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="mb-4">

                                        <label class="font-weight-medium">
                                            Password
                                        </label>

                                        <div class="position-relative">

                                            <span class="material-icons position-absolute"
                                                style="left:15px; top:50%; transform:translateY(-50%);
                                            color:#8b95a7; font-size:21px; z-index:2;">
                                                lock
                                            </span>

                                            <input type="password"
                                                id="passwordInput"
                                                class="form-control"
                                                name="password"
                                                placeholder="Masukkan password"
                                                style="height:55px; padding-left:52px;
                                            padding-right:55px; border-radius:12px;
                                            background:#fff; border:1px solid #dfe5ef;
                                            box-shadow:none;">

                                            <!-- TOGGLE -->
                                            <span class="material-icons"
                                                onclick="togglePassword('passwordInput', this)"
                                                style="position:absolute; right:16px;top:50%;
                                            transform:translateY(-50%); color:#8b95a7;
                                            font-size:22px; cursor:pointer; z-index:2;">
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
                                                style="left:15px; top:50%;
                                            transform:translateY(-50%); color:#8b95a7;
                                            font-size:21px; z-index:2;">
                                                lock
                                            </span>

                                            <input type="password"
                                                id="rePasswordInput"
                                                class="form-control"
                                                name="repassword"
                                                placeholder="Masukkan ulang password"
                                                style="height:55px; padding-left:52px;
                                            padding-right:55px; border-radius:12px;
                                            background:#fff; border:1px solid #dfe5ef;
                                            box-shadow:none;">

                                            <!-- TOGGLE -->
                                            <span class="material-icons"
                                                onclick="togglePassword('rePasswordInput', this)"
                                                style="position:absolute; right:16px; top:50%;
                                            transform:translateY(-50%); color:#8b95a7;
                                            font-size:22px; cursor:pointer; z-index:2;">
                                                visibility_off
                                            </span>

                                        </div>

                                    </div>

                                    <!-- BUTTON -->
                                    <button type="submit" id="btnSubmitEmail" name="save_account"
                                        class="btn text-white px-5 btn-submit-profile"
                                        style="height:55px; border-radius:12px; background:linear-gradient(90deg,#3f7cff,#2962ff); font-weight:500; min-width:220px; transition:.25s ease; border:0;">

                                        <span class="material-icons align-middle mr-2"
                                            style="font-size:19px;">
                                            send
                                        </span>

                                        SUBMIT

                                    </button>

                                </div>
                            </form>

                        </div>

                        <!-- PHOTO PROFILE -->
                        <form
                            method="POST"
                            enctype="multipart/form-data">
                            <div class="upload-photo-wrapper">

                                <!-- INPUT -->
                                <input type="file"
                                    id="uploadFoto"
                                    name="photo"
                                    accept="image/*"
                                    hidden>

                                <!-- AREA -->
                                <div id="uploadArea"
                                    class="d-flex flex-column align-items-center justify-content-center mb-4"
                                    style="border:2px dashed #d9deea; border-radius:30px;
                                    min-height:320px; cursor:pointer; transition:.25s ease;
                                    overflow:hidden; position:relative;">

                                    <!-- PREVIEW -->
                                    <img src="<?= $photo ?>"
                                        id="previewFoto"
                                        style="width:100%; height:320px; object-fit:cover;">

                                    <!-- PLACEHOLDER -->
                                    <div id="uploadPlaceholder"
                                        class="text-center">

                                        <span class="material-icons mb-3"
                                            style="font-size:70px; color:#6f7687;">
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
                                <?php if (!empty($user['photo_profile'])): ?>

                                    <button
                                        type="submit"
                                        name="remove_photo"
                                        class="btn btn-danger btn-block mt-2">

                                        REMOVE PHOTO

                                    </button>

                                <?php endif; ?>
                            </div>
                        </form>

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

    <div
        class="modal fade"
        id="deleteAccountModal"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header border-0">

                    <h5 class="modal-title text-danger">
                        Hapus Akun
                    </h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <p class="mb-3">

                        Apakah Anda yakin ingin menghapus akun ini?

                    </p>

                    <p class="text-muted mb-0">

                        Akun Anda akan dijadwalkan untuk dihapus
                        dalam <strong>30 hari</strong>.

                        <br><br>

                        Jika Anda login kembali sebelum 30 hari,
                        maka penghapusan akun akan otomatis
                        dibatalkan.

                        <br><br>

                        <strong>
                            Setelah menekan tombol "Ya, Hapus Akun",
                            Anda akan langsung logout dari sistem.
                        </strong>

                    </p>

                </div>

                <div class="modal-footer border-0">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-dismiss="modal">

                        Batal

                    </button>

                    <form method="POST">

                        <button
                            type="submit"
                            name="delete_account"
                            class="btn btn-danger">

                            Ya, Hapus Akun

                        </button>

                    </form>

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

                <!-- RIGHT -->
                <div class="col-md-6 text-md-right text-center">
                    <a href="#" class="footer-social">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="#" class="footer-social">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="#" class="footer-social">
                        <i class="fab fa-x-twitter"></i>
                    </a>

                    <a href="#" class="footer-social">
                        <i class="fab fa-youtube"></i>
                    </a>

                    <a href="#" class="footer-social">
                        <i class="fab fa-tiktok"></i>
                    </a>
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

    <!-- Toastr -->
    <script src="../assets/vendor/toastr.min.js"></script>
    <script src="../assets/js/toastr.js"></script>

    <script>
        toastr.options = {
            closeButton: true,
            progressBar: false,
            newestOnTop: true,
            preventDuplicates: true,
        };
    </script>

    <?php if (isset($_SESSION['profile_success'])) : ?>

        <script>
            toastr.success(
                '<?= addslashes($_SESSION['profile_success']) ?>',
                'Informasi Pribadi'
            );
        </script>

        <?php unset($_SESSION['profile_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['account_success'])) : ?>

        <script>
            toastr.success(
                '<?= addslashes($_SESSION['account_success']) ?>',
                'Email & Password'
            );
        </script>

        <?php unset($_SESSION['account_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['photo_success'])) : ?>

        <script>
            toastr.success(
                '<?= addslashes($_SESSION['photo_success']) ?>',
                'Foto Profile'
            );
        </script>

        <?php unset($_SESSION['photo_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['photo_error'])) : ?>

        <script>
            toastr.error(
                '<?= addslashes($_SESSION['photo_error']) ?>',
                'Foto Profile'
            );
        </script>

        <?php unset($_SESSION['photo_error']); ?>
    <?php endif; ?>

    <script>
        // =========================
        // FLATPICKR DATEPICKER
        // =========================

        flatpickr("#tanggalLahir", {
            altInput: true,
            altFormat: "d F Y",
            dateFormat: "Y-m-d",
            maxDate: "today",

            onReady: function(selectedDates) {

                if (selectedDates.length > 0) {
                    hitungUmur(selectedDates[0]);
                }

            },

            onChange: function(selectedDates) {

                if (selectedDates.length > 0) {
                    hitungUmur(selectedDates[0]);
                }

            }
        });

        function hitungUmur(birthDate) {

            const today = new Date();

            let umur =
                today.getFullYear() -
                birthDate.getFullYear();

            const m =
                today.getMonth() -
                birthDate.getMonth();

            if (
                m < 0 ||
                (m === 0 &&
                    today.getDate() < birthDate.getDate())
            ) {
                umur--;
            }

            document.getElementById('hasilUmur').innerHTML =
                umur + ' Tahun';
        }

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

            });
    </script>

</body>

</html>