<?php
include_once(dirname(__FILE__) . '/class/include.php');


$url = explode("/", $_SERVER['REQUEST_URI']);

if(empty($url[2]) || $url[2] == 'index.php') {
    $_SESSION["active"] = "home";
} else  {
    $result = explode(".", $url[2]);
    $_SESSION["active"] = $result[0];
}

