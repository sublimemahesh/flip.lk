<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$GROUP = new Group($id);
$count_members = GroupMember::countGroupMembers($id);
if($count_members['count'] == 0) {
    $count =  '0';
} elseif ($count_members['count'] < 10) {
    $count =  '0'.$count_members['count'];
} else {
    $count =  $count_members['count'];
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
        include './group-header.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col col-xl-8 order-xl-2 col-lg-8 order-lg-1 col-md-9 col-sm-12 col-12">
                    <div class="ui-block responsive-flex">
                        <div class="ui-block-title">
                            <div class="h6 title"><?php echo $GROUP->name . ' members (' . $count . ')'; ?></div>
                            <form class="w-search">
                                <div class="form-group with-button">
                                    <input class="form-control" type="text" placeholder="Search Friends...">
                                    <button>
                                        <svg class="olymp-magnifying-glass-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                                    </button>
                                </div>
                            </form>
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                        foreach (GroupMember::getAllAdminsByGroup($GROUP->id) as $key => $admin) {
                            $MEM = new Member($admin['member']);
                            ?>
                            <div class="col col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="ui-block">

                                    <!-- Friend Item -->

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
                                                    <div class="country"><?php echo ucfirst($admin['status']); ?></div>
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
                                                            <a href="#" class="btn btn-control bg-blue">
                                                                <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                            </a>

                                                            <a href="#" class="btn btn-control bg-purple">
                                                                <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
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

                        <?php
                        $allmembers = GroupMember::getAllMembersByGroup($GROUP->id);

                        if (count($allmembers)) {
                            foreach ($allmembers as $key => $member) {
                                $MEM = new Member($member['member']);
                                ?>
                                <div class="col col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="ui-block">

                                        <!-- Friend Item -->

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
                                                        <div class="country"><?php echo ucfirst($member['status']); ?></div>
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
                                                                <a href="#" class="btn btn-control bg-blue">
                                                                    <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                                </a>

                                                                <a href="#" class="btn btn-control bg-purple">
                                                                    <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
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
                        } else {
                            ?>
<!--                            <div class="col col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="ui-block">
                                    <h5>This group has no any members.</h5>
                                </div>
                            </div>-->
                            <?php
                        }
                        ?>

                    </div>

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">12</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <?php
                include './group-about-nav.php';
                ?>
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
    </body>
</html>