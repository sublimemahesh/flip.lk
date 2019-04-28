<?php

/**
 * Description of Advertisement
 *
 * @author W j K n ¨
 */
class Advertisement {

    public $id;
    public $createdAt;
    public $member;
    public $groupId;
    public $title;
    public $description;
    public $price;
    public $city;
    public $address;
    public $phoneNumber;
    public $email;
    public $category;
    public $subCategory;
    public $website;
    public $status;
    public $isSuspend;
    public $boostFrom;
    public $boostTo;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`member`,`group_id`,`title`,`description`,`price`,`city`,`address`,`phone_number`,`email`,`category`,`sub_category`,`website`,`status`,`boost_from`,`boost_to` FROM `advertisement` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['created_at'];
            $this->member = $result['member'];
            $this->groupId = $result['group_id'];
            $this->title = $result['title'];
            $this->description = $result['description'];
            $this->price = $result['price'];
            $this->city = $result['city'];
            $this->address = $result['address'];
            $this->phoneNumber = $result['phone_number'];
            $this->email = $result['email'];
            $this->category = $result['category'];
            $this->subCategory = $result['sub_category'];
            $this->website = $result['website'];
            $this->status = $result['status'];
            $this->boostFrom = $result['boost_from'];
            $this->boostTo = $result['boost_to'];

            return $result;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `advertisement` ("
                . "`created_at`, "
                . "`member`, "
                . "`group_id`, "
                . "`title`, "
                . "`description` , "
                . "`price` , "
                . "`city`, "
                . "`address`, "
                . "`phone_number`, "
                . "`email`, "
                . "`category`, "
                . "`sub_category`, "
                . "`website`, "
                . "`status`"
                . ") VALUES  ("
                . "'" . $createdAt . "', "
                . "'" . $this->member . "', "
                . "'" . $this->groupId . "', "
                . "'" . $this->title . "', "
                . "'" . $this->description . "', "
                . "'" . $this->price . "', "
                . "'" . $this->city . "', "
                . "'" . $this->address . "', "
                . "'" . $this->phoneNumber . "', "
                . "'" . $this->email . "', "
                . "'" . $this->category . "', "
                . "'" . $this->subCategory . "', "
                . "'" . $this->website . "', "
                . "'" . $this->status . "'"
                . ")";
        $db = new Database();

        $result = $db->readQuery($query);
        if ($result) {
            $last_id = mysql_insert_id();
            $details = $this->__construct($last_id);
            return $details;
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `advertisement` SET "
                . "`title` ='" . $this->title . "', "
                . "`description` ='" . $this->description . "', "
                . "`price` ='" . $this->price . "', "
                . "`city` ='" . $this->city . "', "
                . "`address` ='" . $this->address . "', "
                . "`phone_number` ='" . $this->phoneNumber . "', "
                . "`email` ='" . $this->email . "', "
                . "`website` ='" . $this->website . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `advertisement` ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getAllAdvertisements($pageLimit, $setLimit) {

        $query = "SELECT * FROM `advertisement` WHERE `status` = 1 ORDER BY `created_at` DESC LIMIT " . $pageLimit . " , " . $setLimit . "";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getBoostAdvertisements() {
        date_default_timezone_set('Asia/Colombo');
        $today = date('Y-m-d');

        $query = "SELECT * FROM `advertisement` WHERE `status` = 1 AND '" . $today . "' BETWEEN `boost_from` AND `boost_to` ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getAdsInAnyGroupsByMember($member) {

        $query = "SELECT * FROM `advertisement` WHERE `group_id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member) AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getAdsByCategory($category) {

        $query = "SELECT * FROM `advertisement` WHERE `category` = $category AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function countAdsByCategory($category) {

        $query = "SELECT count(`id`) AS `count` FROM `advertisement` WHERE `category` = $category AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }

    public function getAdsBySubCategory($subcategory) {

        $query = "SELECT * FROM `advertisement` WHERE `sub_category` = $subcategory AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function countAdsBySubCategory($subcategory) {

        $query = "SELECT count(`id`) AS `count` FROM `advertisement` WHERE `sub_category` = $subcategory AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }

    public function getAllAdsAndPostsByMember($member) {

        $query = "SELECT `id`, 'ad' AS `type`, `created_at` FROM `advertisement` WHERE `group_id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member) AND `member` <> $member AND `status` = 1 UNION ALL SELECT `id`, 'post' AS `type`, `created_at` FROM `post` WHERE `member` in (SELECT `member` FROM `friends` WHERE `friend` = $member) OR `member` IN (SELECT `friend` FROM `friends` WHERE `member` = $member) ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getAdsAndPostsByMember($member, $offset, $limit) {

        $query = "SELECT `id`, 'ad' AS `type`, `created_at` FROM `advertisement` WHERE `group_id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member) AND `member` <> $member AND `status` = 1 UNION ALL SELECT `id`, 'post' AS `type`, `created_at` FROM `post` WHERE `member` in (SELECT `member` FROM `friends` WHERE `friend` = $member) OR `member` IN (SELECT `friend` FROM `friends` WHERE `member` = $member) ORDER BY `created_at` DESC LIMIT $offset, $limit";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getCountOfAdsAndPostsByMember($member) {

        $query = "SELECT `id`, 'ad' AS `type`, `created_at` FROM `advertisement` WHERE `group_id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member) AND `member` <> $member AND `status` = 1 UNION ALL SELECT `id`, 'post' AS `type`, `created_at` FROM `post` WHERE `member` in (SELECT `member` FROM `friends` WHERE `friend` = $member) OR `member` IN (SELECT `friend` FROM `friends` WHERE `member` = $member) ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        $query = 'DELETE FROM `advertisement` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function deleteAdvertisement() {

        foreach (AdvertisementImage::getPhotosByAdId($this->id) as $key => $adimg) {
            unlink(Helper::getSitePath() . "upload/advertisement/" . $adimg['image_name']);
            unlink(Helper::getSitePath() . "upload/advertisement/thumb/" . $adimg['image_name']);
            unlink(Helper::getSitePath() . "upload/advertisement/thumb2/" . $adimg['image_name']);

            $AD = new AdvertisementImage($adimg['id']);
            $AD->delete();
        }

        $query = 'DELETE FROM `advertisement` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getAdsByGroup($group) {

        $query = "SELECT * FROM `advertisement` WHERE `group_id` = $group AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getAdsByMember($member) {

        $query = "SELECT * FROM `advertisement` WHERE `member` = $member ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function updateStatus() {

        $query = "UPDATE  `advertisement` SET "
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

    public function boostAd() {

        $query = "UPDATE  `advertisement` SET "
                . "`boost_from` ='" . $this->boostFrom . "', "
                . "`boost_to` ='" . $this->boostTo . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function suspendAdvertisement() {

        $query = "UPDATE  `advertisement` SET "
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

    public function getPublishedAdsByGroup($group) {

        $query = "SELECT * FROM `advertisement` WHERE `group_id` = $group AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getUnpublishedAdsByGroup($group) {

        $query = "SELECT * FROM `advertisement` WHERE `group_id` = $group AND `status` = 0 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function searchAdvertisements($category, $subcategory, $location, $keyword, $pageLimit, $setLimit) {

        $w = array();
        $where = '';

        if (!empty($category)) {
            $w[] = "`category` = '" . $category . "'";
        }
        if (!empty($subcategory)) {
            $w[] = "`sub_category` = '" . $subcategory . "'";
        }
        if (!empty($location)) {
            $w[] = "`city` LIKE '" . $location . "'";
        }
        if (!empty($keyword)) {
            $w[] = "`title` LIKE '%" . $keyword . "%'";
        }
        $w[] = "`status` = 1";
        if (count($w)) {
            $where = 'WHERE ' . implode(' AND ', $w);
        }

        $query = "SELECT * FROM `advertisement` " . $where . " ORDER BY `created_at` DESC LIMIT " . $pageLimit . " , " . $setLimit . "";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function showPaginationOfSearchedAdvertisement($category, $subcategory, $location, $keyword, $per_page, $page) {

        $page_url = "?";

        $w = array();
        $where = '';

        if (!empty($category)) {
            $w[] = "`category` = '" . $category . "'";
        }
        if (!empty($subcategory)) {
            $w[] = "`sub_category` = '" . $subcategory . "'";
        }
        if (!empty($location)) {
            $w[] = "`city` LIKE '" . $location . "'";
        }
        if (!empty($keyword)) {
            $w[] = "`title` LIKE '%" . $keyword . "%'";
        }
        $w[] = "`status` = 1";
        if (count($w)) {
            $where = 'WHERE ' . implode(' AND ', $w);
        }

        $query = "SELECT count(*) AS totalCount FROM `advertisement` " . $where . " ORDER BY `created_at` DESC";

        $rec = mysql_fetch_array(mysql_query($query));

        $total = $rec['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;
        $setLastpage = ceil($total / $per_page);
        $lpm1 = $setLastpage - 1;

        $setPaginate = "";
        if ($setLastpage > 1) {
            $setPaginate .= "<ul class='setPaginate'>";
            $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $setLastpage; $counter++) {
                    if ($counter == $page)
                        $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                    else
                        $setPaginate .= "<li><a href='{$page_url}page=$counter&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>...</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate .= "<li><a href='{$page_url}page=1&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>2</a></li>";
                    $setPaginate .= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>..</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>$setLastpage</a></li>";
                }
                else {
                    $setPaginate .= "<li><a href='{$page_url}page=1&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>2</a></li>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<li><a href='{$page_url}page=$next&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>Next</a></li>";
                $setPaginate .= "<li><a href='{$page_url}page=$setLastpage&category=$category&subcategory=$subcategory&location=$location&keyword=$keyword'>Last</a></li>";
            } else {
                $setPaginate .= "<li><a class='current_page'>Next</a></li>";
                $setPaginate .= "<li><a class='current_page'>Last</a></li>";
            }

            $setPaginate .= "</ul>\n";
        }

        echo $setPaginate;
    }

    public function showPagination($per_page, $page) {

        $page_url = "?";

        $query = "SELECT count(*) AS totalCount FROM `advertisement` WHERE `status` = 1 ORDER BY `created_at` DESC";

        $rec = mysql_fetch_array(mysql_query($query));

        $total = $rec['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;
        $setLastpage = ceil($total / $per_page);
        $lpm1 = $setLastpage - 1;

        $setPaginate = "";
        if ($setLastpage > 1) {
            $setPaginate .= "<ul class='setPaginate'>";
            $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $setLastpage; $counter++) {
                    if ($counter == $page)
                        $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                    else
                        $setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>...</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate .= "<li><a href='{$page_url}page=1'>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2'>2</a></li>";
                    $setPaginate .= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
                    }
                    $setPaginate .= "<li class='dot'>..</li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=$setLastpage'>$setLastpage</a></li>";
                }
                else {
                    $setPaginate .= "<li><a href='{$page_url}page=1'>1</a></li>";
                    $setPaginate .= "<li><a href='{$page_url}page=2'>2</a></li>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate .= "<li><a href='{$page_url}page=$counter'>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<li><a href='{$page_url}page=$next'>Next</a></li>";
                $setPaginate .= "<li><a href='{$page_url}page=$setLastpage'>Last</a></li>";
            } else {
                $setPaginate .= "<li><a class='current_page'>Next</a></li>";
                $setPaginate .= "<li><a class='current_page'>Last</a></li>";
            }

            $setPaginate .= "</ul>\n";
        }

        echo $setPaginate;
    }

    public static function sendBoostAdEmailToAdmin($adid, $fromdate, $to) {

        //----------------------Company Information---------------------

        $AD = new Advertisement($adid);
        $MEMBER = new Member($AD->member);

        $from = 'info@flip.lk';
        $reply = $MEMBER->email;

        $subject = "New enquiry to boost advertisement | Flip.lk ";
        $site = 'flip.lk';

        // mandatory headers for email message, change if you need something different in your setting.
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $reply . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $USER = new User(1);

        $email = $USER->email;
        date_default_timezone_set('Asia/Colombo');
        $todayis = date('Y-m-d H:i:s');

        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>' . $subject . '</title>
    </head>

    <body bgcolor="#8d8e90">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
            <tr>
                <td>
                <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
                        <tr>
                            <td align="center" valign="middle">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="2%">&nbsp;</td>
                                        <td width="96%" align="center" style="border-bottom:1px solid #000000" height="50">
                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#1400FF; font-size:18px; " >
                                                   <h4> ' . $subject . '</h4>
                                            </font>
                                        </td>
                                        <td width="2%">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="5%">&nbsp;</td>
                                        <td width="90%" valign="middle">
                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; ">
                                                 Hi ' . $USER->name . ',
                                                <br /><br />
                                            </font>
                                        </td>
                                        <td width="5%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="5%">&nbsp;</td>
                                        <td width="90%" valign="middle">
                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                               You have a new boost advertisement enquiry from your website on ' . $todayis . ' as follows. Please pay your attention as soon as possible.
                                            </font>
                                        </td>
                                        <td width="5%">&nbsp;</td>
                                    </tr>
                                     <tr>
                                        <td width="5%">&nbsp;<br /><br /></td>
                                        <td width="90%" valign="middle">
                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                               We have successfully sent the acknowledgement to the sender.
                                            </font>
                                        </td>
                                        <td width="5%">&nbsp;</td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="2%">&nbsp;</td>
                                        <td width="96%" style="border-top:1px solid #000000" >
                                            
                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#1400FF; font-size:14px; " >
                                                   <h4>&nbsp;&nbsp;&nbsp;Enquiry Details</h4>
                                            </font>
                                            <ul>
                                              <li>
                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                         Name : ' . $MEMBER->firstName . ' ' . $MEMBER->lastName . '
                                                    </font>
                                                </li>
                                                
                                                <li>
                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                         Email : ' . $MEMBER->email . '
                                                    </font>
                                                </li>
                                                <li>
                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                         Advertisement : <a href="https://www.flip.lk/view-advertisement.php?id=' . $adid . '">' . $AD->title . '</a>
                                                    </font>
                                                </li>
                                                <li>
                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                         Boost From : ' . $fromdate . '
                                                    </font>
                                                </li>
                                                <li>
                                                    <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                         Boost To : ' . $to . '
                                                    </font>
                                                </li>
                                            </ul>
                                        </td>
                                        <td width="2%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                    <td><a href="https://www.flip.lk/admin/boost-advertisement.php?id=' . $adid . '">Boost Advertisement</a></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        
                    </table></td>
            </tr>
        </table>
    </body>
</html>';
        if (mail($email, $subject, $html, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
