<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <title>Setup</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Database Setup</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="student.php">StudentRecord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="courses.php">Course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="instructor.php">Instructor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="enrollment.php">Enrollment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="setup.php">Setup</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Database Setup</h1>

        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";

        $conn = new mysqli($servername, $username, $password);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . "<br>");
        }


        $sql = "CREATE DATABASE IF NOT EXISTS jaime";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully<br>";
        } else {
            echo "Error creating database: " . $conn->error . "<br>";
        }


        $conn->select_db("studentrecord");


        $sql = "CREATE TABLE IF NOT EXISTS student (
    StudentID MEDIUMINT NOT NULL AUTO_INCREMENT,
    FirstName varchar(50) NOT NULL,
    LastName varchar(50),
    DateOfBirth date,
    Email varchar(50),
    Phone INT(20),
    PRIMARY KEY(StudentID)
)";
        if ($conn->query($sql) === TRUE) {
            echo "Table student created successfully<br>";
        } else {
            echo "Error creating table: " . $conn->error . "<br>";
        }


        $sql = "CREATE TABLE IF NOT EXISTS course (
    CourseID MEDIUMINT NOT NULL AUTO_INCREMENT,
    CourseName varchar(100),
    Credits INT(255),
    PRIMARY KEY(CourseID)
)";
        if ($conn->query($sql) === TRUE) {
            echo "Table course created successfully<br>";
        } else {
            echo "Error creating table: " . $conn->error . "<br>";
        }


        $sql = "CREATE TABLE IF NOT EXISTS instructor (
    InstructorID MEDIUMINT NOT NULL AUTO_INCREMENT,
    FirstName varchar(50),
    LastName varchar(50),
    Email varchar(50),
    Phone INT(20),
    PRIMARY KEY(InstructorID)
)";
        if ($conn->query($sql) === TRUE) {
            echo "Table instructor created successfully<br>";
        } else {
            echo "Error creating table: " . $conn->error . "<br>";
        }


        $sql = "CREATE TABLE IF NOT EXISTS enrollment (
        EnrollmentID MEDIUMINT NOT NULL AUTO_INCREMENT,
        StudentID MEDIUMINT,
        FOREIGN KEY (StudentID) REFERENCES student(StudentID),
        CourseID MEDIUMINT,
        FOREIGN KEY (CourseID) REFERENCES course(CourseID),
        EnrollmentDate date,
        Grade INT,
        PRIMARY KEY(EnrollmentID)
        )";
        if ($conn->query($sql) === TRUE) {
            echo "Table enrollment created successfully<br>";
        } else {
            echo "Error creating table: " . $conn->error . "<br>";
        }


        $conn->close();

        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>