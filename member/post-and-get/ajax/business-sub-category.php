<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
if ($_POST['option'] == 'GETSUBCATEGORY') {

    $SUBCATEGORY = BusinessSubCategory::getSubCategoriesByCategory($_POST['category']);

    header('Content-Type: application/json');
    echo json_encode($SUBCATEGORY);
    exit();
}