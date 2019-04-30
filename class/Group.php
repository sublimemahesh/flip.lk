<?php

/**
 * Description of Group
 *
 * @author W j K n ¨
 */
class Group {

    public $id;
    public $createdAt;
    public $name;
    public $member;
    public $category;
    public $subCategory;
    public $email;
    public $phoneNumber;
    public $profilePicture;
    public $coverPicture;
    public $district;
    public $city;
    public $address;
    public $description;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`name`,`member`,`category`,`sub_category`,`email`,`phone_number`,`profile_picture`,`cover_picture`,`district`,`city`,`address`,`description`,`status` FROM `groups` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['created_at'];
            $this->name = $result['name'];
            $this->member = $result['member'];
            $this->category = $result['category'];
            $this->subCategory = $result['sub_category'];
            $this->email = $result['email'];
            $this->phoneNumber = $result['phone_number'];
            $this->profilePicture = $result['profile_picture'];
            $this->coverPicture = $result['cover_picture'];
            $this->district = $result['district'];
            $this->city = $result['city'];
            $this->address = $result['address'];
            $this->description = $result['description'];
            $this->status = $result['status'];

            return $result;
        }
    }

    public function create() {

        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `groups` ("
                . "created_at, "
                . "name, "
                . "member, "
                . "category, "
                . "sub_category, "
                . "email, "
                . "phone_number, "
                . "profile_picture, "
                . "cover_picture, "
                . "district, "
                . "city, "
                . "address, "
                . "description, "
                . "status"
                . ") VALUES  ("
                . "'" . $createdAt . "', "
                . "'" . $this->name . "', "
                . "'" . $this->member . "', "
                . "'" . $this->category . "', "
                . "'" . $this->subCategory . "', "
                . "'" . $this->email . "', "
                . "'" . $this->phoneNumber . "', "
                . "'" . $this->profilePicture . "', "
                . "'" . $this->coverPicture . "', "
                . "'" . $this->district . "', "
                . "'" . $this->city . "', "
                . "'" . $this->address . "', "
                . "'" . $this->description . "', "
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

        $query = "UPDATE  `groups` SET "
                . "`name` ='" . $this->name . "', "
                . "`category` ='" . $this->category . "', "
                . "`sub_category` ='" . $this->subCategory . "', "
                . "`email` ='" . $this->email . "', "
                . "`phone_number` ='" . $this->phoneNumber . "', "
                . "`profile_picture` ='" . $this->profilePicture . "', "
                . "`cover_picture` ='" . $this->coverPicture . "', "
                . "`district` ='" . $this->district . "', "
                . "`city` ='" . $this->city . "', "
                . "`address` ='" . $this->address . "', "
                . "`description` ='" . $this->description . "' "
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

        $query = "SELECT * FROM `groups` ORDER BY `created_at` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getGroupsByMember($member) {

        $query = "SELECT * FROM `groups` WHERE `id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member AND `status` LIKE 'member') AND `status` = 1";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getGroupsOfAdmin($member) {

        $query = "SELECT * FROM `groups` WHERE `id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member AND `status` LIKE 'admin')";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getOtherGroups($member) {

        $query = "SELECT * FROM `groups` WHERE `id` not in (SELECT `group_id` FROM `group_members` WHERE `member` = $member) AND `status` = 1";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getAllGroupsByMember($member) {

        $query = "SELECT * FROM `groups` WHERE `id` in (SELECT `group_id` FROM `group_members` WHERE `member` = $member) AND `status` = 1";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {
        
        unlink(Helper::getSitePath() . "upload/group/" . $this->profilePicture);
        unlink(Helper::getSitePath() . "upload/group/cover-picture/" . $this->coverPicture);
        unlink(Helper::getSitePath() . "upload/group/cover-picture/thumb/" . $this->coverPicture);

        if (GroupMember::deleteAllMembersInGroup($this->id)) {
            $query = 'DELETE FROM `groups` WHERE id="' . $this->id . '"';

            $db = new Database();

            return $db->readQuery($query);
        }
    }

    public function updateStatus() {

        $query = "UPDATE  `groups` SET "
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
    
    public function suspendGroup() {

        $query = "UPDATE  `groups` SET "
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
    
    public function confirmInvitation() {

        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d H:i:s');
        
        $query = 'UPDATE `friend_request` SET '
                . '`is_confirmed`= "' . $this->isConfirmed . '", '
                . '`confirmed_date`= "' . $date . '" '
                . ' WHERE id="' . $this->id . '"';

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    
    public function countGroups() {

        $query = "SELECT count(`id`) as count FROM `groups` WHERE `status` = 1";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }
    
    public function countGroupsByCategory($category) {

        $query = "SELECT count(`id`) AS `count` FROM `groups` WHERE `category` = $category AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }
    
    public function countGroupsBySubCategory($subcategory) {

        $query = "SELECT count(`id`) AS `count` FROM `groups` WHERE `sub_category` = $subcategory AND `status` = 1 ORDER BY `created_at` DESC";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }
    
    public function searchGroups($category1, $subcategory, $location, $keyword, $pageLimit, $setLimit) {

        $w = array();
        $where = '';

        if (!empty($category1)) {
            $w[] = "`category` = '" . $category1 . "'";
        }
        if (!empty($subcategory)) {
            $w[] = "`sub_category` = '" . $subcategory . "'";
        }
        if (!empty($location)) {
            $w[] = "`city` LIKE '" . $location . "'";
        }
        if (!empty($keyword)) {
            $w[] = "`name` LIKE '%" . $keyword . "%'";
        }
        if (count($w)) {
            $where = 'WHERE `status` = 1 AND ' . implode(' AND ', $w);
        } else {
            $where = 'WHERE `status` = 1';
        }

        $query = "SELECT * FROM `groups` " . $where . " ORDER BY `created_at` DESC LIMIT " . $pageLimit . " , " . $setLimit . "";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function showPaginationOfSearchedGroups($category, $subcategory, $location, $keyword, $per_page, $page) {

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
            $w[] = "`name` LIKE '%" . $keyword . "%'";
        }
        if (count($w)) {
            $where = 'WHERE `status` = 1 AND ' . implode(' AND ', $w);
        } else {
            $where = 'WHERE `status` = 1';
        }

        $query = "SELECT count(*) AS totalCount FROM `groups` " . $where . " ORDER BY `created_at` DESC";

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

}
