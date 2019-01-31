<?php

/**
 * Description of PostCommentReply
 *
 * @author W j K n ¨
 */
class PostCommentReply {
    public $id;
    public $comment;
    public $member;
    public $reply;
    public $repliedAt;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`comment`,`member`,`reply`,`replied_at` FROM `post_comment_reply` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->comment = $result['comment'];
            $this->member = $result['member'];
            $this->reply = $result['reply'];
            $this->repliedAt = $result['replied_at'];

            return $this;
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d H:i:s');

        $query = "INSERT INTO `post_comment_reply` (`comment`, `member`, `reply`, `replied_at`) VALUES  ('" . $this->comment . "','" . $this->member . "','" . $this->reply . "', '" . $date . "')";

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

        $query = "SELECT * FROM `post_comment_reply` ORDER BY `replied_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = 'UPDATE `post_comment_reply` SET '
                . '`reply`= "' . $this->reply . '" '
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

        $query = 'DELETE FROM `post_comment_reply` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getCountOfRepliesByCommentID($comment) {

        $query = "SELECT count(`id`) AS `count` FROM `post_comment_reply` WHERE `comment` = " . $comment;
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function getRepliesByCommentID($comment) {

        $query = "SELECT * FROM `post_comment_reply` WHERE `comment` = " . $comment . " ORDER BY `replied_at` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
}