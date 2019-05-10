<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['login'])) {

    $MEMBER = new Member(NULL);
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $back = $_POST['back_url'];


    if (empty($email) || empty($password)) {
        header('Location: ../login.php?message=6');
        exit();
    }
    $result = $MEMBER->login($email, $password);

    if ($result == "deactive member") {
        header('Location: ../login.php?message=34');
        exit();
    } elseif ($result) {

        if (empty($back)) {

            header('Location: ../?message=5');
            exit();
        } else {
            unset($_SESSION["back_url"]);
            redirect($back);

            exit();
        }
        exit();
    } else {
        header('Location: ../login.php?message=7');
        exit();
    }
}

if (isset($_POST['update'])) {

    $MEMBER = new Member($_POST['id']);

    $MEMBER->firstName = $_POST['fname'];
    $MEMBER->lastName = $_POST['lname'];
    $MEMBER->phoneNumber = $_POST['phone_number'];
    $MEMBER->dob = $_POST['datetimepicker'];
    $MEMBER->occupation = $_POST['occupation'];
    $MEMBER->address = $_POST['address'];
    $MEMBER->district = $_POST['district'];
    $MEMBER->districtString = $_POST['district_string'];
    $MEMBER->city = $_POST['city'];
    $MEMBER->cityString = $_POST['city_string'];
    $MEMBER->aboutMe = $_POST['about_me'];
    $MEMBER->gender = $_POST['gender'];
    $MEMBER->civilStatus = $_POST['status'];

    $result = $MEMBER->update();

    if ($result) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION["first_name"] = $result['first_name'];
        $_SESSION["last_name"] = $result['last_name'];
        $_SESSION["phone_number"] = $result['phone_number'];
        $_SESSION["district"] = $result['district'];
        $_SESSION["district_string"] = $result['district_string'];
        $_SESSION["city"] = $result['city'];
        $_SESSION["city_string"] = $result['city_string'];
        $_SESSION["address"] = $result['address'];

        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?message=9');
        exit();
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?message=21');
        exit();
    }
}

if (isset($_POST['confirm'])) {

    $MEMBER = new Member($_POST['id']);

    if ($_POST['code'] === '') {
        header('Location: ../confirm-email.php?id=' . $_POST['id'] . '&message=20');
        exit();
    } elseif ($MEMBER->resetCode === $_POST['code']) {
        $MEMBER->isConfirmed = 1;
        $MEMBER->updateEmailConfirmationStatus();
        header('Location: ../index.php');
        exit();
    } else {
        header('Location: ../confirm-email.php?id=' . $_POST['id'] . '&message=19');
        exit();
    }

    if (empty($email) || empty($password)) {
        
    }
    if ($MEMBER->login($email, $password)) {
        header('Location: ../?message=5');
        exit();
    } else {
        header('Location: ../login.php?message=7');
        exit();
    }
}

if (isset($_POST['change-password'])) {
    if (!isset($_SESSION)) {
        session_start();
    }
    $VALID = new Validator();
    $pass = Member::getIdByPassword($_POST['current_password']);


    if ($pass['id'] == $_POST['id']) {
        $npassword = $_POST["new_password"];
        $cpassword = $_POST["confirm_password"];

        if ($npassword === $cpassword && $npassword != NULL && $cpassword != NULL) {

            $MEMBER = new Member($_POST['id']);
            $MEMBER->password = $npassword;

            $result = $MEMBER->changePassword();

            if ($result) {
                $VALID->addError("Your changes saved successfully", 'success');
                $_SESSION['ERRORS'] = $VALID->errors();


                header('Location: ' . $_SERVER['HTTP_REFERER'] . '?id=' . $MEMBER->id);
            } else {
                $VALID->addError("Your changes not saved successfully", 'danger');
                $_SESSION['ERRORS'] = $VALID->errors();

                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $VALID->addError("Your new password and confirm password was not matched", 'danger');
            $_SESSION['ERRORS'] = $VALID->errors();

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        $VALID->addError("Your current password was not matched", 'danger');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['check-email'])) {
    $MEMBER = new Member(NULL);

    $email = $_POST['email'];

    if (empty($email)) {
        header('Location: ../forgot-password.php?message=11');
        exit();
    }

    if ($MEMBER->checkEmail($email)) {

        if ($MEMBER->GenarateCode($email)) {
            $res = $MEMBER->SelectForgetMember($email);

            $email = $res['email'];
            $resetcode = $res['reset_code'];

            date_default_timezone_set('Asia/Colombo');

            $todayis = date("l, F j, Y, g:i a");

            $subject = 'Member - Password Reset';
            $from = 'noreply@flip.lk'; // give from email address


            $headers = "From: " . $from . "\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $html = "<table style='border:solid 1px #F0F0F0; font-size: 15px; font-family: sans-serif; padding: 0;'>";

            $html .= "<tr><th colspan='3' style='font-size: 18px; padding: 30px 25px 0 25px; color: #fff; text-align: center; background-color: #4184F3;'><h2>Flip.lk</h2> </th> </tr>";

            $html .= "<tr><td colspan='3' style='font-size: 16px; padding: 20px 25px 10px 25px; color: #333; text-align: left; background-color: #fff;'><h3>" . $subject . "</h3> </td> </tr>";

            $html .= "<tr><td colspan='3' style='font-size: 14px; padding: 5px 25px 10px 25px; color: #666; background-color: #fff; line-height: 25px;'><b>Password Reset Code: </b> " . $resetcode . "</td></tr>";

            $html .= "<tr><td colspan='3' style='font-size: 14px; padding: 0 25px 10px 25px; color: #666; background-color: #fff; '><b>Your Login email: </b> " . $email . "</td></tr>";

            $html .= "<tr><td colspan='3' style='font-size: 14px; background-color: #FAFAFA; padding: 25px; color: #333; font-weight: 300; text-align: justify; '>Thank you</td></tr>";

            $html .= "</table>";

            if (mail($email, $subject, $html, $headers)) {
                header('Location: ../reset-password.php?message=12');
            } else {
                header('Location: ../reset-password.php?message=14');
            }
        }
        exit();
    } else {
        header('Location: ../forgot-password.php?message=13');
        exit();
    }
}

if (isset($_POST['reset-password'])) {
    $MEMBER = new MEMBER(NULL);
    $code = $_POST["code"];
    $password = $_POST["password"];
    $confpassword = $_POST["cpassword"];

    if ($password === $confpassword && $password != NULL && $confpassword != NULL) {
        $result = $MEMBER->SelectResetCode($code);

        if ($result) {
            $res = $MEMBER->updatePassword($password, $code);
            if ($res) {

                if ($MEMBER->login($result['email'], md5($password))) {
                    header('Location: ../index.php?message=15');
                } else {
                    header('Location: ../reset-password.php?message=13');
                }
            } else {
                header('Location: ../reset-password.php?message=14');
            }
        } else {
            header('Location: ../reset-password.php?message=16');
        }
    } else {
        header('Location: ../reset-password.php?message=17');
    }
}