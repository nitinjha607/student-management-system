<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection code (similar to what you have in db_connection.php)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "users";

    $conn = new mysqli($servername, $db_username, $db_password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Check the role and redirect accordingly
            if ($row["role"] === "student") {
                $_SESSION["username"] = $username;
                header("Location: home.php"); // Redirect to the student's home page
                exit();
            } elseif ($row["role"] === "teacher") {
                $_SESSION["username"] = $username;
                header("Location: attendanceupdate.php"); // Redirect to the teacher's attendance update page
                exit();
            } else {
                echo "Invalid role";
            }
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System - Login</title>
    <link rel="stylesheet" type="text/css" href="style4.css">
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
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Signup</a></li>
        </ul>
    </nav>

    <main>
        <section id="login">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <label>
                    <input type="radio" name="role" value="student" required>
                    Student
                </label>
                <label>
                    <input type="radio" name="role" value="teacher" required>
                    Teacher
                </label>

                <button type="submit">Login</button>
            </form>
            <p align ="center">Don't have an account? Click here:-<a href="signup.php">Sign up now</a></p>
        </section>
    </main>

    <footer>
        &copy; 2023 Student Management System
    </footer>
</body>
</html>