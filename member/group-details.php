<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$MEMBER = new Member($_SESSION['id']);
$groupimg = '';
$groupcover = '';


if (isset($_SESSION['group-image'])) {
    $groupimg = $_SESSION['group-image'];
}
if (isset($_SESSION['group-cover'])) {
    $groupcover = $_SESSION['group-cover'];
}

$id = '';
$filter = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}


$GROUP = new Group($id);
if ($filter == 'published') {
    $publisedAds = Advertisement::getPublishedAdsByGroup($id);
} elseif ($filter == 'unpublished') {
    $unpublisedAds = Advertisement::getUnpublishedAdsByGroup($id);
} elseif ($filter == 'requests') {
    $requests = GroupAndMemberRequest::getMemberRequestsByGroup($id);
} elseif ($filter == 'members') {
    $members = GroupMember::getAllMembersByGroup($id);
}
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
        <div class="header-spacer"></div>
        <div class="col col-xl-10 order-xl-1 col-lg-9 order-lg-1 col-md-9 col-sm-12 col-12">
            <?php
            include './group-header.php';
            ?>

            <div class="container">
                <div class="row">
                    <div class="col col-xl-8 order-xl-2 col-lg-8 order-lg-2 col-md-6 order-md-1 col-sm-12 col-12">
                        <?php
                        if ($filter == 'published') {
                            ?>
                            <section class="">
                                <div class="container">
                                    <div class="row">
                                        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12  m-auto">


                                            <ul class="table-careers">
                                                <li class="head">
                                                    <span>ID</span>
                                                    <span>DATE POSTED</span>
                                                    <span>TITLE</span>
                                                    <span>MEMBER</span>
                                                    <span></span>
                                                </li>
                                                <?php
                                                $ads = Advertisement::getPublishedAdsByGroup($id);
                                                if (count($ads) > 0) {
                                                    foreach ($ads as $key => $ad) {
                                                        $GROUP = new Group($ad['group_id']);
                                                        $MEM = new Member($ad['member']);
                                                        ?>
                                                        <li>
                                                            <span class=""><?php echo $ad['id']; ?></span>
                                                            <span class="date"><?php echo substr($ad['created_at'],0,10); ?></span>
                                                            <span class="bold"><?php echo $ad['title']; ?></span>
                                                            <span class="town-place"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></span>
                                                            <span><a href="#" class="btn btn-primary btn-sm full-width view-ad-link" data-toggle="modal" data-target="#view-ad" id="<?php echo $ad['id']; ?>" status="<?php echo $ad['status']; ?>">View Ad</a></span>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                    ?>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <?php
                            } elseif ($filter == 'unpublished') {
                                $unpublisedAds = Advertisement::getUnpublishedAdsByGroup($id);
                            } elseif ($filter == 'requests') {
                                $requests = GroupAndMemberRequest::getMemberRequestsByGroup($id);
                            } elseif ($filter == 'members') {
                                $members = GroupMember::getAllMembersByGroup($id);
                            }
                            ?>

                            <div id="newsfeed-items-grid">
                                <?php
                                $ads = Advertisement::getPublishedAdsByGroup($id);
                                if (count($ads) > 0) {
                                    foreach ($ads as $key => $ad) {
                                        $GROUP = new Group($ad['group_id']);
                                        $result = getTime($ad['created_at']);
                                        $count = AdvertisementComment::getCountOfCommentsByAdvertisementID($ad['id']);
                                        $countsharedtimes = count(Post::getPostsBySharedAD($ad['id']));
                                        ?>

                                        <div class="ui-block">
                                            <!-- Post -->

                                            <article class="hentry post has-post-thumbnail shared-photo ad_<?php echo $ad['id']; ?>" id="ad-id" post-id="<?php echo $ad['id']; ?>">

                                                <div class="post__author author vcard inline-items">
                                                    <?php
                                                    if ($MEMBER->profilePicture) {

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
                                                    } else {
                                                        ?>
                                                        <img alt="author" src="../upload/member/member.png" class="avatar" alt="profile" id="profile_pic2">
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="author-date">
                                                        <a class="h6 post__author-name fn" target="blank" href="profile.php"><?php echo $MEMBER->firstName . ' ' . $MEMBER->lastName; ?></a>
                                                        <div class="post__date">
                                                            <time class="published">
                                                                <?php echo $result; ?>
                                                            </time>
                                                        </div>
                                                    </div>

                                                    <div class="more">
                                                        <svg class="olymp-three-dots-icon">
                                                        <use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                                        </svg>
                                                        <ul class="more-dropdown">
                                                            <li>
                                                                <a href="edit-advertisement.php?id=<?php echo $ad['id']; ?>" class="edit-ad" id="<?php echo $ad['id']; ?>">Edit Advertisement</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="delete-ad" id="<?php echo $ad['id']; ?>">Delete Advertisement</a>
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
                                                <h5><b><?php echo $ad['title']; ?></b></h5>
                                                <span class="more">
                                                    <p>
                                                        <?php echo $ad['description']; ?>
                                                    </p>
                                                </span>

                                                <div class="post-thumb">
                                                    <div id="gallery-<?php echo $ad['id']; ?>"></div>
                                                </div>
                                                <div class=" content"></div>

                                                <div class="post-additional-info inline-items">
                                                    <div class="comments-shared">
                                                        <a class="post-add-icon inline-items my-ad-add-comment" id="<?php echo $ad['id']; ?>">
                                                            <svg class="olymp-speech-balloon-icon">
                                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                                            </svg>
                                                            <span><?php echo $count['count']; ?></span>
                                                        </a>
                                                        <a href="#" class="post-add-icon inline-items share-ad-link" data-toggle="modal" data-target="#share-ad" id="<?php echo $ad['id']; ?>">
                                                            <svg class="olymp-share-icon">
                                                            <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                                            </svg>
                                                            <span><?php echo $countsharedtimes; ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </article>
                                            <?php
                                            $comments = AdvertisementComment::getCommentsByAdvertisementID($ad['id']);
                                            if (count($comments) > 0) {
                                                ?>
                                                <ul class="comments-list hidden" id="my-ad-comment-list-<?php echo $ad['id']; ?>" ad-id="<?php echo $ad['id']; ?>">
                                                    <a href="#" class="see-more hidden" id="see-more-<?php echo $ad['id']; ?>">Show all comments</a>
                                                    <?php
                                                    foreach ($comments as $key => $comment) {
                                                        $COMMENTMEMBER = New Member($comment['member']);
                                                        $commentedat = getTime($comment['commented_at']);
                                                        $replies = AdvertisementCommentReply::getRepliesByCommentID($comment['id']);
                                                        if (count($replies) < 0) {
                                                            ?>
                                                            <li class="comment-item comment-item1" id="li_<?php echo $comment['id']; ?>">
                                                                <div class="post__author author vcard inline-items">
                                                                    <?php
                                                                    if ($COMMENTMEMBER->profilePicture) {

                                                                        if ($COMMENTMEMBER->facebookID && substr($COMMENTMEMBER->profilePicture, 0, 5) === "https") {
                                                                            ?>
                                                                            <img alt="profile picture" src="<?php echo $COMMENTMEMBER->profilePicture; ?>">
                                                                            <?php
                                                                        } elseif ($COMMENTMEMBER->googleID && substr($COMMENTMEMBER->profilePicture, 0, 5) === "https") {
                                                                            ?>
                                                                            <img alt="profile picture" src="<?php echo $COMMENTMEMBER->profilePicture; ?>">
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <img alt="profile picture" src="../upload/member/<?php echo $COMMENTMEMBER->profilePicture; ?>">
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <img alt="profile picture" src="../upload/member/member.png">
                                                                        <?php
                                                                    }
                                                                    ?>
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
                                                                                    <a class="delete-comment" id="<?php echo $comment['id']; ?>">Delete Comment</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </div>

                                                                <p class="comment-p" id="my-ad-comment-p-<?php echo $comment['id']; ?>"><?php echo $comment['comment']; ?></p>
                                                                <div class="comment-edit-form inline-items hidden" id="comment-edit-form-<?php echo $comment['id']; ?>">
                                                                    <div class="post__author author vcard inline-items">
                                                                        <div class="form-group with-icon-right is-empty">
                                                                            <textarea class="form-control" placeholder="" name="reply" id="my-ad-comment-<?php echo $comment['id']; ?>"></textarea>
                                                                            <span class="material-input"></span></div>
                                                                    </div>
                                                                    <button id="my-ad-edited-comment" class="btn btn-md-2 btn-primary my-ad-edited-comment" comment="<?php echo $comment['id']; ?>" member="<?php echo $MEMBER->id; ?>">Save</button>
                                                                    <button id="my-ad-edited-cancel" class="btn btn-md-2 btn-default my-ad-edited-cancel" comment="<?php echo $comment['id']; ?>" member="<?php echo $MEMBER->id; ?>">Cancel</button>
                                                                </div>

                                                                <a class="reply add-reply" id="<?php echo $comment['id']; ?>">Reply</a>

                                                                <div class="reply-form inline-items hidden" id="reply-form-<?php echo $comment['id']; ?>">
                                                                    <div class="post__author author vcard inline-items">
                                                                        <?php
                                                                        if ($MEMBER->profilePicture) {

                                                                            if ($MEMBER->facebookID && substr($MEMBER->profilePicture, 0, 5) === "https") {
                                                                                ?>
                                                                                <img alt="profile picture" src="<?php echo $MEMBER->profilePicture; ?>">
                                                                                <?php
                                                                            } elseif ($MEMBER->googleID && substr($MEMBER->profilePicture, 0, 5) === "https") {
                                                                                ?>
                                                                                <img alt="profile picture" src="<?php echo $MEMBER->profilePicture; ?>">
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <img alt="profile picture" src="../upload/member/<?php echo $MEMBER->profilePicture; ?>">
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <img alt="author" src="../upload/member/member.png">
                                                                            <?php
                                                                        }
                                                                        ?>
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
                                                                    <?php
                                                                    if ($COMMENTMEMBER->profilePicture) {

                                                                        if ($COMMENTMEMBER->facebookID && substr($COMMENTMEMBER->profilePicture, 0, 5) === "https") {
                                                                            ?>
                                                                            <img alt="profile picture" src="<?php echo $COMMENTMEMBER->profilePicture; ?>">
                                                                            <?php
                                                                        } elseif ($COMMENTMEMBER->googleID && substr($COMMENTMEMBER->profilePicture, 0, 5) === "https") {
                                                                            ?>
                                                                            <img alt="profile picture" src="<?php echo $COMMENTMEMBER->profilePicture; ?>">
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <img alt="profile picture" src="../upload/member/<?php echo $COMMENTMEMBER->profilePicture; ?>">
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <img alt="author" src="../upload/member/member.png">
                                                                        <?php
                                                                    }
                                                                    ?>

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
                                                                                    <a class="delete-comment" id="<?php echo $comment['id']; ?>">Delete Comment</a>
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
                                                                                <?php
                                                                                if ($REPLYMEMBER->profilePicture) {

                                                                                    if ($REPLYMEMBER->facebookID && substr($REPLYMEMBER->profilePicture, 0, 5) === "https") {
                                                                                        ?>
                                                                                        <img alt="profile picture" src="<?php echo $REPLYMEMBER->profilePicture; ?>">
                                                                                        <?php
                                                                                    } elseif ($REPLYMEMBER->googleID && substr($REPLYMEMBER->profilePicture, 0, 5) === "https") {
                                                                                        ?>
                                                                                        <img alt="profile picture" src="<?php echo $REPLYMEMBER->profilePicture; ?>">
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <img alt="profile picture" src="../upload/member/<?php echo $REPLYMEMBER->profilePicture; ?>">
                                                                                        <?php
                                                                                    }
                                                                                } else {
                                                                                    ?>
                                                                                    <img alt="author" src="../upload/member/member.png" class="avatar" alt="profile" id="profile_pic2">
                                                                                    <?php
                                                                                }
                                                                                ?>

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
                                                                            <?php
                                                                            if ($MEMBER->profilePicture) {

                                                                                if ($MEMBER->facebookID && substr($MEMBER->profilePicture, 0, 5) === "https") {
                                                                                    ?>
                                                                                    <img alt="profile picture" src="<?php echo $MEMBER->profilePicture; ?>">
                                                                                    <?php
                                                                                } elseif ($MEMBER->googleID && substr($MEMBER->profilePicture, 0, 5) === "https") {
                                                                                    ?>
                                                                                    <img alt="profile picture" src="<?php echo $MEMBER->profilePicture; ?>">
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <img alt="profile picture" src="../upload/member/<?php echo $MEMBER->profilePicture; ?>">
                                                                                    <?php
                                                                                }
                                                                            } else {
                                                                                ?>
                                                                                <img alt="author" src="../upload/member/member.png">
                                                                                <?php
                                                                            }
                                                                            ?>
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
                                                <ul class="comments-list hidden" id="my-ad-comment-list-<?php echo $ad['id']; ?>" post-id="<?php echo $ad['id']; ?>"></ul>
                                                <?php
                                            }
                                            ?>

                                            <div class="comment-form inline-items hidden" id="my-ad-comment-form-<?php echo $ad['id']; ?>">
                                                <div class="post__author author vcard inline-items">
                                                    <?php
                                                    if ($MEMBER->profilePicture) {

                                                        if ($MEMBER->facebookID && substr($MEMBER->profilePicture, 0, 5) === "https") {
                                                            ?>
                                                            <img alt="profile picture" src="<?php echo $MEMBER->profilePicture; ?>">
                                                            <?php
                                                        } elseif ($MEMBER->googleID && substr($MEMBER->profilePicture, 0, 5) === "https") {
                                                            ?>
                                                            <img alt="profile picture" src="<?php echo $MEMBER->profilePicture; ?>">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img alt="profile picture" src="../upload/member/<?php echo $MEMBER->profilePicture; ?>">
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <img alt="author" src="../upload/member/member.png">
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="form-group with-icon-right is-empty">
                                                        <textarea class="form-control" placeholder="" name="comment" id="my-ad-comment-<?php echo $ad['id']; ?>"></textarea>

                                                        <span class="material-input"></span></div>
                                                </div>
                                                <button id="post-comment" class="btn btn-md-2 btn-primary my-ad-post-comment" ad="<?php echo $ad['id']; ?>" member="<?php echo $MEMBER->id; ?>">Post Comment</button>
                                            </div>

                                            <!-- .. end Post -->
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="ui-block no-post">
                                        <h5>There is no any advertisements.</h5>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>


                        </div>

                        <?php
                        include './group-about-nav.php';
                        ?>

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
        <script src="js/images-grid.js" type="text/javascript"></script>
        <script src="js/js/join-group.js" type="text/javascript"></script>
        <script src="js/js/add-group-profile-picture.js" type="text/javascript"></script>
        <script src="js/js/add-group-cover-picture.js" type="text/javascript"></script>
        <script src="js/js/sub-categories.js" type="text/javascript"></script>
        <script src="js/js/group.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/js/find-friends.js" type="text/javascript"></script>
        <script src="js/js/publish-ad.js" type="text/javascript"></script>
        <script>
            var placeSearch, autocomplete, autocomplete2;

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                var options = {
                    types: ['(cities)'],
                    componentRestrictions: {country: "lk"}
                };
                var input = document.getElementById('autocomplete');
                var input2 = document.getElementById('autocomplete2');

                autocomplete = new google.maps.places.Autocomplete(input, options);
                autocomplete2 = new google.maps.places.Autocomplete(input2, options);

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
                autocomplete2.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();
                var place2 = autocomplete2.getPlace();
                $('#district').val(place.place_id);
                $('#city').val(place2.place_id);
                //                $('#longitude').val(place.geometry.location.lng());
                //                $('#latitude').val(place.geometry.location.lat());
                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false;
                }

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
            }

            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy
                        });
                        autocomplete.setBounds(circle.getBounds());
                        autocomplete2.setBounds(circle.getBounds());
                    });
                }
            }
        </script>
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
                    var place_id = $('#district').val();
                    var place_id2 = $('#city').val();
                    service.getDetails({
                        placeId: place_id
                    }, function (place, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
//                        alert(place.name);
                            $('#autocomplete').val(place.name);
                            $('.district-label').removeClass('is-empty');
                        }
                    });
                    service.getDetails({
                        placeId: place_id2
                    }, function (place2, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
//                        alert(place.name);
                            $('#autocomplete2').val(place2.name);
                            $('.city-label').removeClass('is-empty');
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