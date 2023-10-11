@extends('layout')

@section('content')
    <h1>Lista zamówień</h1>
    <x-list-search :list="$orders">
        <table class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
                <tr>
                    <th>Nr zamówienia</th>
                    <th>Nr faktury</th>
                    <th>Zamawiający</th>
                    <th>Wartość</th>
                    <th>Sprzedający</th>
                    <th>Data</th>
                    <th>Status</th>
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
                    <td>
                        {{ $order['created_at'] }}
                    </td>
                    <td>
                        {{ app('statusHelper')->getOrderStatus($order->status) }}
                    </td>
                    <td>
                        <a href="orders/{{ $order['id'] }}" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-magnifying-glass" style="color: #707070;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
@endsection
