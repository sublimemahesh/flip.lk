<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'delete') {
    $SUBCATEGORY = new BusinessSubCategory($_POST['id']);

    $result = $SUBCATEGORY->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}