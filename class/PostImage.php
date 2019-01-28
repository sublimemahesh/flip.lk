<?php

/**
 * Description of PostImage

 * @author W j K n ¨
 */
class PostImage {

    public $id;
    public $post;
    public $imageName;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`post`,`image_name`,`sort` FROM `post_image` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->post = $result['post'];
            $this->imageName = $result['image_name'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `post_image` ("
                . "`post`,"
                . "`image_name`,"
                . "`sort`) "
                . "VALUES  ("
                . "'" . $this->post . "',"
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

        $query = "SELECT * FROM `post_image` ORDER BY `sort` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `post_image` SET "
                . "`post` ='" . $this->post . "', "
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

        $query = 'DELETE FROM `post_image` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getPhotosByPostId($post) {

        $query = "SELECT * FROM `post_image` WHERE  `post` = $post";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
