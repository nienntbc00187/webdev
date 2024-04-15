<?php include "header.php" ?>
<?php include "config.php" ?>

<!-- Single Product Start -->
<div class="container-fluid pt-5" style="margin-top: 90px; " !important>
    <div class="container pt-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <?php
                    // Lấy ID sản phẩm từ yêu cầu hoặc từ một nguồn khác
                    $product_id = $_GET['id']; // Đây là ID của sản phẩm bạn muốn hiển thị

                    // Truy vấn SQL để lấy thông tin sản phẩm từ cơ sở dữ liệu
                    $sql = "SELECT p.product_image, p.product_name, p.product_price, p.product_desrshort, p.product_desrdetail, c.category_name, u.unit_name
        FROM products p
        INNER JOIN categories c ON p.category_id = c.id
        INNER JOIN units u ON p.unit_id = u.id
        WHERE p.id = $product_id";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Hiển thị thông tin sản phẩm
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="admin/<?php echo $row["product_image"]; ?>" class="img-fluid rounded" alt="<?php echo $row["product_name"]; ?>">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3"><?php echo $row["product_name"]; ?></h4>
                                <p class="mb-3">Category: <?php echo $row["category_name"]; ?></p>
                                <h5 class="fw-bold mb-3">Price: <?php echo number_format($row["product_price"]) ?> $ / <?php echo $row["unit_name"]; ?></h5>
                                <p class="mb-4"><?php echo $row["product_desrshort"]; ?></p>
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
                                <a href="" class="btn border border-secondary rounded-pill px-3 text-primary add-to-cart" data-product-id=""><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about" aria-selected="true">Description</button>
                                        <button class="nav-link border-white border-bottom-0" type="button" role="tab" id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission" aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <?php echo $row["product_desrdetail"]; ?>
                                    </div>

                            <?php
                        }
                    }
                            ?>

                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                <div class="d-flex">
                                    <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Jason Smith</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                            words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Sam Peters</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                            words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                            <form action="#">
                                <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <input type="text" class="form-control border-0 me-4" placeholder="Yur Name *">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <input type="email" class="form-control border-0" placeholder="Your Email *">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-bottom rounded my-4">
                                            <textarea name="" id="" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between py-3 mb-5">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 me-3">Please rate:</p>
                                                <div class="d-flex align-items-center" style="font-size: 12px;">
                                                    <i class="fa fa-star text-muted"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <a href="#" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <h4>Categories</h4>
                            <ul class="list-unstyled fruite-categorie">
                                <?php

                                // Truy vấn danh sách danh mục sản phẩm
                                $sql_categories = "SELECT categories.id, categories.category_name, COUNT(products.id) AS total_products
                                FROM categories
                                LEFT JOIN products ON categories.id = products.category_id
                                GROUP BY categories.id, categories.category_name";
                                $result_categories = $conn->query($sql_categories);

                                // Truy vấn tổng số sản phẩm không áp dụng điều kiện về categoryId
                                $sql_total_all_categories = "SELECT COUNT(id) AS total FROM products";
                                $result_total_all_categories = $conn->query($sql_total_all_categories);
                                $row_total_all_categories = $result_total_all_categories->fetch_assoc();
                                $total_products_all_categories = $row_total_all_categories["total"];

                                echo "<li>";
                                echo "<div class='d-flex justify-content-between fruite-name'>";
                                // Liên kết để hiển thị tất cả sản phẩm (không có categoryId)
                                echo "<a href='shop.php?categoryId='><i class='fas fa-apple-alt me-2'></i>All Categories</a>";
                                echo "<span>($total_products_all_categories)</span>";
                                echo "</div>";
                                echo "</li>";

                                if ($result_categories->num_rows > 0) {
                                    while ($row = $result_categories->fetch_assoc()) {
                                        echo "<li>";
                                        echo "<div class='d-flex justify-content-between fruite-name'>";
                                        // Liên kết với categoryId
                                        echo "<a href='shop.php?categoryId=" . $row["id"] . "'><i class='fas fa-apple-alt me-2'></i>" . $row["category_name"] . "</a>";
                                        echo "<span>(" . $row["total_products"] . ")</span>";
                                        echo "</div>";
                                        echo "</li>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h4 class="mb-4">Featured products</h4>
                        <?php
                        // Truy vấn SQL để lấy 6 sản phẩm ngẫu nhiên
                        $sql = "SELECT products.*, units.unit_name FROM products
        INNER JOIN units ON products.unit_id = units.id
        ORDER BY RAND() LIMIT 6";
                        $result = $conn->query($sql);

                        // Kiểm tra xem có kết quả trả về không
                        if ($result->num_rows > 0) {
                            // Duyệt qua các hàng kết quả và hiển thị thông tin sản phẩm
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="d-flex align-items-center justify-content-start">';
                                echo '<div class="rounded me-3" style="width: 100px; height: 100px;">';
                                echo '<a href="shop-detail.php?id=' . $row['id'] . '">';
                                echo '<img src="admin/' . $row['product_image'] . '" class="img-fluid rounded" alt="Image">';
                                echo '<a>';
                                echo '</div>';
                                echo '<div>';
                                echo '<a href="shop-detail.php?id=' . $row['id'] . '">';
                                echo '<h6 class="mb-2">' . $row['product_name'] . '</h6>';
                                echo '<div class="d-flex mb-2">';
                                echo '<h5 class="fw-bold me-2">' . number_format($row['product_price']) . ' $ / ' . $row['unit_name'] . '</h5>';
                                echo '</a>';
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
        </div>
        <h1 class="fw-bold mb-0">Related products</h1>
        <div class="vesitable">
            <div class="owl-carousel vegetable-carousel justify-content-center">
                <?php
                // Lấy ID sản phẩm từ yêu cầu hoặc từ một nguồn khác
                $product_id = $_GET['id']; // Đây là ID của sản phẩm bạn muốn hiển thị

                // Truy vấn SQL để lấy danh mục của sản phẩm đang xem
                $sql_category = "SELECT category_id FROM products WHERE id = $product_id";
                $result_category = $conn->query($sql_category);

                if ($result_category->num_rows > 0) {
                    $row_category = $result_category->fetch_assoc();
                    $category_id = $row_category["category_id"];

                    // Truy vấn SQL để lấy tất cả sản phẩm thuộc cùng một danh mục
                    $sql_products = "SELECT p.id, p.product_name, LEFT(p.product_desrshort, 50) AS short_description, p.product_price, p.product_image, c.category_name, u.unit_name 
    FROM products p
    INNER JOIN categories c ON p.category_id = c.id
    INNER JOIN units u ON p.unit_id = u.id
    WHERE p.category_id = $category_id"; // Thay đổi điều kiện từ $product_id thành $category_id
                    $result_products = $conn->query($sql_products);

                    if ($result_products->num_rows > 0) {
                        // Hiển thị thông tin của các sản phẩm
                        while ($row_product = $result_products->fetch_assoc()) {
                ?>
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img">
                                    <img src="admin/<?php echo $row_product["product_image"]; ?>" class="img-fluid w-100 rounded-top" alt="" style="height: 200px;">
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?php echo $row_product["category_name"]; ?></div>
                                <div class="text-center p-4 pb-4 rounded-bottom">
                                    <h4><?php echo $row_product["product_name"]; ?></h4>
                                    <p><?php echo $row_product["short_description"]; ?>...</p>
                                    <div class='text-center'>
                                        <h4><?php echo $row_product["product_price"] . '$ / ' . $row_product["unit_name"]; ?></h4>
                                        <div class="d-flex justify-content-center align-items-center">
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
                                        </div>

                                        <a href='#' class='btn border border-secondary rounded-pill px-3 text-primary'><i class='fa fa-shopping-bag me-2 text-primary'></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    } else {
                        echo "No products found in this category.";
                    }
                } else {
                    echo "Category not found for the given product ID.";
                }
                ?>


            </div>
        </div>
    </div>
</div>
<!-- Single Product End -->


<?php include "footer.php" ?>