<?php 
session_start();
error_reporting(0);
include('includes/config.php');

    ?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <title>Sawit News &#8211; Category</title>
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

    <header class="bg-light">
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
                        <div class="input-group ">
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
                                <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="submit">
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

    </header>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
<ul class="breadcrumbs bg-light mb-4">
    <li class="breadcrumbs__item">
        <a href="index" class="breadcrumbs__url">
            <i class="fa fa-home"></i> Home</a>
    </li>
    <li class="breadcrumbs__item">
        <a href="index" class="breadcrumbs__url">News</a>
    </li>
    <li class="breadcrumbs__item breadcrumbs__item--current">
        Category
    </li>
</ul>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                <?php 
        if($_GET['catid']!=''){
$_SESSION['catid']=intval($_GET['catid']);
}
             






     if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 8;
        $offset = ($pageno-1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


$query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.CategoryId='".$_SESSION['catid']."' and tblposts.Is_Active=1 order by tblposts.id desc LIMIT $offset, $no_of_records_per_page");

$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
echo "No record found";
}
else {
while ($row=mysqli_fetch_array($query)) {


?>
                    <aside class="wrapper__list__article ">
                        <h4 class="border_section"><?php echo htmlentities($row['category']);?> News</h4>

                        <!-- Post Article List -->
          <div class="card mb-4">
       <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
            <div class="card-body">
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
           
              <a href="news-details?nid=<?php echo htmlentities($row['pid'])?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo htmlentities($row['postingdate']);?>
           
            </div>
          </div>
<?php } ?>

<?php } ?>
						
						<!-- Post Article List End -->
                    </aside>
                </div>
                <div class="col-md-4">
                    <div class="sidebar-sticky">
                        <aside class="wrapper__list__article ">
                            <h4 class="border_section">Trending News</h4>
                            <div class="wrapper__list__article-small">
                                
                                
                                <?php
$query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId limit 8");
while ($row=mysqli_fetch_array($query)) {

?>
    <li>
                      <a href="news-details?nid=<?php echo htmlentities($row['pid'])?>"><?php echo htmlentities($row['posttitle']);?></a>
                    </li>
            <?php } ?>
                                <!-- Post Article -->
<h4 class="border_section">Advertise</h4>
<div class="article__entry">
    <div class="article__image">
        <a href="#">
            <img src="images/placeholder/ads 500x400.jpg" alt="" class="img-fluid">
        </a>
    </div>
</div>
                            </div>
                        </aside>

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">Category</h4>
                            <div class="widget widget__category">
    <ul class="list-unstyled ">
    <?php $query=mysqli_query($con,"select id,CategoryName from tblcategory");
while($row=mysqli_fetch_array($query))
{
?>

                    <li>
                      <a href="category?catid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['CategoryName']);?></a>
                    </li>
<?php } ?>

    </ul>
</div>
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

                        <aside class="wrapper__list__article">
                            <h4 class="border_section">Advertise</h4>
                            <a href="#">
                                <figure>
                                    <img src="images/placeholder/ads 500x400.jpg" alt="" class="img-fluid">
                                </figure>
                            </a>
                        </aside>

                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-area">
    <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s"
        style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
        <a class="page-item"><a href="?pageno=1"  class="page-link">First</a></a>
        <a class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
        </a>
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">
            Prev
        </a>
        <a class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item"></a>
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">
            Next
        </a>
        <a class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">
            Last
        </a>
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

</html>