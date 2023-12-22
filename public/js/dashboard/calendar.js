$(document).ready(function () {
    $('#calendar').fullCalendar({
        height: 350,
        header: {

        },
        buttonText: {
            today: 'Dziś',
            month: 'Miesiąc',
            week: 'Tydzień',
            day: 'Dzień'
        },
        dayNamesShort: ['Nd', 'Pn', 'Wt', 'Śr', 'Czw', 'Pt', 'So'],
        dayNames: ['Nd', 'Pn', 'Wt', 'Śr', 'Czw', 'Pt', 'So'],
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
    });
});
