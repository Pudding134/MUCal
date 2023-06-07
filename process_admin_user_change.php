<?php
    session_start();
    include 'db_connection.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $accessRights = $_POST['access-right'];
        $newPassword = $_POST['password'];
        $accountStatus = $_POST['account-status'];
        $oldUsername = $_POST['old_username'];
        $oldEmail = $_POST['old_email'];

        $sql = "UPDATE user SET user_name = ?, user_email = ?, access_right_id = ?, account_status = ?, amended_by_ref = ? WHERE user_name = ? AND user_email = ?";

        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET user_name = ?, user_email = ?, access_right_id = ?, user_password = ?, account_status = ?, amended_by_ref = ? WHERE user_name = ? AND user_email = ?";
        }

        $sqlStatement = $conn->prepare($sql);
        $userAmendedByRef = $_SESSION['user_id'];


        if (!empty($newPassword)) {
            $sqlStatement->bind_param('ssississ', $username, $email, $accessRights, $hashedPassword, $accountStatus, $userAmendedByRef, $oldUsername, $oldEmail);
        } else {
            $sqlStatement->bind_param('ssisiss', $username, $email, $accessRights, $accountStatus, $userAmendedByRef, $oldUsername, $oldEmail);
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
