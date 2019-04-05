<!-- Header-BP -->
<header class="header " id="site-header">
    <div class="page-title">
        <a href="./">
            <img src="img/logo/logo.jpg" alt=""/>
        </a>
    </div>
    <div class="header-content-wrapper">
        <div class="control-block">
            <div class="control-icon more has-items">
                <a href="./">
                    <span><img src="img/icon/header-icon/home.png" alt=""/></span>
                    Home
                </a>
            </div>
            <div class="control-icon more has-items">
                <a href="all-advertisement.php">
                    <span><img src="img/icon/header-icon/advertising.png" alt="" /></span>
                    Advertisements
                </a>
            </div>
            <div class="control-icon more has-items">
                <a href="groups.php">
                    <span><img src="img/icon/header-icon/group.png" alt=""  /></span>
                    Groups
                </a>
            </div>
            <div class="control-icon more has-items">
                <a href="member/">
                    <span><img src="img/icon/header-icon/newsfeed.png" alt="" /></span>
                    Newsfeed
                </a>
            </div>
            <div class="control-icon more has-items has-items1">
                <a href="#">
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
                    Requests
                </a>
                <div class="more-dropdown more-with-triangle triangle-top-center">
                    <div class="ui-block-title ui-block-title-small">
                        <h6 class="title">FOLLOW REQUESTS</h6>
                        <a href="#">Find Followers</a>
                        <a href="#">Settings</a>
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
                                                    <img src="upload/member/<?php echo $MEMB->profilePicture; ?>" alt="author">
                                                </div>
                                                <div class="notification-event">
                                                    <a href="#" class="h6 notification-friend"><?php echo $MEMB->firstName . ' ' . $MEMB->lastName; ?></a>
                                                    <span class="chat-message-item">Mutual Friend: Sarah Hetfield</span>
                                                </div>
                                                <span class="notification-icon">
                                                    <a href="#" class="accept-request confirm-request" row_id="<?php echo $request['id']; ?>">
                                                        <span class="icon-add without-text">
                                                            <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                        </span>
                                                    </a>
                                                    <a href="#" class="accept-request request-del delete-request" row_id="<?php echo $request['id']; ?>">
                                                        <span class="icon-minus">
                                                            <svg class="olymp-happy-face-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use></svg>
                                                        </span>
                                                    </a>
                                                </span>
                                            </li>
                                            <li class="accepted hidden accepted-request-<?php echo $MEMB->id; ?>" id="accepted-request-<?php echo $MEMB->id; ?>">
                                                <div class="author-thumb member-request-profile-pic">
                                                    <img src="../upload/member/<?php echo $MEMB->profilePicture; ?>" alt="author">
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
                                    <li>There is no any follow requests.</li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <a href="member/friend-requests.php" class="view-all bg-theme-blue">See All</a>
                </div>
            </div>
            <div class="control-icon more has-items">
                <a href="#">
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
                    Messaging
                </a>
                <div class="more-dropdown more-with-triangle triangle-top-center">
                    <div class="ui-block-title ui-block-title-small">
                        <h6 class="title">Chat / Messages</h6>
                        <a href="#">Mark all as read</a>
                        <a href="#">Settings</a>
                    </div>
                    <div class="mCustomScrollbar" data-mcs-theme="dark">
                        <ul class="notification-list chat-message">
                            <?php
                            include './calculate-time.php';
                            if (isset($_SESSION['id'])) {
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
                                                    <a href="member/member-message.php?id=<?php echo $MESSAGE->id; ?>" class="h6 notification-friend"><?php echo $MEM1->firstName . ' ' . $MEM1->lastName . ' ' . $MESSAGE->advertisement; ?></a>
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
                    <a href="member/member-message.php" class="view-all bg-theme-blue">View All Messages</a>
                </div>
            </div>
            <div class="control-icon author-page author vcard inline-items more">
                <div class="author-thumb">
                    <a href="member/profile.php">
                        <?php
                        if (isset($_SESSION['id'])) {
                            if ($MEMBER->profilePicture) {
                                ?>
                                <span><img alt="author" src="upload/member/<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2"></span>
                                Me <svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                <?php
                            } else {
                                ?>
                                <span><img alt="author" src="upload/member/member.png" class="avatar" id="profile_pic2"></span>
                                Me <svg class="olymp-dropdown-arrow-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                <?php
                            }
                            ?>
                        </a>
                        <div class="more-dropdown more-with-triangle">
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
                            Sign In
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
        <a href="all-advertisement.php"><img src="img/icon/header-icon/advertising.png" alt="" />Advertisements</a>
        <a href="groups.php"><img src="img/icon/header-icon/group.png" alt=""  />Groups</a>
        <a href="member/"><img src="img/icon/header-icon/newsfeed.png" alt="" />Newsfeed</a>
        <a href="member/friend-requests.php"><img class="follower-request" src="img/icon/header-icon/request.png" alt=""/>Requests</a>
        <a href="member/member-message.php"><img src="img/icon/header-icon/message.png" alt=""/>Messaging</a>
        <?php
        if (isset($_SESSION['id'])) {
            ?>
            <a href="member/profile.php">
                <?php
                if ($MEMBER->profilePicture) {
                    ?>
                    <img alt="author" src="upload/member/<?php echo $MEMBER->profilePicture; ?>" class="avatar" id="profile_pic2">
                    Profile
                    <?php
                } else {
                    ?>
                    <img alt="author" src="upload/member/member.png" class="avatar" id="profile_pic2">
                    Profile
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
    </div>
</div>