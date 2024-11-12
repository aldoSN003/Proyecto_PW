<?php
require_once 'connection.php';
session_start();

// Check if the user is logged in by verifying session data
if (!isset($_SESSION['user'])) {
    // If the user is not logged in, redirect them to the login page
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <h1>You are successfully logged in!</h1>

    <p>Welcome, <strong><?php echo $_SESSION['user']['name']; ?></strong>!</p>
    <p>Your email: <strong><?php echo $_SESSION['user']['email']; ?></strong></p>
    <pre>

</pre>
    <a href="logout.php">Logout</a> <!-- Add a logout link -->
</body>

</html>