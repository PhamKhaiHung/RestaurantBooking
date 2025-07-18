<?php
class HomeController extends Controller
{
    private $category;
    private $model_category;
    private $model_restaurant;
    private $general;
    private $model_general;
    private $model_food;
    private $model_cate_res;
    public function __construct()
    {
        $this->model_category = $this->model('categoryModel');
        $this->model_restaurant = $this->model('restaurantModel');
        $this->model_news = $this->model('newsModel');
        $this->model_general = $this->model('generalModel');
        $this->model_image = $this->model('imageModel');
        $this->model_contact = $this->model('contactModel');
        $this->model_food = $this->model('foodModel');
        // Lấy tất cả danh mục
        $this->category = $this->model_category->getAll();
        $this->model_cate_res = $this->model('CateresModel');
        $this->general = $this->model_general->getAll();
    }
    public function index()
    {
        if (!isset($_SESSION['user-id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'R') {
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header("location:" . $url . "user/home/index");
            exit();
        }

        $rid = null;
        $ownerId = $_SESSION['user-id'];
        
        if ($ownerId) {
            $restaurant = $this->model_restaurant->getRestaurantByOwnerId($ownerId);
        }
        $restaurant = $this->model_restaurant->getRestaurantByOwnerId($ownerId);
        if ($restaurant) {
            $rid = $restaurant['rid'];
            $_SESSION['rid'] = $rid;
        } else {
            echo "Restaurant not found for the given owner ID.";
            return;
        }
        $food_show = $this->model_food->getFoodByFood_res_idAndStatus($rid, 1);
        $food_hide = $this->model_food->getFoodByFood_res_idAndStatus($rid, 0);
        $category_name = $this->model_category->getCategoryNameByID($restaurant['cate_id']);
        $cate_res = $this->model_cate_res->getCateByRid($rid);

        $this->renderRestaurant('layout', [
            'page' => 'restaurant/home',
            'food_show' => $food_show,
            'food_hide' => $food_hide,
            'restaurant' => $restaurant,
            'general' => $this->general,
            'cate_res' => $cate_res
        ]);
    }
    public function updateOverview()
    {
        $rid = $_SESSION['rid'];
        $restaurant_name = $_POST['restaurantName'];
        $address = $_POST['address'];
        $open_time = $_POST['openTime'];
        $description = $_POST['description'];
        $res_include = $_POST['include'];
        $res_exclude = $_POST['exclude'];
        $res_condition = $_POST['condition'];
        $this->model_restaurant->updateRestaurantInfo($rid, $restaurant_name, $address, $open_time, $description, $res_include, $res_exclude, $res_condition);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    public function updateImage()
    {
        $rid = $_SESSION['rid'];
        $image_url = $_POST['restaurantImageUrl'];
        $this->model_restaurant->updateImage( $image_url, $rid);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
