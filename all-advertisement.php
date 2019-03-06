<?php
include_once(dirname(__FILE__) . '/class/include.php');

$id = '';

if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
if (isset($_GET["page"])) {
    $page = (int) $_GET["page"];
} else {
    $page = 1;
}
$setLimit = 30;
$pageLimit = ($page * $setLimit) - $setLimit;
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Profile || Flip.lk</title>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- Main Font -->
        <script src="js/webfontloader.min.js"></script>
        <script>
            WebFont.load({
                google: {
                    families: ['Roboto:300,400,500,700:latin']
                }
            });
        </script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">
        <!-- Main Styles CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.min.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <style>
            .comment-item1 {
                display: none;
            }
            .comment-reply-item {
                display: none;
            }
        </style>
    </head>
    <body>
        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <div class="container index-container">
            <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <!-- Top Header-Profile -->

                <!-- ... end Top Header-Profile -->
                <div class="container">
                    <div class="row">

                        <!-- Main Content -->

                        <div class="col col-xl-8 col-xl-offset-2 order-xl-2 col-lg-8 order-lg-1 col-md-12 col-sm-12 col-12">

                            <div id="newsfeed-items-grid">
                                <div class="ad-breadcrumbs">
                                    <span class="breadcrumb-item"><a href="./" >Home</a> </span><span class="breadcrumb-item">All advertisements in Sri Lanka</span>
                                </div>   
                                <div class="ui-block">
                                    <?php
                                    include './calculate-time.php';
                                    $advertisements = Advertisement::getAllAdvertisements($pageLimit, $setLimit);
                                    if (count($advertisements) > 0) {
                                        foreach ($advertisements as $key => $ad) {
                                            $result = getTime($ad['created_at']);
                                            $MEMBER = new Member($ad['member']);
                                            $CATEGORY = new BusinessCategory($ad['category']);
                                            $adimages = AdvertisementImage::getPhotosByAdId($ad['id']);
                                            ?>
                                            <div class="ad-item  post ">
                                                <div class="ad-item-box row">
                                                    <div class = "col-xl-2 col-xs-4 ad-item-image">
                                                        <?php
                                                        if (count($adimages) > 0) {
                                                            foreach ($adimages as $key => $img) {
                                                                if ($key == 0) {
                                                                    ?>
                                                                    <img src="upload/advertisement/thumb2/<?php echo $img['image_name']; ?>" alt=""/>
                                                                    <?php
                                                                }
                                                            }
                                                        } else {
                                                            ?>
                                                            <img src="upload/advertisement/thumb2/advertising.jpg" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class = "col-xl-10 col-xs-8 ad-item-details">
                                                        <div class="ad-title"><a href="view-advertisement.php?id=<?php echo $ad['id']; ?>"><?php echo $ad['title']; ?></a></div>
                                                        <div class="ad-category"><span class="title">Category <i class="fa fa-angle-double-right"></i> </span><?php echo $CATEGORY->name; ?></div>
                                                        <div class="ad-city"><span class="title">Price <i class="fa fa-angle-double-right"></i> </span><?php if($ad['price'] == 0) { echo 'Negotiable'; } else { echo 'Rs. ' . number_format($ad['price']);} ?></div>
                                                        <div class="ad-time"><i class="fa fa-clock"></i> <?php echo $result; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="ui-block no-post">
                                            <h5>There is no any advertisements.</h5>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- ... end Main Content -->
                        <!-- Left Sidebar -->
                        <div class="col col-xl-4 order-xl-1 col-lg-4 order-lg-1 col-md-12 col-sm-12 col-12 hidden-sm">
                            <div class="ui-block">
                                <div class="ui-block-title">
                                    <h6 class="title">All Categories</h6>
                                </div>
                                <div class="ui-block-content">
                                    <!-- W-Personal-Info -->
                                    <ul class="widget w-personal-info item-block category-list">
                                        <?php
                                        foreach (BusinessCategory::all() as $category) {
                                            ?>
                                            <li>
                                                <span class="text category-icon">
                                                    <img src="upload/business-category/<?php echo $category['image_name']; ?>">
                                                    <a href="advertisements.php?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                                                </span>
                                            </li>
                                            <?php
                                        }
                                        ?>

                                    </ul>
                                    <!-- .. end W-Personal-Info -->
                                </div>
                            </div>
                        </div>
                        <!-- ... end Left Sidebar -->
                    </div>
                </div>
            </div>
        </div>
        <a class="back-to-top" href="#">
            <img src="svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
        </a>
        <!-- Window-popup -->


        <!-- ... end Window-popup -->


        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/jquery.appear.js"></script>
        <script src="js/jquery.mousewheel.js"></script>
        <script src="js/perfect-scrollbar.js"></script>
        <script src="js/jquery.matchHeight.js"></script>
        <script src="js/svgxuse.js"></script>
        <script src="js/imagesloaded.pkgd.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/velocity.js"></script>
        <script src="js/ScrollMagic.js"></script>
        <script src="js/jquery.waypoints.js"></script>
        <script src="js/jquery.countTo.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/material.min.js"></script>
        <script src="js/bootstrap-select.js"></script>
        <script src="js/smooth-scroll.js"></script>
        <script src="js/selectize.js"></script>
        <script src="js/swiper.jquery.js"></script>
        <script src="js/moment.js"></script>
        <script src="js/daterangepicker.js"></script>
        <script src="js/simplecalendar.js"></script>
        <script src="js/fullcalendar.js"></script>
        <script src="js/isotope.pkgd.js"></script>
        <script src="js/ajax-pagination.js"></script>
        <script src="js/Chart.js"></script>
        <script src="js/chartjs-plugin-deferred.js"></script>
        <script src="js/circle-progress.js"></script>
        <script src="js/loader.js"></script>
        <script src="js/run-chart.js"></script>
        <script src="js/jquery.magnific-popup.js"></script>
        <script src="js/jquery.gifplayer.js"></script>
        <script src="js/mediaelement-and-player.js"></script>
        <script src="js/mediaelement-playlist-plugin.min.js"></script>
        <script src="js/sticky-sidebar.js"></script>
        <script src="js/base-init.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/friend-request.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/all-ad-slider.js" type="text/javascript"></script>
    </body>
</html>