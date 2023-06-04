<?php
    include 'header.php';
?>

<?php 
    if($accessRights == '1')
    {
       ?>
          <div class="container login-box col-md-3">
            <h1 class="login-box-title">Create a user</h1>  
            <form action="process_account_creation.php" method="post">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
            <br>
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <br>
                <label for="email">Email</label>
                <input type="email" class="form-control"  name="email" id="email" placeholder="Email" required >
            <br>
                <label for="access-right">User Access Rights</label>
                    <select class="form-control" id="access-right" name="access-right" required>
                        <option value="admin">Administrator</option>
                        <option value="faculty">Faculty</option>
                        <option value="student">Student</option>
                    </select>
            <br>
                <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
            </form>
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
       <?php
    }
    else
    {
        ?>
        <div class="b">not allowed</div>
        <?php
    }

   include 'footer.php'
?>
