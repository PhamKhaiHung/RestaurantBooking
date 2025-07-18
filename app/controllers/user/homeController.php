<?php 
class HomeController extends Controller {
    private $category;
    private $model_category;

    private $restaurant_three;
    private $model_restaurant;

    private $news;
    private $model_news;

    private $general;
    private $model_general;

    private $model_image; private $model_contact; private $other_category;
    
    public function __construct() {
        $this->model_category = $this->model('categoryModel');
        $this->model_restaurant = $this->model('restaurantModel');
        $this->model_news = $this->model('newsModel');
        $this->model_general = $this->model('generalModel');
        $this->model_image = $this->model('imageModel');
        $this->model_contact = $this->model('contactModel');

        $this->category = $this->model_category->getAll();
        $this->general = $this->model_general->getAll();
    }

    public function index() {
        
        $this->other_category = $this->model_category->getAllCategory();
        $this->news = $this->model_news->get3();
        
        // Lấy 3 nhà hàng đặc trưng
        $this->restaurant_three = $this->model_restaurant->getThree();
        $restaurant_f3 = $this->restaurant_three->fetch_all(MYSQLI_ASSOC);
        
        // Lấy 5 nhà hàng khác
        $restaurant_five = $this->model_restaurant->getFive();
        $restaurant_six = $this->model_restaurant->getSixRestaurant();
        
        $this->renderUser('layout', [
            'page' => 'home/homepage', 
            'category' => $this->category, 
            'general' => $this->general, 
            'other_category' => $this->other_category, 
            'news' => $this->news, 
            'restaurant_feature' => $restaurant_f3, 
            'restaurant_five' => $restaurant_five,
            'restaurant_six' => $restaurant_six
        ]);
    }

    

    public function introduction() {
        $this->renderUser('layout', ['page' => 'home/introduction', 'category' => $this->category, 'general' => $this->general]);
    }

    public function contact() {
        $this->renderUser('layout', ['page' => 'home/contact', 'category' => $this->category, 'general' => $this->general]);
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if(empty($name) || empty($email) || empty($phone) || empty($address) || empty($description)) {
                echo "<script>alert('Vui lòng điền đẩy đủ thông tin');</script>";
            }
            if($this->model_contact->insertContact($name, $phone, $email, $description, $address)) {
                echo "<script>alert('Gửi thông tin thành công');</script>";
            } else {
                echo "<script>alert('Gửi thông tin thất bại');</script>";
            }
        }
    }
    public function news() {
        $this->renderUser('layout', ['page' => 'home/news', 'category' => $this->category]);
    }
    public function photo() {
        $image = $this->model_image->getAll();
        $this->renderUser('layout', ['page' => 'home/photo', 'category' => $this->category, 'image' => $image, 'general' => $this->general]);
    }
}
