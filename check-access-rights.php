<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db_connection.php';

$accessRights = 0; 

if (isset($_SESSION['user_name'])) {
    $username = $_SESSION['user_name'];

    $accessSql = "SELECT * FROM user WHERE user_name = ?";
    $accessStmt = $conn->prepare($accessSql);
    $accessStmt->bind_param('s', $username);
    $accessStmt->execute();
    $accessResult = $accessStmt->get_result();

    if ($accessResult->num_rows > 0) {
        $accessRow = $accessResult->fetch_assoc();
        $accessRights = (int)$accessRow['access_right_id'];
    }
    
    $isAdmin = checkIfUserIsAdmin($accessRights);
    $isFaculty = checkIfUserIsFaculty($accessRights);
}
else
{
    $isAdmin = false;
    $isFaculty = false;
}


function checkIfUserIsAdmin($accessRightID)
{
    include 'db_connection.php';

    if(getAccessName($conn, $accessRightID) == "Administrator")
    {
        return true;
    }
    
    return false;
}

function checkIfUserIsFaculty($accessRightID)
{
    include 'db_connection.php';

    if(getAccessName($conn, $accessRightID) == "Faculty")
    {
        return true;
    }
    
    return false;
}

function getAccessName($conn, $accessRightID )
{
    $accessNameSql = "SELECT access_name FROM user_right WHERE access_right_id = $accessRightID";
    $accessNameSqlQuery= $conn->prepare($accessNameSql);
    $accessNameSqlQuery->execute();
    $accessNameSqlResult = $accessNameSqlQuery->get_result();
    $accessNameSqlRow = $accessNameSqlResult->fetch_assoc();
    $accessRight = $accessNameSqlRow['access_name'];

    return $accessRight;
}
?>
