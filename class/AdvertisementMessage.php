<?php

/**
 * Description of AdvertisementMessage
 *
 * @author W j K n ¨
 */
class AdvertisementMessage {

    public $id;
    public $createdAt;
    public $advertisement;
    public $owner;
    public $member;
    public $message;
    public $parent;
    public $sender;
    public $is_viewed;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`advertisement`,`owner`,`member`,`message`,`parent`,`sender`,`is_viewed` FROM `advertisement_message` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['created_at'];
            $this->advertisement = $result['advertisement'];
            $this->owner = $result['owner'];
            $this->member = $result['member'];
            $this->message = $result['message'];
            $this->parent = $result['parent'];
            $this->sender = $result['sender'];
            $this->is_viewed = $result['is_viewed'];

            return $this;
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `advertisement_message` (`created_at`,`advertisement`,`owner`,`member`,`message`,`parent`,`sender`) VALUES  ('"
                . $createdAt . "','"
                . $this->advertisement . "', '"
                . $this->owner . "', '"
                . $this->member . "', '"
                . $this->message . "', '"
                . $this->parent . "', '"
                . $this->sender . "')";
        
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

        $query = "SELECT * FROM `advertisement_message` ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `advertisement_message` SET "
                . "`created_at` ='" . $this->createdAt . "', "
                . "`advertisement` ='" . $this->advertisement . "', "
                . "`owner` ='" . $this->owner . "', "
                . "`member` ='" . $this->member . "', "
                . "`message` ='" . $this->message . "' "
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

        $query = 'DELETE FROM `advertisement_message` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getDistinctAdvertisements($member) {
//        $query = "SELECT distinct(advertisement) FROM `advertisement_message` WHERE (`owner`= $member OR `member`= $member) AND `advertisement` != 0";
        $query = "SELECT `advertisement`,`owner`,`member` FROM `advertisement_message` WHERE (`owner` = $member OR `member` = $member)  AND `advertisement` != 0 GROUP BY `advertisement`, `member`, `owner`";
        
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getDistinctAll($member) {
        $query = "SELECT distinct(advertisement) FROM `advertisement_message` WHERE `owner`= $member OR `member`= $member";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getDistinctMembers($member) {
        $query = "SELECT distinct(member) FROM `advertisement_message` WHERE `owner`= $member AND `advertisement` = 0 UNION ALL SELECT distinct(owner) FROM `advertisement_message` WHERE `member`= $member AND `advertisement` = 0 AND `owner` NOT IN (SELECT distinct(member) FROM `advertisement_message` WHERE `owner`= $member AND `advertisement` = 0)";
        
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getMaxIDOfDistinctAdvertisement($ad, $member, $owner) {

//        $query = "SELECT max(id) AS `max` FROM `advertisement_message` WHERE `advertisement`= $ad and (`owner`= $member OR `member`= $member)";
        $query = "SELECT max(id) AS `max` FROM `advertisement_message` WHERE `advertisement`= $ad AND ((`owner`= $owner AND `member`= $member) OR (`owner`= $member AND `member`= $owner))";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }
    public function getMaxIDOfDistinctMember($member, $owner) {

        $query = "SELECT max(id) AS `max` FROM `advertisement_message` WHERE `advertisement` = 0 AND ((`member`= $member and `owner`= $owner) OR (`member`= $owner and `owner`= $member))";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }
    
    public function getMessagesByMemberOwnerAndAdASC($member, $owner, $ad) {

        $query = "SELECT * FROM `advertisement_message` WHERE `member`= $member AND `owner` = $owner AND `advertisement`= $ad ORDER BY created_at ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getMessagesByMembers($member, $owner) {

        $query = "SELECT * FROM `advertisement_message` WHERE (`member`= $member AND `owner` = $owner) OR (`member`= $owner AND `owner` = $member) ORDER BY created_at ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getMessagesByParent($parent) {

        $query = "SELECT * FROM `advertisement_message` WHERE `parent` = $parent OR `id` = $parent ORDER BY created_at ASC";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getParentMessage($id) {

        $query = "SELECT * FROM `advertisement_message` WHERE `id` = $id";
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function updateViewingStatus($id) {

        $query = "UPDATE  `advertisement_message` SET "
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

    public function countUnreadMessages($id) {

        $query = "SELECT count(`id`) AS `count` FROM `advertisement_message` WHERE (`owner`= $id AND `sender` LIKE 'member' AND `is_viewed`=0) OR (`member`= $id AND `sender` LIKE 'owner' AND `is_viewed`=0) ORDER BY `created_at` DESC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }
    
    public function getUnreadMessages($id) {

        $query = "SELECT max(`id`) AS `max` FROM `advertisement_message` WHERE (`owner`= $id AND `sender` LIKE 'member' AND `is_viewed`=0) OR (`member`= $id AND `sender` LIKE 'owner' AND `is_viewed`=0) GROUP BY `advertisement` ORDER BY `created_at` DESC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
}