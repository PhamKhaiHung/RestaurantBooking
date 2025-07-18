<?php 

class FoodModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function getFoodByFood_res_id($food_res_id) {
        $query = "SELECT * FROM food WHERE food_res_id = $food_res_id";
        $res = $this->db->select($query);
        return $res;
    }
    public function getFoodByFood_res_idAndStatus($food_res_id, $status) {
        $query = "SELECT * FROM food WHERE food_res_id = $food_res_id AND status = $status";
        $res = $this->db->select($query);
        return $res;
    }
    public function getAllFoodByFood_res_id($food_res_id) {
        $query = "SELECT * FROM food WHERE food_res_id = $food_res_id";
        $res = $this->db->select($query);
        return $res;
    }
    public function addFood($name, $price, $food_cate, $rid) {
        $query = "INSERT INTO food (`food_name`, `food_price`, `food_cate`, `food_res_id`,`status`) VALUES ('$name', '$price', '$food_cate', '$rid','1')";
        $res = $this->db->insert($query);
        return $res;
    }
    public function updateFood($name, $price, $food_cate, $id) {
        $query = "UPDATE food SET `food_name`='$name', `food_price`='$price', `food_cate`='$food_cate' WHERE `fid`='$id'";
        $res = $this->db->update($query);
        return $res;
    }
    public function updateFoodStatus($id, $status) {
        $query = "UPDATE food SET `status`='$status' WHERE `fid`='$id'";
        $res = $this->db->update($query);
        return $res;
    }
    public function getFoodById($id) {
        $query = "SELECT * FROM food WHERE fid = $id";
        $res = $this->db->select($query);
        return $res;
    }
}
