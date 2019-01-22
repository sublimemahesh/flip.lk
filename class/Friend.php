<?php

/**
 * Description of Friend
 *
 * @author W j K n ¨
 */
class Friend {

    public $id;
    public $member;
    public $friend;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`member`,`friend`,`status` FROM `friends` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->member = $result['member'];
            $this->friend = $result['friend'];
            $this->status = $result['status'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `friends` ("
                . "`member`,"
                . "`friend`,"
                . "`status`) "
                . "VALUES  ("
                . "'" . $this->member . "',"
                . "'" . $this->friend . "',"
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

        $query = "SELECT * FROM `friends` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getAllFriendsByMember($member) {

        $query = "SELECT * FROM `friends` WHERE `member` = $member OR `friend`=$member ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function countFriends($member) {

        $query = "SELECT count(`id`) AS `count` FROM `friends` WHERE `member` = $member OR `friend` = $member";
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function update() {

        $query = "UPDATE  `friends` SET "
                . "`member` ='" . $this->member . "', "
                . "`friend` ='" . $this->friend . "', "
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

        $query = 'DELETE FROM `friends` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function deleteAllFriendsOfMember($member) {

        $query = 'DELETE FROM `friends` WHERE `member`="' . $member . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

    public function unFollow($id) {

        $query = 'DELETE FROM `friends` WHERE `id`="' . $id . '"';
        $db = new Database();

        return $db->readQuery($query);
    }

    public function checkMemberAlreadyAFriend($friend1, $friend2) {

        $query = "SELECT `id` FROM `friends` WHERE (`friend`= $friend1 AND `member` = $friend2) OR (`friend`= $friend2 AND `member` = $friend1)";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

}
