<?php
// Start the session
session_start();

// Destroy the session and unset all session variables
session_destroy();
$_SESSION = array();

// Redirect to the login page
header("Location: login.php");
exit();
?>
