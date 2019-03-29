<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$MEMBER = '';

if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
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
                                    <div class="col-sm-4 about-box">
                                        <div class="row">
                                            <div class="col-md-3 icon-box">
                                                <i class="fa fa-eye about-box-icon"></i>
                                            </div>
                                            <div class="col-md-9 about-description">
                                                <h5>Vision</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
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
                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
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
                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>
                    <section class="about-section ui-block ui-ad-block intro-section category-wrap-layout1 padding-top-100 padding-bottom-100 ">
                        <div class="">
                            <div class="container index-container">
                                <div class="row">
                                    <div class="col-md-7  about-main-img">
                                        <img src="img/about.png" alt=""/>
                                    </div>
                                    <div class="col-md-5 about-main-description">
                                        <span id="typed2" style="white-space:pre;"></span>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum
                                        </p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>

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
            $(document).ready(function() {
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