<?php
session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . "/../koneksi.php";

$user_id = $_SESSION['user_id'] ?? 0;

$userLogin = mysqli_query($conn, "
    SELECT
        u.id,
        u.role_id,
        up.full_name
    FROM users u
    LEFT JOIN user_profile up
        ON up.user_id = u.id
    WHERE u.id = '$user_id'
    LIMIT 1
");

if (!$userLogin) {
    die(mysqli_error($conn));
}

$userData = mysqli_fetch_assoc($userLogin);

$user_id   = $userData['id'];
$role_id   = $userData['role_id'];
$full_name = $userData['full_name'] ?? '-';
/*
|--------------------------------------------------------------------------
| AMBIL KATEGORI
|--------------------------------------------------------------------------
*/
$kategori = mysqli_query($conn, "
    SELECT id, name_category
    FROM post_category
    ORDER BY name_category ASC
");

/*
|--------------------------------------------------------------------------
| AMBIL SUB KATEGORI
|--------------------------------------------------------------------------
*/
$subkategori = mysqli_query($conn, "
    SELECT
        id,
        post_category_id,
        name_subcategory
    FROM post_subcategory
    ORDER BY name_subcategory ASC
");

/*
|--------------------------------------------------------------------------
| SIMPAN POST
|--------------------------------------------------------------------------
*/
if (isset($_POST['simpan_postingan'])) {
    $post_title          = trim($_POST['post_title']);
    $post_sub_title      = trim($_POST['post_sub_title']);
    $post_category_id    = (int) $_POST['post_category_id'];
    $post_subcategory_id = (int) $_POST['post_subcategory_id'];
    $post_desc           = $_POST['post_desc'];

    /*
    |----------------------------------------------------------
    | SLUG
    |----------------------------------------------------------
    */
    $slug = strtolower($post_title);

    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

    /*
    |----------------------------------------------------------
    | UPLOAD GAMBAR
    |----------------------------------------------------------
    */
    $gambar = '';

    if (!empty($_FILES['post_image']['name'])) {
        $ext = pathinfo(
            $_FILES['post_image']['name'],
            PATHINFO_EXTENSION
        );

        $gambar = time() . '_' . uniqid() . '.' . $ext;

        $uploadDir = '../assets/images/uploads/posts/';

        move_uploaded_file(
            $_FILES['post_image']['tmp_name'],
            $uploadDir . $gambar
        );
    }

    /*
    |----------------------------------------------------------
    | INSERT POST
    |----------------------------------------------------------
    */
    $insert = mysqli_query($conn, "
        INSERT INTO post
        (
            post_title,
            post_sub_title,
            post_category_id,
            post_subcategory_id,
            role_id,
            user_id,
            post_desc,
            post_image,
            slug,
            status,
            created_at
        )
        VALUES
        (
            '" . mysqli_real_escape_string($conn, $post_title) . "',
            '" . mysqli_real_escape_string($conn, $post_sub_title) . "',
            '$post_category_id',
            '$post_subcategory_id',
            '$role_id',
            '$user_id',
            '" . mysqli_real_escape_string($conn, $post_desc) . "',
            '$gambar',
            '$slug',
            'publish',
            NOW()
        )
    ");

    if ($insert) {
        $post_id = mysqli_insert_id($conn);

        $tags = [];
        if (!empty($_POST['tags'])) {
            $rawTags = $_POST['tags'];
            $decoded = json_decode($rawTags, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $tags = $decoded;
            } else {
                $parts = array_filter(array_map('trim', explode(',', $rawTags)));
                foreach ($parts as $part) {
                    $tags[] = ['value' => $part];
                }
            }
        }

        if (!empty($post_id) && !empty($tags)) {
            foreach ($tags as $tag) {
                $tagName = trim($tag['value']);

                $cekTag = mysqli_query($conn, "
                    SELECT id
                    FROM tags
                    WHERE tag_name='" . mysqli_real_escape_string($conn, $tagName) . "'
                    LIMIT 1
                ");

                if (mysqli_num_rows($cekTag)) {
                    $tagId = mysqli_fetch_assoc($cekTag)['id'];
                } else {
                    $slugTag = strtolower($tagName);
                    $slugTag = preg_replace('/[^a-z0-9]+/', '-', $slugTag);

                    mysqli_query($conn, "
    INSERT INTO tags
    (
        tag_name,
        tag_slug,
        created_at
    )
    VALUES
    (
        '" . mysqli_real_escape_string($conn, $tagName) . "',
        '$slugTag',
        NOW()
    )
");

                    $tagId = mysqli_insert_id($conn);
                }

                mysqli_query($conn, "
                    INSERT INTO post_tags
                    (
                        post_id,
                        tag_id
                    )
                    VALUES
                    (
                        '$post_id',
                        '$tagId'
                    )
                ");
            }
        }

        $_SESSION['post_success'] = true;
        
        header("Location: add_post.php");
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| TAGS
|--------------------------------------------------------------------------
*/
$tags_master = [];

$qTags = mysqli_query($conn, "
    SELECT id, tag_name
    FROM tags
    ORDER BY tag_name ASC
");

while ($row = mysqli_fetch_assoc($qTags)) {
    $tags_master[] = $row['tag_name'];
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
    <title>Tambah Postingan - Dashboard | Hukuminfo.id</title>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- Tagify -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">

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

    <!-- SUMMERNOTE -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

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
                                        Manage Postingan
                                    </li>
                                </ol>
                            </nav>
                            <h1 class="m-0">Manage Postingan</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // END page__header -->

            <!-- ********************************// START page__content //******************************* -->
            <div class="container-fluid page__container">
                <div class="container-fluid mt-4">

                    <!-- HEADER -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-1">Tambah Postingan</h4>
                            <p class="text-muted mb-0">
                                Lengkapi informasi untuk menambahkan artikel atau berita baru.
                            </p>
                        </div>
                    </div>

                    <!-- CARD FORM -->
                    <div class="card p-4" style="border-radius:14px; border:none;">
                        <form method="POST"
                            enctype="multipart/form-data">
                            <!-- JUDUL -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">
                                    Judul Postingan
                                </label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white">
                                            <span class="material-icons" style="font-size:20px;">
                                                title
                                            </span>
                                        </span>
                                    </div>

                                    <input
                                        type="text"
                                        name="post_title"
                                        class="form-control"
                                        placeholder="Masukkan judul artikel atau berita">
                                </div>
                            </div>

                            <!-- SUB JUDUL -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">
                                    Sub Judul Postingan
                                </label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white">
                                            <span class="material-icons" style="font-size:20px;">
                                                title
                                            </span>
                                        </span>
                                    </div>

                                    <input
                                        type="text"
                                        name="post_sub_title"
                                        class="form-control"
                                        placeholder="Masukkan sub judul artikel atau berita">
                                </div>
                            </div>

                            <!-- KATEGORI -->
                            <div class="row">

                                <!-- KATEGORI -->
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold">
                                            Kategori
                                        </label>

                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <span class="input-group-text bg-white">
                                                    <span class="material-icons" style="font-size:20px;">
                                                        add_circle
                                                    </span>
                                                </span>
                                            </div>

                                            <div class="flex-fill">
                                                <select
                                                    name="post_category_id" id="post_category_id"
                                                    class="form-control select2"
                                                    required>

                                                    <option value="">
                                                        ---Pilih Kategori---
                                                    </option>

                                                    <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
                                                        <option value="<?= $k['id']; ?>">
                                                            <?= htmlspecialchars($k['name_category']); ?>
                                                        </option>
                                                    <?php endwhile; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SUB KATEGORI -->
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold">
                                            Sub Kategori
                                        </label>

                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <span class="input-group-text bg-white">
                                                    <span class="material-icons" style="font-size:20px;">
                                                        add_circle
                                                    </span>
                                                </span>
                                            </div>

                                            <div class="flex-fill">
                                                <select
                                                    name="post_subcategory_id" id="post_subcategory_id"
                                                    class="form-control select2"
                                                    disabled
                                                    required>

                                                    <option value="">
                                                        ---Pilih Sub Kategori---
                                                    </option>

                                                    <?php while ($s = mysqli_fetch_assoc($subkategori)) : ?>
                                                        <option value="<?= $s['id']; ?>">
                                                            <?= htmlspecialchars($s['name_subcategory']); ?>
                                                        </option>
                                                    <?php endwhile; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- SUMMERNOTE -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold">
                                    Isi Konten
                                </label>

                                <textarea name="post_desc" id="summernote"></textarea>
                            </div>

                            <!-- Tags -->
                            <div class="form-group mb-4">

                                <label class="font-weight-bold">
                                    Tags
                                </label>

                                <div class="d-flex">

                                    <span id="tagsIcon"
                                        class="input-group-text bg-white"
                                        style="border-right:0;">

                                        <span class="fa fa-hashtag"></span>

                                    </span>

                                    <input
                                        type="text"
                                        id="tagsInput"
                                        name="tags"
                                        placeholder="Masukkan tags">

                                </div>

                            </div>

                            <!-- UPLOAD IMAGE -->
                            <div class="form-group mb-4">

                                <label class="font-weight-bold">
                                    Fitur Gambar / Thumbnail
                                </label>

                                <div
                                    class="border p-4"
                                    style="
            border-radius:12px;
            border-style:dashed !important;
            background:#fafbfe;
        ">

                                    <div class="d-flex align-items-center justify-content-between">

                                        <div class="d-flex align-items-center">

                                            <div
                                                class="d-flex align-items-center justify-content-center mr-3"
                                                style="
                        width:70px;
                        height:70px;
                        border-radius:12px;
                        background:rgba(103,116,223,.1);
                    ">

                                                <span
                                                    class="material-icons"
                                                    style="
                            font-size:36px;
                            color:var(--primary);
                        ">
                                                    cloud_upload
                                                </span>
                                            </div>

                                            <div>
                                                <h6 class="mb-1">
                                                    Upload Thumbnail Postingan
                                                </h6>

                                                <small class="text-muted">
                                                    Format JPG, PNG, JPEG maksimal 2MB
                                                </small>
                                            </div>

                                        </div>

                                        <div>

                                            <input
                                                type="file"
                                                name="post_image"
                                                id="uploadThumbnail"
                                                accept="image/*"
                                                hidden>

                                            <button
                                                type="button"
                                                class="btn btn-outline-primary d-flex align-items-center"
                                                onclick="document.getElementById('uploadThumbnail').click()">

                                                <span class="material-icons mr-2" style="font-size:20px;">
                                                    image
                                                </span>

                                                Pilih Gambar
                                            </button>

                                        </div>

                                    </div>

                                    <!-- PREVIEW IMAGE -->
                                    <div
                                        id="previewContainer"
                                        class="mt-4"
                                        style="display:none;">

                                        <div class="d-flex align-items-center">

                                            <img
                                                id="previewImage"
                                                src=""
                                                alt="Preview"
                                                style="
                        width:180px;
                        height:120px;
                        object-fit:cover;
                        border-radius:12px;
                        border:1px solid #dbe5ee;
                    ">

                                            <div class="ml-3">

                                                <h6 class="mb-1">
                                                    Preview Thumbnail
                                                </h6>

                                                <small
                                                    id="fileName"
                                                    class="text-muted">
                                                </small>

                                                <div class="mt-2">
                                                    <button
                                                        type="button"
                                                        id="removeImage"
                                                        class="btn btn-sm btn-danger d-flex align-items-center">

                                                        <span class="material-icons mr-1" style="font-size:16px;">
                                                            delete
                                                        </span>

                                                        Hapus
                                                    </button>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row my-4">

                                <div class="col-md-6">

                                    <div class="form-group my-3">

                                        <label class="font-weight-bold">
                                            Penulis
                                        </label>

                                        <select
                                            class="form-control"
                                            name="author_view" disabled>

                                            <option value="<?= $user_id; ?>" selected>
                                                <?= htmlspecialchars($full_name); ?>
                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <!-- ACTION BUTTON -->
                            <div class="d-flex align-items-center">

                                <button type="submit"
                                    name="simpan_postingan"
                                    class="btn btn-primary d-flex align-items-center mr-2">
                                    <span class="material-icons mr-2" style="font-size:20px;">
                                        save
                                    </span>
                                    Simpan Post
                                </button>

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
    MODAL SUKSES POSTINGAN
========================= -->

    <div class="modal fade" id="modalSuccessPosting" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content border-0"
                style="
                border-radius:18px;
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
                        Posting Berhasil
                    </h4>

                    <!-- TEXT -->
                    <p class="text-muted mb-4" id="successPostingText">
                        Postingan berhasil ditambahkan
                    </p>

                    <!-- BUTTON -->
                    <button type="button"
                        id="btnOkayPosting"
                        class="btn btn-success px-4"
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

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Tagify -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

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
    <script src="assets/vendor/toastr.min.js"></script>
    <script src="assets/js/toastr.js"></script>

    <!-- SUMMERNOTE -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>

    <script>
        $('#summernote').summernote({
            placeholder: 'Tulis isi artikel atau berita...',
            tabsize: 2,
            height: 350,
            spellCheck: true,

            fontNames: [
                'Arial',
                'Arial Black',
                'Comic Sans MS',
                'Courier New',
                'Helvetica',
                'Impact',
                'Roboto',
                'Tahoma',
                'Times New Roman',
                'Verdana',
                'Poppins',
                'Montserrat'
            ],

            fontNamesIgnoreCheck: [
                'Poppins',
                'Montserrat'
            ],

            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'italic', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
        $('.note-editable').attr('spellcheck', 'true');
    </script>

    <script>
        const uploadThumbnail = document.getElementById('uploadThumbnail');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const fileName = document.getElementById('fileName');
        const removeImage = document.getElementById('removeImage');

        uploadThumbnail.addEventListener('change', function() {

            const file = this.files[0];

            if (file) {

                const reader = new FileReader();

                reader.onload = function(e) {

                    previewImage.src = e.target.result;
                    fileName.textContent = file.name;

                    previewContainer.style.display = 'block';
                }

                reader.readAsDataURL(file);
            }

        });

        removeImage.addEventListener('click', function() {

            uploadThumbnail.value = '';
            previewImage.src = '';
            fileName.textContent = '';

            previewContainer.style.display = 'none';

        });
    </script>

    <script>
        const allSubCategory = [
            <?php
            mysqli_data_seek($subkategori, 0);

            while ($s = mysqli_fetch_assoc($subkategori)) {
            ?> {
                    id: '<?= $s['id']; ?>',
                    category_id: '<?= $s['post_category_id']; ?>',
                    name: '<?= htmlspecialchars($s['name_subcategory'], ENT_QUOTES); ?>'
                },
            <?php
            }
            ?>
        ];
    </script>

    <script>
        $('#post_category_id').on('change', function() {

            let categoryId = $(this).val();

            $('#post_subcategory_id')
                .empty()
                .append('<option value="">--- Pilih Sub Kategori ---</option>');

            if (categoryId === '') {
                $('#post_subcategory_id')
                    .prop('disabled', true);

                return;
            }

            allSubCategory.forEach(function(item) {

                if (item.category_id == categoryId) {
                    $('#post_subcategory_id').append(
                        new Option(item.name, item.id)
                    );
                }

            });

            $('#post_subcategory_id')
                .prop('disabled', false);

        });
    </script>

    <script>
        $(function() {

            $('#post_category_id').select2({
                width: '100%'
            });

            $('#post_subcategory_id').select2({
                width: '100%'
            });

            $('#post_subcategory_id').prop('disabled', true);

        });
    </script>

    <script>
        const tagsWhitelist =
            <?= json_encode($tags_master); ?>;
    </script>

    <script>
        const input = document.querySelector('#tagsInput');

        const tagify = new Tagify(input, {
            whitelist: tagsWhitelist,
            enforceWhitelist: false,
            dropdown: {
                enabled: 1,
                maxItems: 20,
                closeOnSelect: true
            }
        });

        tagify.on('add', syncTagHeight);
        tagify.on('remove', syncTagHeight);

        function syncTagHeight() {
            const tagifyEl = tagify.DOM.scope;

            $('#tagsIcon').css(
                'height',
                tagifyEl.offsetHeight + 'px'
            );
        }
    </script>

    <?php if (isset($_SESSION['post_success'])) : ?>
        <script>
            $(window).on('load', function() {

                $('#modalSuccessPosting').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#modalSuccessPosting').modal('show');

                let countdown = 3;

                $('#btnOkayPosting').text(
                    'Okay (' + countdown + ')'
                );

                let timer = setInterval(function() {

                    countdown--;

                    $('#btnOkayPosting').text(
                        'Okay (' + countdown + ')'
                    );

                    if (countdown <= 0) {
                        clearInterval(timer);

                        window.location.href =
                            'manage_post.php';
                    }

                }, 1000);

                $('#btnOkayPosting').on('click', function() {

                    window.location.href =
                        'manage_post.php';

                });

            });
        </script>
        <?php unset($_SESSION['post_success']); ?>
    <?php endif; ?>

</body>

</html>