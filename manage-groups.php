<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$MEMBER = '';

if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
$no_of_invitations = GroupAndMemberRequest::getCountOfGroupInvitationsByMember($MEMBER->id);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage Groups || Flip.lk</title>

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
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
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
        <div class="col col-xl-10 order-xl-1 col-lg-9 order-lg-1 col-md-9 col-sm-12 col-xs-12 col-12">
            <div class="header-spacer header-spacer-small"></div>
            <!-- Main Header Groups -->
            <div class="main-header">
                <div class="content-bg-wrap bg-group"></div>
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-8 m-auto col-md-8 col-sm-12 col-12">
                            <div class="main-header-content">
                                <h1>Manage your Friend Groups</h1>
                                <p>Welcome to your friends groups! Do you wanna know what your close friends have been up to? Groups
                                    will let you easily manage your friends and put the into categories so when you enter you’ll only
                                    see a newsfeed of those friends that you placed inside the group. Just click on the plus button below and start now!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="img-bottom" src="img/group-bottom.png" alt="friends">
            </div>
            <!-- ... end Main Header Groups -->
            <!-- Main Content Groups -->
            <!--        <div class="container">-->
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div class="ui-block groups-you-manage">
                        <div class="ui-block-title">
                            <h6 class="title">Groups You Manage</h6>
                        </div>
                        <div class="ui-block-content">
                            <div class="row">

                                <div class="col col-xl-4 col-lg-6 col-md-6 col-sm-6 col-sm-12 col-12">
                                    <!-- Friend Item -->
                                    <div class="friend-item friend-groups create-group" data-mh="friend-groups-item">
                                        <a href="create-group.php" class="full-block"></a>
                                        <div class="content">
                                            <a href="create-group.php" class="  btn btn-control bg-blue">
                                                <svg class="olymp-plus-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-plus-icon"></use></svg>
                                            </a>
                                            <div class="author-content">
                                                <a class="h5 author-name">Create Group</a>
                                                <!--<div class="country">6 Friends in the Group</div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ... end Friend Item -->		
                                </div>
                                <?php
                                foreach (Group::getGroupsOfAdmin($MEMBER->id) as $key => $group) {
                                    $members = GroupMember::getAllMembersByGroup($group['id']);
                                    $member_count = count($members);
                                    ?>
                                    <div class="col col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                                        <div class="ui-block members-in-group" data-mh="friend-groups-item">
                                            <!-- Friend Item -->
                                            <div class="friend-item friend-groups">
                                                <div class="friend-item-content">
                                                    <div class="more">
                                                        <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                        <ul class="more-dropdown">
                                                            <li>
                                                                <a href="group-settings.php?id=<?php echo $group['id']; ?>">Group Settings</a>
                                                            </li>
                                                            <li>
                                                                <a class="leave-group" group-id="<?php echo $group['id']; ?>" member-id="<?php echo $MEMBER->id; ?>">Leave Group</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="friend-avatar">
                                                        <div class="author-thumb">
                                                            <img src="../upload/group/<?php echo $group['profile_picture']; ?>" alt="Olympus">
                                                        </div>
                                                        <div class="author-content">
                                                            <a href="group.php?id=<?php echo $group['id']; ?>" class="h5 author-name"><?php echo $group['name']; ?></a>
                                                            <div class="country">
                                                                <?php
                                                                if ($member_count == 1) {
                                                                    $s = '';
                                                                } else {
                                                                    $s = 's';
                                                                }
                                                                echo $member_count;
                                                                ?> Member<?php echo $s; ?> in the Group</div>
                                                        </div>
                                                    </div>

                                                    <ul class="friends-harmonic">
                                                        <?php
                                                        foreach (GroupMember::getAllMembersByGroup($group['id']) as $key => $member) {
                                                            if ($key < 6) {
                                                                $MEMB = new Member($member['member']);
                                                                ?>
                                                                <li>
                                                                    <a title="<?php echo $MEMB->firstName . ' ' . $MEMB->lastName; ?>">
                                                                        <?php
                                                                        if ($MEMB->profilePicture) {
                                                                            if ($MEMB->facebookID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                                ?>
                                                                                <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                <?php
                                                                            } elseif ($MEMB->googleID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                                ?>
                                                                                <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <img alt="profile picture" src="../upload/member/<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <img alt="author" src="../upload/member/member.png" class="friend-list-img" alt="profile">
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </a>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
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
                    </div>
                    <div class="ui-block your-groups hidden">
                        <div class="ui-block-title">
                            <h6 class="title">Your Groups</h6>
                        </div>
                        <div class="ui-block-content">
                            <div class="row">
                                <?php
                                if (count(Group::getGroupsByMember($MEMBER->id)) > 0) {
                                    foreach (Group::getGroupsByMember($MEMBER->id) as $key => $group) {
                                        $members = GroupMember::getAllMembersByGroup($group['id']);
                                        $member_count = count($members);
                                        ?>
                                        <div class="col col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="ui-block members-in-group" data-mh="friend-groups-item">
                                                <!-- Friend Item -->
                                                <div class="friend-item friend-groups">
                                                    <div class="friend-item-content">
                                                        <div class="more">
                                                            <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                            <ul class="more-dropdown">
                                                                <li>
                                                                    <a class="leave-group" group-id="<?php echo $group['id']; ?>" member-id="<?php echo $MEMBER->id; ?>">Leave Group</a>
                                                                </li>
                                                                <li>
                                                                    <a>Edit Notification Settings</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="friend-avatar">
                                                            <div class="author-thumb">
                                                                <img src="../upload/group/<?php echo $group['profile_picture']; ?>" alt="Olympus">
                                                            </div>
                                                            <div class="author-content">
                                                                <a href="group.php?id=<?php echo $group['id']; ?>" class="h5 author-name"><?php echo $group['name']; ?></a>
                                                                <div class="country">
                                                                    <?php
                                                                    if ($member_count == 1) {
                                                                        $s = '';
                                                                    } else {
                                                                        $s = 's';
                                                                    }
                                                                    echo $member_count;
                                                                    ?> Member<?php echo $s; ?> in the Group</div>
                                                            </div>
                                                        </div>

                                                        <ul class="friends-harmonic">
                                                            <?php
                                                            foreach (GroupMember::getAllMembersByGroup($group['id']) as $key => $member) {
                                                                if ($key < 6) {
                                                                    $MEMB = new Member($member['member']);
                                                                    ?>
                                                                    <li>
                                                                        <a title="<?php echo $MEMB->firstName . ' ' . $MEMB->lastName; ?>">
                                                                            <?php
                                                                        if ($MEMB->profilePicture) {
                                                                            if ($MEMB->facebookID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                                ?>
                                                                                <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                <?php
                                                                            } elseif ($MEMB->googleID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                                ?>
                                                                                <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <img alt="profile picture" src="../upload/member/<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <img alt="author" src="../upload/member/member.png" class="friend-list-img" alt="profile">
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- ... end Friend Item -->			
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo 'You are not joined any groups.';
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="ui-block discover-groups hidden">
                        <div class="ui-block-title">
                            <h6 class="title">Discover Groups</h6>
                        </div>
                        <div class="ui-block-content">
                            <div class="row">
                                <?php
                                if (count(Group::getOtherGroups($MEMBER->id)) > 0) {
                                    foreach (Group::getOtherGroups($MEMBER->id) as $key => $group) {
                                        ?>
                                        <div class="col col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="ui-block members-in-group" data-mh="friend-groups-item">
                                                <!-- Friend Item -->
                                                <div class="friend-item friend-groups">
                                                    <div class="friend-item-content">
                                                        <div class="more">
                                                            <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                                                        </div>
                                                        <div class="friend-avatar">
                                                            <div class="author-thumb">
                                                                <img src="../upload/group/<?php echo $group['profile_picture']; ?>" alt="Olympus">
                                                            </div>
                                                            <div class="author-content">
                                                                <a href="group.php?id=<?php echo $group['id']; ?>" class="h5 author-name"><?php echo $group['name']; ?></a>
                                                                <div class="country">
                                                                    <?php
                                                                    if ($member_count == 1) {
                                                                        $s = '';
                                                                    } else {
                                                                        $s = 's';
                                                                    }
                                                                    echo $member_count;
                                                                    ?> Member<?php echo $s; ?> in the Group</div>
                                                            </div>
                                                        </div>

                                                        <ul class="friends-harmonic">
                                                            <?php
                                                            foreach (GroupMember::getAllMembersByGroup($group['id']) as $key => $member) {
                                                                if ($key < 6) {
                                                                    $MEMB = new Member($member['member']);
                                                                    ?>
                                                                    <li>
                                                                        <a title="<?php echo $MEMB->firstName . ' ' . $MEMB->lastName; ?>">
                                                                            <?php
                                                                        if ($MEMB->profilePicture) {
                                                                            if ($MEMB->facebookID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                                ?>
                                                                                <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                <?php
                                                                            } elseif ($MEMB->googleID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                                ?>
                                                                                <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <img alt="profile picture" src="../upload/member/<?php echo $MEMB->profilePicture; ?>" class="friend-list-img">
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <img alt="author" src="../upload/member/member.png" class="friend-list-img" alt="profile">
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- ... end Friend Item -->			
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo 'You are not joined any groups.';
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="ui-block group-invitations hidden">
                        <div class="ui-block-title">
                            <h6 class="title">Group Invitations (<span id="group-invitation-count"><?php echo $no_of_invitations['count']; ?></span>)</h6>
                            <a class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>
                        <!-- Notification List Frien Requests -->

                        <ul class="notification-list friend-requests">
                            <?php
                            foreach (GroupAndMemberRequest::getGroupInvitationsByMember($MEMBER->id) as $request) {
                                $GROUP = new Group($request['group_id']);
                                ?>

                                <li id="request-to-join-<?php echo $GROUP->id; ?>">
                                    <div class="author-thumb">
                                        <img src="../upload/group/<?php echo $GROUP->profilePicture; ?>" alt="author">
                                    </div>
                                    <div class="notification-event">
                                        <span><a href="group.php?id=<?php echo $GROUP->id; ?>" class="h6 notification-friend"><?php echo $GROUP->name; ?></a> is invited you to join with them.</span>
                                        <span class="chat-message-item">Mutual Friend: Sarah Hetfield</span>
                                    </div>
                                    <span class="notification-icon">
                                        <a class="accept-request confirm-invitation" row_id="<?php echo $request['id']; ?>">
                                            <span class="icon-add">
                                                <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                            </span>
                                            Confirm Request
                                        </a>

                                        <a class="accept-request request-del delete-invitation" row_id="<?php echo $request['id']; ?>">
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

                                <li class="accepted hidden" id="accepted-invititation-<?php echo $GROUP->id; ?>">
                                    <div class="author-thumb member-request-profile-pic">
                                        <img src="../upload/group/<?php echo $GROUP->profilePicture; ?>" alt="author">
                                    </div>
                                    <div class="notification-event">
                                        You are joined to the <a href="group.php?id=<?php echo $GROUP->id; ?>" class="h6 notification-friend"><?php echo $GROUP->name; ?></a> successfully.
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
                include './group-navigation.php';
                ?>
            </div>
            <!--</div>-->
            <!-- ... end Main Content Groups -->
        </div>
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
        <script src="js/js/custom.js" type="text/javascript"></script>
        <script src="js/js/join-group.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/group.js" type="text/javascript"></script>
        <script src="js/js/view-notification.js" type="text/javascript"></script>
    </body>
</html>