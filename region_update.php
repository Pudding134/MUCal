<?php 
    if($isAdmin)
    {
    ?>
        <div class="container user-setting col-md-6">
            <h1 class="user-setting-title">Update a region</h1>  
            <form action="process_region_update.php" method="post">
                <div>
                    <label for="region_id">Region ID</label><br>
                    <select id="region_id" class="form-control" name="region_id" required>
                        <option value="">--Select Region--</option>
                        <?php
                            $regions = $conn->query("SELECT region_id FROM region");
                            while ($row = $regions->fetch_assoc()) {
                                echo '<option value="'.$row['region_id'].'">'.$row['region_id'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <br>
                <div>
                    <label for="region_name">Region Name:</label>
                    <br>
                    <input type="text" class="form-control" id="region_name" name="region_name" placeholder="Region Full Name" required>
                </div>
                <br>
                <div>
                    <label for="color_code">Color Code:</label><br>
                    <input type="color" class="form-control" id="color_code" name="color_code" placeholder="Color of region event" required>
                </div>
                <br>
                <div>
                    <label for="region_status">Status:</label>
                    <br>
                    <select  class="form-control" id="region_status" name="region_status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary" value="Submit">Update</button>
            </form>
        </div>
        
        <script>
            // Select the fields
            var regionIdField = document.getElementById('region_id');
            var regionNameField = document.getElementById('region_name').parentElement;
            var colorCodeField = document.getElementById('color_code').parentElement;
            var regionStatusField = document.getElementById('region_status').parentElement;

            // Function to show or hide fields
            function toggleFields() {
                var display = regionIdField.value !== "" ? '' : 'none';
                regionNameField.style.display = display;
                colorCodeField.style.display = display;
                regionStatusField.style.display = display;
            }

            // Event listener for changes in the Region ID dropdown
            regionIdField.addEventListener('change', function() {
                var region_id = this.value;

                // Hide fields if Region ID is empty
                if (region_id === "") {
                    toggleFields();
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_region.php?region_id=' + region_id, true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        var region = JSON.parse(this.responseText);
                        document.getElementById('region_name').value = region.region_name;
                        document.getElementById('color_code').value = region.color_code;
                        document.getElementById('region_status').value = region.region_status;

                        // Show fields
                        toggleFields();
                    }
                }
                xhr.send();
            });

            // Hide fields on page load
            toggleFields();
        </script>

    <?php
    }
?>
