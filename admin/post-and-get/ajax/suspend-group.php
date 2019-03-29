<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'SUSPEND') {
    $GROUP = new Group($_POST['id']);

    $GROUP->isSuspend = 1;
    $result = $GROUP->suspendGroup();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'REMOVESUSPEND') {
    $GROUP = new Group($_POST['id']);

    $GROUP->isSuspend = 0;
    $result = $GROUP->suspendGroup();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}