<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'SAVEAD') {
    
    $ADVERTISEMENT = new Advertisement(NULL);
    $ADVERTISEMENT->groupId = $_POST['group'];
    $ADVERTISEMENT->member = $_POST['member'];
    $ADVERTISEMENT->title = $_POST['title'];
    $ADVERTISEMENT->description = $_POST['description'];
    $ADVERTISEMENT->city = $_POST['city'];
    $ADVERTISEMENT->address = $_POST['address'];
    $ADVERTISEMENT->category = $_POST['category'];
    $ADVERTISEMENT->subCategory = $_POST['subcategory'];
    $ADVERTISEMENT->website = $_POST['website'];
    $ADVERTISEMENT->status = '1';
   
    $result = $ADVERTISEMENT->create();
    if($result) {
        foreach ($_POST["images"] as $key => $img) {
            $key++;
            $ADIMAGES = new AdvertisementImage(NULL);
            $ADIMAGES->advertisement = $result['id'];
            $ADIMAGES->imageName = $img["value"];
            $ADIMAGES->sort = $key;
            $res = $ADIMAGES->create();
        }
    }

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'EDITAD') {
    
    $ADVERTISEMENT = new Advertisement($_POST['id']);
    $ADVERTISEMENT->title = $_POST['title'];
    $ADVERTISEMENT->description = $_POST['description'];
    $ADVERTISEMENT->city = $_POST['city'];
    $ADVERTISEMENT->address = $_POST['address'];
    $ADVERTISEMENT->website = $_POST['website'];
    $ADVERTISEMENT->status = '1';
   
    $result = $ADVERTISEMENT->update();
    if($result) {
        foreach ($_POST["images"] as $key => $img) {
            $key++;
            $ADIMAGES = new AdvertisementImage(NULL);
            $ADIMAGES->advertisement = $_POST['id'];
            $ADIMAGES->imageName = $img["value"];
            $ADIMAGES->sort = $key;
            $res = $ADIMAGES->create();
        }
    }

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

if ($_POST['option'] === 'GETADS') {

    $ad = Advertisement::getAdsByGroup($_POST['group']);

    header('Content-type: application/json');
    echo json_encode($ad);
}

if ($_POST['option'] === 'DELETEAD') {

    $images = AdvertisementImage::getPhotosByAdId($_POST['ad']);
    foreach ($images as $img) {
        unlink(Helper::getSitePath() . "upload/advertisement/" . $img['image_name']);
        unlink(Helper::getSitePath() . "upload/advertisement/thumb/" . $img['image_name']);
        unlink(Helper::getSitePath() . "upload/advertisement/thumb2/" . $img['image_name']);

        $ADIMAGES = new AdvertisementImage($img['id']);
        $ADIMAGES->delete();
    }

    $AD = new Advertisement($_POST['ad']);
    $result = $AD->delete();

    header('Content-type: application/json');
    echo json_encode($result);
}

if ($_POST['option'] === 'GETADSBYGROUPSOFMEMBER') {
    
    $ad = Advertisement::getAdsInAnyGroupsByMember($_POST['member']);

    header('Content-type: application/json');
    echo json_encode($ad);
}

if ($_POST['option'] === 'GETADSBYMEMBER') {
    
    $ad = Advertisement::getAdsByMember($_POST['member']);

    header('Content-type: application/json');
    echo json_encode($ad);
}

if ($_POST['option'] == 'UPDATESTATUS') {
    
    $ADVERTISEMENT = new Advertisement($_POST['id']);
    $ADVERTISEMENT->status= $_POST['status'];
    
    $result = $ADVERTISEMENT->updateStatus();

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}