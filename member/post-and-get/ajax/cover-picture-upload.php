<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if (isset($_POST['upload-cover'])) {

    $MEMBER = new Member($_POST['id']);

    $MEMBER->coverPicture = $_POST['cover'];
    $result = $MEMBER->updateCoverPicture();
    $back = $_POST['back_url'];
    
    header('Content-Type: application/json');
    $arr = array();
    if ($result) {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION['cover']);
        if (empty($back)) {
            $arr['response'] = 'success';
        } else {
            unset($_SESSION["back_url"]);
            $arr['back'] = $back;
        }
        
    } else {
        $arr['response'] = 'error';
    }

    echo json_encode($arr);
    exit();
}