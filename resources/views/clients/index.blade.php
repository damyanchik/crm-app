@extends('layout')

@section('content')
    <div class="float-end align-items-center experience"><a href="/clients/create" class="btn border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Dodaj klienta</a></div>
    <x-list-search :list="$clients">
        <table class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
            <tr>
                <th>Klient</th>
                <th>Dane adresowe</th>
                <th>Opiekun</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>
                        <div class="ms-3">
                            <p class="fw-bold mb-1">{{ $client['company'] }}</p>
                            <p class="fw-bold mb-1">{{ $client['name'] }} {{ $client['surname'] }}</p>
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
                        <p class="mb-0">Max Steinberg</p>
                    </td>
                    <td>

                    </td>
                    <td>
                        <a href="clients/{{ $client['id'] }}" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-user" style="color: #707070;"></i>
                        </a>
                        <a href="clients/{{ $client['id'] }}/edit" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-user-pen" style="color: #707070;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
@endsection
