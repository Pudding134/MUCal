<div class="container user-setting col-md-6">
    <h1 class="user-setting-title">Batch User Creation (Via CSV)</h1>  
    <a href="/assets/user_creation_template.csv" download="user_creation_template.csv">Download CSV Template</a>
    <form action="process_batch_user_create.php" method="post" enctype="multipart/form-data">
      Select CSV file to upload:
      <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
      <br>
      <input type="submit" class="btn btn-primary" value="Upload CSV" name="submit">
    </form>

</div>