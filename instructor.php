<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>InstructorRecord</title>
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
    <h1>Add Instructor Record</h1>
    <table style="width:40%">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <tr><td><label for="fname">First name:</label></td>
            <td><input type="text" name="insfname" id="insfname" value=""></td></tr>
            <tr><td><label for="fname">Last name:</label></td>
            <td><input type="text" name="inslname" id="inslname" value=""></td></tr>
            <tr><td><label for="fname">Email:</label></td>
            <td><input type="text" name="insemail" id="insemail" value=""></td></tr>
            <tr><td><label for="fname">Phone:</label></td>
            <td><input type="text" name="insphone" id="insphone" value=""></td></tr> 
            <tr><td></td><td><input type="submit" value="submit" name="submit"></td></tr>
        </form>
    </table>
    <?php 

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        try{
            $studenfname = $_POST['insfname'];
            $studentlname = $_POST['inslname'];
            $studentemail = $_POST['insemail'];
            $studentphone = (int)$_POST['insphone'];
            $studentsql = "INSERT INTO instructor (FirstName,LastName,Email,Phone) 
                                    VALUES(
                                    '$studenfname',
                                    '$studentlname',
                                    '$studentemail',
                                    $studentphone)";
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
    <h1>Instructor Records</h1>
    <table style="width:100%">
    <tr>
        <th>Instructor ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
    <?php
    echo "<br><hr>";
    // Example query
    $sql = "SELECT * FROM instructor";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Process the results
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["InstructorID"] . "</td>"
            . "<td>" . $row["FirstName"]. "</td>"
            . "<td>" . $row["LastName"]. "</td>"
            . "<td>" . $row["Email"]. "</td>"
            . "<td>" . $row["Phone"]. "</td></tr>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }?>
    </table><hr>
</body>
</html>

