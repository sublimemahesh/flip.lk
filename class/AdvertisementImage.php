<?php

/**
 * Description of AdvertisementImage
 *
 * @author W j K n ¨
 */
class AdvertisementImage {
    public $id;
    public $advertisement;
    public $imageName;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`advertisement`,`image_name`,`sort` FROM `advertisement_image` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->advertisement = $result['advertisement'];
            $this->imageName = $result['image_name'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `advertisement_image` ("
                . "`advertisement`,"
                . "`image_name`,"
                . "`sort`) "
                . "VALUES  ("
                . "'" . $this->advertisement . "',"
                . "'" . $this->imageName . "',"
                . "'" . $this->sort . "'"
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

        $query = "SELECT * FROM `advertisement_image` ORDER BY `sort` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `advertisement_image` SET "
                . "`advertisement` ='" . $this->advertisement . "', "
                . "`image_name` ='" . $this->imageName . "' "
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

        $query = 'DELETE FROM `advertisement_image` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getPhotosByAdId($advertisement) {

        $query = "SELECT * FROM `advertisement_image` WHERE  `advertisement` = $advertisement";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
}
