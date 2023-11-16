<?php
session_start();

if (!isset($_SESSION["username"])) {
    // User is not logged in; redirect to the login page
    header("Location: login.php");
    exit();
}

// Add database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db"; // Change this to your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
$name = $_POST["name"];
$roll_number = $_POST["roll_number"];
$admission_number = $_POST["admission_number"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$course = $_POST["course"];
$year = $_POST["year"];
$semester = $_POST["semester"];
$branch = $_POST["branch"];
$image_path = $_POST["image"];

// Insert data into the student_profiles table
$sql = "INSERT INTO student_profiles (username, name, roll_number, admission_number, email, phone, course, year, semester, branch, image_path)
        VALUES ('{$_SESSION["username"]}', '$name', '$roll_number', '$admission_number', '$email', '$phone', '$course', '$year', '$semester', '$branch', '$image_path')";

if ($conn->query($sql) === TRUE) {
    echo "Student profile inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
