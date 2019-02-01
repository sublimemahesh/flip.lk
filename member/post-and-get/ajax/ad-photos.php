<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] === 'GETADPHOTOS') {

    $photos = AdvertisementImage::getPhotosByAdId($_POST['id']);

    $arr = array();

    foreach ($photos as $photo) {
        array_push($arr, "../upload/advertisement/thumb/" . $photo['image_name']);
    }
    header('Content-type: application/json');
    echo json_encode($arr);
}

