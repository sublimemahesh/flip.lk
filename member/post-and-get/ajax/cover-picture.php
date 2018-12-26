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
            $handle->image_x = 1268;
            $handle->image_y = 423;

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
            $handle->image_x = 1268;
            $handle->image_y = 423;

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