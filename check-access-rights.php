<?php 
$accessRights = ''; 
   
    if (isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];
        $accessSql = "SELECT * FROM user WHERE username = '$username'";
        $accessResult = $conn->query($accessSql);
        
        if ($accessResult->num_rows > 0) {
            $accessRow = $accessResult->fetch_assoc();
            $accessRights = strval($accessRow['AccessRightsID']);
        }
    }
?>