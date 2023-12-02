<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>CourseRecord</title>
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
    <h1>Add Course</h1>
    <table style="width:40%">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <tr><td><label for="fname">Course Name:</label></td>
            <td><input type="text" name="coursename" id="coursename" value=""></td></tr>
            <tr><td><label for="fname">Credits:</label></td> 
            <td><input type="text" name="coursecredits" id="coursecredits" value=""></td></tr>
            <tr><td></td><td><input type="submit" value="Add Course" name="submit"></td></tr>
        </form>
    </table>


    <h1>Course Records</h1>
    <?php 

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        try{
            $coursename = $_POST['coursename'];
            $coursecredit = (int)$_POST['coursecredits'];
            $studentsql = "INSERT INTO course (CourseName,Credits) 
                                    VALUES(
                                    '$coursename',
                                    '$coursecredit')";
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
    <table style="width:100%">
        <tr>
            <th>CourseID</th>
            <th>CourseName</th>
            <th>Credits</th>
        </tr>
        <?php
        echo "<br><hr>";
        // Example query
        $sql = "SELECT * FROM course";
        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result) {
            // Process the results
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["CourseID"] . "</td>"
                . "<td>" . $row["CourseName"]. "</td>"
                . "<td>" . $row["Credits"]. "</td></tr>";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }?>
        </table><hr>
</body>
</html>