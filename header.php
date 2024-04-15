<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="" class="text-white"><small class="text-white mx-2">Terms of Use</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-primary display-6">Fruitables</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <?php
                    // Lấy đường dẫn hiện tại
                    $current_url = $_SERVER['REQUEST_URI'];

                    // Kiểm tra xem đường dẫn có chứa 'shop.php' hay không
                    $shop_active = strpos($current_url, 'shop.php') !== false ? 'active' : '';

                    // Kiểm tra xem đường dẫn có chứa 'contact.php' hay không
                    $contact_active = strpos($current_url, 'contact.php') !== false ? 'active' : '';
                    ?>

                    <div class="navbar-nav mx-auto">
                        <a href="index.php" class="nav-item nav-link <?php echo $current_url == '/index.php' ? 'active' : ''; ?>">Home</a>
                        <a href="shop.php" class="nav-item nav-link <?php echo $shop_active; ?>">Shop</a>
                        <a href="contact.php" class="nav-item nav-link <?php echo $contact_active; ?>">Contact</a>
                    </div>

                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                        <?php
                        // Kiểm tra xem session giỏ hàng đã được khởi tạo chưa
                        if (!isset($_SESSION['cart'])) {
                            $_SESSION['cart'] = array();
                        }

                        // Tính tổng số lượng sản phẩm trong giỏ hàng
                        $total_quantity = array_sum($_SESSION['cart']);

                        // Hiển thị số lượng trong thẻ span
                        echo '<a href="cart.php" class="position-relative me-4 my-auto">';
                        echo '<i class="fa fa-shopping-bag fa-2x"></i>';
                        echo '<span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">' . $total_quantity . '</span>';
                        echo '</a>';
                        ?>


                        <div class="btn-group">
                            <button type="button" class="btn " data-bs-toggle="dropdown" aria-expanded="true">
                                <a href="#" class="my-auto">
                                    <i class="fas fa-user fa-2x"></i>
                                </a>
                            </button>
                            <?php

                            if (isset($_SESSION['user_id'])) {
                                // Nếu người dùng đã đăng nhập, hiển thị các liên kết cho tài khoản của họ
                                echo '<ul class="dropdown-menu dropdown-menu-end">';
                                echo '<li><a class="dropdown-item" href="myaccount.php">My Account</a></li>';
                                echo '<li><a class="dropdown-item" href="myordered.php">My Orders</a></li>';
                                echo '<li><a class="dropdown-item" href="logout.php">Logout</a></li>';
                                echo '</ul>';
                            } else {
                                // Nếu chưa đăng nhập, hiển thị liên kết đăng nhập và đăng ký
                                echo '<ul class="dropdown-menu dropdown-menu-end">';
                                echo '<li><a class="dropdown-item" href="login.php">Login</a></li>';
                                echo '<li><a class="dropdown-item" href="register.php">Register</a></li>';
                                echo '</ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->