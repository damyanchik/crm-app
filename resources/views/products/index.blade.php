@extends('layout')

@section('content')
    <h1>Lista produktów</h1>
    <x-list-search :list="$products">
        <table class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
            <tr>
                <th>Nazwa produktu / marka</th>
                <th>Na stanie</th>
                <th>Cena</th>
                <th>Status</th>
                <th style="width: 6rem"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <p>{{ $product['name'] }}</p>
                        <p class="text-muted mb-1">{{ $product->brand->name }}</p>
                    </td>
                    <td>
                        <p class="text-muted mb-1">{{ $product['quantity'] .' '. app('unitHelper')->getProductUnit($product['unit']) }}</p>
                    </td>
                    <td>
                        <p class="mb-0">{{ number_format($product['price'], 2) }} PLN</p>
                    </td>
                    <td>
                        <p class="mb-0">{{ app('statusHelper')->getOrderStatus($product['status']) }}</p>
                    </td>
                    <td>
                        <a href="" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-magnifying-glass" style="color: #707070;"></i>
                        </a>
                        <a href="" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-pen-to-square" style="color: #707070;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
@endsection
