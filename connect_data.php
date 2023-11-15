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
echo "STUDENT";
include 'student.php';
echo "COURSE";
include 'course.php';
echo "INSTRUCTOR";
include 'instructor.php';
echo "ENROLLMENT";
include 'enrollment.php';



?>