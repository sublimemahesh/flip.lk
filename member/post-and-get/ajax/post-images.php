<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if (isset($_POST['upload-post-image'])) {
    $dir_dest = '../../../upload/post/';
    $imgName = Helper::randamId();
//    dd($_FILES['post-image']['name'] == '');
    if ($_FILES['post-image']['name'] == '') {
        $handle = new Upload($_FILES['upload-other-images']);
    } else {
        $handle = new Upload($_FILES['post-image']);
    }
    if ($handle->uploaded) {

        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $imgName;

        $image_dst_x = $handle->image_dst_x;
        $image_dst_y = $handle->image_dst_y;
        $newSize = Helper::calImgResize(600, $image_dst_x, $image_dst_y);

        $image_x = (int) $newSize[0];
        $image_y = (int) $newSize[1];

        $handle->image_x = $image_x;
        $handle->image_y = $image_y;
        $handle->Process($dir_dest);

        if ($handle->processed) {
            if ($_FILES['post-image']['name'] == '') {
                $handle1 = new Upload($_FILES['upload-other-images']);
            } else {
                $handle1 = new Upload($_FILES['post-image']);
            }
            if ($handle1->uploaded) {
                $handle1->image_resize = true;
                $handle1->file_new_name_ext = 'jpg';
                $handle1->image_ratio_crop = 'C';
                $handle1->file_new_name_body = $imgName;
                $handle1->image_x = 900;
                $handle1->image_y = 500;
                $handle1->Process($dir_dest . '/thumb');
                if ($handle1->processed) {
                    if ($_FILES['post-image']['name'] == '') {
                        $handle2 = new Upload($_FILES['upload-other-images']);
                    } else {
                        $handle2 = new Upload($_FILES['post-image']);
                    }
                    if ($handle2->uploaded) {
                        $handle2->image_resize = true;
                        $handle2->file_new_name_ext = 'jpg';
                        $handle2->image_ratio_crop = 'C';
                        $handle2->file_new_name_body = $imgName;
                        $handle2->image_x = 100;
                        $handle2->image_y = 100;
                        $handle2->Process($dir_dest . '/thumb2');
                        if ($handle2->processed) {
                            $handle2->Clean();
                            header('Content-Type: application/json');
                            $result = [
                                "filename" => $handle2->file_dst_name,
                                "message" => 'success'
                            ];
                            echo json_encode($result);
                            exit();
                        } else {
                            header('Content-Type: application/json');
                            $result = [
                                "message" => 'error'
                            ];
                            echo json_encode($result);
                            exit();
                        }
                    } else {
                        header('Content-Type: application/json');
                        $result = [
                            "message" => 'error'
                        ];
                        echo json_encode($result);
                        exit();
                    }
                } else {
                    header('Content-Type: application/json');
                    $result = [
                        "message" => 'error'
                    ];
                    echo json_encode($result);
                    exit();
                }
            } else {
                header('Content-Type: application/json');
                $result = [
                    "message" => 'error'
                ];
                echo json_encode($result);
                exit();
            }
        } else {
            header('Content-Type: application/json');
            $result = [
                "message" => 'error'
            ];
            echo json_encode($result);
            exit();
        }
    } else {
        header('Content-Type: application/json');
        $result = [
            "message" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
}

if ($_POST['option'] == 'DELETEIMAGE') {
//    dd($_POST['image_name']);
    unlink(Helper::getSitePath() . "upload/post/" . $_POST['image_name'] . ".jpg");
    unlink(Helper::getSitePath() . "upload/post/thumb/" . $_POST['image_name'] . ".jpg");
    unlink(Helper::getSitePath() . "upload/post/thumb2/" . $_POST['image_name'] . ".jpg");
    header('Content-Type: application/json');
    $result = 'success';

    echo json_encode($result);
    exit();
}


if ($_POST['option'] == 'DELETEPOSTIMAGES') {
    
    $images =  PostImage::getPhotosByPostId($_POST['post']);
    foreach ($images as $img) {
        unlink(Helper::getSitePath() . "upload/post/" . $img['image_name']);
        unlink(Helper::getSitePath() . "upload/post/thumb/" . $img['image_name']);
        unlink(Helper::getSitePath() . "upload/post/thumb2/" . $img['image_name']);
        
        $POSTIMAGES = new PostImage($img['id']);
        $POSTIMAGES->delete();
    }

    header('Content-Type: application/json');
    $result = 'success';

    echo json_encode($result);
    exit();
}