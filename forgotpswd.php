<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>CIS</title>
  </head>
  <body>

<?php
// Connecting to the Database
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $eid = $_POST['eid'];
        $contact = $_POST['contact'];
        $pswd = $_POST['pswd'];
        include 'C:\xampp\htdocs\phpt\partials\_dbconnect.php';
    $neid = mysqli_real_escape_string($conn, $eid);
    $npswd = mysqli_real_escape_string($conn, $pswd);
    $sql = "UPDATE `signin` SET `pswd` = '$npswd' WHERE `eid` = '$neid' AND `contact` = '$contact'; ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {

        echo 'Error: ' . mysqli_error($conn);
    
        exit;
    
    }
    $num=mysqli_affected_rows($conn);
    if ($num == 1) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Password has been reseted
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
            </div> ';
            '<small id="emailHelp" class="form-text text-muted"><p class="mb-0">Create an account <a href="login.php"> using this link.</a></p></small>';
        }
    else{
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Something went wrong
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
            </div> ';
        }
   
}

?>
<?php include 'C:\xampp\htdocs\phpt\partials\_nav.php'?>
<div class="container mt-3">
    <h1 class="text-center">Reset your password</h1>
        <form action="forgotpswd.php" method="post">
        <div class="form-group">
            <label for="eid">Employee Id</label>
            <input type= "text" name="eid" minLength="6" maxLength="6" class="form-control" id="eid" aria-describedby="emailHelp" Required placeholder="Enter your 6 digit employee ID">
        </div>
        <div class="form-group">
            <label for="contact">Phone number</label>
            <input type= "text" name="contact" minLength="10" maxLength="10" class="form-control" id="contact" aria-describedby="emailHelp" Required placeholder="Enter your 10 digit registered phone number">
        </div>
        <div class="form-group">
            <label for="pswd">Set new password</label>
            <input type= "password" name="pswd" minLength="8" maxLength="25"class="form-control" id="pswd" aria-describedby="emailHelp" Required placeholder="Enter the new password">
            <small><label>Password will be updated</label></small>
        </div>
        <button type="submit" class="btn btn-primary">Account Credential Reset</button>
        <small id="emailHelp" class="form-text text-muted"><p class="mb-0">Create an account <a href="signup.php"> using this link.</a></p></small>
        <small id="emailHelp" class="form-text text-muted"><p class="mb-0">Login <a href="login.php"> using this link.</a></p></small>
        </form>
    </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

