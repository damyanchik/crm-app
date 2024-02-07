@extends('layout')

@section('content')
    <h1>Lista klientów</h1>
    <x-list-search :list="$clients">
        <table id="table-breakpoint" class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
                <tr>
                    <th data-column="company">Klient</th>
                    <th data-column="city">Dane adresowe</th>
                    <th data-column="users.surname">Opiekun</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>
                        <div class="ms-3">
                            <p class="fw-bold mb-1">{{ strtoupper($client['company']) }}</p>
                            <p class="fw-bold mb-1">{{ strtoupper($client['name']) }} {{ strtoupper($client['surname']) }}</p>
                            <p class="text-muted mb-0">{{ $client['tax'] }}</p>
                        </div>
                    </td>
                    <td>
                        <p class="text-muted mb-1">{{ $client['address'] }}</p>
                        <p class="text-muted mb-0">{{ $client['postal_code'] }}</p>
                        <p class="text-muted mb-0">{{ $client['city'] }}</p>
                        <p class="text-muted mb-0">{{ $client['country'] }}</p>
                    </td>
                    <td>
                        @if($client['user_id'])
                        <p class="mb-0">{{ $client->user->name }} {{ $client->user->surname }}</p>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('showClient', $client['id']) }}" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-user" style="color: #707070;"></i>
                        </a>
                        <a href="{{ route('editClient', $client['id']) }}" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-user-pen" style="color: #707070;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
@endsection
