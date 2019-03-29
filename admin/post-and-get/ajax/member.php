<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'FINDMEMBER') {
    
    $MEMBERS = Member::getMembersByKeyword($_POST['keyword']);

    header('Content-Type: application/json');
    echo json_encode($MEMBERS);
    exit();
}