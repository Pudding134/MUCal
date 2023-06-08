<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=MUCal', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        $stmt->execute([$user_name, $user_password, $user_email, $access_right_id, $account_status]);
    }
    fclose($handle);

    echo "Batch creation of accounts successful!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
