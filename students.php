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

// Get the username from the session
$username = $_SESSION["username"];

// Retrieve student profile from the database
$sql = "SELECT * FROM student_profiles WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display student profile
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $roll_number = $row["roll_number"];
    $admission_number = $row["admission_number"];
    $email = $row["email"];
    $phone = $row["phone"];
    $course = $row["course"];
    $year = $row["year"];
    $semester = $row["semester"];
    $branch = $row["branch"];
    $image_path = $row["image_path"];
} else {
    // Handle the case where the profile is not found
    echo "Student profile not found.";
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System - Student Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
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
        <section id="student-profile">
            <h2 align="center">Student Profile</h2>
            <div id="student-info" class="student-info-container">
                <div class="personal-info">
                    <h3>Personal details</h3>
                    <p>Name: <?php echo $name; ?></p>
                    <p>Univ Roll-no.: <?php echo $roll_number; ?></p>
                    <p>Admission no.: <?php echo $admission_number; ?></p>
                    <p>Email: <?php echo $email; ?></p>
                    <p>Phone: <?php echo $phone; ?></p>
                    <p>Course: <?php echo $course; ?></p>
                    <p>Year: <?php echo $year; ?></p>
                    <p>Semester: <?php echo $semester; ?></p>
                    <p>Branch: <?php echo $branch; ?></p>
                    <!-- Add more personal information here -->
                </div>
                <img class="student-image" src="<?php echo $image_path; ?>" alt="Student Image">
            </div>

            <!-- Add more sections for attendance, documents, etc. -->
        </section>
    </main>

    <footer>
        &copy; 2023 Student Management System
    </footer>
</body>

</html>
