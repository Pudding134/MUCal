<?php
    session_start();
    include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST["eventName"];
    $eventDescription = $_POST["eventDescription"];
    $eventDate = $_POST["eventDate"];
    $eventRegion = $_POST["country"];
    $eventID = $_POST["eventID"];
    $eventStatus = $_POST["event-status"];

    $urlStartDate = $_POST["eventStartDate"];
    $urlEndDate = $_POST["eventEndDate"];
    $urlRegion = $_POST["selectedRegion"];

    $sql = "UPDATE event set event_name = '$eventName', description = '$eventDescription', date_start = '$eventDate', region_id = '$eventRegion', event_status = '$eventStatus' where event_id = '$eventID'";

    $sqlStatement = $conn->prepare($sql);

    if ($sqlStatement->execute()) {
        $_SESSION['message'] = "Successfully changed event details.";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "There was an error changing event details.";
        $_SESSION['msg_type'] = "danger";
    }
    $conn->close();
    header("Location: admin_panel.php?page=updateCalEvent&eventStartDate=$urlStartDate&eventEndDate=$urlEndDate&country=$urlRegion");
    exit();
}

?>