@extends('layout')

@section('content')
    <h1>Lista zamówień</h1>
    <x-list-search :list="$orders">
        <table id="table-breakpoint" class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
                <tr>
                    <th data-column="id">Nr</th>
                    <th data-column="invoice_num">Nr faktury</th>
                    <th data-column="client.company">Zamawiający</th>
                    <th data-column="total_price">Wartość</th>
                    <th data-column="users.surname">Wystawiający</th>
                    <th data-column="created_at">Data</th>
                    <th data-column="status">Status</th>
                    <th>Akcje</th>
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
                        <div>{{ strtoupper($order->client->name) }} {{ strtoupper($order->client->surname) }}</div>
                        <div>{{ strtoupper($order->client->company) }}</div>
                    </td>
                    <td>
                        {{ number_format($order['total_price'], 2) }} PLN
                    </td>
                    <td>
                        {{ $order->user->name }} {{ $order->user->surname }}
                    </td>
                    <td class="text-muted">
                        {{ $order['created_at'] }}
                    </td>
                    <td>
                        <span class="badge rounded-pill bg-{{ app('OrderStatusEnum')->getStatusColor($order->status) }}">{{ app('OrderStatusEnum')->getStatus($order->status) }}</span>
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
