<?php
    session_start();

    include 'db_connection.php';
    include 'check-access-rights.php';
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
    <div class="height-control">
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img src="assets/university_logo.png" alt="">
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-label="Expand Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav">
                    <?php
                     if($accessRights == '1')
                     {
                        echo '<li class="nav-item"><a href="admin_panel.php" class="nav-link">Admin Panel</a></li>';
                        echo '<li class="nav-item"><a href="userManagement.php" class="nav-link">User Management</a></li>';
                     }
                    ?>
                    <?php
                        if(isset($_SESSION['username'])) {
                            echo '<li class="nav-item"><a href="user_setting.php" class="nav-link">Account Settings</li>';
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
        <button class="theme-toggle">
            Switch Theme
            <i class="button-svg"></i>
        </button>
    </div>