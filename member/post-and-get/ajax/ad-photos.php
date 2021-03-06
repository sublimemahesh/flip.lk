<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] === 'GETADPHOTOS') {

    $photos = AdvertisementImage::getPhotosByAdId($_POST['id']);

    $arr1 = array();
    $arr2 = array();

    foreach ($photos as $photo) {
        array_push($arr1, "../upload/advertisement/" . $photo['image_name']);
        array_push($arr2, "../upload/advertisement/thumb/" . $photo['image_name']);
    }
    $result['full'] = $arr1;
    $result['thumb'] = $arr2;
    
    header('Content-type: application/json');
    echo json_encode($result);
}

