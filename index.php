<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);

    if (!empty($username)) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Please enter your name.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daily Check-In Tracker</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
    <h2>Daily Check-In Tracker</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input 
            type="text" 
            name="username" 
            placeholder="Enter your name" 
            required
        >
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>