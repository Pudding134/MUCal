<?php
    session_start();
    include 'db_connection.php';

    //$username=$_POST['username']; //testing, using session user name instead, as user input in form is disabled
    $email=$_POST['email'];
    $current_password=$_POST['current_password'];
    $new_password=$_POST['new_password'];


    // Fetching existing data from the database
    $sql = "SELECT * FROM User WHERE UserName = ?";
    $sqlStatement = $conn->prepare($sql);
    $sqlStatement->bind_param('s', $_SESSION['username']);
    $sqlStatement->execute();
    $result = $sqlStatement->get_result();
    $user = $result->fetch_assoc();



    if (password_verify($current_password, $user['UserPassword'])) {

        if (!empty($new_password)) {
            // If the current password is correct, hashed the new password in preparation for updating the database
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            //update the user's email and password in the database
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

        //double check if update statement was successful
        if($sqlStatement->affected_rows === 0) {
            // No rows affected, there might be an error
            header("Location: user_setting.php?error=updateFailed");
            exit;
        } else {
            // Update successful
            header("Location: user_setting.php?success=updateSuccess");
            exit;
        }
    } else {
        // If the current password is incorrect, redirect back to the user settings page with an error
        header("Location: user_setting.php?error=incorrectPassword");
        exit;
    }
    

?>