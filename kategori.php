<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Kategori - Hukuminfo.id</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">

    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <link href="./css/styles.css?537a1bbd0e5129401d28" rel="stylesheet">
    <style>
        .pagination {
            display: flex !important;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            margin-bottom: 0;
        }

        .pagination .page-item {
            display: inline-flex !important;
        }

        .pagination .page-link {
            min-width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
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

    <!-- header -->
    <header>
        <!-- navbar -->
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
        <!-- End Navabr -->
    </header>
    <!-- End header -->
    <section class="wrapper__section my-5">
        <div class="container">
            <div class="mt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">

                            <!-- Kategori -->
                            <div class="mb-4">
                                <h3 class="border_section mb-4">Kategori</h3>

                                <div class="d-flex flex-wrap gap-2">

                                    <a href="#" class="btn btn-outline-primary rounded-pill mb-2">
                                        Hukum Pidana <span class="badge badge-primary ml-1">125</span>
                                    </a>

                                    <a href="#" class="btn btn-outline-primary rounded-pill mb-2">
                                        Hukum Perdata <span class="badge badge-primary ml-1">98</span>
                                    </a>

                                    <a href="#" class="btn btn-outline-primary rounded-pill mb-2">
                                        Korupsi <span class="badge badge-primary ml-1">76</span>
                                    </a>

                                    <a href="#" class="btn btn-outline-primary rounded-pill mb-2">
                                        Mahkamah Agung <span class="badge badge-primary ml-1">54</span>
                                    </a>

                                    <a href="#" class="btn btn-outline-primary rounded-pill mb-2">
                                        Kejaksaan <span class="badge badge-primary ml-1">41</span>
                                    </a>

                                    <a href="#" class="btn btn-outline-primary rounded-pill mb-2">
                                        Kepolisian <span class="badge badge-primary ml-1">87</span>
                                    </a>

                                    <a href="#" class="btn btn-outline-primary rounded-pill mb-2">
                                        HAM <span class="badge badge-primary ml-1">33</span>
                                    </a>

                                    <a href="#" class="btn btn-outline-primary rounded-pill mb-2">
                                        Bisnis <span class="badge badge-primary ml-1">62</span>
                                    </a>

                                    <a href="#" class="btn btn-outline-primary rounded-pill mb-2">
                                        Teknologi <span class="badge badge-primary ml-1">29</span>
                                    </a>

                                    <a href="#" class="btn btn-outline-primary rounded-pill mb-2">
                                        Internasional <span class="badge badge-primary ml-1">15</span>
                                    </a>

                                </div>
                            </div>

                            <!-- Pagination -->
                            <nav aria-label="Kategori Pagination" class="mt-4">
                                <ul class="pagination justify-content-center d-flex flex-row">

                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>

                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">4</a>
                                    </li>

                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>

                                </ul>
                            </nav>

                            <aside class="wrapper__list__article mb-0">
                                <h4 class="border_section">lifestyle</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="#">
                                                        <img src="images/placeholder/500x400.jpg" alt="" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                by david hall
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                descember 09, 2016
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    <h5>
                                                        <a href="#">
                                                            Maecenas accumsan tortor ut velit pharetra mollis.
                                                        </a>
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="#">
                                                        <img src="images/placeholder/500x400.jpg" alt="" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                by david hall
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                descember 09, 2016
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    <h5>
                                                        <a href="#">
                                                            Maecenas accumsan tortor ut velit pharetra mollis.
                                                        </a>
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="#">
                                                        <img src="images/placeholder/500x400.jpg" alt="" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                by david hall
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                descember 09, 2016
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    <h5>
                                                        <a href="#">
                                                            Maecenas accumsan tortor ut velit pharetra mollis.
                                                        </a>
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="#">
                                                        <img src="images/placeholder/500x400.jpg" alt="" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                by david hall
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                descember 09, 2016
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    <h5>
                                                        <a href="#">
                                                            Maecenas accumsan tortor ut velit pharetra mollis.
                                                        </a>
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="#">
                                                        <img src="images/placeholder/500x400.jpg" alt="" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                by david hall
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                descember 09, 2016
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    <h5>
                                                        <a href="#">
                                                            Maecenas accumsan tortor ut velit pharetra mollis.
                                                        </a>
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <!-- Post Article -->
                                            <div class="article__entry">
                                                <div class="article__image">
                                                    <a href="#">
                                                        <img src="images/placeholder/500x400.jpg" alt="" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="article__content">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item">
                                                            <span class="text-primary">
                                                                by david hall
                                                            </span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <span>
                                                                descember 09, 2016
                                                            </span>
                                                        </li>

                                                    </ul>
                                                    <h5>
                                                        <a href="#">
                                                            Maecenas accumsan tortor ut velit pharetra mollis.
                                                        </a>
                                                    </h5>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Pagination -->
                                <nav aria-label="Kategori Pagination" class="mt-4">
                                    <ul class="pagination justify-content-center d-flex flex-row">

                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">
                                                <i class="fa fa-angle-left"></i>
                                            </a>
                                        </li>

                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="#">4</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="#">
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </nav>
                            </aside>
                        </div>

                        <div class="col-md-4">
                            <div class="sticky-top">
                                <aside class="wrapper__list__article">
                                    <h4 class="border_section">stay conected</h4>
                                    <!-- widget Social media -->
                                    <div class="wrap__social__media">
                                        <a href="#" target="_blank">
                                            <div class="social__media__widget facebook">
                                                <span class="social__media__widget-icon">
                                                    <i class="fa fa-facebook"></i>
                                                </span>
                                                <span class="social__media__widget-counter">
                                                    Hukuminfo
                                                </span>
                                                <span class="social__media__widget-name">
                                                    like
                                                </span>
                                            </div>
                                        </a>
                                        <a href="#" target="_blank">
                                            <div class="social__media__widget twitter">
                                                <span class="social__media__widget-icon">
                                                    <i class="fa fa-twitter"></i>
                                                </span>
                                                <span class="social__media__widget-counter">
                                                    @hukuminfo
                                                </span>
                                                <span class="social__media__widget-name">
                                                    follow
                                                </span>
                                            </div>
                                        </a>
                                        <a href="#" target="_blank">
                                            <div class="social__media__widget youtube">
                                                <span class="social__media__widget-icon">
                                                    <i class="fa fa-youtube"></i>
                                                </span>
                                                <span class="social__media__widget-counter">
                                                    Hukum Info News
                                                </span>
                                                <span class="social__media__widget-name">
                                                    subscribe
                                                </span>
                                            </div>
                                        </a>

                                    </div>
                                </aside>

                                <aside class="wrapper__list__article">
                                    <h4 class="border_section">tags</h4>
                                    <div class="blog-tags p-0">
                                        <ul class="list-inline">

                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #property
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #sea
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #programming
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #sea
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #property
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #life style
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #technology
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #framework
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #sport
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #game
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #wfh
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #sport
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #game
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    #wfh
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    + 9 Lainnya...
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </aside>

                                <aside class="wrapper__list__article">
                                    <h4 class="border_section">Advertise</h4>
                                    <a href="#">
                                        <figure>
                                            <img src="images/placeholder/600x400.jpg" alt="" class="img-fluid">
                                        </figure>
                                    </a>
                                </aside>

                                <aside class="wrapper__list__article">
                                    <h4 class="border_section">newsletter</h4>
                                    <!-- Form Subscribe -->
                                    <div class="widget__form-subscribe bg__card-shadow">
                                        <h6>
                                            The most important world news and events of the day.
                                        </h6>
                                        <p><small>Get magzrenvi daily newsletter on your inbox.</small></p>
                                        <div class="input-group ">
                                            <input type="text" class="form-control" placeholder="Your email address">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">sign up</button>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="wrapper__section p-0">
        <div class="wrapper__section__components">
            <?php include 'includes/footer.php'; ?>
        </div>
    </section>


    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="./js/index.bundle.js?537a1bbd0e5129401d28"></script>
</body>

</html>