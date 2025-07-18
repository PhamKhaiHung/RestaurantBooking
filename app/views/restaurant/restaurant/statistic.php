<?php
function format_date_dmy($date_string) {
    
    $timestamp = strtotime($date_string);

 
    if ($timestamp === false) {
      
        return null;  // Hoặc return "Định dạng ngày không hợp lệ";
    }

   
    return date('d/m/Y', $timestamp);
} 
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold">Thống kê</h2>
    <div class="p-3 mb-4 card">
        <div class="mb-3 row g-3 align-items-center">
            <div class="col-auto">
                <button class="btn <?= ($filter_type ?? 'day') === 'day' ? 'btn-primary' : 'btn-outline-primary' ?>" id="btn-filter-day">Ngày</button>
            </div>
            <div class="col-auto">
                <button class="btn <?= ($filter_type ?? 'day') === 'month' ? 'btn-primary' : 'btn-outline-primary' ?>" id="btn-filter-month">Tháng</button>
            </div>
            <div class="col-auto">
                <button class="btn <?= ($filter_type ?? 'day') === 'year' ? 'btn-primary' : 'btn-outline-primary' ?>" id="btn-filter-year">Năm</button>
            </div>
            <div class="col-auto">
                <input type="date" class="form-control" id="date-picker" value="<?= htmlspecialchars($selected_date ?? date('Y-m-d')) ?>" <?= ($filter_type ?? 'day') !== 'day' ? 'disabled' : '' ?>>
            </div>
            <div class="col-auto">
                <input type="month" class="form-control" id="month-picker" value="<?= htmlspecialchars(($selected_year ?? date('Y')) . '-' . str_pad(($selected_month ?? date('m')), 2, '0', STR_PAD_LEFT)) ?>" <?= ($filter_type ?? 'day') !== 'month' ? 'disabled' : '' ?>>
            </div>
            <div class="col-auto">
                <input type="number" class="form-control" id="year-picker" min="2000" max="<?= date('Y') ?>" value="<?= htmlspecialchars($selected_year ?? date('Y')) ?>" <?= ($filter_type ?? 'day') !== 'year' ? 'disabled' : '' ?>>
            </div>
        </div>
        <div class="mt-4 row g-3">
            <div class="col-md-6">
                <div class="p-4 text-center text-white rounded bg-info">
                    <div class="fs-1 fw-bold" id="total-orders"><?= $total_orders ?? 0 ?></div>
                    <div>Số lần đặt bàn</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 text-center text-white rounded bg-success">
                    <div class="fs-1 fw-bold" id="total-revenue"><?= number_format($total_revenue ?? 0, 0, ',', '.') ?> VNĐ</div>
                    <div>Doanh thu</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Doanh thu theo tháng hoặc theo ngày trong tháng -->
    <div class="p-3 mb-4 card">
        <h5>Doanh thu</h5>
        <canvas id="revenueChart" height="100"></canvas>
    </div>

    <!-- Top món ăn -->
    <div class="p-3 card">
        <h5>Món ăn</h5>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <canvas id="foodChart" width="300" height="300"></canvas>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <ul id="food-legend" class="list-unstyled ms-3"></ul>
            </div>
        </div>
    </div>
</div>

<script>
// Dữ liệu mẫu, bạn thay bằng PHP render ra JS
const revenueByMonth = <?= json_encode($revenue_by_month ?? []) ?>;
const topFoods = <?= json_encode($top_foods ?? []) ?>;

const filterType = '<?= $filter_type ?? 'day' ?>';
let revenueChartData, revenueChartLabels;
if (filterType === 'month') {
    const revenueByDay = <?= json_encode($revenue_by_day_in_month ?? []) ?>;
    revenueChartLabels = revenueByDay.map(item => {
        const d = new Date(item.day);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        return `${day}/${month}/${year}`;
    });
    revenueChartData = revenueByDay.map(item => item.revenue);
}else {
    const revenueByMonth = <?= json_encode($revenue_by_month ?? []) ?>;
    revenueChartLabels = revenueByMonth.map(item => item.month);
    revenueChartData = revenueByMonth.map(item => item.revenue);
}
const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(ctxRevenue, {
    type: 'bar',
    data: {
        labels: revenueChartLabels,
        datasets: [{
            label: 'Doanh thu (VNĐ)',
            data: revenueChartData,
            backgroundColor: '#0d6efd'
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } }
    }
});

// Chart món ăn
const ctxFood = document.getElementById('foodChart').getContext('2d');
const foodColors = ['#f39c12', '#3498db', '#e74c3c', '#2ecc71', '#f1c40f', '#bdc3c7'];
const foodLabels = topFoods.map(item => item.food_name);
const foodCounts = topFoods.map(item => item.count);
const foodChart = new Chart(ctxFood, {
    type: 'pie',
    data: {
        labels: foodLabels,
        datasets: [{
            data: foodCounts,
            backgroundColor: foodColors
        }]
    },
    options: {
        responsive: false,
        plugins: { legend: { display: false } }
    }
});

// Tạo legend cho chart món ăn
const legend = document.getElementById('food-legend');
legend.innerHTML = '';
foodLabels.forEach((label, idx) => {
    const color = foodColors[idx % foodColors.length];
    legend.innerHTML += `<li class="mb-2"><span style="display:inline-block;width:16px;height:16px;background:${color};border-radius:3px;margin-right:8px"></span>${label}</li>`;
});

// Lọc ngày chỉ áp dụng phần đầu, lọc tháng/năm áp dụng cho cả 3 phần
const btnDay = document.getElementById('btn-filter-day');
const btnMonth = document.getElementById('btn-filter-month');
const btnYear = document.getElementById('btn-filter-year');
const datePicker = document.getElementById('date-picker');
const monthPicker = document.getElementById('month-picker');
const yearPicker = document.getElementById('year-picker');

// Lọc ngày: chỉ reload phần đầu (có thể dùng AJAX, ở đây reload trang cho đơn giản)
btnDay.onclick = function() {
    const url = new URL(window.location.href);
    url.searchParams.set('filterType', 'day');
    window.location.href = url.toString();
};

// Lọc tháng/năm: reload cả trang với tham số month, year
btnMonth.onclick = function() {
    const url = new URL(window.location.href);
    url.searchParams.set('filterType', 'month');
    window.location.href = url.toString();
};

btnYear.onclick = function() {
    const url = new URL(window.location.href);
    url.searchParams.set('filterType', 'year');
    window.location.href = url.toString();
};

datePicker.onchange = function() {
    const url = new URL(window.location.href);
    url.searchParams.set('date', this.value);
    url.searchParams.set('filterType', 'day');
    window.location.href = url.toString();
};

monthPicker.onchange = function() {
    const val = this.value.split('-');
    const url = new URL(window.location.href);
    url.searchParams.set('month', val[1]);
    url.searchParams.set('year', val[0]);
    url.searchParams.set('filterType', 'month');
    window.location.href = url.toString();
};

yearPicker.onchange = function() {
    const url = new URL(window.location.href);
    url.searchParams.set('year', this.value);
    url.searchParams.set('filterType', 'year');
    window.location.href = url.toString();
};
</script>
