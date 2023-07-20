<?php 
    
    if($isAdmin || $isFaculty)
    {
?>
        <div class="container add-calendar-event col-md-6">
            <h1 class="calendar-event-title">Add a calendar event</h1>  
            <form action="insert.php" method="post">
                <label for="eventTitle">Event Title</label>
                <input type="text" class="form-control" name="eventTitle" id="eventTitle" placeholder="Enter event title" required>
            <br>
                <label for="eventDescription">Event Description</label>
                <textarea class="form-control" id="eventDescription" name="eventDescription" placeholder="Enter event description" rows="3" maxlength="254"></textarea>
            <br>
                <label for="eventDate">Event Date</label>
                <input type="date" class="form-control"  name="eventDate" id="eventDate" placeholder="YYYY-MM-DD" required >
            <br>
                <label for="country">Country</label>
                    <select class="form-control" id="country" name="country" required>
                        <option value="">--Select Region--</option>
                        <?php
                            $regions = $conn->query("SELECT region_id FROM region WHERE region_status = 'active'");
                            while ($row = $regions->fetch_assoc()) {
                                echo '<option value="'.$row['region_id'].'">'.$row['region_id'].'</option>';
                            }
                        ?>
                    </select>
            <br>
                <button type="submit" class="btn btn-primary" id="eventSubmitButton" value="Submit">Submit</button>
            </form>
        </div>

    <script>
        var addEventSubmit = document.querySelector('.add-calendar-event #eventSubmitButton');
        var form = document.querySelector('.add-calendar-event form')
        form.addEventListener('submit', () => 
        {
            addEventSubmit.disabled = true;
        })

    </script>

    
<?php
    }
?>