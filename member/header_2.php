<!-- Header-BP -->
<header class="header" id="site-header">
    <div class="page-title">
        <a href="../">
            <img src="img/logo/logo.jpg" alt=""/>
        </a>
    </div>
    <div class="header-content-wrapper">
        <div class="control-block">
            <form class="search-bar w-search notification-list friend-requests">
                <div class="form-group with-button">
                    <input class="form-control js-user-search" placeholder="Search here people or pages..." type="text">
                    <button>
                        <svg class="olymp-magnifying-glass-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                    </button>
                </div>
            </form>
            <div class="control-icon more has-items">
                <a href="../">
                    <span><img src="img/icon/header-icon/home.png" alt="" /></span>
                    <span class="nav-topic">Home</span>
                </a>

            </div>
            <div class="control-icon more has-items">
                <a href="../all-advertisement.php">
                    <span><img src="img/icon/header-icon/advertising.png" alt=""   /></span>
                    <span class="nav-topic">All Ads</span>
                </a>

            </div>
            <div class="control-icon more has-items">
                <a href="../groups.php">
                    <span><img src="img/icon/header-icon/group.png" alt=""  /></span>
                    <span class="nav-topic">All Groups</span>
                </a>

            </div>
            <?php
            if (isset($_SESSION['id'])) {
                ?>
                <div class="control-icon more has-items has-items-news icon-newsfeed">
                    <a href="./">
                        <span><img src="img/icon/header-icon/newsfeed.png" alt=""  /></span>
                        <span class="nav-topic">Newsfeed</span>
                    </a>

                </div>

                <div class="control-icon more has-items has-items1 icon-request">
                    <a href="friend-requests.php">
                        <span>
                            <img class="follower-request" src="img/icon/header-icon/request.png" alt=""/>
                            <?php
                            if (isset($_SESSION['id'])) {
                                $countu = FriendRequest::getCountOfUnviewedRequests($MEMBER->id);
                                if ($countu['count'] > 0) {
                                    ?>
                                    <div class="label-avatar bg-blue newest-request"><?php echo $countu['count']; ?></div>
                                    <?php
                                }
                            }
                            ?>
                        </span>
                        <span class="nav-topic">Requests</span>
                    </a>
                    <div class="more-dropdown more-with-triangle triangle-top-center">
                        <div class="ui-block-title ui-block-title-small">
                            <h6 class="title">FOLLOW REQUESTS</h6>
                            <a>Find Followers</a>
                            <a>Settings</a>
                        </div>

                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            <ul class="notification-list friend-requests friend-requests-notification">
                                <?php
                                if (isset($_SESSION['id'])) {
                                    if (count(FriendRequest::getFriendRequestsByMember($MEMBER->id)) > 0) {

                                        foreach (FriendRequest::getFriendRequestsByMember($MEMBER->id) as $key => $request) {
                                            if ($key < 4) {
                                                $MEMB = new Member($request['requested_by'])
                                                ?>
                                                <li id="request-to-join-<?php echo $MEMB->id; ?>" class="request-to-join-<?php echo $MEMB->id; ?>">
                                                    <div class="author-thumb">
                                                        <?php
                                                        if ($MEMB->profilePicture) {
                                                            if ($MEMB->facebookID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                ?>
                                                                <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>">
                                                                <?php
                                                            } elseif ($MEMB->googleID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                ?>
                                                                <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img alt="profile picture" src="../upload/member/<?php echo $MEMB->profilePicture; ?>">
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <img alt="author" src="../upload/member/member.png" class="avatar">
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="notification-event">
                                                        <a class="h6 notification-friend"><?php echo $MEMB->firstName . ' ' . $MEMB->lastName; ?></a>
                                                        <span class="chat-message-item">Mutual Friend: Sarah Hetfield</span>
                                                    </div>
                                                    <span class="notification-icon">
                                                        <a class="accept-request confirm-request" row_id="<?php echo $request['id']; ?>">
                                                            <span class="icon-add without-text">
                                                                <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                            </span>
                                                        </a>
                                                        <a class="accept-request request-del delete-request" row_id="<?php echo $request['id']; ?>">
                                                            <span class="icon-minus">
                                                                <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                            </span>
                                                        </a>

                                                    </span>

                                                    <div class="more">
                                                        <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                    </div>
                                                </li>

                                                <li class="accepted hidden accepted-request-<?php echo $MEMB->id; ?>" id="accepted-request-<?php echo $MEMB->id; ?>">
                                                    <div class="author-thumb member-request-profile-pic">
                                                        <?php
                                                        if ($MEMB->profilePicture) {
                                                            if ($MEMB->facebookID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                ?>
                                                                <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>">
                                                                <?php
                                                            } elseif ($MEMB->googleID && substr($MEMB->profilePicture, 0, 5) === "https") {
                                                                ?>
                                                                <img alt="profile picture" src="<?php echo $MEMB->profilePicture; ?>">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img alt="profile picture" src="../upload/member/<?php echo $MEMB->profilePicture; ?>">
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <img alt="author" src="../upload/member/member.png" class="avatar">
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="notification-event">
                                                        <a href="profile.php?id=<?php echo $MEMB->id; ?>" class="h6 notification-friend"><?php echo $MEMB->firstName . ' ' . $MEMB->lastName; ?></a> just became a friend of you.
                                                    </div>
                                                    <span class="notification-icon">
                                                        <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                    </span>

                                                </li>
                                                <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li>There is no any friend requests.</li>
                                        <?php
                                    }
                                }
                                ?>

                            </ul>
                        </div>

                        <a href="friend-requests.php" class="view-all bg-theme-blue">See All</a>
                    </div>
                </div>

                <div class="control-icon more has-items">
                    <a href="member-message.php">
                        <span>
                            <img src="img/icon/header-icon/message.png" alt=""/>
                            <?php
                            if (isset($_SESSION['id'])) {
                                $countmsg = AdvertisementMessage::countUnreadMessages($MEMBER->id);
                                if ($countmsg > 0) {
                                    ?>
                                    <div class="label-avatar bg-blue newest-request"><?php echo $countmsg; ?></div>
                                    <?php
                                }
                            }
                            ?>
                        </span>
                        <span class="nav-topic">Messaging</span>
                    </a>
                    <div class="more-dropdown more-with-triangle triangle-top-center">
                        <div class="ui-block-title ui-block-title-small">
                            <h6 class="title">Chat / Messages</h6>
                            <a>Mark all as read</a>
                            <a>Settings</a>
                        </div>

                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            <ul class="notification-list chat-message">

                                <?php
                                if (isset($_SESSION['id'])) {
                                    include './calculate-time.php';
                                    $unreadmsgs = AdvertisementMessage::getUnreadMessages($MEMBER->id);
                                    if (count($unreadmsgs) > 0) {
                                        foreach ($unreadmsgs as $key => $msg) {
                                            $MESSAGE = new AdvertisementMessage($msg['max']);
                                            if ($key < 6) {
                                                if ($MESSAGE->owner == $MEMBER->id) {
                                                    $MEM1 = new Member($MESSAGE->member);
                                                } else {
                                                    $MEM1 = new Member($MESSAGE->owner);
                                                }
                                                $res = getTime($MESSAGE->createdAt);
                                                ?>
                                                <li class="message-unread">
                                                    <div class="author-thumb">
                                                        <img src="../upload/member/<?php echo $MEM1->profilePicture; ?>" alt="author">
                                                    </div>
                                                    <div class="notification-event">
                                                        <a href="member-message.php?id=<?php echo $MESSAGE->id; ?>" class="h6 notification-friend"><?php echo $MEM1->firstName . ' ' . $MEM1->lastName . ' ' . $MESSAGE->advertisement; ?></a>
                                                        <span class="chat-message-item">
                                                            <?php
                                                            if (strlen($MESSAGE->message) > 50) {
                                                                echo substr($MESSAGE->message, 0, 48) . '...';
                                                            } else {
                                                                echo $MESSAGE->message;
                                                            }
                                                            ?>
                                                        </span>
                                                        <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18"><?php echo $res; ?></time></span>
                                                    </div>
                                                    <span class="notification-icon">
                                                        <svg class="olymp-chat---messages-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
                                                    </span>
                                                    <div class="more">
                                                        <svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li>There is no any messages.</li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <a href="member-message.php" class="view-all bg-theme-blue">View All Messages</a>
                    </div>
                </div>

                <div class="control-icon more has-items">
                    <a href="notifications.php">
                        <span>
                            <img src="img/icon/header-icon/notification.png" alt=""/>
                            <?php
                            if (isset($_SESSION['id'])) {
                                $countnotifications = Notification::countUnviewedNotifications($MEMBER->id);
                                if ($countnotifications > 0) {
                                    ?>
                                    <div class="label-avatar bg-blue newest-request newest-notifications"><?php echo $countnotifications; ?></div>
                                    <?php
                                }
                            }
                            ?>
                        </span>
                        <span class="nav-topic">Notifications</span>
                    </a>
                    <div class="more-dropdown more-with-triangle triangle-top-center">
                        <div class="ui-block-title ui-block-title-small">
                            <h6 class="title">Notifications</h6>
                            <a>View All</a>
                            <a>Settings</a>
                        </div>

                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            <ul class="notification-list chat-message">

                                <?php
                                if (isset($_SESSION['id'])) {
                                    $unviewednotif = Notification::getUnviewedNotifications($MEMBER->id);
                                    if (count($unviewednotif) > 0) {
                                        foreach ($unviewednotif as $key => $notification) {
                                            if ($key < 6) {
//                                            $res = getTime($MESSAGE->createdAt);
                                                ?>
                                                <li class="message-unread notif-list" notification="<?php echo $notification['id']; ?>" id="notif_<?php echo $notification['id']; ?>">
                                                    <div class="author-thumb">
                                                        <?php
                                                        if ($notification['title'] == 'Approved Request') {
                                                            if ($notification['image_name']) {
                                                                ?>
                                                                <img src="../upload/group/<?php echo $notification['image_name']; ?>" alt="author">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="../upload/group/member.png" alt="author">
                                                                <?php
                                                            }
                                                        } elseif ($notification['image_name']) {
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
                                                        <span class="chat-message-item">
                                                            <?php echo $notification['description']; ?>
                                                        </span>
                                                        <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">2004-07-24</time></span>
                                                    </div>

                                                </li>
                                                <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li>There is no any notifications.</li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <a href="notifications.php" class="view-all bg-theme-blue">View All</a>
                    </div>
                </div>
                <?php
            }
            ?>
            
            <div class="control-icon author-page author vcard inline-items more">
                <div class="author-thumb icon-profile">
                    <span>
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
                                        <img alt="profile picture" src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                                        <?php
                                    }
                                    ?>
                                </span>
                                <span class="nav-topic">Me <svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg></span>
                                <?php
                            } else {
                                ?>
                                <span><img alt="profile picture" src="../upload/member/member.png" class="avatar" id="profile_pic2"></span>
                                <span class="nav-topic">Me <svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg></span>
                                <?php
                            }
                            ?>
                        </span>
                        <div class="more-dropdown more-with-triangle profile-dropdown">
                            <div class="mCustomScrollbar" data-mcs-theme="dark">
                                <div class="ui-block-title ui-block-title-small">
                                    <h6 class="title">Your Account</h6>
                                </div>

                                <ul class="account-settings">
                                    <li>
                                        <a href="profile.php">

                                            <svg class="olymp-menu-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-menu-icon"></use></svg>

                                            <span>My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="manage-groups.php">
                                            <svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><use xlink:href="svg-icons/sprites/icons.svg#olymp-star-icon"></use></svg>

                                            <span>My Groups</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="log-out.php">
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
                                        <a href="../terms-and-conditions.php">
                                            <span>Terms and Conditions</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../about-us.php">
                                            <span>About Us</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../contact-us.php">
                                            <span>Contact Us</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <?php
                    } else {
                        ?>
                        <a href="login.php">
                            <span>
                                <img alt="author" src="img/icon/header-icon/signin.png" class="signin" id="profile_pic2">
                            </span>
                            <span class="nav-topic">Sign In</span>
                        </a>
                        <?php
                    }
                    ?>
                </div>

            </div>

            <div class="more has-items">
                <a href="create-advertisement.php?back=ad">
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
        <a href="../"><img src="img/icon/header-icon/home.png" alt=""/>Home</a>
        <a href="../all-advertisement.php"><img src="img/icon/header-icon/advertising.png" alt="" />Advertisements</a>
        <a href="../groups.php"><img src="img/icon/header-icon/group.png" alt=""  />Groups</a>
        <a href="./"><img src="img/icon/header-icon/newsfeed.png" alt="" />Newsfeed</a>
        <?php
        if (isset($_SESSION['id'])) {
            ?>
            <a href="friend-requests.php"><img class="follower-request" src="img/icon/header-icon/request.png" alt=""/>Requests</a>
            <a href="member-message.php"><img src="img/icon/header-icon/message.png" alt=""/>Messaging</a>
            <a href="notifications.php"><img src="img/icon/header-icon/message.png" alt=""/>Notifications</a>


            <a href="profile.php">
                <?php
                if ($MEMBER->profilePicture) {
                    ?>
                    <img alt="author" src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                    Profile
                    <?php
                } else {
                    ?>
                    <img alt="author" src="../upload/member/member.png" class="avatar" id="profile_pic2">
                    Profile
                    <?php
                }
                ?>
            </a>
            <?php
        } else {
            ?>
            <a href="login.php">
                <img alt="author" src="img/icon/header-icon/signin.png" class="signin" id="profile_pic2">
                Sign In
            </a>
            <?php
        }
        ?>
        <a href="create-advertisement.php?back=ad">
            <button class="btn-post">
                <i class="icon fa fa-thumbtack"></i>
                Post Your Ad
            </button>
        </a>
    </div>
</div>