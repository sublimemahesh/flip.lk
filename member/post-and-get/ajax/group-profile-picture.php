<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if (isset($_POST['upload-group-profile'])) {
    $dir_dest = '../../../upload/group/';

    $handle = new Upload($_FILES['group-profile-picture']);
    $imgName = null;

    if ($_POST['group_profile']) {
        $img = $_POST['group_profile'];
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
        $_SESSION['group-image'] = $imgName;
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
        $_SESSION['group-image'] = $imgName;
        header('Content-Type: application/json');
        echo json_encode($imgName);
        exit();
    }
}