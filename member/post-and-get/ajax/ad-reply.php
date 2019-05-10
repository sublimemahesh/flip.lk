<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
if ($_POST['option'] == 'ADDREPLY') {

    $REPLY = new AdvertisementCommentReply(NULL);
    $REPLY->comment = $_POST['comment'];
    $REPLY->member = $_POST['member'];
    $REPLY->reply = $_POST['reply'];

    $result = $REPLY->create();
    $MEMBER = new Member($_POST['member']);
    $array= array();

    $array['replyid'] = $result->id;
    $array['reply'] = $result->reply;
    $array['date'] = $result->repliedAt;
    $array['member'] = $MEMBER->firstName . ' ' . $MEMBER->lastName;
    $array['profile'] = $MEMBER->profilePicture;
    $array['google_id'] = $MEMBER->googleID;
    $array['facebook_id'] = $MEMBER->facebookID;
        
    
    if ($result) {
        header('Content-Type: application/json');
        echo json_encode($array);
        exit();
    }
}

if ($_POST['option'] == 'UPDATEREPLY') {

    $REPLY = new AdvertisementCommentReply($_POST['id']);
    $REPLY->reply = $_POST['reply'];

    $result = $REPLY->update();
    $array = array();

    $array['reply'] = $result->reply;


    if ($result) {
        header('Content-Type: application/json');
        echo json_encode($array);
        exit();
    }
}
if ($_POST['option'] == 'DELETEREPLY') {

    $REPLY = new AdvertisementCommentReply($_POST['id']);

    $result = $REPLY->delete();

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }
}