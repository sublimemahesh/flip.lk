<?php

/**
 * Description of User
 *
 * @author  W j K n ¨
 * */
class Database {

//    private $host = 'localhost';
//    private $name = 'gallnwxt_travelhelper';
//    private $user = 'gallnwxt_travelhelper';
//    private $password = 'sJqd3BLr3gmv!';

    private $host = 'localhost';
    private $name = 'flip.lk';
    private $user = 'root';
    private $password = '';

    public function __construct() {
        mysql_connect($this->host, $this->user, $this->password) or die("Invalid host  or user details");
        mysql_select_db($this->name) or die("Unable to select database");
    }

    public function readQuery($query) {

        $result = mysql_query($query) or die(mysql_error());
        return $result;
    }

}
