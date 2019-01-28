<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['save-post'])) {

    $POST = new Post(NULL);

    $POST->member = $_POST['member'];
    $POST->description = $_POST['description'];

    $result = $POST->create();

    if ($result) {

        foreach ($_POST['post-all-images'] as $key => $img) {
            $key++;
            $POSTIMAGES = new PostImage(NULL);
            $POSTIMAGES->post = $result->id;
            $POSTIMAGES->imageName = $img;
            $POSTIMAGES->sort = $key;
            $res = $POSTIMAGES->create();
        }
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?message=10');
        exit();
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?message=21');
        exit();
    }
}

if (isset($_POST['edit-post'])) {

    $POST = new Post($_POST['id']);

    $POST->description = $_POST['description'];

    $result = $POST->update();
    $url = explode("?", $_SERVER['HTTP_REFERER']);
    if ($result) {

        foreach ($_POST['post-all-images'] as $key => $img) {
            $key++;
            $POSTIMAGES = new PostImage(NULL);
            $POSTIMAGES->post = $result->id;
            $POSTIMAGES->imageName = $img;
            $POSTIMAGES->sort = $key;
            $res = $POSTIMAGES->create();
        }
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?message=10');
        exit();
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?message=21');
        exit();
    }
}