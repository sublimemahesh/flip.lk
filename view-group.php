<?php
include_once(dirname(__FILE__) . '/class/include.php');
if (!isset($_SESSION)) {
    session_start();
}
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$GROUP = new Group($id);

$MEMBER = '';
if (isset($_SESSION['id'])) {
    $MEMBER = new Member($_SESSION['id']);
}
//$MEMBER = new Member(1);
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $GROUP->name; ?> || Groups || Flip.lk</title>
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
                        <div class="col col-xl-8 order-xl-2 col-lg-8 order-lg-1 col-sm-12 col-12">
                            <input type="hidden" id="group" value="<?php echo $GROUP->id ?>" />
                            <?php
                            if (isset($_SESSION['id'])) {
                                if (GroupMember::checkMemberAlreadyExistInTheGroup($MEMBER->id, $id)) {
                                    ?>
                                    <div class="ui-block group-settings-btn">
                                        <div class="row">
                                            <?php
                                            if ($MEMBER->id != $GROUP->member) {
                                                ?>
                                                <div class="col col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4">
                                                    <a class="btn btn-blue btn-md-2 join-group-btn" id="leave-group" group-id="<?php echo $id; ?>" member-id="<?php echo $MEMBER->id; ?>">Leave Group<div class="ripple-container"></div></a>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="col col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4">
                                                <a data-toggle="modal" data-target="#add-member" class="btn btn-blue btn-md-2 join-group-btn add-member" id="" group-id="<?php echo $id; ?>" member-id="<?php echo $MEMBER->id; ?>">Add Members<div class="ripple-container"></div></a>
                                            </div>
                                            <div class="col col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4">
                                                <a href="create-advertisement.php?id=<?php echo $GROUP->id ?>" class="btn btn-blue btn-md-2 join-group-btn" id="">Post Advertisement<div class="ripple-container"></div></a>
                                            </div>

                                        </div>
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
                                    <div class="ui-block <?php
                                    if ($join == 'false') {
                                        echo 'hidden';
                                    }
                                    ?>" id="join-block">
                                        <div class="row">
                                            <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                                <a class="btn btn-blue btn-md-2 join-group-btn" id="join-group-btn" group-id="<?php echo $id; ?>" member-id="<?php echo $MEMBER->id; ?>">Join Group<div class="ripple-container"></div></a>
                                            </div>
                                            <div class="col col-lg-9 col-md-9 col-sm-8 col-8 join-group-section">
                                                <h5>Join this group to post and comment.</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-block <?php
                                    if ($join == 'true') {
                                        echo 'hidden';
                                    }
                                    ?>" id="request-cancel-block">
                                        <div class="row">
                                            <div class="col col-lg-3 col-md-3 col-sm-4 col-4">
                                                <a class="btn btn-smoke btn-light-bg btn-md-2 join-group-btn" id="cancel-request-btn" row-id="<?php echo $rowid; ?>">Cancel Request<div class="ripple-container"></div></a>
                                            </div>
                                            <div class="col col-lg-9 col-md-9 col-sm-8 col-8 join-group-section">
                                                <h5>Your request has been sent to the approval.</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <div id="newsfeed-items-grid">

                                <?php
                                $ads = Advertisement::getAdsByGroup($GROUP->id);
                                if (count($ads) > 0) {
                                    foreach ($ads as $key => $ad) {

                                        $MEM = new Member($ad['member']);
                                        if ($MEM->status == 1) {

                                            $result = getTime($ad['created_at']);
                                            $count = AdvertisementComment::getCountOfCommentsByAdvertisementID($ad['id']);
                                            $countsharedtimes = count(Post::getPostsBySharedAD($ad['id']));
                                            ?>

                                            <div class="ui-block">
                                                <!-- Post -->

                                                <article class="hentry post has-post-thumbnail shared-photo ad_<?php echo $ad['id']; ?>" id="post-id" post-id="<?php echo $post['id']; ?>">

                                                    <div class="post__author author vcard inline-items">
                                                        <img src="upload/member/<?php echo $MEM->profilePicture; ?>" alt="author">

                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="view-member.php?id=<?php echo $MEM->id; ?>"><?php echo $MEM->firstName . ' ' . $MEM->lastName; ?></a> 
                                                            <div class="post__date">
                                                                <time class="published">
                                                                    <?php echo $result; ?>
                                                                </time>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <h5><b><?php echo $ad['title']; ?></b></h5><br/>
                                                    <span class="more">
                                                        <?php echo $ad['description']; ?>
                                                    </span>

                                                    <div class="post-thumb">
                                                        <div id="gallery-<?php echo $ad['id']; ?>"></div>
                                                    </div>
                                                    <div class=" content">

                                                    </div>
                                                    <div class="post-additional-info inline-items">
                                                        <div class="comments-shared">
                                                            <?php
                                                            if (isset($_SESSION['id'])) {
                                                                ?>
                                                                <a class="post-add-icon inline-items group-add-comment" id="<?php echo $ad['id']; ?>">
                                                                    <svg class="olymp-speech-balloon-icon">
                                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                                                    </svg>
                                                                    <span><?php echo $count['count']; ?></span>
                                                                </a>
                                                                <a class="post-add-icon inline-items share-ad-link" data-toggle="modal" data-target="#share-ad" id="<?php echo $ad['id']; ?>">
                                                                    <svg class="olymp-share-icon">
                                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                                                    </svg>
                                                                    <span><?php echo $countsharedtimes; ?></span>
                                                                </a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a class="post-add-icon inline-items" data-toggle="modal" data-target="#login-first" id="<?php echo $ad['id']; ?>">
                                                                    <svg class="olymp-speech-balloon-icon">
                                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                                                    </svg>
                                                                    <span><?php echo $count['count']; ?></span>
                                                                </a>
                                                                <a class="post-add-icon inline-items" data-toggle="modal" data-target="#login-first" id="<?php echo $ad['id']; ?>">
                                                                    <svg class="olymp-share-icon">
                                                                    <use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>
                                                                    </svg>
                                                                    <span><?php echo $countsharedtimes; ?></span>
                                                                </a>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </article>

                                                <?php
                                                $comments = AdvertisementComment::getCommentsByAdvertisementID($ad['id']);
                                                if (count($comments) > 0) {
                                                    ?>
                                                    <ul class="comments-list hidden" id="group-comment-list-<?php echo $ad['id']; ?>" ad-id="<?php echo $ad['id']; ?>">
                                                        <a class="see-more hidden" id="see-more-<?php echo $ad['id']; ?>">Show all comments</a>
                                                        <?php
                                                        foreach ($comments as $key => $comment) {
                                                            $COMMENTMEMBER = New Member($comment['member']);
                                                            $commentedat = getTime($comment['commented_at']);
                                                            $replies = AdvertisementCommentReply::getRepliesByCommentID($comment['id']);
                                                            if (count($replies) < 0) {
                                                                ?>
                                                                <li class="comment-item comment-item1" id="li_<?php echo $comment['id']; ?>">
                                                                    <div class="post__author author vcard inline-items">
                                                                        <img src="upload/member/<?php echo $COMMENTMEMBER->profilePicture; ?>" alt="author">

                                                                        <div class="author-date">
                                                                            <a class="h6 post__author-name fn" href="view-member.php?id=<?php echo $COMMENTMEMBER->id; ?>"><?php echo $COMMENTMEMBER->firstName . ' ' . $COMMENTMEMBER->lastName; ?></a>
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

                                                                    <div class="reply-form inline-items hidden" id="reply-form-<?php echo $comment['id']; ?>">
                                                                        <div class="post__author author vcard inline-items">
                                                                            <img src="upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author">
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
                                                                        <img src="upload/member/<?php echo $COMMENTMEMBER->profilePicture; ?>" alt="author">

                                                                        <div class="author-date">
                                                                            <a class="h6 post__author-name fn" href="view-member.php?id=<?php echo $COMMENTMEMBER->id; ?>"><?php echo $COMMENTMEMBER->firstName . ' ' . $COMMENTMEMBER->lastName; ?></a>
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
                                                                        <a class="see-more-replies hidden" id="see-more-replies-<?php echo $comment['id']; ?>">View all replies</a>
                                                                        <?php
                                                                        foreach ($replies as $reply) {
                                                                            $REPLYMEMBER = New Member($reply['member']);
                                                                            $repliedat = getTime($reply['replied_at']);
                                                                            ?>
                                                                            <li class="comment-item comment-reply-item" id="li_r_<?php echo $reply['id']; ?>">
                                                                                <div class="post__author author vcard inline-items">
                                                                                    <img src="upload/member/<?php echo $REPLYMEMBER->profilePicture; ?>" alt="author">

                                                                                    <div class="author-date">
                                                                                        <a class="h6 post__author-name fn" href="view-member.php?id=<?php echo $REPLYMEMBER->id; ?>"><?php echo $REPLYMEMBER->firstName . ' ' . $REPLYMEMBER->lastName; ?></a>
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
                                                                                <img src="upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author">
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
                                                    <ul class="comments-list hidden" id="group-comment-list-<?php echo $ad['id']; ?>" post-id="<?php echo $ad['id']; ?>"></ul>
                                                    <?php
                                                }
                                                ?>

                                                <div class="comment-form inline-items hidden" id="group-comment-form-<?php echo $ad['id']; ?>">
                                                    <div class="post__author author vcard inline-items">
                                                        <img src="upload/member/<?php echo $MEMBER->profilePicture; ?>" alt="author">
                                                        <div class="form-group with-icon-right is-empty">
                                                            <textarea class="form-control" placeholder="" name="comment" id="group-comment-<?php echo $ad['id']; ?>"></textarea>

                                                            <span class="material-input"></span></div>
                                                    </div>
                                                    <button id="post-comment" class="btn btn-md-2 btn-primary group-post-comment" ad="<?php echo $ad['id']; ?>" member="<?php echo $MEMBER->id; ?>">Post Comment</button>
                                                </div>

                                                <!-- .. end Post -->
                                            </div>
                                            <?php
                                        }
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
        </div>
        <input type="hidden" id="autocomplete2" placeholder="Location" value="<?php echo $_GET['location']; ?>">
        <div id="map"></div>
        <?php
        include './footer.php';
        ?>
        <a class="back-to-top" href="#">
            <img src="svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
        </a>
        <!-- Window-popup -->


        <!-- ... end Window-popup -->


        <!-- JS Scripts -->
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/perfect-scrollbar.js"></script>
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
        <script>
            var placeSearch, autocomplete;
            $('#city').val($('#autocomplete2').val());
            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                var options = {
                    types: ['(cities)'],
                    componentRestrictions: {country: "lk"}
                };
                var input = document.getElementById('autocomplete');

                autocomplete = new google.maps.places.Autocomplete(input, options);

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();
                $('#city').val(place.place_id);
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
                    var place_id = $('#city').val();

                    service.getDetails({
                        placeId: place_id
                    }, function (place, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {

                            $('.location').text(place.name);
                            $('#autocomplete').val(place.name);
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