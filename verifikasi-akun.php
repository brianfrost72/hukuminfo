<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Verifikasi Akun - Hukuminfo.id</title>
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

    <style>
        .otp-input {
            width: 60px !important;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            border-radius: 12px;
        }

        @media(max-width:576px) {
            .otp-input {
                width: 50px !important;
                height: 50px;
                font-size: 20px;
            }
        }
    </style>
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
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-5 text-center">

                            <h2 class="mb-3">Verifikasi Akun</h2>

                            <p class="text-muted mb-4">
                                Masukkan 5 digit kode verifikasi yang telah dikirim ke email Anda.
                            </p>

                            <form action="proses-verifikasi.php" method="POST" id="otpForm">

                                <div class="d-flex justify-content-center gap-2 mb-4">
                                    <input type="text" class="otp-input form-control" maxlength="1" name="otp1" autocomplete="off">
                                    <input type="text" class="otp-input form-control" maxlength="1" name="otp2" autocomplete="off">
                                    <input type="text" class="otp-input form-control" maxlength="1" name="otp3" autocomplete="off">
                                    <input type="text" class="otp-input form-control" maxlength="1" name="otp4" autocomplete="off">
                                    <input type="text" class="otp-input form-control" maxlength="1" name="otp5" autocomplete="off">
                                </div>

                                <input type="hidden" name="kode_verifikasi" id="kode_verifikasi">

                                <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                    Verifikasi Akun
                                </button>

                            </form>

                            <div class="mt-4">
                                <small class="text-muted">
                                    Tidak menerima kode?
                                    <a href="#">Kirim Ulang</a>
                                </small>
                            </div>

                        </div>
                    </div>
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

            const inputs = document.querySelectorAll('.otp-input');
            const form = document.getElementById('otpForm');
            const hiddenInput = document.getElementById('kode_verifikasi');

            inputs.forEach((input, index) => {

                input.addEventListener('input', function(e) {

                    this.value = this.value.replace(/[^0-9]/g, '');

                    if (this.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }

                    updateOTP();
                });

                input.addEventListener('keydown', function(e) {

                    if (e.key === 'Backspace') {

                        if (this.value !== '') {
                            this.value = '';
                            e.preventDefault();
                        } else if (index > 0) {
                            inputs[index - 1].value = '';
                            inputs[index - 1].focus();
                            e.preventDefault();
                        }

                        updateOTP();
                    }

                    if (e.key === 'Enter') {
                        e.preventDefault();
                        form.submit();
                    }
                });

                input.addEventListener('paste', function(e) {

                    e.preventDefault();

                    let data = (e.clipboardData || window.clipboardData)
                        .getData('text')
                        .replace(/\D/g, '')
                        .substring(0, 5);

                    data.split('').forEach((char, i) => {
                        if (inputs[i]) {
                            inputs[i].value = char;
                        }
                    });

                    updateOTP();

                    let lastIndex = Math.min(data.length, 5) - 1;
                    if (lastIndex >= 0) {
                        inputs[lastIndex].focus();
                    }
                });
            });

            function updateOTP() {
                let otp = '';

                inputs.forEach(input => {
                    otp += input.value;
                });

                hiddenInput.value = otp;
            }

            inputs[0].focus();
        });
    </script>
</body>

</html>