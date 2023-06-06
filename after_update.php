<?php
    session_start();
    include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST["eventName"];
    $eventDescription = $_POST["eventDescription"];
    $eventDate = $_POST["eventDate"];
    $eventRegion = $_POST["country"];
    $eventID = $_POST["eventID"];

    $sql = "UPDATE events set EventName = '$eventName', description = '$eventDescription', DateStart = '$eventDate',
    regionid = $eventRegion where EventID = '$eventID'";

    $sqlStatement = $conn->prepare($sql);

    if ($sqlStatement->execute()) {
        $_SESSION['message'] = "Successfully changed event details.";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "There was an error changing event details.";
        $_SESSION['msg_type'] = "danger";
    }
    $conn->close();
    header('Location: admin_panel.php?page=updateCalEvent');
    exit();
}

?>