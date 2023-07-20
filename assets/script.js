let darkMode = localStorage.getItem('darkMode');
var currentCalendar = '';


const darkModeToggle = document.querySelector('.theme-toggle');
const enableDarkMode = () => {
    document.body.classList.add('dark-theme');
    document.querySelector(".navbar").classList.add('navbar-dark');
    document.querySelector(".navbar").classList.add('bg-dark');
    document.querySelector(".footer").classList.add('navbar-dark');
    document.querySelector(".footer").classList.add('bg-dark');

    localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
    document.body.classList.remove('dark-theme');
    document.querySelector(".navbar").classList.remove('navbar-dark');
    document.querySelector(".navbar").classList.remove('bg-dark');
    document.querySelector(".footer").classList.remove('navbar-dark');
    document.querySelector(".footer").classList.remove('bg-dark');
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
        initialView: 'dayGridMonth',
        editable: false,
        events: 'load.php',
        eventClick: function(info) {
            window.scrollTo(0, 160);
            document.querySelector(".event-heading").innerHTML = info.event.title + " : " + info.event.extendedProps.country;
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
    currentCalendar = calendar;

    windowResize(currentCalendar);
    calendar.setOption('timeZone', 'local'); 

    var regionTitle = document.querySelector('.region-title');
    var regionFilter = document.querySelector('.region-filter');
    var selectedRegions = document.querySelector('.selected-regions');

    regionTitle.addEventListener('click', function()
    {
        regionFilter.classList.toggle('active');
        if (regionFilter.classList.contains("active"))
        {
            regionTitle.innerHTML = "Filter &#9650"
        }
        else
        {
            regionTitle.innerHTML = "Filter &#9660";
        }
    });
    
    var regionItem = document.querySelectorAll('.region-item');

    regionItem.forEach(item => {
        item.addEventListener('click', () => {
            item.classList.toggle('active');
            selectedRegions.innerHTML = "";
            var activeRegions = [];
            
            regionItem.forEach(i => {
                if (i.classList.contains('active'))
                {
                    selectedRegions.innerHTML +=  i.innerHTML + " ";
                    activeRegions.push(i.innerHTML);
                    
                }
            });
            
            var jsonArray = JSON.stringify(activeRegions);
            var url = 'load.php';
            
            if (activeRegions.length === 0) {
                url = 'load.php'
            } else {
                url += '?param='+jsonArray;
            }
            
            var dateUserWasIn = currentCalendar.getDate();
            console.log(dateUserWasIn);
            reRenderCalendar(url, dateUserWasIn);

        });
    });

    function reRenderCalendar(url, dateUserWasIn)
    {
        currentCalendar.destroy();
        var initialTimeZone = 'UTC';
        var calendarEl = document.getElementById('calendar');
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: initialTimeZone,
            initialView: 'dayGridMonth',
            editable: false,
            events: url,
            eventClick: function(info) {
                window.scrollTo(0, 180);
                document.querySelector(".event-heading").innerHTML = info.event.title + " : " + info.event.extendedProps.country;
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

        
        if (window.innerWidth < 768)
        {
            calendar.changeView('listMonth');    
        }
        else
        {
            calendar.changeView('listMonth');
            calendar.changeView('dayGridMonth');
        }
        calendar.setOption('timeZone', 'local');
        calendar.gotoDate(dateUserWasIn);
        
        currentCalendar = calendar;
        windowResize(currentCalendar);
    }
});

function windowResize(calendar)
{
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
            calendar.changeView('listMonth');
            calendar.changeView('dayGridMonth');
        }

    }
}