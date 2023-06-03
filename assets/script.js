let darkMode = localStorage.getItem('darkMode');

const darkModeToggle = document.querySelector('.theme-toggle');
const enableDarkMode = () => {
    document.body.classList.add('dark-theme');
    document.querySelector(".navbar").classList.add('navbar-dark');
    document.querySelector(".navbar").classList.add('bg-dark');

    localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
    document.body.classList.remove('dark-theme');
    document.querySelector(".navbar").classList.remove('navbar-dark');
    document.querySelector(".navbar").classList.remove('bg-dark');

    localStorage.setItem('darkMode', null);
}

if(darkMode === 'enabled')
{
    enableDarkMode();
}
else
{
    disableDarkMode();
}

darkModeToggle.addEventListener('click', () => {
    darkMode = localStorage.getItem('darkMode');
    if(darkMode !== 'enabled')
    {
        enableDarkMode();
    }
    else
    {
        disableDarkMode();
    }
})


document.addEventListener('DOMContentLoaded', function() {
    var initialTimeZone = 'UTC';
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: initialTimeZone,
        initialView: 'dayGridMonth', //multiMonthYear
        editable: false,
        events: 'load.php',
        eventClick: function(info) {
            document.querySelector(".event-heading").innerHTML = info.event.title;
            if (info.event.extendedProps.description === 'undefined')
            {
                document.querySelector(".event-description").innerHTML = ''
            }
            else
            {
                document.querySelector(".event-description").innerHTML = info.event.extendedProps.description;
            }
            document.querySelector(".expanded-view").style.border = '1px solid var(--secondary-color-cal)'
        }
        
        });
        
        calendar.render();
        calendar.setOption('timeZone', 'local');
        
        window.addEventListener('resize', function()
        {
            if (window.innerWidth < 768)
            {
            calendar.changeView('listMonth');    
            }
            else
            {
            calendar.changeView('dayGridMonth');
            }
        })

        window.onload = function()
        {
            if (window.innerWidth < 768)
            {
            calendar.changeView('listMonth');    
            }
            else
            {
            calendar.changeView('dayGridMonth');
            }

        }
});