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
                                <div class="section-heading heading-dark heading-center section1">
                                    <div class="item-sub-title">Understand to achieve anything requires faith and belief in yourself.</div>
                                    <h2 class="item-title">This is our Company important</h2>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 about-box">
                                        <div class="row">
                                            <div class="col-md-12 about-description">
                                                <!--<i class="fa fa-eye about-box-icon"></i>-->
                                                <img src="img/icon/about-us-icon/eye-512.png" alt=""/>
                                                <h5>Vision</h5>
                                                <p><?php echo $VISION->description; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 about-box">

                                        <div class="row">
                                            <div class="col-md-12 about-description">

            <!--<i class="fa fa-rocket about-box-icon"></i>-->
                                                <img src="img/icon/about-us-icon/mission-icon.png" alt=""/>
                                                <h5>Mission</h5>
                                                <p><?php echo $MISSION->description; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 about-box">

                                        <div class="row">
                                            <div class="col-md-12 about-description">
                                                <!--<i class="fa fa-handshake about-box-icon"></i>-->
                                                <img src="img/icon/about-us-icon/004-handshake.png" alt=""/>
                                                <h5>Value</h5>
                                                <p><?php echo $VALUE->description; ?></p>
                                            </div>
                                        </div>
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
        <script src="js/js/view-notification.js" type="text/javascript"></script>
        <script src="js/perfect-scrollbar.js"></script>
        <script src="js/smooth-scroll.js"></script>
        <script src="js/base-init.js"></script>
        <script>
            $(document).ready(function () {
                $('.about-box').mouseover(function () {
                    $(this).find('.about-box-icon').addClass('about-box-icon-hover');
                });
                $('.about-box').mouseout(function () {
                    $(this).find('.about-box-icon').removeClass('about-box-icon-hover');
                });
            });
            //    Typed-js master

            var typed2 = new Typed('#typed2', {
                strings: ['<b style="font-size: 40px; color: #003263;">FLIP.LK</b>', '<b style="font-size: 28px; color: #003263;">Sri Lankan Biggest Business Group</b>'],
                typeSpeed: 100,
                backSpeed: 0,
                fadeOut: true,
                loop: true
            });
        </script>
    </body>
</html>