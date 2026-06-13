<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../koneksi.php';

$popularQuery = mysqli_query($conn, "
    SELECT
        p.id,
        p.post_title,
        p.post_image,
        p.slug,
        p.created_at,
        p.total_views,
        p.total_likes,
        p.total_bookmarks,
        up.full_name
    FROM post p
    LEFT JOIN user_profile up
        ON up.user_id = p.user_id
    WHERE p.status = 'publish'
    ORDER BY
        (
            (p.total_views * 1)
            +
            (p.total_likes * 3)
            +
            (p.total_bookmarks * 5)
        ) DESC,
        p.created_at DESC
    LIMIT 10
");

$basePostImage = 'dashboard/assets/images/uploads/posts/';
?>
<nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
    <div class="container">
        <div class="offcanvas-header">
            <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
                <span class="navbar-toggler-icon"></span>
            </div>
        </div>
        <figure class="mb-0 mx-auto">
            <a href="/">
                <img src="images/placeholder/logo.png" alt="" class="img-fluid logo">
            </a>
        </figure>

        <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item"><a class="nav-link" href="/"> Beranda </a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                        href="#"
                        id="topikDropdown"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        Topik Hukum
                    </a>

                    <div class="dropdown-menu">

                        <a class="dropdown-item" href="artikel-populer">
                            <i class="fa fa-star mr-2"></i> Artikel Populer
                        </a>

                        <a class="dropdown-item" href="artikel-disukai">
                            <i class="fa fa-heart mr-2"></i> Paling Disukai
                        </a>

                        <a class="dropdown-item" href="artikel-dibookmark">
                            <i class="fa fa-bookmark mr-2"></i> Paling Diminati
                        </a>

                        <a class="dropdown-item" href="kategori">
                            <i class="fa fa-folder-open mr-2"></i> Kategori
                        </a>

                        <a class="dropdown-item" href="tags">
                            <i class="fa fa-tags mr-2"></i> Tags
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown has-megamenu">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Trending Topik </a>
                    <div class="dropdown-menu animate fade-down megamenu mx-auto" role="menu">
                        <div class="container wrap__mobile-megamenu">
                            <div class="col-megamenu">
                                <h5 class="title">Trending Topik</h5>
                                <hr>
                                <!-- Popular news carousel -->
                                <div class="popular__news-header-carousel">

                                    <div class="top__news__slider">

                                        <?php while ($popular = mysqli_fetch_assoc($popularQuery)): ?>

                                            <div class="item">

                                                <div class="article__entry">

                                                    <div class="article__image">

                                                        <a href="<?= htmlspecialchars($popular['slug']) ?>">

                                                            <img
                                                                src="<?= $basePostImage . htmlspecialchars($popular['post_image']) ?>"
                                                                alt="<?= htmlspecialchars($popular['post_title']) ?>"
                                                                class="img-fluid">

                                                        </a>

                                                    </div>

                                                    <div class="article__content">

                                                        <ul class="list-inline mb-2">

                                                            <li class="list-inline-item">
                                                                <span class="text-primary">
                                                                    <?= htmlspecialchars($popular['full_name'] ?? 'Administrator') ?>
                                                                </span>
                                                            </li>

                                                            <li class="list-inline-item">
                                                                <?= date('d M Y', strtotime($popular['created_at'])) ?>
                                                            </li>

                                                        </ul>

                                                        <h5>

                                                            <a href="<?= htmlspecialchars($popular['slug']) ?>">

                                                                <?= htmlspecialchars($popular['post_title']) ?>

                                                            </a>

                                                        </h5>

                                                        <div class="mt-2 small text-muted">

                                                            <span class="mr-3">
                                                                <i class="fa fa-eye"></i>
                                                                <?= number_format($popular['total_views']) ?>
                                                            </span>

                                                            <span class="mr-3">
                                                                <i class="fa fa-heart"></i>
                                                                <?= number_format($popular['total_likes']) ?>
                                                            </span>

                                                            <span>
                                                                <i class="fa fa-bookmark"></i>
                                                                <?= number_format($popular['total_bookmarks']) ?>
                                                            </span>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        <?php endwhile; ?>

                                    </div>

                                </div>
                            </div> <!-- col-megamenu.// -->
                        </div>
                    </div> <!-- dropdown-mega-menu.// -->
                </li>
                <!-- <li class="nav-item"><a class="nav-link" href="#"> Kategori </a></li> -->
                <li class="nav-item"><a class="nav-link" href="kontak-kami"> Kontak Kami </a></li>
            </ul>

            <ul class="navbar-actions d-none d-xl-flex align-items-center list-unstyled mb-0 mr-2">
                <li>
                    <div class="phone__number phone__number-light">

                        <div class="phone__icon">
                            <div class="icon-phone">
                                <i class="fa fa-phone"></i>
                            </div>
                        </div>

                        <div class="phone__content">

                            <span class="help__text">
                                Butuh Bantuan?
                            </span>

                            <a href="tel:08111902759" class="phone__link">
                                0811 1902 759
                            </a>

                            <a href="mailto:cs@hukuminfo.id" class="email__link">
                                cs@hukuminfo.id
                            </a>

                        </div>

                    </div>
                </li>
            </ul>


            <!-- Search bar.// -->
            <ul class="navbar-nav ">
                <li class="nav-item search hidden-xs hidden-sm "> <a class="nav-link" href="#">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
            </ul>

            <!-- BAGIAN INI BUATKAN SEPERTI DI GAMBAR -->

            <!-- Search content bar.// -->
            <div class="top-search navigation-shadow">
                <div class="container">
                    <div class="input-group ">
                        <form action="pencarian.php" method="GET" id="navbarSearchForm">

                            <div class="row no-gutters mt-3">

                                <div class="col position-relative">

                                    <input
                                        type="search"
                                        name="q"
                                        id="navbarSearchInput"
                                        class="form-control border-secondary border-right-0 rounded-0"
                                        placeholder="Apa yang anda cari..."
                                        autocomplete="off">

                                    <div id="navbarSearchResult"></div>

                                </div>

                                <div class="col-auto">

                                    <button
                                        type="submit"
                                        class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">

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