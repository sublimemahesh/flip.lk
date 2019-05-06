<?php
/**
 * Description of BusinessSubCategory
 *
 * @author W j K n¨
 */
class BusinessSubCategory {
    public $id;
    public $business_category;
    public $name;
    public $image_name;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`business_category`,`name`,`image_name`,`sort` FROM `business_sub_category` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->business_category = $result['business_category'];
            $this->name = $result['name'];
            $this->image_name = $result['image_name'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `business_sub_category` (`business_category`, `name`, `image_name`, `sort`) VALUES  ('" . $this->business_category . "','" . $this->name . "','" . $this->image_name . "', '" . $this->sort . "')";

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

        $query = "SELECT * FROM `business_sub_category` ORDER BY `sort` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = 'UPDATE `business_sub_category` SET '
                . '`business_category`= "' . $this->business_category . '", '
                . '`name`= "' . $this->name . '", '
                . '`image_name`= "' . $this->image_name . '" '
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

        unlink(Helper::getSitePath() . "upload/business_subcategory/" . $this->image_name);

        $query = 'DELETE FROM `business_sub_category` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getSubCategoriesByCategory($category) {

        $query = "SELECT * FROM `business_sub_category` WHERE `business_category` = '" . $category . "' ORDER BY `sort` ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function deleteSubCategoriesByCategory($category) {


        $subcategories = SubCategory::getSubCategoriesByCategory($category);

        foreach ($subcategories as $subcategory) {
            $IMG = $subcategory['image_name'];
            unlink(Helper::getSitePath() . "upload/subcategory/" . $IMG);
            unlink(Helper::getSitePath() . "upload/subcategory/thumb/" . $IMG);
        }

        $query = "DELETE FROM `business_sub_category` WHERE `business_category`= '" . $category . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result;
    }
    
    public function countSubCategories() {

        $query = "SELECT count(`id`) as count FROM `business_sub_category`";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result['count'];
    }

    public function arrange($key, $img) {
        $query = "UPDATE `business_sub_category` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }
}
