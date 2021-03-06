<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEM = '';
$MEMBER = new Member($_SESSION['id']);
if (isset($_GET['id'])) {
    $MEM = new Member($_GET['id']);
} else {
    $MEM = new Member($_SESSION['id']);
}
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>About || Profile || Flip.lk</title>

        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">
        <!-- Main Styles CSS -->
        <link rel="stylesheet" type="text/css" href="css/main.min.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.min.css">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>

        <!-- Main Font -->
        <script src="js/webfontloader.min.js"></script>
        <script>
            WebFont.load({
                google: {
                    families: ['Roboto:300,400,500,700:latin']
                }
            });
        </script>

    </head>
    <body>
        <?php
        include './header.php';
        ?>

        <div class="header-spacer"></div>
        <div class="col col-xl-10 order-xl-1 col-lg-9 order-lg-1 col-md-9 col-sm-12 col-12">
            <!-- Top Header-Profile -->
            <?php
            include './profile-header.php';
            ?>
            <!-- ... end Top Header-Profile -->
            <div class="container">
                <div class="row">

                    <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 order-md-2 col-sm-12 col-12">
                        <div class="ui-block">
                                <div class="ui-block-title">
                                    <h6 class="title">Personal Info</h6>
                                </div>
                                <div class="ui-block-content">


                                    <!-- W-Personal-Info -->

                                    <ul class="widget w-personal-info">
                                        <li>
                                            <span class="title">About Me:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->aboutMe) {
                                                    echo $MEM->aboutMe;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Birthday:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->dob) {
                                                    echo date_format(date_create($MEM->dob), "F dS, Y");
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Lives in:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->address) {
                                                    echo $MEM->address;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">City:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->cityString) {
                                                    echo $MEM->cityString;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">District:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->districtString) {
                                                    echo $MEM->districtString;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Occupation:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->occupation) {
                                                    echo $MEM->occupation;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Joined:</span>
                                            <span class="text"><?php echo date_format(date_create(substr($MEM->createdAt, 0, 10)), "F dS, Y"); ?></span>
                                        </li>
                                        <li>
                                            <span class="title">Gender:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->gender) {
                                                    echo ucfirst($MEM->gender);
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Status:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->civilStatus) {
                                                    if ($MEM->civilStatus == 'not_married') {
                                                        echo 'Not Married';
                                                    } else {
                                                        echo 'Married';
                                                    };
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Email:</span>
                                            <a class="text"><?php echo $MEM->email; ?></a>
                                        </li>
                                        <li>
                                            <span class="title">Phone Number:</span>
                                            <span class="text">
                                                <?php
                                                if ($MEM->phoneNumber) {
                                                    echo $MEM->phoneNumber;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </span>
                                        </li>
                                    </ul>

                                    <!-- ... end W-Personal-Info -->
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="back-to-top" href="#">
            <img src="svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
        </a>
        <!-- Window-popup -->
        <?php
        include './window-pop-up.php';
        ?>
        <!-- ... end Window-popup -->
        <?php
        include './footer.php';
        ?>

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
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/edit-profile-picture.js" type="text/javascript"></script>
        <script src="js/js/edit-cover-picture.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>
    </body>
</html>
