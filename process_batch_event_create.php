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

        $event_name = $data[0];
        $date_start = $data[1];
        $description = $data[2];
        $region_id = $data[3];

        $stmt = $dbh->prepare("INSERT INTO event (event_name, date_start, description, region_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $event_name, $date_start, $description, $region_id);
        $stmt->execute();
    }

    fclose($handle);
    $stmt->close();
    $dbh->close();
    header('Location: admin_panel.php?page=addBulkCalEvent');// Redirect back to the upload page
    exit();

} catch (mysqli_sql_exception $e) {
    echo "Database Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "General Error: " . $e->getMessage();
}
?>
