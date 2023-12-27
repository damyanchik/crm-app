@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row mb-2 mb-md-0 text-center">
            <h3 class="col-12 text-right fw-bold">Zamówienie nr {{ $order['id'] }}</h3>
            <small>{{ $order['updated_at'] }}</small>
        </div>
        <div class="row">
            <x-orders.client-detail :order="$order"/>
            <x-orders.ordered-products :order="$order"/>
            <x-orders.down-order-buttons :order="$order"/>
        </div>
    </div>

    @if (in_array($order['status'], [app('OrderStatusEnum')::PENDING['id']]))
        @include('partials.orders._ready-order-modal')
    @elseif(in_array($order['status'], [app('OrderStatusEnum')::READY['id']]))
        @include('partials.orders._close-order-modal')
    @endif
    @include('partials.orders._reject-order-modal')

    <script src="{{ asset('/js/orders.show/search_order_item.js') }}"></script>
@endsection
