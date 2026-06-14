<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>


<div class="container page__container">
    <div class="navbar navbar-secondary navbar-light navbar-expand-sm p-0">
        <button class="navbar-toggler navbar-toggler-right"
            data-toggle="collapse"
            data-target="#navbarsExample03"
            type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse"
            id="navbarsExample03">
            <ul class="nav navbar-nav">
                <li class="sidebar-menu-item <?= ($currentPage == 'index.php' || $currentPage == '') ? 'active' : ''; ?>">
                    <a class="sidebar-menu-button" href="/">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                        <span class="sidebar-menu-text">Beranda</span>
                    </a>
                </li>

                <li class="sidebar-menu-item <?= ($currentPage == 'daftar-bookmark.php') ? 'active' : ''; ?>">
                    <a class="sidebar-menu-button" href="daftar-bookmark.php">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">bookmark</i>
                        <span class="sidebar-menu-text">Bookmarks</span>
                    </a>
                </li>

                <li class="sidebar-menu-item <?= ($currentPage == 'daftar-likes.php') ? 'active' : ''; ?>">
                    <a class="sidebar-menu-button" href="daftar-likes.php">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">favorite</i>
                        <span class="sidebar-menu-text">Like Post</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>