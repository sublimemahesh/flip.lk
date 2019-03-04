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
                            <img src="img/logo/logo.png" alt="Olympus">
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
                        <a href="#" class="btn btn-md btn-border c-white">Register Now!</a>
                    </div>
                </div>

                <div class="col col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">

                    <!-- Login-Registration Form  -->

                    <div class="registration-login-form" id="registration-login-form">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">
                                    <svg class="olymp-register-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-register-icon"></use></svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#home" role="tab">
                                    <svg class="olymp-login-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-login-icon"></use></svg>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile" role="tabpanel" data-mh="log-tab">
                                <div class="title h6">Login to your Account</div>

                                <form class="content" action="post-and-get/member.php" method="post">
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
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label">Your Password</label>
                                                <input class="form-control" placeholder="" type="password" name="password">
                                            </div>

                                            <div class="remember">

                                                <div class="checkbox">
                                                    <label>
                                                        <input name="optionsCheckboxes" type="checkbox">
                                                        Remember Me
                                                    </label>
                                                </div>
                                                <a href="forgot-password.php" class="forgot">Forgot my Password</a>
                                            </div>

                                            <input type="submit" class="btn btn-lg btn-primary full-width" name="login"  value="Login">

                                            <div class="or"></div>

                                            <a href="#" class="btn btn-lg bg-facebook full-width btn-icon-left"><i class="fab fa-facebook-f" aria-hidden="true"></i>Login with Facebook</a>

                                            <a href="#" class="btn btn-lg bg-twitter full-width btn-icon-left"><i class="fab fa-twitter" aria-hidden="true"></i>Login with Twitter</a>


                                            <p>Don’t you have an account? <a href="#">Register Now!</a> it’s really simple and you can start enjoing all the benefits!</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="home" role="tabpanel" data-mh="log-tab">
                                <div class="title h6">Register to Flip.lk</div>
                                <div class="alert-position hidden">
                                    <div class="alert alert-danger" role = "alert">
                                        <span id="message"></span>
                                    </div>
                                </div>

                                <form class="content" id="register">
                                    <div class="row">
                                        <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label">First Name</label>
                                                <input class="form-control" placeholder="" type="text" name="fname" autocomplete="off" />
                                            </div>
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label">Last Name</label>
                                                <input class="form-control" placeholder="" type="text" name="lname" autocomplete="off" />
                                            </div>
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label">Your Email</label>
                                                <input class="form-control" placeholder="" type="email" name="email" autocomplete="off" />
                                            </div>
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label">Your Password</label>
                                                <input class="form-control" placeholder="" type="password" name="password" autocomplete="off" />
                                            </div>
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label">Confirm Password</label>
                                                <input class="form-control" placeholder="" type="password" name="cpassword" autocomplete="off" />
                                            </div>

                                            <div class="remember">
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="optionsCheckboxes" type="checkbox">
                                                        I accept the <a href="#">Terms and Conditions</a> of the website
                                                    </label>
                                                </div>
                                            </div>
                                            <a href="#" id="btnRegister" class="btn btn-purple btn-lg full-width">Complete Registration!</a>
                                            <input type="hidden" name="save"  value="">
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
        <script src="js/js/add-member.js" type="text/javascript"></script>

    </body>
</html>