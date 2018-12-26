<?php

include_once(dirname(__FILE__) . '/../class/include.php');

$MEMBER = new Member(NULL);

if ($MEMBER->logOut()) {
    header('Location: login.php');
} else {
    header('Location: ./?message=2');
}