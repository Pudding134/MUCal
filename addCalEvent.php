<?php 
    include 'check-access-rights.php';
    
    if($accessRights == '1')
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
                        <option>Australia</option>
                        <option>Singapore</option>
                        <option>Dubai</option>
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
        <div class="not-allowed">not allowed</div>
<?php
    }
?>