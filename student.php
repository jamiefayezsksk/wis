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
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO Student (FirstName, LastName, DateOfBirth, Email, Phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $dateOfBirth, $email, $phone);

    if ($stmt->execute()) {
        echo "Data added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Fetch data
$sql = "SELECT * FROM Student";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    echo '<table border="1">';
    echo '<tr><th>ID Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Birth Date</th>
        <th>E-mail</th>
        <th>Contact Number</th></tr>';
    // Process the results
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['StudentID'] . '</td>';
        echo '<td>' . $row['FirstName'] . '</td>';
        echo '<td>' . $row['LastName'] . '</td>';
        echo '<td>' . $row['DateOfBirth'] . '</td>';
        echo '<td>' . $row['Email'] . '</td>';
        echo '<td>' . $row['Phone'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

    // Add data form
    echo '<form method="post" action="">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required>
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required>
        <label for="dateOfBirth">Birth Date:</label>
        <input type="date" name="dateOfBirth" required>
        <label for="email">E-mail:</label>
        <input type="email" name="email" required>
        <label for="phone">Contact Number:</label>
        <input type="tel" name="phone" required>
        <input type="submit" value="Add Data">
    </form>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>