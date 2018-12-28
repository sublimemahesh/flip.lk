<?php
include_once(dirname(__FILE__) . '/../class/include.php');
//include_once(dirname(__FILE__) . '/auth.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Confirm Email</title>
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
    </head>
    <body class="landing-page">
        <div class="content-bg-wrap"></div>
        <!-- Header Standard Landing  -->
        <div class="header--standard header--standard-landing" id="header--standard">
            <div class="container">
                <div class="header--standard-wrap">
                    <a href="#" class="logo">
                        <div class="img-wrap">
                            <img src="img/logo.png" alt="Olympus">
                            <img src="img/logo-colored-small.png" alt="Olympus" class="logo-colored">
                        </div>
                        <div class="title-block">
                            <h6 class="logo-title">olympus</h6>
                            <div class="sub-title">SOCIAL NETWORK</div>
                        </div>
                    </a>
                    <a href="#" class="open-responsive-menu js-open-responsive-menu">
                        <svg class="olymp-menu-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-menu-icon"></use></svg>
                    </a>
                    <div class="nav nav-pills nav1 header-menu">
                        <div class="mCustomScrollbar">
                            <ul>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" tabindex='1'>Profile</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Profile Page</a>
                                        <a class="dropdown-item" href="#">Newsfeed</a>
                                        <a class="dropdown-item" href="#">Post Versions</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown dropdown-has-megamenu">
                                    <a href="#" class="nav-link">Forums</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Terms & Conditions</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Events</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Privacy Policy</a>
                                </li>
                                <li class="close-responsive-menu js-close-responsive-menu">
                                    <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                                </li>
                                <li class="nav-item js-expanded-menu">
                                    <a href="#" class="nav-link">
                                        <svg class="olymp-menu-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-menu-icon"></use></svg>
                                        <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                                    </a>
                                </li>
                                <li class="shoping-cart more">
                                    <a href="#" class="nav-link">
                                        <svg class="olymp-shopping-bag-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-shopping-bag-icon"></use></svg>
                                        <span class="count-product">2</span>
                                    </a>
                                    <div class="more-dropdown shop-popup-cart">
                                        <ul>
                                            <li class="cart-product-item">
                                                <div class="product-thumb">
                                                    <img src="img/product1.png" alt="product">
                                                </div>
                                                <div class="product-content">
                                                    <h6 class="title">White Enamel Mug</h6>
                                                    <ul class="rait-stars">
                                                        <li>
                                                            <i class="fa fa-star star-icon c-primary" aria-hidden="true"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star star-icon c-primary" aria-hidden="true"></i>
                                                        </li>

                                                        <li>
                                                            <i class="fa fa-star star-icon c-primary" aria-hidden="true"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star star-icon c-primary" aria-hidden="true"></i>
                                                        </li>
                                                        <li>
                                                            <i class="far fa-star star-icon" aria-hidden="true"></i>
                                                        </li>
                                                    </ul>
                                                    <div class="counter">x2</div>
                                                </div>
                                                <div class="product-price">$20</div>
                                                <div class="more">
                                                    <svg class="olymp-little-delete"><use xlink:href="svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                                </div>
                                            </li>
                                            <li class="cart-product-item">
                                                <div class="product-thumb">
                                                    <img src="img/product2.png" alt="product">
                                                </div>
                                                <div class="product-content">
                                                    <h6 class="title">Olympus Orange Shirt</h6>
                                                    <ul class="rait-stars">
                                                        <li>
                                                            <i class="fa fa-star star-icon c-primary" aria-hidden="true"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star star-icon c-primary" aria-hidden="true"></i>
                                                        </li>

                                                        <li>
                                                            <i class="fa fa-star star-icon c-primary" aria-hidden="true"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star star-icon c-primary" aria-hidden="true"></i>
                                                        </li>
                                                        <li>
                                                            <i class="far fa-star star-icon" aria-hidden="true"></i>
                                                        </li>
                                                    </ul>
                                                    <div class="counter">x1</div>
                                                </div>
                                                <div class="product-price">$40</div>
                                                <div class="more">
                                                    <svg class="olymp-little-delete"><use xlink:href="svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="cart-subtotal">Cart Subtotal:<span>$80</span></div>

                                        <div class="cart-btn-wrap">
                                            <a href="#" class="btn btn-primary btn-sm">Go to Your Cart</a>
                                            <a href="#" class="btn btn-purple btn-sm">Go to Checkout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ... end Header Standard Landing  -->
        <div class="header-spacer--standard"></div>

        <div class="container">
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

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel" data-mh="log-tab">
                                <div class="title h6">Confirm Your Email</div>
                                <?php
                                if (isset($_GET['message'])) {
                                    $MESSAGE = new Message($_GET['message']);
                                    ?>
                                    <div class="alert-position">
                                        <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                                            <span id="message"><?php echo $MESSAGE->description; ?></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>


                                <form class="content" id="register" action="post-and-get/member.php" method="post">
                                    <div class="row">
                                        <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label">Enter Code</label>
                                                <input class="form-control" placeholder="" type="text" name="code">
                                            </div>

                                            <input type="submit" class="btn btn-lg btn-primary full-width" name="confirm"  value="Complete Confirmation!">
                                            <input type="hidden" name="id"  value="<?php echo $_GET['id']; ?>">
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