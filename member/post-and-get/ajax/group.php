<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'UPDATESTATUS') {

    $GROUP = new Group($_POST['id']);
    $GROUP->status = $_POST['status'];

    $result = $GROUP->updateStatus();

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}
if ($_POST['option'] == 'DELETEGROUP') {

    $GROUP = new Group($_POST['id']);

    $result = $GROUP->delete();

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}
if ($_POST['option'] == 'CONFIRMINVITATION') {

    $REQUEST = new GroupAndMemberRequest($_POST['row']);
    $REQUEST->isApproved = 1;

    $req = $REQUEST->approveRequest();

    if ($req) {
        $GROUPMEMBER = new GroupMember(NULL);
        $GROUPMEMBER->member = $req->member;
        $GROUPMEMBER->groupId = $req->groupId;
        $GROUPMEMBER->status = 'member';
        $result = $GROUPMEMBER->create();
    }

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'DELETEINVITATION') {
    $REQUEST = new GroupAndMemberRequest($_POST['row']);

    $result = $REQUEST->delete();

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'REMOVEMEMBER') {

    $result = GroupMember::removeMember($_POST['member'], $_POST['group']);
    if ($result) {
        $res = GroupAndMemberRequest::removeMember($_POST['member'], $_POST['group']);
    }

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}