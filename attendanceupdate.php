<?php
session_start();

// Check if the user is logged in and is a teacher (you can add your authentication logic here)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "Delete All Records" button is clicked
    if (isset($_POST['deleteAllRecords'])) {
        // Get the start and end date from the form
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];

        // Database connection code (replace with your actual database connection details)
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $database = "attendance"; // Modify this with your database name

        // Create a database connection
        $conn = new mysqli($servername, $db_username, $db_password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Perform database deletion of records within the specified date range
        $sql = "DELETE FROM attendance WHERE date BETWEEN ? AND ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $startDate, $endDate);

        if ($stmt->execute()) {
            // Redirect to a success page or show a success message
            echo "Attendance records within the specified date range deleted successfully.";
            // header("Location: home.php");
            exit();
        } else {
            // Show an error message if the deletion fails
            echo "Error deleting attendance records: " . $conn->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } elseif (isset($_POST['updateAttendance'])) {
        // Process the regular form submission for updating attendance
        // Get the form data
        $name = $_POST["name"];
        $subject = $_POST["subject"];
        $attendanceData = $_POST["attendanceData"];
        $date = $_POST["date"];

        // Database connection code (replace with your actual database connection details)
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $database = "attendance"; // Modify this with your database name

        // Create a database connection
        $conn = new mysqli($servername, $db_username, $db_password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Perform database insertion for the subject, date, and attendance data
        // You should use prepared statements to prevent SQL injection
        $sql = "INSERT INTO attendance (name, subject, date, attendanceData) VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $subject, $date, $attendanceData);

        if ($stmt->execute()) {
            // Redirect to a success page or show a success message
            echo "Attendance record inserted successfully.";
            // header("Location: home.php");
            exit();
        } else {
            // Show an error message if the insertion fails
            echo "Error inserting attendance record: " . $conn->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Attendance Update - Teacher</title>
    <link rel="stylesheet" type="text/css" href="style4.css">
</head>
<body>
    <header>
        <h1>Attendance Update - Teacher</h1>
    </header>
    <nav>
        <ul>
            <li><a href="insert_profile.php">Student Profile</a></li>
            <li><a href="attendanceupdate.php">Attendance</a></li>
            <li><a href="grading_system.php">Grades</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </nav>
    <main>
        <section id="attendance-update">
            <h2>Attendance Records</h2>
            <form action="attendanceupdate.php" method="post">
                <label for="name">Student Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
                <label for="attendanceData">Attendance Data:</label>
                <input type="attendanceData" id="attendanceData" name="attendanceData" required>    
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
                <button type="submit" name="updateAttendance">Update</button>
            </form>
        </section>
        <br>
        <section id="attendance-update">
        <!-- Add a separate form for "Delete All Records" with 
        date range filters -->
            <h2>Delete Attendance Records</h2>
            <form action="attendanceupdate.php" method="post">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" required>
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate" required>
                <button type="submit" name="deleteAllRecords" onclick="return confirm('Are you sure you want to delete records within the specified date range?')">Delete Records</button>
            </form>
        </section>
    </main>
    <footer>
        &copy; 2023 Student Management System
    </footer>
</body>
</html>
