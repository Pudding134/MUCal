<?php
    $user = null;
    if (isset($_GET['search_username']) || isset($_GET['search_email'])) {
        $searchUsername = isset($_GET['search_username']) ? $_GET['search_username'] : '';
        $searchEmail = isset($_GET['search_email']) ? $_GET['search_email'] : '';

        $sql = "SELECT * FROM User WHERE UserName = ? OR UserEmail = ?";
        $sqlStatement = $conn->prepare($sql);
        $sqlStatement->bind_param('ss', $searchUsername, $searchEmail);
        $sqlStatement->execute();
        $result = $sqlStatement->get_result();
        $user = $result->fetch_assoc();
    }
?>