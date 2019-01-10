<?php

/**
 * Description of Group
 *
 * @author W j K n ¨
 */
class Group {

    public $id;
    public $createdAt;
    public $name;
    public $member;
    public $category;
    public $subCategory;
    public $email;
    public $phoneNumber;
    public $profilePicture;
    public $coverPicture;
    public $district;
    public $city;
    public $address;
    public $description;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`name`,`member`,`category`,`sub_category`,`email`,`phone_number`,`profile_picture`,`cover_picture`,`district`,`city`,`address`,`description`,`status` FROM `groups` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['created_at'];
            $this->name = $result['name'];
            $this->member = $result['member'];
            $this->category = $result['category'];
            $this->subCategory = $result['sub_category'];
            $this->email = $result['email'];
            $this->phoneNumber = $result['phone_number'];
            $this->profilePicture = $result['profile_picture'];
            $this->coverPicture = $result['cover_picture'];
            $this->district = $result['district'];
            $this->city = $result['city'];
            $this->address = $result['address'];
            $this->description = $result['description'];
            $this->status = $result['status'];

            return $result;
        }
    }

    public function create() {

        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `groups` ("
                . "created_at, "
                . "name, "
                . "member, "
                . "category, "
                . "sub_category, "
                . "email, "
                . "phone_number, "
                . "profile_picture, "
                . "cover_picture, "
                . "district, "
                . "city, "
                . "address, "
                . "description, "
                . "status"
                . ") VALUES  ("
                . "'" . $createdAt . "', "
                . "'" . $this->name . "', "
                . "'" . $this->member . "', "
                . "'" . $this->category . "', "
                . "'" . $this->subCategory . "', "
                . "'" . $this->email . "', "
                . "'" . $this->phoneNumber . "', "
                . "'" . $this->profilePicture . "', "
                . "'" . $this->coverPicture . "', "
                . "'" . $this->district . "', "
                . "'" . $this->city . "', "
                . "'" . $this->address . "', "
                . "'" . $this->description . "', "
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

        $query = "UPDATE  `groups` SET "
                . "`name` ='" . $this->name . "', "
                . "`category` ='" . $this->category . "', "
                . "`sub_category` ='" . $this->subCategory . "', "
                . "`email` ='" . $this->email . "', "
                . "`phone_number` ='" . $this->phoneNumber . "', "
                . "`profile_picture` ='" . $this->profilePicture . "', "
                . "`cover_picture` ='" . $this->coverPicture . "', "
                . "`district` ='" . $this->district . "', "
                . "`city` ='" . $this->city . "', "
                . "`address` ='" . $this->address . "', "
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

    public function all() {

        $query = "SELECT * FROM `groups`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getGroupsByMember($member) {

        $query = "SELECT * FROM `groups` WHERE `id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member AND `status` LIKE 'member') AND `status` = 1";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getGroupsOfAdmin($member) {

        $query = "SELECT * FROM `groups` WHERE `id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member AND `status` LIKE 'admin')";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getOtherGroups($member) {

        $query = "SELECT * FROM `groups` WHERE `id` not in (SELECT `group_id` FROM `group_members` WHERE `member` = $member) AND `status` = 1";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {
        
        unlink(Helper::getSitePath() . "upload/group/" . $this->profilePicture);
        unlink(Helper::getSitePath() . "upload/group/cover-picture/" . $this->coverPicture);
        unlink(Helper::getSitePath() . "upload/group/cover-picture/thumb/" . $this->coverPicture);
//        unlink("localhost/flip.lk/upload/group/" . $this->profilePicture);
//        unlink("localhost/flip.lk/upload/group/cover-picture/" . $this->coverPicture);
//        unlink("localhost/flip.lk/upload/group/cover-picture/thumb/" . $this->coverPicture);

        if (GroupMember::deleteAllMembersInGroup($this->id)) {
            $query = 'DELETE FROM `groups` WHERE id="' . $this->id . '"';

            $db = new Database();

            return $db->readQuery($query);
        }
    }

    public function updateStatus() {

        $query = "UPDATE  `groups` SET "
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
