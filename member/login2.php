<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$img = '';
$cover = '';
$c = '';

if (isset($_SESSION['image'])) {
    $img = $_SESSION['image'];
}
if (isset($_SESSION['cover'])) {
    $cover = $_SESSION['cover'];
}
if (isset($_GET['c'])) {
    $c = 'c';
}
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
                    <a href="#" class="logo">
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

                    <div class="registration-login-form">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                    <svg class="olymp-login-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-login-icon"></use></svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                    <svg class="olymp-register-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-register-icon"></use></svg>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel" data-mh="log-tab">
                                <div class="title h6">Upload Profile Picture</div>
                                <div class="alert-position hidden">
                                    <div class="alert alert-danger" role="alert">
                                        <span id="message"></span>
                                    </div>
                                </div>

                                <form class="content" id="form-profile-picture">
                                    <div class="row upload-pro-pic">
                                        <!--<img src="image/driver.png" alt=""/>-->
                                        <div class="uploadphotobx" id="uploadphotobx"> 


                                            <div class="proimg">
                                                <?php
                                                if (isset($_SESSION['image'])) {
                                                    ?>
                                                    <img src="../upload/member/<?php echo $img; ?>" class="profile-default-image pro-pic" alt=""/>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="image/profile.png" class="profile-default-image" alt=""/>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <label class="uploadBox">
                                                <!--<input type="file" name="profile-picture" id="profile-picture" class="profile-picture" sort="1" value="">-->
                                                <input type="hidden" name="upload-profile" id="upload-profile" value="TRUE">
                                                <input type="hidden" name="sort" id="sort" value="1">
                                            </label>


                                        </div>
                                        <span class="upload-span" id="upload-span">
                                            <i class="fa fa-camera fa-2x"></i><br />
                                            Click here to Upload photo
                                            <input type="file" name="profile-picture" id="profile-picture" class="profile-picture" sort="1" value="">
                                        </span>

                                    </div>
                                    <input type="hidden" id="pro" name="profile" value="<?php echo $img; ?>" />
                                    <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['id']; ?>" />
                                    <input type="submit" class="btn btn-lg btn-primary full-width btn-upload" id="upload-pro-pic" name="upload-pro-pic"  value="Upload Profile Picture">
                                </form>
                            </div>

                            <div class="tab-pane" id="profile" role="tabpanel" data-mh="log-tab">
                                <div class="title h6">Upload Cover Picture</div>
                                <form class="content" id="form-cover-picture">
                                    <div class="row upload-cover-pic">
                                        <!--<img src="image/driver.png" alt=""/>-->
                                        <div class="uploadphotobx2" id="uploadphotobx2"> 


                                            <div class="coverimg">
                                                <?php
                                                if (isset($_SESSION['cover'])) {
                                                    ?>
                                                    <img src="../upload/member/cover-picture/thumb/<?php echo $cover; ?>" class="cover-default-image cover-pic" alt=""/>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="image/cover.jpg" class="cover-default-image" alt=""/>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <label class="uploadBox2">
                                                <!--<input type="file" name="profile-picture" id="profile-picture" class="profile-picture" sort="1" value="">-->
                                                <input type="hidden" name="upload-cover" id="upload-cover" value="TRUE">
                                                <input type="hidden" name="sort" id="sort" value="1">
                                            </label>


                                        </div>
                                        <span class="upload-span2" id="upload-span2">
                                            <i class="fa fa-camera fa-2x"></i><br />
                                            Click here to Upload photo
                                            <input type="file" name="cover-picture" id="cover-picture" class="cover-picture" sort="1" value="">
                                        </span>

                                    </div>
                                    <input type="hidden" id="cover" name="cover" value="<?php echo $cover; ?>" />
                                    <input type="hidden" id="c" name="c" value="<?php echo $c; ?>" />
                                    <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['id']; ?>" />
                                    <input type="submit" class="btn btn-lg btn-primary full-width btn-upload" id="upload-cover-pic" name="upload-pro-pic"  value="Upload Cover Picture">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ... end Login-Registration Form  -->		</div>
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
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script src="js/js/add-profile-picture.js" type="text/javascript"></script>
        <script src="js/js/add-cover-picture.js" type="text/javascript"></script>
    </body>
</html>