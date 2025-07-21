<?php
$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $eid = $_POST["eid"];
    $pswd = $_POST["pswd"];

    $sql = "SELECT * FROM `signin` WHERE eid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $eid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pswd, $row['pswd'])) {
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $eid;
            header("location: welcome.php");
            exit;
        } else {
            $showError = "Invalid Credentials";
        }
    } else {
        $showError = "Invalid Credentials";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CIS - Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        .form-container {
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
    <?php include 'partials/_nav.php'; ?>

    <div class="container mt-4">
        <?php if ($login): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You are logged in.
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        <?php endif; ?>

        <?php if ($showError): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?= $showError ?>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <h2 class="text-center mb-4">Enter Your Credentials</h1>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="eid">Employee ID</label>
                    <input type="text" class="form-control" id="eid" name="eid" minlength="6" maxlength="6" required placeholder="Enter your 6-digit employee ID">
                </div>
                <div class="form-group">
                    <label for="pswd">Password</label>
                    <input type="password" class="form-control" id="pswd" name="pswd" minlength="8" maxlength="25" required placeholder="Enter your password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <div class="mt-3 text-center">
                    <small>Don't have an account? <a href="signup.php">Sign up here</a></small><br>
                    <small>Forgot password? <a href="forgotpswd.php">Reset here</a></small>
                </div>
            </form>
        </div>
    </div>

    <!-- JS scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
