<?php
session_start();

// If not logged in, go back to login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];

// Check last visit cookie
$last_visit = "This is your first visit!";
if (isset($_COOKIE['last_visit'])) {
    $last_visit = $_COOKIE['last_visit'];
}

// Set new cookie (1 day = 86400 seconds)
setcookie("last_visit", date("Y-m-d H:i:s"), time() + 86400);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome, <?php echo $username; ?>!</h2>

<p><strong>Current Date & Time:</strong> <?php echo date("Y-m-d H:i:s"); ?></p>

<p><strong>Last Visit:</strong> <?php echo $last_visit; ?></p>

<br>
<a href="logout.php">Logout</a>

</body>
</html>