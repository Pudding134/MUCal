<?php
    include 'header.php';

    $sql = "SELECT * FROM User WHERE UserName = ?";
    $sqlStatement = $conn->prepare($sql);
    $sqlStatement->bind_param('s', $_SESSION['username']);
    $sqlStatement->execute();
    $result = $sqlStatement->get_result();
    $user = $result->fetch_assoc();
?>
    <div class="container login-box col-md-3">
            <h1 class="login-box-title">User Settings</h1>  
            <form action="process_user_setting.php" method="post">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $user['UserName']; ?>"  disabled>
            <br>
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['UserEmail']; ?>" required>
            <br>
                <label for="password">Current Password</label>
                <input type="password" class="form-control" id="password" name="current_password" required>
            <br>
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            <br>
                <button type="submit" class="btn btn-primary" value="Submit">Update</button>
            </form>
    </div>

    <script>
        var urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has('error')) {
            alert('Update Failed. Please check your credentials and try again.');
        } else if(urlParams.has('success')) {
            alert('Account update successful!');
        }
    </script>



<?php include 'footer.php'; ?>