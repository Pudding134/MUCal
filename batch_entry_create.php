<?php 
  include 'check-access-rights.php';
?>


<?php 
    $currentUrl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if($accessRights == '1' && (strpos($currentUrl, 'userManagement.php') !== false))
    {
       ?>
        <div class="container user-setting col-md-6">
            <h1 class="user-setting-title">Batch User Creation (Via CSV)</h1>  
            <a href="/assets/user_creation_template.csv" download="User Creation Template.csv">Download CSV Template</a>
            <form action="process_batch_user_create.php" method="post" enctype="multipart/form-data">
              Select CSV file to upload:
              <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
              <br>
              <input type="submit" class="btn btn-primary" value="Upload CSV" name="submit">
            </form>
        </div>
<?php
    }
    elseif($accessRights == '1' && (strpos($currentUrl, 'admin_panel.php') !== false))
    {
        ?>
        <div class="container user-setting col-md-6">
            <h1 class="user-setting-title">Batch Event Creation (Via CSV)</h1>  
            <a href="/assets/event_creation_template.csv" download="Event Creation Template.csv">Download CSV Template</a>
            <form action="process_batch_event_create.php" method="post" enctype="multipart/form-data">
              Select CSV file to upload:
              <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
              <br>
              <input type="submit" class="btn btn-primary" value="Upload CSV" name="submit">
            </form>
        </div>
<?php
    }
    ?>