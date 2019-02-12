<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if (isset($_POST['upload-profile'])) {

    $dir_dest = '../../../upload/member/';

    $handle = new Upload($_FILES['profile-picture']);
    $imgName = null;

    if ($_POST['profile']) {
        $img = $_POST['profile'];
        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = FALSE;
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $img;
            $handle->image_x = 250;
            $handle->image_y = 250;

            $handle->Process($dir_dest);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['image'] = $imgName;
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
            $handle->image_x = 250;
            $handle->image_y = 250;

            $handle->Process($dir_dest);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['image'] = $imgName;
        header('Content-Type: application/json');
        echo json_encode($imgName);
        exit();
    }
}

if (isset($_POST['update-profile'])) {

    $MEMBER = new Member($_POST["member"]);
    $folder = '../../../upload/member/';
    $imgName = Helper::randamId();

    $handle = new Upload($_FILES['profile-picture']);


    if (empty($MEMBER->profilePicture)) {
        if ($handle->uploaded) {

            $handle->image_resize = true;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $imgName;

            $handle->image_x = 250;
            $handle->image_y = 250;

            $handle->Process($folder);

            if ($handle->processed) {


                Member::ChangeProPic($_POST["member"], $handle->file_dst_name);
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
        unlink("$folder" . $MEMBER->profilePicture);
        if ($handle->uploaded) {

            $handle->image_resize = true;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $imgName;

            $handle->image_x = 250;
            $handle->image_y = 250;

            $handle->Process($folder);

            if ($handle->processed) {


                Member::ChangeProPic($_POST["member"], $handle->file_dst_name);
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
    }
}

 