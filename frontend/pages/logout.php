<?php
session_start();

// Destroy all session data to log out the user
session_unset();
session_destroy();

// Redirect to the login page
header("Location: ../index.php");
exit();