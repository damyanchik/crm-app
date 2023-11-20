$(document).ready(function () {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
            today: 'Dziś',
            month: 'Miesiąc',
            week: 'Tydzień',
            day: 'Dzień'
        },
        dayNamesShort: ['Niedz.', 'Pon.', 'Wt.', 'Śr.', 'Czw.', 'Pt.', 'Sob.'],
        dayNames: ['Nd', 'Pn', 'Wt', 'Śr', 'Czw', 'Pi', 'So'],
        monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
        timeFormat: 'H:mm',
        locale: 'pl',
        views: {
            month: {
                columnFormat: 'dddd'
            },
            week: {
                columnFormat: 'ddd D/MM',
                titleFormat: 'MMMM D YYYY'
            },
            day: {
                columnFormat: 'dddd D/MM',
                titleFormat: 'MMMM D YYYY',
            }
        },
        events: eventdata,
        eventMouseover: function (event, jsEvent, view) {
            $(this).attr('title', event.description);
            $(this).tooltip({
                container: 'body',
                placement: 'top',
                trigger: 'manual'
            }).tooltip('show');
        },
        eventMouseout: function (event, jsEvent, view) {
            $(this).tooltip('hide');
        },
        eventClick: function (event) {
            $('#eventAuthor').text(event.name);
            $('#eventAuthorLink').attr('href', '/employees/' + event.user_id);
            $('#eventDelete').attr('action', '/calendar/' + event.id);
            $('#eventTitle').text('Tytuł: ' + event.title);
            $('#eventDescription').text('Opis: ' + event.description);
            $('#eventStart').text('Data rozpoczęcia: ' + event.start.format('YYYY-MM-DD HH:mm:ss'));
            $('#eventEnd').text('Data zakończenia: ' + event.end.format('YYYY-MM-DD HH:mm:ss'));
            $('#eventModal').modal('show');
        }
    });
});
