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
    
        <div class="carousel-inner">
            <img class="d-block w-100" src="images/bldeacet.png" class="rounded-right"alt="Bldeacet_logo">
                        
        </div>
    
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/slide1.png" alt="First slide" style="height: 400px; width: 1600px;">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/slide2.png" alt="Second slide" style="height: 400px; width:1600px;">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/slide3.png" alt="Third slide" style="height: 400px; width: 1600px;">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="main-div">
        <div class="center-div-welcome">
            <div class="table-responsive">
                <table>
                    <thread>
                        <tr>
                            <th>Table names</th>
                            <th>Product count</th>
                        </tr>
                    </thread>
                    <tbody>
                        <?php
                            
                            include 'C:\xampp\htdocs\phpt\partials\_dbconnect.php';
                            $sql1 = "SELECT count(*) FROM `chemicals`";
                            $result1 = mysqli_query($conn, $sql1);
                            $sql2 = "SELECT count(*) FROM `glassware`";
                            $result2 = mysqli_query($conn, $sql2);
                            $sql3 = "SELECT count(*) FROM `instrument`";
                            $result3 = mysqli_query($conn, $sql3);
                            if (!$result1 and !$result2 and !$result3) {

                                die("Query failed: ". mysqli_error($conn));

                            }
                            // Find the number of records returned
                            $row1 = mysqli_fetch_assoc($result1);
                            $row2 = mysqli_fetch_assoc($result2);
                            $row3 = mysqli_fetch_assoc($result3);

                                ?>  <tr>
                                    <td><?php echo 'Glasswares';?></td>
                                    <td><?php echo $row2['count(*)'];?></td>
                                    </tr>
                                    <tr>
                                    <td><?php echo 'Chemicals';?></td>
                                    <td><?php echo $row1['count(*)'];?></td>
                                    </tr>
                                    <tr>
                                    <td><?php echo 'Instruments';?></td>
                                    <td><?php echo $row3['count(*)'];?></td>
                                    </tr>
                                <?php
                                
                                ?>
                    </tbody>
                </table>
                
            </div>
            
        </div>
        
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
