$(document).ready(function() {
    var calendar = $("#fullcalendar").fullCalendar({
        header: {
            left: "prev,today,next",
            center: "title",
            right: "month,agendaWeek,agendaDay,listMonth"
        },
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar
        dragRevertDuration: 0,
        defaultView: "month",
        eventLimit: true, // allow "more" link when too many events
        events: "/project-calendar",
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            var title = $("#createEventModal").modal("show");
            if (title) {
                var start = $.fullCalendar.formatDate(
                    start,
                    "dddd, MMMM D, YYYY HH:mm:ss"
                );
                var end = $.fullCalendar.formatDate(end, "dddd, MMMM D, YYYY HH:mm:ss");
                //var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                $("#startLabel").text(start);
                $("#endLabel").text(end);
                $("#startValue").val(start);
                $("#endValue").val(end);
            }
        },
        eventResize: function(event) {
            var start = $.fullCalendar.formatDate(
                event.start,
                "Y-MM-DD HH:mm:ss"
            );
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
        },
        eventDrop: function(event) {
            var start = $.fullCalendar.formatDate(
                event.start,
                "Y-MM-DD HH:mm:ss"
            );
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            axios
                .post("/update-event", {
                    title: title,
                    end: end,
                    start: start,
                    id: id
                })
                .then(response => {
                    $.notify(response.data.message, "success");
                })
                .catch(error => {
                    $.notify("Error! Couldn't update event.");
                });
        },
        eventClick: function(event, jsEvent, view) {
            $("#modalTitle1").html(event.title);
            $("#modalBody1").html(event.description);
            $("#eventUrl").attr("href", event.url);
            $("#fullCalModal").modal();
        }
    });
    //save Event
    $(document).on("click", "#addEventBtn", function(event) {
        event.preventDefault();
        axios
            .post("/add-event", {
                eventName: $("#eventName").val(),
                startDate: $("#startValue").val(),
                endDate: $("#endValue").val(),
                description: $("#description").val()
            })
            .then(response => {
                calendar.fullCalendar("refetchEvents");
                $.notify(response.data.message, "success");
            });
    });
});
