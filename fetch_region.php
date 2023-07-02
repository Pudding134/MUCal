<?php
    include 'db_connection.php';
    $region_id = $_GET['region_id'];

    $stmt = $conn->prepare("SELECT * FROM region WHERE region_id = ?");
    $stmt->bind_param("s", $region_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $region = $result->fetch_assoc();

    echo json_encode($region); // Output region details in JSON format
?>
