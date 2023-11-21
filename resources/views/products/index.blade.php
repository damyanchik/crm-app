@extends('layout')

@section('content')
    <h1>Lista produktów</h1>
    <x-list-search :list="$products">
        <table id="table-breakpoint" class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
            <tr>
                <th data-column="name">Nazwa produktu</th>
                <th data-column="brand">Marka</th>
                <th data-column="category">Kategoria</th>
                <th data-column="quantity">Na stanie</th>
                <th data-column="price">Cena</th>
                <th data-column="status">Status</th>
                <th style="width: 6rem">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img
                                @if(!empty($product['photo']))
                                    src="{{ asset('storage/'.$product['photo']) }}"
                                @else
                                    src="{{ asset('images/unknown-product.png') }}"
                                @endif
                                alt=""
                                style="width: 45px; height: 45px"
                                class="rounded-circle"
                            />
                            <div class="ms-3 mt-2">
                                <p>{{ $product['name'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if (!empty($product['brand']))
                            <p class="text-muted mb-1">{{ $product['brand'] }}</p>
                        @endif
                    </td>
                    <td>
                        @if (!empty($product['category']))
                            <p class="text-muted mb-1">{{ $product['category'] }}</p>
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
