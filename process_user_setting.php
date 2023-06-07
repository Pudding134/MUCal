<?php
    session_start();
    include 'db_connection.php';

    $email=$_POST['email'];
    $current_password=$_POST['current_password'];
    $new_password=$_POST['new_password'];

    $sql = "SELECT * FROM user WHERE user_name = ?";
    $sqlStatement = $conn->prepare($sql);
    $sqlStatement->bind_param('s', $_SESSION['user_name']);
    $sqlStatement->execute();
    $result = $sqlStatement->get_result();
    $user = $result->fetch_assoc();


    if (password_verify($current_password, $user['user_password'])) {

        if (!empty($new_password)) {
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET user_email = ?, user_password = ? WHERE user_name = ?";
            $sqlStatement = $conn->prepare($sql);
            $sqlStatement->bind_param('sss', $email, $new_password_hashed, $_SESSION['user_name']);
            $sqlStatement->execute();
        }
        else{
            $sql = "UPDATE user SET user_email = ? WHERE user_name = ?";
            $sqlStatement = $conn->prepare($sql);
            $sqlStatement->bind_param('ss', $email, $_SESSION['user_name']);
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