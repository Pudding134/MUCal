<?php
    session_start();
    include 'db_connection.php';
    include 'check-access-rights.php';
    include 'header.php';
?>

<?php 
    if($accessRights == '1')
    {
       ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Account Creation Page</title>
            <link rel="stylesheet" href="assets/login.css">
        </head>
        <body class="account_create">
          <div class="account_content">
            <div class="login-box">
              <h2>User Creation</h2>
              <form action="process_account_creation.php" method="post">
                <div class="user-box">
                    <input type="text" name="username" required placeholder="User Name">
                </div>
                <div class="user-box">
                    <input type="password" name="password" required placeholder="Password">
                </div>
                <div class="user-box">
                    <input type="email" name="email" required placeholder="User Email">
                </div>
                <div class="user-box">
                    <select name="access-right" required>
                        <option value="">User Access Right</option>
                        <option value="admin">Administrator</option>
                        <option value="faculty">Faculty</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <button type="submit">
                  Submit
                </button>
              </form>
              <button onclick="location.href='index.php'" class="back-btn">Back</button>
            </div>
    </div>

            <script>
              var urlParams = new URLSearchParams(window.location.search);
              if(urlParams.has('error')) {
                if(urlParams.get('error') === 'userexists') {
                  alert('Username or email already exists!');
                } else if(urlParams.get('error') === 'dberror') {
                  alert('There was a problem with the database. Please try again.');
                }
              } else if(urlParams.has('success')) {
                if(urlParams.get('success') === 'accountcreated') {
                  alert('Account created successfully!');
                }
              }
            </script>
          </body>
        </html>
       <?php
    }
    else
    {
        ?>
        <div class="b">not allowed</div>
        <?php
    }
?>
