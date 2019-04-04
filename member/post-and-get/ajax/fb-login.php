<?php
header('Content-Type: application/json; charset=UTF8');
include_once(dirname(__FILE__) . '/../../../class/include.php');

if (isset($_POST['memberLogin'])) {

    $back = "";
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['back_url'])) {
        $back = $_SESSION['back_url'];
    }


    $response = array();

    $memberID = $_POST["userID"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $picture = $_POST["picture"];
    $password = substr(explode(".", $_POST["signedRequest"])[1], -7);

    $MEMBER = New Member(NULL);

    $isFbIdIsEx = $MEMBER->isFbIdIsEx($memberID);

    if ($isFbIdIsEx == false) {

        $res = $MEMBER->createByFB($name, $email, $picture, $memberID, $password);

        if ($res === false) {
            $response['message'] = 'error-log';
            echo json_encode($response);
            exit();
        } else {
            if ($back <> '') {
                $response['message'] = 'success-cre';
                $response['back'] = $back;
                unset($_SESSION["back_url"]);
            } else {
                $response['message'] = 'success-cre';
                $response['back'] = '';
            }
            echo json_encode($response);
            exit();
        }
    } else {
        $res = $MEMBER->loginByFB($memberID, $password);
        if ($res === false) {
            $response['message'] = 'error-log';
            echo json_encode($response);
            exit();
        } else {
            if ($back <> '') {
                $response['message'] = 'success-log';
                $response['back'] = $back;
                unset($_SESSION["back_url"]);
            } else {
                $response['message'] = 'success-log';
                $response['back'] = '';
            }
            echo json_encode($response);
            exit();
        }
    }
}