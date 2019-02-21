<?php
include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] == 'SUSPEND') {
    $MEMBER = new Member($_POST['id']);

    $MEMBER->isSuspend = 1;
    $result = $MEMBER->suspendMember();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'REMOVESUSPEND') {
    $MEMBER = new Member($_POST['id']);

    $MEMBER->isSuspend = 0;
    $result = $MEMBER->suspendMember();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}