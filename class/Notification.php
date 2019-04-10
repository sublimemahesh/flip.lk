<?php

/**
 * Description of Notification
 *
 * @author W j K n
 */
class Notification {

    public $id;
    public $createdAt;
    public $title;
    public $description;
    public $url;
    public $imageName;
    public $user;
    public $isViewed;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`title`,`description`,`url`,`image_name`,`user`, `is_viewed` FROM `notification` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['created_at'];
            $this->title = $result['title'];
            $this->description = $result['description'];
            $this->url = $result['url'];
            $this->imageName = $result['image_name'];
            $this->user = $result['user'];
            $this->isViewed = $result['is_viewed'];

            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');
        
        $query = "INSERT INTO `notification` ("
                . "`created_at`,"
                . "`title`,"
                . "`description`,"
                . "`url`,"
                . "`image_name`,"
                . "`user`,"
                . "`is_viewed`) "
                . "VALUES  ("
                . "'" . $createdAt . "',"
                . "'" . $this->title . "',"
                . "'" . $this->description . "',"
                . "'" . $this->url . "',"
                . "'" . $this->imageName . "',"
                . "'" . $this->user . "',"
                . "'" . 0 . "'"
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

        $query = "SELECT * FROM `notification` ORDER BY `url` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `notification` SET "
                . "`is_viewed` = 1 "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function updateAllAsViewed() {

        $query = "UPDATE  `notification` SET "
                . "`is_viewed` = 1 "
                . "WHERE `is_viewed` = 0";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `notification` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function countUnviewedNotifications($id) {

        $query = "SELECT count(`id`) AS `count` FROM `notification` WHERE `user`= $id AND `is_viewed`=0 ORDER BY `created_at` DESC";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }

    public function getUnviewedNotifications($id) {

        $query = "SELECT * FROM `notification` WHERE `user`= $id AND `is_viewed`=0 ORDER BY `created_at` DESC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
