<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'CREATESESSION') {
    if (!isset($_SESSION)) {
        session_start();
    }
    $url = $_POST['page_url'];
    $_SESSION['back_url'] = $url;

    header('Content-type: application/json');
    echo json_encode(true);
}