<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'UPDATESTATUS') {
    
    $MEMBER = new Member($_POST['id']);
    $MEMBER->status= $_POST['status'];
    
    $result = $MEMBER->updateStatus();

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}
if ($_POST['option'] == 'DELETEGROUP') {
    
    $MEMBER = new Member($_POST['id']);
    
    $result = $MEMBER->delete();

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}