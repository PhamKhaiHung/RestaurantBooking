<?php
class StatisticController extends Controller {
    private $model_booking;
    private $general;
    private $model_general;
    public function __construct() {
        $this->model_booking = $this->model('bookingModel');
        $this->model_general = $this->model('generalModel');
        $this->general = $this->model_general->getAll();
    }
    public function index() {
        if(!isset($_SESSION['user-id'])){
            $url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            header("location:" . $url . "user/home/index");
            exit();
        }
        $rid = $_SESSION['rid'];
        $date = $_GET['date'] ?? date('Y-m-d');
        $year = $_GET['year'] ?? date('Y');
        $month = $_GET['month'] ?? date('m');
        $filterType = $_GET['filterType'] ?? 'day'; // 'day', 'month', 'year'

        $revenueByDayInMonth = [];
        if ($filterType === 'month') {
            $month_year = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
            $ordersRevenue = $this->model_booking->getTotalOrdersAndRevenue($rid, 'month', $month_year);
            $revenueByMonth = $this->model_booking->getRevenueByMonth($rid, 'month', $month_year);
            $revenueByDayInMonth = $this->model_booking->getRevenueByDayInMonth($rid, $month_year);
            $topFoods = $this->model_booking->getTopFoods($rid, $month, $year);
        } elseif ($filterType === 'year') {
            $ordersRevenue = $this->model_booking->getTotalOrdersAndRevenue($rid, 'year', $year);
            $revenueByMonth = $this->model_booking->getRevenueByMonth($rid, 'year', $year);
            $topFoods = $this->model_booking->getTopFoods($rid, null, $year);
        } else { // day
            $ordersRevenue = $this->model_booking->getTotalOrdersAndRevenue($rid, 'day', $date);
            $revenueByMonth = $this->model_booking->getRevenueByMonth($rid, 'year', $year);
            $topFoods = $this->model_booking->getTopFoods($rid, $month, $year);
        }

        $this->renderRestaurant('layout', [
            'page' => 'restaurant/statistic',
            'total_orders' => $ordersRevenue['total_orders'],
            'total_revenue' => $ordersRevenue['total_revenue'],
            'revenue_by_month' => $revenueByMonth,
            'revenue_by_day_in_month' => $revenueByDayInMonth,
            'top_foods' => $topFoods,
            'general' => $this->general,
            'selected_date' => $date,
            'selected_month' => $month,
            'selected_year' => $year,
            'filter_type' => $filterType
        ]);
    }
}
