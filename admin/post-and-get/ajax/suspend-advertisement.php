<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'SUSPEND') {
    $ADVERTISEMENT = new Advertisement($_POST['id']);

    $ADVERTISEMENT->isSuspend = 1;
    $result = $ADVERTISEMENT->suspendAdvertisement();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'REMOVESUSPEND') {
    $ADVERTISEMENT = new Advertisement($_POST['id']);

    $ADVERTISEMENT->isSuspend = 0;
    $result = $ADVERTISEMENT->suspendAdvertisement();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}