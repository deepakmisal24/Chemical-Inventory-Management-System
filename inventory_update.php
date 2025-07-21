<?php
session_start();
include 'partials/_dbconnect.php';
include 'partials/_nav.php';

function sanitize_input($conn, $input) {
    return mysqli_real_escape_string($conn, trim($input));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'] ?? '';
    $updates = [];
    $error = '';
    $success = '';

    switch ($type) {
        case 'chemical':
        $s_no = $_POST['chem_s_no'] ?? '';
        if (empty($s_no)) {
            $error = "Serial number is required for chemical.";
            break;
        }

        $fields = ['name', 'volume', 'state', 'used'];
        foreach ($fields as $f) {
            if (isset($_POST["chem_$f"]) && $_POST["chem_$f"] !== '') {
                $updates[$f] = sanitize_input($conn, $_POST["chem_$f"]);
            }
        }

        if (empty($updates)) {
            $error = "At least one field must be filled to update.";
            break;
        }

        $res = mysqli_query($conn, "SELECT volume, used FROM chemicals WHERE s_no = '$s_no'");
        if ($res && mysqli_num_rows($res)) {
            $row = mysqli_fetch_assoc($res);

            // Update numeric values additively if provided
            $volume = isset($updates['volume']) ? $row['volume'] + (float)$updates['volume'] : $row['volume'];
            $used   = isset($updates['used'])   ? $row['used']   + (float)$updates['used']   : $row['used'];
            $available = $volume - $used;

            if ($available < 0) {
                $error = "Used amount exceeds total volume.";
                break;
            }

            // Finalize update set
            $updates['volume'] = $volume;
            $updates['used'] = $used;
            $updates['available'] = $available;

            $set = [];
            foreach ($updates as $key => $value) {
                $set[] = "$key = '" . sanitize_input($conn, $value) . "'";
            }
            $set_sql = implode(', ', $set);

            $sql = "UPDATE chemicals SET $set_sql WHERE s_no = '$s_no'";
            if (mysqli_query($conn, $sql)) {
                $success = "Chemical updated successfully.";

                // Log transaction if user session exists
                if (!empty($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $action = 'update';
                    $table = 'chemicals';
                    $entry_id = $s_no;

                    $sql_log = "INSERT INTO transactions (username, action, table_name, entry_id, timestamp) VALUES (?, ?, ?, ?, NOW())";
                    if ($stmt_log = mysqli_prepare($conn, $sql_log)) {
                        mysqli_stmt_bind_param($stmt_log, "sssi", $username, $action, $table, $entry_id);
                        mysqli_stmt_execute($stmt_log);
                        mysqli_stmt_close($stmt_log);
                    }
                }
            } else {
                $error = "Failed to update chemical: " . mysqli_error($conn);
            }
        } else {
            $error = "Chemical not found.";
        }
        break;
    

        case 'glassware':
            $s_no = $_POST['glass_s_no'] ?? '';
            if ($s_no == '') {
                $error = "Serial number is required for glassware.";
                break;
            }

            $fields = ['name', 'capacity', 't_quantity', 'broken'];
            foreach ($fields as $f) {
                if (!empty($_POST["glass_$f"])) {
                    $updates[$f] = sanitize_input($conn, $_POST["glass_$f"]);
                }
            }

            if (empty($updates)) {
                $error = "At least one field must be filled to update.";
                break;
            }

            $res = mysqli_query($conn, "SELECT working, broken, t_quantity FROM glassware WHERE s_no = '$s_no'");
            if ($res && mysqli_num_rows($res)) {
                $row = mysqli_fetch_assoc($res);

                $t_quantity = isset($updates['t_quantity']) ? $row['t_quantity'] + $updates['t_quantity'] : $row['t_quantity'];
                $broken = isset($updates['broken']) ? $row['broken'] + $updates['broken'] : $row['broken'];
                $working = isset($updates['working']) ? $row['working'] + $updates['working'] : $row['working'];
                $working = $t_quantity;
                $working = $working - $broken;

                if ($working < 0) {
                    $error = "Broken items exceed total quantity.";
                    break;
                }

                $updates['t_quantity'] = $t_quantity;
                $updates['broken'] = $broken;
                $updates['working'] = $working;

                $set = [];
                foreach ($updates as $key => $value) {
                    $set[] = "$key = '$value'";
                }
                $set_sql = implode(', ', $set);

                $sql = "UPDATE glassware SET $set_sql WHERE s_no = '$s_no'";
                if (mysqli_query($conn, $sql)) {
                    $success = "Glassware updated successfully.";
                    if (!empty($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        $action = 'update';
                        $table = 'glassware';
                        $entry_id = $s_no;

                        $sql_log = "INSERT INTO transactions (username, action, table_name, entry_id, timestamp) VALUES (?, ?, ?, ?, NOW())";
                        if ($stmt_log = mysqli_prepare($conn, $sql_log)) {
                            mysqli_stmt_bind_param($stmt_log, "sssi", $username, $action, $table, $entry_id);
                            mysqli_stmt_execute($stmt_log);
                            mysqli_stmt_close($stmt_log);
                        }
                    }
                } else {
                    $error = "Failed to update glassware: " . mysqli_error($conn);
                }
            } else {
                $error = "Glassware not found.";
            }
            break;
        case 'instrument':
            $number = $_POST['instr_number'] ?? '';
            if ($number == '') {
                $error = "Number is required for instrument.";
                break;
            }

            $fields = ['name', 'total_quantity', 'broken','working'];
            foreach ($fields as $f) {
                if (!empty($_POST["instr_$f"])) {
                    $updates[$f] = sanitize_input($conn, $_POST["instr_$f"]);
                }
            }

            if (empty($updates)) {
                $error = "At least one field must be filled to update.";
                break;
            }

            $res = mysqli_query($conn, "SELECT total_quantity,broken,working FROM instrument WHERE number = '$number'");
            if ($res && mysqli_num_rows($res)) {
                $row = mysqli_fetch_assoc($res);
                $total_quantity = isset($updates['total_quantity']) ? $row['total_quantity']+$updates['total_quantity'] : $row['total_quantity'];
                $broken = isset($updates['broken']) ? $row['broken'] + $updates['broken'] : $row['broken'];
                $working = isset($updates['working']) ? $row['working'] + $updates['working'] : $row['working'];
                $working = $total_quantity;
                $working = $working - $broken;
                if ($working < 0) {
                    $error = "Broken instruments exceed total.";
                    break;
                }
                $updates['total_quantity'] = $total_quantity;
                $updates['broken'] = $broken;
                $updates['working'] = $working;

                $set = [];
                foreach ($updates as $key => $value) {
                    $set[] = "$key = '$value'";
                }
                $set_sql = implode(', ', $set);

                $sql = "UPDATE instrument SET $set_sql WHERE number = '$number'";
                if (mysqli_query($conn, $sql)) {
                    $success = "Instrument updated successfully.";
                    if (!empty($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        $action = 'update';
                        $table = 'instrument';
                        $entry_id = $number;

                        $sql_log = "INSERT INTO transactions (username, action, table_name, entry_id, timestamp) VALUES (?, ?, ?, ?, NOW())";
                        if ($stmt_log = mysqli_prepare($conn, $sql_log)) {
                            mysqli_stmt_bind_param($stmt_log, "sssi", $username, $action, $table, $entry_id);
                            mysqli_stmt_execute($stmt_log);
                            mysqli_stmt_close($stmt_log);
                        }
                    }
                } else {
                    $error = "Failed to update intrument: " . mysqli_error($conn);
                }
            } else {
                $error = "intrument not found.";
            }
            break;

        default:
            $error = "Invalid category selected.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Inventory Updater</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>
<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<div class="container mt-4">
    <h2 class="text-center">Update Inventory</h2>
    <form method="POST">
        <div class="form-group">
            <label for="type">Select Category</label>
            <select name="type" class="form-control" id="type" required onchange="showForm(this.value)">
                <option value="">-- Select Category --</option>
                <option value="chemical">Chemical</option>
                <option value="glassware">Glassware</option>
                <option value="instrument">Instrument</option>
            </select>
        </div>
        <div class='mb-3'>
                <a class='btn btn-success btn-sm' href='inventory_form.php'>➕ Add New</a>
                <a class='btn btn-danger btn-sm' href='inventory_delete.php'>🗑️ Delete</a>
              </div>

        <!-- Chemical -->
        <div id="chemicalForm" style="display:none;">
            <h3>Chemical</h3>
            <input type="text" name="chem_s_no" class="form-control mb-2" placeholder="Serial Number (Required)">
            <input type="text" name="chem_name" class="form-control mb-2" placeholder="Name">
            <input type="number" name="chem_volume" class="form-control mb-2" placeholder="Volume">
            <select name="chem_state" class="form-control mb-2">
                <option value="">-- Select State --</option>
                <option value="Solid">Solid</option>
                <option value="Liquid">Liquid</option>
                <option value="Gas">Gas</option>
            </select>
            <input type="number" name="chem_used" class="form-control mb-2" placeholder="Used">
        </div>

        <!-- Glassware -->
        <div id="glasswareForm" style="display:none;">
            <h3>Glassware</h3>
            <input type="text" name="glass_s_no" class="form-control mb-2" placeholder="Serial Number (Required)">
            <input type="text" name="glass_name" class="form-control mb-2" placeholder="Name">
            <input type="number" name="glass_capacity" class="form-control mb-2" placeholder="Capacity of the glassware">
            <input type="number" name="glass_t_quantity" class="form-control mb-2" placeholder="Total Quantity">
            <input type="number" name="glass_broken" class="form-control mb-2" placeholder="Broken">
        </div>

        <!-- Instrument -->
        <div id="instrumentForm" style="display:none;">
            <h3>Instrument</h3>
            <input type="text" name="instr_number" class="form-control mb-2" placeholder="Number (Required)">
            <input type="text" name="instr_name" class="form-control mb-2" placeholder="Name">
            <input type="number" name="instr_total_quantity" class="form-control mb-2" placeholder="Total Quantity">
            <input type="number" name="instr_broken" class="form-control mb-2" placeholder="Broken">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Update Inventory</button>
    </form>
</div>

<script>
function showForm(category) {
    document.getElementById('chemicalForm').style.display = category === 'chemical' ? 'block' : 'none';
    document.getElementById('glasswareForm').style.display = category === 'glassware' ? 'block' : 'none';
    document.getElementById('instrumentForm').style.display = category === 'instrument' ? 'block' : 'none';
}
</script>
</body>
</html>
