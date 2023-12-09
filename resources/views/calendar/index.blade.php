@extends('layout')

@section('content')
    @can('storeCalendar')
    <form method="post" action="/calendar/" class="row">
        @csrf
        <div class="col-md-2 mt-2">
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
        <div class="col-md-1 mt-2">
            <label>Kolor</label>
            <select name="color" class="form-control">
                @foreach(app('CalendarColorEnum')->getAllColors() as $id => $color)
                    <option value="{{ $id }}" style="background-color: {{ $color }};">&nbsp;</option>
                @endforeach
            </select>
            @error('color')
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
    @endcan
    <hr class="my-4">

    <div id="calendar"></div>

    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-block">
                        <p id="eventStart" class="m-0 small"></p>
                        <p id="eventEnd" class="m-0 small"></p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="eventTitle"></p>
                    <p id="eventDescription"></p>
                    <div class="d-flex float-end">
                        <a id="eventAuthorLink" class="text-decoration-none" target="_blank">
                            <i class="fa-solid fa-user me-1" style="color: #707070;"></i>
                        </a>
                        <p id="eventAuthor"></p>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <form id="eventDelete" method="post" action="" class="float-end align-items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-secondary" data-bs-dismiss="modal">Usuń</button>
                    </form>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var eventdata = @json($events);
    </script>
    <script src="{{ asset('/js/calendar/calendar.js') }}"></script>
@endsection
