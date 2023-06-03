<?php 
include 'db_connection.php';

$sql = "SELECT eventid, eventname, description, datestart, regionid FROM events";
$result = $conn->query($sql);
$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $regionId = $row['regionid'];
        $colorCode = ''; 
        $regionSql = "SELECT colorcode FROM categories WHERE regionid = '$regionId'";
        $regionResult = $conn->query($regionSql);
        
        if ($regionResult->num_rows > 0) {
            $regionRow = $regionResult->fetch_assoc();
            $colorCode = $regionRow['colorcode'];
        }

        $start = date('Y-m-d', strtotime($row['datestart']));

        $events[] = array(
            'id' => $row['eventid'],
            'title' => $row['eventname'],
            'start' => $start,
            'color' => $colorCode,
            'extendedProps' => array(
                'description' => $row['description']
            )
        );
    }
}
$json = json_encode($events, JSON_PRETTY_PRINT);
$conn->close();
header('Content-Type: application/json');
echo $json;

?>