<?php 

class CateresModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
 
    
    public function getCateByRid($rid) {
        $query = "SELECT * FROM cate_res WHERE rid=$rid";
        $res = $this->db->select($query);
        return $res;
    }
    public function addCategory($name, $rid) {
        $query = "INSERT INTO cate_res (`cate_res_name`, `id`) VALUES ('$name', '$rid')";
        $res = $this->db->insert($query);
        return $res;
    }
    public function updateStatusCategory($id, $status) {
        $query = "UPDATE cate_res SET `status`='$status' WHERE `cate_res_id`='$id' ";
        $res = $this->db->update($query);
        return $res;
    }
    public function updateCategory($name, $id) {
        $query = "UPDATE cate_res SET `cate_res_name`='$name' WHERE `cate_res_id`='$id' ";
        $res = $this->db->update($query);
        return $res;
    }
}
