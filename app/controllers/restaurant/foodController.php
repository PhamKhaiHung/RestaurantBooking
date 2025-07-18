<?php

class FoodController extends Controller {
    public function hideFood($id) {
        $this->model('foodModel')->updateFoodStatus($id, 0);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    public function showFood($id) {
        $this->model('foodModel')->updateFoodStatus($id, 1);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    public function addFood() {
        $path_base = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        $name = $_POST['foodName'];
        $price = $_POST['foodPrice'];
        $food_cate = $_POST['foodCategory'];
        $rid = $_SESSION['rid'];
        $this->model('foodModel')->addFood($name, $price, $food_cate, $rid);
        header('Location: ' . $path_base . 'restaurant/home/index');
        exit();
    }
    public function updateFood() {
        $path_base = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        $id = $_POST['foodId'];
        $name = $_POST['foodName'];
        $price = $_POST['foodPrice'];
        $food_cate = $_POST['foodCategory'];
        
        $this->model('foodModel')->updateFood($name, $price, $food_cate, $id);
        header('Location: ' . $path_base . 'restaurant/home/index');
        exit();
    }
    public function getAll($rid) {
        // Giả sử bạn có một FoodModel
        $foodModel = $this->model("FoodModel"); // Hoặc cách bạn gọi model
        $foods = $foodModel->getAllFoodByFood_res_id($rid); // Viết hàm này trong model để lấy tất cả món ăn
    
        if ($foods) {
            echo json_encode(['success' => true, 'foods' => $foods]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy món ăn nào.']);
        }
        exit;
    }
} 