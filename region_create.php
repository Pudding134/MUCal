
<?php 

    if($isAdmin)
    {
       ?>
          <div class="container user-setting col-md-6">
            <h1 class="user-setting-title">Create a new region</h1>  
            <form action="process_region_create.php" method="post"> 
                <label for="region_id">Region ID</label><br>
                <input type="text" class="form-control" id="region_id" name="region_id" placeholder="Region ID (2 letters) e.g. AU" required>
            <br>
                <label for="region_name">Region Name:</label>
            <br>
                <input type="text" class="form-control" id="region_name" name="region_name" placeholder="Region Full Name" required>
            <br>
                <label for="color_code">Color Code:</label><br>
                <input type="color" class="form-control" id="color_code" name="color_code" placeholder="Color of region event" required>
            <br>
                <label for="region_status">Status:</label>
            <br>
                <select  class="form-control" id="region_status" name="region_status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <br><br>
                <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
            </form>
        </div>
       <?php
    }
?>
