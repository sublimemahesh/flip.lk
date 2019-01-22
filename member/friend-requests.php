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
$no_of_request = FriendRequest::getCountOfFriendRequestsByMember($MEMBER->id);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>About || Flip.lk</title>

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
        include './sidebar-left.php';
        ?>
        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>

        <?php
        include './profile-header.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Friend requests (<span id="member-request-count"><?php echo $no_of_request['count']; ?></span>)</h6>
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>


                        <!-- Notification List Frien Requests -->

                        <ul class="notification-list friend-requests">
                            <?php
                        foreach (FriendRequest::getFriendRequestsByMember($MEMBER->id) as $request) {
                            $MEM = new Member($request['requested_by']);
                            ?>
                            
                            <li id="request-to-join-<?php echo $MEM->id; ?>">
                                <div class="author-thumb">
                                    <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" alt="author">
                                </div>
                                <div class="notification-event">
                                    <a href="profile.php?id=<?php echo $MEM->id; ?>" class="h6 notification-friend"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a>
                                    <span class="chat-message-item">Mutual Friend: Sarah Hetfield</span>
                                </div>
                                <span class="notification-icon">
                                    <a href="#" class="accept-request confirm-request" row_id="<?php echo $request['id']; ?>">
                                        <span class="icon-add">
                                            <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                        </span>
                                        Confirm Request
                                    </a>

                                    <a href="#" class="accept-request request-del delete-request" row_id="<?php echo $request['id']; ?>">
                                        <span class="icon-minus">
                                            <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                        </span>
                                    </a>

                                </span>

                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <svg class="olymp-little-delete"><use xlink:href="svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                </div>
                            </li>

                            <li class="accepted hidden" id="accepted-request-<?php echo $MEM->id; ?>">
                                <div class="author-thumb member-request-profile-pic">
                                    <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" alt="author">
                                </div>
                                <div class="notification-event">
                                    <a href="profile.php?id=<?php echo $MEM->id; ?>" class="h6 notification-friend"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a> just became a friend of you.
                                </div>
                                <span class="notification-icon">
                                    <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                </span>

                                <div class="more">
                                    <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <svg class="olymp-little-delete"><use xlink:href="svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                </div>
                            </li>
                            <?php
                        }
                        ?>

                        </ul>

                        <!-- ... end Notification List Frien Requests -->
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
        <script src="js/js/friend-request.js" type="text/javascript"></script>
    </body>
</html>