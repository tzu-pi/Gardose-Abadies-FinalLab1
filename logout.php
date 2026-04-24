<?php
session_start();

// Destroy session data
$_SESSION = [];
session_destroy();

// Redirect back to login
header("Location: index.php");
exit();
?>
