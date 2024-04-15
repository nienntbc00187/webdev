<?php session_start();

// Kiểm tra xem session giỏ hàng đã được khởi tạo chưa, nếu chưa thì khởi tạo
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Hàm thêm sản phẩm vào giỏ hàng
function addToCart($product_id, $quantity)
{
    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    if (isset($_SESSION['cart'][$product_id])) {
        // Nếu đã tồn tại, cộng thêm số lượng mới vào số lượng hiện có
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        // Nếu chưa tồn tại, thêm mới sản phẩm vào giỏ hàng
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

// Xử lý yêu cầu thêm sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        addToCart($product_id, $quantity);
        echo 'success'; // Phản hồi cho AJAX biết rằng yêu cầu đã được xử lý thành công
        exit;
    }
}

// Lấy product_id từ yêu cầu AJAX
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Xóa sản phẩm khỏi session giỏ hàng
    unset($_SESSION['cart'][$product_id]);

    // Phản hồi AJAX
    echo 'success';
} else {
    echo 'error';
}
