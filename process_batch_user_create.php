<?php
try {
    if ($_FILES['fileToUpload']['error'] > 0) { 
        throw new Exception('File upload failed. Error Code: ' . $_FILES['fileToUpload']['error']);
    }

    $dbh = new mysqli('localhost', 'root', '', 'MUCal');
    
    if ($dbh->connect_error) {
        throw new Exception("Connection failed: " . $dbh->connect_error);
    }

    $file = $_FILES['fileToUpload']['tmp_name']; // Get temporary name of the uploaded file
    $handle = fopen($file, 'r');

    $row = 0; // Initialize row counter
    while (($data = fgetcsv($handle)) !== FALSE) {
        $row++; // Increment row counter
        if ($row === 1) { // Skip the first row
            continue;
        }

        $user_name = $data[0];
        $user_password = password_hash($data[1], PASSWORD_DEFAULT); // Hash the password before storing
        $user_email = $data[2];
        $access_right_id = $data[3];
        $account_status = $data[4];

        $stmt = $dbh->prepare("INSERT INTO user (user_name, user_password, user_email, access_right_id, account_status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $user_name, $user_password, $user_email, $access_right_id, $account_status);
        $stmt->execute();
    }

    fclose($handle);
    $stmt->close();
    $dbh->close();

    header('Location: userManagement.php?page=batchUserCreate');// Redirect back to the upload page
    exit();

} catch (mysqli_sql_exception $e) {
    echo "Database Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "General Error: " . $e->getMessage();
}
?>
