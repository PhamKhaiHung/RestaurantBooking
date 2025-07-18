<?php
class BookingController extends Controller
{
    private $model_booking;
    private $general;
    private $model_general;
    private $model_food;
    public function __construct()
    {
        $this->model_booking = $this->model('bookingModel');
        $this->model_general = $this->model('generalModel');
        $this->general = $this->model_general->getAll();
        $this->model_food = $this->model('foodModel');
    }
    public function manage()
    {
        $rid = $_SESSION['rid'];
        $foods = $this->model_food->getAllFoodByFood_res_id($rid);
        if(!isset($_SESSION['user-id'])){
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header("location:" . $url . "user/home/index");
            exit();
        }
        $rid = $_SESSION['rid'];
        $bookings = $this->model_booking->getBookingByRid($rid);
        
        // Lấy thông tin món ăn cho mỗi booking
        foreach ($bookings as &$booking) {
            $booking['food_items'] = $this->model_booking->getFoodBookingByBid($booking['bid']);
        }
       
        $this->renderRestaurant('layout',[
            'page'=>'restaurant/booking',
            'bookings'=>$bookings,
            'general'=>$this->general,
            'foods'=>$foods
        ]);
    }
    
    public function getBookingDetail($bid)
{
    $foodModel = $this->model('foodModel');
    $foodBookings = $this->model_booking->getFoodBookingByBid($bid);
    $foodList = [];
    foreach ($foodBookings as $fb) {
        $foodRes = $foodModel->getFoodById($fb['fid']);
        $foodInfo = $foodRes->fetch_assoc();
        $foodList[] = [
            'food_name' => $foodInfo['food_name'],
            'food_price' => $foodInfo['food_price'],
            'num' => $fb['num']
        ];
    }
    echo json_encode(['food_items' => $foodList]);
    exit;
}
    
    public function updateStatus($bid)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
            $status = $_POST['status'];
            $result = $this->model_booking->updateStatus($bid, $status);
            if ($result) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }
}
