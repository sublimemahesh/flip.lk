<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create-group'])) {

    $GROUP = new Group(NULL);

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
    $GROUP->member = $_POST['member'];
    $GROUP->status = 1;

    $result = $GROUP->create();
    $url = explode("?", $_SERVER['HTTP_REFERER']);
    if ($result) {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION['group-image']);
        unset($_SESSION['group-cover']);


        header('Location: ' . $url[0] . '?message=10');
        exit();
    } else {
        header('Location: ' . $url[0] . '?message=21');
        exit();
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