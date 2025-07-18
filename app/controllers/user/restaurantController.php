<?php

class RestaurantController extends Controller
{
    private $category;
    private $model_category;

    private $general;
    private $model_general;

    private $model_restaurant;
    private $model_comment;
    private $model_address;
    private $model_booking;
    private $model_image;
    private $model_food;
    private $model_cate_res;
    public function __construct()
    {
        $this->model_category = $this->model('CategoryModel');
        $this->model_general = $this->model('GeneralModel');
        $this->model_restaurant = $this->model('RestaurantModel');
        $this->model_comment = $this->model('CommentModel');
        $this->model_address = $this->model('AddressModel');
        $this->model_booking = $this->model('BookingModel');
        $this->model_image = $this->model('ImageModel');
        $this->model_food = $this->model('FoodModel');
        $this->category = $this->model_category->getAll();
        $this->general = $this->model_general->getAll();
        $this->model_cate_res = $this->model('CateresModel');
    }




    public function list_res($cateid = 0, $page = 1, $search = '')
    {
        $each_page = 6;

        if ($cateid == -1) {
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
            }
            $maxSearch = $this->model_restaurant->countById($search);
        } else {
            $maxSearch = $this->model_restaurant->countById($cateid);
        }

        $maxPage = ceil($maxSearch / $each_page);
        $start = ($page - 1) * $each_page;

        if ($cateid == 0) {
            $restaurant = $this->model_restaurant->getAllCategory($cateid, $start, $each_page);
            $category_name = 'Các kiểu nhà hàng';
        } else if ($cateid == -1) {
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
            }
            $restaurant = $this->model_restaurant->getAllCategory($cateid, $start, $each_page);
            $category_name = 'Kết quả tìm kiếm: ' . $search;
        } else {
            $restaurant = $this->model_restaurant->getAllCategory($cateid, $start, $each_page);
            $category_name = $this->model_category->getCategoryNameByID($cateid);
        }


        $this->renderUser('layout', ['page' => 'restaurant/list', 'category' => $this->category, 'category_name' => $category_name, 'restaurant' => $restaurant, 'maxPage' => $maxPage, 'currentPage' => $page, 'category_id' => $cateid, 'search' => $search, 'general' => $this->general]);
    }
    public function search_res()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $search = isset($_GET['q']) ? trim($_GET['q']) : '';


            $restaurants = ['result' => [], 'total' => 0];
            if (!empty($search)) {
                $restaurants = $this->model_restaurant->searchRestaurant($search);
            } else {
            }


            $this->renderUser('layout', [
                'page' => 'restaurant/search_res',
                'restaurant' => $restaurants['result'],
                'search' => htmlspecialchars($search),
                'search_count' => $restaurants['total'],
                'general' => $this->general

            ]);
        } else {

            echo "Phương thức không hợp lệ.";
        }
    }

    public function checkEmail($email)
    {
        $require = "/(.{1}).*(@{1})(.{1}).*((\.){1})(.{1}).*/";
        if (preg_match($require, $email)) return true;
        else return false;
    }

    public function checkPhone($phone)
    {
        if (ctype_digit($phone))  return true;
        else return false;
    }

    public function restaurant_detail($rid)
    {
        $restaurant = $this->model_restaurant->getRestaurantById($rid);
        $food = $this->model_food->getFoodByFood_res_id($rid);
        $category_name = $this->model_category->getCategoryNameByID($restaurant['cate_id']);
        $cate_res = $this->model_cate_res->getCateByRid($rid);
        $email = '';
        $fullname = '';
        $phone = '';
        $content = '';
        $error_email = '';
        $error_fullname = '';
        $error_phone = '';
        $error_content = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Email
            if (!isset($_POST['email']) || !$this->checkEmail($_POST['email'])) {
                $error_email = 'Email không hợp lệ';
            } else $email = $_POST['email'];

            // Fullname
            if (!isset($_POST['fullname']) || strlen($_POST['fullname']) < 1) {
                $error_fullname = 'Họ tên không hợp lệ';
            } else $fullname = $_POST['fullname'];

            // Phone
            if (!isset($_POST['phone']) || !$this->checkPhone($_POST['phone'])) {
                $error_phone = 'Số điện thoại không hợp lệ';
            } else $phone = $_POST['phone'];

            // Content
            if (!isset($_POST['content']) || strlen($_POST['content']) < 1) {
                $error_content = 'Nội dung không hợp lệ';
            } else $content = $_POST['content'];


            if ($email && $fullname && $phone && $content) {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $time = date('Y-m-d H:i:s');

                $this->model_comment->insertComment([
                    'r_id' => $restaurant['rid'],
                    'name' => $fullname,
                    'phone' => $phone,
                    'email' => $email,
                    'cmt' => $content,
                    'time' => $time
                ]);
            }
        }

        $comment = $this->model_comment->getAllByResID($rid);
        $address = $this->model_address->getAddressByRID($rid);

        $img = $this->model_image->getImageByRID($rid);

        $this->renderUser('layout', ['page' => 'restaurant/detail', 'cate_res' => $cate_res, 'category' => $this->category, 'food' => $food, 'restaurant' => $restaurant, 'address' => $address, 'comment' => $comment, 'email_error' => $error_email, 'fullname_error' => $error_fullname, 'phone_error' => $error_phone, 'content_error' => $error_content, 'category_name' => $category_name, 'imgs' => $img, 'general' => $this->general]);
    }

    public function list_price($page = 1)
    {
        $each_page = 5;
        $maxPage = $this->model_restaurant->countById();
        $max = ceil($maxPage / $each_page);

        $start = ($page - 1) * $each_page;

        $restaurant = $this->model_restaurant->getAllCategory(0, $start, $each_page);


        $this->renderUser('layout', ['page' => 'restaurant/price', 'category' => $this->category, 'restaurant' => $restaurant, 'maxPage' => $max, 'currentPage' => $page, 'general' => $this->general]);
    }
    public function booking($rid, $uid = null)
    {
        
        $pass = false;
        $food = $this->model_food->getFoodByFood_res_id($rid);
        $restaurant = $this->model_restaurant->getRestaurantById($rid);
        
        $email = '';
        $fullname = '';
        $phone = '';
        $address = '';
        $error_email = '';
        $error_fullname = '';
        $error_phone = '';
        $error_address = '';
        $error_date = '';
        $error_people = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['email']) || !$this->checkEmail($_POST['email'])) {
                $error_email = 'Email không hợp lệ';
            } else $email = $_POST['email'];

            if (!isset($_POST['fullname']) || strlen($_POST['fullname']) < 1) {
                $error_fullname = 'Họ tên không hợp lệ';
            } else $fullname = $_POST['fullname'];

            if (!isset($_POST['phone']) || !$this->checkPhone($_POST['phone'])) {
                $error_phone = 'Số điện thoại không hợp lệ';
            } else $phone = $_POST['phone'];

            if (!isset($_POST['address']) || strlen($_POST['address']) < 1) {
                $error_address = 'Địa chỉ không hợp lệ';
            } else $address = $_POST['address'];
            if (!isset($_POST['depart_date']) || strlen($_POST['depart_date']) < 1) {
                $error_date = 'Chưa chọn ngày đặt';
            } else $date = $_POST['depart_date'];
            if (isset($_POST['food_total_price']) && is_numeric($_POST['food_total_price'])) {
                $food_total_price = (float)$_POST['food_total_price'];
            } else {

                $food_total_price = 0;
            }
            if (!isset($_POST['number_of_people']) || !is_numeric($_POST['number_of_people']) || (int)$_POST['number_of_people'] < 1) {
                $error_people = 'Số lượng người không hợp lệ (tối thiểu 1).';
            } else {
                $number_of_people = (int)$_POST['number_of_people'];
            }
            if ($email && $fullname && $phone && $address && $date) {


                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $created_at = date('Y-m-d H:i:s');
               
                $new_booking_id = $this->model_booking->insertBooking([
                    
                    "date" => $date,
                    "num" => $number_of_people,
                    "money" => $food_total_price,
                    "fullname" => $fullname,
                    "address" => $address,
                    "phone" => $phone,
                    "email" => $email,
                    "u_id" => $uid,
                    "r_id" => $rid,
                    "createdAt" => $created_at
                ]);
                $pass = true;


                if ($new_booking_id) {
                    $pass = true;
                    $selected_foods = [];
                    if (isset($_POST['food_quantity']) && is_array($_POST['food_quantity'])) {
                        foreach ($_POST['food_quantity'] as $food_id => $quantity) {
                            $quantity = (int)$quantity;
                            if ($quantity > 0) {
                                $selected_foods[] = [
                                    'fid' => (int)$food_id,
                                    'num' => $quantity
                                ];
                            }
                        }
                    }

                    if (!empty($selected_foods)) {
                        foreach ($selected_foods as $food_item) {
                            $food_booking_data = [
                                'bid' => $new_booking_id,
                                'fid' => $food_item['fid'],
                                'num' => $food_item['num']
                            ];
                            $food_insert_success = $this->model_booking->insertFoodBooking($food_booking_data);
                            if (!$food_insert_success) {
                                error_log("Lỗi khi chèn món ăn (fid: {$food_item['fid']}) cho booking (bid: $new_booking_id)");
                            }
                        }
                    }
                } else {
                    error_log("Lỗi khi tạo booking mới.");
                    $pass = false;
                }
            }
        }

        $this->renderUser('layout', ['page' => 'restaurant/booking', 'food' => $food, 'category' => $this->category, 'restaurant' => $restaurant, 'date_error' => $error_date, 'email_error' => $error_email, 'fullname_error' => $error_fullname, 'phone_error' => $error_phone, 'address_error' => $error_address, 'general' => $this->general, 'isSuccess' => $pass]);
    }

    public function make_booking($rid)
    {
        $restaurant = $this->model_restaurant->getRestaurantById($rid);

        $email = '';
        $fullname = '';
        $phone = '';
        $address = '';
        $error_email = '';
        $error_fullname = '';
        $error_phone = '';
        $error_address = '';


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['email']) || !$this->checkEmail($_POST['email'])) {
                $error_email = 'Email không hợp lệ';
            } else $email = $_POST['email'];

            if (!isset($_POST['fullname']) || strlen($_POST['fullname']) < 1) {
                $error_fullname = 'Họ tên không hợp lệ';
            } else $fullname = $_POST['fullname'];

            if (!isset($_POST['phone']) || !$this->checkPhone($_POST['phone'])) {
                $error_phone = 'Số điện thoại không hợp lệ';
            } else $phone = $_POST['phone'];

            if (!isset($_POST['address']) || strlen($_POST['address']) < 1) {
                $error_address = 'Địa chỉ không hợp lệ';
            } else $address = $_POST['address'];

            if ($email && $fullname && $phone && $address) {
                $adult_num = $_POST['adult_count'];
                $child_num = $_POST['child_count'];
                $date = $_POST['depart_date'];
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $created_at = date('Y-m-d H:i:s');
                $total_price = $adult_num * $restaurant['adult_price'] + $child_num * $restaurant['child_price'];

                $this->model_booking->insertBooking([
                    "adult_num" => $adult_num,
                    "child_num" => $child_num,
                    "date" => $date,
                    "money" => $total_price,
                    "fullname" => $fullname,
                    "address" => $address,
                    "phone" => $phone,
                    "email" => $email,
                    "u_id" => 1,
                    "r_id" => $rid,
                    "createdAt" => $created_at
                ]);
                $pass = true;
            }
        }

        $this->renderUser('layout', ['page' => 'restaurant/booking', 'category' => $this->category, 'restaurant' => $restaurant, 'email_error' => $error_email, 'fullname_error' => $error_fullname, 'phone_error' => $error_phone, 'address_error' => $error_address]);
    }
}
