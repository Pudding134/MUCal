<?php
    include 'header.php';

    // Fetching existing data from the database
    $sql = "SELECT * FROM User WHERE UserName = ?";
    $sqlStatement = $conn->prepare($sql);
    $sqlStatement->bind_param('s', $_SESSION['username']);
    $sqlStatement->execute();
    $result = $sqlStatement->get_result();
    $user = $result->fetch_assoc();
?>

<link rel="stylesheet" href="assets/login.css">



<body class="login_page">
    <div class="login_content">
        <div class="login-box">
            <h2>User Settings</h2>
            <form action="process_user_setting.php" method="post">
                <div class="user-box">
                    <label for="username">User Name</label>
                    <input type="text" id="username" name="username" value="<?php echo $user['UserName']; ?>" readonly>
                </div>
                <div class="user-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['UserEmail']; ?>" required>
                </div>
                <div class="user-box">
                    <label for="password">Current Password</label>
                    <input type="password" id="password" name="current_password" required>
                </div>
                <div class="user-box">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">
                Update
                </button>
            </form>
            <button onclick="location.href='index.php'" class="back-btn">Back</button>
        </div>
    </div>
    <script>
        var urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has('error')) {
            alert('Update Failed. Please check your credentials and try again.');
        } else if(urlParams.has('success')) {
            alert('Account update successful!');
        }
    </script>


</body>

<?php include 'footer.php'; ?>





<?php include 'footer.php'; ?>