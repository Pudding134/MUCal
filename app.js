// Dummy event data - you would fetch this from Google Calendar in a real application
var events = [
    { title: 'Event 1', date: '2023-05-19' },
    { title: 'Event 2', date: '2023-05-20' },
    //...
  ];
  
  document.getElementById("monthView").addEventListener("click", function() {
    displayEvents('month');
  });
  
  document.getElementById("weekView").addEventListener("click", function() {
    displayEvents('week');
  });
  
  document.getElementById("listView").addEventListener("click", function() {
    displayEvents('list');
  });
  
  function displayEvents(view) {
    var calendarDiv = document.getElementById('calendar');
    calendarDiv.innerHTML = ""; // Clear the calendar
  
    // This is a very simplistic example. In a real application, you would format and display
    // the events differently depending on the selected view.
    for (var i = 0; i < events.length; i++) {
      var eventDiv = document.createElement('div');
      eventDiv.textContent = events[i].title + ' (' + events[i].date + ') - ' + view + ' view';
      calendarDiv.appendChild(eventDiv);
    }
  }
  
  // Display the events in month view by default
  displayEvents('month');
  