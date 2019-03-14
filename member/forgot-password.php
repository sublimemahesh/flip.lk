<?php
include_once(dirname(__FILE__) . '/../class/include.php');
//include_once(dirname(__FILE__) . '/auth.php');
if (!isset($_SESSION)) {
    session_start();
}
$CATEGORIES = BusinessCategory::all();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Landing Page</title>
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
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="landing-page">
        <div class="content-bg-wrap"></div>
        <!-- Header Standard Landing  -->
        <div class="header--standard header--standard-landing" id="header--standard">
            <div class="container">
                <div class="header--standard-wrap">
                    <a href="../" class="logo">
                        <div class="img-wrap">
                            <img src="img/logo/logo.jpg" alt="flip.lk">
                        </div>
                    </a>
                    <a href="#" class="open-responsive-menu js-open-responsive-menu">
                        <svg class="olymp-menu-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-menu-icon"></use></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- ... end Header Standard Landing  -->
        <div class="header-spacer--standard"></div>

        <div class="container login-container">
            <div class="row display-flex">
                <div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="landing-content">
                        <h1>Welcome to the Biggest Social Network in the World</h1>
                        <p>We are the best and biggest social network with 5 billion active users all around the world. Share you
                            thoughts, write blog posts, show your favourite music via Stopify, earn badges and much more!
                        </p>
                        <!--<a href="#" class="btn btn-md btn-border c-white">Register Now!</a>-->
                    </div>
                </div>

                <div class="col col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">

                    <!-- Login-Registration Form  -->

                    <div class="registration-login-form" id="registration-login-form">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel" data-mh="log-tab">
                                <div class="title h6">Forgotten Password?</div>
                                
                                <form class="content" id="register" action="post-and-get/member.php" method="post">
                                    <div class="top-bott20 m-l-25 m-r-15">
                                        <?php
                                        
                                        if (isset($_GET['message'])) {

                                            $MESSAGE = New Message($_GET['message']);
                                            ?>
                                            <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                                                <?php echo $MESSAGE->description; ?>
                                            </div>
                                            <?php
                                        }

                                        $vali = new Validator();

                                        $vali->show_message();
                                        ?>
                                    </div>
                                    <div class="row">
                                        <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label">Your Email</label>
                                                <input class="form-control" placeholder="" type="email" name="email">
                                            </div>
                                            
                                            <input type="submit" class="btn btn-lg btn-primary full-width" name="check-email"  value="Send Email">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ... end Login-Registration Form  -->
                </div>
            </div>
        </div>
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
        <script src="js/base-init.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <!--custom js-->

    </body>
</html>