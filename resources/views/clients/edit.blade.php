@extends('layout')

@section('content')
    <div class="row float-end">
        <div class="col-12">
            <form method="post" action="/clients/{{$client->id}}" class="float-end align-items-center">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger border px-3 p-1">
                    <i class="fa fa-minus"></i>&nbsp;Usuń klienta
                </button>
            </form>
        </div>
    </div>
    <form method="post" action="/clients/{{$client->id}}" class="container rounded bg-white mb-5">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="p-5 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Edycja danych klienta</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <span class="labels">Firma</span>
                            <input name="company" type="text" class="form-control" value="{{ $client['company'] }}">
                            @error('company')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">NIP</span>
                            <input name="tax" type="text" class="form-control" value="{{ $client['tax'] }}">
                            @error('tax')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Imię</span>
                            <input name="name" type="text" class="form-control" value="{{ $client['name'] }}">
                            @error('name')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Nazwisko</span>
                            <input name="surname" type="text" class="form-control" value="{{ $client['surname'] }}">
                            @error('surname')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mt-2">
                            <span class="labels">Email</span>
                            <input name="email" type="email" class="form-control" value="{{ $client['email'] }}">
                            @error('email')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Numer telefonu</span>
                            <input name="phone" type="text" class="form-control" value="{{ $client['phone'] }}">
                            @error('phone')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Adres zamieszkania</span>
                            <input name="address" type="text" class="form-control" value="{{ $client['address'] }}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Kod pocztowy</span>
                            <input name="postal_code" type="text" class="form-control" value="{{ $client['postal_code'] }}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Miasto</span>
                            <input name="city" type="text" class="form-control" value="{{ $client['city'] }}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Województwo</span>
                            <input name="state" type="text" class="form-control" value="{{ $client['state'] }}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Kraj</span>
                            <input name="country" type="text" class="form-control" value="{{ $client['country'] }}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Opiekun</span>
                            <select name="user_id" id="userSelect" class="form-control" style="width: 100%;">
                                @if( $client['user_id'] )
                                    <option value="{{ $client['user_id'] }}" selected>{{ $client->user->name }} {{ $client->user->surname }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Zapisz zmiany</button></div>
                </div>
            </div>
        </div>
    </form>
    <script>
        var ajaxSearchUsersLink = @json(route('ajax.searchUsers'));
    </script>
    <script src="{{ asset('/js/clients/ajax_search_employees.js') }}"></script>
@endsection
