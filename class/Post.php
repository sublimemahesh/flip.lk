<?php

/**
 * Description of Post
 *
 * @author W j K n ¨
 */
class Post {
    
    public $id;
    public $member;
    public $createdAt;
    public $description;
    public $sharedAd;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`member`,`created_at`,`description`, `shared_ad` FROM `post` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->member = $result['member'];
            $this->createdAt = $result['created_at'];
            $this->description = $result['description'];
            $this->sharedAd = $result['shared_ad'];

            return $this;
        }
    }

    public function create() {
        
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `post` ("
                . "`member`,"
                . "`created_at`,"
                . "`description`) "
                . "VALUES  ("
                . "'" . $this->member . "',"
                . "'" . $createdAt . "',"
                . "'" . $this->description . "'"
                . ")";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }
    
    public function shareAd() {
        
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `post` ("
                . "`member`,"
                . "`created_at`,"
                . "`description`,"
                . "`shared_ad`) "
                . "VALUES  ("
                . "'" . $this->member . "',"
                . "'" . $createdAt . "',"
                . "'" . $this->description . "',"
                . "'" . $this->sharedAd . "'"
                . ")";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `post` ORDER BY `description` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `post` SET "
                . "`description` ='" . $this->description . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `post` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
    
    public function getPostsByMember($member) {

        $query = "SELECT * FROM `post` WHERE  `member` = $member ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getPostsBySharedAD($ad) {

        $query = "SELECT * FROM `post` WHERE  `shared_ad` = $ad ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
}