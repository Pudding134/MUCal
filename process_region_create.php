<?php
    session_start();
    include 'db_connection.php';

    $region_id = $_POST['region_id'];
    $region_name = $_POST['region_name'];
    $color_code = $_POST['color_code'];
    $region_status = $_POST['region_status'];

    if (!preg_match("/^[a-zA-Z]{2}$/", $region_id)) {
        $_SESSION['message'] = "Region ID must be exactly 2 Alphabet letters (Country Code).";
        $_SESSION['msg_type'] = "danger";
        header('Location: admin_panel.php?page=addRegion');
        exit;
    }

    $checkRegionSql = "SELECT * FROM region WHERE region_id = ? OR region_name = ?";
    $checkStmt = $conn->prepare($checkRegionSql);
    $checkStmt->bind_param('ss', $region_id, $region_name);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Region already exist.";
        $_SESSION['msg_type'] = "danger";
        header('Location: admin_panel.php?page=addRegion');
        exit;
    }


    $query = "INSERT INTO region (region_id, region_name, color_code, region_status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $region_id, $region_name, $color_code, $region_status);
    ;

    if ($stmt->execute()) {
        $_SESSION['message'] = "Successfully added region.";
        $_SESSION['msg_type'] = "success";
    }
    else{
        $_SESSION['message'] = "Error creating region.";
        $_SESSION['msg_type'] = "danger";
    }
    $conn->close();
    header('Location: admin_panel.php?page=addRegion');
    exit();

?>
