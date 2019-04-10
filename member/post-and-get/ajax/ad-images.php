<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if (isset($_POST['upload-ad-image'])) {
    $dir_dest = '../../../upload/advertisement/';
    $imgName = Helper::randamId();

    $handle = new Upload($_FILES['upload-other-images']);
    if ($handle->uploaded) {

        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $imgName;

        $image_dst_x = $handle->image_dst_x;
        $image_dst_y = $handle->image_dst_y;

        if ($image_dst_y > 900) {
            $newSize = Helper::calImgResize(900, $image_dst_x, $image_dst_y);

            $image_x = (int) $newSize[0];
            $image_y = (int) $newSize[1];

            $handle->image_x = $image_x;
            $handle->image_y = $image_y;
        } else {
            $handle->image_x = $image_dst_x;
            $handle->image_y = $image_dst_y;
        }
        $handle->Process($dir_dest);

        if ($handle->processed) {

            $handle1 = new Upload($_FILES['upload-other-images']);

            if ($handle1->uploaded) {
                $handle1->image_resize = true;
                $handle1->file_new_name_ext = 'jpg';
                $handle1->image_ratio_crop = 'C';
                $handle1->file_new_name_body = $imgName;
                $handle1->image_x = 500;
                $handle1->image_y = 500;
                $handle1->Process($dir_dest . '/thumb');
                if ($handle1->processed) {
                    $handle2 = new Upload($_FILES['upload-other-images']);
                    if ($handle2->uploaded) {
                        $handle2->image_resize = true;
                        $handle2->file_new_name_ext = 'jpg';
                        $handle2->image_ratio_crop = 'C';
                        $handle2->file_new_name_body = $imgName;
                        $handle2->image_x = 100;
                        $handle2->image_y = 100;
                        $handle2->Process($dir_dest . '/thumb2');
                        if ($handle2->processed) {
                            $handle3 = new Upload($_FILES['upload-other-images']);
                            if ($handle3->uploaded) {
                                $handle3->image_resize = true;
                                $handle3->file_new_name_ext = 'jpg';
                                $handle3->image_ratio_crop = 'C';
                                $handle3->file_new_name_body = $imgName;
                                $handle3->image_x = 350;
                                $handle3->image_y = 200;
                                $handle3->Process($dir_dest . '/thumb3');
                                if ($handle3->processed) {
                                    $handle3->Clean();
                                    header('Content-Type: application/json');
                                    $result = [
                                        "filename" => $handle3->file_dst_name,
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
    unlink(Helper::getSitePath() . "upload/advertisement/" . $_POST['image_name'] . ".jpg");
    unlink(Helper::getSitePath() . "upload/advertisement/thumb/" . $_POST['image_name'] . ".jpg");
    unlink(Helper::getSitePath() . "upload/advertisement/thumb2/" . $_POST['image_name'] . ".jpg");
    header('Content-Type: application/json');
    $result = 'success';

    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'DELETEADIMAGES') {

    $images = AdvertisementImage::getPhotosByAdId($_POST['ad']);
    foreach ($images as $img) {
        unlink(Helper::getSitePath() . "upload/advertisement/" . $img['image_name']);
        unlink(Helper::getSitePath() . "upload/advertisement/thumb/" . $img['image_name']);
        unlink(Helper::getSitePath() . "upload/advertisement/thumb2/" . $img['image_name']);

        $ADIMAGES = new AdvertisementImage($img['id']);
        $ADIMAGES->delete();
    }

    header('Content-Type: application/json');
    $result = 'success';

    echo json_encode($result);
    exit();
}

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