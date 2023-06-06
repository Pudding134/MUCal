<?php
    session_start();
    include 'db_connection.php';

    $email=$_POST['email'];
    $current_password=$_POST['current_password'];
    $new_password=$_POST['new_password'];

    $sql = "SELECT * FROM User WHERE UserName = ?";
    $sqlStatement = $conn->prepare($sql);
    $sqlStatement->bind_param('s', $_SESSION['username']);
    $sqlStatement->execute();
    $result = $sqlStatement->get_result();
    $user = $result->fetch_assoc();


    if (password_verify($current_password, $user['UserPassword'])) {

        if (!empty($new_password)) {
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE User SET UserEmail = ?, UserPassword = ? WHERE UserName = ?";
            $sqlStatement = $conn->prepare($sql);
            $sqlStatement->bind_param('sss', $email, $new_password_hashed, $_SESSION['username']);
            $sqlStatement->execute();
        }
        else{
            $sql = "UPDATE User SET UserEmail = ? WHERE UserName = ?";
            $sqlStatement = $conn->prepare($sql);
            $sqlStatement->bind_param('ss', $email, $_SESSION['username']);
            $sqlStatement->execute();
        }

        if($sqlStatement->affected_rows === 0) {
            $_SESSION['message'] = "There was an error updating user setting.";
            $_SESSION['msg_type'] = "danger";
        } else {
            $_SESSION['message'] = "User Setting Updated.";
            $_SESSION['msg_type'] = "success";
        }
    } else {
        $_SESSION['message'] = "Wrong User Password.";
        $_SESSION['msg_type'] = "danger";
    }
    $conn->close();
    header('Location: user_setting.php');
    exit();
    

?>