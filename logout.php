<?php
session_start();
session_unset();   // Unset all session variables
session_destroy(); // Destroy the session
setcookie(session_name(), '', time() - 3600, '/'); // Delete the session cookie

// Redirect to the login page or home page after logging out
header('Location: login.php');
exit();
?>
