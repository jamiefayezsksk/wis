<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Enrollment Records</title>
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

    // Check if form is submitted for adding or updating data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['delete'])) {
            // Handle delete logic
            $delete_id = $_POST['delete_id'];
            $delete_query = "DELETE FROM Enrollment WHERE EnrollmentID = $delete_id";
            if ($conn->query($delete_query) === TRUE) {
                echo "Record deleted successfully.";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } elseif (isset($_POST['edit'])) {
            // Handle edit logic
            $edit_id = $_POST['edit_id'];
            $edit_query = "SELECT * FROM Enrollment WHERE EnrollmentID = $edit_id";
            $edit_result = $conn->query($edit_query);

            if ($edit_result && $edit_result->num_rows > 0) {
                $edit_row = $edit_result->fetch_assoc();
                $edit_studentID = $edit_row['StudentID'];
                $edit_courseID = $edit_row['CourseID'];
                $edit_enrollmentDate = $edit_row['EnrollmentDate'];
                $edit_grade = $edit_row['Grade'];
            }
        } else {
            // Handle add logic
            $studentID = $_POST['studentID'];
            $courseID = $_POST['courseID'];
            $enrollmentDate = $_POST['enrollmentDate'];
            $grade = $_POST['grade'];

            if (!empty($_POST['edit_id'])) {
                // Update existing record
                $edit_id = $_POST['edit_id'];
                $update_query = "UPDATE Enrollment SET StudentID = $studentID, CourseID = $courseID, EnrollmentDate = '$enrollmentDate', Grade = '$grade' WHERE EnrollmentID = $edit_id";
                if ($conn->query($update_query) === TRUE) {
                    echo "Record updated successfully.";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                // Insert new record
                $insert_query = "INSERT INTO Enrollment (StudentID, CourseID, EnrollmentDate, Grade) VALUES ($studentID, $courseID, '$enrollmentDate', '$grade')";
                if ($conn->query($insert_query) === TRUE) {
                    echo "Data added successfully.";
                } else {
                    echo "Error: " . $insert_query . "<br>" . $conn->error;
                }
            }
        }
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
        <th>Grade</th>
        <th>Edit</th>
        <th>Delete</th></tr>';
        // Process the results
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['EnrollmentID'] . '</td>';
            echo '<td>' . $row['StudentID'] . '</td>';
            echo '<td>' . $row['CourseID'] . '</td>';
            echo '<td>' . $row['EnrollmentDate'] . '</td>';
            echo '<td>' . $row['Grade'] . '</td>';
            echo '<td><form method="post" action=""><input type="hidden" name="edit_id" value="' . $row['EnrollmentID'] . '"><input type="submit" name="edit" value="Edit"></form></td>';
            echo '<td><form method="post" action=""><input type="hidden" name="delete_id" value="' . $row['EnrollmentID'] . '"><input type="submit" name="delete" value="Delete"></form></td>';
            echo '</tr>';
        }
        echo '</table>';

        // Add data form
        echo '<form method="post" action="">
        <label for="studentID">Student ID:</label>
        <input type="text" name="studentID" value="' . (isset($edit_studentID) ? $edit_studentID : '') . '" required>
        <label for="courseID">Course ID:</label>
        <input type="text" name="courseID" value="' . (isset($edit_courseID) ? $edit_courseID : '') . '" required>
        <label for="enrollmentDate">Enrollment Date:</label>
        <input type="date" name="enrollmentDate" value="' . (isset($edit_enrollmentDate) ? $edit_enrollmentDate : '') . '" required>
        <label for="grade">Grade:</label>
        <input type="text" name="grade" value="' . (isset($edit_grade) ? $edit_grade : '') . '" required>
        <input type="hidden" name="edit_id" value="' . (isset($edit_id) ? $edit_id : '') . '">
        <input type="submit" value="' . (isset($edit_id) ? 'Update' : 'Add Data') . '">
    </form>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
    ?>
</body>

</html>