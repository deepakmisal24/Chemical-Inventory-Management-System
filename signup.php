<?php
$showAlert = false;
$showError = false;
$showPswdError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $eid = $_POST['eid'];
    $contact = $_POST['contact'];
    $pswd = $_POST['pswd'];
    $cpswd = $_POST["cpswd"];

    // Check if employee ID already exists using prepared statement
    $existSql = "SELECT * FROM `signin` WHERE eid = ?";
    $stmt = mysqli_prepare($conn, $existSql);
    mysqli_stmt_bind_param($stmt, "s", $eid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $numExistRows = mysqli_num_rows($result);

    // Check if phone number already exists using prepared statement
    $existphone = "SELECT * FROM `signin` WHERE contact = ?";
    $stmt2 = mysqli_prepare($conn, $existphone);
    mysqli_stmt_bind_param($stmt2, "s", $contact);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $numPhoneExistRows = mysqli_num_rows($result2);

    if ($numExistRows > 0) {
        $showError = " Employee ID already registered. Please log in instead.";
    } elseif ($numPhoneExistRows > 0) {
        $showError = " Phone number already registered.";
    } else {
        if ($pswd == $cpswd) {
            $hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);

            $sql = "INSERT INTO `signin` (`fname`, `sname`, `eid`, `contact`, `pswd`) VALUES (?, ?, ?, ?, ?);";
            $stmt3 = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt3, "sssss", $fname, $sname, $eid, $contact, $hashed_pswd);
            $result = mysqli_stmt_execute($stmt3);

            if ($result) {
                echo "<script>alert('Signup successful! You can now log in.'); window.location.href='login.php';</script>";
                exit;
            }
        } else {
            $showPswdError = " Passwords do not match.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CIS - Sign Up</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
      .signup-container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            margin-top: 40px;
            border-radius: 15px;
            background-color: #f8f9fa;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
  </head>
  <body>
    <?php require 'partials/_nav.php'; ?>

    <div class="container signup-container">
      <h2 class="text-center mb-4">Create Your Account</h2>

      <?php if ($showError): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error:</strong> <?= $showError; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      <?php endif; ?>

      <?php if ($showPswdError): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error:</strong> <?= $showPswdError; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      <?php endif; ?>

      <form action="signup.php" method="post">
        <div class="form-group">
          <label for="fname">First Name</label>
          <input type="text" name="fname" class="form-control" id="fname" required placeholder="Enter your first name">
        </div>
        <div class="form-group">
          <label for="sname">Last Name</label>
          <input type="text" name="sname" class="form-control" id="sname" required placeholder="Enter your last name">
        </div>
        <div class="form-group">
          <label for="eid">Employee ID</label>
          <input type="text" name="eid" class="form-control" id="eid" minlength="6" maxlength="6" required placeholder="Enter your Employee ID">
        </div>
        <div class="form-group">
          <label for="contact">Phone Number</label>
          <input type="tel" name="contact" class="form-control" id="contact" minlength="10" maxlength="10" required placeholder="Enter your phone number">
        </div>
        <div class="form-group">
          <label for="pswd">Password</label>
          <input type="password" name="pswd" class="form-control" id="pswd" minlength="8" maxlength="25" required placeholder="Enter your password">
        </div>
        <div class="form-group">
          <label for="cpswd">Confirm Password</label>
          <input type="password" name="cpswd" class="form-control" id="cpswd" maxlength="25" required placeholder="Re-enter your password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
        <div class="mt-3 text-center">
          <small>Have an account? <a href="login.php">Login here</a></small><br>
          <small>Forgot password? <a href="forgotpswd.php">Reset here</a></small>
        </div>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
