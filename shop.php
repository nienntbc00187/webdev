<?php include "header.php" ?>
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5" style="margin-top:5%">
    <div class="container py-5">
        <div class="row g-4">
            <?php
            include "config.php";

            // Xử lý categoryId từ URL
            $category_id = isset($_GET['categoryId']) ? intval($_GET['categoryId']) : null;


            // Xử lý tham số sắp xếp từ URL
            $sorting = isset($_GET['sorting']) ? $_GET['sorting'] : 'default';
            $allowed_sorting = ['default', 'low_to_high', 'high_to_low'];

            // Kiểm tra nếu giá trị sắp xếp không hợp lệ, sử dụng giá trị mặc định
            if (!in_array($sorting, $allowed_sorting)) {
                $sorting = 'default';
            }

            ?>

            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3"></div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Default Sorting:</label>
                            <form id="fruitform">
                                <select id="sorting" name="sorting" class="border-0 form-select-sm bg-light me-3" onchange="updateURL()">
                                    <option value="default" <?php echo ($sorting == 'default') ? 'selected' : ''; ?>>Default</option>
                                    <option value="low_to_high" <?php echo ($sorting == 'low_to_high') ? 'selected' : ''; ?>>Low to High</option>
                                    <option value="high_to_low" <?php echo ($sorting == 'high_to_low') ? 'selected' : ''; ?>>High to Low</option>
                                </select>

                            </form>
                            <script>
                                function updateURL() {
                                    var sorting = document.getElementById("sorting").value;
                                    var categoryId = '<?php echo $category_id ?>';
                                    var baseUrl = window.location.href.split('?')[0]; // Get current URL without query string
                                    var url = baseUrl;

                                    // Xây dựng URL mới với tham số categoryId và sorting
                                    if (categoryId !== null && categoryId !== '') {
                                        url += "?categoryId=" + categoryId;
                                        if (sorting !== 'default') {
                                            url += "&sorting=" + sorting;
                                        }
                                    } else {
                                        if (sorting !== 'default') {
                                            url += "?sorting=" + sorting;
                                        }
                                    }

                                    window.location.href = url;; // Thay đổi URL mà không tải lại trang
                                }
                            </script>

                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
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
                                        echo "<a href='?categoryId='><i class='fas fa-apple-alt me-2'></i>All Categories</a>";
                                        echo "<span>($total_products_all_categories)</span>";
                                        echo "</div>";
                                        echo "</li>";

                                        if ($result_categories->num_rows > 0) {
                                            while ($row = $result_categories->fetch_assoc()) {
                                                echo "<li>";
                                                echo "<div class='d-flex justify-content-between fruite-name'>";
                                                // Liên kết với categoryId
                                                echo "<a href='?categoryId=" . $row["id"] . "'><i class='fas fa-apple-alt me-2'></i>" . $row["category_name"] . "</a>";
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
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <?php
                            $limit = 9;
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($page - 1) * $limit;

                            // Truy vấn sản phẩm dựa trên categoryId được chọn
                            $sql = "SELECT products.*, categories.category_name, units.unit_name 
                            FROM products 
                            INNER JOIN categories ON products.category_id = categories.id
                            INNER JOIN units ON products.unit_id = units.id";
                            if (!$category_id) {
                                // Nếu không có categoryId được chọn, không áp dụng bất kỳ điều kiện nào về categoryId
                                $sql .= " WHERE 1";
                            } else {
                                // Nếu có categoryId được chọn, áp dụng điều kiện về categoryId
                                $sql .= " WHERE products.category_id = $category_id";
                            }

                            // Thêm điều kiện sắp xếp
                            switch ($sorting) {
                                case 'low_to_high':
                                    $sql .= " ORDER BY product_price ASC";
                                    break;
                                case 'high_to_low':
                                    $sql .= " ORDER BY product_price DESC";
                                    break;
                                default:
                                    // Mặc định sắp xếp theo thứ tự mặc định hoặc không sắp xếp
                                    break;
                            }

                            $result = $conn->query($sql);

                            // Tính toán số lượng trang
                            $total_records = $result->num_rows;
                            $total_pages = ceil($total_records / $limit);

                            // Thực hiện truy vấn với phân trang
                            $sql .= " LIMIT $limit OFFSET $offset";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div class='col-md-6 col-lg-6 col-xl-4'>";
                                    echo "<div class='border border-primary rounded position-relative vesitable-item'>";
                                    echo "<div class='vesitable-img'>";
                                    echo "<a href='shop-detail.php?id=" . $row['id'] . "'><img src='admin/" . $row['product_image'] . "' class='img-fluid w-100 rounded-top' alt='' style='height: 170px;'></a>";
                                    echo "</div>";
                                    echo "<div class='text-white bg-primary px-3 py-1 rounded position-absolute' style='top: 10px; right: 10px;'>" . $row['category_name'] . "</div>";
                                    echo "<div class='p-4 rounded-bottom'>";
                                    echo "<h4 class='text-center'><a href='shop-detail.php?id=" . $row['id'] . "'>" . $row['product_name'] . "</a></h4>";
                                    $product_desrshort_words = explode(" ", $row["product_desrshort"]);
                                    $product_desrshort_trimmed = implode(" ", array_slice($product_desrshort_words, 0, 8));
                                    echo "<p class='text-center'>$product_desrshort_trimmed...</p>";
                                    echo "<div class='text-center'>";
                                    echo "<h4>" . number_format($row['product_price']) . " $ / " . $row['unit_name'] . "</h4>";
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
                                    echo "<a href='#' class='btn border border-secondary rounded-pill px-3 text-primary'><i class='fa fa-shopping-bag me-2 text-primary'></i> Add to cart</a>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            } else {
                                echo "Not found products!";
                            }
                            ?>
                        </div>
                        <div class="col-12">
                            <div class="pagination d-flex justify-content-center mt-5">
                                <?php
                                // Hiển thị các liên kết phân trang
                                if ($total_pages > 1) {
                                    if ($page > 1) {
                                        echo "<a href='?categoryId=$category_id&sorting=$sorting&page=1' class='rounded'>&laquo;</a>";
                                    }

                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $page) {
                                            echo "<a href='?categoryId=$category_id&sorting=$sorting&page=" . $i . "' class='active rounded'>" . $i . "</a>";
                                        } else {
                                            echo "<a href='?categoryId=$category_id&sorting=$sorting&page=" . $i . "' class='rounded'>" . $i . "</a>";
                                        }
                                    }

                                    if ($page < $total_pages) {
                                        echo "<a href='?categoryId=$category_id&sorting=$sorting&page=" . $total_pages . "' class='rounded'>&raquo;</a>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Fruits Shop End-->

<?php include "footer.php" ?>