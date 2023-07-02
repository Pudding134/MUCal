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
                    $regions = $conn->query("SELECT region_name, color_code FROM region");
                    while ($row = $regions->fetch_assoc()) {
                        echo '<li class="region-item inactive" style="border: 2px solid '.$row['color_code'].'">'.$row['region_name'].'</li>';
                    }
                ?> 
            </ul>
        </div>
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
