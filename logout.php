<?php
session_start(); // Start the session

// Unset all session variables to log the user out
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page after logging out
header("Location: login.php");
exit;
?>
