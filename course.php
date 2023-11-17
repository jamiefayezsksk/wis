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

// Fetch data
$sql = "SELECT * FROM Course";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    echo '<table border="1">';
    echo '<tr><th>Course ID</th>
        <th>Course Name</th>
        <th>Credits</th></tr>';
    // Process the results
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['CourseID'] . '</td>';
        echo '<td>' . $row['CourseName'] . '</td>';
        echo '<td>' . $row['Credits'] . '</td>';
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