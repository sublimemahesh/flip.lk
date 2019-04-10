<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'ADDCOMMENT') {

    $COMMENT = new PostComment(NULL);
    $COMMENT->post = $_POST['post'];
    $COMMENT->member = $_POST['member'];
    $COMMENT->comment = $_POST['comment'];

    $result = $COMMENT->create();
    //    Create Notification
    if ($result) {
        $NOTIFICATION = new Notification(NULL);
        $MEM = new Member($COMMENT->member);
        $POST = new Post($COMMENT->advertisement);
        
        $NOTIFICATION->imageName = $MEM->profilePicture;
        $NOTIFICATION->title = 'New Comment';
        $NOTIFICATION->description = $MEM->firstName . ' ' . $MEM->lastName . ' is commented on your post.';
        $NOTIFICATION->url = 'advertisement.php?id=' . $POST->id;
        $NOTIFICATION->user = $POST->member;
        $NOTIFICATION->create();
    }
    
    
    $MEMBER = new Member($_POST['member']);
    $array= array();

    $array['commentid'] = $result->id;
    $array['comment'] = $result->comment;
    $array['date'] = $result->commented_at;
    $array['member'] = $MEMBER->firstName . ' ' . $MEMBER->lastName;
    $array['profile'] = $MEMBER->profilePicture;
        
    
    if ($result) {
        header('Content-Type: application/json');
        echo json_encode($array);
        exit();
    }
}


if ($_POST['option'] == 'UPDATECOMMENT') {

    $COMMENT = new PostComment($_POST['id']);
    $COMMENT->comment = $_POST['comment'];

    $result = $COMMENT->update();
    $array = array();

    $array['comment'] = $result->comment;


    if ($result) {
        header('Content-Type: application/json');
        echo json_encode($array);
        exit();
    }
}
if ($_POST['option'] == 'DELETECOMMENT') {

    $COMMENT = new PostComment($_POST['id']);

    $result = $COMMENT->delete();

    foreach (PostCommentReply::getRepliesByCommentID($_POST['id']) as $reply) {
        $REPLY = new PostCommentReply($reply['id']);
        $REPLY->delete();
    }

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }
}
