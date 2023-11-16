<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection code (similar to what you have in db_connection.php)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "users";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $role = $_POST["role"];

    // Insert user data into the database
    $sql = "INSERT INTO users (fullname, email, username, password, role) VALUES ('$fullname', '$email', '$username', '$password','$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System - Signup</title>
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
        <section id="signup">
            <h2>Signup</h2>
            <form action="signup.php" method="post">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

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

                <button type="submit">Signup</button>
            </form>
            <p align ="center">Already have an account? Click here:-<a href="login.php">Login now</a></p>
        </section>
    </main>

    <footer>
        &copy; 2023 Student Management System
    </footer>
</body>

</html>