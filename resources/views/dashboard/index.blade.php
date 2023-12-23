@extends('layout')

@section('content')
    <h1 class="col-12">Dashboard</h1>
    <div class="col-12 text-center mt-3">
        <small>STATYSTYKA OSTATNIEGO TYGODNIA I PORÓWNANIE Z TYGODNIEM POPRZEDZĄJĄCYM</small>
    </div>
    <div class="row mt-3 text-center">
        <div class="col-6 col-md-3">
            <h4 class="col-12 fw-bold">Zamówienia</h4>
            <h5>{{ $dashboardData->totalOrdersThisWeek }}</h5>
            <small class="lastWeekDiff">{{ $dashboardData->totalOrdersThisWeek - $dashboardData->totalOrdersLastWeek }}</small>
        </div>
        <div class="col-6 col-md-3">
            <h4 class="col-12 fw-bold">Wartość zamówień</h4>
            <h5>{{ app('PriceHelper')->formatPrice($dashboardData->totalSalesThisWeek) }}</h5>
            <small class="lastWeekDiff">{{ app('PriceHelper')->formatPrice($dashboardData->totalSalesThisWeek - $dashboardData->totalSalesLastWeek) }}</small>
        </div>
        <div class="col-6 col-md-3 mt-4 mt-md-0">
            <h4 class="col-12 fw-bold">Ilość produktów</h4>
            <h5>{{ $dashboardData->totalProductsSoldThisWeek }}</h5>
            <small class="lastWeekDiff">{{ $dashboardData->totalProductsSoldThisWeek - $dashboardData->totalProductsSoldLastWeek }}</small>
        </div>
        <div class="col-6 col-md-3 mt-4 mt-md-0">
            <h4 class="col-12 fw-bold">Liczba klientów</h4>
            <h5>{{ $dashboardData->customersThisWeek }}</h5>
            <small class="lastWeekDiff">{{ $dashboardData->customersThisWeek - $dashboardData->customersLastWeek }}</small>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 col-md-6 mt-4 text-center">
            <h2>Wyniki sprzedażowe</h2>
            <canvas id="chart" class="ps-4"></canvas>
        </div>
        <div class="col-12 col-md-6 dashboard__calendar">
            <div id="calendar" class="p-4" style="background-color: #ffffff;"></div>
        </div>
    </div>
    <script>
        var eventdata = @json($events);
    </script>
    <script src="{{ asset('/js/dashboard/calendar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('/js/dashboard/bar-chart.js') }}"></script>
    <script src="{{ asset('/js/dashboard/last-week-stats.js') }}"></script>
@endsection
