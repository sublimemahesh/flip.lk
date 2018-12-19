<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create-sub-category'])) {
    $SUBCATEGORY = new BusinessSubCategory(NULL);
    $VALID = new Validator();

    $SUBCATEGORY->business_category = filter_input(INPUT_POST, 'id');
    $SUBCATEGORY->name = filter_input(INPUT_POST, 'name');

    $dir_dest = '../../upload/business_subcategory/';

    $handle = new Upload($_FILES['image_name']);

    $imgName = null;
    $img = Helper::randamId();

    if ($handle->uploaded) {
        $handle->image_resize = true;
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

    $SUBCATEGORY->image_name = $imgName;

    $VALID->check($SUBCATEGORY, [
        'business_category' => ['required' => TRUE],
        'name' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $SUBCATEGORY->create();

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

if (isset($_POST['edit-sub-category'])) {
    $dir_dest = '../../upload/business_subcategory/';

    $handle = new Upload($_FILES['image_name']);
    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST["oldImageName"];
        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }
    $SUBCATEGORY = new BusinessSubCategory($_POST['id']);
    
    $SUBCATEGORY->business_category = $_POST['catid'];
    $SUBCATEGORY->name = $_POST['name'];
    $SUBCATEGORY->image_name = $_POST["oldImageName"];

    $VALID = new Validator();
    $VALID->check($SUBCATEGORY, [
        'business_category' => ['required' => TRUE],
        'name' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $SUBCATEGORY->update();

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

if (isset($_POST['save-arrange'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;

        $SUBCATEGORY = BusinessSubCategory::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}