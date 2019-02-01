<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] === 'SHAREAD') {

    $POST = new Post(NULL);
    $POST->member = $_POST['member'];
    $POST->sharedAd = $_POST['ad'];
    $POST->description = $_POST['description'];
    
    $result = $POST->shareAd();

    header('Content-type: application/json');
    echo json_encode($result);
}
