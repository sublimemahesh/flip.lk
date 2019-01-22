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
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Profile || Flip.lk</title>
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
    </head>
    <body>

        <?php
        include './sidebar-left.php';
        ?>
        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <!-- Top Header-Profile -->
        <?php
        include './profile-header.php';
        ?>
        <!-- ... end Top Header-Profile -->
        <div class="container">
            <div class="row">

                <!-- Main Content -->

                <div class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                    <?php
                    if (isset($_GET['id'])) {
                        $isFriend = Friend::checkMemberAlreadyAFriend($MEMBER->id, $id);
                        if ($isFriend) {
                            ?>
                            <div class="ui-block">
                                <div class="row">
                                    <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                        <a href="#" class="btn btn-blue btn-md-2 join-group-btn" id="unfollow-friend" row-id="<?php echo $isFriend['id']; ?>" friend-id="<?php echo $id; ?>" member-id="<?php echo $MEMBER->id; ?>">Unfollow<div class="ripple-container"></div></a>
                                    </div>
                                </div>
                            </div>
                            <div class="ui-block">

                                <!-- News Feed Form  -->

                                <div class="news-feed-form">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active inline-items" data-toggle="tab" href="#home-1" role="tab" aria-expanded="true">

                                                <svg class="olymp-status-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-status-icon"></use></svg>

                                                <span>Status</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link inline-items" data-toggle="tab" href="#profile-1" role="tab" aria-expanded="false">

                                                <svg class="olymp-multimedia-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-multimedia-icon"></use></svg>

                                                <span>Multimedia</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link inline-items" data-toggle="tab" href="#blog" role="tab" aria-expanded="false">
                                                <svg class="olymp-blog-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-blog-icon"></use></svg>

                                                <span>Blog Post</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home-1" role="tabpanel" aria-expanded="true">
                                            <form>
                                                <div class="author-thumb">
                                                    <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author" class="avatar">
                                                </div>
                                                <div class="form-group with-icon label-floating is-empty">
                                                    <label class="control-label">Share what you are thinking here...</label>
                                                    <textarea class="form-control" placeholder=""></textarea>
                                                </div>
                                                <div class="add-options-message">
                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                                        <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                                    </a>
                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
                                                        <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                                    </a>

                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
                                                        <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                                    </a>

                                                    <button class="btn btn-primary btn-md-2">Post Status</button>
                                                    <button   class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

                                                </div>

                                            </form>
                                        </div>

                                        <div class="tab-pane" id="profile-1" role="tabpanel" aria-expanded="true">
                                            <form>
                                                <div class="author-thumb">
                                                    <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author" class="avatar">
                                                </div>
                                                <div class="form-group with-icon label-floating is-empty">
                                                    <label class="control-label">Share what you are thinking here...</label>
                                                    <textarea class="form-control" placeholder=""  ></textarea>
                                                </div>
                                                <div class="add-options-message">
                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                                        <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                                    </a>
                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
                                                        <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                                    </a>

                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
                                                        <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                                    </a>

                                                    <button class="btn btn-primary btn-md-2">Post Status</button>
                                                    <button   class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

                                                </div>

                                            </form>
                                        </div>

                                        <div class="tab-pane" id="blog" role="tabpanel" aria-expanded="true">
                                            <form>
                                                <div class="author-thumb">
                                                    <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author" class="avatar">
                                                </div>
                                                <div class="form-group with-icon label-floating is-empty">
                                                    <label class="control-label">Share what you are thinking here...</label>
                                                    <textarea class="form-control" placeholder=""  ></textarea>
                                                </div>
                                                <div class="add-options-message">
                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                                        <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                                    </a>
                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
                                                        <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                                    </a>

                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
                                                        <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                                    </a>

                                                    <button class="btn btn-primary btn-md-2">Post Status</button>
                                                    <button   class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- ... end News Feed Form  -->
                            </div>
                            <?php
                        } else {
                            $sendrequest = FriendRequest::checkMemberSentRequest($id, $MEMBER->id);
                            $getrequest = FriendRequest::checkMemberGotRequest($id, $MEMBER->id);

                            if ($sendrequest) {
                                ?>
                                <div class="ui-block" id="request-cancel-block">
                                    <div class="row">
                                        <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                            <a href="#" class="btn btn-smoke btn-light-bg btn-md-2 join-group-btn" id="cancel-friend-request-btn" row-id="<?php echo $sendrequest['id']; ?>">Cancel Request<div class="ripple-container"></div></a>
                                        </div>
                                        <div class="col col-lg-9 col-md-9 col-sm-8 col-8 join-group-section">
                                            <h5>Your request has been sent.</h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } elseif ($getrequest) {
                                
                                ?>
                                <div class="ui-block" id="request-cancel-block">
                                    <div class="row">
                                        <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                            <a href="#" class="btn btn-smoke btn-light-bg btn-md-2 join-group-btn" id="confirm-request" row-id="<?php echo $getrequest['id']; ?>">Confirm Request<div class="ripple-container"></div></a>
                                        </div>
                                        <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                            <a href="#" class="btn btn-smoke btn-light-bg btn-md-2 join-group-btn" id="delete-request" row-id="<?php echo $getrequest['id']; ?>">Delete Request<div class="ripple-container"></div></a>
                                        </div>

                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="ui-block" id="join-block">
                                    <div class="row">
                                        <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                            <a href="#" class="btn btn-blue btn-md-2 join-group-btn" id="follow-btn" requested-to="<?php echo $id; ?>" requested-by="<?php echo $MEMBER->id; ?>">Follow<div class="ripple-container"></div></a>
                                        </div>
                                        <div class="col col-lg-9 col-md-9 col-sm-8 col-8 join-group-section">
                                            <h5>To see what <?php
                                                if ($MEM->gender == 'male' || !($MEM->gender)) {
                                                    echo ' he ';
                                                } else {
                                                    echo ' she ';
                                                }
                                                ?>shares with friends, send <?php
                                                if ($MEM->gender == 'male' || !($MEM->gender)) {
                                                    echo ' him ';
                                                } else {
                                                    echo ' her ';
                                                }
                                                ?> a friend request.</h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    } else {
                        ?>
                        <div class="ui-block">

                            <!-- News Feed Form  -->

                            <div class="news-feed-form">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active inline-items" data-toggle="tab" href="#home-1" role="tab" aria-expanded="true">

                                            <svg class="olymp-status-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-status-icon"></use></svg>

                                            <span>Status</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link inline-items" data-toggle="tab" href="#profile-1" role="tab" aria-expanded="false">

                                            <svg class="olymp-multimedia-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-multimedia-icon"></use></svg>

                                            <span>Multimedia</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link inline-items" data-toggle="tab" href="#blog" role="tab" aria-expanded="false">
                                            <svg class="olymp-blog-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-blog-icon"></use></svg>

                                            <span>Blog Post</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home-1" role="tabpanel" aria-expanded="true">
                                        <form>
                                            <div class="author-thumb">
                                                <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author" class="avatar">
                                            </div>
                                            <div class="form-group with-icon label-floating is-empty">
                                                <label class="control-label">Share what you are thinking here...</label>
                                                <textarea class="form-control" placeholder=""></textarea>
                                            </div>
                                            <div class="add-options-message">
                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                                    <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                                </a>
                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
                                                    <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                                </a>

                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
                                                    <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                                </a>

                                                <button class="btn btn-primary btn-md-2">Post Status</button>
                                                <button   class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

                                            </div>

                                        </form>
                                    </div>

                                    <div class="tab-pane" id="profile-1" role="tabpanel" aria-expanded="true">
                                        <form>
                                            <div class="author-thumb">
                                                <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author" class="avatar">
                                            </div>
                                            <div class="form-group with-icon label-floating is-empty">
                                                <label class="control-label">Share what you are thinking here...</label>
                                                <textarea class="form-control" placeholder=""  ></textarea>
                                            </div>
                                            <div class="add-options-message">
                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                                    <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                                </a>
                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
                                                    <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                                </a>

                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
                                                    <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                                </a>

                                                <button class="btn btn-primary btn-md-2">Post Status</button>
                                                <button   class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

                                            </div>

                                        </form>
                                    </div>

                                    <div class="tab-pane" id="blog" role="tabpanel" aria-expanded="true">
                                        <form>
                                            <div class="author-thumb">
                                                <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author" class="avatar">
                                            </div>
                                            <div class="form-group with-icon label-floating is-empty">
                                                <label class="control-label">Share what you are thinking here...</label>
                                                <textarea class="form-control" placeholder=""  ></textarea>
                                            </div>
                                            <div class="add-options-message">
                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                                    <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                                </a>
                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
                                                    <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                                </a>

                                                <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
                                                    <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                                </a>

                                                <button class="btn btn-primary btn-md-2">Post Status</button>
                                                <button   class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- ... end News Feed Form  -->
                        </div>
                        <?php
                    }
                    ?>
                    <div id="newsfeed-items-grid">

                        <div class="ui-block">
                            <!-- Post -->

                            <article class="hentry post">

                                <div class="post__author author vcard inline-items">
                                    <img src="img/author-page.jpg" alt="author">

                                    <div class="author-date">
                                        <a class="h6 post__author-name fn" href="02-ProfilePage.html">James Spiegel</a>
                                        <div class="post__date">
                                            <time class="published" datetime="2017-03-24T18:18">
                                                19 hours ago
                                            </time>
                                        </div>
                                    </div>

                                    <div class="more">
                                        <svg class="olymp-three-dots-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                        </svg>
                                        <ul class="more-dropdown">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                    mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                    accusantium doloremque.
                                </p>

                                <div class="post-additional-info inline-items">

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                        </svg>
                                        <span>8</span>
                                    </a>

                                    <ul class="friends-harmonic">
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic7.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic8.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic9.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic10.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic11.jpg" alt="friend">
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="names-people-likes">
                                        <a href="#">Jenny</a>, <a href="#">Robert</a> and
                                        <br>6 more liked this
                                    </div>


                                    <div class="comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-speech-balloon-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                            </svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-share-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                    </div>


                                </div>

                                <div class="control-block-button post-control-button">

                                    <a href="#" class="btn btn-control featured-post">
                                        <svg class="olymp-trophy-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-trophy-icon"></use>
                                        </svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-like-post-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use>
                                        </svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-comments-post-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use>
                                        </svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-share-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                        </svg>
                                    </a>

                                </div>

                            </article>

                            <!-- .. end Post -->				</div>
                        <div class="ui-block">

                            <!-- Post -->

                            <article class="hentry post video">

                                <div class="post__author author vcard inline-items">
                                    <img src="img/author-page.jpg" alt="author">

                                    <div class="author-date">
                                        <a class="h6 post__author-name fn" href="02-ProfilePage.html">James Spiegel</a> shared a
                                        <a href="#">link</a>
                                        <div class="post__date">
                                            <time class="published" datetime="2017-03-24T18:18">
                                                7 hours ago
                                            </time>
                                        </div>
                                    </div>

                                    <div class="more">
                                        <svg class="olymp-three-dots-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                        </svg>
                                        <ul class="more-dropdown">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <p>If someone missed it, check out the new song by System of a Revenge! I thinks they are going back to their roots...</p>

                                <div class="post-video">
                                    <div class="video-thumb">
                                        <img src="img/video5.jpg" alt="photo">
                                        <a href="https://youtube.com/watch?v=excVFQ2TWig" class="play-video">
                                            <svg class="olymp-play-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-play-icon"></use>
                                            </svg>
                                        </a>
                                    </div>

                                    <div class="video-content">
                                        <a href="#" class="h4 title">System of a Revenge - Nothing Else Matters (LIVE)</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur ipisicing elit, sed do eiusmod tempo incididunt ut labore..</p>
                                        <a href="#" class="link-site">YOUTUBE.COM</a>
                                    </div>
                                </div>

                                <div class="post-additional-info inline-items">

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                        </svg>
                                        <span>15</span>
                                    </a>

                                    <ul class="friends-harmonic">
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic9.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic10.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic7.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic8.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic11.jpg" alt="friend">
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="names-people-likes">
                                        <a href="#">Jenny</a>, <a href="#">Robert</a> and
                                        <br>13 more liked this
                                    </div>

                                    <div class="comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-speech-balloon-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                            </svg>
                                            <span>1</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-share-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                            </svg>
                                            <span>16</span>
                                        </a>
                                    </div>


                                </div>

                                <div class="control-block-button post-control-button">

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-like-post-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use>
                                        </svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-comments-post-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use>
                                        </svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-share-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                        </svg>
                                    </a>

                                </div>

                            </article>

                            <!-- .. end Post -->				</div>
                        <div class="ui-block">
                            <!-- Post -->

                            <article class="hentry post">

                                <div class="post__author author vcard inline-items">
                                    <img src="img/author-page.jpg" alt="author">

                                    <div class="author-date">
                                        <a class="h6 post__author-name fn" href="02-ProfilePage.html">James Spiegel</a>
                                        <div class="post__date">
                                            <time class="published" datetime="2017-03-24T18:18">
                                                2 hours ago
                                            </time>
                                        </div>
                                    </div>

                                    <div class="more">
                                        <svg class="olymp-three-dots-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                        </svg>
                                        <ul class="more-dropdown">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris consequat.
                                </p>

                                <div class="post-additional-info inline-items">

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                        </svg>
                                        <span>36</span>
                                    </a>

                                    <ul class="friends-harmonic">
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic7.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic8.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic9.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic10.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic11.jpg" alt="friend">
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="names-people-likes">
                                        <a href="#">You</a>, <a href="#">Elaine</a> and
                                        <br>34 more liked this
                                    </div>


                                    <div class="comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-speech-balloon-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                            </svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-share-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                            </svg>
                                            <span>24</span>
                                        </a>
                                    </div>


                                </div>

                                <div class="control-block-button post-control-button">

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-like-post-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use>
                                        </svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-comments-post-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use>
                                        </svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-share-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                        </svg>
                                    </a>

                                </div>

                            </article>

                            <!-- .. end Post -->					
                            <!-- Comments -->

                            <ul class="comments-list">
                                <li class="comment-item">
                                    <div class="post__author author vcard inline-items">
                                        <img src="img/avatar10-sm.jpg" alt="author">

                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="#">Elaine Dreyfuss</a>
                                            <div class="post__date">
                                                <time class="published" datetime="2017-03-24T18:18">
                                                    5 mins ago
                                                </time>
                                            </div>
                                        </div>

                                        <a href="#" class="more">
                                            <svg class="olymp-three-dots-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                            </svg>
                                        </a>

                                    </div>

                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium der doloremque laudantium.</p>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                        </svg>
                                        <span>8</span>
                                    </a>
                                    <a href="#" class="reply">Reply</a>
                                </li>
                                <li class="comment-item has-children">
                                    <div class="post__author author vcard inline-items">
                                        <img src="img/avatar5-sm.jpg" alt="author">

                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="#">Green Goo Rock</a>
                                            <div class="post__date">
                                                <time class="published" datetime="2017-03-24T18:18">
                                                    1 hour ago
                                                </time>
                                            </div>
                                        </div>

                                        <a href="#" class="more">
                                            <svg class="olymp-three-dots-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                            </svg>
                                        </a>

                                    </div>

                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugiten, sed quia
                                        consequuntur magni dolores eos qui ratione voluptatem sequi en lod nesciunt. Neque porro
                                        quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur adipisci velit en lorem ipsum der.
                                    </p>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                        </svg>
                                        <span>5</span>
                                    </a>
                                    <a href="#" class="reply">Reply</a>

                                    <ul class="children">
                                        <li class="comment-item">
                                            <div class="post__author author vcard inline-items">
                                                <img src="img/avatar8-sm.jpg" alt="author">

                                                <div class="author-date">
                                                    <a class="h6 post__author-name fn" href="#">Diana Jameson</a>
                                                    <div class="post__date">
                                                        <time class="published" datetime="2017-03-24T18:18">
                                                            39 mins ago
                                                        </time>
                                                    </div>
                                                </div>

                                                <a href="#" class="more">
                                                    <svg class="olymp-three-dots-icon">
                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                                    </svg>
                                                </a>

                                            </div>

                                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

                                            <a href="#" class="post-add-icon inline-items">
                                                <svg class="olymp-heart-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                                </svg>
                                                <span>2</span>
                                            </a>
                                            <a href="#" class="reply">Reply</a>
                                        </li>
                                        <li class="comment-item">
                                            <div class="post__author author vcard inline-items">
                                                <img src="img/avatar2-sm.jpg" alt="author">

                                                <div class="author-date">
                                                    <a class="h6 post__author-name fn" href="#">Nicholas Grisom</a>
                                                    <div class="post__date">
                                                        <time class="published" datetime="2017-03-24T18:18">
                                                            24 mins ago
                                                        </time>
                                                    </div>
                                                </div>

                                                <a href="#" class="more">
                                                    <svg class="olymp-three-dots-icon">
                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                                    </svg>
                                                </a>

                                            </div>

                                            <p>Excepteur sint occaecat cupidatat non proident.</p>

                                            <a href="#" class="post-add-icon inline-items">
                                                <svg class="olymp-heart-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                                </svg>
                                                <span>0</span>
                                            </a>
                                            <a href="#" class="reply">Reply</a>

                                        </li>
                                    </ul>

                                </li>

                                <li class="comment-item">
                                    <div class="post__author author vcard inline-items">
                                        <img src="img/avatar4-sm.jpg" alt="author">

                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="#">Chris Greyson</a>
                                            <div class="post__date">
                                                <time class="published" datetime="2017-03-24T18:18">
                                                    1 hour ago
                                                </time>
                                            </div>
                                        </div>

                                        <a href="#" class="more">
                                            <svg class="olymp-three-dots-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                            </svg>
                                        </a>

                                    </div>

                                    <p>Dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                        </svg>
                                        <span>7</span>
                                    </a>
                                    <a href="#" class="reply">Reply</a>

                                </li>
                            </ul>

                            <!-- ... end Comments -->
                            <a href="#" class="more-comments">View more comments <span>+</span></a>

                            <!-- Comment Form  -->

                            <form class="comment-form inline-items">

                                <div class="post__author author vcard inline-items">
                                    <img src="img/author-page.jpg" alt="author">

                                    <div class="form-group with-icon-right ">
                                        <textarea class="form-control" placeholder=""></textarea>
                                        <div class="add-options-message">
                                            <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
                                                <svg class="olymp-camera-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-md-2 btn-primary">Post Comment</button>

                                <button class="btn btn-md-2 btn-border-think c-grey btn-transparent custom-color">Cancel</button>

                            </form>

                            <!-- ... end Comment Form  -->				</div>
                        <div class="ui-block">
                            <!-- Post -->

                            <article class="hentry post has-post-thumbnail shared-photo">

                                <div class="post__author author vcard inline-items">
                                    <img src="img/author-page.jpg" alt="author">

                                    <div class="author-date">
                                        <a class="h6 post__author-name fn" href="02-ProfilePage.html">James Spiegel</a> shared
                                        <a href="#">Diana Jameson</a>’s <a href="#">photo</a>
                                        <div class="post__date">
                                            <time class="published" datetime="2017-03-24T18:18">
                                                7 hours ago
                                            </time>
                                        </div>
                                    </div>

                                    <div class="more">
                                        <svg class="olymp-three-dots-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                        </svg>
                                        <ul class="more-dropdown">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <p>Hi! Everyone should check out these amazing photographs that my friend shot the past week. Here’s one of them...leave a kind comment!</p>

                                <div class="post-thumb">
                                    <img src="img/post-photo6.jpg" alt="photo">
                                </div>

                                <ul class="children single-children">
                                    <li class="comment-item">
                                        <div class="post__author author vcard inline-items">
                                            <img src="img/avatar8-sm.jpg" alt="author">
                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="#">Diana Jameson</a>
                                                <div class="post__date">
                                                    <time class="published" datetime="2017-03-24T18:18">
                                                        16 hours ago
                                                    </time>
                                                </div>
                                            </div>
                                        </div>

                                        <p>Here’s the first photo of our incredible photoshoot from yesterday. If you like it please say so and tel me what you wanna see next!</p>
                                    </li>
                                </ul>

                                <div class="post-additional-info inline-items">

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                        </svg>
                                        <span>15</span>
                                    </a>

                                    <ul class="friends-harmonic">
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic5.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic10.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic7.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic8.jpg" alt="friend">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="img/friend-harmonic2.jpg" alt="friend">
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="names-people-likes">
                                        <a href="#">Diana</a>, <a href="#">Nicholas</a> and
                                        <br>13 more liked this
                                    </div>

                                    <div class="comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-speech-balloon-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                            </svg>
                                            <span>0</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-share-icon">
                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                            </svg>
                                            <span>16</span>
                                        </a>
                                    </div>

                                </div>

                                <div class="control-block-button post-control-button">

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-like-post-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use>
                                        </svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-comments-post-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use>
                                        </svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-share-icon">
                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                        </svg>
                                    </a>

                                </div>

                            </article>

                            <!-- .. end Post -->				</div>
                    </div>

                    <a id="load-more-button" href="#" class="btn btn-control btn-more" data-load-link="items-to-load.html" data-container="newsfeed-items-grid">
                        <svg class="olymp-three-dots-icon">
                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                        </svg>
                    </a>
                </div>

                <!-- ... end Main Content -->


                <!-- Left Sidebar -->

                <div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">

                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Profile Intro</h6>
                        </div>
                        <div class="ui-block-content">

                            <!-- W-Personal-Info -->

                            <ul class="widget w-personal-info item-block">
                                <li>
                                    <span class="title">About Me:</span>
                                    <span class="text"><?php echo $MEM->aboutMe; ?></span>
                                </li>
                            </ul>

                            <!-- .. end W-Personal-Info -->
                        </div>
                    </div>

                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Friends (86)</h6>
                        </div>
                        <div class="ui-block-content">

                            <!-- W-Faved-Page -->

                            <ul class="widget w-faved-page js-zoom-gallery">
                                <li>
                                    <a href="#">
                                        <img src="img/avatar38-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar24-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar36-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar35-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar34-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar33-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar32-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar31-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar30-sm.jpg" alt="author">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar29-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar28-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar27-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar26-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/avatar25-sm.jpg" alt="user">
                                    </a>
                                </li>
                                <li class="all-users">
                                    <a href="#">+74</a>
                                </li>
                            </ul>

                            <!-- .. end W-Faved-Page -->
                        </div>
                    </div>

                </div>

                <!-- ... end Left Sidebar -->


                <!-- Right Sidebar -->

                <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">

                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Last Photos</h6>
                        </div>
                        <div class="ui-block-content">

                            <!-- W-Latest-Photo -->

                            <ul class="widget w-last-photo js-zoom-gallery">
                                <li>
                                    <a href="img/last-photo10-large.jpg">
                                        <img src="img/last-photo10-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot11-large.jpg">
                                        <img src="img/last-phot11-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot12-large.jpg">
                                        <img src="img/last-phot12-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot13-large.jpg">
                                        <img src="img/last-phot13-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot14-large.jpg">
                                        <img src="img/last-phot14-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot15-large.jpg">
                                        <img src="img/last-phot15-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot16-large.jpg">
                                        <img src="img/last-phot16-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot17-large.jpg">
                                        <img src="img/last-phot17-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-phot18-large.jpg">
                                        <img src="img/last-phot18-large.jpg" alt="photo">
                                    </a>
                                </li>
                            </ul>


                            <!-- .. end W-Latest-Photo -->
                        </div>
                    </div>



                </div>

                <!-- ... end Right Sidebar -->

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
        <script src="js/sticky-sidebar.js"></script>
        <script src="js/base-init.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/friend-request.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    </body>
</html>