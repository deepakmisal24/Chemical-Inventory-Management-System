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
?>
<?php include 'C:\xampp\htdocs\phpt\partials\_nav.php'?>
<?php include 'C:\xampp\htdocs\phpt\partials\style.css'?>

        <h1>List of Instruments</h1>

        <div class="left-div">
            <td><a type="button" class="btn btn-outline-success btn-sm" href="instrument.php">Add new Instrument to the Inventory</a></td>
            <td><a type="submit" class="btn btn-outline-primary btn-sm" href="instrumentupdate.php">Update the Instrument Inventory</a></td>
            <td><a type="button" class="btn btn-outline-danger btn-sm" href="instrumentdelete.php">Delete the Instrument from the Inventory</a></td>
        </div>
        <div class="main-div">
        <div class="center-div">
            <div class="table-responsive">
                <table>
                    <thread>
                        <tr>
                            <th>Serial number</th>
                            <th>Name</th>
                            <th>Total quantity</th>
                            <th>Broken</th>
                            <th>Working</th>
                            <th>Price</th>
                            <th>Date</th>
                        </tr>
                    </thread>
                    <tbody>
                        <?php
                            
                            include 'C:\xampp\htdocs\phpt\partials\_dbconnect.php';
                            $sql = "SELECT * FROM `instrument`";
                            $result = mysqli_query($conn, $sql);
                            if (!$result) {

                                die("Query failed: ". mysqli_error($conn));

                            }
                            // Find the number of records returned
                            $num = mysqli_num_rows($result);
                            while($row = mysqli_fetch_assoc($result)){
                                ?>  <tr>
                                    <td><?php echo $row['number'];?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['total_quantity'];?></td>
                                    <td><?php echo $row['broken'];?></td>
                                    <td><?php echo $row['working'];?></td>
                                    <td><?php echo $row['price'];?></td>
                                    <td><?php echo $row['date'];?></td>
                                    </tr>
                                
                        <?php
                                }
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>




