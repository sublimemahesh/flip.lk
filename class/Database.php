<?php

/**
 * Description of Database
 *
 * @author  W j K n ¨
 * */
class Database {

//    private $host = 'localhost';
//    private $name = 'islapiiu_flip';
//    private $user = 'islapiiu_main';
//    private $password = 'Ue.t;FNgC?BG,Paf8V';

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
