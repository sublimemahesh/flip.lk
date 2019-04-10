<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] == 'UPDATE') {

    $NOTIFICATION = new Notification($_POST['id']);

    $result = $NOTIFICATION->update();
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}
