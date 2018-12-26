<?php
include_once(dirname(__FILE__) . '/../../class/include.php');
$MEMBER= new Member(NULL);

$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

if (empty($email) || empty($password)) {
    header('Location: ../login.php?message=6');
    exit();
}
if ($USER->login($email, $password)) {
    header('Location: ../?message=5');
    exit();
} else {
    header('Location: ../login.php?message=7');
    exit();
}