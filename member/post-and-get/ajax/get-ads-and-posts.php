
<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../calculate-time1.php');

if (!isset($_SESSION)) {
    session_start();
}
$MEMBER = new Member($_SESSION['id']);
$limit = 5;
if (isset($_POST['page']) && $_POST['page'] != "") {
    $page = $_POST['page'];
    $offset = $limit * ($page - 1);
} else {
    $page = 1;
    $offset = 0;
}

$total_rows = count(Advertisement::getCountOfAdsAndPostsByMember($MEMBER->id));

$total_pages = ceil($total_rows / $limit);

$ads = Advertisement::getAdsAndPostsByMember($MEMBER->id, $offset, $limit);

//dd(mysql_num_rows($ads));
//$query = "select * from `posts` limit $offset, $limit";
//$res = mysql_query($con, $query);
//if (mysql_num_rows($ads) > 0) {
    $results = "";
    $results .= '<input type="hidden" name="total_pages" id="total_pages" value="' . $total_pages . '">';
    $results .= '<input type="hidden" name="page" id="page" value="' . $page . '" offset="' . $offset . '" limit="' . $limit . '">';
    $results .= '<div id="results">';

    if (count($ads) > 0) {
        
        foreach ($ads as $key => $ad) {

            if ($ad['type'] == 'post') {
               
//                $results .= '<p style="height:200px;">' . $ad['id'] . '</p>';
                $POST = new Post($ad['id']);
                $MEM = new Member($POST->member);
                
                if ($MEM->status == 1) {

                    $result = getTime1($POST->createdAt);
                    
                    $count = PostComment::getCountOfCommentsByPostID($ad['id']);

                    $results .= '<div class="ui-block">';
                    $results .= '<article class="hentry post has-post-thumbnail shared-photo post' . $ad['id'] . '" id="post-id" post-id="' . $ad['id'] . '">';
                    $results .= '<div class="post__author author vcard inline-items">';
                    if ($MEM->profilePicture) {
                        if ($MEM->facebookID && substr($MEM->profilePicture, 0, 5) === "https") {
                            $results .= '<img alt="profile picture" src="' . $MEM->profilePicture . '">';
                        } elseif ($MEM->googleID && substr($MEM->profilePicture, 0, 5) === "https") {
                            $results .= '<img alt="profile picture" src="' . $MEM->profilePicture . '">';
                        } else {
                            $results .= '<img alt="profile picture" src="../upload/member/' . $MEM->profilePicture . '">';
                        }
                    } else {
                        $results .= '<img alt="author" src="../upload/member/member.png">';
                    }
                    $results .= '<div class="author-date">';
                    if ($POST->sharedAd != 0) {
                        $results .= '<a class="h6 post__author-name fn" href="profile.php?id=' . $MEM->id . '">' . $MEM->firstName . ' ' . $MEM->lastName . '</a> shared a post';
                    } else {

                        $results .= '<a class="h6 post__author-name fn" href="profile.php?id=' . $MEM->id . '">' . $MEM->firstName . ' ' . $MEM->lastName . '</a>';
                    }
                    $results .= '<div class="post__date">';
                    $results .= '<time class="published">';
                    $results .= $result;
                    $results .= '</time>';
                    $results .= '</div>';
                    $results .= '</div>';
                    if ($POST->member == $MEMBER->id) {
                        $results .= '<div class="more">';
                        $results .= '<svg class="olymp-three-dots-icon">';
                        $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                        $results .= ' </svg>';
                        $results .= '<ul class="more-dropdown">';

                        $results .= '<li>';
                        $results .= ' <a  href="#" data-toggle="modal" data-target="#edit-post" class="edit-post" id="' . $ad['id'] . '">Edit Post</a>';
                        $results .= '</li>';
                        $results .= '<li>';
                        $results .= '<a class="delete-post" id="' . $ad['id'] . '">Delete Post</a>';
                        $results .= ' </li>';
                        $results .= '</ul>';
                        $results .= '</div>';
                    }
                    $results .= '</div>';
                    $results .= '<span class="more">';
                    $results .= ' <p>' . $POST->description . '</p>';
                    $results .= '</span>';

                    $results .= '<div class="post-thumb">';
                    $results .= '<div id="gallery-' . $ad['type'] . '-' . $ad['id'] . '"></div>';
                    $results .= '</div>';
                    $results .= '<div class=" content">';

                    $results .= '</div>';
                    if ($POST->sharedAd != 0) {
                        $AD1 = new Advertisement($POST->sharedAd);
                        $MEM2 = new Member($AD1->member);
                        $GROUP = new Group($AD1->groupId);
                        $result1 = getTime1($AD1->createdAt);

                        $results .= '<ul class="children single-children">';
                        $results .= '<li class="comment-item">';
                        $results .= '<div class="post__author author vcard inline-items">';

                        if ($MEM2->profilePicture) {

                            if ($MEM2->facebookID && substr($MEM2->profilePicture, 0, 5) === "https") {

                                $results .= ' <img alt="profile picture" src="' . $MEM2->profilePicture . '">';
                            } elseif ($MEM2->googleID && substr($MEM2->profilePicture, 0, 5) === "https") {

                                $results .= ' <img alt="profile picture" src="' . $MEM2->profilePicture . '">';
                            } else {

                                $results .= '<img alt="profile picture" src="../upload/member/' . $MEM2->profilePicture . '">';
                            }
                        } else {

                            $results .= '<img alt="author" src="../upload/member/member.png">';
                        }
                        $results .= ' <div class="author-date">';
                        $results .= '<a class="h6 post__author-name fn" href="profile.php?id=' . $MEM->id . '">' . $MEM2->firstName . ' ' . $MEM2->lastName . '</a> <i class="fa fa-caret-right"></i> <a class="h6 post__author-name fn" href="group.php?id=' . $GROUP->id . '">' . $GROUP->name . '</a>';
                        $results .= '<div class="post__date">';
                        $results .= '<time class="published" datetime="2017-03-24T18:18">';
                        $results .= $result1;
                        $results .= '</time>';
                        $results .= '</div>';
                        $results .= '</div>';
                        $results .= '</div>';
                        $results .= '<h5>' . $AD1->title . '</h5>';
                        $results .= '<span class="more">';
                        $results .= '<p>' . $AD1->description . '</p>';
                        $results .= '</span>';
                        $results .= '</li>';
                        $results .= '</ul>';
                    }

                    $results .= '<div class="post-additional-info inline-items">';
                    $results .= '<div class="comments-shared">';
                    $results .= '<a class="post-add-icon inline-items add-comment" id="' . $ad['id'] . '">';
                    $results .= '<svg class="olymp-speech-balloon-icon">';
                    $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>';
                    $results .= '</svg>';
                    $results .= '<span>' . $count['count'] . '</span>';
                    $results .= '</a>';
                    $results .= '</div>';
                    $results .= '</div>';
                    $results .= '</article>';

                    $comments = PostComment::getCommentsByPostID($ad['id']);
                    if (count($comments) > 0) {

                        $results .= '<ul class="comments-list hidden" id="comment-list-' . $ad['id'] . '" post-id="' . $ad['id'] . '">';
                        $results .= '<a class="see-more hidden" id="see-more-' . $ad['id'] . '">Show all comments</a>';

                        foreach ($comments as $key => $comment) {

                            $COMMENTMEMBER = New Member($comment['member']);
                            $commentedat = getTime1($comment['commented_at']);
                            $replies = PostCommentReply::getRepliesByCommentID($comment['id']);
                            if (count($replies) < 0) {
                                $results .= '<li class="comment-item comment-item1" id="li_' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';
                                $results .= '<img src="../upload/member/' . $COMMENTMEMBER->profilePicture . '" alt="author">';
                                $results .= '<div class="author-date">';
                                $results .= '<a class="h6 post__author-name fn" href="profile.php?id=' . $COMMENTMEMBER->id . '">' . $COMMENTMEMBER->firstName . ' ' . $COMMENTMEMBER->lastName . '</a>';
                                $results .= '<div class="post__date">';
                                $results .= '<time class="published" datetime="2017-03-24T18:18">';
                                $results .= $commentedat;
                                $results .= '</time>';
                                $results .= '</div>';
                                $results .= '</div>';
                                if ($comment['member'] == $MEMBER->id) {
                                    $results .= '<div class="more">';
                                    $results .= '<svg class="olymp-three-dots-icon">';
                                    $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                                    $results .= '</svg>';
                                    $results .= '<ul class="more-dropdown">';
                                    $results .= '<li>';
                                    $results .= '<a class="edit-comment" id="' . $comment['id'] . '">Edit Comment</a>';
                                    $results .= '</li>';
                                    $results .= '<li>';
                                    $results .= '<a class="delete-comment" id="' . $comment['id'] . '">Delete Comment</a>';
                                    $results .= '</li>';
                                    $results .= '</ul>';
                                    $results .= '</div>';
                                }
                                $results .= '</div>';
                                $results .= '<p class="comment-p" id="comment-p-' . $comment['id'] . '">' . $comment['comment'] . '</p>';
                                $results .= '<div class="comment-edit-form inline-items hidden" id="comment-edit-form-' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';
                                $results .= '<div class="form-group with-icon-right is-empty">';
                                $results .= '<textarea class="form-control" placeholder="" name="reply" id="comment-' . $comment['id'] . '"></textarea>';
                                $results .= '<span class="material-input"></span></div>';
                                $results .= '</div>';
                                $results .= '<button id="post-edited-comment" class="btn btn-md-2 btn-primary post-edited-comment" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Save</button>';
                                $results .= '<button id="post-edited-cancel" class="btn btn-md-2 btn-default post-edited-cancel" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Cancel</button>';
                                $results .= '</div>';
                                $results .= '<a class="reply add-reply" id="' . $comment['id'] . '">Reply</a>';
                                $results .= '<div class="reply-form inline-items hidden" id="reply-form-' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';
                                $results .= '<img src="../upload/member/' . $MEMBER->profilePicture . '" alt="author">';
                                $results .= '<div class="form-group with-icon-right is-empty">';
                                $results .= '<textarea class="form-control" placeholder="" name="reply" id="reply-' . $comment['id'] . '"></textarea>';
                                $results .= '<span class="material-input"></span></div>';
                                $results .= '</div>';
                                $results .= '<button id="index-post-reply" class="btn btn-md-2 btn-primary index-post-reply" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Post Reply</button>';
                                $results .= ' </div>';


                                $results .= '</li>';
                            } else {

                                $results .= '<li class="comment-item comment-item1 has-children" id="li_' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';
                                $results .= '<img src="../upload/member/' . $COMMENTMEMBER->profilePicture . '" alt="author">';

                                $results .= '<div class="author-date">';
                                $results .= '<a class="h6 post__author-name fn" href="profile.php?id=' . $COMMENTMEMBER->id . '">' . $COMMENTMEMBER->firstName . ' ' . $COMMENTMEMBER->lastName . '</a>';
                                $results .= '<div class="post__date">';
                                $results .= '<time class="published" datetime="2017-03-24T18:18">';
                                $results .= $commentedat;
                                $results .= '</time>';
                                $results .= '</div>';
                                $results .= '</div>';

                                if ($comment['member'] == $MEMBER->id) {

                                    $results .= '<div class="more">';
                                    $results .= '<svg class="olymp-three-dots-icon">';
                                    $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                                    $results .= ' </svg>';
                                    $results .= '<ul class="more-dropdown">';
                                    $results .= '<li>';
                                    $results .= '<a class="edit-comment" id="' . $comment['id'] . '" type="' . $POST->sharedAd . '">Edit Comment</a>';
                                    $results .= ' </li>';
                                    $results .= '<li>';
                                    $results .= '<a class="delete-comment" id="' . $comment['id'] . '" type="' . $ad['type'] . '">Delete Comment</a>';
                                    $results .= '</li>';
                                    $results .= '</ul>';
                                    $results .= '</div>';
                                }
                                $results .= '</div>';

                                $results .= '<p class = "comment-p" id = "comment-p-' . $comment['id'] . '">' . $comment['comment'] . '</p>';
                                $results .= '<div class="comment-edit-form inline-items hidden" id="comment-edit-form-' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';
                                $results .= '<div class="form-group with-icon-right is-empty">';
                                $results .= '<textarea class="form-control" placeholder="" name="reply" id="comment-' . $comment['id'] . '"></textarea>';
                                $results .= '<span class="material-input"></span></div>';
                                $results .= '</div>';
                                $results .= '<button id="post-edited-comment" class="btn btn-md-2 btn-primary post-edited-comment" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Save</button>';
                                $results .= '<button id="post-edited-cancel" class="btn btn-md-2 btn-default post-edited-cancel" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Cancel</button>';
                                $results .= '</div>';
                                $results .= '<div class="comment-edit-form inline-items hidden" id="shared-comment-edit-form-' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';
                                $results .= '<div class="form-group with-icon-right is-empty">';
                                $results .= '<textarea class="form-control" placeholder="" name="reply" id="shared-comment-' . $comment['id'] . '"></textarea>';
                                $results .= '<span class="material-input"></span></div>';
                                $results .= '</div>';
                                $results .= '<button id="shared-post-edited-comment" class="btn btn-md-2 btn-primary shared-post-edited-comment" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Save</button>';
                                $results .= '<button id="shared-post-edited-cancel" class="btn btn-md-2 btn-default shared-post-edited-cancel" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Cancel</button>';
                                $results .= '</div>';

                                $results .= '<a class="reply add-reply" id="' . $comment['id'] . '">Reply</a>';

                                $results .= '<ul class="children comment-reply-list" id="comment-reply-list-' . $comment['id'] . '" comment-id="' . $comment['id'] . '">';
                                $results .= '<a class="see-more-replies hidden" id="see-more-replies-' . $comment['id'] . '">View all replies</a>';

                                foreach ($replies as $reply) {
                                    $REPLYMEMBER = New Member($reply['member']);
                                    $repliedat = getTime1($reply['replied_at']);

                                    $results .= '<li class="comment-item comment-reply-item" id="li_r_' . $reply['id'] . '">';
                                    $results .= '<div class="post__author author vcard inline-items">';
                                    $results .= '<img src="../upload/member/' . $REPLYMEMBER->profilePicture . '" alt="author">';

                                    $results .= '<div class="author-date">';
                                    $results .= '<a class="h6 post__author-name fn" href="profile.php?id=' . $REPLYMEMBER->id . '">' . $REPLYMEMBER->firstName . ' ' . $REPLYMEMBER->lastName . '</a>';
                                    $results .= '<div class="post__date">';
                                    $results .= '<time class="published" datetime="2017-03-24T18:18">';
                                    $results .= $repliedat;
                                    $results .= '</time>';
                                    $results .= '</div>';
                                    $results .= '</div>';
                                    if ($reply['member'] == $MEMBER->id) {

                                        $results .= '<div class="more">';
                                        $results .= '<svg class="olymp-three-dots-icon">';
                                        $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                                        $results .= '</svg>';
                                        $results .= '<ul class="more-dropdown">';
                                        $results .= '<li>';
                                        $results .= '<a class="edit-reply" id="' . $reply['id'] . '">Edit Reply</a>';
                                        $results .= '</li>';
                                        $results .= '<li>';
                                        $results .= '<a class="delete-reply" id="' . $reply['id'] . '" type="' . $ad['type'] . '">Delete Reply</a>';
                                        $results .= '</li>';
                                        $results .= '</ul>';
                                        $results .= '</div>';
                                    }
                                    $results .= '</div>';
                                    $results .= '<p class = "reply-p" id = "reply-p-' . $reply['id'] . '">' . $reply['reply'] . '</p>';
                                    $results .= '<div class="reply-edit-form inline-items hidden" id="reply-edit-form-' . $reply['id'] . '">';
                                    $results .= '<div class="post__author author vcard inline-items">';
                                    $results .= '<div class="form-group with-icon-right is-empty">';
                                    $results .= '<textarea class="form-control" placeholder="" name="reply" id="reply-' . $reply['id'] . '"></textarea>';
                                    $results .= '<span class="material-input"></span></div>';
                                    $results .= '</div>';
                                    $results .= '<button id="post-edited-reply" class="btn btn-md-2 btn-primary post-edited-reply" reply="' . $reply['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Save</button>';
                                    $results .= '<button id="reply-edited-cancel" class="btn btn-md-2 btn-default reply-edited-cancel" reply="' . $reply['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Cancel</button>';
                                    $results .= '</div>';
                                    $results .= '<div class="shared-reply-edit-form inline-items hidden" id="shared-reply-edit-form-' . $reply['id'] . '">';
                                    $results .= '<div class="post__author author vcard inline-items">';
                                    $results .= '<div class="form-group with-icon-right is-empty">';
                                    $results .= '<textarea class="form-control" placeholder="" name="reply" id="shared-reply-' . $reply['id'] . '"></textarea>';
                                    $results .= '<span class="material-input"></span></div>';
                                    $results .= '</div>';
                                    $results .= '<button id="shared-post-edited-reply" class="btn btn-md-2 btn-primary shared-post-edited-reply" reply="' . $reply['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Save</button>';
                                    $results .= '<button id="shared-reply-edited-cancel" class="btn btn-md-2 btn-default shared-reply-edited-cancel" reply="' . $reply['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Cancel</button>';
                                    $results .= '</div>';


                                    $results .= '<a class="reply add-reply" id="' . $comment['id'] . '">Reply</a>';
                                    $results .= '</li>';
                                }
                                $results .= '<div class="reply-form inline-items hidden" id="reply-form-' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';
                                $results .= '<img src="../upload/member/' . $MEMBER->profilePicture . '" alt="author">';
                                $results .= '<div class="form-group with-icon-right is-empty">';
                                $results .= '<textarea class="form-control" placeholder="" name="reply" id="reply-' . $comment['id'] . '"></textarea>';
                                $results .= '<span class="material-input"></span></div>';
                                $results .= '</div>';
                                $results .= '<button id="index-post-reply" class="btn btn-md-2 btn-primary index-post-reply" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Post Reply</button>';
                                $results .= '</div>';
                                $results .= '</ul>';
                                $results .= '</li>';
                            }
                        }
                        $results .= '</ul>';
                    } else {

                        $results .= '<ul class="comments-list hidden" id="comment-list-' . $ad['id'] . '" post-id="' . $ad['id'] . '"></ul>';
                    }
                    $results .= '<div class="comment-form inline-items hidden" id="comment-form-' . $ad['id'] . '">';
                    $results .= '<div class="post__author author vcard inline-items">';
                    $results .= '<img src="../upload/member/' . $MEMBER->profilePicture . '" alt="author">';
                    $results .= '<div class="form-group with-icon-right is-empty">';
                    $results .= ' <textarea class="form-control" placeholder="" name="comment" id="comment-' . $ad['id'] . '"></textarea>';
                    $results .= '<span class="material-input"></span></div>';
                    $results .= '</div>';
                    $results .= '<button id="index-post-comment" class="btn btn-md-2 btn-primary index-post-comment" post="' . $ad['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Post Comment</button>';
                    $results .= '</div>';
                    $results .= '</div>';
                }
                 
            } else {
//                $results .= '<p style="height:200px;">' . $ad['id'] . '</p>';
                $AD = new Advertisement($ad['id']);
                $MEM = new Member($AD->member);
                if ($MEM->status == 1) {
                    $GROUP = new Group($AD->groupId);
                    $result = getTime1($AD->createdAt);
                    $count = AdvertisementComment::getCountOfCommentsByAdvertisementID($AD->id);
                    $countsharedtimes = count(Post::getPostsBySharedAD($AD->id));
                    $CATEGORY = new BusinessCategory($AD->category);
                    $SUBCATEGORY = new BusinessSubCategory($AD->subCategory);


                    $results .= '<div class="ui-block">';
                    $results .= '<article class="hentry post has-post-thumbnail shared-photo ad_' . $ad['id'] . '" id="post-id" post-id="' . $ad['id'] . '">';

                    $results .= '<div class="post__author author vcard inline-items">';
                    $results .= '<img src="../upload/member/' . $MEM->profilePicture . '" alt="author">';

                    $results .= '<div class="author-date">';
                    $results .= '<a class="h6 post__author-name fn" href="profile.php?id=' . $MEM->id . '">' . $MEM->firstName . ' ' . $MEM->lastName . '</a> <i class="fa fa-caret-right"></i> <a class="h6 post__author-name fn" href="group.php?id=' . $GROUP->id . '">' . $GROUP->name . '</a>';
                    $results .= '<div class="post__date">';
                    $results .= '<time class="published">';
                    $results .= $result;
                    $results .= '</time>';
                    $results .= '</div>';
                    $results .= '</div>';

                    if ($AD->member == $MEMBER->id) {

                        $results .= '<div class="more">';
                        $results .= '<svg class="olymp-three-dots-icon">';
                        $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                        $results .= '</svg>';
                        $results .= '<ul class="more-dropdown">';

                        $results .= '<li>';
                        $results .= '<a href="edit-advertisement.php?id=' . $ad['id'] . '" class="edit-ad" id="' . $ad['id'] . '">Edit Advertisement</a>';
                        $results .= '</li>';
                        $results .= '<li>';
                        $results .= '<a class="delete-ad" id="' . $ad['id'] . '">Delete Advertisement</a>';
                        $results .= '</li>';

                        $results .= '</ul>';
                        $results .= '</div>';
                    }
                    $results .= '</div>';
                    $results .= '<h5><b>' . $AD->title . '</b></h5>';
                    $results .= '<span class="more">';
                    $results .= '<p>' . $AD->description . '</p>';
                    $results .= '</span>';

                    $results .= '<div class="post-thumb">';
                    $results .= '<div id="gallery-' . $ad['type'] . '-' . $ad['id'] . '"></div>';
                    $results .= '</div>';
                    $results .= '<div class=" content">';

                    $results .= '</div>';
                    $results .= '<ul class="children single-children">';
                    $results .= '<li class="comment-item">';
                    $results .= '<ul class="">';
                    $results .= '<li>' . $CATEGORY->name . ' >> ' . $SUBCATEGORY->name . '</li>';
                    $results .= '<li>City >> Category</li>';
                    $results .= '</ul>';
                    $results .= '</li>';
                    $results .= ' </ul>';
                    $results .= '<div class="post-additional-info inline-items">';
                    $results .= '<div class="comments-shared">';
                    $results .= '<a class="post-add-icon inline-items add-comment" id="' . $ad['id'] . '">';
                    $results .= '<svg class="olymp-speech-balloon-icon">';
                    $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>';
                    $results .= '</svg>';
                    $results .= '<span>' . $count['count'] . '</span>';
                    $results .= '</a>';

                    $results .= '<a class="post-add-icon inline-items share-ad-link" data-toggle="modal" data-target="#share-ad" id="' . $ad['id'] . '">';
                    $results .= '<svg class="olymp-share-icon">';
                    $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use>';
                    $results .= '</svg>';
                    $results .= '<span>' . $countsharedtimes . '</span>';
                    $results .= '</a>';
                    $results .= '</div>';
                    $results .= '</div>';
                    $results .= '</article>';

                    $comments = AdvertisementComment::getCommentsByAdvertisementID($ad['id']);
                    if (count($comments) > 0) {

                        $results .= '<ul class="comments-list hidden" id="comment-list-' . $ad['id'] . '" post-id="' . $ad['id'] . '">';
                        $results .= '<a class="see-more hidden" id="see-more-' . $ad['id'] . '">Show all comments</a>';

                        foreach ($comments as $key => $comment) {
                            $COMMENTMEMBER = New Member($comment['member']);
                            $commentedat = getTime1($comment['commented_at']);
                            $replies = AdvertisementCommentReply::getRepliesByCommentID($comment['id']);
                            if (count($replies) < 0) {

                                $results .= '<li class="comment-item comment-item1" id="li_' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';

                                if ($COMMENTMEMBER->profilePicture) {

                                    if ($COMMENTMEMBER->facebookID && substr($COMMENTMEMBER->profilePicture, 0, 5) === "https") {

                                        $results .= '<img alt="profile picture" src="' . $COMMENTMEMBER->profilePicture . '">';
                                    } elseif ($COMMENTMEMBER->googleID && substr($COMMENTMEMBER->profilePicture, 0, 5) === "https") {

                                        $results .= '<img alt="profile picture" src="' . $COMMENTMEMBER->profilePicture . '">';
                                    } else {

                                        $results .= '<img alt="profile picture" src="../upload/member/' . $COMMENTMEMBER->profilePicture . '">';
                                    }
                                } else {

                                    $results .= '<img alt="profile picture" src="../upload/member/member.png">';
                                }


                                $results .= '<div class="author-date">';
                                $results .= '<a class="h6 post__author-name fn" href="profile.php?id=' . $COMMENTMEMBER->id . '">' . $COMMENTMEMBER->firstName . ' ' . $COMMENTMEMBER->lastName . '</a>';
                                $results .= '<div class="post__date">';
                                $results .= '<time class="published" datetime="2017-03-24T18:18">';
                                $results .= $commentedat;
                                $results .= '</time>';
                                $results .= '</div>';
                                $results .= '</div>';
                                if ($comment['member'] == $MEMBER->id) {

                                    $results .= '<div class="more">';
                                    $results .= '<svg class="olymp-three-dots-icon">';
                                    $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                                    $results .= '</svg>';
                                    $results .= '<ul class="more-dropdown">';
                                    $results .= '<li>';
                                    $results .= '<a class="edit-comment" id="' . $comment['id'] . '" type="' . $ad['type'] . '">Edit Comment</a>';
                                    $results .= '</li>';
                                    $results .= '<li>';
                                    $results .= '<a class="delete-comment" id="' . $comment['id'] . '">Delete Comment</a>';
                                    $results .= '</li>';
                                    $results .= '</ul>';
                                    $results .= '</div>';
                                }

                                $results .= '</div>';

                                $results .= '<p class="comment-p" id="comment-p-' . $comment['id'] . '">' . $comment['comment'] . '</p>';
                                $results .= '<div class="comment-edit-form inline-items hidden" id="comment-edit-form-' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';
                                $results .= ' <div class="form-group with-icon-right is-empty">';
                                $results .= '<textarea class="form-control" placeholder="" name="reply" id="comment-' . $comment['id'] . '"></textarea>';
                                $results .= '<span class="material-input"></span></div>';
                                $results .= '</div>';
                                $results .= '<button id="post-edited-comment" class="btn btn-md-2 btn-primary post-edited-comment" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Save</button>';
                                $results .= '<button id="post-edited-cancel" class="btn btn-md-2 btn-default post-edited-cancel" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Cancel</button>';
                                $results .= '</div>';


                                $results .= '<a class="reply add-reply" id="' . $comment['id'] . '">Reply</a>';

                                $results .= '<div class="reply-form inline-items hidden" id="reply-form-' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';

                                if ($MEMBER->profilePicture) {

                                    if ($MEMBER->facebookID && substr($MEMBER->profilePicture, 0, 5) === "https") {

                                        $results .= '<img alt="profile picture" src="' . $MEMBER->profilePicture . '">';
                                    } elseif ($MEMBER->googleID && substr($MEMBER->profilePicture, 0, 5) === "https") {

                                        $results .= '<img alt="profile picture" src="' . $MEMBER->profilePicture . '">';
                                    } else {

                                        $results .= '<img alt="profile picture" src="../upload/member/' . $MEMBER->profilePicture . '">';
                                    }
                                } else {

                                    $results .= '<img alt="author" src="../upload/member/member.png">';
                                }

                                $results .= '<div class="form-group with-icon-right is-empty">';
                                $results .= '<textarea class="form-control" placeholder="" name="reply" id="reply-' . $comment['id'] . '"></textarea>';
                                $results .= '<span class="material-input"></span></div>';
                                $results .= '</div>';
                                $results .= '<button id="index-post-reply" class="btn btn-md-2 btn-primary index-post-reply" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Post Reply</button>';
                                $results .= '</div>';


                                $results .= '</li>';
                            } else {

                                $results .= '<li class="comment-item comment-item1 has-children" id="li_' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';

                                if ($COMMENTMEMBER->profilePicture) {

                                    if ($COMMENTMEMBER->facebookID && substr($COMMENTMEMBER->profilePicture, 0, 5) === "https") {

                                        $results .= '<img alt="profile picture" src="' . $COMMENTMEMBER->profilePicture . '">';
                                    } elseif ($COMMENTMEMBER->googleID && substr($COMMENTMEMBER->profilePicture, 0, 5) === "https") {

                                        $results .= '<img alt="profile picture" src="' . $COMMENTMEMBER->profilePicture . '">';
                                    } else {

                                        $results .= '<img alt="profile picture" src="../upload/member/' . $COMMENTMEMBER->profilePicture . '">';
                                    }
                                } else {

                                    $results .= '<img alt="profile picture" src="../upload/member/member.png">';
                                }


                                $results .= '<div class="author-date">';
                                $results .= '<a class="h6 post__author-name fn" href="profile.php?id=' . $COMMENTMEMBER->id . '">' . $COMMENTMEMBER->firstName . ' ' . $COMMENTMEMBER->lastName . '</a>';
                                $results .= '<div class="post__date">';
                                $results .= '<time class="published" datetime="2017-03-24T18:18">';
                                $results .= $commentedat;
                                $results .= '</time>';
                                $results .= '</div>';
                                $results .= '</div>';


                                if ($comment['member'] == $MEMBER->id) {

                                    $results .= '<div class="more">';
                                    $results .= '<svg class="olymp-three-dots-icon">';
                                    $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                                    $results .= '</svg>';
                                    $results .= '<ul class="more-dropdown">';
                                    $results .= '<li>';
                                    $results .= '<a class="ad-edit-comment" id="' . $comment['id'] . '">Edit Comment</a>';
                                    $results .= '</li>';
                                    $results .= '<li>';
                                    $results .= '<a class="delete-comment" id="' . $comment['id'] . '">Delete Comment</a>';
                                    $results .= '</li>';
                                    $results .= '</ul>';
                                    $results .= '</div>';
                                }


                                $results .= '</div>';

                                $results .= '<p class="ad-comment-p" id="ad-comment-p-' . $comment['id'] . '">' . $comment['comment'] . '</p>';

                                $results .= '<div class="ad-comment-edit-form inline-items hidden" id="ad-comment-edit-form-' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';
                                $results .= '<div class="form-group with-icon-right is-empty">';
                                $results .= '<textarea class="form-control" placeholder="" name="reply" id="ad-comment-' . $comment['id'] . '"></textarea>';
                                $results .= '<span class="material-input"></span></div>';
                                $results .= '</div>';
                                $results .= '<button id="ad-post-edited-comment" class="btn btn-md-2 btn-primary ad-post-edited-comment" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Save</button>';
                                $results .= '<button id="ad-post-edited-cancel" class="btn btn-md-2 btn-default ad-post-edited-cancel" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Cancel</button>';
                                $results .= '</div>';

                                $results .= '<a class="reply add-reply" id="' . $comment['id'] . '">Reply</a>';

                                $results .= '<ul class="children comment-reply-list" id="comment-reply-list-' . $comment['id'] . '" comment-id="' . $comment['id'] . '">';
                                $results .= '<a class="see-more-replies hidden" id="see-more-replies-' . $comment['id'] . '">View all replies</a>';

                                foreach ($replies as $reply) {
                                    $REPLYMEMBER = New Member($reply['member']);
                                    $repliedat = getTime1($reply['replied_at']);

                                    $results .= '<li class="comment-item comment-reply-item" id="li_r_' . $reply['id'] . '">';
                                    $results .= '<div class="post__author author vcard inline-items">';
                                    $results .= '<img src="../upload/member/' . $REPLYMEMBER->profilePicture . '" alt="author">';

                                    $results .= '<div class="author-date">';
                                    $results .= '<a class="h6 post__author-name fn" href="profile.php?id=' . $REPLYMEMBER->id . '">' . $REPLYMEMBER->firstName . ' ' . $REPLYMEMBER->lastName . '</a>';
                                    $results .= '<div class="post__date">';
                                    $results .= '<time class="published" datetime="2017-03-24T18:18">';
                                    $results .= $repliedat;
                                    $results .= '</time>';
                                    $results .= '</div>';
                                    $results .= '</div>';
                                    if ($reply['member'] == $MEMBER->id) {
                                        $results .= '<div class="more">';
                                        $results .= '<svg class="olymp-three-dots-icon">';
                                        $results .= '<use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>';
                                        $results .= '</svg>';
                                        $results .= '<ul class="more-dropdown">';
                                        $results .= '<li>';
                                        $results .= '<a class="edit-ad-reply" id="' . $reply['id'] . '">Edit Reply</a>';
                                        $results .= '</li>';
                                        $results .= '<li>';
                                        $results .= '<a class="delete-reply" id="' . $reply['id'] . '">Delete Reply</a>';
                                        $results .= '</li>';
                                        $results .= '</ul>';
                                        $results .= '</div>';
                                    }
                                    $results .= '</div>';
                                    $results .= '<p class="reply-p" id="ad-reply-p-' . $reply['id'] . '">' . $reply['reply'] . '</p>';
                                    $results .= '<div class="ad-reply-edit-form inline-items hidden" id="ad-reply-edit-form-' . $reply['id'] . '">';
                                    $results .= '<div class="post__author author vcard inline-items">';
                                    $results .= '<div class="form-group with-icon-right is-empty">';
                                    $results .= '<textarea class="form-control" placeholder="" name="reply" id="ad-reply-' . $reply['id'] . '"></textarea>';
                                    $results .= ' <span class="material-input"></span></div>';
                                    $results .= '</div>';
                                    $results .= '<button id="ad-post-edited-reply" class="btn btn-md-2 btn-primary ad-post-edited-reply" reply="' . $reply['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Save</button>';
                                    $results .= '<button id="ad-reply-edited-cancel" class="btn btn-md-2 btn-default ad-reply-edited-cancel" reply="' . $reply['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Cancel</button>';
                                    $results .= ' </div>';
                                    $results .= ' <a class="reply add-reply" id="' . $comment['id'] . '">Reply</a>';
                                    $results .= '</li>';
                                }

                                $results .= '<div class="reply-form inline-items hidden" id="reply-form-' . $comment['id'] . '">';
                                $results .= '<div class="post__author author vcard inline-items">';
                                $results .= '<img src="../upload/member/' . $MEMBER->profilePicture . '" alt="author">';
                                $results .= '<div class="form-group with-icon-right is-empty">';
                                $results .= ' <textarea class="form-control" placeholder="" name="reply" id="reply-' . $comment['id'] . '"></textarea>';
                                $results .= '<span class="material-input"></span></div>';
                                $results .= '</div>';
                                $results .= '<button id="index-post-reply" class="btn btn-md-2 btn-primary index-post-reply" comment="' . $comment['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Post Reply</button>';
                                $results .= '</div>';
                                $results .= ' </ul>';
                                $results .= '</li>';
                            }
                        }
                        $results .= '</ul>';
                    } else {

                        $results .= '<ul class="comments-list hidden" id="comment-list-' . $ad['id'] . '" post-id="' . $ad['id'] . '"></ul>';
                    }
                    $results .= '<div class="comment-form inline-items hidden" id="comment-form-' . $ad['id'] . '">';
                    $results .= '<div class="post__author author vcard inline-items">';
                    $results .= '<img src="../upload/member/' . $MEMBER->profilePicture . '" alt="author">';
                    $results .= '<div class="form-group with-icon-right is-empty">';
                    $results .= '<textarea class="form-control" placeholder="" name="comment" id="comment-' . $ad['id'] . '"></textarea>';
                    $results .= '<span class="material-input"></span></div>';
                    $results .= '</div>';
                    $results .= '<button id="index-post-comment" class="btn btn-md-2 btn-primary index-post-comment" post="' . $ad['id'] . '" member="' . $MEMBER->id . '" type="' . $ad['type'] . '">Post Comment</button>';
                    $results .= '</div>';
                    $results .= '</div>';
                }
            }
        }
    } else {
       
        $results .= '';
    }
    $results .= '</div>';
 
    echo $results;
//}
?>
