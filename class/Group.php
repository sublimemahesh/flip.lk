<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`name`,`member`,`category`,`sub_category`,`email`,`phone_number`,`profile_picture`,`cover_picture`,`district`,`city`,`address`,`status` FROM `group` WHERE `id`=" . $id;

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
            $this->status = $result['status'];

            return $result;
        }
    }

    public function create() {

        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `group` ("
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

        $query = "UPDATE  `group` SET "
                . "`name` ='" . $this->name . "', "
                . "`member` ='" . $this->member . "', "
                . "`category` ='" . $this->category . "', "
                . "`sub_category` ='" . $this->subCategory . "', "
                . "`email` ='" . $this->email . "', "
                . "`phone_number` ='" . $this->phoneNumber . "', "
                . "`profile_picture` ='" . $this->profilePicture . "', "
                . "`cover_picture` ='" . $this->coverPicture . "', "
                . "`district` ='" . $this->district . "', "
                . "`city` ='" . $this->city . "', "
                . "`address` ='" . $this->address . "' "
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

        $query = "SELECT * FROM `group`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        unlink(Helper::getSitePath() . "upload/group/profile-picture/" . $this->profilePicture);
        unlink(Helper::getSitePath() . "upload/group/cover-picture/" . $this->coverPicture);
        unlink(Helper::getSitePath() . "upload/group/cover-picture/thumb/" . $this->coverPicture);
        $query = 'DELETE FROM `group` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
}