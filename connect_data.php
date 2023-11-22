<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 200px;
            background-color: #f1f1f1;
            padding: 20px;
            position: fixed;
            height: 100%;
            overflow: auto;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #000;
            border-bottom: 1px solid #ccc;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        .section {
            max-width: 600px;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
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

    <div class="sidebar">
        <h2>Sidebar Menu</h2>
        <ul>
            <li><a href="#student">Student</a></li>
            <li><a href="#course">Course</a></li>
            <li><a href="#instructor">Instructor</a></li>
            <li><a href="#enrollment">Enrollment</a></li>
        </ul>
    </div>

    <div class="content">
        <div id="student" class="section">
            <h2>STUDENT</h2>
            <?php include 'student.php'; ?>
        </div>

        <div id="course" class="section">
            <h2>COURSE</h2>
            <?php include 'course.php'; ?>
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

</body>

</html>