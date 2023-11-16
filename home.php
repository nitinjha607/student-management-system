<?php
session_start();

if (!isset($_SESSION["username"])) {
    // User is not logged in; redirect to the login page
    header("Location: login.php");
    exit();
}
?>
<!-- Your HTML content for the home page -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">
    <title>Student Management System - Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>
    <header>
        <h1>Welcome to the Student Management System</h1>
    </header>

    <nav>
        <ul>
            <li><a href="students.php">Students</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="attendance.php">Attendance</a></li>
            <li><a href="grades.php">Grades</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </nav>

    <main>
        <section id="dashboard">
            <h2>Dashboard</h2>
            <!-- Display key information, statistics, or announcements here -->
            <section id="course-details">
               <h1 align ="center">Time Table</h1>
               <img class="fitting-image" src="Time Table.jpeg" alt="Original Image" />
            </section>
            <section id="courses-list">
               <h1 align="center">Syallbus</h1>
               <p>Click the link below to download of syallbus of ELCE:</p>
               <a href="B.Tech_2nd_Yr_EEZ_V2.pdf" class="download-link"download>Download PDF</a>
               <p>Click the link below to syallbus of syallbus of Mathematics:</p>
               <a href="Mathematics-III_Mathematics_IV_Mathematics_V.pdf" class="download-link" download>Download PDF</a>
               <p>Click the link below to download syallbus of Python Programming:</p>
               <a href="B.Tech_Common_Course_BCC.pdf" class="download-link" download>Download PDF</a>
               <p>Click the link below to download syallbus of Techanical Communication:</p>
               <a href="Technical Communication_2023-2024.pdf" 
               class="download-link" download>Download PDF</a>
            </section>
        </section>
    </main>

    <footer>
        &copy; 2023 Student Management System
    </footer>
</body>

</html>