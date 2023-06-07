<?php
session_start();
include 'db_connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE UserName = ?";
$sqlStatement = $conn->prepare($sql);
$sqlStatement->bind_param('s', $username);
$sqlStatement->execute();
$result = $sqlStatement->get_result();
$user = $result->fetch_assoc();

if($user && password_verify($password, $user['UserPassword'])) {
    $_SESSION['username'] = $username;
    $_SESSION['accessRightsId'] = $user['AccessRightsID'];
    $_SESSION['userid'] = $user['UserID'];

    header("Location: login.php?success=loginSuccess");
    exit();
} else {
    header("Location: login.php?error=loginFailed");
    exit();
}

$conn->close();
?>