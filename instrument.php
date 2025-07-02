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
            $number = $_POST['number'];
            $name = $_POST['name'];
            $total_quantity = $_POST['total_quantity'];
            $price=$_POST['price'];
            $date=$_POST['date'];
            $sql = "INSERT INTO `instrument` (`number`, `name`, `total_quantity`,`price`,`date`) VALUES ('$number', '$name', '$total_quantity','$price','$date');";
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
    <div class="container mt-4">
    <h1 class="text-center">Enter instrument to add to the inventory</h1>
        <form action="instrument.php" method="post">
        <div class="form-group">
            <label for="number">Product serial number</label>
            <input type= "number" name="number" class="form-control" id="number" aria-describedby="emailHelp" Required placeholder="Enter the serial number ">
        </div>
        <div class="form-group">
            <label for="name">Name of the instrument</label>
            <input type= "string" name="name" class="form-control" id="name" aria-describedby="emailHelp" Required placeholder="Enter the name of instrument ">
        </div>
        <div class="form-group">
            <label for="total_quantity">Number of units purchased</label>
            <input type= "number" name="total_quantity" class="form-control" id="total_quantity" aria-describedby="emailHelp" Required placeholder="Enter the number of units">
        </div>
        <div class="form-group">
            <label for="price">Total invoice value</label>
            <input type= "number" name="price" class="form-control" id="price" Required placeholder="Enter the price in INR ">
        </div>
        <div class="form-group">
            <label for="date">Purchase transaction date</label>
            <input type= "date" name="date" class="form-control" id="date" aria-describedby="emailHelp" Required placeholder="Enter the date of purchase">
        </div>

        
        <button type="submit" class="btn btn-success btn-block">Add to the Instrument Inventory</button>
        </form>
    </div>

    
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

