@extends('layout')

@section('content')
    <div class="float-end align-items-center experience">
        <a href="/brands/create" class="btn btn-primary border px-3 p-1">
            <i class="fa fa-plus"></i>
            Dodaj nową markę
        </a>
    </div>
    <h1>Marki produktów</h1>
    <x-list-search :list="$brands">
        <table class="table align-middle mb-0 bg-white border">
            <thead class="bg-light">
            <tr>
                <th style="width: 2rem">ID</th>
                <th>Nazwa marki</th>
                <th style="width: 6rem"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td class="text-center">
                        {{ $brand['id'] }}
                    </td>
                    <td>
                        {{ $brand['name'] }}
                    </td>
                    <td class="">
                        <a href="brands/{{ $brand['id'] }}/edit" class="btn btn-link btn-sm btn-rounded">
                            <i class="fa-solid fa-pen-to-square" style="color: #707070;"></i>
                        </a>
                        <form method="post" action="/brands/{{ $brand['id'] }}" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link btn-sm btn-rounded">
                                <i class="fa-solid fa-trash" style="color: #b01111;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-list-search>
@endsection
