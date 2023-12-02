<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>EnrollmentRecord</title>
</head>
<body>
    <?php // Check if the query was successful
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studentrecord";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Status:  Connection failed: " . $conn->connect_error);
    }
    echo "Server Status: Connected successfully";
    ?>
    <hr>
    <h1>Enroll</h1>
    <table style="width:40%">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <tr><td><label for="fname">Select Student:</label></td>
            <td>
            <select id="student" name="student">
            <?php
                echo "<br><hr>";
                // Example query
                $sql = "SELECT * FROM student";
                $result = $conn->query($sql);

                // Check if the query was successful
                if ($result) {
                    // Process the results
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=" . $row["StudentID"] . ">".$row["FirstName"]."</option>";
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }?>
            </select>
            </td></tr>
            <tr><td><label for="fname">Select Course:</label></td>
            <td>
            <select id="course" name="course">
            <?php
                echo "<br><hr>";
                // Example query
                $sql = "SELECT * FROM course";
                $result = $conn->query($sql);

                // Check if the query was successful
                if ($result) {
                    // Process the results
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=" . $row["CourseID"] . ">".$row["CourseName"]."</option>";
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }?>
            </select>
            </td></tr>
            <tr><td><label for="fname">Enrollment Date:</label></td>
            <td><input type="date" id="datepicker" name="selectedDate"></td></tr>
            <tr><td><label for="fname">Grade:</label></td>
            <td><input type="number" id="integerInput" name="grade" required></td></tr>      
            <tr><td></td><td><input type="submit" value="submit" name="submit"></td></tr>
        </form>
    </table>
    
    <?php 

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        try{
            $student = $_POST['student'];
            $course = $_POST['course'];
            $enrolldate = $_POST['selectedDate'];
            $grade = (int)$_POST['grade'];
            $studentsql = "INSERT INTO enrollment (StudentID,CourseID,EnrollmentDate,Grade) 
                                    VALUES(
                                    '$student',
                                    '$course',
                                    '$enrolldate',
                                    '$grade')";
            //$studentrecord = $conn->exec($studentsql);
            //echo  gettype($studenfname);	

            if (mysqli_query($conn, $studentsql)) {
                echo "New record created successfully";
            } else {
                echo "<br>Error: " . $studentsql . "<br>" . mysqli_error($conn);
            }
        }catch(PDOException $e) {
            echo $studentrecord . "<br>" . $e->getMessage();
        }
        
        
    }?>
    <h1>Enrollment Records</h1>
    <table style="width:100%">
    <tr>
        <th>Enrollment ID</th>
        <th>Student ID</th>
        <th>Course ID</th>
        <th>Enrollment Date</th>
        <th>Grade</th>
    </tr>
    <?php
    echo "<br><hr>";
    // Example query
    $sql = "SELECT * FROM enrollment";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Process the results
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["EnrollmentID"] . "</td>"
            . "<td>" . $row["StudentID"]. "</td>"
            . "<td>" . $row["CourseID"]. "</td>"
            . "<td>" . $row["EnrollmentDate"]. "</td>"
            . "<td>" . $row["Grade"]. "</td>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }?>
    </table><hr>
</body>
</html>

