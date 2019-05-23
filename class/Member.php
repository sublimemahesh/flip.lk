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
    public $districtString;
    public $city;
    public $cityString;
    public $address;
    public $dob;
    public $occupation;
    public $gender;
    public $civilStatus;
    public $aboutMe;
    public $category;
    public $subCategory;
    public $facebookID;
    public $googleID;
    public $authToken;
    public $lastLogin;
    public $resetCode;
    public $password;
    public $status;
    public $isConfirmed;
    public $isSuspend;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`first_name`,`last_name`,`email`,`phone_number`,`profile_picture`,`cover_picture`,`district`,`district_string`,`city`,`city_string`,`address`,`dob`,`occupation`,`gender`,`civil_status`,`about_me`,`category`,`sub_category`,`facebook_id`,`google_id`,`auth_token`,`last_login`,`reset_code`,`status`,`is_confirmed`,`is_suspend` FROM `member` WHERE `id`=" . $id;

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
            $this->districtString = $result['district_string'];
            $this->city = $result['city'];
            $this->cityString = $result['city_string'];
            $this->address = $result['address'];
            $this->dob = $result['dob'];
            $this->occupation = $result['occupation'];
            $this->gender = $result['gender'];
            $this->civilStatus = $result['civil_status'];
            $this->aboutMe = $result['about_me'];
            $this->category = $result['category'];
            $this->subCategory = $result['sub_category'];
            $this->facebookID = $result['facebook_id'];
            $this->googleID = $result['google_id'];
            $this->authToken = $result['auth_token'];
            $this->lastLogin = $result['last_login'];
            $this->resetCode = $result['reset_code'];
            $this->status = $result['status'];
            $this->isConfirmed = $result['is_confirmed'];
            $this->isSuspend = $result['is_suspend'];

            return $result;
        }
    }

    public function create() {

        $enPass = md5($this->password);
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
                . "'" . $this->lastName . "', "
                . "'" . $this->email . "', "
                . "'" . 1 . "', "
                . "'" . $enPass . "'"
                . ")";

        $db = new Database();

        $result = $db->readQuery($query);
        if ($result) {
            $last_id = mysql_insert_id();
            $details = $this->__construct($last_id);
            Member::GenarateCode($details['email']);
            return $details;
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `member` ORDER BY `created_at` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function login($email, $password) {

        $query = "SELECT `id`, `is_suspend` FROM `member` WHERE `email`= '" . $email . "' AND `password`= '" . $password . "'";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            if ($result['is_suspend'] == 0) {

                $this->id = $result['id'];
                $this->setAuthToken($result['id']);
                $this->setLastLogin($this->id);
                $member = $this->__construct($this->id);
                $this->setUserSession($member);

                return $member;
            } else {
                return 'deactive member';
            }
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

    public function changePassword() {

        $enPass = md5($this->password);
        $query = "UPDATE  `member` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `id` = '" . $this->id . "'";

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

        if (isset($_SESSION["auth_token"])) {
            $authToken = $_SESSION["auth_token"];
        }
        $query = "SELECT `id` FROM `member` WHERE `id`= '" . $id . "' AND `auth_token`= '" . $authToken . "'";

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
        unset($_SESSION["district_string"]);
        unset($_SESSION["city"]);
        unset($_SESSION["city_string"]);
        unset($_SESSION["address"]);
        unset($_SESSION["auth_token"]);
        unset($_SESSION["last_login"]);
        unset($_SESSION["status"]);

        return TRUE;
    }

    public function update() {

        $query = "UPDATE  `member` SET "
                . "`first_name` ='" . $this->firstName . "', "
                . "`last_name` ='" . $this->lastName . "', "
                . "`phone_number` ='" . $this->phoneNumber . "', "
                . "`district` ='" . $this->district . "', "
                . "`district_string` ='" . $this->districtString . "', "
                . "`city` ='" . $this->city . "', "
                . "`city_string` ='" . $this->cityString . "', "
                . "`address` ='" . $this->address . "', "
                . "`dob` ='" . $this->dob . "', "
                . "`occupation` ='" . $this->occupation . "', "
                . "`gender` ='" . $this->gender . "', "
                . "`civil_status` ='" . $this->civilStatus . "', "
                . "`about_me` ='" . $this->aboutMe . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function updateProfilePicture() {

        $query = "UPDATE  `member` SET "
                . "`profile_picture` ='" . $this->profilePicture . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function updateCoverPicture() {

        $query = "UPDATE  `member` SET "
                . "`cover_picture` ='" . $this->coverPicture . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function updateBusinessCategory() {

        $query = "UPDATE  `member` SET "
                . "`category` ='" . $this->category . "', "
                . "`sub_category` ='" . $this->subCategory . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function updateEmailConfirmationStatus() {

        $query = "UPDATE  `member` SET "
                . "`is_confirmed` ='" . $this->isConfirmed . "' "
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
        $_SESSION["district_string"] = $member['district_string'];
        $_SESSION["city"] = $member['city'];
        $_SESSION["city_string"] = $member['city_string'];
        $_SESSION["address"] = $member['address'];
        $_SESSION["auth_token"] = $member['auth_token'];
        $_SESSION["last_login"] = $member['last_login'];
        $_SESSION["status"] = $member['status'];
    }

    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));
        $query = "UPDATE `member` SET `auth_token` ='" . $authToken . "' WHERE `id`='" . $id . "'";

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

        $query = "UPDATE `member` SET `last_login` ='" . $now . "' WHERE `id`='" . $id . "'";

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
                . "`reset_code` ='" . $rand . "' "
                . "WHERE `email` = '" . $email . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function SelectForgetMember($email) {

        if ($email) {

            $query = "SELECT `email`,`reset_code` FROM `member` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->email = $result['email'];
            $this->restCode = $result['reset_code'];

            return $result;
        }
    }

    public function SelectResetCode($code) {

        $query = "SELECT `id`, `email` FROM `member` WHERE `reset_code`= '" . $code . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return $result;
        }
    }

    public function updatePassword($password, $code) {

        $enPass = md5($password);

        $query = "UPDATE  `member` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `reset_code` = '" . $code . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getIdByPassword($password) {

        $enPass = md5($password);

        $query = "SELECT `id` FROM `member` WHERE `password`= '" . $enPass . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }

    public function countMembers() {

        $query = "SELECT count(`id`) as count FROM `member` WHERE `is_suspend` = 0 AND `status` = 1";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }

    public function sendConfirmationEmail() {

        $MEMBER = new Member($this->id);

        $member_f_name = $MEMBER->firstName;
        $member_l_name = $MEMBER->lastName;
        $member_image_name = $MEMBER->profilePicture;
        $member_email = $MEMBER->email;
        $member_id = $MEMBER->id;
        $code = $MEMBER->resetCode;
        $site_link = "http://" . $_SERVER['HTTP_HOST'];
        $website_name = 'www.flip.lk';
        $comany_name = 'Flip.lk';
        $comConNumber = '+94 788918561';
        $comEmail = 'support@flip.lk';
        date_default_timezone_set('Asia/Colombo');

        $todayis = date("l, F j, Y, g:i a");

        $subject = 'Confirm Your Email';
        $from = 'support@flip.lk'; // give from email address


        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                <title>Srilanka Tourism Email Template</title>
                            </head>

                            <body bgcolor="#8d8e90">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
                                    <tr>
                                        <td>
                                            <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #c8d6d8;">
                                                            <tr>
                                                                <td style="border-collapse:collapse" width="100%" height="12">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border-collapse:collapse" valign="middle" align="center">
                                                                    <img alt="Logo" src="' . $site_link . '/flip.lk/member/img/logo/logo.png" style="outline:none;text-decoration:none;border:none" class="CToWUd" height="55px" align="middle">
                                                                </td>
                                                            </tr>           
                                                            <tr>
                                                                <td style="border-collapse:collapse" width="100%" height="12">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-collapse:collapse" width="600" align="center">
                                                        <table style="border-collapse:collapse;border:1px; border-color:#e8ecee; border-radius:0px 0px 16px 16px; width:100%; max-width:600px" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="3" style="border-collapse:collapse" width="100%" height="20"></td>
                                                                </tr> 
                                                                <tr>
                                                                    <td style="border-collapse:collapse" width="48"></td>
                                                                    <td style="border-collapse:collapse" valign="middle">
                                                                        <table style="border-collapse:collapse;border:1px;border-color:#e8ecee;border-radius:0px 0px 16px 16px;width:100%;max-width:632px" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="border-collapse:collapse;font-size:24px;font-weight:bold;color:#ff4b04;line-height:28px;padding-left:9px;padding-top:15px;padding-bottom:12px">
                                                                                        Confirm your email.
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="border-collapse:collapse;font-size:15px;font-weight:normal;line-height:20px">
                                                                                        <img style="outline:none;text-decoration:none;border:none;width:513px;padding-left:9px;padding-right:9px;display:block;padding-top:10px" src="https://ci3.googleusercontent.com/proxy/-wOUA68Jt1jPBZ8p-sDeiPQEXMZuOhyFUeZ7-a5PgowNs8DlkvRao8ok5xImz9PAhD4JUTv-UqOuFvS8evnV6el1=s0-d-e1-ft#https://a.edim.co/waterboy/subdivider@2x.png" class="CToWUd">
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td style="border-collapse:collapse">
                                                                                        <table style="border-collapse:collapse;border:1px;border-color:#e8ecee;border-radius:0px 0px 16px 16px;width:100%;max-width:632px;background:#ffffff" width="100%" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="border-collapse:collapse" width="5"></td>
                                                                                                    <td style="border-collapse:collapse" width="450">

                                                                                                        <table style="border-collapse:collapse;border:1px;border-color:#e8ecee;border-radius:0px 0px 16px 16px;width:100%;max-width:632px; margin-top:10px;" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <!--<td style="border-collapse:collapse" width="40" valign="top" align="right">
                                                                                                                        <img style="outline:none;text-decoration:none;border:none;display:block;border-radius:12px" src="' . $site_link . '/flip.lk/upload/member/' . $member_image_name . '" class="CToWUd" width="60">
                                                                                                                    </td>-->
                                                                                                                    <td style="border-collapse:collapse" width="8" valign="top"></td>
                                                                                                                    <td style="border-collapse:collapse;min-width:100%" width="400" valign="top">
                                                                                                                        <div style="line-height:20px;color:#888;text-align:left;font-size:13px!important;color:rgba(0,0,0,0.8)">

                                                                                                                            <span style="font-weight:bold;font-size:15px;opacity:0.8"> Please confirm your email using following link. </span>
                                                                                                                            <h4> Your code is ' . $code . '</h4>
                                                                                                                                <br>
                                                                                                                            
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                    <td style="border-collapse:collapse" width="20"></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td style="border-collapse:collapse"></td>
                                                                                                </tr> 
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td colspan="4" style="border-collapse:collapse" align="center">      
                                                                                        <table style="border-collapse:collapse;border:1px;border-color:#e8ecee;border-radius:0px 0px 16px 16px;width:100%;max-width:632px;width:300px" width="300" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="border-collapse:collapse" align="center">

                                                                                                        <a href="' . $site_link . '/flip.lk/member/confirm-email.php?id=' . $member_id . '" style="text-decoration:none;color:#24c7ff;text-align:center;font-size:16px;font-family:Helvetica,Arial,sans-serif;color:#ffffff;text-decoration:none;color:#ffffff;text-decoration:none;padding:10px;border-radius:6px;border:1px solid #24c7ff;display:inline-block;width:266px;background-color:#24c7ff; margin-top: 15px;" target="_blank"> 
                                                                                                        Confirm email
                                                                                                        </a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td style="border-collapse:collapse" width="46"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3" style="border-collapse:collapse" width="100%" height="48"></td>
                                                                </tr> 
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="2%" align="center">&nbsp;</td>
                                                                <td width="29%" align="center">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:8px; " >
                                                                        <strong>Phone No : <br/> ' . $comConNumber . ' </strong>
                                                                    </font>
                                                                </td>
                                                                <td width="2%" align="center">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:8px; " >
                                                                        <strong>|</strong>
                                                                    </font>
                                                                </td>
                                                                <td width="30%" align="center">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:8px; " >
                                                                        <strong>Website : <br/> ' . $website_name . '  </strong>
                                                                    </font>
                                                                </td>
                                                                <td width="2%" align="center">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:8px; " >
                                                                        <strong>|</strong>
                                                                    </font>
                                                                </td>
                                                                <td width="25%" align="center">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:8px; " >
                                                                        <strong>E-mail :  <br/> ' . $comEmail . '</strong>
                                                                    </font>
                                                                </td> 
                                                            </tr>
                                                        </table>
                                                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%" align="center">&nbsp;</td>
                                                                <td width="28%" align="center"><font style="font-family: Verdana, Geneva, sans-serif; color:#1400FF; font-size:9px; " > © ' . date('Y') . ' Copyright ' . $comany_name . '</font> </td>
                                                                <td width="10%" align="center"></td>
                                                                <td width="3%" align="center"></td> 
                                                                <td width="30%" align="right">
                                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#1400FF; font-size:9px; " > 
                                                                        <a href="http://www.sublime.lk/">
                                                                            web solution by: Sublime Holdings</a>
                                                                    </font>
                                                                </td>
                                                                <td width="5%">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </body>
                        </html>';

        if (mail($member_email, $subject, $html, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getAllMembersWithoutThis($member) {
        $query = "SELECT * FROM `member` WHERE `id` <> '" . $member . "' AND `status` = 1 AND `is_suspend` = 0";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getMembersByKeyword($keyword) {
        $query = "SELECT * FROM `member` WHERE (`first_name` LIKE '%" . $keyword . "%' OR `last_name` LIKE '%" . $keyword . "%') AND `status` = 1 AND `is_suspend` = 0 ORDER BY CASE
        WHEN `first_name` LIKE '" . $keyword . "%' THEN 1
        ELSE 2 END";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getFriendsByKeyword($keyword, $member) {
        $query = "SELECT * FROM `member` WHERE (`first_name` LIKE '%" . $keyword . "%' OR `last_name` LIKE '%" . $keyword . "%') AND `id` in (SELECT `friend` FROM `friends` WHERE `member` = $member) OR `id` in (SELECT `member` FROM `friends` WHERE `friend` = $member)  AND `status` = 1 AND `is_suspend` = 0 ORDER BY CASE
        WHEN `first_name` LIKE '" . $keyword . "%' THEN 1
        ELSE 2 END";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getMembersForInviteGroups($keyword, $member) {
//        $query = "SELECT * FROM `member` WHERE (`first_name` LIKE '%" . $keyword . "%' OR `last_name` LIKE '%" . $keyword . "%') AND `status` = 1";
        $query = "SELECT * FROM `member` WHERE (`id` IN (SELECT `friend` FROM `friends` WHERE `member` = $member) OR `id` IN (SELECT `member` FROM `friends` WHERE `friend` = $member)) AND (`first_name` LIKE '%" . $keyword . "%' OR `last_name` LIKE '%" . $keyword . "%') AND `status` = 1  AND `is_suspend` = 0";
//        $query = "SELECT * FROM `member` WHERE id IN (SELECT `id` FROM `member` WHERE (`first_name` LIKE '%" . $keyword . "%' OR `last_name` LIKE '%" . $keyword . "%') AND `id` IN (SELECT `id` FROM `friends` WHERE `member` = $member OR `friend` = $member))";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function ChangeProPic($member, $file) {

        $query = "UPDATE  `member` SET "
                . "`profile_picture` ='" . $file . "' "
                . "WHERE `id` = '" . $member . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function ChangeCoverPic($member, $file) {

        $query = "UPDATE  `member` SET "
                . "`cover_picture` ='" . $file . "' "
                . "WHERE `id` = '" . $member . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateStatus() {

        $query = "UPDATE  `member` SET "
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

    public function suspendMember() {

        $query = "UPDATE  `member` SET "
                . "`is_suspend` ='" . $this->isSuspend . "' "
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

        unlink(Helper::getSitePath() . "upload/member/" . $this->profilePicture);
        unlink(Helper::getSitePath() . "upload/group/cover-picture/" . $this->coverPicture);

        if (GroupMember::deleteAllMembersInGroup($this->id)) {
            $query = 'DELETE FROM `groups` WHERE id="' . $this->id . '"';

            $db = new Database();

            return $db->readQuery($query);
        }
    }

    public function deleteMember() {


        unlink(Helper::getSitePath() . "upload/member/" . $this->profilePicture);

        unlink(Helper::getSitePath() . "upload/member/cover-picture/" . $this->coverPicture);

        unlink(Helper::getSitePath() . "upload/member/cover-picture/thumb/" . $this->coverPicture);

        $query = 'DELETE FROM `member` WHERE id="' . $this->id . '"';
        $db = new Database();

        return $db->readQuery($query);
    }

    public function isFbIdIsEx($memberID) {

        $query = "SELECT * FROM `member` WHERE `facebook_id` = '" . $memberID . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    public function createByFB($name, $email, $picture, $memberID, $password) {
//        date_default_timezone_set('Asia/Colombo');
//
//        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `member` (`first_name`,`email`,`profile_picture`,`facebook_id`,`password`,`status`) VALUES  ('" . $name . "', '" . $email . "', '" . $picture . "', '" . $memberID . "', '" . $password . "', 1)";

        $db = new Database();

        $result = $db->readQuery($query);

        $last_id = mysql_insert_id();

        if ($result) {

            $this->loginByFB($memberID, $password);

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function loginByFB($memberID, $password) {

        $query = "SELECT * FROM `member` WHERE `facebook_id`= '" . $memberID . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {
            if ($result['is_suspend'] == 0) {

                $this->id = $result['id'];
                $this->setAuthToken($result['id']);
                $this->setLastLogin($this->id);
                $member = $this->__construct($this->id);
                if (!isset($_SESSION)) {
                    session_start();
                    session_unset($_SESSION);
                }
                $this->setUserSession($member);

                return $member;
            } else {
                return 'deactive member';
            }
//            $this->id = $result['id'];
//            $member = $this->__construct($this->id);
//
//            if (!isset($_SESSION)) {
//                session_start();
//                session_unset($_SESSION);
//            }
//
//            $_SESSION["login"] = TRUE;
//
//            $_SESSION["id"] = $member["id"];
//
//            return TRUE;
        }
    }

    public function isGoogleIdIsEx($memberID) {

        $query = "SELECT * FROM `member` WHERE `google_id` = '" . $memberID . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    public function createByGoogle($name, $email, $picture, $memberID, $password) {
//        date_default_timezone_set('Asia/Colombo');
//
//        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `member` (`first_name`,`email`,`profile_picture`,`google_id`,`password`, `status`) VALUES  ('" . $name . "', '" . $email . "', '" . $picture . "', '" . $memberID . "', '" . $password . "', 1)";

        $db = new Database();

        $result = $db->readQuery($query);

        $last_id = mysql_insert_id();

        if ($result) {

            $this->loginByGoogle($memberID, $password);

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function loginByGoogle($memberID, $password) {

        $query = "SELECT * FROM `member` WHERE `google_id`= '" . $memberID . "' AND `password`= '" . $password . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            if ($result['is_suspend'] == 0) {

                $this->id = $result['id'];
                $this->setAuthToken($result['id']);
                $this->setLastLogin($this->id);
                $member = $this->__construct($this->id);
                if (!isset($_SESSION)) {
                    session_start();
                    session_unset($_SESSION);
                }
                $this->setUserSession($member);

                return $member;
            } else {
                return 'deactive member';
            }

//            $this->id = $result['id'];
//
//            $member = $this->__construct($this->id);
//
//            if (!isset($_SESSION)) {
//                session_start();
//                session_unset($_SESSION);
//            }
//
//            $_SESSION["login"] = TRUE;
//            $_SESSION["id"] = $member["id"];
//
//            return TRUE;
        }
    }

}
