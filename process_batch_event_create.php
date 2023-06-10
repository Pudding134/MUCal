<?php
    session_start();
    include 'db_connection.php';

try {
    if ($_FILES['fileToUpload']['error'] > 0) { 
        throw new Exception('File upload failed. Error Code: ' . $_FILES['fileToUpload']['error']);
    }

    $file = $_FILES['fileToUpload']['tmp_name']; // Get temporary name of the uploaded file
    $handle = fopen($file, 'r');

    $row = 0; // Initialize row counter
    while (($data = fgetcsv($handle)) !== FALSE) {
        $row++; // Increment row counter
        if ($row === 1) { // Skip the first row
            continue;
        }

        // Validate and format the date
        if (!is_numeric($data[1]) || strlen($data[1]) != 4 || 
        !is_numeric($data[2]) || (strlen($data[2]) != 1 && strlen($data[2]) != 2) || 
        !is_numeric($data[3]) || strlen($data[3]) != 2) {
            throw new Exception("Invalid date format. Date should be in YYYY-MM-DD format.");
        }
        // If the month is a single digit, add a leading zero
        $month = (strlen($data[2]) == 1) ? '0' . $data[2] : $data[2];

        $event_name = $data[0];
        $date_start = $data[1] . '-' . $data[2] . '-' . $data[3];
        $description = $data[4];
        $region_id = $data[5];
        $currentUser = $_SESSION["user_id"];

        $stmt = $conn->prepare("INSERT INTO event (event_name, date_start, description, region_id, amended_by_ref) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $event_name, $date_start, $description, $region_id, $currentUser);
        $stmt->execute();
    }

    fclose($handle);
    $stmt->close();
    $conn->close();

    $_SESSION['message'] = "Successfully added event details.";
    $_SESSION['msg_type'] = "success";

    header('Location: admin_panel.php?page=addBulkCalEvent');// Redirect back to the upload page
    exit();

} catch (mysqli_sql_exception $e) {
    echo "Database Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "General Error: " . $e->getMessage();
}
?>
