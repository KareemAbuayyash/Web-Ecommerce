<?php
// config.php

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    // Set session cookie parameters for security
    session_set_cookie_params([
        'lifetime' => 0, // Session cookie expires when browser closes
        'path' => '/',
        'domain' => '',
        'secure' => isset($_SERVER['HTTPS']), // True if using HTTPS
        'httponly' => true, // Prevent JavaScript access to session cookie
        'samesite' => 'Lax' // Adjust as needed
    ]);
    session_start();
}

// Database connection parameters
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$database = 'ka';

// Create a new MySQLi connection
$con = mysqli_connect($host, $user, $password, $database);

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: Handle user authentication here or include separate authentication scripts
?>
