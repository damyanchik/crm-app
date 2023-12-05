@extends('layout')

@section('content')
    <h1>Lista ofert</h1>
    <x-list-search :list="$offers">
        <table id="table-breakpoint" class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
            <tr>
                <th data-column="id">Nr</th>
                <th data-column="client.company">Klient</th>
                <th data-column="total_price">Wartość</th>
                <th data-column="total_quantity">Ilość</th>
                <th data-column="users.surname">Wystawiający</th>
                <th data-column="created_at">Data</th>
                <th data-column="status">Status</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
                <tr>
                    <td>
                        <div class="ms-3">
                            {{ $offer['id'] }}
                        </div>
                    </td>
                    <td>
                        <div>{{ strtoupper($offer->client->name) }} {{ strtoupper($offer->client->surname) }}</div>
                        <div>{{ strtoupper($offer->client->company) }}</div>
                    </td>
                    <td>
                        {{ app('PriceHelper')->formatPrice($offer['total_price']) }}
                    </td>
                    <td>
                        {{ $offer['total_quantity'] }}
                    </td>
                    <td>
                        {{ $offer->user->name }} {{ $offer->user->surname }}
                    </td>
                    <td class="text-muted">
                        {{ $offer['created_at'] }}
                    </td>
                    <td>
                        <span class="badge rounded-pill bg-{{ app('OrderStatusEnum')->getStatusColor($offer->status) }}">
                            {{ app('OrderStatusEnum')->getStatus($offer->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="offers/{{ $offer['id'] }}/edit" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-magnifying-glass" style="color: #707070;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
@endsection
