<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include your database connection file here
include 'db_connection.php';

$accessRights = 0; // assume 0 means no access

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare SQL statement
    $accessSql = "SELECT * FROM user WHERE username = ?";
    $accessStmt = $conn->prepare($accessSql);
    $accessStmt->bind_param('s', $username);
    $accessStmt->execute();
    $accessResult = $accessStmt->get_result();

    if ($accessResult->num_rows > 0) {
        $accessRow = $accessResult->fetch_assoc();
        $accessRights = (int)$accessRow['AccessRightsID'];
    }
}
?>
