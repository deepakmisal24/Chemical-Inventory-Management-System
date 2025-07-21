<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>

<style>
/* Hover effect for navbar links */
.navbar-nav .nav-link:hover {
    color: #ffc107 !important; /* Bootstrap warning color (yellowish) */
    text-decoration: underline;
    transition: color 0.3s ease, text-decoration 0.3s ease;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="welcome.php">Chemical Inventory System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="welcome.php">Home</a>
      </li>

      <?php if ($loggedin): ?>
        <li class="nav-item">
          <a class="nav-link" href="inventory_management.php">Inventory Management</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transaction.php">Transaction</a>
        </li>
      <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link" href="aboutus.php">About Us</a>
      </li>
    </ul>

    <div class="ml-auto d-flex align-items-center">
      <span id="date" style="color: white; margin-right: 20px;"></span>

      <?php if (!$loggedin): ?>
        <a href="login.php" class="btn btn-outline-light mr-2">Login</a>
        <a href="signup.php" class="btn btn-outline-light">Sign up</a>
      <?php else: ?>
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<script>
function startDateTimeDisplay() {
  function updateDateTime() {
    const today = new Date();
    const formatted = today.toLocaleString("en-IN", {
      day: "2-digit", month: "2-digit", year: "numeric",
      hour: "2-digit", minute: "2-digit", second: "2-digit",
      hour12: false
    });
    document.getElementById("date").innerHTML = formatted;
  }

  updateDateTime(); // initial
  setInterval(updateDateTime, 1000); // every second
}
startDateTimeDisplay();
</script>
