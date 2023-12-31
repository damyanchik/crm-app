@extends('layout')

@section('content')
    <div>
        <h1 class="d-md-inline-block">Lista produktów</h1>
        <div class="float-md-end">
            <button type="button" class="btn btn-primary px-3 p-1" data-bs-toggle="modal"
                    data-bs-target="#addProductsModal">
                <i class="fa fa-plus"></i>&nbsp;
                Dodaj nowe produkty
            </button>
            <button type="button" class="btn btn-primary px-3 p-1" data-bs-toggle="modal"
                    data-bs-target="#updateProductsModal">
                <i class="fa fa-plus"></i>&nbsp;
                Zaktualizuj produkty
            </button>
        </div>
    </div>
    <x-list-search :list="$products">
        <table id="table-breakpoint" class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
            <tr>
                <th data-column="name">Nazwa produktu</th>
                <th data-column="brand">Marka</th>
                <th data-column="category">Kategoria</th>
                <th data-column="code">Kod</th>
                <th data-column="quantity">Stan</th>
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
                                <p>{{ strtoupper($product['name']) }}</p>
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
                        <p class="text-muted mb-1">{{ $product['code'] }}</p>
                    </td>
                    <td>
                        <p class="mb-0">{{ $product['quantity'] .' '. app('ProductUnitEnum')->getUnit($product['unit']) }}</p>
                    </td>
                    <td>
                        <p class="mb-0">{{ app('PriceHelper')->formatPrice($product['price']) }}</p>
                    </td>
                    <td>
                        <p class="mb-0 badge rounded-pill bg-{{ app('ProductStatusEnum')->getStatusColor($product['status']) }}">
                            {{ app('ProductStatusEnum')->getStatus($product['status']) }}
                        </p>
                    </td>
                    <td>
                        <a href="{{ route('editProduct', $product['id']) }}" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-pen-to-square" style="color: #707070;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
    @include('partials.products._import-products-modal')
@endsection
