<?php 
    include 'db_connection.php';
    include 'check-access-rights.php';
?>


<?php 

    $currentUrl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if($accessRights == '1' && (strpos($currentUrl, 'userManagement.php') !== false))
    {
       ?>
    <nav id="sidebarMenu" class="d-lg-block sidebar mt-1 ml-5">
        <div class="position-sticky">
            <div class="list-group  mx-3 mb-3 ">
            <a href="userManagement.php?page=accountCreate" 
                class="list-group-item list-group-item-action py-2 ripple">
               <span>Single User Creation</span>
            </a>
            <a href="userManagement.php?page=singleUserEdit" 
            class="list-group-item list-group-item-action py-2 ripple">
            <span>Single User Edit</span></a>
            <a href="userManagement.php?page=batchUserCreate"
                class="list-group-item list-group-item-action py-2 ripple">
                <span>Batch User Creation</span></a>
            <a href="userManagement.php?page=batchUserDelete" 
                class="list-group-item list-group-item-action py-2 ripple">
                <span>Batch User Delete</span>
            </a>
            </div>
        </div>
</nav>
    <?php
    }
    elseif($accessRights == '1' && (strpos($currentUrl, 'admin_panel.php') !== false))
    {
        ?>
            <nav id="sidebarMenu" class="d-lg-block sidebar mt-1 ml-5">
                <div class="position-sticky">
                    <div class="list-group  mx-3 mb-3 ">
                        <a href="admin_panel.php?page=addCalEvent" 
                            class="list-group-item list-group-item-action py-2 ripple">
                        <span>Add Calendar Event</span>
                        </a>
                        <a href="admin_panel.php?page=updateCalEvent" 
                            class="list-group-item list-group-item-action py-2 ripple">
                        <span>Update Calendar Events</span>
                        </a>
                        <a href="admin_panel.php?page=addBulkCalEvent" 
                            class="list-group-item list-group-item-action py-2 ripple">
                        <span>Bulk Upload Calendar Events</span>
                        </a>
                    </div>
                </div>
            </nav>
        <?php
    }
    else
    {
    ?>
        <div class="not-allowed">not allowed</div>
    <?php
    }
    ?>
