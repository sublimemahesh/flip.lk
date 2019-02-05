<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] === 'GETPOST') {

    $post = Post::getPostsByMember($_POST['member']);

//    $arr = array();
//
//    foreach ($photos as $photo) {
//        array_push($arr, "../upload/post/" . $photo['image_name']);
//    }
    header('Content-type: application/json');
    echo json_encode($post);
}

if ($_POST['option'] === 'GETPOSTBYID') {

    $POST = new Post($_POST['post']);

    header('Content-type: application/json');
    echo json_encode($POST);
}

if ($_POST['option'] === 'DELETEPOST') {

    $images = PostImage::getPhotosByPostId($_POST['post']);
    foreach ($images as $img) {
        unlink(Helper::getSitePath() . "upload/post/" . $img['image_name']);
        unlink(Helper::getSitePath() . "upload/post/thumb/" . $img['image_name']);
        unlink(Helper::getSitePath() . "upload/post/thumb2/" . $img['image_name']);

        $POSTIMAGES = new PostImage($img['id']);
        $POSTIMAGES->delete();
    }

    $POST = new Post($_POST['post']);
    $result = $POST->delete();

    header('Content-type: application/json');
    echo json_encode($result);
}

