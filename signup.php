<?php
$showAlert = false;
$showError = false;
$showPswdError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $eid = $_POST['eid'];
    $contact=$_POST['contact'];
    $pswd=$_POST['pswd'];
    $cpswd = $_POST["cpswd"];
    $exists=false;
    $existsphone=false;
    $existSql = "SELECT * FROM `signin` WHERE eid = '$eid'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    $existphone = "SELECT * FROM `signin` WHERE contact = '$contact'";
    $result2 = mysqli_query($conn, $existphone);
    $numPhoneExistRows = mysqli_num_rows($result2);
    if($numExistRows > 0){
        // $exists = true;
        $showError = " Please log in instead";
    }
    else if($numPhoneExistRows > 0){
        $showError = " Phone number already registered";
    }
    else{
        if(($pswd == $cpswd) && $exists==false){
            
            $sql = "INSERT INTO `signin` (`fname`, `sname`, `eid`, `contact`,`pswd`) VALUES ('$fname', '$sname', '$eid', '$contact','$pswd');";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
        
            header("location: login.php");
        }

        else{
            $showPswdError = " Password mismatch";
        }
    }
}
    
?>

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
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>Looks like youre already a member!</strong>'. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    if($showPswdError){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>Unable to create account! </strong>'. $showPswdError.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div> ';
        }
    ?>

    <div class="container my-4">
     <h1 class="text-center">Get Started with Your New Account</h1>
     <form action="signup.php" method="post">
     <div class="form-group">
            <label for="fname">First Name</label>
            <input type= "text" name="fname" class="form-control" id="fname" aria-describedby="emailHelp" Required placeholder="Enter your first name">
        </div>
        <div class="form-group">
            <label for="sname">Last Name</label>
            <input type= "text" name="sname" class="form-control" id="sname" aria-describedby="emailHelp" Required placeholder="Enter your last name">
        </div>
        <div class="form-group">
            <label for="eid">Employee Id</label>
            <input type= "text" minLength="6" maxLength="6"  name="eid" class="form-control" id="eid" aria-describedby="emailHelp" Required placeholder="Enter 6 digit employee ID">
        </div>
        <div class="form-group">
            <label for="contact">Phone Number</label>
            <input type= "phone" minLength="10" maxlength="10" name="contact" class="form-control" id="contact" aria-describedby="emailHelp" Required placeholder="Enter your 10 digit phone number">
        </div>
        <div class="form-group">
            <label for="pswd">Password</label>
            <input type= "password" minLength="8" maxLength="25" name="pswd" class="form-control" id="pswd" aria-describedby="emailHelp" Required placeholder="Enter the password (Minimum 8 characters and maximum 25 character)">
        </div>
        <div class="form-group">
            <label for="cpswd">Re-enter to confirm password match</label>
            <input type="password" maxLength="25" class="form-control" id="cpswd" name="cpswd" Rquired placeholder="Enter same password as above to confirm">
            <small id="emailHelp" class="form-text text-muted">Make sure the passwords are same</small>
        </div>
         
        <button type="submit" class="btn btn-primary">Sign Up</button>
        <small id="emailHelp" class="form-text text-muted"><p class="mb-0">Already have an account, login<a href="login.php"> using this link.</a></p></small>
     </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
