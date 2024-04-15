<?php include "header.php"; ?>
<div class="container-fluid h-custom" style="padding-top: 150px;">
  <div class="row d-flex justify-content-center align-items-center h-100">

    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
      <form action="login.php" method="POST">
        <!-- Email input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="form3Example3">Email address</label>
          <input name="email" type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" />

        </div>

        <!-- Password input -->
        <div class="form-outline mb-3">
          <label class="form-label" for="form3Example4">Password</label>
          <input name="password" type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" />

        </div>

        <div class="d-flex justify-content-between align-items-center">
          <!-- Checkbox -->
          <div class="form-check mb-0">
            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
            <label class="form-check-label" for="form2Example3">
              Remember me
            </label>
          </div>
          <a href="reset-password.php" class="text-body">Forgot password?</a>
        </div>

        <div class="divider d-flex align-items-center my-4">
        </div>

        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
          <p class="lead fw-normal mb-0 me-3">Sign in with</p>
          <button type="button" class="btn btn-primary btn-floating mx-1">
            <i class="fab fa-facebook-f"></i>
          </button>

          <button type="button" class="btn btn-primary btn-floating mx-1">
            <i class="fab fa-brands fa-google"></i>
          </button>
        </div>

        <div class="text-center text-lg-start mt-4 pt-2">
          <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
          <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="register.php" class="link-danger">Register</a></p>
        </div>

      </form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>

<?php
include "config.php";

// Array to store error messages
$errors = array();

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if email and password are not empty
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    // Get login information from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to check login credentials
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    // Check if there's any data returned
    if ($result->num_rows > 0) {
      // Fetch data from the result
      $row = $result->fetch_assoc();

      // Use password_verify to check password
      if (password_verify($password, $row['password'])) {
        // Login successful
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];
        // Redirect to the main page after successful login
        echo "<script>
                toastr.success('Login successful!');
                setTimeout(function() {
                  window.location.href = 'index.php';
                }, 2000);
              </script>";
        exit;
      } else {
        // Incorrect password, add error message to array
        $errors[] = "Incorrect password. Please try again.";
      }
    } else {
      // Email does not exist in the database, add error message to array
      $errors[] = "Email does not exist in the database. Please check again or register a new account.";
    }
  } else {
    // Both email and password are empty, add appropriate error message to array
    if (empty($_POST['email']) && empty($_POST['password'])) {
      $errors[] = "Please enter both email and password.";
    } elseif (empty($_POST['email'])) {
      $errors[] = "Please enter your email.";
    } elseif (empty($_POST['password'])) {
      $errors[] = "Please enter your password.";
    }
  }

  // Close the connection
  $conn->close();
}

// Display error messages using toastr.error
foreach ($errors as $error) {
  echo "<script>toastr.error('{$error}');</script>";
}
?>