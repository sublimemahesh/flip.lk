<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create-group'])) {
    $GROUP = new Group(NULL);
    $VALID = new Validator();
    $GROUP->name = $_POST['group_name'];
    $GROUP->email = $_POST['email'];
    $GROUP->phoneNumber = $_POST['phone_number'];
    $GROUP->category = $_POST['category'];
    $GROUP->subCategory = $_POST['sub_category'];
    $GROUP->address = $_POST['address'];
    $GROUP->district = $_POST['district'];
    $GROUP->city = $_POST['city'];
    $GROUP->description = $_POST['description'];
    $GROUP->profilePicture = $_POST['group_profile'];
    $GROUP->coverPicture = $_POST['group_cover'];
    dd($_POST['group_profile']);
//    $GROUP->member = $_POST['member'];
    $GROUP->status = 1;

    $dir_dest = '../../upload/group/profile/';

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
        dd($imgName);
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
    }





    $VALID->check($GROUP, [
        'name' => ['required' => TRUE],
        'email' => ['required' => TRUE],
        'category' => ['required' => TRUE],
        'district' => ['required' => TRUE],
        'city' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $GROUP->create();
        $url = explode("?", $_SERVER['HTTP_REFERER']);

        if ($result) {
            if (!isset($_SESSION)) {
                session_start();
            }
            unset($_SESSION['group-image']);
            unset($_SESSION['group-cover']);
            $VALID->addError("Your data was saved successfully", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['ERRORS'] = $VALID->errors();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}

if (isset($_POST['edit-group'])) {

    $GROUP = new Group($_POST['id']);

    $GROUP->name = $_POST['group_name'];
    $GROUP->email = $_POST['email'];
    $GROUP->phoneNumber = $_POST['phone_number'];
    $GROUP->category = $_POST['category'];
    $GROUP->subCategory = $_POST['sub_category'];
    $GROUP->address = $_POST['address'];
    $GROUP->district = $_POST['district'];
    $GROUP->city = $_POST['city'];
    $GROUP->description = $_POST['description'];
    $GROUP->profilePicture = $_POST['group_profile'];
    $GROUP->coverPicture = $_POST['group_cover'];

    $result = $GROUP->update();
    $url = explode("?", $_SERVER['HTTP_REFERER']);
    if ($result) {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION['group-image']);
        unset($_SESSION['group-cover']);


        header('Location: ' . $url[0] . '?id=' . $_POST['id'] . '&message=10');
        exit();
    } else {
        header('Location: ' . $url[0] . '?id=' . $_POST['id'] . '&message=21');
        exit();
    }
}    