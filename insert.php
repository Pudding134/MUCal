<?php
    session_start();
    include 'db_connection.php';

    $countryMap = [
        'Australia' => 'AU',
        'Singapore' => 'SG',
        'Dubai' => 'DB'
    ];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $title = $_POST["eventTitle"];
        $description = $_POST["eventDescription"];
        $date = $_POST["eventDate"];
        $country = $_POST["country"];
        $currentUser = $_SESSION["user_id"];

        $countryID = $countryMap[$country];
        $sql = "INSERT INTO event (event_name, date_start, description, region_id, amended_by_ref) 
        VALUES ('$title', '$date', '$description', '$countryID', $currentUser)";

        $sqlStatement = $conn->prepare($sql);

        if ($sqlStatement->execute()) {
            header("Location: after_insert.php");
        } else {
            echo "Error";
        }
        $conn->close();
    }
?>