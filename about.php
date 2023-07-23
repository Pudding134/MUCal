<?php
    include 'header.php';
?>

<style>
    .container.about-us-title
    {
        margin-bottom: 30px;
    }
    .container.about-us
    {
        display: grid;
        grid-template-columns: 1fr 1fr;
        border: 1px solid var(--secondary-color-cal);
        padding: 30px;
        margin-bottom: 25px;
    }
    .container .about
    {
        display: flex;
        column-gap: 20px;
        align-items: flex-end;
        margin-bottom: 25px;
    }

    .container .about .intro,
    .container .about ul
    {
        transition: all 1s;
        position: relative;
        transform: translateY(60px);
        opacity: 0;
    }

    .container .about.active .intro,
    .container .about.active ul
    {
        position: relative;
        transform: translateY(0);
        opacity: 1;
    }


    .container .about .intro >h3
    {
        text-align: center;
    }

    @media only screen and (max-width: 768px)
    {
        .container.about-us
        {
            display: grid;
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="container about-us-title">
    <h1>About Us</h1>
</div>

<div class="container about-us">
    <div class="about">
        <div class="intro">
            <h3>Bernard</h3>
            <img src="./assets/about/Bernard.png" alt="Bernard">
        </div>
        <ul>
            <li>Risk Management</li>
            <li>Procurement Management</li>
            <li>Infrastructure Design</li>
            <li>Promo Video</li>
        </ul>
    </div>

    <div class="about">
        <div class="intro">
            <h3>Jasmine</h3>
            <img src="./assets/about/Jasmine.png" alt="Jasmine">
        </div>
        <ul>
            <li>Project Scope Management</li>
            <li>Project Time Management</li>
            <li>Project Cost Management</li>
            <li>Use Case List</li>
            <li>Test Case</li>
        </ul>
    </div>

    <div class="about">
        <div class="intro">
            <h3>Sreehari</h3>
            <img src="./assets/about/Sreehari.png" alt="Sreehari">
        </div>
        <ul>
            <li>Project Integration Management</li>
            <li>Project Quality Management</li>
            <li>Interface Design</li>
            <li>Test Case</li>
        </ul>
    </div>

    <div class="about">
        <div class="intro">
            <h3>Tharuka</h3>
            <img src="./assets/about/Tharuka.png" alt="Tharuka">
        </div>
        <ul>
            <li>Software Design</li>
            <li>Software Developer</li>
            <li>Requirement Analysis</li>
            <li>Installation Guide</li>
            <li>Test Case List</li>
        </ul>
    </div>

    <div class="about">
        <div class="intro">
            <h3>Willie</h3>
            <img src="./assets/about/Willie.png" alt="Willie">
        </div>
        <ul>
            <li>Software Design</li>
            <li>Software Developer</li>
            <li>Requirement Analysis</li>
            <li>Data Design</li>
            <li>User Case List</li>
        </ul>
    </div>

    <div class="about">
        <div class="intro">
            <h3>ZhenLong</h3>
            <img src="./assets/about/ZhenLong.png" alt="ZhenLong">
        </div>
        <ul>
            <li>Diagram Representation</li>
            <li>Project Communication Management</li>
            <li>Project Human Resource Management</li>
            <li>Data Design</li>
            <li>Promo Video</li>
        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var aboutElements = document.querySelectorAll('.about-us .about');

    function addActiveWithDelay(elements, index) {
    if (index >= elements.length) {
        return; 
    }

    elements[index].classList.add('active');
    setTimeout(function() {
        addActiveWithDelay(elements, index + 1);
    }, 100 * (index + 1)); 
    }

    addActiveWithDelay(aboutElements, 0);
})
</script>
<?php
include 'footer.php';
?>
