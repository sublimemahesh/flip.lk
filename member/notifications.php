<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
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
        <title>About || Groups || Flip.lk</title>

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
            <?php
            include './profile-header.php';
            ?>
            <div class="container">
                <div class="row">
                    <div class="col col-xl-8 order-xl-2 col-lg-8 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                        <div class="ui-block">
                            <div class="ui-block-title">
                                <h6 class="title">All Notifications</h6>
                                <a class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                            </div>


                            <!-- Notification List -->

                            <ul class="notification-list friend-requests">
                                <?php
                                foreach (Notification::getAllNotificationsByUser($MEMBER->id) as $notification) {
                                    ?>

                                    <li class="notif-list <?php if($notification['is_viewed'] == 0) { echo 'unviewed-notification'; } ?>" notification="<?php echo $notification['id']; ?>" id="notif_<?php echo $notification['id']; ?>">
                                        <div class="author-thumb member-request-profile-pic">
                                            <?php
                                            if ($notification['image_name']) {
                                                if (substr($notification['image_name'], 0, 5) == 'https') {
                                                    ?>
                                                    <img src="<?php echo $notification['image_name']; ?>" alt="author">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="../upload/member/<?php echo $notification['image_name']; ?>" alt="author">
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <img src="../upload/member/member.png" alt="author">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="notification-event">
                                            <a href="<?php echo $notification['url']; ?>" class="h6 notification-friend"><?php echo $notification['title']; ?></a>
                                            <span class="chat-message-item"><?php echo $notification['description']; ?></span>
                                        </div>

                                    </li>
                                    <?php
                                }
                                ?>

                            </ul>

                            <!-- ... end Notification List Frien Requests -->
                        </div>

                    </div>
                    <?php
                    include './profile-left-side.php';
                    ?>

                    <!-- ... end Left Sidebar -->

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
        <?php
        include './footer.php';
        ?>
        <!-- ... end Window-popup -->
        <!-- updateAllAsViewed -->
        <?php
//        $res = Notification::updateAllAsViewed();
        ?>
        <!-- ... end updateAllAsViewed -->

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
        <script src="js/js/join-group.js" type="text/javascript"></script>
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>
        <script>
//            $('.newest-notifications').text('0');
        </script>
    </body>
</html>