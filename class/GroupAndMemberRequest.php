<?php

/**
 * Description of GroupAndMemberRequest
 *
 * @author W j K n ¨
 */
class GroupAndMemberRequest {

    public $id;
    public $member;
    public $groupId;
    public $requestedBy;
    public $requestedDate;
    public $isApproved;
    public $approvedDate;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`member`,`group_id`,`requested_by`,`requested_date`,`is_approved`, `approved_date` FROM `group_and_member_request` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->member = $result['member'];
            $this->groupId = $result['group_id'];
            $this->requestedBy = $result['requested_by'];
            $this->requestedDate = $result['requested_date'];
            $this->isApproved = $result['is_approved'];
            $this->approvedDate = $result['approved_date'];

            return $this;
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `group_and_member_request` (`member`, `group_id`, `requested_by`, `requested_date`, `is_approved`) VALUES  ('" . $this->member . "','" . $this->groupId . "','" . $this->requestedBy . "','" . $date . "', '" . $this->isApproved . "')";

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

        $query = "SELECT * FROM `group_and_member_request` ORDER BY `requested_date` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getIdByGroupAndMember($group, $member) {

        $query = "SELECT `id` FROM `group_and_member_request` WHERE `group_id` = " . $group . " AND `member` = " . $member;
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function update() {

        $query = 'UPDATE `group_and_member_request` SET '
                . '`member`= "' . $this->member . '", '
                . '`group_id`= "' . $this->groupId . '", '
                . '`requested_by`= "' . $this->requestedBy . '", '
                . '`requested_date`= "' . $this->requestedDate . '" '
                . ' WHERE id="' . $this->id . '"';

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `group_and_member_request` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getCountOfMemberRequestsByGroup($group) {

        $query = "SELECT count(`id`) AS `count` FROM `group_and_member_request` WHERE `group_id` = " . $group . " AND `is_approved` = 0";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function getMemberRequestsByGroup($group) {

        $query = "SELECT * FROM `group_and_member_request` WHERE `group_id` = " . $group . " AND `is_approved` = 0";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function approveRequest() {

        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d H:i:s');
        
        $query = 'UPDATE `group_and_member_request` SET '
                . '`is_approved`= "' . $this->isApproved . '", '
                . '`approved_date`= "' . $date . '" '
                . ' WHERE id="' . $this->id . '"';

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    
    public function leaveGroup($member, $group) {

        $query = 'DELETE FROM `group_and_member_request` WHERE `member`="'. $member .'" AND `group_id` ="'. $group .'"';
        $db = new Database();

        return $db->readQuery($query);
    }

}
