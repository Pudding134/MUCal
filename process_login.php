<?php
//start a session
session_start();

// Include your database connection file here
include 'db_connection.php';

// Get data from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare SQL statement
$sql = "SELECT * FROM User WHERE UserName = ?";
$sqlStatement = $conn->prepare($sql);
$sqlStatement->bind_param('s', $username);
$sqlStatement->execute();
$result = $sqlStatement->get_result();
$user = $result->fetch_assoc();

//verify password
if($user && password_verify($password, $user['UserPassword'])) {
    
    //set session variables
    $_SESSION['username'] = $username;
    $_SESSION['accessRightsId'] = $user['AccessRightsID'];

    header("Location: login.php?success=loginSuccess");
    exit();
} else {
    header("Location: login.php?error=loginFailed");
    exit();
}

$conn->close();
?>