<?php 
  include 'header.php'; 
    if (isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
      $msg_type = $_SESSION['msg_type'];
      echo "<div class='alert alert-{$msg_type}'>{$message}</div>";
      unset($_SESSION['message']);
      unset($_SESSION['msg_type']);
  }
?>

<div class="user-management-container" style="min-height: 64svh;">
    <?php include 'sidebar.php' ?>

    <div class="container main-content">
    <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            $page_map = array(
                "addCalEvent" => "addCalEvent.php",
                "updateCalEvent" => "updateCalEvent.php",
                "update" => "update.php",
                "addBulkCalEvent" => "batch_entry_create.php",
                "addRegion" => "region_create.php",
                "updateRegion" => "region_update.php"
            );

            if (array_key_exists($page, $page_map) && file_exists($page_map[$page])) {
                include $page_map[$page];
            } else {
                header("Location: 404.php");
            }
        } else {
            echo '<h1>Welcome to Calendar Management</h1>';
            echo '<p>Select an option from the sidebar to get started.</p>';
        }
    ?>
    </div>
</div>
<?php include 'footer.php'; ?>
