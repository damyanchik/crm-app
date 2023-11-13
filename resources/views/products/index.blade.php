@extends('layout')

@section('content')
    <h1>Lista produktów</h1>
    <x-list-search :list="$products">
        <table class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
            <tr>
                <th data-column="name">Nazwa produktu / marka</th>
                <th data-column="quantity">Na stanie</th>
                <th data-column="price">Cena</th>
                <th data-column="status">Status</th>
                <th style="width: 6rem"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <p>{{ $product['name'] }}</p>
                        @if (!empty($product['brand_id']) || !empty($product->brand->name))
                        <p class="text-muted mb-1">{{ $product->brand->name }}</p>
                        @endif
                    </td>
                    <td>
                        <p class="text-muted mb-1">{{ $product['quantity'] .' '. app('unitHelper')->getProductUnit($product['unit']) }}</p>
                    </td>
                    <td>
                        <p class="mb-0">{{ number_format($product['price'], 2) }} PLN</p>
                    </td>
                    <td>
                        <p class="mb-0">{{ app('statusHelper')->getProductStatus($product['status']) }}</p>
                    </td>
                    <td>
                        <a href="products/{{ $product['id'] }}/edit" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-pen-to-square" style="color: #707070;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
@endsection
