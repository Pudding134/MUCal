<?php
include 'header.php';
?>
    <div class="container">
        <h1>Event Added Successfully!</h1>
        <br>
        <button class="admin-back btn btn-primary">Back to Admin Panel</button>
    </div>

    <script>
        const adminPanel = document.querySelector('.admin-back');
        adminPanel.addEventListener('click', () => {
            window.location.href = "admin_panel.php";
        })
    </script>

<?php 
include 'footer.php';
?>
