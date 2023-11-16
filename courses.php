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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System - Courses</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function () {
        // Function to fetch and display courses based on selected semester and type
        function loadCourses() {
            var selectedSemester = $("#semesterSelect").val();

            // Make an AJAX request to fetch courses
            $.ajax({
                url: "fetch_courses.php",
                method: "GET",
                data: { semester: selectedSemester},
                success: function (data) {
                    // Update the course list div with the fetched courses
                    $("#courseList").html(data);
                },
                error: function () {
                    // Handle errors appropriately, e.g., show an error message
                    alert("Error fetching courses");
                }
            });
        }

        // Attach the loadCourses function to the change event of the semester and type selects
        $("#semesterSelect").change(loadCourses);

        // Initial load of courses when the page is ready
        loadCourses();
    });
</script>



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
        <h1 align="center">Courses Covered</h1>
        <label for="semesterSelect">Select Semester:</label>
        <select name="semesterSelect" id="semesterSelect">
            <option value="Semester-I">Semester-I</option>
            <option value="Semester-II">Semester-II</option>
            <option value="Semester-III">Semester-III</option>
            <!-- Add more semester options as needed -->
        </select>

        <div id="courseList"></div>
    </main>

    <footer>
        &copy; 2023 Student Management System
    </footer>
</body>

</html>
