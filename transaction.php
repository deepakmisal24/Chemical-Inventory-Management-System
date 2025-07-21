<?php
session_start();
include 'partials/_dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Function to log a transaction
function log_transaction($conn, $username, $action, $table, $entry_id) {
    $stmt = mysqli_prepare($conn, "INSERT INTO transactions (username, action, table_name, entry_id) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssi", $username, $action, $table, $entry_id);
    mysqli_stmt_execute($stmt);
}

// Handle dynamic actions (insert/update/delete)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['table']) && isset($_POST['action'])) {
    $table = $_POST['table'];
    $action = $_POST['action'];
    $username = $_SESSION['username'];
    $entry_id = intval($_POST['entry_id']);

    // Log the transaction
    log_transaction($conn, $username, $action, $table, $entry_id);
    header("Location: transactions.php?logged=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Logs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<?php require 'partials/_nav.php'; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Inventory Activity Logs</h2>

    <?php if (isset($_GET['logged']) && $_GET['logged'] == 1): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Transaction successfully logged.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Product ID</th>
                    <th>Table Affected</th>
                    <th>Action</th>
                    <th>Username</th>
                    <th>Date & Time</th>
                    
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM `transactions` ORDER BY timestamp DESC";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['entry_id']}</td>
                                    <td>{$row['table_name']}</td>
                                    <td><span class='badge badge-" .
                                        ($row['action'] === 'add' ? 'success' : ($row['action'] === 'update' ? 'info' : 'danger')) .
                                        "'>" . ucfirst($row['action']) . "</span></td>
                                    <td>{$row['username']}</td>
                                    <td>{$row['timestamp']}</td>
                                    
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No transaction records found.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    

</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>