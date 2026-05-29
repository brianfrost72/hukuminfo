<?php
include('includes/config.php');

?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <title>Sawit News &#8211; Susunan Team Sawit News</title>
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

    <!-- header -->
    <header>
        <!-- navbar -->
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
                    <img src="images/placeholder/logo.jpg" alt="" class="img-fluid logo">
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
                    <li class="nav-item"><a class="nav-link" href="contact_us"> Kontak Kami </a></li>
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
                <div class="widget__form-search-bar">
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
                    <li class="nav-item"><a class="nav-link" href="contact_us"> Kontak Kami </a></li>
                </ul>

                </nav>
            </div>
        </div>
    </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->
<!-- End Navbar sidebar menu  -->
        <!-- End Navabr -->
    </header>
    <!-- End header -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- breadcrumb -->
                    <!-- Breadcrumb -->
<ul class="breadcrumbs bg-light mb-4">
    <li class="breadcrumbs__item">
        <a href="index" class="breadcrumbs__url">
            <i class="fa fa-home"></i>Home</a>
    </li>
    <li class="breadcrumbs__item">
        <a href="index" class="breadcrumbs__url">News</a>
    </li>
    <li class="breadcrumbs__item breadcrumbs__item--current">
        Redaksi Sawit News
    </li>
</ul>
                    <!-- End breadcrumb -->

                    <div class="wrap__about-us">                        
                        
                        <div class="clearfix"></div>
                        <h2 align="center">Pemimpin Umum</h2>
                        <!-- team member -->
                        <div class="team-member row">
                            <div class="col-md-12">
                                <figure class="member"> <img src="images/placeholder/yohanesfsilaen.jpg"
                                        class="img-fluid" alt="Image">
                                    <figcaption>
                                        <h4>Yohanes Ferdinan Silaen</h4>
                                        <small>Komisaris</small>
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"
                                                        aria-hidden="true"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"
                                                        aria-hidden="true"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-youtube-play"
                                                        aria-hidden="true"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
						<h2 align="center">Technical Support</h2>
                        <div class="team-member row">
                            <div class="col-md-12">
                                <figure class="member"> <img src="images/placeholder/briansteven.jpg"
                                        class="img-fluid" alt="Image">
                                    <figcaption>
                                        <h4>Brian Steven P. G</h4>
                                        <small>IT Staff</small>
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"
                                                        aria-hidden="true"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"
                                                        aria-hidden="true"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-youtube-play"
                                                        aria-hidden="true"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </section>



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
                                <img src="images/placeholder/logo.png" alt="" class="img-fluid logo-footer">
                            </figure>
                        </a>

                        <p>
                            Alamat Redaksi : Villa Nusa Indah 2 Blok GG 6 No. 9 Kec. Gn. Putri - Kab. Bogor<br>
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

</html>