<?php
session_start();

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
    <title>Student Management System - Insert Student Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="style4.css">
</head>

<body>
    <header>
        <h1>Student Management System</h1>
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
            <h2 align="center">Insert Student Profile</h2>
            <form action="process_insert_profile.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="roll_number">Univ Roll-no.:</label>
                <input type="text" id="roll_number" name="roll_number" required>

                <label for="admission_number">Admission no.:</label>
                <input type="text" id="admission_number" name="admission_number" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">

                <label for="course">Course:</label>
                <input type="text" id="course" name="course" required>

                <label for="year">Year:</label>
                <input type="text" id="year" name="year" required>

                <label for="semester">Semester:</label>
                <input type="text" id="semester" name="semester" required>

                <label for="branch">Branch:</label>
                <input type="text" id="branch" name="branch" required>

                <label for="image">Image Path:</label>
                <input type="text" id="image" name="image" required>

                <button type="submit">Insert Profile</button>
            </form>
        </section>
    </main>

    <footer>
        &copy; 2023 Student Management System
    </footer>
</body>

</html>
