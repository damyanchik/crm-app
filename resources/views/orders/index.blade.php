@extends('layout')

@section('content')
    <div class="float-end align-items-center experience"><a href="/orders/create" class="btn border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Dodaj zamówienie</a></div>
    @if(isset($orders))
    <x-list-search :list="$orders">
        <table class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
            <tr>
                <th>Nr zamówienia</th>
                <th>Nr faktury</th>
                <th>Zamawiający</th>
                <th>Wartość</th>
                <th>Opiekun</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        <div class="ms-3">
                            {{ $order['id'] }}
                        </div>
                    </td>
                    <td>
                        {{ $order['invoice_num'] }}
                    </td>
                    <td>
                        <div>{{ $order->client->name }} {{ $order->client->surname }}</div>
                        <div>{{ $order->client->company }}</div>
                    </td>
                    <td>
                        {{ number_format($order['total_price'], 2) }} PLN
                    </td>
                    <td>
                        {{ $order->user->name }} {{ $order->user->surname }}
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
