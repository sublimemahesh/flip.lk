<?php

/**
 * Description of Advertisement
 *
 * @author W j K n ¨
 */
class Advertisement {

    public $id;
    public $createdAt;
    public $member;
    public $groupId;
    public $title;
    public $description;
    public $city;
    public $address;
    public $category;
    public $subCategory;
    public $website;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`member`,`group_id`,`title`,`description`,`city`,`address`,`category`,`sub_category`,`website`,`status` FROM `advertisement` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['created_at'];
            $this->member = $result['member'];
            $this->groupId = $result['group_id'];
            $this->title = $result['title'];
            $this->description = $result['description'];
            $this->city = $result['city'];
            $this->address = $result['address'];
            $this->category = $result['category'];
            $this->subCategory = $result['sub_category'];
            $this->website = $result['website'];
            $this->status = $result['status'];

            return $result;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `advertisement` ("
                . "`created_at`, "
                . "`member`, "
                . "`group_id`, "
                . "`title`, "
                . "`description` , "
                . "`city`, "
                . "`address`, "
                . "`category`, "
                . "`sub_category`, "
                . "`website`, "
                . "`status`"
                . ") VALUES  ("
                . "'" . $createdAt . "', "
                . "'" . $this->member . "', "
                . "'" . $this->groupId . "', "
                . "'" . $this->title . "', "
                . "'" . $this->description . "', "
                . "'" . $this->city . "', "
                . "'" . $this->address . "', "
                . "'" . $this->category . "', "
                . "'" . $this->subCategory . "', "
                . "'" . $this->website . "', "
                . "'" . $this->status . "'"
                . ")";
       
        $db = new Database();

        $result = $db->readQuery($query);
        if ($result) {
            $last_id = mysql_insert_id();
            $details = $this->__construct($last_id);
            return $details;
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `advertisement` SET "
                . "`title` ='" . $this->title . "', "
                . "`description` ='" . $this->description . "', "
                . "`city` ='" . $this->city . "', "
                . "`address` ='" . $this->address . "', "
                . "`website` ='" . $this->website . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `advertisement`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getAdsInAnyGroupsByMember($member) {

        $query = "SELECT * FROM `advertisement` WHERE `group_id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member) AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        $query = 'DELETE FROM `advertisement` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
    
    public function getAdsByGroup($group) {

        $query = "SELECT * FROM `advertisement` WHERE `group_id` = $group AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getAdsByMember($member) {

        $query = "SELECT * FROM `advertisement` WHERE `member` = $member ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function updateStatus() {

        $query = "UPDATE  `advertisement` SET "
                . "`status` ='" . $this->status . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

}
