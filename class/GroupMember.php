<?php

/**
 * Description of GroupMember
 *
 * @author W j K n ¨
 */
class GroupMember {

    public $id;
    public $groupId;
    public $member;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`group_id`,`member`,`status` FROM `group_members` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->groupId = $result['group_id'];
            $this->member = $result['member'];
            $this->status = $result['status'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `group_members` ("
                . "`group_id`,"
                . "`member`,"
                . "`status`) "
                . "VALUES  ("
                . "'" . $this->groupId . "',"
                . "'" . $this->member . "',"
                . "'" . $this->status . "'"
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

        $query = "SELECT * FROM `group_members` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getAllMembersByGroup($group) {

        $query = "SELECT * FROM `group_members` WHERE `group_id` = $group AND `status` LIKE 'member' ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getAllAdminsByGroup($group) {

        $query = "SELECT * FROM `group_members` WHERE `group_id` = $group AND `status` LIKE 'admin' ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function countGroupMembers($group) {

        $query = "SELECT count(`id`) AS `count` FROM `group_members` WHERE `group_id` = $group";
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function update() {

        $query = "UPDATE  `group_members` SET "
                . "`group_id` ='" . $this->groupId . "', "
                . "`member` ='" . $this->member . "', "
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

    public function delete() {

        $query = 'DELETE FROM `group_members` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function deleteAllMembersInGroup($group) {

        $query = 'DELETE FROM `group_members` WHERE `group_id`="' . $group . '"';
        
        $db = new Database();
        return $db->readQuery($query);
    }

    public function leaveGroup($member, $group) {

        $query = 'DELETE FROM `group_members` WHERE `member`="' . $member . '" AND `group_id` ="' . $group . '"';
        $db = new Database();

        return $db->readQuery($query);
    }

    public function checkMemberAlreadyExistInTheGroup($member, $group) {

        $query = "SELECT `id` FROM `group_members` WHERE `member`= $member AND `group_id` = $group";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function checkMemberIsAnAdmin($member, $group) {

        $query = "SELECT `id` FROM `group_members` WHERE `member`= $member AND `group_id` = $group AND `status` LIKE 'admin'";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

}
