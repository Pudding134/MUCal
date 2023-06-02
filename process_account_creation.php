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


// Check if the username or email already exists
$checkUserSql = "SELECT * FROM User WHERE UserName = ? OR UserEmail = ?";
$checkStmt = $conn->prepare($checkUserSql);
$checkStmt->bind_param('ss', $username, $email);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    // Username or email exists, redirect back to account creation page with error
    header('Location: accountCreate.html?error=userexists');
    exit;
}


// Perform password hashing
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert the data into the database
$sql = "INSERT INTO User (UserName, UserPassword, UserEmail, AccessRightsID) 
        VALUES (?, ?, ?, ?)";

//prepare SQL statement, help prevent SQL injection attacks
$sqlStatement = $conn->prepare($sql);

//bind parameters with variables (SSSI = string, string, string, integer)
$sqlStatement->bind_param('sssi', $username, $hashedPassword, $email, $accessRightId);

//check if the statement was successful, if not, display error
if ($sqlStatement->execute()) {
    header("Location: accountCreate.html?success=accountcreated");
    exit();
} else {
    header("Location: accountCreate.html?error=dberror");
    exit();
}

$conn->close();
?>
