<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CIS - Delete Inventory</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  </head>
  <body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'partials/_dbconnect.php';

    $table = $_POST['table'] ?? '';
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');

    $valid_tables = ['chemicals', 'glassware', 'instrument'];
    if (!in_array($table, $valid_tables)) {
        echo '<div class="alert alert-danger">Invalid table selected.</div>';
    } else {
        $conditions = "`name` = '$name'";
        $entry_id = '';

        if ($table === 'chemicals' || $table === 'glassware') {
            $s_no = mysqli_real_escape_string($conn, $_POST['s_no'] ?? '');
            $conditions .= " AND `s_no` = '$s_no'";
            $entry_id = $s_no;
        } elseif ($table === 'instrument') {
            $number = mysqli_real_escape_string($conn, $_POST['number'] ?? '');
            $conditions .= " AND `number` = '$number'";
            $entry_id = $number;
        }

        // DELETE Query
        $sql = "DELETE FROM `$table` WHERE $conditions";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
        } else {
            $affected = mysqli_affected_rows($conn);
            if ($affected === 1) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Record deleted successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      </div>';

                // Log transaction
                if (!empty($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $action = 'delete';
                    $sql_log = "INSERT INTO transactions (username, action, table_name, entry_id, timestamp) 
                                VALUES (?, ?, ?, ?, NOW())";
                    $stmt_log = mysqli_prepare($conn, $sql_log);
                    if ($stmt_log) {
                        mysqli_stmt_bind_param($stmt_log, "sssi", $username, $action, $table, $entry_id);
                        mysqli_stmt_execute($stmt_log);
                        mysqli_stmt_close($stmt_log);
                    }
                }
            } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Notice!</strong> No matching record found to delete.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        }
    }
}
?>

<?php include 'partials/_nav.php'; ?>

<div class="container mt-4">
  <h2 class="text-center">Delete Inventory Record</h2>
    <div class="form-group">
      <label >Select Table</label>
      <select class="form-control" name="table" id="table" required onchange="toggleFields()">
        <option value="" disabled selected>-- Choose --</option>
        <option value="chemicals">Chemicals</option>
        <option value="glassware">Glassware</option>
        <option value="instrument">Instruments</option>
      </select>
    </div>
    
  <form method="POST" action="inventory_delete.php" id="deleteForm" class="hidden">

    <div class="form-group" id="name_group" style="display:none;">
      <label for="name">Item Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter full name" required>
    </div>

    <div class="form-group" id="s_no_group" style="display:none;">
      <label for="s_no">Serial Number</label>
      <input type="text" class="form-control" name="s_no" id="s_no" placeholder="Enter Serial Number" required>
    </div>

    <div class="form-group" id="number_group" style="display:none;">
      <label for="number">Serial Number</label>
      <input type="text" class="form-control" name="number" id="number" placeholder="Enter Instrument Number" required>
    </div>

    <div class='mb-3'>
        <a class='btn btn-success btn-sm' href='inventory_form.php'>➕ Add New</a>
        <a class='btn btn-warning btn-sm' href='inventory_update.php'>✏️ Update</a>
    </div>

    <button type="submit" class="btn btn-danger btn-block">Delete Item</button>
  </form>
</div>

<script>
function toggleFields() {
  const table = document.getElementById('table').value;
  document.getElementById('name_group').style.display = table ? 'block' : 'none';
  document.getElementById('s_no_group').style.display = (table === 'chemicals' || table === 'glassware') ? 'block' : 'none';
  document.getElementById('number_group').style.display = (table === 'instrument') ? 'block' : 'none';
}
</script>

</body>
</html>
