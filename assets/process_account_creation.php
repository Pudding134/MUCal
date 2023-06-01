<?php
// Include your database connection file here
include 'db_connection.php';

// Get data from the form
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$accessRight = $_POST['access-right'];

// Map the access right to the appropriate AccessRightsID
$accessRightsMap = [
    'admin' => 1,
    'faculty' => 2,
    'student' => 3
];

$accessRightId = $accessRightsMap[$accessRight];

// Perform password hashing
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the data into the database
$sql = "INSERT INTO User (UserName, UserPassword, UserEmail, AccessRightsID) 
        VALUES (?, ?, ?, ?)";

//prepare SQL statement, help prevent SQL injection attacks
$stmt = $conn->prepare($sql);

//bind parameters with variables (SSSI = string, string, string, integer)
$stmt->bind_param('sssi', $username, $hashedPassword, $email, $accessRightId);

//check if the statement was successful, if not, display error
if ($stmt->execute()) {
    echo "New account created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
