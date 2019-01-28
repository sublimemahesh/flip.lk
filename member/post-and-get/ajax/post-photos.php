<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] === 'GETPOSTPHOTOS') {

    $photos = PostImage::getPhotosByPostId($_POST['id']);

    $arr = array();

    foreach ($photos as $photo) {
        array_push($arr, "../upload/post/thumb/" . $photo['image_name']);
    }
    header('Content-type: application/json');
    echo json_encode($arr);
}

