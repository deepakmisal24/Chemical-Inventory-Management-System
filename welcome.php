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
    
<?php include 'partials/_nav.php'?>
<?php include 'partials/style.css'?>
    
       
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
    <!-- Table -->
    <div class="container my-5">
    <div class="row text-center">

        <?php
            include 'partials/_dbconnect.php';

            // Query product counts
            $counts = [
                "Chemicals" => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM chemicals"))['count'],
                "Glasswares" => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM glassware"))['count'],
                "Instruments" => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM instrument"))['count']
            ];

            // Icon map
            $icons = [
                "Chemicals" => "flask",
                "Glasswares" => "wine-glass-alt",
                "Instruments" => "microscope"
            ];

            // Color classes
            $colors = [
                "Chemicals" => "primary",
                "Glasswares" => "success",
                "Instruments" => "info"
            ];
        ?>

        <?php foreach ($counts as $item => $count): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-left-<?php echo $colors[$item]; ?> h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-<?php echo $colors[$item]; ?>"><?php echo $item; ?></h5>
                                <h2 class="font-weight-bold"><?php echo $count; ?></h2>
                            </div>
                            <div>
                                <i class="fas fa-<?php echo $icons[$item]; ?> fa-3x text-<?php echo $colors[$item]; ?>"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    </div>

    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
