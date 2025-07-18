<?php

class BookingModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $query = "SELECT bid, fullname, phone, status, restaurant_name
        FROM restaurant R JOIN booking B ON R.rid = B.r_id";
        $q = $this->db->select($query);
        $res = [];
        if ($q) {
            while ($row = mysqli_fetch_assoc($q)) {
                array_push($res, $row);
            }
            return json_encode($res, JSON_UNESCAPED_UNICODE);
        } else return false;
    }

    public function getBookingById($bid)
    {
        $query = "SELECT *
        FROM restaurant R JOIN booking B ON R.rid = B.r_id
        WHERE bid = $bid";
        $q = $this->db->select($query);
        if ($q) {
            $res = mysqli_fetch_assoc($q);
            return json_encode($res, JSON_UNESCAPED_UNICODE);
        } else return false;
    }

    public function deleteBooking($bid)
    {
        $query = "DELETE FROM booking WHERE bid = $bid";
        $res = $this->db->delete($query);
        if ($res) return true;
        else return false;
    }

    public function updateStatus($bid, $status)
    {
        $query = "UPDATE booking SET status = '$status' WHERE bid = $bid";
        $res = $this->db->update($query);
        if ($res) return $status;
        else return false;
    }

    public function getBookingByUid($uid)
    {
        $query = "SELECT distinct bid, fullname, email, R.address, phone, `money`,
        createdAt, date, status, restaurant_name
        FROM booking B join restaurant R ON B.r_id = R.rid
        WHERE u_id = $uid";
        $res = $this->db->select($query);
        return $res;
    }
    public function getBookingByBU($uid, $bid)
    {
        $query = "SELECT distinct fullname, email, R.address, phone, money, adult_num, child_num,
        createdAt, date, status, restaurant_name
        FROM booking B join restaurant R ON B.r_id = R.rid
        WHERE B.u_id = $uid AND B.bid = $bid";
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function getBookingByRid($rid)
    {
        $query = "SELECT * FROM booking WHERE r_id = $rid";
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC);
    }
    public function getFoodBookingByBid($bid)
    {
        $query = "SELECT * FROM food_booking WHERE bid = $bid";
        $res = $this->db->select($query);
        return $res->fetch_all(MYSQLI_ASSOC);
    }
    public function insertBooking($data)
    {

        $date = $data['date'];
        $money = $data['money'];
        $fullname = $data['fullname'];
        $email = $data['email'];
        $address = $data['address'];
        $phone = $data['phone'];
        $u_id = $data['u_id'];
        $r_id = $data['r_id'];
        $createdAt = $data['createdAt'];
        $num = $data['num'];
        
        if ($u_id) {
            $query = "INSERT INTO `booking` (
            `num`,
            `date`,
            `money`,
            `fullname`,
            `address`,
            `phone`,
            `email`,
            `status`,
            `u_id`,
            `r_id`,
            `createdAt`
            ) VALUES (
            $num,
           
            '$date',
            $money,
            '$fullname',
            '$address',
            '$phone',
            '$email',
            '0',
            $u_id,
            $r_id,
            '$createdAt'
            )";
        } else {
            $query = "INSERT INTO `booking` (
            `num`,
            `date`,
            `money`,
            `fullname`,
            `address`,
            `phone`,
            `email`,
            `status`,
            `u_id`,
            `r_id`,
            `createdAt`
            ) VALUES (
            $num,
            '$date',
            $money,
            '$fullname',
            '$address',
            '$phone',
            '$email',
            '0',
            NULL,
            $r_id,
            '$createdAt'
            )";
        }
        return $this->db->insert($query,true);
    }
    public function insertFoodBooking($data) {
        $bid = isset($data['bid']) ? (int)$data['bid'] : null;
        $fid = isset($data['fid']) ? (int)$data['fid'] : null;
        $num = isset($data['num']) ? (int)$data['num'] : null;

        if ($bid === null || $fid === null || $num === null || $num < 1) {
            return false;
        }

        $query = "INSERT INTO `food_booking` (`bid`, `fid`, `num`) VALUES ($bid, $fid, $num)";
        $result = $this->db->insert($query);
        return $result;
    }

    // Thống kê tổng số lượt đặt và doanh thu theo ngày/tháng/năm
    public function getTotalOrdersAndRevenue($rid, $type = 'day', $value = null) {
        $where = "r_id = $rid";
        if ($type === 'day' && $value) {
            $where .= " AND DATE(date) = '$value'";
        } elseif ($type === 'month' && $value) {
            $where .= " AND DATE_FORMAT(date, '%Y-%m') = '$value'";
        } elseif ($type === 'year' && $value) {
            $where .= " AND YEAR(date) = '$value'";
        }
        $query = "SELECT COUNT(*) as total_orders, COALESCE(SUM(money),0) as total_revenue FROM booking WHERE $where";
        $res = $this->db->select($query);
        return $res->fetch_assoc();
    }

    // Thống kê doanh thu theo từng tháng trong năm hoặc theo tháng cụ thể
    public function getRevenueByMonth($rid, $type = 'year', $value = null) {
        $where = "r_id = $rid";
        if ($type === 'month' && $value) {
            // $value dạng 'YYYY-MM'
            $where .= " AND DATE_FORMAT(date, '%Y-%m') = '$value'";
            $query = "SELECT DATE_FORMAT(date, '%m/%Y') as month, COALESCE(SUM(money),0) as revenue FROM booking WHERE $where GROUP BY month";
        } elseif ($type === 'year' && $value) {
            $where .= " AND YEAR(date) = '$value'";
            $query = "SELECT DATE_FORMAT(date, '%m/%Y') as month, COALESCE(SUM(money),0) as revenue FROM booking WHERE $where GROUP BY month ORDER BY month ASC";
        } else {
            $query = "SELECT DATE_FORMAT(date, '%m/%Y') as month, COALESCE(SUM(money),0) as revenue FROM booking WHERE $where GROUP BY month ORDER BY month ASC";
        }
        $res = $this->db->select($query);
        $result = [];
        while ($row = $res->fetch_assoc()) {
            $result[] = $row;
        }
        return $result;
    }

    // Thống kê doanh thu theo từng ngày trong một tháng
    public function getRevenueByDayInMonth($rid, $month_year) {
        $where = "r_id = $rid AND DATE_FORMAT(date, '%Y-%m') = '$month_year'";
        $query = "SELECT DATE(date) as day, COALESCE(SUM(money),0) as revenue FROM booking WHERE $where GROUP BY day ORDER BY day ASC";
        $res = $this->db->select($query);
        $result = [];
        while ($row = $res->fetch_assoc()) {
            $result[] = $row;
        }
        return $result;
    }

    // Top 5 món ăn đặt nhiều nhất theo tháng/năm
    public function getTopFoods($rid, $month = null, $year = null) {
        $where = "B.r_id = $rid";
        if ($month && $year) {
            $where .= " AND MONTH(B.date) = $month AND YEAR(B.date) = $year";
        } elseif ($year) {
            $where .= " AND YEAR(B.date) = $year";
        }
        $query = "SELECT F.food_name, SUM(FB.num) as count FROM food_booking FB JOIN booking B ON FB.bid = B.bid JOIN food F ON FB.fid = F.fid WHERE $where GROUP BY FB.fid ORDER BY count DESC LIMIT 5";
        $res = $this->db->select($query);
        $result = [];
        while ($row = $res->fetch_assoc()) {
            $result[] = $row;
        }
       
        return $result;
    }
}
