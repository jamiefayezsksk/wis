<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>StudentRecord</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td:last-child {
            text-align: center;
        }

        form.inline {
            display: inline;
        }

        button {
            padding: 5px 10px;
            cursor: pointer;
        }

        button.edit {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        button.delete {
            background-color: #f44336;
            color: white;
            border: none;
        }
    </style>
    <script>
        function confirmDelete(id) {
            return confirm("Are you sure you want to delete this student?");
        }
    </script>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studentrecord";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Status: Connection failed: " . $conn->connect_error);
    }
    echo "Server Status: Connected successfully";
    ?>

    <hr>
    <h1>Add Student Record</h1>
    <table style="width:40%">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <tr>
                <td><label for="fname">First name:</label></td>
                <td><input type="text" name="studentFname" id="studentFname" value=""></td>
            </tr>
            <tr>
                <td><label for="fname">Last name:</label></td>
                <td><input type="text" name="studentLname" id="studentLname" value=""></td>
            </tr>
            <tr>
                <td><label for="fname">Date of Birth</label></td>
                <td><input type="text" name="studentDOB" id="studentDOB" value=""></td>
            </tr>
            <tr>
                <td><label for="fname">Email:</label></td>
                <td><input type="text" name="studentEmail" id="studentEmail" value=""></td>
            </tr>
            <tr>
                <td><label for="fname">Phone:</label></td>
                <td><input type="text" name="studentPhone" id="studentPhone" value=""></td>
            </tr>
            <tr>
                <td><label for="fname">Course:</label></td>
                <td>
                    <select id="course" name="course">
                        <option value="BSIT">BSIT</option>
                        <option value="BSCS">BSCS</option>
                        <option value="BSDA">BSDA</option>
                        <option value="BLIS">BLIS</option>
                        <option value="ACT">ACT</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="submit" name="submit"></td>
            </tr>
        </form>
    </table>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $studenfname = $_POST['studentFname'];
            $studentlname = $_POST['studentLname'];
            $studentDOB = $_POST['studentDOB'];
            $studentemail = $_POST['studentEmail'];
            $studentphone = (int)$_POST['studentPhone'];

            $studentsql = "INSERT INTO student (FirstName,LastName,DateOfBirth,Email,Phone) 
                                    VALUES(
                                    '$studenfname',
                                    '$studentlname',
                                    '$studentDOB',
                                    '$studentemail',
                                    $studentphone)";

            if (mysqli_query($conn, $studentsql)) {
                echo "New record created successfully";
            } else {
                echo "<br>Error: " . $studentsql . "<br>" . mysqli_error($conn);
            }
        } catch (PDOException $e) {
            echo $studentrecord . "<br>" . $e->getMessage();
        }
    }
    ?>

    <h1>Students Records</h1>
    <table>
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>

        <?php
        echo "<br><hr>";

        $sql = "SELECT * FROM student";
        $result = $conn->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["StudentID"] . "</td>
                        <td>" . $row["FirstName"] . "</td>
                        <td>" . $row["LastName"] . "</td>
                        <td>" . $row["DateOfBirth"] . "</td>
                        <td>" . $row["Email"] . "</td>
                        <td>" . $row["Phone"] . "</td>
                        <td>
                            <form action='edit_student.php' method='get' class='inline'>
                                <input type='hidden' name='id' value='" . $row["StudentID"] . "'>
                                <button type='submit' class='edit'>Edit</button>
                            </form>
                            <form action='delete_student.php' method='post' class='inline' onsubmit='return confirmDelete(" . $row["StudentID"] . ");'>
                                <input type='hidden' name='id' value='" . $row["StudentID"] . "'>
                                <button type='submit' class='delete'>Delete</button>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        ?>
    </table>

    <hr>
</body>

</html>
