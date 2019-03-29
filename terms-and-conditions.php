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

        <title>Terms & Conditions || Flip.lk</title>

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

<!--                    <section class="about-section-values ui-block ui-ad-block intro-section category-wrap-layout1 padding-top-100 padding-bottom-100 ">
                        <div class="">
                            <div class="container index-container">
                                <div class="row">
                                    <div class="col-sm-4 about-box">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <i class="fa fa-eye about-box-icon"></i>
                                            </div>
                                            <div class="col-sm-9">
                                                <h5>Vision</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 about-box">

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <i class="fa fa-rocket about-box-icon"></i>
                                            </div>
                                            <div class="col-sm-9">
                                                <h5>Mission</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 about-box">

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <i class="fa fa-handshake about-box-icon"></i>
                                            </div>
                                            <div class="col-sm-9">
                                                <h5>Value</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>-->

                    <section class=" term">
                        <div class="">
                            <div class="container index-container">
                                <div class="row terms1">
                                    <div class="entry-single-content">
                                        <h2 class="entry-single-title ">Terms and Conditions</h2>
                                        <p>We will provide our services to you, which are subject to the conditions stated below in this document. Every time you visit this website, use its services or make a purchase, you accept the following conditions. This is why we urge you to read them carefully. </p>

                                        <h3 class="entry-single-list-title">Conditions of use</h3>
                                        <ul class="details">
                                            <li><i class="fa fa-angle-right icon1"></i>The content of the pages of this website is for your general information and use only. It is subject to change without notice.</li>
                                            <li><i class="fa fa-angle-right icon1"></i>Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.</li>
                                            <li><i class="fa fa-angle-right icon1"></i>Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.</li>
                                            <li><i class="fa fa-angle-right icon1"></i>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</li>
                                            <li><i class="fa fa-angle-right icon1"></i>All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.</li>
                                            <li><i class="fa fa-angle-right icon1"></i>Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.</li>
                                            <li><i class="fa fa-angle-right icon1"></i>This website may also include links to third party websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).</li>

                                        </ul>
                                        <h3 class="entry-single-list-title">Privacy</h3>
                                        <ul>
                                            <li><i class="fa fa-angle-right icon1"></i>This privacy policy sets out how Flip.lk uses and protects any information that you give Flip.lk when you use this website.</li>
                                            <li><i class="fa fa-angle-right icon1"></i>Flip.lk is committed to ensuring that your privacy is protected. Should we ask you to provide certain information by which you can be identified when using this website you can be assured that it will only be used in accordance with this privacy statement.</li>
                                            <li><i class="fa fa-angle-right icon1"></i>Flip.lk may change this policy from time to time by updating this page. You should check this page from time to time to ensure that you are happy with any changes. This policy is effective from 29th March 2019. </li>

                                        </ul>

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