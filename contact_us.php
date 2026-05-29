<?php
include('includes/config.php');

?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <title>Sawitnews &#8211; Kontak Kami</title>
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
<link href="./css/styles.css?537a1bbd0e5129401d28" rel="stylesheet"></head>

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
    <header class="bg-light">
        <!-- Navbar  -->
        <div class="topbar d-none d-sm-block">
    <div class="container ">
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="topbar-left">
                    <div class="topbar-text">
                        <p id="Date"></p>
<script>
  // Example c: Customizing the date using options
  const date = new Date();
  const options = {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  };
  const date3 = date.toLocaleDateString('en-IN', options);
  document.getElementById("Date").innerHTML += "" + date3;
</script>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="list-unstyled topbar-right">
                    <ul class="topbar-link">
                        <li><a href="#" title="">Karir</a></li>
                        <li><a href="contact_us" title="">Kontak Kami</a></li>
<!--                        <li><a href="#" title="">Login / Register</a></li>  -->
                    </ul>
                    <ul class="topbar-sosmed">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Navbar menu  -->
<div class="navigation-wrap navigation-shadow bg-white">
    <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
        <div class="container">
            <div class="offcanvas-header">
                <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
                    <span class="navbar-toggler-icon"></span>
                </div>
            </div>
            <figure class="mb-0 mx-auto">
                <a href="index">
                    <img src="images/placeholder/logo.png" alt="" class="img-fluid logo">
                </a>
            </figure>

            <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index"> Beranda </a></li>
					<?php $query=mysqli_query($con,"select id,CategoryName from tblcategory"); while($row=mysqli_fetch_array($query))
					{
					?>
					<li class="nav-item"><a class="nav-link" href="category?catid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['CategoryName']);?></a></li>
					<?php } ?>
					<li class="nav-item"><a class="nav-link" href="team"> Redaksi </a></li>
                    
                    <li class="nav-item"><a class="nav-link" href="category"> Kategory </a></li>
                    <li class="nav-item"><a class="nav-link" href="#"> Kontak Kami </a></li>
                </ul>


                <!-- Search bar.// -->
                <ul class="navbar-nav ">
                    <li class="nav-item search hidden-xs hidden-sm "> <a class="nav-link" href="#">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                </ul>
                <!-- Search content bar.// -->
                <div class="top-search navigation-shadow">
                    <div class="container">
                        <div class="input-group">
                            <form name="search" action="search" method="post">
                                <div class="input-group">
                                    <div class="row no-gutters mt-3">
                                        <div class="col">
                                            <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
                                        </div>
                                    <div class="col-auto">
                                        <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="submit"                                            >
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Search content bar.// -->
            </div> <!-- navbar-collapse.// -->
        </div>
    </nav>
</div>
<!-- End Navbar menu  -->

<!-- Navbar sidebar menu  -->
<div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-aside" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="widget__form-search-bar  ">
    				<form name="search" action="search" method="post">
                        <div class="row no-gutters">
                            <div class="col">
                                <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="submit"                                            >
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
					</form>
				</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <nav class="list-group list-group-flush">
                    <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index"> Beranda </a></li>
					<?php $query=mysqli_query($con,"select id,CategoryName from tblcategory"); while($row=mysqli_fetch_array($query))
					{
					?>
					<li class="nav-item"><a class="nav-link" href="category?catid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['CategoryName']);?></a></li>
					<?php } ?>
					<li class="nav-item"><a class="nav-link" href="about-us"> Redaksi </a></li>
                    
                    <li class="nav-item"><a class="nav-link" href="category"> Kategory </a></li>
                    <li class="nav-item"><a class="nav-link" href="#"> Kontak Kami </a></li>
                </ul>

                </nav>
            </div>
        </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->
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
        <a href="index" class="breadcrumbs__url">
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
                            <center><hr class="bg-primary bg-opacity-100 opacity-100 my-1" width="50em"></center>
                            <form action="" id="contact-form">
                                <input type="hidden" name="id">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <input type="text" id="userName" name ="fullname" class="form-control form-control-sm rounded-0 form-control-border" required autocomplete="off" placeholder="Enter Fullname here">
                                            <small class="px-1 field-label">Fullname</small>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <input type="email" id="userEmail" name ="email" class="form-control form-control-sm rounded-0 form-control-border" required autocomplete="off" placeholder="Enter Email here">
                                            <small class="px-1 field-label">Email</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group position-relative">
                                            <input type="subject" id="subject" name ="subject" class="form-control form-control-sm rounded-0 form-control-border" required autocomplete="off" placeholder="Enter Subject here">
                                            <small class="px-1 field-label">Subject</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control rounded-0" id="content" name="message" rows="4" required placeholder="Write your message here"></textarea>
                                            <small class="px-1 field-label">Message</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 text-center">
                                    <input type="submit" name="send" class="btn-submit"
                    value="Send" />

                <div id="statusMessage"> 
                        <?php
                        if (! empty($message)) {
                            ?>
                            <p class='<?php echo $type; ?>Message'><?php echo $message; ?></p>
                        <?php
                        }
                        ?>
                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
				<script>
    $(function(){
        $('#contact-form').submit(function(e){
            e.preventDefault();
            var _this= $(this)
            $('.pop-msg').remove()
            var _el = $("<div>")
                _el.addClass("alert pop-msg my-2")
                _el.html('<div class="d-flex w-100 align-items-center">'+
                         '<div class="text-msg col-11"></div>'+
                         '<div class="col-1"><button class="btn-close" id="pop-msg-btn"></button></div>'+
                        '</div>')
                _el.hide()
                _el.find('#pop-msg-btn').click(function(){
                    _el.hide('slideUp')
                    setTimeout(() => {
                        _el.remove()
                    }, 1000);
                })
            if(_this[0].checkValidity() == false){
                _this[0].reportValidity();
                return false;
            }
            console.log(_this.serialize())
            _this.find('input,select,textarea').attr('readonly',true)
            _this.find('button').attr('disabled',true)
            $.ajax({
                url:'Actions.php?a=save_message',
                method:'POST',
                type:'POST',
                data:$(this).serialize(),
                dataType:'json',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert-danger')
                    _el.find('.text-msg').text("An error occurred.")
                    _this.before(_el)
                    _el.show()
                    _this.find('input,select,textarea').attr('readonly',false)
                    _this.find('button').attr('disabled',false)
                },
                success:function(resp){
                    if(!!resp.msg){
                        _el.find('.text-msg').text(resp.msg)
                    }
                    if(resp.status == 'success'){
                        _el.addClass('alert-success')
                        _this[0].reset(0)
                    }else{
                        _el.addClass('alert-danger')
                        if(!resp.msg){
                            _el.find('.text-msg').text('An error occurred.')
                        }
                    }
                    _this.before(_el)
                    _el.show()
                    _this.find('input,select,textarea').attr('readonly',false)
                    _this.find('button').attr('disabled',false)
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

                                Alamat Redaksi : Villa Nusa Indah 2 Blok GG 6 No. 9 Kec. Gn. Putri - Kab. Bogor

                            </li>
<!--                            <li>
                                <span>
                                    <i class="fa fa-phone"></i>
                                    <a href="tel:">(+12) 34567 890 123</a>
                                </span>

                            </li>  -->
                            <li>
                                <span>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:">info@sawitnews.id</a>
                                </span>

                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-globe"></i>
                                    <a href="#" target="_blank"> www.sawitnews.id</a>
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
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.5730724116165!2d106.96787967409779!3d-6.3196722618392425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69925ca7c80c97%3A0x37a98f6fd203e5b1!2s2%20blok%20GG6%20no%2C%20Jl.%20Vila%20Nusa%20Indah%20Raya%20No.22%2C%20Bojong%20Kulur%2C%20Kec.%20Gn.%20Putri%2C%20Kabupaten%20Bogor%2C%20Jawa%20Barat%2016969!5e0!3m2!1sid!2sid!4v1722235803169!5m2!1sid!2sid" width="450" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Form contact  -->


    <section class="wrapper__section p-0">
        <div class="wrapper__section__components">
            <footer>
    <div class="wrapper__footer bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="wrapper__footer-logo text-center">
                        <a href="index">
                            <figure class="mb-4">
                                <img src="images/placeholder/logo.jpg" alt="" class="img-fluid logo-footer">
                            </figure>
                        </a>

                        <p>
                            Alamat Redaksi : Villa Nusa Indah 2 Blok GG 6 No. 9 Kec. Gn. Putri - Kab. Bogor
							Email : info@sawitnews.id
                        </p>
                        <p class="mb-0">
                            <button class="btn btn-social btn-social-o facebook mr-1">
                                <i class="fa fa-facebook-f"></i>
                            </button>
                            <button class="btn btn-social btn-social-o twitter mr-1">
                                <i class="fa fa-twitter"></i>
                            </button>

                            <button class="btn btn-social btn-social-o linkedin mr-1">
                                <i class="fa fa-linkedin"></i>
                            </button>
                            <button class="btn btn-social btn-social-o instagram mr-1">
                                <i class="fa fa-instagram"></i>
                            </button>

                            <button class="btn btn-social btn-social-o youtube mr-1">
                                <i class="fa fa-youtube"></i>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer bottom -->
    <div class="bg__footer-bottom bg-light">
        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-6">
                    <span class="text-dark">
                        Copyright © 2024 SawitNews. All rights Reserved
                        <a href="index" class="text-dark">sawitnews.id</a>
                    </span>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline ">
                        <li class="list-inline-item">
                            <a href="contact_us" class="text-dark ">
                                contact
                            </a>
                        </li>
						<li class="list-inline-item">
                            <a href="team" class="text-dark ">
                                redaksi SawitNews
                            </a>
                        </li>
						<li class="list-inline-item">
                            <a href="#" class="text-dark ">
                                pedoman media cyber
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
        </div>
    </section>


    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<script type="text/javascript" src="./js/index.bundle.js?537a1bbd0e5129401d28"></script></body>
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
            if (!userEmail.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))
            {
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