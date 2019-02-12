<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if (isset($_POST['upload-cover'])) {

    $dir_dest = '../../../upload/member/cover-picture/';
    $dir_dest_thumb = '../../../upload/member/cover-picture/thumb/';

    $handle = new Upload($_FILES['cover-picture']);
    $imgName = null;

    if ($_POST['cover']) {
        $img = $_POST['cover'];
        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = FALSE;
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $img;
            $handle->image_x = 1154;
            $handle->image_y = 385;

            $handle->Process($dir_dest);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = FALSE;
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $img;
            $handle->image_x = 387;
            $handle->image_y = 168;

            $handle->Process($dir_dest_thumb);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
        }

        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['cover'] = $imgName;
        header('Content-Type: application/json');
        echo json_encode($imgName);
        exit();
    } else {

        $img = Helper::randamId();

        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $img;
            $handle->image_x = 1321;
            $handle->image_y = 441;

            $handle->Process($dir_dest);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $img;
            $handle->image_x = 387;
            $handle->image_y = 168;

            $handle->Process($dir_dest_thumb);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['cover'] = $imgName;
        header('Content-Type: application/json');
        echo json_encode($imgName);
        exit();
    }
}

if (isset($_POST['update-cover'])) {

    $MEMBER = new Member($_POST["member"]);
    $folder = '../../../upload/member/cover-picture/';
    $imgName = Helper::randamId();

    $handle = new Upload($_FILES['cover-picture']);
    $handle1 = new Upload($_FILES['cover-picture']);


    if (empty($MEMBER->coverPicture)) {
        if ($handle->uploaded) {

            $handle->image_resize = true;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $imgName;

            $handle->image_x = 1321;
            $handle->image_y = 441;

            $handle->Process($folder);

            if ($handle->processed) {
                $handle1->image_resize = true;
                $handle1->file_new_name_ext = 'jpg';
                $handle1->image_ratio_crop = 'C';
                $handle1->file_new_name_body = $imgName;

                $handle1->image_x = 387;
                $handle1->image_y = 168;

                $handle1->Process($folder . "thumb/");

                if ($handle->processed) {
                    Member::ChangeCoverPic($_POST["member"], $handle->file_dst_name);
                    header('Content-Type: application/json');

                    $result = [
                        "filename" => $handle->file_dst_name,
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
        unlink($folder . $MEMBER->coverPicture);
        unlink($folder. "thumb/" . $MEMBER->coverPicture);
        if ($handle->uploaded) {

            $handle->image_resize = true;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $imgName;

            $handle->image_x = 1321;
            $handle->image_y = 441;

            $handle->Process($folder);

            if ($handle->processed) {
                $handle1->image_resize = true;
                $handle1->file_new_name_ext = 'jpg';
                $handle1->image_ratio_crop = 'C';
                $handle1->file_new_name_body = $imgName;

                $handle1->image_x = 387;
                $handle1->image_y = 168;

                $handle1->Process($folder . "thumb/");
                if ($handle1->processed) {

                    Member::ChangeCoverPic($_POST["member"], $handle->file_dst_name);
                    header('Content-Type: application/json');

                    $result = [
                        "filename" => $handle->file_dst_name,
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
    }
}