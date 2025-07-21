<!DOCTYPE html>
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
    
    <div class="container mt-4">
        <h1 class="text-center mb-4">Chemical Inventory Management System</h1>
        
        <div class="list-group">
            <a href="inventory_form.php" class="list-group-item list-group-item-action">
                ➕ Add New Inventory
            </a>
            <a href="inventory_view.php" class="list-group-item list-group-item-action">
                📋 View Inventory
            </a>
            <a href="inventory_update.php" class="list-group-item list-group-item-action">
                ✏️ Update Inventory Entry
            </a>
            <a href="inventory_delete.php" class="list-group-item list-group-item-action">
                ❌ Delete Inventory Entry
            </a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
