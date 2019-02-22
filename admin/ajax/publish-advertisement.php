<?php
include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] == 'PUBLISH') {
    $ADVERTISEMENT = new Advertisement($_POST['id']);

    $ADVERTISEMENT->status = 1;
    $result = $ADVERTISEMENT->updateStatus();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'UNPUBLISH') {
    $ADVERTISEMENT = new Advertisement($_POST['id']);

    $ADVERTISEMENT->status = 0;
    $result = $ADVERTISEMENT->updateStatus();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}