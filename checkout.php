<?php include "header.php"; ?>
<?php include "config.php"; ?>

<div class="container" style="margin-top: 150px;">
    <div class="row">
        <!-- Order Information -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header text-center">
                    Order Information
                </div>
                <div class="card-body">

                    <!-- List of selected products -->
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="col-md-6"><strong>Product Name</strong></div>
                            <div class="col-md-3"><strong>Quantity</strong></div>
                            <div class="col-md-3"><strong>Price</strong></div>
                        </li>
                        <?php

                        // Kiểm tra xem session giỏ hàng đã được khởi tạo chưa, nếu chưa thì khởi tạo
                        if (!isset($_SESSION['cart'])) {
                            $_SESSION['cart'] = array();
                        }

                        // Function lấy thông tin sản phẩm từ CSDL dựa trên product_id (Giả sử đã có kết nối CSDL)
                        function getProductInfo($product_id)
                        {
                            // Thực hiện truy vấn để lấy thông tin sản phẩm từ CSDL
                            // $conn là biến chứa kết nối CSDL, bạn cần thay đổi nó tương ứng
                            global $conn;
                            $product_id = mysqli_real_escape_string($conn, $product_id); // Tránh SQL injection
                            $sql = "SELECT * FROM products WHERE id = '$product_id'";
                            $result = mysqli_query($conn, $sql);
                            if ($result && mysqli_num_rows($result) > 0) {
                                return mysqli_fetch_assoc($result);
                            }
                            return false;
                        }

                        // Hiển thị thông tin sản phẩm trong giỏ hàng
                        foreach ($_SESSION['cart'] as $product_id => $quantity) {
                            // Lấy thông tin sản phẩm từ CSDL
                            $product_info = getProductInfo($product_id);

                            // Kiểm tra xem sản phẩm có tồn tại không
                            if ($product_info) {
                                // Hiển thị thông tin sản phẩm trong HTML
                                echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                echo '<div class="col-md-6">' . $product_info['product_name'] . '</div>';
                                echo '<div class="col-md-3">' . $quantity . '</div>';
                                echo '<div class="col-md-3">' . number_format($product_info['product_price'] * $quantity) . ' $</div>';
                                echo '</li>';
                            }
                        }
                        ?>

                        <!-- Add other products if necessary -->
                    </ul>
                    <hr>
                    <?php
                    // Kiểm tra xem session giỏ hàng đã được khởi tạo chưa, nếu chưa thì khởi tạo
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array();
                    }

                    // Function tính tổng giá trị của giỏ hàng
                    function calculateSubtotal()
                    {
                        $subtotal = 0;
                        // Lặp qua từng sản phẩm trong giỏ hàng
                        foreach ($_SESSION['cart'] as $product_id => $quantity) {
                            // Lấy thông tin sản phẩm từ CSDL
                            $product_info = getProductInfo($product_id);
                            // Nếu sản phẩm tồn tại, tính tổng giá trị của sản phẩm (giá sản phẩm * số lượng)
                            if ($product_info) {
                                $subtotal += $product_info['product_price'] * $quantity;
                            }
                        }
                        return $subtotal;
                    }

                    // Tính toán subtotal
                    $subtotal = calculateSubtotal();

                    // Tính toán phí vận chuyển
                    $shipping_fee = ($subtotal < 500000) ? 20000 : 0;

                    // Tính toán tổng cộng
                    $total = $subtotal + $shipping_fee;
                    ?>

                    <div class="text-right mb-3">
                        <strong>Subtotal:</strong> <?php echo number_format($subtotal); ?> $
                    </div>
                    <div class="text-right mb-3">
                        <strong>Shipping Fee:</strong> <?php echo number_format($shipping_fee); ?>$
                    </div>
                    <div class="text-right">
                        <h5><strong>Total:</strong> <?php echo number_format($total); ?> $</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Customer Information -->
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header text-center">
                    Customer Information
                </div>
                <div class="card-body">
                    <!-- Form for entering customer information -->
                    <form action="vnpay_create_payment.php" id="frmCreateOrder" method="post">
                        <input class="form-control" type="hidden" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" max="100000000" min="1" name="amount" type="number" value="<?php echo ($total); ?>" />
                        <?php
                        // Kiểm tra xem session người dùng đã đăng nhập hay chưa
                        if (isset($_SESSION['user_id'])) {
                            // Đã đăng nhập, lấy user_id từ session
                            $user_id = $_SESSION['user_id'];

                            // Chuẩn bị truy vấn SQL để lấy thông tin người dùng từ CSDL
                            $sql = "SELECT * FROM users WHERE id = $user_id";

                            // Thực thi truy vấn
                            $result = mysqli_query($conn, $sql);

                            // Kiểm tra xem truy vấn có thành công hay không
                            if ($result && mysqli_num_rows($result) > 0) {
                                // Lấy thông tin người dùng từ kết quả truy vấn
                                $user = mysqli_fetch_assoc($result);

                                // Hiển thị thông tin người dùng trong các trường nhập
                                echo '<div class="form-group">';
                                echo '<label for="name">Full Name:</label>';
                                echo '<input type="text" class="form-control" id="name" placeholder="Enter full name" disabled value="' . $user['fullname'] . '">';
                                echo '</div>';

                                echo '<div class="form-group">';
                                echo '<label for="email">Email:</label>';
                                echo '<input type="email" class="form-control" id="email" placeholder="Enter email address" disabled value="' . $user['email'] . '">';
                                echo '</div>';

                                echo '<div class="form-group">';
                                echo '<label for="address">Address:</label>';
                                echo '<input type="text" class="form-control" id="address" placeholder="Enter address" disabled value="' . $user['address'] . '">';
                                echo '</div>';

                                echo '<div class="form-group">';
                                echo '<label for="phone">Phone Number:</label>';
                                echo '<input type="tel" class="form-control" id="phone" placeholder="Enter phone number" disabled value="' . $user['phone'] . '">';
                                echo '</div>';
                                echo  '<br>';
                                echo '<div class="form-group text-danger">';
                                echo '<label>If you wish to change the information above, please go to the address settings in your account section.</label>';
                                echo '</div>';
                            }
                        } else {
                            // Chưa đăng nhập, hiển thị các trường nhập trống
                            echo '<div class="form-group">';
                            echo '<label for="name">Full Name:</label>';
                            echo '<input type="text" class="form-control" id="name" placeholder="Enter full name">';
                            echo '</div>';

                            echo '<div class="form-group">';
                            echo '<label for="email">Email:</label>';
                            echo '<input type="email" class="form-control" id="email" placeholder="Enter email address">';
                            echo '</div>';

                            echo '<div class="form-group">';
                            echo '<label for="address">Address:</label>';
                            echo '<input type="text" class="form-control" id="address" placeholder="Enter address">';
                            echo '</div>';

                            echo '<div class="form-group">';
                            echo '<label for="phone">Phone Number:</label>';
                            echo '<input type="tel" class="form-control" id="phone" placeholder="Enter phone number">';
                            echo '</div>';
                        }
                        ?>
                        <hr>
                        <div class="form-group">
                            <label for="paymentMethod">Payment Method:</label>
                            <select class="form-control" id="paymentMethod">
                                <option value="Cash on Delivery (COD)">Cash on Delivery (COD)</option>
                                <option value="Payment via VNPay">Payment via VNPay</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deliveryMethod">Delivery Method:</label>
                            <select class="form-control" id="deliveryMethod">
                                <option value="Home Delivery">Home Delivery</option>
                                <option value="Pick up at Store">Pick up at Store</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="buyerNotes">Buyer Notes:</label>
                            <textarea class="form-control" id="buyerNotes" rows="3" placeholder="Enter any notes for the seller"></textarea>
                        </div>
                        <br>
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <a href="cart.php"><button type="button" class="btn btn-secondary">Back to Cart</button></a>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Confirm Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include "footer.php"; ?>