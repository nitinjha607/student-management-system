<?php
$servername = "localhost"; // MySQL server hostname
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "users"; // MySQL database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>