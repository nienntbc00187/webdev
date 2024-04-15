<?php

const DBServerName = "localhost"; // or your server IP address
const DBUsername = "root"; // your MySQL username
const DBPassword = ""; // your MySQL password
const DBName = "webdev"; // your MySQL database name

// Create connection
$conn = new mysqli(DBServerName, DBUsername, DBPassword, DBName);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vnp_TmnCode = "HIOOSB8J"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "PNQDHTJNAUISWMCEIPOCOGSCGSQTITBI"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://webdev.local/vnpay_ipn.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
