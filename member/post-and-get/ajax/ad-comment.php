<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'ADDCOMMENT') {

    $COMMENT = new AdvertisementComment(NULL);
    $COMMENT->advertisement = $_POST['ad'];
    $COMMENT->member = $_POST['member'];
    $COMMENT->comment = $_POST['comment'];

    $result = $COMMENT->create();
    
    //    Create Notification
    if ($result) {
        $NOTIFICATION = new Notification(NULL);
        $MEM = new Member($COMMENT->member);
        $AD = new Advertisement($COMMENT->advertisement);
        
        $NOTIFICATION->imageName = $MEM->profilePicture;
        $NOTIFICATION->title = 'New Comment';
        $NOTIFICATION->description = $MEM->firstName . ' ' . $MEM->lastName . ' is commented on your advertisement.';
        $NOTIFICATION->url = 'advertisement.php?id=' . $AD->id;
        $NOTIFICATION->user = $AD->member;
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

    $COMMENT = new AdvertisementComment($_POST['id']);
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

    $COMMENT = new AdvertisementComment($_POST['id']);

    $result = $COMMENT->delete();

    foreach (AdvertisementCommentReply::getRepliesByCommentID($_POST['id']) as $reply) {
        $REPLY = new AdvertisementCommentReply($reply['id']);
        $REPLY->delete();
    }

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }
}