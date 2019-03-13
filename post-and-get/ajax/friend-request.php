<?php
include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] == 'FOLLOWFRIEND') {
    
    $REQUEST = new FriendRequest(NULL);
    $REQUEST->requestedBy = $_POST['requestedBy'];
    $REQUEST->requestedTo = $_POST['requestedTo'];
    $REQUEST->isApproved = '0';
    
    $result = $REQUEST->create();

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'CANCELREQUEST') {
    
    $REQUEST = new FriendRequest($_POST['row']);
    
    $result = $REQUEST->delete();
    
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'CONFIRMREQUEST') {
    
    $REQUEST = new FriendRequest($_POST['row']);
    $REQUEST->isConfirmed = 1;
    
    $req = $REQUEST->confirmRequest();
    
    if($req) {
        $FRIEND = new Friend(NULL);
        $FRIEND->member = $req->requestedBy;
        $FRIEND->friend = $req->requestedTo;
        $result = $FRIEND->create();
    }

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'DELETEREQUEST') {
    $REQUEST = new FriendRequest($_POST['row']);
    
    $result = $REQUEST->delete();
    
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'UNFOLLOW') {
    $res = Friend::unFollow($_POST['row']);
   
    $result = '';
    if($res) {
        $result = FriendRequest::unFollow($_POST['friend'],$_POST['member']);
    }
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}
