@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="align-items-center mb-3">
                <div class="float-end">
                    <form method="post" action="{{ route('destroyBrand', $brand['id']) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger border px-3 p-1">
                            <i class="fa fa-minus"></i> Usuń markę
                        </button>
                    </form>
                </div>
                <h4>Edycja marki</h4>
            </div>
        </div>
        <div class="row">
            <form method="post" action="{{ route('updateBrand',$brand['id']) }}" class="col-md-12 border-right">
                @csrf
                @method('PUT')
                <div class="p-3 py-2">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <span class="labels">Nazwa marki</span>
                            <input name="name" value="{{$brand['name']}}" type="text" class="form-control">
                            @error('name')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Zapisz zmiany</button>
                        <a href="{{ route('brands') }}" class="btn btn-primary profile-button" type="button">Powrót do listy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
