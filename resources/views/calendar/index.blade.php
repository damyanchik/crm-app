@extends('layout')

@section('content')
    @can('storeCalendar')
        @include('partials.calendar._event-calendar-form')
    @endcan
    <hr class="my-4">

    <div id="calendar"></div>

    @include('partials.calendar._event-calendar-modal')

    <script>
        var eventdata = @json($events);
    </script>
    <script src="{{ asset('/js/calendar/calendar.js') }}"></script>
@endsection
