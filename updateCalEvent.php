<?php 
    include 'check-access-rights.php';
    
    if($accessRights == '1')
    {
?>
        <div class="container add-calendar-event col-md-6">
            <h1 class="calendar-event-title">Update a calendar event</h1>

            <form action="admin_panel.php?page=update" method="post">
            <h4 class="calendar-event-title">Filter</h4>
            <div class="col-md-12" style="display: flex; column-gap: 15px;">
                <div class="form-group">
                    <label for="eventStartDate">Start Date</label>
                    <input type="date" class="form-control"  name="eventStartDate" id="eventStartDate" placeholder="YYYY-MM-DD" required >    
                </div>
                <div class="form-group">
                    <label for="eventEndDate">End Date</label>
                    <input type="date" class="form-control"  name="eventEndDate" id="eventEndDate" placeholder="YYYY-MM-DD" required >  
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" id="country" name="country" required>
                        <option>All</option>
                        <option>Australia</option>
                        <option>Singapore</option>
                        <option>Dubai</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" value="Submit">Find</button>
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