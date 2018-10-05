// Handles ajax and post when submit button is clicked in the event form and to load events

$(function() {
    var oldDate = -1;
    var oldEvent = false;
    
    $('.calendar-day').on('click', function(event) {
       
        var date = event.target.dataset.date;
        var description = $(event.currentTarget).find("input").val();
        var title = $(event.currentTarget).find("param").val();
        
        if(document.getElementById("event-date") != null)
        document.getElementById("event-date").value = date;
        
        document.getElementById(date).style.backgroundColor = "blue";
        if(oldDate != -1)
            document.getElementById(oldDate).style.backgroundColor = "white";
        
        if(oldEvent == true) {
            document.getElementById(oldDate).style.backgroundColor = "#8bc172";
            oldEvent = false;
        }
        oldDate = date;
        if(description != null)
            oldEvent = true;
        
        if(description != null) {
            document.getElementById('eventTitle').innerHTML = title;
            document.getElementById('eventDescription').innerHTML = description;
        }
        else {
            document.getElementById('eventTitle').innerHTML = "";
            document.getElementById('eventDescription').innerHTML = "";
        }
        
    });
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