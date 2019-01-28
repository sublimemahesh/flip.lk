<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'GETMEMBERS') {
    
    $MEMBERS = Member::getAllMembersWithoutThis($_POST['id']);
    $arr = array();

    foreach ($MEMBERS as $member) {
        array_push($arr, "{image: '../upload/member/" . $member['profile_picture'] . "', name: " . $member['first_name'] . " " . $member['last_name'] . ", message:'12 Friends in Common', icon:'olymp-happy-face-icon'}");
    }

    header('Content-Type: application/json');
    echo json_encode($arr);
    exit();
}
if ($_POST['option'] == 'FINDMEMBER') {
    
    $MEMBERS = Member::getMembersByKeyword($_POST['keyword']);

    header('Content-Type: application/json');
    echo json_encode($MEMBERS);
    exit();
}
if ($_POST['option'] == 'GETMEMBER') {
    
    $MEMBER = new Member($_POST['member']);

    header('Content-Type: application/json');
    echo json_encode($MEMBER);
    exit();
}
