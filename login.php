<?php

session_start();

/*
|--------------------------------------------------------------------------
| CEGAH AKSES HALAMAN LOGIN JIKA SUDAH LOGIN
|--------------------------------------------------------------------------
*/
if (isset($_SESSION['user_id'])) {

    // arahkan ke dashboard atau halaman utama
    header("Location: /");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Login - Hukuminfo.id</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
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
                    <!-- Form Login -->
                    <div class="card mx-auto" style="max-width: 380px;">
                        <div class="card-body">
                            <h4 class="card-title text-center mb-4">Masuk Hufo</h4>
                            <!-- ERROR LOGIN -->
                            <?php if (isset($_GET['error'])): ?>
                                <div class="error-msg">
                                    Email Atau Kata Sandi Salah.
                                </div>
                            <?php endif; ?>
                            <!-- NONAKTIF DARI SUPERADMIN -->
                            <?php if (isset($_GET['client_admin_block'])): ?>
                                <div class="error-msg">
                                    Mohon Maaf Akun Anda Di Nonaktifkan.<br>
                                    Untuk Pertanyaan Silahkan Hubungi Admin.
                                </div>
                            <?php endif; ?>
                            <form action="logic/proses-login.php" method="POST">
                                <div class="form-group">
                                    <label>Email Anda</label>
                                    <input class="form-control" type="email" name="email" id="login-email" placeholder="Masukkan Email Anda" required>
                                </div> <!-- form-group// -->
                                <div class="form-group position-relative">
                                    <label>Password Anda</label>
                                    <input class="form-control" type="password" name="password" id="login-password" placeholder="Masukkan Password Anda" required>

                                    <span id="togglePassword"
                                        style="
            position:absolute;
            right:15px;
            top:70%;
            transform:translateY(-50%);
            cursor:pointer;
            z-index:10;
        ">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div> <!-- form-group// -->

                                <div class="form-group">
                                    <a href="reset-password" class="float-right">Lupa Password?</a>
                                    <label class="float-left custom-control custom-checkbox"> <input type="checkbox"
                                            class="custom-control-input" checked="">
                                        <span class="custom-control-label"> Ingat Saya </span>
                                    </label>
                                </div> <!-- form-group form-check .// -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"> Login </button>
                                </div> <!-- form-group// -->
                            </form>
                        </div> <!-- card-body.// -->
                    </div> <!-- card .// -->

                    <p class="text-center mt-4">Belum punya akun? <a href="registrasi">Registrasi</a></p>
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


    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="./js/index.bundle.js?537a1bbd0e5129401d28"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('login-password');
            const togglePassword = document.getElementById('togglePassword');
            const icon = togglePassword.querySelector('i');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ?
                    'text' :
                    'password';

                password.setAttribute('type', type);

                if (type === 'text') {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>

</html>