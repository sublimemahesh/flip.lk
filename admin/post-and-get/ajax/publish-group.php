<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'PUBLISH') {
    $GROUP = new Group($_POST['id']);

    $GROUP->status = 1;
    $result = $GROUP->updateStatus();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'UNPUBLISH') {
    $GROUP = new Group($_POST['id']);

    $GROUP->status = 0;
    $result = $GROUP->updateStatus();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}