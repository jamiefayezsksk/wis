<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Records</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
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
            // Example: header("Location: edit_instructor.php?id=$edit_id");
        } elseif (isset($_POST['delete'])) {
            // Handle delete logic
            $delete_id = $_POST['delete_id'];
            $delete_query = "DELETE FROM Instructor WHERE InstructorID = $delete_id";
            if ($conn->query($delete_query) === TRUE) {
                echo "Record deleted successfully.";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            // Handle add logic
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO Instructor (FirstName, LastName, Email, Phone) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstName, $lastName, $email, $phone);

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
    $sql = "SELECT * FROM Instructor";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        echo '<table border="1">';
        echo '<tr><th>Instructor ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Edit</th>
        <th>Delete</th></tr>';
        // Process the results
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['InstructorID'] . '</td>';
            echo '<td>' . $row['FirstName'] . '</td>';
            echo '<td>' . $row['LastName'] . '</td>';
            echo '<td>' . $row['Email'] . '</td>';
            echo '<td>' . $row['Phone'] . '</td>';
            echo '<td><form method="post" action=""><input type="hidden" name="edit_id" value="' . $row['InstructorID'] . '"><input type="submit" name="edit" value="Edit"></form></td>';
            echo '<td><form method="post" action=""><input type="hidden" name="delete_id" value="' . $row['InstructorID'] . '"><input type="submit" name="delete" value="Delete"></form></td>';
            echo '</tr>';
        }
        echo '</table>';

        // Add data form
        echo '<form method="post" action="">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required>
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="phone">Phone:</label>
        <input type="tel" name="phone" required>
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