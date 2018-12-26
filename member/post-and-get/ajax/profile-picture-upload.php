<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if (isset($_POST['upload-profile'])) {

    $MEMBER = new Member($_POST['id']);

    $MEMBER->profilePicture = $_POST['profile'];
    $result = $MEMBER->updateProfilePicture();
    
    header('Content-Type: application/json');
    $arr = array();
    if($result) {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION['image']);
        $arr['response'] = 'success';
    } else {
        $arr['response'] = 'error';
    }
    
echo json_encode($arr);
    exit();
    
}