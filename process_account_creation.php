<?php
    session_start();
    include 'db_connection.php';


    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $accessRight = $_POST['access-right'];

    $accessRightsMap = [
        'admin' => 1,
        'faculty' => 2,
        'student' => 3
    ];
    $accessRightId = $accessRightsMap[$accessRight];


    $checkUserSql = "SELECT * FROM user WHERE UserName = ? OR UserEmail = ?";
    $checkStmt = $conn->prepare($checkUserSql);
    $checkStmt->bind_param('ss', $username, $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        header('Location: accountCreate.php?error=userexists');
        exit;
    }


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (UserName, UserPassword, UserEmail, AccessRightsID) 
            VALUES (?, ?, ?, ?)";

    $sqlStatement = $conn->prepare($sql);

    $sqlStatement->bind_param('sssi', $username, $hashedPassword, $email, $accessRightId);

    if ($sqlStatement->execute()) {
        $_SESSION['message'] = "User successfully created.";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "There was an error creating the user.";
        $_SESSION['msg_type'] = "danger";
    }

    $conn->close();
    header("Location: userManagement.php?page=accountCreate");
    exit();
?>
