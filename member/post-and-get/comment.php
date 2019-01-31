<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['post-comment'])) {

    $COMMENT = new PostComment(NULL);

    $COMMENT->post = $_POST['post'];
    $COMMENT->member = $_POST['member'];
    $COMMENT->comment = $_POST['comment'];
    $COMMENT->imageName = $_POST['image_name'];

    $result = $COMMENT->create();
    
    if ($result) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?message=21');
        exit();
    }
}