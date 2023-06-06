<?php
    session_start();
    include 'db_connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['toDelete_username'];
        $email = $_POST['toDelete_email'];

        $sql = "DELETE FROM User WHERE UserName = ? AND UserEmail = ?";
        $sqlStatement = $conn->prepare($sql);
        $sqlStatement->bind_param('ss', $username, $email);
        
        if ($sqlStatement->execute()) {
            $_SESSION['message'] = "User successfully deleted.";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "There was an error deleting the user.";
            $_SESSION['msg_type'] = "danger";
        }
        $conn->close();
        header('Location: userManagement.php?page=singleUserDelete');
        exit();
    }
?>