<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['login'])) {

    $MEMBER = new Member(NULL);

    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = md5($_POST['password']);

    if (empty($email) || empty($password)) {
        header('Location: ../login.php?message=6');
        exit();
    }
    if ($MEMBER->login($email, $password)) {
        header('Location: ../?message=5');
        exit();
    } else {
        header('Location: ../login.php?message=7');
        exit();
    }
}