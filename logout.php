<?php
// Khởi đầu phiên
session_start();

// Xóa các biến phiên liên quan đến người dùng đã đăng nhập
unset($_SESSION['user_id']);
unset($_SESSION['user_email']);

// Hủy toàn bộ phiên
session_destroy();

// Chuyển hướng đến trang đăng nhập hoặc trang chính
header("Location: index.php"); // Chuyển hướng đến trang đăng nhập
// hoặc header("Location: index.php"); // Chuyển hướng đến trang chính
exit;
