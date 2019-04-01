<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] == 'JOINGROUP') {
    
    $REQUEST = new GroupAndMemberRequest(NULL);
    $REQUEST->groupId = $_POST['group'];
    $REQUEST->member = $_POST['member'];
    $REQUEST->requestedBy = 'member';
    $REQUEST->isApproved = '0';
    
    $result = $REQUEST->create();

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'CANCELREQUEST') {
    
    $REQUEST = new GroupAndMemberRequest($_POST['row']);
    
    $result = $REQUEST->delete();
    
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'APPROVEREQUEST') {

    date_default_timezone_set('Asia/Colombo');
    $date = date('Y-m-d H:i:s');

    $REQUEST = new GroupAndMemberRequest($_POST['row']);
    $REQUEST->isApproved = 1;
    $REQUEST->approvedDate = $date;

    $req = $REQUEST->approveRequest();
    
    if($req) {
        $GROUPMEMBERS = new GroupMember(NULL);
        $GROUPMEMBERS->joinedAt = $date;
        $GROUPMEMBERS->groupId = $req->groupId;
        $GROUPMEMBERS->member = $req->member;
        $GROUPMEMBERS->status = 'member';
        $result = $GROUPMEMBERS->create();
    }

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'DECLINEREQUEST') {
    
    $REQUEST = new GroupAndMemberRequest($_POST['row']);
    
    $result = $REQUEST->delete();
    
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'LEAVEGROUP') {
    
    $res = GroupMember::leaveGroup($_POST['member'], $_POST['group']);
   
    $result = '';
    if ($res) {
        $result = GroupAndMemberRequest::leaveGroup($_POST['member'], $_POST['group']);
    }
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'ADDMEMBER') {

    $REQUEST = new GroupAndMemberRequest(NULL);
    $REQUEST->groupId = $_POST['group'];
    $REQUEST->member = $_POST['member'];
    $REQUEST->requestedBy = $_POST['addedBy'];
    $REQUEST->isApproved = '0';
    
    $result = $REQUEST->create();
    $MEMBER = new Member($result->member);
    $name = $MEMBER->firstName . ' ' . $MEMBER->lastName;

    header('Content-Type: application/json');
    echo json_encode($name);
    exit();
}

if ($_POST['option'] == 'CHECKMEMBEREXIST') {
    
    $GROUP = GroupMember::checkMemberAlreadyExistInTheGroup($_POST['member'], $_POST['group']);
    if ($GROUP) {
        $result = true;
    } else {
        $result = false;
    }
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}
if ($_POST['option'] == 'CHECKINVITED') {
    
    $res = GroupAndMemberRequest::checkAlreadyInvitedToTheGroup($_POST['member'], $_POST['group']);
    if ($res) {
        $result = true;
    } else {
        $result = false;
    }
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}