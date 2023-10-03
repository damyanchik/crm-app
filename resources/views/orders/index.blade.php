@extends('layout')

@section('content')
    <div class="float-end align-items-center experience"><a href="/orders/create" class="btn border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Dodaj zamówienie</a></div>
    @if(isset($orders))
    <x-list-search :list="$orders">
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
            @foreach($orders as $order)
                <tr>
                    <td>
                        <div class="ms-3">
asd
                        </div>
                    </td>
                    <td>
x
                    </td>
                    <td>
xx
                    </td>
                    <td>
x
                    </td>
                    <td>
                        <a href="orders/" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-user" style="color: #707070;"></i>
                        </a>
                        <a href="orders/x/edit" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-user-pen" style="color: #707070;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
    @else
        Brak danych
    @endif
@endsection
