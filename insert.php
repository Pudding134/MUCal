<?php
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

        $countryID = $countryMap[$country];
        $sql = "INSERT INTO events (EventName, DateStart, Description, RegionID) 
        VALUES ('$title', '$date', '$description', '$countryID')";

        $sqlStatement = $conn->prepare($sql);

        if ($sqlStatement->execute()) {
            header("Location: after_insert.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
?>