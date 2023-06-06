<?php
    session_start();
    include 'db_connection.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $accessRights = $_POST['access-right'];
        $newPassword = $_POST['password'];
        $oldUsername = $_POST['old_username'];
        $oldEmail = $_POST['old_email'];

        $sql = "UPDATE User SET UserName = ?, UserEmail = ?, AccessRightsID = ? WHERE UserName = ? AND UserEmail = ?";

        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE User SET UserName = ?, UserEmail = ?, AccessRightsID = ?, UserPassword = ? WHERE UserName = ? AND UserEmail = ?";
        }

        $sqlStatement = $conn->prepare($sql);

        if (!empty($newPassword)) {
            $sqlStatement->bind_param('ssisss', $username, $email, $accessRights, $hashedPassword, $oldUsername, $oldEmail);
        } else {
            $sqlStatement->bind_param('ssiss', $username, $email, $accessRights, $oldUsername, $oldEmail);
        }

        if ($sqlStatement->execute()) {
            $_SESSION['message'] = "Successfully changed User details.";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "There was an error changing user details.";
            $_SESSION['msg_type'] = "danger";
        }
        $conn->close();
        header('Location: userManagement.php?page=singleUserEdit');
        exit();
    }
?>
