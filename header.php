<?php
    session_start();

    include 'db_connection.php';
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MuCal</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="assets/styles.css">
    
</head>
<body>
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a href="https://www.murdoch.edu.au/currentstudents#menu" class="navbar-brand">
                <img src="assets/university_logo.png" alt="">
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-label="Expand Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="" class="nav-link">About</a></li>
                    <?php
                     if($accessRights == '1')
                     {
                        echo '<li class="nav-item"><a href="admin_panel.php" class="nav-link">Admin Panel</a></li>';
                        echo '<li class="nav-item"><a href="accountCreate.php" class="nav-link">Create Account</a></li>';
                     }
                    ?>
                    <?php
                        if(isset($_SESSION['username'])) {
                            echo '<li class="nav-item"><a href="user_setting.php" class="nav-link">User Setting (' . $_SESSION['username'] . ')</a></li>';

                            echo '<li class="nav-item"><a href="logout.php" class="nav-link">Logout (' . $_SESSION['username'] . ')</a></li>';
                        } else {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container theme-switcher">
        <button class="theme-toggle">Switch Theme</button>
    </div>