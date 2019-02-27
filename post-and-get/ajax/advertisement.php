<?php
include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] === 'GETALLADS') {

    $ad = Advertisement::all();
  
    header('Content-type: application/json');
    echo json_encode($ad);
}
