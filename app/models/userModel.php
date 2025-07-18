<?php 

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function signUser($email, $uname, $password, $role, $fullname = '', $phone = '', $address = '') {
        // Làm sạch dữ liệu đầu vào để tránh SQL injection
        $email = $this->db->escape_string($email);
        $uname = $this->db->escape_string($uname);
        $password = $this->db->escape_string($password);
        $role = $this->db->escape_string($role);
        $fullname = $this->db->escape_string($fullname);
        $phone = $this->db->escape_string($phone);
        $address = $this->db->escape_string($address);
        
        // Chuẩn bị câu query an toàn
        $query = "INSERT INTO user (email, uname, password, role, name, phone, address) 
                  VALUES ('$email', '$uname', '$password', '$role', '$fullname', '$phone', '$address')";
        
        try {
            $res = $this->db->insert($query);
            if ($res) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            error_log("Lỗi khi đăng ký tài khoản: " . $e->getMessage());
            return false;
        }
    }

    public function getAll() {
        $query = "SELECT `uid`, `name`, phone, email, `address` FROM user WHERE role = 'U'";
        $query = $this->db->select($query);
        $res = [];
        if($query) {
            while($row = mysqli_fetch_assoc($query)) {
                array_push($res, $row);
            }
            return json_encode($res, JSON_UNESCAPED_UNICODE);
        }
        else return false;
    }

    public function getUserById($uid) {
        $query = "SELECT * FROM user WHERE uid = '$uid'";
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function updateUser($uid, $name, $phone, $address) {
        $query = "UPDATE user SET name = '$name', phone = '$phone', address = '$address' WHERE uid = $uid";
        $res = $this->db->update($query);
        return $res;
    }

    public function updatePass($email, $password) {
        $query = "UPDATE user SET password = '$password' WHERE email = '$email'";
        $res = $this->db->update($query);
        return $res;
    }

    public function deleteUser($uid) {
        $query_check = "SELECT * FROM booking WHERE u_id = $uid";
        $res_check = $this->db->select($query_check);
        if($res_check) {
            $query1 = "DELETE FROM booking WHERE u_id = $uid";
            $query2 = "DELETE FROM user WHERE uid = $uid";
            if($query1) $res1 = $this->db->delete($query1);
            $res2 = $this->db->delete($query2);
            if($res2) return 1;
            else return 0;
        }
        else {
            $query2 = "DELETE FROM user WHERE uid = $uid";
            $res2 = $this->db->delete($query2);
            if($res2) return true;
            else return false;
        }
    }

    public function existUser($email) {
        $query = "SELECT * FROM user WHERE email = '$email'";
        $res = $this->db->select($query);
        return $res;
    }

    public function existUserName($uname) {
        $query = "SELECT * FROM user WHERE uname = '$uname'";
        $res = $this->db->select($query);
        return $res;
    }
}