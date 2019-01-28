<?php

include_once(dirname(__FILE__) . '/Setting.php');
include_once(dirname(__FILE__) . '/Helper.php');
include_once(dirname(__FILE__) . '/Upload.php');
include_once(dirname(__FILE__) . '/Validator.php');
include_once(dirname(__FILE__) . '/Database.php');
include_once(dirname(__FILE__) . '/User.php');
include_once(dirname(__FILE__) . '/Message.php');
include_once(dirname(__FILE__) . '/BusinessCategory.php');
include_once(dirname(__FILE__) . '/BusinessSubCategory.php');
include_once(dirname(__FILE__) . '/Member.php');
include_once(dirname(__FILE__) . '/Group.php');
include_once(dirname(__FILE__) . '/Advertisement.php');
include_once(dirname(__FILE__) . '/GroupMember.php');
include_once(dirname(__FILE__) . '/GroupAndMemberRequest.php');
include_once(dirname(__FILE__) . '/Friend.php');
include_once(dirname(__FILE__) . '/FriendRequest.php');
include_once(dirname(__FILE__) . '/Post.php');
include_once(dirname(__FILE__) . '/PostImage.php');

function dd($data) {
    var_dump($data);
    exit();
}
function redirect($url) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';

    echo $string;
    exit();
}
