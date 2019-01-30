<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$GROUP = new Group($id);
$no_of_request = GroupAndMemberRequest::getCountOfMemberRequestsByGroup($id);
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
        include './group-header.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Member requests (<span id="member-request-count"><?php echo $no_of_request['count']; ?></span>)</h6>
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>


                        <!-- Notification List Frien Requests -->

                        <ul class="notification-list friend-requests">
                            <?php
                        foreach (GroupAndMemberRequest::getMemberRequestsByGroup($id) as $request) {
                            $MEM = new Member($request['member']);
                            ?>
                            
                            <li id="request-to-join-<?php echo $MEM->id; ?>">
                                <div class="author-thumb member-request-profile-pic">
                                    <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" alt="author">
                                </div>
                                <div class="notification-event">
                                    <a href="profile.php?id=<?php echo $MEM->id; ?>" class="h6 notification-friend"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a>
                                    <span class="chat-message-item">Mutual Friend: Sarah Hetfield</span>
                                </div>
                                <span class="notification-icon">
                                    <a href="#" class="accept-request approve-request" id="approve-request" row_id="<?php echo $request['id']; ?>">
                                        <span class="icon-add">
                                            <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                        </span>
                                        Approve Member Request
                                    </a>

                                    <a href="#" class="accept-request request-del decline-request" id="decline-request" row_id="<?php echo $request['id']; ?>">
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
                                    <a href="profile.php?id=<?php echo $MEM->id; ?>" class="h6 notification-friend"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a> just became member of your group.
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
                <?php
                include './group-about-nav.php';
                ?>
            </div>
        </div>




<!--        <div class="container">
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                    <div class="ui-block responsive-flex">
                        <div class="ui-block-title">
                            <div class="h6 title">Member requests (<?php echo $no_of_request['count']; ?>)</div>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                        foreach (GroupAndMemberRequest::getMemberRequestsByGroup($id) as $request) {
                            $MEM = new Member($request['member']);
                            ?>
                            <div class="col col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="ui-block">

                                     Friend Item 

                                    <div class="friend-item">
                                        <div class="friend-header-thumb">
                                            <img src="../upload/member/cover-picture/thumb/<?php echo $MEM->coverPicture; ?>" alt="member">
                                        </div>

                                        <div class="friend-item-content">

                                            <div class="more">
                                                <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                <ul class="more-dropdown">
                                                    <li>
                                                        <a href="#">Report Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Block Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Turn Off Notifications</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="friend-avatar">
                                                <div class="author-thumb member-request-profile-pic">
                                                    <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" alt="author">
                                                </div>
                                                <div class="author-content">
                                                    <a href="profile.php?id=<?php echo $MEM->id; ?>" class="h5 author-name"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a>
                                                    <div class="country"><?php // echo $MEM->city . ' ' . $MEM->district;  ?></div>
                                                </div>
                                            </div>

                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <div class="friend-count" data-swiper-parallax="-500">
                                                            <a href="#" class="friend-count-item">
                                                                <div class="h6">52</div>
                                                                <div class="title">Friends</div>
                                                            </a>
                                                            <a href="#" class="friend-count-item">
                                                                <div class="h6">240</div>
                                                                <div class="title">Photos</div>
                                                            </a>
                                                            <a href="#" class="friend-count-item">
                                                                <div class="h6">16</div>
                                                                <div class="title">Videos</div>
                                                            </a>
                                                        </div>
                                                        <div class="control-block-button" data-swiper-parallax="-100">
                                                            <a href="#" class="btn btn-control-square bg-blue" id="approve-request" row_id="<?php echo $request['id']; ?>">
                                                                Approve
                                                            </a>
                                                            <a href="#" class="btn btn-control-square bg-purple" id="decline-request" row_id="<?php echo $request['id']; ?>">
                                                                Decline
                                                            </a>

                                                        </div>
                                                    </div>

                                                    <div class="swiper-slide">
                                                        <p class="friend-about" data-swiper-parallax="-500">
                                                            <?php echo substr($MEM->aboutMe, 0, 50) . '...'; ?>
                                                        </p>

                                                        <div class="friend-since" data-swiper-parallax="-100">
                                                            <span>Friends Since:</span>
                                                            <div class="h6"><?php echo date_format(date_create(substr($MEM->createdAt, 0, 10)), "F Y"); ?></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                 If we need pagination 
                                                <div class="swiper-pagination"></div>
                                            </div>
                                        </div>
                                    </div>

                                     ... end Friend Item 					</div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>

                </div>
                <?php
                include './group-about-nav.php';
                ?>
            </div>
        </div>-->
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
        <script src="js/js/join-group.js" type="text/javascript"></script>
        <script src="js/js/find-friends.js" type="text/javascript"></script>
    </body>
</html>