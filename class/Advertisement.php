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
    public $group;
    public $title;
    public $description ;
    public $location;
    public $category;
    public $subCategory;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`member`,`group`,`title`,`description `,`location`,`category`,`sub_category`,`status` FROM `advertisement` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['created_at'];
            $this->member = $result['member'];
            $this->group = $result['group'];
            $this->title = $result['title'];
            $this->description  = $result['description '];
            $this->location = $result['location'];
            $this->category = $result['category'];
            $this->subCategory = $result['sub_category'];
            $this->status = $result['status'];

            return $result;
        }
    }

    public function create() {

        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `advertisement` ("
                . "created_at, "
                . "member, "
                . "group, "
                . "title, "
                . "description , "
                . "location, "
                . "category, "
                . "sub_category, "
                . "status"
                . ") VALUES  ("
                . "'" . $createdAt . "', "
                . "'" . $this->member . "', "
                . "'" . $this->group . "', "
                . "'" . $this->title . "', "
                . "'" . $this->description  . "', "
                . "'" . $this->location . "', "
                . "'" . $this->category . "', "
                . "'" . $this->subCategory . "', "
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
                . "`member` ='" . $this->member . "', "
                . "`group` ='" . $this->group . "', "
                . "`title` ='" . $this->title . "', "
                . "`description ` ='" . $this->description  . "', "
                . "`location` ='" . $this->location . "', "
                . "`category` ='" . $this->category . "', "
                . "`sub_category` ='" . $this->subCategory . "' "
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

    public function delete() {

        $query = 'DELETE FROM `advertisement` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
}
