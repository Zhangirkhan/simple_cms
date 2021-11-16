$(function () {
    $(".flatpickr").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        locale: "ru",
    });
    //Валидация номера телефона
    $('#phoneMask').mask('+79999999999');
    //Валидация почты
    $("#emailMask").inputmask("email");

    //Загрузка файлов 
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');

    $('#uploadForm').ajaxForm({
        beforeSend: function () {
            $('.progress').show();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function () {
            var percentVal = '100%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function (xhr) {
            status.html(xhr.responseText);
        }

    });


});



function loaderStart() {
    // ______________ Global Loader
    $(window).on("load", function (e) {
        $("#global-loader").css("display") = block;
        $("#global-loader").css("opacity") = 0.5;
        console.log('heloo');
    })
}


$(document).on("click", "#OSIpushToUCButton", function () {
    $('#openinfo').modal('hide');
    var id = $(this).data('id');
    $(".modal-body #id").val(id);

});

$(document).on("click", "#UCpushRequestOSIButton", function () {
    $('#openinfo').modal('hide');
    var id = $(this).data('id');
    $(".modal-body #id").val(id);

});

$(document).on("click", ".OSIpushToUCWithoutAccept", function () {
    $('#openinfo').modal('hide');
    var executor = $(this).data('id');
    $(".modal-body #executor").val(executor);

});
$(document).on("click", ".OSIpushToUCNotAccept", function () {
    $('#openinfo').modal('hide');
    var executor = $(this).data('id');
    $(".modal-body #executor").val(executor);

});
$(document).on("click", ".OSIpushToUCWithoutAccept", function () {
    $('#openinfo').modal('hide');
    var executor = $(this).data('id');
    $(".modal-body #executor").val(executor);

});

$(document).on("click", "#AddReviewButton", function () {
    $('#openinfo').modal('hide');
    var id = $(this).data('id');
    var wroter_type = $(this).data('stuff');
    var wroter = $(this).data('author');

    $(".modal-body #id").val(id);
    $(".modal-body #wroter_type").val(wroter_type);
    $(".modal-body #wroter").val(wroter);


});

$(document).on("click", "#NotFinishedRequestButton", function () {
    $('#openinfo').modal('hide');
    var id = $(this).data('id');
    var wroter_type = $(this).data('stuff');
    var wroter = $(this).data('author');

    $(".modal-body #id").val(id);
    $(".modal-body #wroter_type").val(wroter_type);
    $(".modal-body #wroter").val(wroter);


});

$(document).on("click", "#notAcceptRequest", function () {
    $('#openinfo').modal('hide');
    var id = $(this).data('id');
    var wroter_type = $(this).data('stuff');
    var wroter = $(this).data('author');

    $(".modal-body #id").val(id);
    $(".modal-body #wroter_type").val(wroter_type);
    $(".modal-body #wroter").val(wroter);


});

$(document).on("click", "#CancelRequestButton", function () {
    $('#openinfo').modal('hide');
    var id = $(this).data('id');
    var executor_type = $(this).data('stuff');
    $(".modal-body #id").val(id);
    $(".modal-body #executor_type").val(executor_type);

});

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

//

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