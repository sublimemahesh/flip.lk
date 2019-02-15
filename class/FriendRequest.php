<?php
/**
 * Description of FriendRequest
 *
 * @author W j K n ¨
 */
class FriendRequest {
    public $id;
    public $requestedBy;
    public $requestedTo;
    public $requestedDate;
    public $isConfirmed;
    public $confirmedDate;
    public $isViewed;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`requested_by`,`requested_to`,`requested_date`,`is_confirmed`, `confirmed_date`, `is_viewed` FROM `friend_request` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->requestedBy = $result['requested_by'];
            $this->requestedTo = $result['requested_to'];
            $this->requestedDate = $result['requested_date'];
            $this->isConfirmed = $result['is_confirmed'];
            $this->confirmedDate = $result['confirmed_date'];
            $this->isViewed = $result['is_viewed'];

            return $this;
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `friend_request` (`requested_by`, `requested_to`, `requested_date`, `is_confirmed`) VALUES  ('" . $this->requestedBy . "','" . $this->requestedTo . "','" . $date . "', '" . $this->isConfirmed . "')";

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

        $query = "SELECT * FROM `friend_request` ORDER BY `requested_date` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getIdByRequestedToAndRequestedBy($requestedTo, $requestedBy) {

        $query = "SELECT `id` FROM `friend_request` WHERE `requested_to` = " . $requestedTo . " AND `requested_by` = " . $requestedBy;
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function checkMemberSentRequest($requestedTo, $requestedBy) {

        $query = "SELECT `id` FROM `friend_request` WHERE `requested_to` = " . $requestedTo . " AND `requested_by` = " . $requestedBy ." AND `is_confirmed` = 0";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function checkMemberGotRequest($requestedBy, $requestedTo) {

        $query = "SELECT `id` FROM `friend_request` WHERE `requested_to` = " . $requestedTo . " AND `requested_by` = " . $requestedBy ." AND `is_confirmed` = 0";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function getFriendRequest($requestedTo, $requestedBy) {

        $query = "SELECT `id` FROM `friend_request` WHERE `requested_to` = " . $requestedTo . " AND `requested_by` = " . $requestedBy;
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function update() {

        $query = 'UPDATE `friend_request` SET '
                . '`requested_by`= "' . $this->requestedBy . '", '
                . '`requested_to`= "' . $this->requestedTo . '", '
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

        $query = 'DELETE FROM `friend_request` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getCountOfFriendRequestsByMember($requestedTo) {

        $query = "SELECT count(`id`) AS `count` FROM `friend_request` WHERE `requested_to` = " . $requestedTo . " AND `is_confirmed` = 0";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function getFriendRequestsByMember($requestedTo) {

        $query = "SELECT * FROM `friend_request` WHERE `requested_to` = " . $requestedTo . " AND `is_confirmed` = 0";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    
    public function getConfirmedDate($friend1, $friend2) {

        $query = "SELECT * FROM `friend_request` WHERE (`requested_to` = " . $friend1 . " AND `requested_by` = " . $friend2 . ") OR (`requested_to` = " . $friend2 . " AND `requested_by` = " . $friend1 . ") AND `is_confirmed` = 0";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function confirmRequest() {

        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d H:i:s');
        
        $query = 'UPDATE `friend_request` SET '
                . '`is_confirmed`= "' . $this->isConfirmed . '", '
                . '`confirmed_date`= "' . $date . '" '
                . ' WHERE id="' . $this->id . '"';

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    
    public function unFollow($requestedTo, $requestedBy) {

        $query = 'DELETE FROM `friend_request` WHERE (`requested_by`="'. $requestedBy .'" AND `requested_to` ="'. $requestedTo .'") OR (`requested_by`="'. $requestedTo .'" AND `requested_to` ="'. $requestedBy .'")';
        $db = new Database();

        return $db->readQuery($query);
    }
    
    public function updateViewingStatus($id) {

        $query = "UPDATE  `friend_request` SET "
                . "`is_viewed` = 1 "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function getCountOfUnviewedRequests($requestedTo) {

        $query = "SELECT count(`id`) AS `count` FROM `friend_request` WHERE `requested_to` = " . $requestedTo . " AND `is_confirmed` = 0 AND `is_viewed` = 0";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
}
