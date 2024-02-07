@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-1 py-md-5">
                    <img class="rounded-circle mt-5" width="150px"
                         @if(!empty($user['avatar']))
                             src="{{ asset('storage/'.$user['avatar']) }}"
                         @else
                             src="{{ asset('images/unknown.png') }}"
                        @endif
                    >
                    <span class="font-weight-bold">{{ $user['position'] }}</span>
                    <span class="text-black-50">{{ $user['department'] }}</span>
                    @if (now()->subMinutes(5)->lessThanOrEqualTo($user['last_activity']) && !empty($user['last_activity']))
                        <span class="mt-2 badge bg-success rounded-pill d-inline">Aktywny</span>
                    @else
                        <span class="mt-2 badge bg-secondary rounded-pill d-inline">Nieaktywny</span>
                    @endif
                </div>
            </div>
            <x-employees.show-employee-details :user="$user"/>
        </div>
        <x-employees.all-companies :clients="$user->client"/>
        @include('partials.employees._employee-down-buttons')
    </div>
    </div>
    <script src="{{ asset('/js/employees.show/search_companies.js') }}"></script>
@endsection
