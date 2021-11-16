// Планирование
$(document).ready(function () {

    $(function () {
        'use strict'
        // Datepicker
        $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'yy-mm-dd'
        });

        $('#datepickerNoOfMonths').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            numberOfMonths: 2
        });

    });

    // $('#myModal').on('show.bs.modal', function() {
    //     alert('hi')
    // });
    var calendar = $('#calendar1').fullCalendar({
        editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        locale: 'ru',
        events: 'loadEvents.php',
        selectable: true,
        selectHelper: true,
        timeFormat: 'H:mm',
        
        select: function (start, end, allDay) {
            var title = prompt("Укажите задачу");
            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                var add = 1;
                $.ajax({
                    url: "insertEvent.php",
                    type: "POST",
                    data: { title: title, start: start, end: end, add: add },
                    success: function () {
                        calendar.fullCalendar('refetchEvents');
                        alert("Задача добавлена");

                    }
                })
            }
        },
        editable: true,
        eventResize: function (event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            var update = 1;
            $.ajax({
                url: "insertEvent.php",
                type: "POST",
                data: { title: title, start: start, end: end, id: id, update: update },
                success: function () {
                    calendar.fullCalendar('refetchEvents');
                    alert('Задача обновлена');
                }
            })
        },

        eventDrop: function (event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            var update = 1;
            $.ajax({
                url: "insertEvent.php",
                type: "POST",
                data: { title: title, start: start, end: end, id: id, update: update },
                success: function () {
                    calendar.fullCalendar('refetchEvents');
                    alert("Задача обновлена");
                }
            });
        },

        eventClick: function (event) {
            if (confirm("Хотите завершить задачу?")) {
                var id = event.id;
                var deleted = 1;
                $.ajax({
                    url: "insertEvent.php",
                    type: "POST",
                    data: { id: id, deleted: deleted },
                    success: function () {
                        calendar.fullCalendar('refetchEvents');
                        alert("Завершить задачу?");
                    }
                })
            }
        },

    });
    var calendar2 = $('#calendar').fullCalendar({
        editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'listDay,listWeek,month'
        },
        views: {
            listDay: { buttonText: 'День' },
            listWeek: { buttonText: 'Неделя' }
        },
        displayEventTime: false,
        defaultView: 'listWeek',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        locale: 'ru',
        events: 'loadEvents.php',
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt("Напишите задачу");
            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                var add = 1;
                $.ajax({
                    url: "insertEvent.php",
                    type: "POST",
                    data: { title: title, start: start, end: end, add: add },
                    success: function () {
                        calendar.fullCalendar('refetchEvents');
                        alert("Успешно добавлено");

                    }
                })
            }
        },
        editable: true,
        eventResize: function (event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            var update = 1;
            $.ajax({
                url: "insertEvent.php",
                type: "POST",
                data: { title: title, start: start, end: end, id: id, update: update },
                success: function () {
                    calendar.fullCalendar('refetchEvents');
                    alert('Задача обноволена');
                }
            })
        },

        eventDrop: function (event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            var update = 1;
            $.ajax({
                url: "insertEvent.php",
                type: "POST",
                data: { title: title, start: start, end: end, id: id, update: update },
                success: function () {
                    calendar.fullCalendar('refetchEvents');
                    alert("Задача обновлена");
                }
            });
        },

        eventClick: function (event) {
            if (confirm("Хотите завершить задачу?")) {
                var id = event.id;
                var deleted = 1;
                $.ajax({
                    url: "insertEvent.php",
                    type: "POST",
                    data: { id: id, deleted: deleted },
                    success: function () {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Removed");
                    }
                })
            }
        },

    });
});