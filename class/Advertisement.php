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

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`member`,`group_id`,`title`,`description`,`price`,`city`,`address`,`phone_number`,`email`,`category`,`sub_category`,`website`,`status` FROM `advertisement` WHERE `id`=" . $id;

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

        $query = "SELECT * FROM `advertisement` ORDER BY `created_at` DESC LIMIT " . $pageLimit . " , " . $setLimit . "";
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

    public function getAdsAndPostsByMember($member) {

        $query = "SELECT `id`, 'ad' AS `type`, `created_at` FROM `advertisement` WHERE `group_id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member) AND `member` <> $member UNION ALL SELECT `id`, 'post' AS `type`, `created_at` FROM `post` WHERE `member` in (SELECT `member` FROM `friends` WHERE `friend` = $member) OR `member` IN (SELECT `friend` FROM `friends` WHERE `member` = $member) ORDER BY `created_at` DESC";
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
        
        $query = "SELECT count(*) AS totalCount FROM `advertisement` ORDER BY `created_at` DESC";

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
            $setPaginate .= "<ul class='pagination justify-content-center'>";
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

}
