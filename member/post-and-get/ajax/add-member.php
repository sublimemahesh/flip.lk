<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');
if (!isset($_SESSION)) {
    session_start();
} 


if (isset($_POST["save"])) {

    $response = array();
    if (isset($_POST['back_url'])) {
        $back = $_POST['back_url'];
    } else {
        $back = "";
    }

    if (empty($_POST['fname'])) {
        $response['status'] = 'error';
        $response['message'] = "Please enter your first name.";
        echo json_encode($response);
        exit();
    } else if (empty($_POST['lname'])) {
        $response['status'] = 'error';
        $response['message'] = "Please enter your last name.";
        echo json_encode($response);
        exit();
    } else if (empty($_POST['email'])) {
        $response['status'] = 'error';
        $response['message'] = "Please enter your email.";
        echo json_encode($response);
        exit();
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $response['status'] = 'error';
        $response['message'] = "Please enter valid email.";
        echo json_encode($response);
        exit();
    } else if (empty($_POST['password'])) {
        $response['status'] = 'error';
        $response['message'] = "Please enter the password.";
        echo json_encode($response);
        exit();
    } else if (empty($_POST['cpassword'])) {
        $response['status'] = 'error';
        $response['message'] = "Please enter the confirm password.";
        echo json_encode($response);
        exit();
    } else if ($_POST['password'] !== $_POST['cpassword']) {
        $response['status'] = 'error';
        $response['message'] = "Your password and confirm password does not match.";
        echo json_encode($response);
        exit();
    } else {
        $MEMBER = new Member(NULL);
        $result = $MEMBER->checkEmail($_POST['email']);
        if ($result) {
            $response['status'] = 'registered';
            $response['message'] = "The email address you entered is already in use.";
            echo json_encode($response);
            exit();
        } else {
            $MEMBER = new Member(NULL);
            $email = $_POST['email'];

            $MEMBER->firstName = filter_input(INPUT_POST, 'fname');
            $MEMBER->lastName = filter_input(INPUT_POST, 'lname');
            $MEMBER->email = $email;
            $MEMBER->password = $_POST['password'];
            $result = $MEMBER->create();
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $result['id'];

            if ($result) {
                
                $MEM = new Member($result['id']);
                $MEM->sendConfirmationEmail();
                
                $response['status'] = 'success';

                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['registered'] = TRUE;

                echo json_encode($response);
                exit();
            } else {

                $response['status'] = 'error';
                $response['message'] = "Oops. Something went wrong, Please try again.";
                echo json_encode($response);
                exit();
            }
        }
    }
}

if ($_POST["option"] == 'ADDBUSINESSCATEGORY') {

    $MEMBER = new Member($_SESSION['id']);

    $MEMBER->category = $_POST['category'];
    $MEMBER->subCategory = $_POST['subcategory'];

    $result = $MEMBER->updateBusinessCategory();

    if ($result) {
        $response['status'] = 'success';
        $response['message'] = "Oops. Something went wrong, Please try again.";
        echo json_encode($response);
        exit();
    } else {
        $response['status'] = 'error';
        $response['message'] = "Oops. Something went wrong, Please try again.";
        echo json_encode($response);
        exit();
    }
}