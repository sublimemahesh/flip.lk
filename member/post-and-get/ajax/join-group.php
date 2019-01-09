<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

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
    
    $REQUEST = new GroupAndMemberRequest($_POST['row']);
    $REQUEST->isApproved = 1;
    
    $req = $REQUEST->approveRequest();
    
    if($req) {
        $GROUPMEMBERS = new GroupMember(NULL);
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
    
    $res = GroupMember::leaveGroup($_POST['member'],$_POST['group']);
   
    $result = '';
    if($res) {
        $result = GroupAndMemberRequest::leaveGroup($_POST['member'],$_POST['group']);
    }
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}