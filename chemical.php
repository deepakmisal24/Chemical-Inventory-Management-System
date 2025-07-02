<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Chemical Inventory System</title>
  </head>
  <body>
    <?php
    session_start();
    include 'C:\xampp\htdocs\phpt\partials\_dbconnect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $s_no = mysqli_real_escape_string($conn, $_POST['s_no']);
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $volume = mysqli_real_escape_string($conn, $_POST['volume']);
      $state = mysqli_real_escape_string($conn, $_POST['state']);
      $price = mysqli_real_escape_string($conn, $_POST['price']);
      $date = mysqli_real_escape_string($conn, $_POST['date']);
      
      $sql = "INSERT INTO `chemicals` (`s_no`, `name`, `volume`, `state`, `price`, `date`) 
              VALUES ('$s_no', '$name', '$volume', '$state', '$price', '$date');";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your entry has been submitted successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Technical issue, entry was not submitted.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
    }
    ?>

    <?php require 'C:\xampp\htdocs\phpt\partials\_nav.php'; ?>
    
    <div class="container mt-4">
      <h1 class="text-center">Add New Chemical to Inventory</h1>
      <form action="chemical.php" method="post">
        <div class="form-group">
          <label for="s_no">Product Serial Number</label>
          <input type="number" name="s_no" class="form-control" id="s_no" required placeholder="Enter serial number">
        </div>
        <div class="form-group">
          <label for="name">Chemical Name</label>
          <input type="text" name="name" class="form-control" id="name" required placeholder="Enter chemical name">
        </div>
        <div class="form-group">
          <label for="volume">Quantity (kg or liters)</label>
          <input type="number" name="volume" class="form-control" id="volume" required placeholder="Enter quantity">
        </div>
        <div class="form-group">
          <label for="state">Physical State</label>
          <select name="state" class="form-control" id="state" required>
            <option value="" disabled selected>-- Select State --</option>
            <option value="Solid">Solid</option>
            <option value="Liquid">Liquid</option>
            <option value="Gas">Gas</option>
          </select>
        </div>
        <div class="form-group">
          <label for="price">Invoice Value</label>
          <input type="double" name="price" class="form-control" id="price" required placeholder="Enter price in INR">
        </div>
        <div class="form-group">
          <label for="date">Purchase Date</label>
          <input type="date" name="date" class="form-control" id="date" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Add to Chemical Inventory</button>
      </form>
    </div>

    <script>
      // Set default date input to today
      document.getElementById('date').value = new Date().toISOString().split('T')[0];
    </script>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>
