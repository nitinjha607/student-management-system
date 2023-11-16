<?php
session_start();

if (!isset($_SESSION["username"])) {
    // User is not logged in; redirect to the login page
    header("Location: login.php");
    exit();
}   
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student Management System - Attendance</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
    <header>
        <h1>Student Management System</h1>
    </header>

    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="students.php">Students</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="attendance.php">Attendance</a></li>
            <li><a href="grades.php">Grades</a></li>
        </ul>
    </nav>

    <main>
        <section id="attendance">
            <h1>Attendance Report</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" required>
    
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" required>
    
                <input type="submit" value="Filter">
            </form>

            <?php

// Database connection code (replace with your actual database connection details)
$servername = "localhost";
$db_username = "root";
$db_password = "";
$database = "attendance"; // Modify this with your database name

// Create a database connection
$conn = new mysqli($servername, $db_username, $db_password, 
$database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in student's username (modify this based on your authentication)

$studentUsername = $_SESSION["username"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];
// Query to retrieve attendance data for the logged-in student
$sql = "SELECT subject, date, attendanceData FROM attendance WHERE name = ? AND date BETWEEN ? AND ? ORDER BY date ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $studentUsername, $startDate, $endDate);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    // Display attendance data in a table
    // echo "<h1>Attendance Report</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Subject</th><th>Date</th><th>Attendance</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["subject"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["attendanceData"] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    // Show an error message if the query fails
    echo "Error fetching attendance data: " . $conn->error;
}

// Close the database connection
$stmt->close();
}
$conn->close();
?>
        </section>
    </main>

    <footer>
        &copy; 2023 Student Management System
    </footer>
</body>

</html>
