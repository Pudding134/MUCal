<?php
    session_start();
    include 'db_connection.php';

    $region_id = $_POST['region_id'];
    $region_name = $_POST['region_name'];
    $color_code = $_POST['color_code'];
    $region_status = $_POST['region_status'];

    $query = "UPDATE region SET region_name = ?, color_code = ?, region_status = ? WHERE region_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $region_name, $color_code, $region_status, $region_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Successfully updated region.";
        $_SESSION['msg_type'] = "success";
    }
    else{
        $_SESSION['message'] = "Error updating region.";
        $_SESSION['msg_type'] = "danger";
    }
    $conn->close();
    header('Location: admin_panel.php?page=updateRegion');
    exit();
?>
