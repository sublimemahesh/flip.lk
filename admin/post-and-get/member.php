<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {
    $MEMBER = new Member(NULL);
    $VALID = new Validator();

    $MEMBER->firstName = $_POST['first_name'];
    $MEMBER->lastName = $_POST['last_name'];
    $MEMBER->email = $_POST['email'];
    $MEMBER->password = $_POST['password'];

    $VALID->check($MEMBER, [
        'firstName' => ['required' => TRUE],
        'lastName' => ['required' => TRUE],
        'email' => ['required' => TRUE],
        'password' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $MEMBER->create();
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

if (isset($_POST['update'])) {

    $dir_dest_profile = '../../upload/member/';
    $dir_dest_cover = '../../upload/member/cover-picture/';

    $handle = new Upload($_FILES['profile_picture']);
    $handle1 = new Upload($_FILES['cover_picture']);
    $imgName = null;
    $imgName1 = null;
    if ($_POST["oldProfileImageName"]) {
        $pro = $_POST["oldProfileImageName"];
        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = FALSE;
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $pro;
            $handle->image_x = 250;
            $handle->image_y = 250;

            $handle->Process($dir_dest_profile);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
        }
    } else {
        $pro = Helper::randamId();
        if ($handle->uploaded) {
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $pro;
            $handle->image_x = 250;
            $handle->image_y = 250;

            $handle->Process($dir_dest_profile);

            if ($handle->processed) {
                $info = getimagesize($handle->file_dst_pathname);
                $imgName = $handle->file_dst_name;
            }
        }
    }

    if ($_POST["oldCoverImageName"]) {
        $cover = $_POST["oldCoverImageName"];
        if ($handle1->uploaded) {
            $handle1->image_resize = true;
            $handle1->file_new_name_body = TRUE;
            $handle1->file_overwrite = TRUE;
            $handle1->file_new_name_ext = FALSE;
            $handle1->image_ratio_crop = 'C';
            $handle1->file_new_name_body = $pro;
            $handle1->image_x = 1154;
            $handle1->image_y = 385;

            $handle1->Process($dir_dest_cover);

            if ($handle1->processed) {
                $info = getimagesize($handle1->file_dst_pathname);
                $imgName1 = $handle1->file_dst_name;
            }
            $handle1->image_resize = true;
            $handle1->file_new_name_body = TRUE;
            $handle1->file_overwrite = TRUE;
            $handle1->file_new_name_ext = FALSE;
            $handle1->image_ratio_crop = 'C';
            $handle1->file_new_name_body = $pro;
            $handle1->image_x = 387;
            $handle1->image_y = 168;

            $handle1->Process($dir_dest_cover . "/thumb");

            if ($handle1->processed) {
                $info = getimagesize($handle1->file_dst_pathname);
                $imgName1 = $handle1->file_dst_name;
            }
        }
    } else {
        $cover = Helper::randamId();
        if ($handle1->uploaded) {
            $handle1->image_resize = true;
            $handle1->file_new_name_body = TRUE;
            $handle1->file_overwrite = TRUE;
            $handle1->file_new_name_ext = 'jpg';
            $handle1->image_ratio_crop = 'C';
            $handle1->file_new_name_body = $pro;
            $handle1->image_x = 1154;
            $handle1->image_y = 385;

            $handle1->Process($dir_dest_cover);

            if ($handle1->processed) {
                $info = getimagesize($handle1->file_dst_pathname);
                $imgName1 = $handle1->file_dst_name;
            }
            $handle1->image_resize = true;
            $handle1->file_new_name_body = TRUE;
            $handle1->file_overwrite = TRUE;
            $handle1->file_new_name_ext = 'jpg';
            $handle1->image_ratio_crop = 'C';
            $handle1->file_new_name_body = $pro;
            $handle1->image_x = 387;
            $handle1->image_y = 168;

            $handle1->Process($dir_dest_cover . "/thumb");

            if ($handle1->processed) {
                $info = getimagesize($handle1->file_dst_pathname);
                $imgName1 = $handle1->file_dst_name;
            }
        }
    }

    $MEMBER = new Member($_POST['id']);

    $MEMBER->firstName = $_POST['first_name'];
    $MEMBER->lastName = $_POST['last_name'];
    $MEMBER->phoneNumber = $_POST['phone_number'];
    $MEMBER->district = $_POST['district'];
    $MEMBER->city = $_POST['city'];
    $MEMBER->address = $_POST['address'];
    $MEMBER->dob = $_POST['dob'];
    $MEMBER->occupation = $_POST['occupation'];
    $MEMBER->gender = $_POST['gender'];
    $MEMBER->civilStatus = $_POST['civil_status'];
    $MEMBER->aboutMe = $_POST['short_description'];

    if ($_POST["oldProfileImageName"]) {
        $MEMBER->profilePicture = $_POST["oldProfileImageName"];
    } else {
        $MEMBER->profilePicture = $imgName;
        $result1 = $MEMBER->updateProfilePicture();
    }

    if ($_POST["oldCoverImageName"]) {
        $MEMBER->coverPicture = $_POST["oldCoverImageName"];
    } else {
        $MEMBER->coverPicture = $imgName1;
        $result2 = $MEMBER->updateCoverPicture();
    }

    $VALID = new Validator();

    $VALID->check($MEMBER, [
        'firstName' => ['required' => TRUE],
        'lastName' => ['required' => TRUE],
        'phoneNumber' => ['required' => TRUE],
        'district' => ['required' => TRUE],
        'city' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'dob' => ['required' => TRUE],
        'occupation' => ['required' => TRUE],
        'gender' => ['required' => TRUE],
        'civilStatus' => ['required' => TRUE],
        'aboutMe' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        
        $result = $MEMBER->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
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