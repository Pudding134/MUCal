<?php
    include 'header.php';
?>
  
  <div class="container login-box user-login col-md-3">
            <form action="process_login.php" method="post">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
            <br>
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <br>
                <button type="submit" class="btn btn-primary" value="Submit">Login</button>
            </form>
    </div>

    <script>
      var urlParams = new URLSearchParams(window.location.search);
      if(urlParams.has('error')) 
      {
        if(urlParams.get('error') === 'loginFailed') 
        {
          alert('Login Failed. Please check your credentials and try again.');
        }
        if(urlParams.get('error') === 'deactivated') 
        {
          alert('Your account has been deactivated, please contact your administrator');
        }
      } 
      else if(urlParams.has('success')) 
      {
        if(urlParams.get('success') === 'loginSuccess') 
        {
          window.location.href = 'index.php';
        }
      }
    </script>

<?php
include 'footer.php';
?>