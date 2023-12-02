<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link rel="stylesheet" type="text/css" href="connect_styles.css">
    <style>
        .section {
            display: none;
        }

        .section.active {
            display: block;
        }
    </style>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "StudentRecord";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>

    <header>
        <h1>Student Records</h1>
        <nav>
            <ul>
                <li><a href="#student" onclick="showSection('student')">Student</a></li>
                <li><a href="#courses" onclick="showSection('courses')">Courses</a></li>
                <li><a href="#instructor" onclick="showSection('instructor')">Instructor</a></li>
                <li><a href="#enrollment" onclick="showSection('enrollment')">Enrollment</a></li>
            </ul>
        </nav>
    </header>

    <div class="content">
        <div id="student" class="section active">
            <h2>STUDENT</h2>
            <?php include 'student.php'; ?>
        </div>

        <div id="courses" class="section">
            <h2>COURSE</h2>
            <?php include 'courses.php'; ?>
        </div>

        <div id="instructor" class="section">
            <h2>INSTRUCTOR</h2>
            <?php include 'instructor.php'; ?>
        </div>

        <div id="enrollment" class="section">
            <h2>ENROLLMENT</h2>
            <?php include 'enrollment.php'; ?>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            var sections = document.getElementsByClassName('section');
            for (var i = 0; i < sections.length; i++) {
                sections[i].classList.remove('active');
            }

            // Show the selected section
            document.getElementById(sectionId).classList.add('active');
        }
    </script>
</body>

</html>
