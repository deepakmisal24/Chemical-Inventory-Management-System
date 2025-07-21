<?php
session_start();
include 'partials/_dbconnect.php';
include 'partials/_nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Viewer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center mb-4">View Inventory</h2>
    <form method="POST" class="form-inline justify-content-center mb-4">
        <label for="category" class="mr-2">Select Category:</label>
        <select name="category" id="category" class="form-control mr-3" required>
            <option value="">--Select--</option>
            <option value="chemicals">Chemicals</option>
            <option value="glassware">Glassware</option>
            <option value="instrument">Instruments</option>
        </select>
        <button type="submit" class="btn btn-primary">View</button>
    </form>
    
        <div class='mb-3'>
                <a class='btn btn-success btn-sm' href='inventory_form.php'>➕ Add New</a>
                <a class='btn btn-warning btn-sm' href='inventory_update.php'>✏️ Update</a>
                <a class='btn btn-danger btn-sm' href='inventory_delete.php'>🗑️ Delete</a>
              </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category'])) {
        $category = $_POST['category'];
        $allowed = ['chemicals', 'glassware', 'instrument'];
        if (!in_array($category, $allowed)) {
            echo "<div class='alert alert-danger'>Invalid category selected.</div>";
            exit;
        }


        $sql = "SELECT * FROM `$category`";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<div class='table-responsive'><table class='table table-bordered table-striped'>";
            echo "<thead class='thead-dark'><tr>";

            // Print headers dynamically
            while ($field = mysqli_fetch_field($result)) {
                echo "<th>" . ucfirst(str_replace('_', ' ', $field->name)) . "</th>";
            }
            echo "</tr></thead><tbody>";

            // Print rows dynamically
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $val) {
                    echo "<td>" . htmlspecialchars($val) . "</td>";
                }
                echo "</tr>";
            }

            echo "</tbody></table></div>";
        } else {
            echo "<div class='alert alert-info'>No records found in $category.</div>";
        }
    }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
