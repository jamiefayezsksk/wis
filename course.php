<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Course Records</title>
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
            if (isset($_POST['edit'])) {
                // Handle edit logic
                $edit_id = $_POST['edit_id'];
                // Redirect to edit page or perform edit action
                // Example: header("Location: edit_course.php?id=$edit_id");
            } elseif (isset($_POST['delete'])) {
                // Handle delete logic
                $delete_id = $_POST['delete_id'];
                $delete_query = "DELETE FROM Course WHERE CourseID = $delete_id";
                if ($conn->query($delete_query) === TRUE) {
                    echo "Record deleted successfully.";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                // Handle add logic
                $courseName = $_POST['courseName'];
                $credits = $_POST['credits'];

                // Use prepared statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO Course (CourseName, Credits) VALUES (?, ?)");
                $stmt->bind_param("si", $courseName, $credits);

                if ($stmt->execute()) {
                    echo "Data added successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close statement
                $stmt->close();
            }
        }

        // Fetch data
        $sql = "SELECT * FROM Course";
        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result) {
            echo '<table border="1">';
            echo '<tr><th>Course ID</th>
        <th>Course Name</th>
        <th>Credits</th>
        <th>Edit</th>
        <th>Delete</th></tr>';
            // Process the results
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['CourseID'] . '</td>';
                echo '<td>' . $row['CourseName'] . '</td>';
                echo '<td>' . $row['Credits'] . '</td>';
                echo '<td><form method="post" action=""><input type="hidden" name="edit_id" value="' . $row['CourseID'] . '"><input type="submit" name="edit" value="Edit"></form></td>';
                echo '<td><form method="post" action=""><input type="hidden" name="delete_id" value="' . $row['CourseID'] . '"><input type="submit" name="delete" value="Delete"></form></td>';
                echo '</tr>';
            }
            echo '</table>';

            // Add data form
            echo '<form method="post" action="">
        <label for="courseName">Course Name:</label>
        <input type="text" name="courseName" required>
        <label for="credits">Credits:</label>
        <input type="number" name="credits" required>
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

</body>

</html>