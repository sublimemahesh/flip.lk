<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$GROUP = new Group($id);
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Group || Flip.lk</title>
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
                <div class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-sm-12 col-12">
                    <?php
                    if (GroupMember::checkMemberAlreadyExistInTheGroup($MEMBER->id, $id)) {
                        ?>
                        <div class="ui-block">
                            <div class="row">
                                <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                    <a href="#" class="btn btn-blue btn-md-2 join-group-btn" id="leave-group" group-id="<?php echo $id; ?>" member-id="<?php echo $MEMBER->id; ?>">Leave Group<div class="ripple-container"></div></a>
                                </div>
                                <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                    <a href="#" class="btn btn-blue btn-md-2 join-group-btn" id="" group-id="<?php echo $id; ?>" member-id="<?php echo $MEMBER->id; ?>">Add Members<div class="ripple-container"></div></a>
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
                        $request = GroupAndMemberRequest::getIdByGroupAndMember($id, $MEMBER->id);
                        if ($request) {
                            $join = 'false';
                            $rowid = $request['id'];
                        } else {
                            $join = 'true';
                        }
                        ?>
                        <div class="ui-block <?php if ($join == 'false') {
                            echo 'hidden';
                        } ?>" id="join-block">
                            <div class="row">
                                <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                    <a href="#" class="btn btn-blue btn-md-2 join-group-btn" id="join-group-btn" group-id="<?php echo $id; ?>" member-id="<?php echo $MEMBER->id; ?>">Join Group<div class="ripple-container"></div></a>
                                </div>
                                <div class="col col-lg-9 col-md-9 col-sm-8 col-8 join-group-section">
                                    <h5>Join this group to post and comment.</h5>
                                </div>
                            </div>
                        </div>
                        <div class="ui-block <?php if ($join == 'true') {
                            echo 'hidden';
                        } ?>" id="request-cancel-block">
                            <div class="row">
                                <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                    <a href="#" class="btn btn-smoke btn-light-bg btn-md-2 join-group-btn" id="cancel-request-btn" row-id="<?php echo $rowid; ?>">Cancel Request<div class="ripple-container"></div></a>
                                </div>
                                <div class="col col-lg-9 col-md-9 col-sm-8 col-8 join-group-section">
                                    <h5>Your request has been sent to the approval.</h5>
                                </div>
                            </div>
                        </div>
    <?php
}
?>

                    <div id="newsfeed-items-grid">
                        <div class="ui-block">


                            <!-- Post -->
                            <article class="hentry post">
                                <div class="post__author author vcard inline-items">
                                    <img src="img/avatar5-sm.jpg" alt="author">

                                    <div class="author-date">
                                        <a class="h6 post__author-name fn" href="#">Green Goo Rock</a>
                                        <div class="post__date">
                                            <time class="published" datetime="2017-03-24T18:18">
                                                4 hours ago
                                            </time>
                                        </div>
                                    </div>

                                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
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

                                <p>Hi guys! We just wanted to let everyone know that we are currently recording
                                    our new album “News of the Goo”. We’ll be playing one of our new songs this Friday at 8pm in
                                    our Fake Street 320 recording studio, come and join us!
                                </p>

                                <div class="post-additional-info inline-items">

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
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
                                            <svg class="olymp-speech-balloon-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                            <span>17</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                            <span>24</span>
                                        </a>
                                    </div>


                                </div>

                                <div class="control-block-button post-control-button">

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-like-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use></svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-comments-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                    </a>

                                </div>

                            </article>

                            <!-- ... end Post -->


                            <!-- Comments -->

                            <ul class="comments-list">
                                <li class="comment-item">
                                    <div class="post__author author vcard inline-items">
                                        <img src="img/avatar2-sm.jpg" alt="author">

                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="#">Nicholas Grissom</a>
                                            <div class="post__date">
                                                <time class="published" datetime="2017-03-24T18:18">
                                                    28 mins ago
                                                </time>
                                            </div>
                                        </div>

                                        <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>

                                    </div>

                                    <p>Dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                        <span>6</span>
                                    </a>
                                    <a href="#" class="reply">Reply</a>
                                </li>
                                <li class="comment-item">
                                    <div class="post__author author vcard inline-items">
                                        <img src="img/avatar19-sm.jpg" alt="author">

                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="#">Jimmy Elricson</a>
                                            <div class="post__date">
                                                <time class="published" datetime="2017-03-24T18:18">
                                                    2 hours ago
                                                </time>
                                            </div>
                                        </div>

                                        <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>

                                    </div>

                                    <p>Ratione voluptatem sequi en lod nesciunt. Neque porro quisquam est, quinder dolorem ipsum
                                        quia dolor sit amet, consectetur adipisci velit en lorem ipsum duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
                                    </p>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                        <span>8</span>
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

                            <!-- ... end Comment Form  -->
                        </div>

                        <div class="ui-block">


                            <!-- Post -->

                            <article class="hentry post has-post-thumbnail">

                                <div class="post__author author vcard inline-items">
                                    <img src="img/avatar5-sm.jpg" alt="author">

                                    <div class="author-date">
                                        <a class="h6 post__author-name fn" href="#">Green Goo Rock</a>
                                        <div class="post__date">
                                            <time class="published" datetime="2017-03-24T18:18">
                                                March 8 at 6:42pm
                                            </time>
                                        </div>
                                    </div>

                                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
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

                                <p>Hey guys! We are gona be playing this Saturday of <a href="#">The Marina Bar</a> for their new Mystic Deer Party.
                                    If you wanna hang out and have a really good time, come and join us. We’l be waiting for you!
                                </p>

                                <div class="post-thumb">
                                    <img src="img/post__thumb1.jpg" alt="photo">
                                </div>

                                <div class="post-additional-info inline-items">

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                        <span>49</span>
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
                                        <a href="#">Jimmy</a>, <a href="#">Andrea</a> and
                                        <br>47 more liked this
                                    </div>


                                    <div class="comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-speech-balloon-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                            <span>264</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                            <span>37</span>
                                        </a>
                                    </div>


                                </div>

                                <div class="control-block-button post-control-button">

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-like-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use></svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-comments-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                    </a>

                                </div>

                            </article>

                            <!-- ... end Post -->
                        </div>

                        <div class="ui-block">

                            <!-- Post -->

                            <article class="hentry post video">

                                <div class="post__author author vcard inline-items">
                                    <img src="img/avatar5-sm.jpg" alt="author">

                                    <div class="author-date">
                                        <a class="h6 post__author-name fn" href="#">Gren Goo Rock</a> shared a <a href="#">link</a>
                                        <div class="post__date">
                                            <time class="published" datetime="2017-03-24T18:18">
                                                March 4 at 2:05pm
                                            </time>
                                        </div>
                                    </div>

                                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
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

                                <p>Hey <a href="#">Cindi</a>, you should really check out this new song by Iron Maid. The next time they come to the city we should totally go!</p>

                                <div class="post-video">
                                    <div class="video-thumb">
                                        <img src="img/video-youtube.jpg" alt="photo">
                                        <a href="https://youtube.com/watch?v=excVFQ2TWig" class="play-video">
                                            <svg class="olymp-play-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-play-icon"></use></svg>
                                        </a>
                                    </div>

                                    <div class="video-content">
                                        <a href="#" class="h4 title">Killer Queen - Archiduke</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur ipisicing elit, sed do eiusmod tempor incididunt
                                            ut labore et dolore magna aliqua...
                                        </p>
                                        <a href="#" class="link-site">YOUTUBE.COM</a>
                                    </div>
                                </div>

                                <div class="post-additional-info inline-items">

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                        <span>18</span>
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
                                        <br>18 more liked this
                                    </div>

                                    <div class="comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-speech-balloon-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                            <span>0</span>
                                        </a>

                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                            <span>16</span>
                                        </a>
                                    </div>


                                </div>

                                <div class="control-block-button post-control-button">

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-like-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use></svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-comments-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                                    </a>

                                    <a href="#" class="btn btn-control">
                                        <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                    </a>

                                </div>

                            </article>

                            <!-- ... end Post -->				</div>
                    </div>
                    <a id="load-more-button" href="#" class="btn btn-control btn-more" data-load-link="items-to-load.html" data-container="newsfeed-items-grid"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>

                </div>

<?php
include './group-about-nav.php';
?>

                <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Last Photos</h6>
                            <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                        </div>
                        <div class="ui-block-content">

                            <!-- W-Latest-Photo -->

                            <ul class="widget w-last-photo js-zoom-gallery">
                                <li>
                                    <a href="img/last-photo1-large.jpg">
                                        <img src="img/last-photo1-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-photo2-large.jpg">
                                        <img src="img/last-photo2-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-photo3-large.jpg">
                                        <img src="img/last-photo3-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-photo4-large.jpg">
                                        <img src="img/last-photo4-large.jpg" alt="photo">
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
                                    <a href="img/last-photo7-large.jpg">
                                        <img src="img/last-photo7-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-photo8-large.jpg">
                                        <img src="img/last-photo8-large.jpg" alt="photo">
                                    </a>
                                </li>
                                <li>
                                    <a href="img/last-photo9-large.jpg">
                                        <img src="img/last-photo9-large.jpg" alt="photo">
                                    </a>
                                </li>
                            </ul>

                            <!-- ... end W-Latest-Photo -->				
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="map"></div>
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
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script>
            // Retrieve Details from Place_ID
            function initMap() {
                setTimeout(function () {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: -33.866, lng: 151.196},
                        zoom: 15
                    });

                    var infowindow = new google.maps.InfoWindow();
                    var service = new google.maps.places.PlacesService(map);
                    var place_id = $('#autocomplete').val();
//                    var place_id2 = $('#autocomplete2').val();

                    service.getDetails({
                        placeId: place_id
                    }, function (place, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
//                        alert(place.name);
                            $('#city').append(place.name);

                        }
                    });

                }, 1000);
            }

            $(document).ready(function () {
                initMap();
            });


        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2FmnO6PPzu9Udebcq9q_yUuQ_EGItjak&libraries=places&callback=initAutocomplete"
        async defer></script>
    </body>
</html>