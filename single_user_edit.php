<?php
    include 'fetch_user.php';
?>



<div class="container user-setting col-md-6">
    <h1 class="user-setting-title">Search for User to edit</h1>  
        <form action="userManagement.php" method="get">
            <input type="hidden" name="page" value="singleUserEdit">
            <label for="search_username">Username</label>
            <input type="text" class="form-control" name="search_username" id="search_username" placeholder="Search by username">
            <br>
            <label for="search_email">Email</label>
            <input type="email" class="form-control" name="search_email" id="search_email" placeholder="Search by email">
            <br>
            <button type="submit" class="btn btn-primary" value="Search">Search</button>
        </form>
    <br><br>


    <?php 
    if ($user) {
        $accessRightsMap = [
            1 => 'admin',
            2 => 'faculty',
            3 => 'student'
        ];
    ?>
        <form action="process_admin_user_change.php" method="post">
            <input type="hidden" name="old_username" value="<?php echo $user['UserName']; ?>">
            <input type="hidden" name="old_email" value="<?php echo $user['UserEmail']; ?>">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="<?php echo $user['UserName']; ?>" required >
            <br>
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['UserEmail']; ?>" required>
            <br>
            <label for="access-right">User Access Rights</label>
            <select class="form-control" id="access-right" name="access-right" required>
            <?php
                foreach($accessRightsMap as $id => $right) {
                    $selected = ($id == $user['AccessRightsID']) ? 'selected' : '';
                    echo "<option value='{$id}' {$selected}>{$right}</option>";
                }
            ?>
             </select>
            <br>
            <label for="password">New Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <br>
            <button type="submit" class="btn btn-primary" value="Submit">Update</button>
        </form>
    <?php 
    } else if (isset($_GET['search_username']) || isset($_GET['search_email'])) {
        echo "<p>No user found with that username or email.</p>";
    }
    ?>
</div>
