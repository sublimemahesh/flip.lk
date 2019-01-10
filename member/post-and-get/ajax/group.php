<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'UPDATESTATUS') {
    
    $GROUP = new Group($_POST['id']);
    $GROUP->status= $_POST['status'];
    
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