<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['edit-group'])) {

    $GROUP = new Group($_POST['id']);
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
    $GROUP->status = 1;

    $dir_dest = '../../upload/group/';
    $dir_dest1 = '../../upload/group/cover-picture/';

    $handle = new Upload($_FILES['group_profile']);
    $handle1 = new Upload($_FILES['group_cover']);
    $imgName = null;
    $imgName1 = null;
    $img = $_POST['oldProfilePic'];
    $img1 = $_POST['oldCoverPic'];

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
    
    if ($handle1->uploaded) {
        $handle1->image_resize = true;
        $handle1->file_new_name_body = TRUE;
        $handle1->file_overwrite = TRUE;
        $handle1->file_new_name_ext = FALSE;
        $handle1->image_ratio_crop = 'C';
        $handle1->file_new_name_body = $img1;
        $handle1->image_x = 1154;
        $handle1->image_y = 385;

        $handle1->Process($dir_dest1);

        if ($handle1->processed) {
            $info = getimagesize($handle1->file_dst_pathname);
            $imgName1 = $handle1->file_dst_name;
        }
        $handle1->image_resize = true;
        $handle1->file_new_name_body = TRUE;
        $handle1->file_overwrite = TRUE;
        $handle1->file_new_name_ext = FALSE;
        $handle1->image_ratio_crop = 'C';
        $handle1->file_new_name_body = $img1;
        $handle1->image_x = 387;
        $handle1->image_y = 168;

        $handle1->Process($dir_dest1.'thumb/');

        if ($handle1->processed) {
            $info = getimagesize($handle1->file_dst_pathname);
            $imgName1 = $handle1->file_dst_name;
        }
    }
    $GROUP->profilePicture = $_POST['oldProfilePic'];
    $GROUP->coverPicture = $_POST['oldCoverPic'];



    $VALID->check($GROUP, [
        'name' => ['required' => TRUE],
        'email' => ['required' => TRUE],
        'category' => ['required' => TRUE],
        'subCategory' => ['required' => TRUE],
        'district' => ['required' => TRUE],
        'city' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $GROUP->update();
        $url = explode("?", $_SERVER['HTTP_REFERER']);

        if ($result) {
            if (!isset($_SESSION)) {
                session_start();
            }
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

if (isset($_POST['add-member'])) {
    date_default_timezone_set('Asia/Colombo');
    $date = date('Y-m-d H:i:s');

    $GROUPMEMBER = new GroupMember(NULL);
    $VALID = new Validator();
    $GROUPMEMBER->member = $_POST['member'];
    $GROUPMEMBER->groupId = $_POST['group_id'];
    $GROUPMEMBER->joinedAt = $date;
    $GROUPMEMBER->status = 'member';


    $VALID->check($GROUPMEMBER, [
        'member' => ['required' => TRUE],
        'groupId' => ['required' => TRUE],
        'joinedAt' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $GROUPMEMBER->create();
        $url = explode("?", $_SERVER['HTTP_REFERER']);

        if ($result) {
            if (!isset($_SESSION)) {
                session_start();
            }
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