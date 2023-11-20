<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    // Check if form is submitted for adding data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentID = $_POST['studentID'];
        $courseID = $_POST['courseID'];
        $enrollmentDate = $_POST['enrollmentDate'];
        $grade = $_POST['grade'];

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO Enrollment (StudentID, CourseID, EnrollmentDate, Grade) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $studentID, $courseID, $enrollmentDate, $grade);

        if ($stmt->execute()) {
            echo "Data added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Fetch data
    $sql = "SELECT * FROM Enrollment";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        echo '<table border="1">';
        echo '<tr><th>Enrollment ID</th>
        <th>Student ID</th>
        <th>Course ID</th>
        <th>Enrollment Date</th>
        <th>Grade</th></tr>';
        // Process the results
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['EnrollmentID'] . '</td>';
            echo '<td>' . $row['StudentID'] . '</td>';
            echo '<td>' . $row['CourseID'] . '</td>';
            echo '<td>' . $row['EnrollmentDate'] . '</td>';
            echo '<td>' . $row['Grade'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';

        // Add data form
        echo '<form method="post" action="">
        <label for="studentID">Student ID:</label>
        <input type="text" name="studentID" required>
        <label for="courseID">Course ID:</label>
        <input type="text" name="courseID" required>
        <label for="enrollmentDate">Enrollment Date:</label>
        <input type="date" name="enrollmentDate" required>
        <label for="grade">Grade:</label>
        <input type="text" name="grade" required>
        <input type="submit" value="Add Data">
    </form>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
    ?>
</body>

</html>