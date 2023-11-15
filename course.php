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
// echo "Connected successfully";



$sql = "SELECT * FROM Course";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    echo '<table>';
    echo '<tr><th>Course ID</th>
    <th>Course Name</th>
    <th>Credits</th></tr>';
    echo '<tr><td colspan="6"><hr></td></tr>'; // Separation line
    // Process the results
    while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['CourseID'] . '</td>';
    echo '<td>' . $row['CourseName'] . '</td>';
    echo '<td>' . $row['Credits'] . '</td>';

    echo '</tr>';
    echo '<tr><td colspan="6" style="border-bottom: 1px dotted #000;"></td></tr>'; // Add a dotted line after each row
    }
    echo '</table>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




?>




