@extends('layout')

@section('content')
    <h1>Lista zamówień</h1>
    <x-list-search :list="$orders">
        <table class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
                <tr>
                    <th data-column="id">Nr zamówienia </th>
                    <th data-column="invoice_num">Nr faktury </th>
                    <th>Zamawiający </th>
                    <th data-column="total_price">Wartość </th>
                    <th>Sprzedający </th>
                    <th data-column="created_at">Data </th>
                    <th data-column="status">Status </th>
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

    <script>
        $(document).ready(function() {
            var lastClickedTh = null;

            $('th[data-column]').hover(
                function () {
                    var th = $(this);
                    if (!th.find('.rotate-icon').is(":visible")) {
                        th.css('cursor', 'pointer');
                    }
                },
                function () {
                    var th = $(this);
                    if (!th.find('.rotate-icon').length) {
                        th.css('cursor', 'auto');
                    }
                }
            );

            $('th[data-column]').click(function () {
                var th = $(this);
                var column = th.data('column');

                if (lastClickedTh && lastClickedTh !== th) {
                    lastClickedTh.find('.rotate-icon').remove();
                    lastClickedTh.css('cursor', 'pointer');
                }

                if (!th.find('.rotate-icon').length) {
                    var icon = $('<img src="{{ asset('images/arrow.png') }}" class="rotate-icon" style="width: 0.7rem; cursor: pointer">');
                    rotateIconClick(column, icon);

                    th.append(icon);
                    th.css('cursor', 'auto');
                    lastClickedTh = th;
                } else {
                    th.css('cursor', 'pointer');
                    lastClickedTh = null;
                }
            });

            function rotateIconClick(column, icon) {
                addParam('column', column);
                changeOrder()
                var currentSort = $('#listManager input[name="order"]').val();
                var rotateIcon = currentSort === 'desc' ? 'rotate(180deg)' : 'rotate(0deg)';
                icon.css('transform', rotateIcon);

                $('#listManager input[name="order"]').trigger('change');
                $('#listManager input[name="column"]').trigger('change');
            }

            function addParam(name, value) {
                $('#listManager input[name="' + name + '"]').val(value);
            }

            function changeOrder() {
                var currentSortOrder = $('#listManager input[name="order"]').val();

                if (currentSortOrder === 'asc') {
                    $('#listManager input[name="order"]').val('desc');
                } else {
                    $('#listManager input[name="order"]').val('asc');
                }
            }
        });

    </script>
@endsection
