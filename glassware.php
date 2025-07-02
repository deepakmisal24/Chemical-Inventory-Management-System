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
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            include 'C:\xampp\htdocs\phpt\partials\_dbconnect.php';
            $s_no = $_POST['s_no'];
            $name = $_POST['name'];
            $capacity = $_POST['capacity'];
            $t_quantity = $_POST['t_quantity'];
            $price=$_POST['price'];
            $date=$_POST['date'];
         
            $sql = "INSERT INTO `glassware` (`s_no`, `name`, `capacity`, `t_quantity`,`price`,`date`) VALUES ('$s_no', '$name', '$capacity','$t_quantity','$price','$date');";
            $result = mysqli_query($conn, $sql);
    
            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your entry has been submitted successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
                </div>';
              }
            else{
                //echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> We are facing some technical issue and your entry was not submitted successfully! We regret the inconvinience caused!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"></span>
                </button>
                </div>';
              }

          }

    ?>
    <?php require 'C:\xampp\htdocs\phpt\partials\_nav.php' ?>
    <div class="container mt-3">
    <h1 class="text-center">Enter glassware to add to the inventory</h1>
        <form action="glassware.php" method="post">
        <div class="form-group">
            <label for="s_no">Product serial number</label>
            <input type= "number" name="s_no" class="form-control" id="s_no" aria-describedby="emailHelp" Required placeholder="Enter the product serial number">
        </div>
        <div class="form-group">
            <label for="name">Name of the Glassware</label>
            <input type= "string" name="name" class="form-control" id="name" aria-describedby="emailHelp" Required placeholder="Enter the glassware name">
        </div>
        <div class="form-group">
            <label for="capacity">Glassware size (capacity in mL)</label>
            <input type= "string" name="capacity" class="form-control" id="capacity" aria-describedby="emailHelp" Required placeholder="Enter the capacity of the glassware">
        </div>
        <div class="form-group">
            <label for="t_quantity">Number of units purchased</label>
            <input type= "number" name="t_quantity" class="form-control" id="t_quantity" aria-describedby="emailHelp" Required placeholder="Enter the number of pieces">
        </div>
        <div class="form-group">
            <label for="price">Total invoice value</label>
            <input type= "double" name="price" class="form-control" id="price" aria-describedby="emailHelp" Required placeholder="Enter the bill amount in INR">
        </div>
        <div class="form-group">
            <label for="date">Purchase transaction date</label>
            <input type= "date" name="date" class="form-control" id="date" aria-describedby="emailHelp" Required>
        </div>

        
        <button type="submit" class="btn btn-success btn-block">Add to the Glassware Inventory</button>
        </form>
    </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

