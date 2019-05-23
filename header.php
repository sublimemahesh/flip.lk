<!-- Header-BP -->
<header class="header " id="site-header">
    <div class="page-title">
        <a href="./">
            <img src="img/logo/logo.jpg" alt=""/>
        </a>
    </div>
    <div class="header-content-wrapper">
        <?php
        if (isset($_SESSION['id'])) {
            ?>
            <form class="search-bar w-search notification-list friend-requests">
                <div class="form-group with-button">
                    <input class="form-control js-user-search" id="find-member" placeholder="Search here people..." type="text" value="<?php
                    if (isset($MEM)) {
                        echo $MEM->firstName . ' ' . $MEM->lastName;
                    }
                    ?>" autocomplete="off">
                    <div class="" id="name-list-append"></div>
                    <input type="hidden" name="member" value="" id="member-id"  />
                    <button>
                        <svg class="olymp-magnifying-glass-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                    </button>
                </div>
            </form>
            <?php
        }
        ?>
        <div class="control-block">
            <div class="control-icon more has-items">
                <a href="./">
                    <span><img src="img/icon/header-icon/home.png" alt=""/></span>
                    <span class="nav-topic">Home</span>
                </a>
            </div>
            <div class="control-icon more has-items">
                <a href="all-advertisement.php">
                    <span><img src="img/icon/header-icon/advertising.png" alt="" /></span>
                    <span class="nav-topic">All Ads</span>
                </a>
            </div>
            <div class="control-icon more has-items">
                <a href="groups.php">
                    <span><img src="img/icon/header-icon/group.png" alt=""  /></span>
                    <span class="nav-topic">All Groups</span>
                </a>
            </div>
            <?php
            include './calculate-time.php';
            if (isset($_SESSION['id'])) {
                $countu = FriendRequest::getCountOfUnviewedRequests($MEMBER->id);
                $countmsg = AdvertisementMessage::countUnreadMessages($MEMBER->id);
                $countnotifications = Notification::countUnviewedNotifications($MEMBER->id);
                $total = (int) $countu['count'] + (int) $countmsg + (int) $countnotifications;
                ?>
                <div class="control-icon author-page author vcard inline-items more">
                    <div class="icon-profile">
                        <span><img alt="more" src="img/icon/header-icon/more.png" class="" id=""></span>
                        <?php
                        if ($total > 0) {
                            ?>
                            <div class="label-avatar bg-blue more-circle"><?php echo $total; ?></div>
                            <?php
                        }
                        ?>
                        <span class="nav-topic">More <svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg></span>

                        <div class="more-dropdown more-with-triangle profile-dropdown">
                            <div class="mCustomScrollbar" data-mcs-theme="dark">
                                <div class="ui-block-title ui-block-title-small">
                                    <h6 class="title">More</h6>
                                </div>

                                <ul class="account-settings">
                                    <li class="dropdown-nav">
                                        <a href="member/">

                                            <img src="img/icon/header-icon/new/newsfeed.png" alt=""  />

                                            <span>Newsfeed</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-nav">
                                        <a href="member/friend-requests.php">
                                            <img class="follower-request" src="img/icon/header-icon/new/requests.png" alt=""/>

                                            <span>Requests</span>
                                            <?php
                                            if (isset($_SESSION['id'])) {
                                                if ($countu['count'] > 0) {
                                                    ?>
                                                    <div class="label-avatar bg-blue newest-request"><?php echo $countu['count']; ?></div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </a>
                                    </li>
                                    <li class="dropdown-nav">
                                        <a href="member/member-message.php">
                                            <img src="img/icon/header-icon/new/messaging.png" alt=""/>

                                            <span>Messaging</span>
                                            <?php
                                            if (isset($_SESSION['id'])) {
                                                if ($countmsg > 0) {
                                                    ?>
                                                    <div class="label-avatar bg-blue newest-request"><?php echo $countmsg; ?></div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </a>
                                    </li>
                                    <li class="dropdown-nav">
                                        <a href="member/notifications.php">
                                            <img src="img/icon/header-icon/new/notification.png" alt=""/>

                                            <span>Notifications</span>
                                            <?php
                                            if (isset($_SESSION['id'])) {
                                                if ($countnotifications > 0) {
                                                    ?>
                                                    <div class="label-avatar bg-blue newest-request newest-notifications"><?php echo $countnotifications; ?></div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="control-icon author-page author vcard inline-items more">
                <div class="author-thumb icon-profile">
                    <a href="member/profile.php">
                        <?php
                        if (isset($_SESSION['id'])) {
                            if ($MEMBER->profilePicture) {
                                ?>
                                <span>
                                    <?php
                                    if ($MEMBER->facebookID && substr($MEMBER->profilePicture, 0, 5) === "https") {
                                        ?>
                                        <img alt="profile picture" src="<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                                        <?php
                                    } elseif ($MEMBER->googleID && substr($MEMBER->profilePicture, 0, 5) === "https") {
                                        ?>
                                        <img alt="profile picture" src="<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                                        <?php
                                    } else {
                                        ?>
                                        <img alt="profile picture" src="upload/member/<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                                        <?php
                                    }
                                    ?>
                                </span>
                                <span class="nav-topic">Me <svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg></span>
                                <?php
                            } else {
                                ?>
                                <span><img alt="profile picture" src="upload/member/member.png" class="avatar" id="profile_pic2"></span>
                                <span class="nav-topic">Me <svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg></span>
                                <?php
                            }
                            ?>
                        </a>
                        <div class="more-dropdown more-with-triangle profile-dropdown">
                            <div class="mCustomScrollbar" data-mcs-theme="dark">
                                <div class="ui-block-title ui-block-title-small">
                                    <h6 class="title">Your Account</h6>
                                </div>
                                <ul class="account-settings">
                                    <li>
                                        <a href="member/profile.php">
                                            <svg class="olymp-menu-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-menu-icon"></use></svg>
                                            <span>My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="member/manage-groups.php">
                                            <svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="svg-icons/sprites/icons.svg#olymp-star-icon"></use></svg>

                                            <span>My Groups</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="member/log-out.php">
                                            <svg class="olymp-logout-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-logout-icon"></use></svg>

                                            <span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="ui-block-title ui-block-title-small">
                                    <h6 class="title">About Flip.lk</h6>
                                </div>
                                <ul>
                                    <li>
                                        <a href="terms-and-conditions.php">
                                            <span>Terms and Conditions</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="about-us.php">
                                            <span>About Us</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="contact-us.php">
                                            <span>Contact Us</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <?php
                    } else {
                        ?>
                        <a href="member/login.php">
                            <span><img alt="author" src="img/icon/header-icon/signin.png" class="signin" id="profile_pic2">
                            </span>
                            <span class="nav-topic">Sign In</span>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class=" more has-items">
                <a href="member/create-advertisement.php?back=ad">
                    <button class="btn-post">
                        <i class="icon fa fa-thumbtack"></i>
                        Post Your Ad
                    </button>
                </a>
            </div>

        </div>
    </div>

</header>
<!-- ... end Header-BP -->
<!-- Responsive Header-BP -->
<div class="nav">
    <div class="nav-header">
        <div class="nav-title logo">
            <img src="img/logo/logo.jpg" alt=""/>
        </div>
    </div>
    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>
    <input type="checkbox" id="nav-check">
    <div class="nav-links">
        <a href="./"><img src="img/icon/header-icon/home.png" alt=""/>Home</a>
        <a href="all-advertisement.php"><img src="img/icon/header-icon/advertising.png" alt="" />All Ads</a>
        <a href="groups.php"><img src="img/icon/header-icon/group.png" alt=""  />All Groups</a>
        <a href="member/"><img src="img/icon/header-icon/newsfeed.png" alt="" />Newsfeed</a>

        <?php
        if (isset($_SESSION['id'])) {
//            $countu = FriendRequest::getCountOfUnviewedRequests($MEMBER->id);
//            $countmsg = AdvertisementMessage::countUnreadMessages($MEMBER->id);
//            $countnotifications = Notification::countUnviewedNotifications($MEMBER->id);
            ?>
            <a href="member/friend-requests.php"><img class="follower-request" src="img/icon/header-icon/request.png" alt=""/>Requests

            </a>
            <a href="member/member-message.php"><img src="img/icon/header-icon/message.png" alt=""/>Messaging</a>
            <a href="member/notifications.php"><img src="img/icon/header-icon/notification.png" alt=""/>Notifications</a>

            <a href="member/profile.php">


                <?php
                if ($MEMBER->profilePicture) {
                    ?>
                    <?php
                    if ($MEMBER->facebookID && substr($MEMBER->profilePicture, 0, 5) === "https") {
                        ?>
                        <img alt="profile picture" src="<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                        Profile
                        <?php
                    } elseif ($MEMBER->googleID && substr($MEMBER->profilePicture, 0, 5) === "https") {
                        ?>
                        <img alt="profile picture" src="<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                        Profile
                        <?php
                    } else {
                        ?>
                        <img alt="profile picture" src="upload/member/<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                        Profile
                        <?php
                    }
                    ?>
                    <?php
                } else {
                    ?><img alt="profile picture" src="upload/member/member.png" class="avatar" id="profile_pic2">
                    <?php
                }
                ?>
            </a>
            <?php
        } else {
            ?>
            <a href="member/login.php">
                <img alt="author" src="img/icon/header-icon/signin.png" class="signin" id="profile_pic2">
                Sign In
            </a>
            <?php
        }
        ?>
        <a href="member/create-advertisement.php?back=ad">
            <button class="btn-post">
                <i class="icon fa fa-thumbtack"></i>
                Post Your Ad
            </button>
        </a>
        <?php
        if (isset($_SESSION['id'])) {
            ?>
            <form class="search-bar w-search notification-list friend-requests search-bar-xs">
                <div class="form-group with-button">
                    <input class="form-control js-user-search" id="find-member-xs" placeholder="Search here people..." type="text" value="<?php
                    if (isset($MEM)) {
                        echo $MEM->firstName . ' ' . $MEM->lastName;
                    }
                    ?>" autocomplete="off">
                    <div class="" id="name-list-append-xs"></div>
                    <input type="hidden" name="member" value="" id="member-id"  />
                    <button>
                        <svg class="olymp-magnifying-glass-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                    </button>
                </div>
            </form>
            <?php
        }
        ?>
    </div>
</div>