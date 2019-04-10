<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
$GROUP = new Group($id);
$count_members = GroupMember::countGroupMembers($id);
$admin = GroupMember::getGroupAdmin($GROUP->id);
if ($count_members['count'] == 0) {
    $count = '0';
} elseif ($count_members['count'] < 10) {
    $count = '0' . $count_members['count'];
} else {
    $count = $count_members['count'];
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
                                                    <img src="upload/member/cover-picture/thumb/<?php echo $MEM->coverPicture; ?>" alt="member">
                                                </div>

                                                <div class="friend-item-content">

                                                    <div class="more">
                                                        <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                        <?php
                                                        if (isset($_SESSION['id'])) {
                                                            if (in_array($MEMBER->id, $admin)) {
                                                                ?>
                                                                <ul class="more-dropdown">
                                                                    <li>
                                                                        <a class="remove-member" id="" group="<?php echo $GROUP->id; ?>" member="<?php echo $MEM->id; ?>">Remove Member</a>
                                                                    </li>
                                                                </ul>
                                                                <?php
                                                            }
                                                        }
                                                        ?>


                                                    </div>
                                                    <div class="friend-avatar">
                                                        <div class="author-thumb member-request-profile-pic">
                                                            <?php
                                                            if ($MEM->profilePicture) {
                                                                if ($MEM->facebookID && substr($MEM->profilePicture, 0, 5) === "https") {
                                                                    ?>
                                                                    <img alt="profile picture" src="<?php echo $MEM->profilePicture; ?>">
                                                                    <?php
                                                                } elseif ($MEM->googleID && substr($MEM->profilePicture, 0, 5) === "https") {
                                                                    ?>
                                                                    <img alt="profile picture" src="<?php echo $MEM->profilePicture; ?>">
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <img alt="profile picture" src="upload/member/<?php echo $MEM->profilePicture; ?>">
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <img src="upload/member/member.png" alt="profile picture">
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="author-content">
                                                            <a href="view-member.php?id=<?php echo $MEM->id; ?>" class="h5 author-name"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a>
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
                                                        <?php
                                                        if ($MEM->status == 0) {
                                                            ?>
                                                            <img src="upload/member/cover-picture/cover.jpg" alt="friend" alt="member">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="upload/member/cover-picture/thumb/<?php echo $MEM->coverPicture; ?>" alt="friend">
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="friend-item-content">

                                                        <div class="more">
                                                            <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                            <?php
                                                            if (isset($_SESSION['id'])) {
                                                                if (in_array($MEMBER->id, $admin)) {
                                                                    ?>
                                                                    <ul class="more-dropdown">
                                                                        <li>
                                                                            <a class="remove-member" id="" group="<?php echo $GROUP->id; ?>" member="<?php echo $MEM->id; ?>">Remove Member</a>
                                                                        </li>
                                                                    </ul>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="friend-avatar">
                                                            <div class="author-thumb member-request-profile-pic">
                                                                <?php
                                                                if ($MEM->status == 0) {
                                                                    ?>
                                                                    <img src="upload/member/member.png" alt="friend" alt="member">
                                                                    <?php
                                                                } else {
                                                                    
                                                                    if ($MEM->profilePicture) {
                                                                        if ($MEM->facebookID && substr($MEM->profilePicture, 0, 5) === "https") {
                                                                            ?>
                                                                            <img alt="profile picture" src="<?php echo $MEM->profilePicture; ?>">
                                                                            <?php
                                                                        } elseif ($MEM->googleID && substr($MEM->profilePicture, 0, 5) === "https") {
                                                                            ?>
                                                                            <img alt="profile picture" src="<?php echo $MEM->profilePicture; ?>">
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <img alt="profile picture" src="upload/member/<?php echo $MEM->profilePicture; ?>">
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <img src="upload/member/member.png" alt="profile picture">
                                                                        <?php
                                                                    }
                                                                    
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="author-content">
                                                                <?php
                                                                if ($MEM->status == 0) {
                                                                    ?>
                                                                    <a class="h5 author-name"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <a href="view-member.php?id=<?php echo $MEM->id; ?>" class="h5 author-name"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a>
                                                                    <?php
                                                                }
                                                                ?>
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

                            <!--                        <nav aria-label="Page navigation">
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
                                                    </nav>-->
                        </div>

                        <?php
                        include './group-about-nav.php';
                        ?>

                    </div>
                </div>
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