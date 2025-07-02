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
            $broken = $_POST['broken'];
            


            $sql1 = "SELECT `total_quantity` FROM `instrument` WHERE `number`=$number";
            $result1 = mysqli_query($conn, $sql1);
            if (!$result1) {
                die("Query failed: ". mysqli_error($conn));
            }
            $num = mysqli_num_rows($result1);
            $row = mysqli_fetch_assoc($result1);
            if($num>0){
                $nnumber = mysqli_real_escape_string($conn, $number);
                $working=$row['total_quantity'] - $broken;
                
                if($working<0)
                {
                    echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Out of limit! </strong> Number of broken items exceeds available stock
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                        </div> ';
                    
                }
                else{
                    $sql = "UPDATE `instrument` SET `broken`=$broken,`working`=$working WHERE `number`=$nnumber;";
                    $result = mysqli_query($conn, $sql);
                
        
                if (!$result) {

                    echo 'Error: ' . mysqli_error($conn);
                
                    exit;
                
                }
                $num=mysqli_affected_rows($conn);
                if ($num == 1) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Record deleted successfully
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        </div>';

                    }
                else
                {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> We are facing some technical issue and the records was not deleted ! We regret the inconvinience caused!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"></span>
                        </button>
                        </div>';
                    }
                }
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Invalid serial number! </strong> Please enter a valid serial number
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    </div> ';
            }    
          }
    ?>
    <?php require 'C:\xampp\htdocs\phpt\partials\_nav.php' ?>
    <div class="container mt-3">
    <h1 class="text-center">Update Instrument Inventory</h1>
    <form action="instrumentupdate.php" method="post">
        <div class="form-group">
            <label for="number">Serial number of the instrument</label>
            <input type= "text" name="number" class="form-control" id="number" aria-describedby="emailHelp" Required placeholder="Enter the serial number of the instrument you want to update">
        </div>
        <div class="form-group">
            <label for="broken">Number of broken instrument</label>
            <input type= "number" name="broken" class="form-control" id="broken" aria-describedby="emailHelp" Required placeholder="Enter the number of broken instrument">
        </div>
        
        <button type="submit" class="btn btn-primary">Update the Instrument Inventory</button>
        </form>

    </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

