<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
    $count_requests = FriendRequest::getCountOfFriendRequestsByMember($MEMBER->id);
    if ($count_requests['count'] == 0) {
        $countr = '0';
    } elseif ($count_requests['count'] < 10) {
        $countr = '0' . $count_requests['count'];
    } else {
        $countr = $count_requests['count'];
    }
}

$MEM = '';
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
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Groups || Flip.lk</title>
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
        <link href="css/search-box.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <?php
        include './banner.php';
        ?>
        <div class="container index-container body-content">

            <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <?php
                include './member-header.php';
                ?>
                <!-- ... end Top Header-Profile -->

                <div class="container">
                    <div class="row">
                        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ui-block responsive-flex">
                                <div class="ui-block-title">
                                    <div class="h6 title col-sm-2">
                                        <?php echo $MEM->firstName . ' ' . $MEM->lastName . ' (' . $count1 . ')'; ?> 
                                    </div>
                                    <form class="w-search col-sm-4">
                                        <div class="form-group with-button">
                                            <input class="form-control" type="text" placeholder="Search Friends...">
                                            <button class="search-btn">
                                                <svg class="olymp-magnifying-glass-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                                            </button>
                                        </div>
                                    </form>
                                    <!--                                <form class="w-search col-sm-4">
                                                                        <div class="form-group with-button">
                                                                            <input class="form-control js-user-search" id="find-member" type="text" placeholder="Find Friends...">
                                                                            <button class="search-btn">
                                                                                <svg class="olymp-magnifying-glass-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                                                                            </button>
                                                                        </div>
                                                                    </form>-->
                                    <form class="w-search col-sm-4">
                                        <div class="form-group with-button">
                                            <input class="form-control find-friends" id="find-member" placeholder="Find Friends..." type="text" value="" autocomplete="off">
                                            <div class="" id="name-list-append"></div>
                                            <input type="hidden" name="member" value="" id="member-id"  />
                                            <button>
                                                <svg class="olymp-magnifying-glass-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                                            </button>
                                        </div>
                                    </form>
                                    <div class="col-sm-2 friend-request">
                                        <?php
                                        if (isset($_SESSION['id'])) {
                                            if ($MEM->id == $MEMBER->id) {
                                                ?>
                                                <a href="friend-requests.php" class="btn btn-smoke btn-md-2 btn-light-bg">Friend Request<span class="request-label-avatar bg-blue"><?php echo $countr; ?></span></a>
                                                <?php
                                            }
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
                            ?>
                            <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                                <div class="ui-block">

                                    <!-- Friend Item -->

                                    <div class="friend-item">
                                        <div class="friend-header-thumb">
                                            <?php
                                            if ($FRI->status == 0) {
                                                ?>
                                                <img src="upload/member/cover-picture/cover.jpg" alt="friend">
                                                <?php
                                            } else {
                                                ?>
                                                <img src="upload/member/cover-picture/thumb/<?php echo $FRI->coverPicture; ?>" alt="friend">
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
                                                        <img src="upload/member/member.png" alt="author">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img src="upload/member/<?php echo $FRI->profilePicture; ?>" alt="author">
                                                        <?php
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
                                                        <a href="view-member.php?id=<?php echo $FRI->id; ?>" class="h5 author-name"><?php echo $FRI->firstName . ' ' . $FRI->lastName; ?></a>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="country">San Francisco, CA</div>
                                                </div>
                                            </div>

                                            <div class="swiper-container" data-slide="fade">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <div class="friend-count" data-swiper-parallax="-500">
                                                            <a href="#" class="friend-count-item">
                                                                <div class="h6"><?php echo $countoffriends['count']; ?></div>
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
                                                            <a href="#" class="btn btn-control bg-purple">
                                                                <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                            </a>

                                                        </div>
                                                    </div>

                                                    <div class="swiper-slide">
                                                        <p class="friend-about" data-swiper-parallax="-500">
                                                            <?php echo substr($FRI->aboutMe, 0, 50) . '...'; ?>
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
        </div>
        <input type="hidden" id="autocomplete2" placeholder="Location" value="<?php echo $_GET['location']; ?>">
        <div id="map"></div>
        <?php
        include './footer.php';
        ?>
        <?php
        include './window-pop-up.php';
        ?>
        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/perfect-scrollbar.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script src="js/js/friend-request.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/all-ad-slider.js" type="text/javascript"></script>
        <script src="js/choices.js" type="text/javascript"></script>
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script src="js/js/read-more-and-less.js" type="text/javascript"></script>
        <script src="js/js/join-group.js" type="text/javascript"></script>
        <script src="js/js/ad-slider.js" type="text/javascript"></script>
        <script src="js/js/delete-ad.js" type="text/javascript"></script>
        <script src="js/js/ad-comment.js" type="text/javascript"></script>
        <script src="js/js/ad-reply.js" type="text/javascript"></script>
        <script src="js/js/shared-ad.js" type="text/javascript"></script>
        <script src="js/js/login-first.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>
    </body>
</html>