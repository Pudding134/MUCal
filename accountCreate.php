
<?php 
    include 'check-access-rights.php';

    if($accessRights == '1')
    {
       ?>
          <div class="container user-setting col-md-6">
            <h1 class="user-setting-title">Create a user</h1>  
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
       <?php
    }
    else
    {
        ?>
        <div class="now-allowed">not allowed</div>
        <?php
    }
?>
