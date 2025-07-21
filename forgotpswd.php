<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CIS - Reset Password</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">

  <!-- Custom Styles -->
  <style>
    body {
      background: #f5f7fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }
    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }
    .btn-primary {
      border-radius: 50px;
    }
    .small-link {
      font-size: 0.875rem;
    }
  </style>
</head>

<body>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eid = $_POST['eid'];
    $contact = $_POST['contact'];
    $pswd = $_POST['pswd'];

    include 'partials/_dbconnect.php';

    $hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);

    $sql = "UPDATE `signin` SET `pswd` = ? WHERE `eid` = ? AND `contact` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $hashed_pswd, $eid, $contact);
    mysqli_stmt_execute($stmt);
    
    $num = mysqli_affected_rows($conn);
    
    if ($num == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <strong>Success!</strong> Password has been reset.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <strong>Error!</strong> No matching record found or password was not updated.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }
}
?>

<?php include 'partials/_nav.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="col-md-6">
    <div class="card p-4">
      <h3 class="text-center mb-4">🔐 Reset Your Password</h3>
      <form action="forgotpswd.php" method="post">
        <div class="form-group">
          <label for="eid">Employee ID</label>
          <input type="text" name="eid" minlength="6" maxlength="6" class="form-control" id="eid" required
                 placeholder="Enter your 6-digit Employee ID">
        </div>
        <div class="form-group">
          <label for="contact">Phone Number</label>
          <input type="text" name="contact" minlength="10" maxlength="10" class="form-control" id="contact" required
                 placeholder="Enter your 10-digit phone number">
        </div>
        <div class="form-group">
          <label for="pswd">New Password</label>
          <input type="password" name="pswd" minlength="8" maxlength="25" class="form-control" id="pswd" required
                 placeholder="Create your new password">
          <small class="form-text text-muted">Password must be 8-25 characters long.</small>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        <div class="mt-3 text-center">
          <p class="small-link mb-1">Don't have an account? <a href="signup.php">Sign up here</a>.</p>
          <p class="small-link">Already a user? <a href="login.php">Login now</a>.</p>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body>
</html>
