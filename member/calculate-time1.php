<?php

function getTime1($datetime) {

    $diff = '';
    date_default_timezone_set('Asia/Colombo');
    $today = new DateTime(date("Y-m-d"));
    $todaytime = new DateTime(date("H:i:s"));

    $arr = explode(' ', $datetime);
    $date1 = new DateTime(date($arr[0]));
    $time1 = new DateTime(date($arr[1]));

    $date = $today->diff($date1);
    $datediff = $date->format('%a');

    if ($datediff == 0) {

        $time = $todaytime->diff($time1);
        $timediff = $time->format('%h:%i:%s');
        $arr1 = explode(':', $timediff);
        if ($arr1[0] == 0) {
            if($arr1[1] == 0) {
                $diff = 'just now';
            } else {
                $diff = $arr1[1] . ' min ago';
            }
            
        } else {
            if ($arr1[0] == 1) {
                $diff = $arr1[0] . ' hour ago';
            } else {
                $diff = $arr1[0] . ' hours ago';
            }
        }
    } elseif ($datediff == 1 && $time1 > $todaytime) {
        $t = $todaytime->diff($time1);
        $timediff1 = $t->format('%h:%i:%s');
        $timediff1format = new DateTime($timediff1);
        $time3 = new DateTime('24:00:00');
        $time = $time3->diff($timediff1format);
        $timediff = $time->format('%h:%i:%s');
        $arr1 = explode(':', $timediff);
        $diff = $arr1[0] . ' hours ago';
    } elseif ($datediff == 1 && $time1 < $todaytime) {
        $diff = $datediff . ' day ago';
    } elseif ($datediff > 30) {
        $month = round($datediff / 30);

        if ($month >= 12) {

            $year = round($month / 12);
            if ($year == 1) {
                $diff = $year . ' year ago';
            } else {
                $diff = $year . ' years ago';
            }
        } elseif ($month == 1) {
            $diff = $month . ' month ago';
        } else {
            $diff = $month . ' months ago';
        }
    } else {
        $diff = $datediff . ' days ago';
    }

    return $diff;
}
