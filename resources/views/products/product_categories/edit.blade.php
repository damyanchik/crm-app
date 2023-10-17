@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="align-items-center mb-3">
                <div class="float-end">
                    <form method="post" action="/product-categories/{{$productCategory['id']}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger border px-3 p-1">
                            <i class="fa fa-minus"></i>&nbsp;Usuń kategorię
                        </button>
                    </form>
                </div>
                <h4>Edycja kategorii produktowej</h4>
            </div>
        </div>
        <div class="row">
            <form method="post" action="/product-categories/{{$productCategory['id']}}" class="col-md-12 border-right">
                @csrf
                @method('PUT')
                <div class="p-3 py-2">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <span class="labels">Nazwa kategorii</span>
                            <input name="name" value="{{$productCategory['name']}}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Zapisz zmiany</button>
                        <a href="/product-categories" class="btn btn-primary profile-button" type="button">Powrót do listy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
