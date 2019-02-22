<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['update'])) {
    
    $ADVERTISEMENT = new Advertisement($_POST['id']);
    $ADVERTISEMENT->title = $_POST['title'];
    $ADVERTISEMENT->description = $_POST['description'];
    $ADVERTISEMENT->city = $_POST['city'];
    $ADVERTISEMENT->address = $_POST['address'];
    $ADVERTISEMENT->website = $_POST['website'];
    $ADVERTISEMENT->status = '1';

    $VALID = new Validator();

    $VALID->check($ADVERTISEMENT, [
        'title' => ['required' => TRUE],
        'city' => ['required' => TRUE],
        'address' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $ADVERTISEMENT->update();
        if ($result) {
            foreach ($_POST["post-all-images"] as $key => $img) {
                $key++;
                $ADIMAGES = new AdvertisementImage(NULL);
                $ADIMAGES->advertisement = $_POST['id'];
                $ADIMAGES->imageName = $img;
                $ADIMAGES->sort = $key;
                $res = $ADIMAGES->create();
            }
        }

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

