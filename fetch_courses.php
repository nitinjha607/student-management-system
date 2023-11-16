<?php
// Assuming you have a database connection
session_start();
$servername = "localhost";
$db_username = "root";
$db_password = "";
$database = "course"; // Modify this with your database name
// Create a database connection
$conn = new mysqli($servername, $db_username, $db_password, 
$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION["username"])) {
    // User is not logged in; redirect to the login page
    header("Location: login.php");
    exit();
}

// Check if a semester is provided
if (isset($_GET['semester'])) {
    $selectedSemester = $_GET['semester'];

    // Fetch courses from the database for the selected semester
    $query = "SELECT * FROM courses WHERE semester = '$selectedSemester'" ;
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Display the courses
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>";
            echo "<h3>{$row['course_name']}</h3>";
            echo "<p>Type: {$row['type']}</p>";
            echo "<p>Course Code: {$row['course_code']}</p>";
            echo "<p>Instructor: {$row['instructor_name']}</p>";
            echo "<p>Credits: {$row['credits']}</p>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "Error fetching courses: " . mysqli_error($conn);
    }
} else {
    echo "No semester selected";
}
?>
