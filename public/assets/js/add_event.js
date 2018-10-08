// Handles ajax and post when submit button is clicked in the event form and to load events

$(function() {
    var oldDate = -1;
    var oldEvent = false;
    
    //Loads events when a date in the calendar is activated and prints them under the calendar.
    $('.calendar-day').on('click', function(event) {
       
        var date = event.target.dataset.date;
        var description = $(event.currentTarget).find("input").val();
        var title = $(event.currentTarget).find("param").val();
        
        //if admin is current logged in the date field should be filled in
        if(document.getElementById("event-date") != null)
            document.getElementById("event-date").value = date;
        
        //highlight activated date and let go of last activted date
        document.getElementById(date).style.backgroundColor = "blue";
        if(oldDate != -1)
            document.getElementById(oldDate).style.backgroundColor = "white";
        
        //if last activted date was an event day it should remain green
        if(oldEvent == true) {
            document.getElementById(oldDate).style.backgroundColor = "#8bc172";
            oldEvent = false;
        }
        oldDate = date;
        if(description != null)
            oldEvent = true;
        
        //if there is a event on the activated date print it out
        if(description != null) {
            document.getElementById('eventTitle').innerHTML = title;
            document.getElementById('eventDescription').innerHTML = description;
        }
        //if there is a no event on the activated date don't print out
        else {
            document.getElementById('eventTitle').innerHTML = "";
            document.getElementById('eventDescription').innerHTML = "";
        }
        
    });
    
    //add an event to the database
    $('#eventForm').on('submit', function(event) {
        
        event.preventDefault();

        let name = $('#event-name').val();
        let date = $('#event-date').val();
        let description = $('#event-description').val();


        $.post("calendar.php", {

            "event-name": name,
            "event-date": date,
            "event-description": description,

        }, function (res) {

            if(res.status === 'success') {

                alert("The event was added!");
                
            } else {

                alert("The event couldn't be added");

            }

        });

    });

});