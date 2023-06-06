<?php 
    include 'db_connection.php';
    include 'check-access-rights.php';
?>


<?php 
    if($accessRights == '1')
    {
       ?>
        <aside class="sidebar">
        <ul>
            <li><a href="userManagement.php?page=accountCreate">Single User Creation</a></li>
            <li><a href="userManagement.php?page=batchUserCreate">Batch User Creation</a></li>
            <li><a href="userManagement.php?page=singleUserEdit">Single User Edit</a></li>
            <li><a href="userManagement.php?page=singleUserDelete">Single User Delete</a></li>
            <li><a href="userManagement.php?page=batchUserDelete">Batch User Delete</a></li>
        </ul>

</aside>

    <?php
    }
    else
    {
    ?>
        <div class="not-allowed">not allowed</div>
    <?php
    }
    ?>

