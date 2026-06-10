<?php

session_start();

/*
|--------------------------------------------------------------------------
| CEGAH AKSES HALAMAN REGISTRASI JIKA SUDAH LOGIN
|--------------------------------------------------------------------------
*/
if (isset($_SESSION['user_id'])) {

    // arahkan ke dashboard
    header("Location: /");
    exit;
}

require_once __DIR__ . "/koneksi.php";

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Registrasi - Hukuminfo.id</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="icon.png">

    <meta name="theme-color" content="#030303">
    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <link href="./css/styles.css?537a1bbd0e5129401d28" rel="stylesheet">
</head>

<body>
    <!-- loading -->
    <div class="loading-container">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <ul class="list-unstyled">
                <li>
                    <img src="images/placeholder/loading.png" alt="Alternate Text" height="100" />

                </li>
                <li>

                    <div class="spinner">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>

                    </div>

                </li>
                <li>
                    <p>Loading</p>
                </li>
            </ul>
        </div>
    </div>
    <!-- End loading -->

    <!-- Header  -->
    <header>
        <!-- Navbar  -->
        <div class="topbar d-none d-sm-block">
            <?php include 'includes/top-header.php'; ?>
        </div>
        <!-- Navbar menu  -->
        <div class="navigation-wrap navigation-shadow bg-white">
            <?php include 'includes/navbar.php'; ?>
        </div>
        <!-- End Navbar menu  -->

        <!-- Navbar sidebar menu  -->
        <?php include 'includes/mobile_menu.php'; ?>
        <!-- End Navbar sidebar menu  -->
        <!-- End Navbar  -->
    </header>
    <!-- End Header  -->

    <!-- login -->
    <section class="wrap__section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- register -->
                    <!-- Form Register -->

                    <div class="card mx-auto" style="max-width: 520px">
                        <article class="card-body">
                            <header class="mb-4">
                                <h4 class="card-title text-center">Registrasi</h4>
                            </header>
                            <form action="logic/proses-registrasi.php" method="POST">
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="fullname" class="form-control" placeholder="Tuliskan Nama Lengkap Anda" />
                                    </div>
                                    <!-- form-group end.// -->
                                </div>
                                <!-- form-row end.// -->

                                <div class="form-group">
                                    <label>Nomor Hp</label>
                                    <input type="text" name="phone_number" class="form-control" placeholder="Tuliskan Nomor Hp Anda" />
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="" />
                                    <small class="form-text text-muted">Kami tidak akan membagikan email Anda.</small>
                                </div>
                                <!-- form-group end.// -->
                                <div class="form-group">
                                    <label
                                        class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input"
                                            type="radio"
                                            name="gender"
                                            value="Laki-laki"
                                            checked>
                                        <span class="custom-control-label"> Laki-Laki </span>
                                    </label>
                                    <label
                                        class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input"
                                            type="radio"
                                            name="gender"
                                            value="Perempuan">
                                        <span class="custom-control-label"> Perempuan </span>
                                    </label>
                                </div>
                                <!-- form-group end.// -->
                                <div class="form-row">
                                    <!-- form-group end.// -->
                                    <div class="form-group col-md-6">
                                        <label>Provinsi</label>
                                        <select id="provinsi"
                                            name="provinces_id"
                                            class="form-control">

                                            <option value="">Pilih Provinsi</option>

                                            <?php
                                            $provinsi = mysqli_query(
                                                $conn,
                                                "SELECT id,name
         FROM provinces
         ORDER BY name ASC"
                                            );

                                            while ($row = mysqli_fetch_assoc($provinsi)) {
                                            ?>
                                                <option value="<?= $row['id']; ?>">
                                                    <?= htmlspecialchars($row['name']); ?>
                                                </option>
                                            <?php } ?>

                                        </select>
                                    </div><!-- form-group end.// -->
                                    <div class="form-group col-md-6">
                                        <label>Kabupaten</label>
                                        <select id="kabupaten" name="regencies_id" class="form-control" disabled>
                                            <option value="">Pilih Provinsi Terlebih Dahulu</option>
                                        </select>
                                    </div>
                                    <!-- form-group end.// -->
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Alamat</label>
                                        <textarea name="address" id="alamat" class="form-control"></textarea>
                                    </div>
                                </div>

                                <!-- form-row.// -->
                                <div class="form-row">
                                    <!-- Password -->
                                    <div class="form-group col-md-6">
                                        <label>Buat Password</label>
                                        <div class="input-group">
                                            <input
                                                id="password"
                                                name="password"
                                                class="form-control"
                                                type="password"
                                                placeholder="Masukkan Password">

                                            <div class="input-group-append">
                                                <button
                                                    class="btn btn-outline-secondary"
                                                    type="button"
                                                    id="togglePassword"
                                                    title="Tampilkan/Sembunyikan Password">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Konfirmasi Password -->
                                    <div class="form-group col-md-6">
                                        <label>Ketik Ulang Password</label>
                                        <div class="input-group">
                                            <input
                                                id="confirmPassword"
                                                name="confirm_password"
                                                class="form-control"
                                                type="password"
                                                placeholder="Ketik Ulang Password">

                                            <div class="input-group-append">
                                                <button
                                                    class="btn btn-outline-secondary"
                                                    type="button"
                                                    id="toggleConfirmPassword"
                                                    title="Tampilkan/Sembunyikan Password">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <small id="passwordMatch" class="form-text"></small>
                                    </div>
                                </div>

                                <!-- form-group// -->
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            name="agree_terms"
                                            id="agreeTerms"
                                            class="custom-control-input">

                                        <span class="custom-control-label">
                                            Saya menyetujui
                                            <a href="#" id="openTerms">
                                                Syarat & Ketentuan
                                            </a>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Register
                                    </button>
                                </div>
                                <!-- form-group end.// -->
                            </form>
                        </article>
                        <!-- card-body.// -->
                    </div>
                    <!-- end register -->
                </div>
            </div>
        </div>
    </section>
    <!-- end login -->


    <section class="wrapper__section p-0">
        <div class="wrapper__section__components">
            <?php include 'includes/footer.php'; ?>
        </div>
    </section>

    <!-- Modal Syarat & Ketentuan -->
    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Syarat & Ketentuan Hukuminfo.id</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="max-height:500px;overflow-y:auto;">

                    <h6>1. Ketentuan Umum</h6>
                    <p>
                        Dengan melakukan registrasi pada Hukuminfo.id, pengguna
                        menyatakan telah membaca, memahami, dan menyetujui seluruh
                        syarat dan ketentuan yang berlaku.
                    </p>

                    <h6>2. Akun Pengguna</h6>
                    <p>
                        Pengguna wajib memberikan data yang benar, lengkap,
                        dan dapat dipertanggungjawabkan.
                    </p>

                    <h6>3. Privasi Data</h6>
                    <p>
                        Data pribadi pengguna akan digunakan sesuai dengan
                        Kebijakan Privasi Hukuminfo.id dan tidak diperjualbelikan
                        kepada pihak ketiga tanpa izin pengguna.
                    </p>

                    <h6>4. Larangan</h6>
                    <ul class="pl-4">
                        <li>Menyebarkan informasi palsu atau menyesatkan.</li>
                        <li>Mengunggah konten yang melanggar hukum.</li>
                        <li>Menggunakan akun untuk aktivitas spam.</li>
                        <li>Menyalahgunakan layanan website.</li>
                    </ul>

                    <h6>5. Penangguhan Akun</h6>
                    <p>
                        Hukuminfo.id berhak menangguhkan atau menghapus akun
                        yang melanggar ketentuan tanpa pemberitahuan terlebih dahulu.
                    </p>

                    <h6>6. Perubahan Ketentuan</h6>
                    <p>
                        Hukuminfo.id dapat mengubah syarat dan ketentuan kapan saja.
                        Pengguna bertanggung jawab untuk memeriksa perubahan tersebut.
                    </p>

                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Tidak Setuju
                    </button>

                    <button type="button"
                        class="btn btn-primary"
                        id="acceptTerms">
                        Saya Setuju
                    </button>
                </div>

            </div>
        </div>
    </div>

    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="./js/index.bundle.js?537a1bbd0e5129401d28"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            $('#provinsi').select2();
            $('#kabupaten').select2();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Password utama
            const password = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');

            togglePassword.addEventListener('click', function() {
                const type = password.type === 'password' ? 'text' : 'password';
                password.type = type;

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });

            // Konfirmasi password
            const confirmPassword = document.getElementById('confirmPassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPassword.type === 'password' ? 'text' : 'password';
                confirmPassword.type = type;

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });

            // Cek kecocokan password
            const passwordMatch = document.getElementById('passwordMatch');

            function checkPasswordMatch() {
                if (confirmPassword.value === '') {
                    passwordMatch.textContent = '';
                    return;
                }

                if (password.value === confirmPassword.value) {
                    passwordMatch.textContent = '✓ Password cocok';
                    passwordMatch.className = 'form-text text-success';
                } else {
                    passwordMatch.textContent = '✗ Password tidak cocok';
                    passwordMatch.className = 'form-text text-danger';
                }
            }

            password.addEventListener('keyup', checkPasswordMatch);
            confirmPassword.addEventListener('keyup', checkPasswordMatch);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const checkbox = document.getElementById('agreeTerms');
            const openTerms = document.getElementById('openTerms');
            const acceptTerms = document.getElementById('acceptTerms');

            // Jangan bisa dicentang langsung
            checkbox.addEventListener('click', function(e) {
                e.preventDefault();
                $('#termsModal').modal('show');
            });

            // Klik link syarat & ketentuan
            openTerms.addEventListener('click', function(e) {
                e.preventDefault();
                $('#termsModal').modal('show');
            });

            // Setuju
            acceptTerms.addEventListener('click', function() {
                checkbox.checked = true;
                $('#termsModal').modal('hide');
            });

            // Jika batal/tidak setuju
            $('#termsModal').on('hidden.bs.modal', function() {
                if (!checkbox.checked) {
                    checkbox.checked = false;
                }
            });

        });
    </script>

    <script>
        $('#provinsi').on('change', function() {

            let province_id = $(this).val();

            $('#kabupaten')
                .html('<option value="">Memuat Kabupaten...</option>')
                .prop('disabled', true);

            if (province_id == '') {

                $('#kabupaten')
                    .html('<option value="">Pilih Provinsi Terlebih Dahulu</option>')
                    .prop('disabled', true);

                return;
            }

            $.ajax({
                url: 'ajax/get-regencies.php',
                type: 'POST',
                data: {
                    province_id: province_id
                },
                success: function(response) {

                    $('#kabupaten')
                        .html(response)
                        .prop('disabled', false)
                        .trigger('change');
                },
                error: function() {

                    $('#kabupaten')
                        .html('<option value="">Gagal Memuat Data</option>')
                        .prop('disabled', true);
                }
            });

        });
    </script>
</body>

</html>