<?php 
include 'db_connection.php';

$sql = "SELECT event_id, event_name, description, date_start, region_id FROM event where event_status = 'active'";
$result = $conn->query($sql);
$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $regionId = $row['region_id'];
        $colorCode = ''; 
        $regionSql = "SELECT color_code, region_name FROM region WHERE region_id = '$regionId'";
        $regionResult = $conn->query($regionSql);
        
        if ($regionResult->num_rows > 0) {
            $regionRow = $regionResult->fetch_assoc();
            $colorCode = $regionRow['color_code'];
            $regionName = $regionRow['region_name'];
        }

        $start = date('Y-m-d', strtotime($row['date_start']));

        $events[] = array(
            'id' => $row['event_id'],
            'title' => $row['event_name'],
            'start' => $start,
            'color' => $colorCode,
            'extendedProps' => array(
                'description' => $row['description'],
                'country' => $regionName,
            )
        );
    }
}
$json = json_encode($events, JSON_PRETTY_PRINT);
$conn->close();
header('Content-Type: application/json');
echo $json;

?>