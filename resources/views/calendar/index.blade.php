@extends('layout')

@section('content')
    <form method="post" action="/calendar/" class="row">
        @csrf
        <div class="col-md-3 mt-2">
            <label>Tytuł wydarzenia</label>
            <input type="text" name="title" class="form-control">
            @error('title')
            <span class="flash-message__alert" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="col-md-3 mt-2">
            <label>Opis wydarzenia</label>
            <input type="text" name="description" class="form-control">
            @error('description')
            <span class="flash-message__alert" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="col-md-2 mt-2">
            <label>Data początku</label>
            <input type="datetime-local" name="date_start" class="form-control">
            @error('date_start')
            <span class="flash-message__alert" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="col-md-2 mt-2">
            <label>Data końca</label>
            <input type="datetime-local" name="date_end" class="form-control">
            @error('date_end')
            <span class="flash-message__alert" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="col-md-2 mt-4 text-center">
            <button type="submit" class="btn-primary btn">Dodaj wydarzenie</button>
        </div>
    </form>
    <hr class="my-4">
    <div id="calendar"></div>
    <script>
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
                dayNames: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
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
                events: @json($events)
            });
        });
    </script>
@endsection
