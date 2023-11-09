@extends('layout')

@section('content')
    <h1>Lista użytkowników</h1>
    <x-list-search :list="$users">
        <table class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
                <tr>
                    <th>Użytkownik</th>
                    <th>Pozycja / Dział</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <img
                            @if(!empty($user['avatar']))
                                src="{{ asset('storage/'.$user['avatar']) }}"
                            @else
                                src="{{ asset('images/unknown.png') }}"
                            @endif
                            alt=""
                            style="width: 45px; height: 45px"
                            class="rounded-circle"
                        />
                        <div class="ms-3">
                            <p class="fw-bold mb-1">{{ $user['name'] }} {{ $user['surname'] }}</p>
                            <p class="text-muted mb-0">{{ $user['email'] }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{ $user['position'] }}</p>
                    <p class="text-muted mb-0">{{ $user['department'] }}</p>
                </td>
                <td>
                    @if (now()->subMinutes(5)->lessThanOrEqualTo($user['last_activity']) && !empty($user['last_activity']))
                    <span class="badge bg-success rounded-pill d-inline">Aktywny</span>
                    @else
                    <span class="badge bg-secondary rounded-pill d-inline">Nieaktywny</span>
                    @endif
                </td>
                <td></td>
                <td>
                    <a href="employees/{{ $user['id'] }}" class="btn btn-link btn-sm btn-rounded">
                        <i class="fa-solid fa-user" style="color: #707070;"></i>
                    </a>
                    <a href="employees/{{ $user['id'] }}/edit" class="btn btn-link btn-sm btn-rounded">
                        <i class="fa-solid fa-user-pen" style="color: #707070;"></i>
                    </a>
                    <form method="post" action="/employees/{{ $user['id'] }}/block" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-link btn-sm btn-rounded">
                        @if($user['block'])
                            <i class="fa-solid fa-lock" style="color: #b01111;"></i>
                        @else
                            <i class="fa-solid fa-lock-open" style="color: #707070;"></i>
                        @endif
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
@endsection
