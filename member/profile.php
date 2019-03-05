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
$propic = $MEMBER->profilePicture;
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
        <link href="css/images-grid.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <style>
            .comment-item1 {
                display: none;
            }
            .comment-reply-item {
                display: none;
            }
        </style>
    </head>
    <body>
        <?php
        include './header.php';
        ?>
        <div class="header-spacer"></div>
        <!-- Top Header-Profile -->
        <div class="col col-xl-10 order-xl-1 col-lg-9 order-lg-1 col-md-9 col-sm-12 col-12">
            <?php
            include './profile-header.php';
            ?>
            <!-- ... end Top Header-Profile -->

            <div class="container">
                <div class="row">

                    <!-- Main Content -->

                    <div class="col col-xl-8 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                        <input type="hidden" id="member" value="<?php echo $MEM->id ?>" />
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
                                                        <input type="submit" name="save-post" class="btn btn-primary btn-md-2 share-post" value="Share" />

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
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home-1" role="tabpanel" aria-expanded="true">
                                            <form action="post-and-get/post.php" method="post" id="post-form">
                                                <div class="author-thumb">
                                                    <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author" class="avatar">
                                                </div>
                                                <div class="form-group with-icon label-floating is-empty">
                                                    <label class="control-label">Share what you are thinking here...</label>
                                                    <textarea class="form-control" placeholder="" name="description"></textarea>
                                                    <div class="flipScrollableArea hidden" id="image-list" style="/*! height: 112px; */ /*! width: 100%; */">
                                                        <div class="flipScrollableAreaWrap">
                                                            <div class="flipScrollableAreaBody" style="height: 112px;">
                                                                <div class="flipScrollableAreaContent">
                                                                    <div class="flipScrollableAreaContent1">
                                                                    </div>
                                                                    <span class="_uploadouterbox">
                                                                        <div class="_m _6a">
                                                                            <a class="_uploadbox" rel="ignore">
                                                                                <div class="_upload">
                                                                                    <input multiple="" name="upload-other-images" title="Choose a file to upload" data-testid="add-more-photos" display="inline-block" type="file" class="_uploadinput _outlinenone" id="add-more-photos">
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </span>
                                                                    <span class="_uploadloaderbox abc">
                                                                        <div class="_m _6a">
                                                                            <a class="_uploadbox" rel="ignore">
                                                                                <div class="_upload">

                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flipScrollableAreaTrack invisible_elem" style="opacity: 0;">
                                                            <div class="flipScrollableAreaGripper hidden_elem"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="add-options-message">

                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD PHOTOS">
                                                        <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                                        <div class="_upload">
                                                            <input  name="post-image" display="inline" role="button" tabindex="0" data-testid="media-tab" type="file" class="_uploadinput _outlinenone" id="upload_first_image">
                                                            <input type="hidden" id="upload-post-image" name="upload-post-image" >
                                                        </div>

                                                    </a>
                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="TAG YOUR FRIENDS">
                                                        <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                                    </a>

                                                    <a href="#" class="options-message" data-toggle="tooltip" data-placement="top"   data-original-title="ADD LOCATION">
                                                        <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                                    </a>
                                                    <input type="hidden" value ="<?php echo $_SESSION['id']; ?>" id="member" name="member" />
                                                    <input type="submit" name="save-post" class="btn btn-primary btn-md-2 share-post" value="Share" />
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

                            <?php
                            include './calculate-time.php';
                            $posts = Post::getPostsByMember($MEM->id);
                            if (count($posts) > 0) {
                                foreach ($posts as $key => $post) {
                                    $photos = PostImage::getPhotosByPostId($post['id']);
                                    $result = getTime($post['created_at']);
                                    $count = PostComment::getCountOfCommentsByPostID($post['id']);
                                    ?>

                                    <div class="ui-block">
                                        <!-- Post -->

                                        <article class="hentry post has-post-thumbnail shared-photo post_<?php echo $post['id']; ?>" id="post-id" post-id="<?php echo $post['id']; ?>">

                                            <div class="post__author author vcard inline-items">
                                                <img src="../upload/member/<?php echo $MEM->profilePicture; ?>" alt="author">

                                                <div class="author-date">
                                                    <?php
                                                    if ($post['shared_ad'] != 0) {
                                                        ?>
                                                        <a class="h6 post__author-name fn" href="profile.php?id=<?php echo $MEM->id; ?>"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a> shared a post
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a class="h6 post__author-name fn" href="profile.php?id=<?php echo $MEM->id; ?>"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a> 
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="post__date">
                                                        <time class="published">
                                                            <?php echo $result; ?>
                                                        </time>
                                                    </div>
                                                </div>
                                                <?php
                                                if (!isset($_GET['id'])) {
                                                    ?>
                                                    <div class="more">
                                                        <svg class="olymp-three-dots-icon">
                                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                                        </svg>
                                                        <ul class="more-dropdown">
                                                            <li>
                                                                <a href="#" data-toggle="modal" data-target="#edit-post" class="edit-post" id="<?php echo $post['id']; ?>">Edit Post</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="delete-post" id="<?php echo $post['id']; ?>">Delete Post</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                            <span class="more">
                                                <p><?php echo $post['description']; ?></p>
                                            </span>
                                            <div class="post-thumb">
                                                <div id="gallery-<?php echo $post['id']; ?>"></div>
                                            </div>
                                            <div class=" content">

                                            </div>
                                            <?php
                                            if ($post['shared_ad'] != 0) {
                                                $AD = new Advertisement($post['shared_ad']);
                                                $MEM2 = new Member($AD->member);
                                                $GROUP = new Group($AD->groupId);
                                                $result1 = getTime($AD->createdAt);
                                                ?>
                                                <ul class="children single-children">
                                                    <li class="comment-item">
                                                        <div class="post__author author vcard inline-items">
                                                            <img src="../upload/member/<?php echo $MEM2->profilePicture; ?>" alt="author">
                                                            <div class="author-date">
                                                                <a class="h6 post__author-name fn" href="#"><?php echo $MEM2->firstName . ' ' . $MEM2->lastName; ?></a> <i class="fa fa-caret-right"></i> <a class="h6 post__author-name fn" href="group.php?id=<?php echo $GROUP->id; ?>"><?php echo $GROUP->name; ?></a>
                                                                <div class="post__date">
                                                                    <time class="published" datetime="2017-03-24T18:18">
                                                                        <?php echo $result1; ?>
                                                                    </time>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5><b><?php echo $AD->title; ?></b></h5>
                                                        <span class="more">
                                                            <p><?php echo $AD->description; ?></p>
                                                        </span>
                                                    </li>
                                                </ul>
                                                <?php
                                            }
                                            ?>


                                            <div class="post-additional-info inline-items">
                                                <div class="comments-shared">
                                                    <a class="post-add-icon inline-items add-comment" id="<?php echo $post['id']; ?>">
                                                        <svg class="olymp-speech-balloon-icon">
                                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                                        </svg>
                                                        <span><?php echo $count['count'] ?></span>
                                                    </a>
                                                </div>

                                            </div>
                                        </article>

                                        <?php
                                        $comments = PostComment::getCommentsByPostID($post['id']);
                                        if (count($comments) > 0) {
                                            ?>
                                            <ul class="comments-list hidden" id="comment-list-<?php echo $post['id']; ?>" post-id="<?php echo $post['id']; ?>">
                                                <a href="#" class="see-more hidden" id="see-more-<?php echo $post['id']; ?>">Show all comments</a>
                                                <?php
                                                foreach ($comments as $key => $comment) {
                                                    $COMMENTMEMBER = New Member($comment['member']);
                                                    $commentedat = getTime($comment['commented_at']);
                                                    $replies = PostCommentReply::getRepliesByCommentID($comment['id']);
                                                    if (count($replies) < 0) {
                                                        ?>
                                                        <li class="comment-item comment-item1" id="li_<?php echo $comment['id']; ?>">
                                                            <div class="post__author author vcard inline-items">
                                                                <img src="../upload/member/<?php echo $COMMENTMEMBER->profilePicture; ?>" alt="author">

                                                                <div class="author-date">
                                                                    <a class="h6 post__author-name fn" href="profile.php?id=<?php echo $COMMENTMEMBER->id; ?>"><?php echo $COMMENTMEMBER->firstName . ' ' . $COMMENTMEMBER->lastName; ?></a>
                                                                    <div class="post__date">
                                                                        <time class="published" datetime="2017-03-24T18:18">
                                                                            <?php echo $commentedat; ?>
                                                                        </time>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                if ($comment['member'] == $MEMBER->id) {
                                                                    ?>
                                                                    <div class="more">
                                                                        <svg class="olymp-three-dots-icon">
                                                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                                                        </svg>
                                                                        <ul class="more-dropdown">
                                                                            <li>
                                                                                <a class="edit-comment" id="<?php echo $comment['id']; ?>">Edit Comment</a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="delete-post" id="<?php echo $comment['id']; ?>">Delete Comment</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </div>

                                                            <p class="comment-p" id="comment-p-<?php echo $comment['id']; ?>"><?php echo $comment['comment']; ?></p>
                                                            <div class="comment-edit-form inline-items hidden" id="comment-edit-form-<?php echo $comment['id']; ?>">
                                                                <div class="post__author author vcard inline-items">
                                                                    <div class="form-group with-icon-right is-empty">
                                                                        <textarea class="form-control" placeholder="" name="reply" id="comment-<?php echo $comment['id']; ?>"></textarea>
                                                                        <span class="material-input"></span></div>
                                                                </div>
                                                                <button id="post-edited-comment" class="btn btn-md-2 btn-primary post-edited-comment" comment="<?php echo $comment['id']; ?>" member="<?php echo $MEMBER->id; ?>">Save</button>
                                                                <button id="post-edited-cancel" class="btn btn-md-2 btn-default post-edited-cancel" comment="<?php echo $comment['id']; ?>" member="<?php echo $MEMBER->id; ?>">Cancel</button>
                                                            </div>

                                                            <a class="reply add-reply" id="<?php echo $comment['id']; ?>">Reply</a>

                                                            <div class="reply-form inline-items hidden" id="reply-form-<?php echo $comment['id']; ?>">
                                                                <div class="post__author author vcard inline-items">
                                                                    <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author">
                                                                    <div class="form-group with-icon-right is-empty">
                                                                        <textarea class="form-control" placeholder="" name="reply" id="reply-<?php echo $comment['id']; ?>"></textarea>
                                                                        <span class="material-input"></span></div>
                                                                </div>
                                                                <button id="post-reply" class="btn btn-md-2 btn-primary post-reply" comment="<?php echo $comment['id']; ?>" member="<?php echo $MEMBER->id; ?>">Post Reply</button>
                                                            </div>


                                                        </li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li class="comment-item comment-item1 has-children" id="li_<?php echo $comment['id']; ?>">
                                                            <div class="post__author author vcard inline-items">
                                                                <img src="../upload/member/<?php echo $COMMENTMEMBER->profilePicture; ?>" alt="author">

                                                                <div class="author-date">
                                                                    <a class="h6 post__author-name fn" href="profile.php?id=<?php echo $COMMENTMEMBER->id; ?>"><?php echo $COMMENTMEMBER->firstName . ' ' . $COMMENTMEMBER->lastName; ?></a>
                                                                    <div class="post__date">
                                                                        <time class="published" datetime="2017-03-24T18:18">
                                                                            <?php echo $commentedat; ?>
                                                                        </time>
                                                                    </div>
                                                                </div>

                                                                <?php
                                                                if ($comment['member'] == $MEMBER->id) {
                                                                    ?>
                                                                    <div class="more">
                                                                        <svg class="olymp-three-dots-icon">
                                                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                                                        </svg>
                                                                        <ul class="more-dropdown">
                                                                            <li>
                                                                                <a class="edit-comment" id="<?php echo $comment['id']; ?>">Edit Comment</a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="delete-post" id="<?php echo $comment['id']; ?>">Delete Comment</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </div>

                                                            <p class="comment-p" id="comment-p-<?php echo $comment['id']; ?>"><?php echo $comment['comment']; ?></p>
                                                            <div class="comment-edit-form inline-items hidden" id="comment-edit-form-<?php echo $comment['id']; ?>">
                                                                <div class="post__author author vcard inline-items">
                                                                    <div class="form-group with-icon-right is-empty">
                                                                        <textarea class="form-control" placeholder="" name="reply" id="comment-<?php echo $comment['id']; ?>"></textarea>
                                                                        <span class="material-input"></span></div>
                                                                </div>
                                                                <button id="post-edited-comment" class="btn btn-md-2 btn-primary post-edited-comment" comment="<?php echo $comment['id']; ?>" member="<?php echo $MEMBER->id; ?>">Save</button>
                                                                <button id="post-edited-cancel" class="btn btn-md-2 btn-default post-edited-cancel" comment="<?php echo $comment['id']; ?>" member="<?php echo $MEMBER->id; ?>">Cancel</button>
                                                            </div>

                                                            <a class="reply add-reply" id="<?php echo $comment['id']; ?>">Reply</a>

                                                            <ul class="children comment-reply-list" id="comment-reply-list-<?php echo $comment['id']; ?>" comment-id="<?php echo $comment['id']; ?>">
                                                                <a href="#" class="see-more-replies hidden" id="see-more-replies-<?php echo $comment['id']; ?>">View all replies</a>
                                                                <?php
                                                                foreach ($replies as $reply) {
                                                                    $REPLYMEMBER = New Member($reply['member']);
                                                                    $repliedat = getTime($reply['replied_at']);
                                                                    ?>
                                                                    <li class="comment-item comment-reply-item" id="li_r_<?php echo $reply['id']; ?>">
                                                                        <div class="post__author author vcard inline-items">
                                                                            <img src="../upload/member/<?php echo $REPLYMEMBER->profilePicture; ?>" alt="author">

                                                                            <div class="author-date">
                                                                                <a class="h6 post__author-name fn" href="profile.php?id=<?php echo $REPLYMEMBER->id; ?>"><?php echo $REPLYMEMBER->firstName . ' ' . $REPLYMEMBER->lastName; ?></a>
                                                                                <div class="post__date">
                                                                                    <time class="published" datetime="2017-03-24T18:18">
                                                                                        <?php echo $repliedat; ?>
                                                                                    </time>
                                                                                </div>
                                                                            </div>

                                                                            <?php
                                                                            if ($reply['member'] == $MEMBER->id) {
                                                                                ?>
                                                                                <div class="more">
                                                                                    <svg class="olymp-three-dots-icon">
                                                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                                                                    </svg>
                                                                                    <ul class="more-dropdown">
                                                                                        <li>
                                                                                            <a class="edit-reply" id="<?php echo $reply['id']; ?>">Edit Reply</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a class="delete-reply" id="<?php echo $reply['id']; ?>">Delete Reply</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                            ?>

                                                                        </div>


                                                                        <p class="reply-p" id="reply-p-<?php echo $reply['id']; ?>"><?php echo $reply['reply']; ?></p>
                                                                        <div class="reply-edit-form inline-items hidden" id="reply-edit-form-<?php echo $reply['id']; ?>">
                                                                            <div class="post__author author vcard inline-items">
                                                                                <div class="form-group with-icon-right is-empty">
                                                                                    <textarea class="form-control" placeholder="" name="reply" id="reply-<?php echo $reply['id']; ?>"></textarea>
                                                                                    <span class="material-input"></span></div>
                                                                            </div>
                                                                            <button id="post-edited-reply" class="btn btn-md-2 btn-primary post-edited-reply" reply="<?php echo $reply['id']; ?>" member="<?php echo $MEMBER->id; ?>">Save</button>
                                                                            <button id="reply-edited-cancel" class="btn btn-md-2 btn-default reply-edited-cancel" reply="<?php echo $reply['id']; ?>" member="<?php echo $MEMBER->id; ?>">Cancel</button>
                                                                        </div>


                                                                        <a class="reply add-reply" id="<?php echo $comment['id']; ?>">Reply</a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="reply-form inline-items hidden" id="reply-form-<?php echo $comment['id']; ?>">
                                                                    <div class="post__author author vcard inline-items">
                                                                        <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author">
                                                                        <div class="form-group with-icon-right is-empty">
                                                                            <textarea class="form-control" placeholder="" name="reply" id="reply-<?php echo $comment['id']; ?>"></textarea>
                                                                            <span class="material-input"></span></div>
                                                                    </div>
                                                                    <button id="post-reply" class="btn btn-md-2 btn-primary post-reply" comment="<?php echo $comment['id']; ?>" member="<?php echo $MEMBER->id; ?>">Post Reply</button>
                                                                </div>
                                                            </ul>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </ul>
                                            <?php
                                        } else {
                                            ?>
                                            <ul class="comments-list hidden" id="comment-list-<?php echo $post['id']; ?>" post-id="<?php echo $post['id']; ?>"></ul>
                                            <?php
                                        }
                                        ?>

                                        <div class="comment-form inline-items hidden" id="comment-form-<?php echo $post['id']; ?>">
                                            <div class="post__author author vcard inline-items">
                                                <img src="../upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author">
                                                <div class="form-group with-icon-right is-empty">
                                                    <textarea class="form-control" placeholder="" name="comment" id="comment-<?php echo $post['id']; ?>"></textarea>

                                                    <span class="material-input"></span></div>
                                            </div>
                                            <button id="post-comment" class="btn btn-md-2 btn-primary post-comment" post="<?php echo $post['id']; ?>" member="<?php echo $MEMBER->id; ?>">Post Comment</button>
                                        </div>

                                        <!-- .. end Post -->
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="ui-block no-post">
                                    <h5>There is no any post.</h5>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                    <!-- ... end Main Content -->
                    <!-- Left Sidebar -->
                    <?php
                    include './profile-left-side.php';
                    ?>

                    <!-- ... end Left Sidebar -->



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
        <script src="js/sticky-sidebar.js"></script>
        <script src="js/base-init.js"></script>
        <script defer src="fonts/fontawesome-all.js"></script>
        <script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/friend-request.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/js/post-images.js" type="text/javascript"></script>
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/post-slider.js" type="text/javascript"></script>
        <script src="js/js/edit-post.js" type="text/javascript"></script>
        <script src="js/js/delete-post.js" type="text/javascript"></script>
        <script src="js/js/post-comment.js" type="text/javascript"></script>
        <script src="js/js/post-reply.js" type="text/javascript"></script>
        <script src="js/js/edit-profile-picture.js" type="text/javascript"></script>
        <script src="js/js/edit-cover-picture.js" type="text/javascript"></script>
        <script src="js/heartcode-canvasloader.js" type="text/javascript"></script>
        <script src="js/image-preloader.js" type="text/javascript"></script>
        <script src="js/js/read-more-and-less.js" type="text/javascript"></script>
    </body>
</html>