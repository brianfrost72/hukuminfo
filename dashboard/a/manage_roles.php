<?php
session_start();
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . "/../koneksi.php";

// PAGINATION
$limit = isset($_GET['show'])
    ? (int)$_GET['show']
    : 5;

$page = isset($_GET['page'])
    ? (int)$_GET['page']
    : 1;

if ($page < 1) {
    $page = 1;
}

$offset =
    ($page - 1) * $limit;

$sql = "
SELECT
    u.id,
    u.email,
    u.role_id,
    u.account_status,

    up.full_name,
    up.phone_number,
    up.photo_profile,
    up.birth_place,
    up.date_birth,
    up.gender,
    up.address,
    up.marital_status,

    r.role_name

FROM users u
LEFT JOIN user_profile up ON up.user_id=u.id
LEFT JOIN roles r ON r.id=u.role_id

ORDER BY u.id ASC
LIMIT $offset,$limit
";

$result = mysqli_query($conn, $sql);

// *************************************************************** LOGIC TAMBAH
if (isset($_POST['tambah_user'])) {
    $nama      = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id   = (int)$_POST['role_id'];

    $tempat    = mysqli_real_escape_string($conn, $_POST['birth_place']);
    $tgl       = $_POST['date_birth'];
    $gender    = $_POST['gender'];
    $marital_status = mysqli_real_escape_string($conn, $_POST['marital_status'] ?? '');
    $alamat    = mysqli_real_escape_string($conn, $_POST['address']);
    $phone     = mysqli_real_escape_string($conn, $_POST['phone_number']);

    $photo_profile = '';

    if (!empty($_FILES['photo_profile']['name'])) {

        $ext = strtolower(
            pathinfo(
                $_FILES['photo_profile']['name'],
                PATHINFO_EXTENSION
            )
        );

        $slugName = strtolower($nama);

        $slugName = preg_replace(
            '/[^a-z0-9]+/',
            '-',
            $slugName
        );

        $slugName = trim($slugName, '-');

        $filename = $slugName . '.' . $ext;

        $upload_dir =
            __DIR__ .
            '/../assets/images/uploads/user_photos/';

        move_uploaded_file(
            $_FILES['photo_profile']['tmp_name'],
            $upload_dir . $filename
        );

        $photo_profile = $filename;
    } else {

        if ($gender == 'Perempuan') {
            $photo_profile = 'avatar-women.png';
        } else {
            $photo_profile = 'avatar-men.png';
        }
    }

    mysqli_begin_transaction($conn);

    try {

        mysqli_query($conn, "
            INSERT INTO users(
    email,
    password,
    role_id,
    user_type,
    account_status
)
VALUES(
    '$email',
    '$password',
    '$role_id',
    'internal',
    'Active'
)
        ");

        $user_id = mysqli_insert_id($conn);

        $sqlProfile = "
INSERT INTO user_profile(
    user_id,
    full_name,
    birth_place,
    date_birth,
    gender,
    marital_status,
    address,
    phone_number,
    linkedin,
    instagram,
    photo_profile
)
VALUES(
    '$user_id',
    '$nama',
    '$tempat',
    '$tgl',
    '$gender',
    '$marital_status',
    '$alamat',
    '$phone',
    '',
    '',
    '$photo_profile'
)";

        if (!mysqli_query($conn, $sqlProfile)) {
            die(mysqli_error($conn));
        }

        mysqli_commit($conn);

        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'User berhasil ditambahkan'
        ];

        header("Location: manage_roles.php");
        exit;
    } catch (Exception $e) {

        mysqli_rollback($conn);

        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Gagal menambahkan user'
        ];

        header("Location: manage_roles.php");
        exit;
    }
}

// LOGIC UPDATE
if (isset($_POST['update_user'])) {
    $id       = (int)$_POST['user_id'];
    $nama     = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $role_id  = (int)$_POST['role_id'];
    $phone    = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $tempat   = mysqli_real_escape_string($conn, $_POST['birth_place']);
    $tgl      = $_POST['date_birth'];
    $gender   = $_POST['gender'];
    $marital_status = mysqli_real_escape_string(
        $conn,
        $_POST['marital_status']
    );
    $alamat   = mysqli_real_escape_string($conn, $_POST['address']);

    //***************************************************** AMBIL FOTO LAMA */ 
    $getUser = mysqli_query(
        $conn,
        "SELECT photo_profile
     FROM user_profile
     WHERE user_id='$id'"
    );

    $user = mysqli_fetch_assoc($getUser);

    $photo_profile = $user['photo_profile'];

    // ****************************************************** UPLOAD FOTO BARU JIKA ADA */
    if (!empty($_FILES['photo_profile']['name'])) {

        $ext = strtolower(
            pathinfo(
                $_FILES['photo_profile']['name'],
                PATHINFO_EXTENSION
            )
        );

        $slugName = strtolower($nama);

        $slugName = preg_replace(
            '/[^a-z0-9]+/',
            '-',
            $slugName
        );

        $slugName = trim($slugName, '-');

        $filename = $slugName . '.' . $ext;

        move_uploaded_file(
            $_FILES['photo_profile']['tmp_name'],
            __DIR__ .
                '/../assets/images/uploads/user_photos/' .
                $filename
        );

        $photo_profile = $filename;
    }

    //********************************* */ CENTANG FOTO LAMA (RESET KE DEFAULT JIKA GANTI FOTO)
    if (isset($_POST['remove_photo'])) {

        if ($gender == 'Perempuan') {

            $photo_profile =
                'avatar-women.png';
        } else {

            $photo_profile =
                'avatar-men.png';
        }
    }

    mysqli_query($conn, "
        UPDATE users
        SET
            email='$email',
            role_id='$role_id'
        WHERE id='$id'
    ");

    $cekProfile = mysqli_query(
        $conn,
        "SELECT id
     FROM user_profile
     WHERE user_id='$id'"
    );

    if (mysqli_num_rows($cekProfile) > 0) {

        mysqli_query($conn, "
        UPDATE user_profile
        SET
            full_name='$nama',
            phone_number='$phone',
            birth_place='$tempat',
            date_birth='$tgl',
            gender='$gender',
            marital_status='$marital_status',
            address='$alamat',
            photo_profile='$photo_profile'
        WHERE user_id='$id'
    ");
    } else {

        mysqli_query($conn, "
        INSERT INTO user_profile(
            user_id,
            full_name,
            birth_place,
            date_birth,
            gender,
            marital_status,
            address,
            phone_number,
            linkedin,
            instagram,
            photo_profile
        )
        VALUES(
            '$id',
            '$nama',
            '$tempat',
            '$tgl',
            '$gender',
            '$marital_status',
            '$alamat',
            '$phone',
            '',
            '',
            '$photo_profile'
        )
    ");
    }

    $_SESSION['toast'] = [
        'type' => 'success',
        'message' => 'User berhasil diupdate'
    ];

    header("Location: manage_roles.php");
    exit;
}

// AKUN SET NON AKTIF/AKTIF

if (isset($_POST['toggle_status'])) {

    $id = (int)$_POST['user_id'];
    $status = $_POST['status'];

    mysqli_query(
        $conn,
        "UPDATE users
         SET account_status='$status'
         WHERE id='$id'"
    );

    if ($status == 'Inactive') {

        $_SESSION['toast'] = [
            'type' => 'warning',
            'message' => 'User berhasil dinonaktifkan'
        ];
    } else {

        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'User berhasil diaktifkan'
        ];
    }

    header("Location: manage_roles.php");
    exit;
}

// BULK INACTIVE
if (isset($_POST['bulk_inactive'])) {
    $ids = explode(
        ',',
        $_POST['selected_ids']
    );

    foreach ($ids as $id) {
        mysqli_query(
            $conn,
            "UPDATE users
             SET account_status='Inactive'
             WHERE id='" . (int)$id . "'"
        );
    }
    $_SESSION['toast'] = [
        'type' => 'warning',
        'message' => 'User terpilih berhasil dinonaktifkan'
    ];

    header("Location: manage_roles.php");
    exit;
}

// QUERY COUNT TOTAL ROWS
$countQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) total
     FROM users"
);

$totalData =
    mysqli_fetch_assoc($countQuery)['total'];

$totalPages =
    ceil(
        $totalData /
            $limit
    );

$start = ($totalData > 0)
    ? $offset + 1
    : 0;

$end = min(
    $offset + $limit,
    $totalData
);

$totalRows = mysqli_num_rows($result);
?>

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
                            <div class="row mb-3 align-items-center">

                                <div class="col-md-8 d-flex">

                                    <div class="mr-3">
                                        Show
                                        <select id="showEntries"
                                            class="form-control d-inline w-auto">
                                            <option
                                                value="5"
                                                <?= $limit == 5 ? 'selected' : '' ?>>
                                                5
                                            </option>

                                            <option
                                                value="10"
                                                <?= $limit == 10 ? 'selected' : '' ?>>
                                                10
                                            </option>

                                            <option
                                                value="20"
                                                <?= $limit == 20 ? 'selected' : '' ?>>
                                                20
                                            </option>
                                        </select>
                                        entries
                                    </div>

                                    <select
                                        id="roleFilter"
                                        class="form-control mr-2"
                                        style="width:180px;">

                                        <option value="">
                                            Semua Role
                                        </option>

                                        <?php

                                        $roleFilter = mysqli_query(
                                            $conn,
                                            "SELECT * FROM roles
                 ORDER BY role_name ASC"
                                        );

                                        while ($r = mysqli_fetch_assoc($roleFilter)):
                                        ?>

                                            <option value="<?= $r['role_name']; ?>">
                                                <?= $r['role_name']; ?>
                                            </option>

                                        <?php endwhile; ?>

                                    </select>

                                    <select
                                        id="statusFilter"
                                        class="form-control"
                                        style="width:180px;">

                                        <option value="">
                                            Semua Status
                                        </option>

                                        <option value="Active">
                                            Active
                                        </option>

                                        <option value="Inactive">
                                            Inactive
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-4">

                                    <input
                                        type="text"
                                        id="searchInput"
                                        class="form-control"
                                        placeholder="Search...">

                                </div>

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
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox"
                                                        class="rowCheck"
                                                        value="<?= $row['id']; ?>">
                                                </td>

                                                <td><?= $no++; ?></td>

                                                <td><?= $row['id']; ?></td>

                                                <td class="d-flex align-items-center">
                                                    <?php

                                                    $photo = $row['photo_profile'];

                                                    if (empty($photo)) {
                                                        $photo = 'avatar-men.png';
                                                    }

                                                    if (
                                                        $photo == 'avatar-men.png' ||
                                                        $photo == 'avatar-women.png'
                                                    ) {

                                                        $photo_path =
                                                            '../assets/images/avatar/' . $photo;
                                                    } else {

                                                        $photo_path =
                                                            '../assets/images/uploads/user_photos/' . $photo;
                                                    }
                                                    ?>

                                                    <img
                                                        src="<?= $photo_path; ?>"
                                                        width="40"
                                                        height="40"
                                                        class="rounded-circle mr-2"
                                                        style="object-fit:cover">

                                                    <?= htmlspecialchars($row['full_name']); ?>
                                                </td>

                                                <td><?= htmlspecialchars($row['email']); ?></td>

                                                <td><?= htmlspecialchars($row['role_name']); ?></td>

                                                <td>

                                                    <?php if (($row['account_status'] ?? 'Active') == 'Active'): ?>

                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>

                                                    <?php else: ?>

                                                        <span class="badge badge-danger">
                                                            Inactive
                                                        </span>

                                                    <?php endif; ?>

                                                </td>

                                                <td>
                                                    <button
                                                        class="btn btn-warning btn-sm btnEdit"
                                                        title="Edit User"
                                                        data-id="<?= $row['id']; ?>"
                                                        data-nama="<?= htmlspecialchars($row['full_name']); ?>"
                                                        data-email="<?= htmlspecialchars($row['email']); ?>"
                                                        data-role="<?= $row['role_id']; ?>"

                                                        data-phone="<?= htmlspecialchars($row['phone_number']); ?>"
                                                        data-tempat="<?= htmlspecialchars($row['birth_place']); ?>"
                                                        data-tanggal="<?= $row['date_birth']; ?>"
                                                        data-gender="<?= htmlspecialchars($row['gender']); ?>"
                                                        data-status="<?= htmlspecialchars($row['marital_status']); ?>"
                                                        data-address="<?= htmlspecialchars($row['address']); ?>"
                                                        data-photo="<?= htmlspecialchars($row['photo_profile']); ?>"

                                                        data-toggle="modal"
                                                        data-target="#modalEdit">

                                                        <i class="material-icons">edit</i>
                                                    </button>

                                                    <?php if (($row['account_status'] ?? 'Active') == 'Active'): ?>

                                                        <form method="POST" style="display:inline;">

                                                            <input
                                                                type="hidden"
                                                                name="user_id"
                                                                value="<?= $row['id']; ?>">

                                                            <input
                                                                type="hidden"
                                                                name="status"
                                                                value="Inactive">

                                                            <button
                                                                type="submit"
                                                                name="toggle_status"
                                                                title="Blokir Akun"
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Nonaktifkan akun ini?')">

                                                                <i class="material-icons">block</i>

                                                            </button>

                                                        </form>

                                                    <?php else: ?>

                                                        <form method="POST" style="display:inline;">

                                                            <input
                                                                type="hidden"
                                                                name="user_id"
                                                                value="<?= $row['id']; ?>">

                                                            <input
                                                                type="hidden"
                                                                name="status"
                                                                value="Active">

                                                            <button
                                                                type="submit"
                                                                name="toggle_status"
                                                                class="btn btn-success btn-sm"
                                                                onclick="return confirm('Aktifkan akun ini?')">

                                                                <i class="material-icons">check_circle</i>

                                                            </button>

                                                        </form>

                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- PAGINATION -->
                            <div class="row mt-3 align-items-start">

                                <!-- KIRI -->
                                <div class="col-md-6">

                                    <div id="showingInfo">

                                        Showing
                                        <?= $start; ?>
                                        to
                                        <?= $end; ?>
                                        of
                                        <?= $totalData; ?>
                                        entries

                                    </div>

                                    <button
                                        class="btn btn-warning btn-sm mt-2"
                                        id="inactiveSelected"
                                        style="display:none;">

                                        <i class="material-icons">block</i>

                                        Inactive Selected

                                    </button>

                                </div>

                                <!-- KANAN -->
                                <div class="col-md-6">

                                    <nav class="float-md-right">

                                        <ul class="pagination mb-0">

                                            <?php if ($page > 1): ?>

                                                <li class="page-item">

                                                    <a
                                                        class="page-link"
                                                        href="?page=<?= $page - 1; ?>&show=<?= $limit; ?>">

                                                        Prev

                                                    </a>

                                                </li>

                                            <?php endif; ?>

                                            <?php

                                            for (
                                                $i = max(1, $page - 2);
                                                $i <= min($totalPages, $page + 2);
                                                $i++
                                            ):

                                            ?>

                                                <li class="page-item <?= $page == $i ? 'active' : ''; ?>">

                                                    <a
                                                        class="page-link"
                                                        href="?page=<?= $i; ?>&show=<?= $limit; ?>">

                                                        <?= $i; ?>

                                                    </a>

                                                </li>

                                            <?php endfor; ?>

                                            <?php if ($page < $totalPages): ?>

                                                <li class="page-item">

                                                    <a
                                                        class="page-link"
                                                        href="?page=<?= $page + 1; ?>&show=<?= $limit; ?>">

                                                        Next

                                                    </a>

                                                </li>

                                            <?php endif; ?>
                                        </ul>

                                    </nav>

                                </div>

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
        <app-settings layout-active="fluid"></app-settings>
    </div>

    <!-- ********************************** // MENU-Drawer ********************************** -->
    <?php include 'includes/drawer_menu.php'; ?>
    <!-- ********************************** //END MENU-drawer ********************************** -->
    <form method="POST" enctype="multipart/form-data">
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
                                        name="full_name"
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
                                        name="email"
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
                                        name="password"
                                        class="form-control"
                                        placeholder="Password">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()"><span class="material-icons">remove_red_eye</span></button>
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
                                        name="birth_place"
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
                                        name="date_birth"
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
                                        name="phone_number"
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

                                    <select name="gender" id="genderTambah" class="form-control">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
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

                                    <select name="marital_status" class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option value="Belum Menikah">
                                            Belum Menikah
                                        </option>

                                        <option value="Menikah">
                                            Menikah
                                        </option>
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

                                    <select class="form-control" name="role_id">
                                        <?php
                                        $roles = mysqli_query($conn, "
        SELECT *
        FROM roles
        ORDER BY role_name ASC
    ");

                                        while ($role = mysqli_fetch_assoc($roles)):
                                        ?>
                                            <option value="<?= $role['id']; ?>">
                                                <?= $role['role_name']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <textarea name="address" id="alamatTambah" class="form-control mb-2" placeholder="Alamat"></textarea>

                            <input
                                type="file"
                                name="photo_profile"
                                id="photoTambah"
                                class="form-control mb-2"
                                accept="image/*">

                            <div class="text-center mt-2">

                                <img
                                    id="previewPhoto"
                                    src="../assets/images/avatar/avatar-men.png"
                                    width="120"
                                    height="120"
                                    class="rounded-circle border"
                                    style="object-fit:cover">

                                <small class="d-block text-muted mt-2">
                                    Preview Foto
                                </small>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit"
                            name="tambah_user"
                            class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="modalEdit">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Edit User</h5>
                    </div>

                    <div class="modal-body row">
                        <input type="hidden" name="user_id" id="editIndex">

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
                                        name="full_name"
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
                                        name="email"
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
                                        name="password"
                                        id="passwordEdit"
                                        class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordEdit()"><span class="material-icons">remove_red_eye</span></button>
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
                                        name="birth_place"
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
                                        name="date_birth"
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
                                        name="phone_number"
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

                                    <select name="gender" id="genderEdit" class="form-control">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
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

                                    <select name="marital_status" id="statusEdit" class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option value="Belum Menikah">
                                            Belum Menikah
                                        </option>

                                        <option value="Menikah">
                                            Menikah
                                        </option>
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

                                    <select class="form-control"
                                        name="role_id"
                                        id="roleEdit">

                                        <?php
                                        $roles = mysqli_query($conn, "
        SELECT *
        FROM roles
        ORDER BY role_name ASC
    ");

                                        while ($role = mysqli_fetch_assoc($roles)):
                                        ?>
                                            <option value="<?= $role['id']; ?>">
                                                <?= $role['role_name']; ?>
                                            </option>
                                        <?php endwhile; ?>

                                    </select>
                                </div>
                            </div>

                            <textarea name="address" id="alamatEdit" class="form-control mb-2"></textarea>

                            <div class="row">

                                <div class="col-md-6 text-center">

                                    <label>Foto Saat Ini</label>

                                    <img id="oldPhotoEdit"
                                        src=""
                                        class="img-thumbnail d-block mx-auto"
                                        width="120">

                                </div>

                                <div class="col-md-6 text-center">

                                    <label>Preview Foto Baru</label>

                                    <img id="newPhotoEdit"
                                        src=""
                                        class="img-thumbnail d-block mx-auto"
                                        width="120">

                                </div>

                            </div>

                            <input type="file"
                                name="photo_profile"
                                id="photoEdit"
                                class="form-control mt-2">

                            <div class="form-check mt-2">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="removePhoto"
                                    name="remove_photo">

                                <label
                                    class="form-check-label"
                                    for="removePhoto">

                                    Hapus foto profile
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="submit"
                            name="update_user"
                            class="btn btn-success">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
    <script src="../assets/js/flatpickr.js"></script>

    <!-- Global Settings -->
    <script src="../assets/js/settings.js"></script>

    <!-- Moment.js -->
    <script src="../assets/vendor/moment.min.js"></script>
    <script src="../assets/vendor/moment-range.js"></script>

    <!-- Toastr -->
    <script src="../assets/vendor/toastr.min.js"></script>
    <script src="../assets/js/toastr.js"></script>

    <?php if (!empty($_SESSION['toast'])): ?>

        <script>
            toastr.options = {

                closeButton: true,
                progressBar: false,

                newestOnTop: true,

                positionClass: "toast-center",

                showDuration: "300",
                hideDuration: "300",

                timeOut: 0,
                extendedTimeOut: 0,

                tapToDismiss: true,

                preventDuplicates: true
            };

            toastr.<?= $_SESSION['toast']['type']; ?>(
                "<?= $_SESSION['toast']['message']; ?>"
            );
        </script>

    <?php
        unset($_SESSION['toast']);
    endif;
    ?>

    <script>
        // FOTO DEFAULT
        $('#genderTambah').on('change', function() {

            let gender = $(this).val();

            if (gender === 'Perempuan') {

                $('#previewPhoto').attr(
                    'src',
                    '../assets/images/avatar/avatar-women.png'
                );

            } else {

                $('#previewPhoto').attr(
                    'src',
                    '../assets/images/avatar/avatar-men.png'
                );

            }

        });

        // UPLOAD REPLACE AVATAR
        $('#photoTambah').on('change', function() {

            const file = this.files[0];

            if (file) {

                const reader = new FileReader();

                reader.onload = function(e) {

                    $('#previewPhoto').attr(
                        'src',
                        e.target.result
                    );

                }

                reader.readAsDataURL(file);
            }

        });
    </script>

    <script>
        $('#photoEdit').on('change', function() {

            const file = this.files[0];

            if (file) {

                const reader = new FileReader();

                reader.onload = function(e) {

                    $('#newPhotoEdit').attr('src', e.target.result);

                }

                reader.readAsDataURL(file);

            }

        });

        // ISI OTOMATIS
        $('.btnEdit').on('click', function() {

            $('#editIndex').val($(this).data('id'));
            $('#namaEdit').val($(this).data('nama'));
            $('#emailEdit').val($(this).data('email'));

            $('#tempatLahirEdit').val($(this).data('tempat'));
            $('#tanggalLahirEdit').val($(this).data('tanggal'));
            let umur = hitungUmur(
                $(this).data('tanggal')
            );

            $('#umurTextEdit').html(
                '<b>Umur:</b> ' +
                umur +
                ' Tahun'
            );

            $('#teleponEdit').val($(this).data('phone'));

            $('#genderEdit').val($(this).data('gender'));
            $('#statusEdit').val($(this).data('status'));

            $('#roleEdit').val($(this).data('role'));

            $('#alamatEdit').val($(this).data('address'));

            let photo = $(this).data('photo');

            let photoPath = '';

            if (
                photo === 'avatar-men.png' ||
                photo === 'avatar-women.png'
            ) {

                photoPath =
                    '../assets/images/avatar/' + photo;

            } else {

                photoPath =
                    '../assets/images/uploads/user_photos/' + photo;
            }

            $('#oldPhotoEdit').attr('src', photoPath);
            $('#newPhotoEdit').attr('src', photoPath);

        });

        // GENDER DIGANTI SAAT EDIT OTOMATIS AVATAR GANTI
        $('#genderEdit').on('change', function() {

            if ($('#removePhoto').is(':checked')) {

                let avatar =
                    $(this).val() === 'Perempuan' ?
                    '../assets/images/avatar/avatar-women.png' :
                    '../assets/images/avatar/avatar-men.png';

                $('#newPhotoEdit').attr(
                    'src',
                    avatar
                );
            }

        });

        // Centang Hapus Foto
        $('#removePhoto').on('change', function() {

            if ($(this).is(':checked')) {

                let gender =
                    $('#genderEdit').val();

                let avatar =
                    gender === 'Perempuan' ?
                    '../assets/images/avatar/avatar-women.png' :
                    '../assets/images/avatar/avatar-men.png';

                $('#newPhotoEdit').attr(
                    'src',
                    avatar
                );
            }

        });
    </script>

    <script>
        // FUNGSI HITUNG UMUR
        function hitungUmur(tanggalLahir) {

            if (!tanggalLahir) return '';

            const today = new Date();
            const birthDate = new Date(tanggalLahir);

            let umur = today.getFullYear() - birthDate.getFullYear();

            const bulan =
                today.getMonth() -
                birthDate.getMonth();

            if (
                bulan < 0 ||
                (
                    bulan === 0 &&
                    today.getDate() < birthDate.getDate()
                )
            ) {
                umur--;
            }

            return umur;
        }

        // MODAL TAMBAH
        $('#tanggalLahirTambah').on('change', function() {

            let umur = hitungUmur($(this).val());

            if (umur !== '') {

                $('#umurText').html(
                    '<b>Umur:</b> ' +
                    umur +
                    ' Tahun'
                );

            } else {

                $('#umurText').html(
                    'Umur akan muncul di sini'
                );

            }

        });

        // MODAL EDIT
        $('#tanggalLahirEdit').on('change', function() {

            let umur = hitungUmur($(this).val());

            if (umur !== '') {

                $('#umurTextEdit').html(
                    '<b>Umur:</b> ' +
                    umur +
                    ' Tahun'
                );

            } else {

                $('#umurTextEdit').html(
                    'Umur akan muncul di sini'
                );

            }

        });
    </script>

    <script>
        function toggleBulkButton() {

            let checked =
                $('.rowCheck:checked').length;

            if (checked > 0) {

                $('#inactiveSelected').show();

            } else {

                $('#inactiveSelected').hide();

            }
        }

        // CHECK ALL
        $('#checkAll').on('change', function() {

            $('.rowCheck').prop(
                'checked',
                $(this).prop('checked')
            );

            toggleBulkButton();

        });

        // CHECK SATUAN
        $(document).on(
            'change',
            '.rowCheck',
            function() {

                $('#checkAll').prop(
                    'checked',
                    $('.rowCheck').length ===
                    $('.rowCheck:checked').length
                );

                toggleBulkButton();

            }
        );
    </script>


    <script>
        const rows = $('#dataTable tbody tr');

        function filterTable() {

            let role =
                $('#roleFilter').val().toLowerCase();

            let status =
                $('#statusFilter').val().toLowerCase();

            let search =
                $('#searchInput').val().toLowerCase();

            let visibleRows = 0;

            rows.each(function() {

                let row = $(this);

                let rowRole =
                    row.find('td:eq(5)')
                    .text()
                    .toLowerCase();

                let rowStatus =
                    row.find('td:eq(6)')
                    .text()
                    .toLowerCase();

                let rowText =
                    row.text().toLowerCase();

                let matchRole = !role || rowRole === role;

                let matchStatus = !status || rowStatus.includes(status);

                let matchSearch = !search || rowText.includes(search);

                if (
                    matchRole &&
                    matchStatus &&
                    matchSearch
                ) {

                    row.show();
                    visibleRows++;

                } else {

                    row.hide();

                }

            });

            $('#showingInfo').html(
                'Showing ' +
                visibleRows +
                ' entries'
            );
        }

        $('#roleFilter').on(
            'change',
            filterTable
        );

        $('#statusFilter').on(
            'change',
            filterTable
        );

        $('#searchInput').on(
            'keyup',
            filterTable
        );

        // SHOW ENTRIES
        $('#showEntries').on('change', function() {

            let limit =
                parseInt($(this).val());

            let visible = 0;

            $('#dataTable tbody tr').each(function() {

                if ($(this).css('display') !== 'none') {

                    visible++;

                    if (visible <= limit) {

                        $(this).show();

                    } else {

                        $(this).hide();

                    }
                }

            });

        });
    </script>

    <script>
        function togglePassword() {

            const input =
                document.querySelector(
                    '#modalTambah input[name="password"]'
                );

            input.type =
                input.type === 'password' ?
                'text' :
                'password';
        }

        function togglePasswordEdit() {

            const input =
                document.getElementById('passwordEdit');

            input.type =
                input.type === 'password' ?
                'text' :
                'password';
        }
    </script>

</body>

</html>