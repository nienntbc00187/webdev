<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->
<style>
    .overlay .overlay-content {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.3);
        /* Điều chỉnh mức độ mờ tại đây */
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        border-radius: 10px;
    }
</style>

<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary">100% Organic Foods</h4>
                <h1 class="mb-5 display-3 text-primary">Organic Veggies & Fruits Foods</h1>
                <div class="position-relative mx-auto">
                    <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number" placeholder="Search">
                    <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                </div>
            </div>
            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php
                        include "config.php";

                        // Truy vấn danh mục từ cơ sở dữ liệu
                        $sql = "SELECT * FROM categories";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $isFirstImage = true; // Biến kiểm soát xem hình ảnh đang được duyệt là hình ảnh đầu tiên hay không
                            // Duyệt qua các dòng dữ liệu
                            while ($row = $result->fetch_assoc()) {
                                $category_name = $row["category_name"];
                                $category_image = $row["category_image"];
                                // Tạo class active chỉ cho hình ảnh đầu tiên
                                $active_class = ($isFirstImage) ? "active" : "";
                                // Mã HTML với hình ảnh và tên danh mục từ cơ sở dữ liệu
                                echo '<div class="carousel-item ' . $active_class . ' rounded">
                <div class="overlay" style="width:380x;height:280px">
                    <img src="admin/' . $category_image . '" class="img-fluid w-100 h-100 bg-secondary rounded" alt="' . $category_name . '">
                    <div class="overlay-content">
                        <a href="#" class="btn px-4 py-2 text-white rounded">' . $category_name . '</a>
                    </div>
                </div>
            </div>';
                                $isFirstImage = false; // Đánh dấu đã duyệt qua hình ảnh đầu tiên
                            }
                        } else {
                            echo "Không có danh mục được tìm thấy";
                        }
                        ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Featurs Section Start -->
<div class="container-fluid featurs">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-car-side fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Free Shipping</h5>
                        <p class="mb-0">Free on order over $300</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Security Payment</h5>
                        <p class="mb-0">100% security payment</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-exchange-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>30 Day Return</h5>
                        <p class="mb-0">30 day money guarantee</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>24/7 Support</h5>
                        <p class="mb-0">Support every time fast</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featurs Section End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Our Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-all">
                                <span class="text-dark" style="width: 130px;">All Products</span>
                            </a>
                        </li>
                        <?php
                        // Query danh mục từ CSDL
                        $sql = "SELECT * FROM categories";
                        $result = $conn->query($sql);

                        // Hiển thị các thể loại làm các tab
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<li class="nav-item">';
                                echo '<a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-' . $row["category_name"] . '">';
                                echo '<span class="text-dark" style="width: 130px;">' . $row["category_name"] . '</span>';
                                echo '</a>';
                                echo '</li>';
                            }
                        } else {
                            echo "Not found category!";
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="tab-content">
                <div id="tab-all" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <?php
                        // Query tất cả sản phẩm từ CSDL
                        $all_products_sql = "SELECT products.*, categories.category_name, units.unit_name FROM products 
                                    INNER JOIN categories ON products.category_id = categories.id
                                    INNER JOIN units ON products.unit_id = units.id";
                        $all_products_result = $conn->query($all_products_sql);
                        if ($all_products_result->num_rows > 0) {
                            while ($product_row = $all_products_result->fetch_assoc()) {
                                echo '<div class="col-md-6 col-lg-4 col-xl-3">';
                                echo '<div class="rounded position-relative fruite-item">';
                                echo '<div class="fruite-img">';
                                echo '<a href="shop-detail.php?id=' . $product_row["id"] . '">';
                                echo '<img src="admin/' . $product_row["product_image"] . '" class="img-fluid w-100 rounded-top" alt="" style="height: 170px;">';
                                echo '</a>';
                                echo '</div>';
                                echo '<div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">' . $product_row["category_name"] . '</div>';
                                echo '<div class="p-4 border border-secondary border-top-0 rounded-bottom">';
                                echo '<h4><a href="shop-detail.php?id=' . $product_row["id"] . '">' . $product_row["product_name"] . '</a></h4>';
                                $max_words = 8;
                                $product_desrshort = $product_row["product_desrshort"];
                                $words = explode(" ", $product_desrshort);
                                $product_desrshort = implode(" ", array_slice($words, 0, $max_words));
                                echo '<p>' . $product_desrshort . '...</p>';
                                echo '<div class=" align-items-center">';
                                echo '<h4>' . number_format($product_row["product_price"]) . '$ / ' . $product_row["unit_name"] . '</h4>';
                                echo '<div class="d-flex justify-content-center align-items-center"">
    <div class="input-group quantity mb-3" style="width: 100px;">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                <i class="fa fa-minus"></i>
            </button>
        </div>
        <input type="text" class="form-control form-control-sm text-center border-0" value="1">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</div>';
                                echo '<a href="" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart" data-product-id="' . $product_row["id"] . '"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>';

                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "No products found!";
                        }
                        ?>

                    </div>
                </div>

                <?php
                // Query sản phẩm cho từng danh mục và hiển thị ở các tab tương ứng
                $category_sql = "SELECT * FROM categories";
                $category_result = $conn->query($category_sql);
                if ($category_result->num_rows > 0) {
                    while ($category_row = $category_result->fetch_assoc()) {
                        echo '<div id="tab-' . $category_row["category_name"] . '" class="tab-pane fade">';
                        echo '<div class="row g-4">';
                        $category_products_sql = "SELECT products.*, units.unit_name FROM products 
                                          INNER JOIN units ON products.unit_id = units.id 
                                          WHERE category_id = (SELECT id FROM categories WHERE category_name = '" . $category_row["category_name"] . "')";
                        $category_products_result = $conn->query($category_products_sql);
                        if ($category_products_result->num_rows > 0) {
                            while ($product_row = $category_products_result->fetch_assoc()) {
                                echo '<div class="col-md-6 col-lg-4 col-xl-3">';
                                echo '<div class="rounded position-relative fruite-item">';
                                echo '<div class="fruite-img">';
                                echo '<a href="shop-detail.php?id=' . $product_row["id"] . '">';
                                echo '<img src="admin/' . $product_row["product_image"] . '" class="img-fluid w-100 rounded-top" alt="" style="height: 170px;">';
                                echo '</a>';
                                echo '</div>';
                                echo '<div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">' . $category_row["category_name"] . '</div>';
                                echo '<div class="p-4 border border-secondary border-top-0 rounded-bottom">';
                                echo '<h4><a href="shop-detail.php?id=' . $product_row["id"] . '">' . $product_row["product_name"] . '</a></h4>';
                                $max_words = 8;
                                $product_desrshort = $product_row["product_desrshort"];
                                $words = explode(" ", $product_desrshort);
                                $product_desrshort = implode(" ", array_slice($words, 0, $max_words));
                                echo '<p>' . $product_desrshort . '...</p>';
                                echo '<div class="align-items-center">';
                                echo '<h4>' . number_format($product_row["product_price"]) . '$ / ' . $product_row["unit_name"] . '</h4>';
                                echo '<div class="d-flex justify-content-center align-items-center"">
    <div class="input-group quantity mb-3" style="width: 100px;">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                <i class="fa fa-minus"></i>
            </button>
        </div>
        <input type="text" class="form-control form-control-sm text-center border-0" value="1">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</div>';
                                echo '<a href="" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart" data-product-id="' . $product_row["id"] . '"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "No products found for this category!";
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "Not found category!";
                }
                ?>
            </div>
        </div>

    </div>
</div>
<!-- Fruits Shop End-->


<!-- Vesitable Shop Start-->
<div class="container-fluid vesitable">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="mb-0">Fresh Organic Vegetables</h1>
                <div class="owl-carousel vegetable-carousel d-flex justify-content-center">
                    <?php

                    // Truy vấn CSDL để lấy các sản phẩm trong danh mục có ID là 11
                    $category_id = 2; // ID của danh mục
                    $sql = "SELECT products.*, units.unit_name FROM products 
                    INNER JOIN units ON products.unit_id = units.id 
                    WHERE category_id = $category_id";
                    $result = $conn->query($sql);

                    // Hiển thị các sản phẩm trong danh mục 11
                    if ($result->num_rows > 0) {
                        while ($product_row = $result->fetch_assoc()) {
                            echo '<div class="border border-primary rounded position-relative vesitable-item">';
                            echo '<div class="vesitable-img">';
                            echo '<a href="shop-detail.php?id=' . $product_row["id"] . '">';
                            echo '<img src="admin/' . $product_row["product_image"] . '" class="img-fluid w-100 rounded-top" alt="" style="height: 170px;">';
                            echo '</a>';
                            echo '</div>';
                            echo '<div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>';
                            echo '<div class="p-4 rounded-bottom">';
                            echo '<h4 class="text-center"><a href="shop-detail.php?id=' . $product_row["id"] . '">' . $product_row["product_name"] . '</a></h4>';
                            $product_desrshort_words = explode(" ", $product_row["product_desrshort"]);
                            $product_desrshort_trimmed = implode(" ", array_slice($product_desrshort_words, 0, 8));
                            echo '<p class="text-center">' . $product_desrshort_trimmed . '...</p>';
                            echo '<div class="text-center">';
                            echo '<h4>' . number_format($product_row["product_price"]) . ' ' . $product_row["unit_name"] . '</h4>';
                            echo '<div class="d-flex justify-content-center align-items-center"">
    <div class="input-group quantity mb-3" style="width: 100px;">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                <i class="fa fa-minus"></i>
            </button>
        </div>
        <input type="text" class="form-control form-control-sm text-center border-0" value="1">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</div>';
                            echo '<a href="" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart" data-product-id="' . $product_row["id"] . '"><i class="fa fa-shopping-bag me-2 text-primary"></i>Add to cart</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "No products found in this category!";
                    }
                    ?>



                </div>
            </div>
        </div>
    </div>

</div>
<!-- Vesitable Shop End -->


<!-- Tastimonial Start -->
<div class="container-fluid testimonial ">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h4 class="text-primary">Our Testimonial</h4>
            <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
            <?php

            // Truy vấn dữ liệu từ bảng testimonials
            $sql = "SELECT * FROM testimonials";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Hiển thị dữ liệu
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="testimonial-item img-border-radius bg-light rounded p-4">';
                    echo '<div class="position-relative">';
                    echo '<i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>';
                    echo '<div class="mb-4 pb-4 border-bottom border-secondary">';
                    echo '<p class="mb-0">' . $row["testimonial"] . '</p>';
                    echo '</div>';
                    echo '<div class="d-flex align-items-center flex-nowrap">';
                    echo '<div class="bg-secondary rounded">';
                    echo '<img src="admin/' . $row["testimonial_image"] . '" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">';
                    echo '</div>';
                    echo '<div class="ms-4 d-block">';
                    echo '<h4 class="text-dark">' . $row["client_name"] . '</h4>';
                    echo '<p class="m-0 pb-3">' . $row["profession"] . '</p>';
                    echo '<div class="d-flex pe-5">';
                    // Hiển thị số lượng sao
                    for ($i = 0; $i < $row["testimonial_star"]; $i++) {
                        echo '<i class="fas fa-star text-primary"></i>';
                    }
                    // Hiển thị số lượng sao trống (nếu có)
                    for ($j = $row["testimonial_star"]; $j < 5; $j++) {
                        echo '<i class="fas fa-star"></i>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
            ?>


        </div>

    </div>
</div>
<!-- Tastimonial End -->