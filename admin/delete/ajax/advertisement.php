<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'delete') {
    $ADVERTISEMENT = new Advertisement($_POST['id']);

    $result = $ADVERTISEMENT->deleteAdvertisement();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}