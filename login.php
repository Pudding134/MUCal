<?php
    include 'header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login Page</title>
    <link rel="stylesheet" href="assets/login.css">
    
</head>
<body class="login_page">
  <div class="login_content">
      <div class="login-box">
        <h2>User Login</h2>
        <form action="process_login.php" method="post">
          <div class="user-box">
            <input type="text" name="username" required placeholder="User Name">
          </div>
          <div class="user-box">
            <input type="password" name="password" required placeholder="Password">
          </div>

          <button type="submit">Submit</button>
        </form>
        <button onclick="location.href='index.php'" class="back-btn">Back</button>
      </div>
  </div>
    
    <script>
      var urlParams = new URLSearchParams(window.location.search);
      if(urlParams.has('error')) {
        if(urlParams.get('error') === 'loginFailed') {
          alert('Login Failed. Please check your credentials and try again.');
          }
        } else if(urlParams.has('success')) {
        if(urlParams.get('success') === 'loginSuccess') {
          alert('Login successfully!');
          window.location.href = 'index.php';
        }
      }
    </script>

  </body>
  
</html>