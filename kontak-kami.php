<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Kontak Kami - Hukuminfo.id</title>
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

    <!-- Breadcrumb  -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="index.html" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> Beranda</a>
                        </li>
                        <li class="breadcrumbs__item breadcrumbs__item--current">
                            Kontak Kami
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb  -->


    <!-- Form contact -->
    <section class="wrap__contact-form">
        <div class="container">
            <div class="row">
                <div class="card-body border-top-1 border-primary rounded-0">
                    <div class="container-fluid">
                        <h3 class="text-center fw-bolder">Send us a Message</h3>
                        <center>
                            <hr class="bg-primary bg-opacity-100 opacity-100 my-1" width="50em">
                        </center>
                        <form action="" id="contact-form">
                            <input type="hidden" name="id">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <input type="text" id="userName" name="fullname" class="form-control form-control-sm rounded-0 form-control-border" required autocomplete="off" placeholder="Enter Fullname here">
                                        <small class="px-1 field-label">Fullname</small>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <input type="email" id="userEmail" name="email" class="form-control form-control-sm rounded-0 form-control-border" required autocomplete="off" placeholder="Enter Email here">
                                        <small class="px-1 field-label">Email</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <input type="subject" id="subject" name="subject" class="form-control form-control-sm rounded-0 form-control-border" required autocomplete="off" placeholder="Enter Subject here">
                                        <small class="px-1 field-label">Subject</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control rounded-0" id="userMessage-info" name="message" rows="4" required placeholder="Write your message here"></textarea>
                                        <small class="px-1 field-label">Message</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary bg-gradient rounded-pill btn-lg col-md-4"><i class="fa fa-paper-plane"></i> Send Message</button>
                                    <?php
                                    if (! empty($message)) {
                                    ?>
                                        <p class='<?php echo $type; ?>Message'><?php echo $message; ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    $(function() {
                        $('#contact-form').submit(function(e) {
                            e.preventDefault();
                            var _this = $(this)
                            $('.pop-msg').remove()
                            var _el = $("<div>")
                            _el.addClass("alert pop-msg my-2")
                            _el.html('<div class="d-flex w-100 align-items-center">' +
                                '<div class="text-msg col-11"></div>' +
                                '<div class="col-1"><button class="btn-close" id="pop-msg-btn"></button></div>' +
                                '</div>')
                            _el.hide()
                            _el.find('#pop-msg-btn').click(function() {
                                _el.hide('slideUp')
                                setTimeout(() => {
                                    _el.remove()
                                }, 1000);
                            })
                            if (_this[0].checkValidity() == false) {
                                _this[0].reportValidity();
                                return false;
                            }
                            console.log(_this.serialize())
                            _this.find('input,select,textarea').attr('readonly', true)
                            _this.find('button').attr('disabled', true)
                            $.ajax({
                                url: 'Actions.php?a=save_message',
                                method: 'POST',
                                type: 'POST',
                                data: $(this).serialize(),
                                dataType: 'json',
                                error: err => {
                                    console.log(err)
                                    _el.addClass('alert-danger')
                                    _el.find('.text-msg').text("An error occurred.")
                                    _this.before(_el)
                                    _el.show()
                                    _this.find('input,select,textarea').attr('readonly', false)
                                    _this.find('button').attr('disabled', false)
                                },
                                success: function(resp) {
                                    if (!!resp.msg) {
                                        _el.find('.text-msg').text(resp.msg)
                                    }
                                    if (resp.status == 'success') {
                                        _el.addClass('alert-success')
                                        _this[0].reset(0)
                                    } else {
                                        _el.addClass('alert-danger')
                                        if (!resp.msg) {
                                            _el.find('.text-msg').text('An error occurred.')
                                        }
                                    }
                                    _this.before(_el)
                                    _el.show()
                                    _this.find('input,select,textarea').attr('readonly', false)
                                    _this.find('button').attr('disabled', false)
                                }
                            })
                        })
                    })
                </script>


                <div class="col-md-4">
                    <h5>Info location</h5>
                    <div class="wrap__contact-form-office">
                        <ul class="list-unstyled">
                            <li>
                                <span>
                                    <i class="fa fa-home"></i>
                                </span>

                                PO Box 16122 Collins Street West Victoria
                                8007 Australia


                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-phone"></i>
                                    <a href="tel:">(+12) 34567 890 123</a>
                                </span>

                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:">mail@example.com</a>
                                </span>

                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-globe"></i>
                                    <a href="#" target="_blank"> www.yourdomain.com</a>
                                </span>
                            </li>
                        </ul>

                        <div class="social__media">
                            <h5>find us</h5>
                            <ul class="list-inline">

                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social rounded text-white facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social rounded text-white twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social rounded text-white whatsapp">
                                        <i class="fa fa-whatsapp"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social rounded text-white telegram">
                                        <i class="fa fa-telegram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social rounded text-white linkedin">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Form contact  -->


    <section class="wrapper__section p-0">
        <div class="wrapper__section__components">
            <?php include 'includes/footer.php'; ?>
        </div>
    </section>


    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="./js/index.bundle.js?537a1bbd0e5129401d28"></script>
</body>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script type="text/javascript">
    function validateContactForm() {
        var valid = true;

        $(".info").html("");
        $(".input-field").css('border', '#e0dfdf 1px solid');
        var userName = $("#userName").val();
        var userEmail = $("#userEmail").val();
        var subject = $("#subject").val();
        var content = $("#content").val();

        if (userName == "") {
            $("#userName-info").html("Required.");
            $("#userName").css('border', '#e66262 1px solid');
            valid = false;
        }
        if (userEmail == "") {
            $("#userEmail-info").html("Required.");
            $("#userEmail").css('border', '#e66262 1px solid');
            valid = false;
        }
        if (!userEmail.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
            $("#userEmail-info").html("Invalid Email Address.");
            $("#userEmail").css('border', '#e66262 1px solid');
            valid = false;
        }

        if (subject == "") {
            $("#subject-info").html("Required.");
            $("#subject").css('border', '#e66262 1px solid');
            valid = false;
        }
        if (content == "") {
            $("#userMessage-info").html("Required.");
            $("#content").css('border', '#e66262 1px solid');
            valid = false;
        }
        return valid;
    }
</script>

</html>