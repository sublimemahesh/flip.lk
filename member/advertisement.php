<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$MEM = '';
$id = '';
$MEMBER = new Member($_SESSION['id']);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $MEM = new Member($_GET['id']);
} else {
    $MEM = new Member($_SESSION['id']);
}
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
    </head>
    <body>

        <?php
        include './sidebar-left.php';
        ?>
        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <!-- Top Header-Profile -->
        <?php
        include './profile-header.php';
        ?>
        <!-- ... end Top Header-Profile -->
        <div class="container">
            <div class="row">

                <!-- Main Content -->

                <div class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                    <input type="hidden" id="member" value="<?php echo $MEMBER->id ?>" />
                    <div id="newsfeed-items-grid">

                        <?php
                        include './calculate-time.php';
                        $ads = Advertisement::getAdsByMember($MEMBER->id);
                        if (count($ads) > 0) {
                            foreach ($ads as $key => $ad) {
                                $GROUP = new Group($ad['group_id']);
                                $result = getTime($ad['created_at']);
                                ?>

                                <div class="ui-block">
                                    <!-- Post -->

                                    <article class="hentry post has-post-thumbnail shared-photo ad_<?php echo $ad['id']; ?>" id="ad-id" post-id="<?php echo $ad['id']; ?>">

                                        <div class="post__author author vcard inline-items">
                                            <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author">

                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="profile.php"><?php echo $MEMBER->firstName . ' ' . $MEMBER->lastName; ?></a> <i class="fa fa-caret-right"></i> <a class="h6 post__author-name fn" href="group.php?id=<?php echo $GROUP->id; ?>"><?php echo $GROUP->name; ?></a> 
                                                <div class="post__date">
                                                    <time class="published">
                                                        <?php echo $result; ?>
                                                    </time>
                                                </div>
                                            </div>

                                            <div class="more">
                                                <svg class="olymp-three-dots-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                                </svg>
                                                <ul class="more-dropdown">
                                                    <li>
                                                        <a href="edit-advertisement.php?id=<?php echo $ad['id']; ?>" class="edit-ad" id="<?php echo $ad['id']; ?>">Edit Advertisement</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="delete-ad" id="<?php echo $ad['id']; ?>">Delete Advertisement</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Turn Off Notifications</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Select as Featured</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <h5><b><?php echo $ad['title']; ?></b></h5>
                                        <?php echo $ad['description']; ?>

                                        <div class="post-thumb">
                                            <div id="gallery-<?php echo $ad['id']; ?>"></div>
                                        </div>
                                        <div class=" content">

                                        </div>



                                        <div class="post-additional-info inline-items">

                                            <a href="#" class="post-add-icon inline-items">
                                                <svg class="olymp-heart-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                                </svg>
                                                <span>15</span>
                                            </a>

                                            <ul class="friends-harmonic">
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic5.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic10.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic7.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic8.jpg" alt="friend">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/friend-harmonic2.jpg" alt="friend">
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="names-people-likes">
                                                <a href="#">Diana</a>, <a href="#">Nicholas</a> and
                                                <br>13 more liked this
                                            </div>

                                            <div class="comments-shared">
                                                <a href="#" class="post-add-icon inline-items">
                                                    <svg class="olymp-speech-balloon-icon">
                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                                    </svg>
                                                    <span>0</span>
                                                </a>

                                                <a href="#" class="post-add-icon inline-items">
                                                    <svg class="olymp-share-icon">
                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                                    </svg>
                                                    <span>16</span>
                                                </a>
                                            </div>

                                        </div>

                                        <div class="control-block-button post-control-button">

                                            <a href="#" class="btn btn-control">
                                                <svg class="olymp-like-post-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use>
                                                </svg>
                                            </a>

                                            <a href="#" class="btn btn-control">
                                                <svg class="olymp-comments-post-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use>
                                                </svg>
                                            </a>

                                            <a href="#" class="btn btn-control">
                                                <svg class="olymp-share-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                                </svg>
                                            </a>

                                        </div>


                                    </article>

                                    <!-- .. end Post -->
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

                <!-- ... end Main Content -->


                <!-- Left Sidebar -->

                <div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">

                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Profile Intro</h6>
                        </div>
                        <div class="ui-block-content">

                            <!-- W-Personal-Info -->

                            <ul class="widget w-personal-info item-block">
                                <li>
                                    <span class="title">About Me:</span>
                                    <span class="text"><?php echo $MEM->aboutMe; ?></span>
                                </li>
                            </ul>

                            <!-- .. end W-Personal-Info -->
                        </div>
                    </div>

                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Friends (86)</h6>
                        </div>
                        <div class="ui-block-content">

                            <!-- W-Faved-Page -->

                            <ul class="widget w-faved-page js-zoom-gallery">
                                <li>
                                    <a href="#">
                                        <img src="img/avatar38-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar24-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar36-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar35-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar34-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar33-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar32-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar31-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar30-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar29-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar28-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar27-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar26-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar25-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li class="all-users">
                                    <a href="#">+74</a>
                                </li>
                            </ul>

                            <!-- .. end W-Faved-Page -->
                        </div>
                    </div>

                </div>

                <!-- ... end Left Sidebar -->


                <!-- Right Sidebar -->

                <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">

                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Last Photos</h6>
                        </div>
                        <div class="ui-block-content">

                            <!-- W-Latest-Photo -->

                            <ul class="widget w-last-photo js-zoom-gallery">
                                <li>
                                    <a href="img/last-photo10-large.jpg">
                                        <img src="img/last-photo10-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot11-large.jpg">
                                        <img src="img/last-phot11-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot12-large.jpg">
                                        <img src="img/last-phot12-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot13-large.jpg">
                                        <img src="img/last-phot13-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot14-large.jpg">
                                        <img src="img/last-phot14-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot15-large.jpg">
                                        <img src="img/last-phot15-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot16-large.jpg">
                                        <img src="img/last-phot16-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot17-large.jpg">
                                        <img src="img/last-phot17-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot18-large.jpg">
                                        <img src="img/last-phot18-large.jpg" alt="photo">
                                    </a>
                                </li>
                            </ul>


                            <!-- .. end W-Latest-Photo -->
                        </div>
                    </div>



                </div>

                <!-- ... end Right Sidebar -->

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
        <script src="js/js/my-ad-slider.js" type="text/javascript"></script>
        <script src="js/js/delete-ad.js" type="text/javascript"></script>
    </body>
</html>