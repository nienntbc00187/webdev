<?php include "header.php" ?>
<?php include "config.php" ?>


<!-- Cart Page Start -->
<div class="container-fluid" style="margin-top: 100px; " !important>
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Lấy thông tin giỏ hàng từ session
                    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

                    // Hàm lấy thông tin sản phẩm từ ID
                    function getProductInfo($conn, $product_id)
                    {
                        if (!empty($product_id)) {
                            $sql = "SELECT * FROM products WHERE id = $product_id";
                            $result = $conn->query($sql);
                            if ($result && $result->num_rows > 0) {
                                return $result->fetch_assoc();
                            }
                        }
                        return false;
                    }

                    // Hiển thị thông tin giỏ hàng
                    foreach ($cart as $product_id => $quantity) {
                        $product_info = getProductInfo($conn, $product_id);
                        if ($product_info) {
                            echo '<tr>';
                            echo '<th scope="row">';
                            echo '<div class="d-flex align-items-center">';
                            echo '<img src="admin/' . $product_info['product_image'] . '" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">';
                            echo '</div>';
                            echo '</th>';
                            echo '<td>';
                            echo '<p class="mb-0 mt-4">' . $product_info['product_name'] . '</p>';
                            echo '</td>';
                            echo '<td>';
                            echo '<p class="mb-0 mt-4 product_price">' . number_format($product_info['product_price']) . ' $</p>';
                            echo '</td>';
                            echo '<td>';
                            echo '<div class="input-group quantity mt-4" style="width: 100px;">';
                            echo '<div class="input-group-btn">';
                            echo '<button class="btn btn-sm btn-minus rounded-circle bg-light border"><i class="fa fa-minus"></i></button>';
                            echo '</div>';
                            echo '<input type="text" class="form-control form-control-sm text-center border-0" value="' . $quantity . '">';
                            echo '<div class="input-group-btn">';
                            echo '<button class="btn btn-sm btn-plus rounded-circle bg-light border"><i class="fa fa-plus"></i></button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</td>';
                            echo '<td>';
                            echo '<p class="mb-0 mt-4 product_subtotal_price">' . number_format($product_info['product_price'] * $quantity) . ' $</p>';
                            echo '</td>';
                            echo '<td>';
                            echo '<button class="btn btn-md rounded-circle bg-light border mt-4 delete-product" data-product-id="' . $product_id . '"><i class="fa fa-times text-danger"></i></button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>


                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping Fee</h5>
                            <div class="">
                                <p class="mb-0">Please see at the checkout step.</p>
                            </div>
                        </div>
                    </div>
                    <?php
                    // Kiểm tra xem session giỏ hàng đã được khởi tạo chưa, nếu chưa thì khởi tạo
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array();
                    }

                    // Function tính tổng giá trị của giỏ hàng
                    function calculateTotal()
                    {
                        $total = 0;
                        // Nếu giỏ hàng không trống
                        if (!empty($_SESSION['cart'])) {
                            global $conn;
                            // Lặp qua từng sản phẩm trong giỏ hàng
                            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                // Thực hiện truy vấn SQL để lấy giá của sản phẩm từ CSDL
                                $sql = "SELECT product_price FROM products WHERE id = $product_id";
                                $result = mysqli_query($conn, $sql);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    // Lấy giá sản phẩm từ kết quả truy vấn
                                    $row = mysqli_fetch_assoc($result);
                                    $product_price = $row['product_price'];
                                    // Tính tổng giá trị của sản phẩm (giá sản phẩm * số lượng)
                                    $total += $product_price * $quantity;
                                }
                            }
                            // Đóng kết nối CSDL
                            mysqli_close($conn);
                        }
                        return $total;
                    }

                    // Gọi function calculateTotal() để tính tổng giá trị của giỏ hàng
                    $total = calculateTotal();
                    ?>

                    <!-- Hiển thị tổng giá trị trong HTML -->
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Subtotal</h5>
                        <p class="mb-0 pe-4"><?php echo number_format($total); ?> $</p>
                    </div>

                    <a href="checkout.php"><button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->


<?php include "footer.php" ?>