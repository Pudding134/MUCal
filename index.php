<?php
    include 'header.php';
?>
    <div class="container calendar-content">
    <div class="filter">
        <button class=" btn btn-primary px-5 region-title">Filter &#9660</button>
        <p>Selected: <span class="selected-regions"></span></p>
        <div class="region-filter">
            <ul class="region-list">
                <?php
                    $regions = $conn->query("SELECT region_name, color_code,region_status FROM region");

                    while ($row = $regions->fetch_assoc()) {
                        if ($row['region_status'] != 'inactive')
                        {
                            echo '<li class="region-item inactive" style="border: 2px solid '.$row['color_code'].'">'.$row['region_name'].'</li>';
                        }
                        else
                        {
                            isRegionOlderThanAYear($row['region_name'], $conn, $row['color_code'], $row['region_name']);
                        }
                    }
                    function isRegionOlderThanAYear($region_name, $conn, $colorCode, $regionName)
                    {
                        $regions = $conn->query("SELECT region_id FROM region WHERE region_name = '".$region_name."'");
                        $regionID ='';
                        while($row = $regions->fetch_assoc())
                        {
                            $regionID = $row['region_id']; 
                        }

                        $checkAge = $conn->query("SELECT curdate()-date_start as diff FROM event WHERE region_id = '".$region_name."' AND event_status !='inactive' ORDER BY date_start DESC LIMIT 1");
                        $age = '';
                        while($row = $checkAge->fetch_assoc())
                        {
                            $age = $row['diff']; 
                        }

                        if ($age <365 && $age !='' )
                        {
                            echo '<li class="region-item inactive" style="border: 2px solid '.$colorCode.'">'.$regionName.'</li>';
                        }

                    }
                ?> 
            </ul>
        </div>
        <div id='calendar'></div>
        <div class="expanded-view">
            <div class="expanded-details">
                <h1 class="event-heading"></h1>
                <p class="event-description"></p>
            </div>
        </div>
    </div>

<script>
    const regionItems = document.querySelectorAll('.region-item');
    regionItems.forEach(item => {
        item.addEventListener('click', function() {
            const colorCode = this.style.borderColor;
            item.classList.toggle('inactive');
            this.style.backgroundColor = colorCode;
        });
    });
</script>
<?php
include 'footer.php';
?>
