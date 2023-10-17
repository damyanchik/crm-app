@extends('layout')

@section('content')
    <div class="float-end align-items-center experience">
        <a href="/product-categories/create" class="btn btn-primary border px-3 p-1">
            <i class="fa fa-plus"></i>
            Dodaj nową kategorię
        </a>
    </div>
    <h1>Kategorie produktowe</h1>
    <x-list-search :list="$productCategories">
        <table class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
            <tr>
                <th style="width: 2rem">ID</th>
                <th>Nazwa marki</th>
                <th style="width: 6rem"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($productCategories as $productCategory)
                <tr>
                    <td class="text-center">
                        {{ $productCategory['id'] }}
                    </td>
                    <td>
                        {{ $productCategory['name'] }}
                    </td>
                    <td class="">
                        <a href="product-categories/{{ $productCategory['id'] }}/edit" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-pen-to-square" style="color: #707070;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
@endsection
