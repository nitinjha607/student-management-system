<?php
session_start();

// Function to update grades
function updateGrades($conn, $name, $subject, $semester, $st1, $st2, $st3, $ue)
{
    // Check if the record already exists
    $checkSql = "SELECT * FROM grades WHERE name='$name' AND subject='$subject' AND semester='$semester'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // Record exists, update the marks
        $updateSql = "UPDATE grades SET st1=$st1, st2=$st2, st3=$st3, ue=$ue WHERE name='$name' AND subject='$subject' AND semester='$semester'";
        
        if ($conn->query($updateSql) === TRUE) {
            echo "Grades updated successfully.";
        } else {
            echo "Error updating grades: " . $conn->error;
        }
    } else {
        echo "Record not found. You can only update existing records.";
    }
}

if (!isset($_SESSION["username"])) {
    // User is not logged in; redirect to the login page
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $name = $_POST["name"];
    $subject = $_POST["subject"];
    $semester = $_POST["semester"];
    $st1 = $_POST["st1"];
    $st2 = $_POST["st2"];
    $st3 = $_POST["st3"];
    $ue = $_POST["ue"];
    
    // Add database connection code here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "grade"; 

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user wants to update grades
    if (isset($_POST['updateGrades'])) {
        // Call the updateGrades function
        updateGrades($conn, $name, $subject, $semester, $st1, $st2, $st3, $ue);
    } else {
        // Insert data into the grades table
        $sql = "INSERT INTO grades (name, subject, semester, st1, st2, st3, ue)
                VALUES ('$name','$subject', '$semester', $st1, $st2, $st3, $ue)";

        if ($conn->query($sql) === TRUE) {
            echo "Grades inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student Management System - Insert/Update Grades</title>
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
            <h2>Insert Student Grades</h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="name">Student Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>

                <label for="semester">Semester:</label>
                <input type="text" id="semester" name="semester" required>

                <label for="st1">ST-1:</label>
                <input type="number" id="st1" name="st1" required>

                <label for="st2">ST-2:</label>
                <input type="number" id="st2" name="st2" required>

                <label for="st3">ST-3:</label>
                <input type="number" id="st3" name="st3" required>

                <label for="ue">University exam:</label>
                <input type="number" id="ue" name="ue" required>

                <button type="submit">Insert Grades</button>
            </form>
        </section>
        <br>    
        <section id="attendance-update">
            <h2>Update Student Grades</h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <label for="updateName">Student Name:</label>
                <input type="text" id="updateName" name="name" required>

                <label for="updateSubject">Subject:</label>
                <input type="text" id="updateSubject" name="subject" required>

                <label for="updateSemester">Semester:</label>
                <input type="text" id="updateSemester" name="semester" required>

                <label for="updateSt1">ST-1:</label>
                <input type="number" id="updateSt1" name="st1" required>

                <label for="updateSt2">ST-2:</label>
                <input type="number" id="updateSt2" name="st2" required>

                <label for="updateSt3">ST-3:</label>
                <input type="number" id="updateSt3" name="st3" required>

                <label for="updateUE">University exam:</label>
                <input type="number" id="updateUE" name="ue" required>

                <button type="submit" name="updateGrades">Update Grades</button>
            </form>
        </section>
    </main>

    <footer>
        &copy; 2023 Student Management System
    </footer>
</body>

</html>
