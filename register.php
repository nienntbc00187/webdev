<?php
// Khởi tạo mảng lưu trữ thông tin người dùng đã nhập
$user_data = array(
    'fullname' => '',
    'email' => '',
    'phone' => '',
);

// Kiểm tra xem phiên làm việc đã được khởi tạo chưa
if (isset($_SESSION['user_data'])) {
    // Gán giá trị từ session cho biến $user_data
    $user_data = $_SESSION['user_data'];
}
?>

<?php include "header.php"; ?>

<div class="container-fluid h-custom" style="padding-top: 150px;">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form action="register.php" method="POST">

                <!-- Fullname input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3">Your fullname</label>
                    <input name="fullname" id="form3Example3" class="form-control form-control-lg" placeholder="Enter your fullname" value="<?php echo $user_data['fullname']; ?>" />
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3">Email address</label>
                    <input name="email" type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" value="<?php echo $user_data['email']; ?>" />
                </div>

                <!-- Phone input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3">Your phone</label>
                    <input name="phone" type="phone" id="form3Example3" class="form-control form-control-lg" placeholder="Enter your phone" value="<?php echo $user_data['phone']; ?>" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="form3Example4">Password</label>
                    <input name="password" type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" />
                </div>

                <!-- Retype Password input -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="form3Example4">Retype Password</label>
                    <input name="repassword" type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" />
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                        <input name="checked" class="form-check-input me-2" type="checkbox" value="" id="form2Example3" required />
                        <label class="form-check-label" for="form2Example3">
                            By submitting this form, you agree to processing of personal data according to our <a href="">Privacy Policy</a> and <a href="">Terms of Use</a>.
                        </label>
                    </div>
                </div>

                <div class="divider d-flex align-items-center my-4">
                </div>

                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                    <p class="lead fw-normal mb-0 me-3">Register with</p>
                    <button type="button" class="btn btn-primary btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" class="btn btn-primary btn-floating mx-1">
                        <i class="fab fa-brands fa-google"></i>
                    </button>
                </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login.php" class="link-danger">Login</a></p>
                </div>

            </form>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>

<?php
include "config.php";

// Khởi tạo mảng lưu trữ các thông báo lỗi
$errors = array();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user_data['fullname'] = $_POST['fullname'];
    $user_data['email'] = $_POST['email'];
    $user_data['phone'] = $_POST['phone'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    // Lưu thông tin người dùng vào session
    $_SESSION['user_data'] = $user_data;

    // Kiểm tra xem các trường dữ liệu có bị rỗng không
    if (empty($user_data['fullname'])) {
        $errors[] = "Please enter your full name.";
    }
    if (empty($user_data['email'])) {
        $errors[] = "Please enter your email address.";
    }
    if (empty($user_data['phone'])) {
        $errors[] = "Please enter your phone number.";
    }
    if (empty($password)) {
        $errors[] = "Please enter a password.";
    }
    if (empty($repassword)) {
        $errors[] = "Please re-enter your password.";
    }

    // Nếu không có trường dữ liệu nào rỗng, tiếp tục kiểm tra các điều kiện khác
    if (empty($errors)) {
        // Check if email is already in use
        $check_email_query = "SELECT * FROM users WHERE email='$user_data[email]'";
        $check_email_result = $conn->query($check_email_query);
        if ($check_email_result->num_rows > 0) {
            $errors[] = "Email has already been used!";
        }

        // Check if phone number is already in use
        $check_phone_query = "SELECT * FROM users WHERE phone='$user_data[phone]'";
        $check_phone_result = $conn->query($check_phone_query);
        if ($check_phone_result->num_rows > 0) {
            $errors[] = "Phone number has already been used!";
        }

        // Check if password and re-entered password match
        if ($password !== $repassword) {
            $errors[] = "Password and re-entered password do not match!";
        }

        // Kiểm tra xem có lỗi nào không
        if (empty($errors)) {
            // Hash the password before storing it in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Thêm người dùng mới vào cơ sở dữ liệu
            $insert_user_query = "INSERT INTO users (fullname, email, phone, password) VALUES ('$user_data[fullname]', '$user_data[email]', '$user_data[phone]', '$hashed_password')";
            if ($conn->query($insert_user_query) === TRUE) {
                echo "<script>
                toastr.success('Register successful!');
                setTimeout(function() {
                    window.location.href = 'login.php'; 
                }, 2000); 
              </script>";

                // Xóa phiên làm việc sau khi đăng ký thành công
                session_unset();
                session_destroy();
            } else {
                echo "<script>toastr.warning('Error: " . $conn->error . "');</script>";
            }
        } else {
            // Hiển thị tất cả các thông báo lỗi
            foreach ($errors as $error) {
                echo "<script>toastr.error('$error');</script>";
            }
        }
    } else {
        // Hiển thị tất cả các thông báo lỗi chi tiết cho từng trường thiếu thông tin
        foreach ($errors as $error) {
            echo "<script>toastr.error('$error');</script>";
        }
    }
    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
}
?>