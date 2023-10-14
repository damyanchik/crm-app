@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <form method="post" action="/brands/" class="col-md-12 border-right">
                @csrf
                <div class="p-3 py-2">
                    <div class="align-items-center mb-3">
                        <h4>Tworzenie nowej marki</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <span class="labels">Nazwa marki</span>
                            <input name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Dodaj markę</button>
                        <a href="/brands" class="btn btn-primary profile-button" type="button">Powrót do listy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
