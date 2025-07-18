<div>
    <div class="d-flex justify-content-center">
        <div class="flex-row d-flex w-100">
            <div class="slide d-flex align-items-center justify-content-start w-100">
                <div class="gap-2 p-4 mx-5 slide__information d-flex flex-column px-lg-5">
                    <h5 class="text-uppercase lineUp">Nhà hàng sang trọng</h5>
                    <h6 class="text-uppercase lineDown">Q1 - TP HCM</h6>
                    <p class="lineLeft">Giảm giá 15% </p>
                    <button class="primary-button w-25 lineRight">ĐẶT NGAY</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 mb-4">
        <h2>Hôm nay bạn muốn ăn gì ?</h2>
        <form method="GET" action="<?php echo $path ?>user/restaurant/search_res" id="searchForm">
            <div class="input-group input-group-lg">
                <button class="input-group-text bg-light" type="submit">
                    <i class="bi bi-search"></i>
                </button>
                <input type="text" 
                    class="py-3 form-control" 
                    name="q" 
                    id="searchFood" 
                    placeholder="Tìm kiếm món ăn..."
                    value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
            </div>
        </form> 
    </div>

   

    <div class="container py-5">
        <!-- Header -->
        <div class="mb-5 text-center">
            <h2 class="text-uppercase fw-bold" style="color: #2c3e50;">
                Danh sách nhà hàng
                <div style="height: 4px; width: 50px; background: #e74c3c; margin: 15px auto;"></div>
            </h2>
        </div>

        <!-- Categories Grid -->
        <div class="row g-4">
            <?php foreach ($data['other_category'] as $row) {
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100"
                        style="border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                        <!-- Image Container -->
                        <div class="position-relative" style="height: 250px; overflow: hidden;">
                            <img src="<?= $row['category_img'] ?>" class="w-100 h-100" alt="<?= $row['category_name'] ?>"
                                style="object-fit: cover; transition: transform 0.5s ease;">

                            <!-- Category Info Overlay -->
                            <div class="bottom-0 p-4 position-absolute start-0 w-100"
                                style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);">
                                <h4 class="mb-2 text-white text-uppercase fw-bold">
                                    <?= $row['category_name'] ?>
                                </h4>
                                <div class="d-flex align-items-center">
                                    <span class="badge" style="background: #e74c3c;">
                                        <i class="bi bi-shop me-2"></i>
                                        <?= $row['num_res'] ?> Nhà hàng
                                    </span>
                                </div>
                            </div>

                            <!-- Hover Overlay -->
                            <a href="<?php echo $path ?>user/restaurant/list_res/<?= $row['cateid'] ?>"
                                class="top-0 opacity-0 position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center text-decoration-none"
                                style="background: rgba(231, 76, 60, 0.9); transition: all 0.3s ease;">
                                <div class="text-center text-white">
                                    <i class="mb-3 bi bi-arrow-right-circle fs-1"></i>
                                    <h5 class="mb-0 text-uppercase">Xem Nhà Hàng</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="container my-5">
        <div class="mb-5 text-center">
            <h2 class="text-uppercase fw-bold" style="color: #2c3e50;">
                Nhà hàng nổi bật
                <div style="height: 4px; width: 50px; background: #e74c3c; margin: 15px auto;"></div>
            </h2>
        </div>
        <div class="row g-4">
            <!-- Nhà hàng chính bên trái -->
            <?php foreach ($data['restaurant_six'] as $row) { ?>
                <div class="col-md-6 col-lg-4">

                    <div class="card h-100" style="border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">

                        <img src="<?= $row['avatar'] ?>" class="card-img-top w-100" style="height: 250px; object-fit: cover;" alt="<?= $row['restaurant_name'] ?>">

                        <div class="card-body d-flex flex-column">
                            <h6 class="mb-3 card-title text-uppercase fw-bold"><?= $row['restaurant_name'] ?></h6>
                            <p class="card-text flex-grow-1"><?= $row['description'] ?></p>
                            <a href="<?= $path ?>user/restaurant/restaurant_detail/<?= $row['rid'] ?>" class="mt-3">
                                <button class="primary-button w-100">XEM NGAY</button>
                            </a>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <!-- Grid 2x2 nhà hàng bên phải -->

        </div>
    </div>

    <div class="my-5 tour__blog">
        <div class="mb-5 text-center">
            <h2 class="text-uppercase fw-bold" style="color: #2c3e50;">
                Tin tức
                <div style="height: 4px; width: 50px; background: #e74c3c; margin: 15px auto;"></div>
            </h2>
        </div>

        <div class="container">
            <div class="row g-4">
                <?php foreach ($data['news'] as $row) { ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 blog-card">
                            <div class="card-img-wrapper" style="height: 250px;">
                                <img src="<?= $row['news_image'] ?>" class="card-img-top w-100 h-100 object-fit-cover"
                                    alt="<?= $row['title'] ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h6 class="mb-3 card-title text-uppercase fw-bold"><?= $row['title'] ?></h6>
                                <p class="card-text flex-grow-1"><?= $row['intro'] ?></p>
                                <a href="<?= $path ?>user/news/detail_news/<?= $row['nsid'] ?>" class="mt-3">
                                    <button class="primary-button w-100">Đọc thêm</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hover Effects */
    .card:hover {
        transform: translateY(-5px);
    }

    .card:hover img {
        transform: scale(1.1);
    }

    .card:hover .opacity-0 {
        opacity: 1 !important;
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeIn 0.5s ease-out forwards;
    }

    /* Stagger animation for cards */
    .col-md-6:nth-child(1) .card {
        animation-delay: 0.1s;
    }

    .col-md-6:nth-child(2) .card {
        animation-delay: 0.2s;
    }

    .col-md-6:nth-child(3) .card {
        animation-delay: 0.3s;
    }

    .col-md-6:nth-child(4) .card {
        animation-delay: 0.4s;
    }

    .col-md-6:nth-child(5) .card {
        animation-delay: 0.5s;
    }

    .col-md-6:nth-child(6) .card {
        animation-delay: 0.6s;
    }

    /* Optional: Add media queries for better mobile experience */
    @media (max-width: 768px) {
        .card {
            margin-bottom: 20px;
        }
    }
</style>

<!-- Thêm form ẩn để submit -->


<script>
document.getElementById('searchFood').addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của phím Enter
        let searchTerm = e.target.value.trim();
        if (searchTerm) {
            document.getElementById('searchForm').submit();
        }
    }
});
</script>