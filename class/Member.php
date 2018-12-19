<?php
/**
 * Description of Member
 *
 * @author W j K n ¨
 */
class Member {

    public $id;
    public $createdAt;
    public $firstName;
    public $lastName;
    public $email;
    public $phoneNumber;
    public $profilePicture;
    public $coverPicture;
    public $district;
    public $city;
    public $address;
    public $authToken;
    public $lastLogin;
    public $resetCode;
    private $password;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`first_name`,`last_name`,`email`,`phone_number`,`profile_picture`,`cover_picture`,`district`,`city`,`address`,`auth_token`,`last_login`,`reset_code`,`status` FROM `member` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['created_at'];
            $this->firstName = $result['first_name'];
            $this->lastName = $result['last_name'];
            $this->email = $result['email'];
            $this->phoneNumber = $result['phone_number'];
            $this->profilePicture = $result['profile_picture'];
            $this->coverPicture = $result['cover_picture'];
            $this->district = $result['district'];
            $this->city = $result['city'];
            $this->address = $result['address'];
            $this->authToken = $result['auth_token'];
            $this->lastLogin = $result['last_login'];
            $this->resetCode = $result['reset_code'];
            $this->status = $result['status'];

            return $result;
        }
    }

    public function create() {

        $enPass = md5($passwor);
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `member` ("
                . "created_at, "
                . "first_name, "
                . "last_name, "
                . "email, "
                . "status, "
                . "password"
                . ") VALUES  ("
                . "'" . $createdAt . "', "
                . "'" . $this->firstName . "', "
                . "'" . $this->lastLogin . "', "
                . "'" . $this->email . "', "
                . "'" . $this->status . "', "
                . "'" . $enPass . "'"
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

    public function login($email, $password) {

        $query = "SELECT `id` FROM `member` WHERE `email`= '" . $email . "' AND `password`= '" . $password . "'";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
            $this->setLastLogin($this->id);

            $member = $this->__construct($this->id);

            $this->setUserSession($member);

            return $member;
        }
    }

    public function checkOldPass($id, $password) {

        $enPass = md5($password);

        $query = "SELECT `id` FROM `member` WHERE `id`= '" . $id . "' AND `password`= '" . $enPass . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function changePassword($id, $password) {

        $enPass = md5($password);
        $query = "UPDATE  `member` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function authenticate() {

        if (!isset($_SESSION)) {
            session_start();
        }

        $id = NULL;
        $authToken = NULL;

        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
        }

        if (isset($_SESSION["authToken"])) {
            $authToken = $_SESSION["authToken"];
        }

        $query = "SELECT `id` FROM `member` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function logOut() {

        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION["id"]);
        unset($_SESSION["created_at"]);
        unset($_SESSION["first_name"]);
        unset($_SESSION["last_name"]);
        unset($_SESSION["email"]);
        unset($_SESSION["phone_number"]);
        unset($_SESSION["profile_picture"]);
        unset($_SESSION["cover_picture"]);
        unset($_SESSION["district"]);
        unset($_SESSION["city"]);
        unset($_SESSION["address"]);
        unset($_SESSION["auth_token"]);
        unset($_SESSION["last_login"]);
        unset($_SESSION["status"]);

        return TRUE;
    }

    public function update() {

        $query = "UPDATE  `member` SET "
                . "`first_name` ='" . $this->name . "', "
                . "`last_name` ='" . $this->membername . "', "
                . "`phone_number` ='" . $this->email . "', "
                . "`profile_picture` ='" . $this->email . "', "
                . "`cover_picture` ='" . $this->email . "', "
                . "`district` ='" . $this->email . "', "
                . "`city` ='" . $this->email . "', "
                . "`address` ='" . $this->email . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    private function setUserSession($member) {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION["id"] = $member['id'];
        $_SESSION["created_at"] = $member['created_at'];
        $_SESSION["first_name"] = $member['first_name'];
        $_SESSION["last_name"] = $member['last_name'];
        $_SESSION["email"] = $member['email'];
        $_SESSION["phone_number"] = $member['phone_number'];
        $_SESSION["profile_picture"] = $member['profile_picture'];
        $_SESSION["cover_picture"] = $member['cover_picture'];
        $_SESSION["district"] = $member['district'];
        $_SESSION["city"] = $member['city'];
        $_SESSION["address"] = $member['address'];
        $_SESSION["auth_token"] = $member['auth_token'];
        $_SESSION["last_login"] = $member['last_login'];
        $_SESSION["status"] = $member['status'];
    }

    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `member` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {

            return $authToken;
        } else {
            return FALSE;
        }
    }

    private function setLastLogin($id) {

        date_default_timezone_set('Asia/Colombo');

        $now = date('Y-m-d H:i:s');

        $query = "UPDATE `member` SET `lastLogin` ='" . $now . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function checkEmail($email) {

        $query = "SELECT `email` FROM `member` WHERE `email`= '" . $email . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }

    public function GenarateCode($email) {

        $rand = rand(10000, 99999);

        $query = "UPDATE  `member` SET "
                . "`resetcode` ='" . $rand . "' "
                . "WHERE `email` = '" . $email . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function SelectForgetUser($email) {

        if ($email) {

            $query = "SELECT `email`,`resetcode` FROM `member` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->email = $result['email'];
            $this->restCode = $result['resetcode'];

            return $result;
        }
    }

    public function SelectResetCode($code) {

        $query = "SELECT `id` FROM `member` WHERE `resetcode`= '" . $code . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function updatePassword($password, $code) {

        $enPass = md5($password);

        $query = "UPDATE  `member` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `resetcode` = '" . $code . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}