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
$count_friends = Friend::countFriends($MEM->id);
if ($count_friends['count'] == 0) {
    $count1 = '0';
} elseif ($count_friends['count'] < 10) {
    $count1 = '0' . $count_friends['count'];
} else {
    $count1 = $count_friends['count'];
}


$count_requests = FriendRequest::getCountOfFriendRequestsByMember($MEMBER->id);
if ($count_requests['count'] == 0) {
    $countr = '0';
} elseif ($count_requests['count'] < 10) {
    $countr = '0' . $count_requests['count'];
} else {
    $countr = $count_requests['count'];
}
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Followers || Profile || Flip.lk</title>

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
                    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="ui-block">
                            <div class="ui-block-title">
                                <div class="h6 title col-sm-3">
                                    <?php echo $MEM->firstName . ' ' . $MEM->lastName . ' (' . $count1 . ')'; ?> 
                                </div>
                                
                                <form class="w-search col-sm-6">
                                    <div class="form-group with-button">
                                        <input class="form-control search-friends" id="search-member" placeholder="Search Friends..." type="text" value="" autocomplete="off">
                                        <div class="" id="name-list-append-friends"></div>
                                        <input type="hidden" name="member" value="" id="member-id"  />
                                        <input type="hidden" name="owner" value="<?php echo $MEM->id; ?>" id="owner"  />
                                        <button class="search-friend-btn">
                                            <svg class="olymp-magnifying-glass-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                                        </button>
                                    </div>
                                </form>
                                <div class="col-sm-1"></div>
                                <div class="col-sm-2 friend-request">
                                    <?php
                                    if ($MEM->id == $MEMBER->id) {
                                        ?>
                                        <a href="friend-requests.php" class="btn btn-smoke btn-md-2 btn-light-bg">Friend Request<span class="request-label-avatar bg-blue"><?php echo $countr; ?></span></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Friends -->

            <div class="container">
                <div class="row">
                    <?php
                    $friends = Friend::getAllFriendsByMember($MEM->id);
                    foreach ($friends as $friend) {
                        if ($MEM->id == $friend['friend']) {
                            $FRI = new Member($friend['member']);
                            $confirmedDate = FriendRequest::getConfirmedDate($friend['friend'], $friend['member']);
                            $countoffriends = Friend::countFriends($friend['member']);
                        } else {
                            $FRI = new Member($friend['friend']);
                            $confirmedDate = FriendRequest::getConfirmedDate($friend['friend'], $friend['member']);
                            $countoffriends = Friend::countFriends($friend['friend']);
                        }
                        $countAds = Advertisement::countAdsByMember($FRI->id);
                        $countGroups = Group::countGroupsByMember($FRI->id);
                        ?>
                        <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                            <div class="ui-block">

                                <!-- Friend Item -->

                                <div class="friend-item">
                                    <div class="friend-header-thumb">
                                        <?php
                                        if ($FRI->status == 0) {
                                            ?>
                                            <img src="../upload/member/cover-picture/cover.jpg" alt="friend">
                                            <?php
                                        } else {
                                            ?>
                                            <img src="../upload/member/cover-picture/thumb/<?php echo $FRI->coverPicture; ?>" alt="friend">
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="friend-item-content">

                                        <div class="friend-avatar">
                                            <div class="author-thumb member-request-profile-pic">
                                                <?php
                                                if ($FRI->status == 0) {
                                                    ?>
                                                    <img src="../upload/member/member.png" alt="author">
                                                    <?php
                                                } else {
                                                    if ($FRI->profilePicture) {
                                                        if ($FRI->facebookID && substr($FRI->profilePicture, 0, 5) === "https") {
                                                            ?>
                                                            <img alt="profile picture" src="<?php echo $FRI->profilePicture; ?>">
                                                            <?php
                                                        } elseif ($FRI->googleID && substr($FRI->profilePicture, 0, 5) === "https") {
                                                            ?>
                                                            <img alt="profile picture" src="<?php echo $FRI->profilePicture; ?>">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img alt="profile picture" src="../upload/member/<?php echo $FRI->profilePicture; ?>">
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <img alt="profile picture" src="../upload/member/member.png">
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="author-content">
                                                <?php
                                                if ($FRI->status == 0) {
                                                    ?>
                                                    <a class="h5 author-name"><?php echo $FRI->firstName . ' ' . $FRI->lastName; ?></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="profile.php?id=<?php echo $FRI->id; ?>" class="h5 author-name"><?php echo $FRI->firstName . ' ' . $FRI->lastName; ?></a>
                                                    <?php
                                                }
                                                ?>
                                                <div class="country"><?php echo $FRI->cityString; ?>, <?php echo $FRI->districtString; ?></div>
                                            </div>
                                        </div>

                                        <div class="swiper-container" data-slide="fade">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="friend-count" data-swiper-parallax="-500">
                                                        <a class="friend-count-item">
                                                            <div class="h6"><?php echo $countoffriends['count']; ?></div>
                                                            <div class="title">Friends</div>
                                                        </a>
                                                        <a class="friend-count-item">
                                                            <div class="h6"><?php echo $countAds; ?></div>
                                                            <div class="title">Ads</div>
                                                        </a>
                                                        <a class="friend-count-item">
                                                            <div class="h6"><?php echo $countGroups; ?></div>
                                                            <div class="title">Groups</div>
                                                        </a>
                                                    </div>
                                                    <div class="control-block-button" data-swiper-parallax="-100">
                                                        <a href="member-message.php?member=<?php echo $FRI->id; ?>" class="btn btn-control bg-purple" title="Chat">
                                                            <svg class=""><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                        </a>

                                                    </div>
                                                </div>

                                                <div class="swiper-slide">
                                                    <p class="friend-about" data-swiper-parallax="-500">
                                                        <?php
                                                        if ($FRI->aboutMe) {
                                                            echo substr($FRI->aboutMe, 0, 50) . '...';
                                                        } else {
                                                            echo 'No description';
                                                        }
                                                        ?>
                                                    </p>

                                                    <div class="friend-since" data-swiper-parallax="-100">
                                                        <span>Friends Since:</span>
                                                        <div class="h6"><?php echo date_format(date_create(substr($confirmedDate['confirmed_date'], 0, 10)), "F Y"); ?></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- If we need pagination -->
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ... end Friend Item -->			
                            </div>
                        </div>
                        <?php
                    }
                    ?>



                </div>
            </div>

            <!-- ... end Friends -->
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
        <script src="js/js/search-friend.js" type="text/javascript"></script>
        <script src="js/js/edit-profile-picture.js" type="text/javascript"></script>
        <script src="js/js/edit-cover-picture.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>
    </body>
</html>
