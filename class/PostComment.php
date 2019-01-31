<?php

/**
 * Description of PostComment
 *
 * @author W j K n ¨
 */
class PostComment {

    public $id;
    public $post;
    public $member;
    public $comment;
    public $commented_at;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`post`,`member`,`comment`, `commented_at` FROM `post_comment` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->post = $result['post'];
            $this->member = $result['member'];
            $this->comment = $result['comment'];
            $this->commented_at = $result['commented_at'];

            return $this;
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `post_comment` (`post`, `member`, `comment`, `commented_at`) VALUES  ('" . $this->post . "','" . $this->member . "','" . $this->comment . "', '" . $date . "')";

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

        $query = "SELECT * FROM `post_comment` ORDER BY `commented_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = 'UPDATE `post_comment` SET '
                . '`comment`= "' . $this->comment . '" '
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

        $query = 'DELETE FROM `post_comment` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getCountOfCommentsByPostID($post) {

        $query = "SELECT count(`id`) AS `count` FROM `post_comment` WHERE `post` = " . $post;
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function getCommentsByPostID($post) {

        $query = "SELECT * FROM `post_comment` WHERE `post` = " . $post . " ORDER BY `commented_at` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
