<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$MEMBER = '';

if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
$ABOUT = New Page(1);
$VISION = New Page(2);
$MISSION = New Page(3);
$VALUE = New Page(4);
?> 
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>About Us || Flip.lk</title>

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
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="css/search-box.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/OwlCarousel/dist/assets/owl.carousel.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/OwlCarousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/flaticon.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <?php
        include './banner.php';
        ?>
        <div class="">


            <div class="row">
                <!-- Main Content -->
                <main class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                    <section class="about-section-values ui-block ui-ad-block intro-section category-wrap-layout1 padding-top-100 padding-bottom-100 ">

                        <div class="">
                            <div class="container index-container">
                                <div class="row">
                                    <div class="col-md-7  about-main-img">
                                        <img src="upload/page/<?php echo $ABOUT->image_name; ?>" alt=""/>
                                    </div>
                                    <div class="col-md-5 about-main-description">
                                        <span id="typed2" style="white-space:pre;"></span>
                                        <p>
                                            <?php echo $ABOUT->description; ?>
                                        </p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>


                    <section class="about-section ui-block ui-ad-block intro-section category-wrap-layout1 padding-top-100 padding-bottom-100 ">
                        <div class="">
                            <div class="container index-container">
                                <div class="row">
                                    <div class="col-sm-4 about-box">
                                        <div class="row">
                                            <div class="col-md-3 icon-box">
                                                <i class="fa fa-eye about-box-icon"></i>
                                            </div>
                                            <div class="col-md-9 about-description">
                                                <h5>Vision</h5>
                                                <p><?php echo $VISION->description; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 about-box">

                                        <div class="row">
                                            <div class="col-md-3 icon-box">
                                                <i class="fa fa-rocket about-box-icon"></i>
                                            </div>
                                            <div class="col-md-9 about-description">
                                                <h5>Mission</h5>
                                                <p><?php echo $MISSION->description; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 about-box">

                                        <div class="row">
                                            <div class="col-md-3 icon-box">
                                                <i class="fa fa-handshake about-box-icon"></i>
                                            </div>
                                            <div class="col-md-9 about-description">
                                                <h5>Value</h5>
                                                <p><?php echo $VALUE->description; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>
                    
                    
                    <!--///// tet-->
                     <section class="welcome-section section-padding section-bg">
            <div class="container paddingtop">
                <div class="section-header text-center">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="section-title">This is our Company important</h2>
                            <p>Understand to achieve anything requires faith and belief in yourself.</p>
                        </div>
                    </div>
                </div>
                <div class="section-wrapper">
                    <div class="row mt-mb-15 justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="single-item-style-four item-0">
                                <div class="single-item-head d-flex align-items-center">
                                    <div class="icon"><i class="fa fa-eye"></i></div>
                                    <h5 class="item-title">Vision</h5>
                                </div>
                                <div class="content">

                                    <p>To assist the travelers, gain the most out of their coverage and give a customer service with a smile</p>
                                </div>
                            </div>
                        </div><!--benefits-item end -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-item-style-four item-0">
                                <div class="single-item-head d-flex align-items-center">
                                    <div class="icon"><i class="fa fa-rocket"></i></div>
                                    <h5 class="item-title">Mission</h5>
                                </div>
                                <div class="content">

                                    <p>Being a knowledgeable and experienced would help ascertaining travelers believes, Keep them totally satisfied.we strive to do our best, and are committed to ensuring a dream travel to all our guests.
                                    </p>
                                </div>
                            </div>
                        </div><!--benefits-item end -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-item-style-four item-0">
                                <div class="single-item-head d-flex align-items-center">
                                    <div class="icon"><i class="fa fa-handshake-o"></i></div>
                                    <h5 class="item-title">Value</h5>
                                </div>
                                <div class="content">

                                    <p>get a happy comment for our service in a guests.and get a good name  for tour services</p>
                                </div>
                            </div>
                        </div><!--benefits-item end -->
                    </div>
                </div>
            </div>
        </section>
                    <!--end test-->
                    

                </main>
                <!-- ... end Main Content -->
            </div>
        </div>
        <!--footers-->
        <?php
        include './footer.php';
        ?>
        <!--end footer-->
        <a class="back-to-top" href="#">
            <img src="svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
        </a>
        <!-- Window-popup -->
        <?php
        include './window-pop-up.php';
        ?>

        <!-- ... end Window-popup -->

        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/choices.js" type="text/javascript"></script>
        <script src="plugins/OwlCarousel/dist/owl.carousel.min.js" type="text/javascript"></script>
        <script src="plugins/type-js/js/typed.min.js" type="text/javascript"></script>
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('.about-box').mouseover(function () {
                    $(this).find('.about-box-icon').addClass('about-box-icon-hover');
                });
                $('.about-box').mouseout(function () {
                    $(this).find('.about-box-icon').removeClass('about-box-icon-hover');
                });
            });
        </script>
    </body>
</html>