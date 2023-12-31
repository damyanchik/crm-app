@extends('layout')

@section('content')
    <form method="post" action="{{ route('storeClient') }}" class="container rounded bg-white mb-5">
        @csrf
        <div class="row">
            <div class="col-12 border-right">
                <div class="p-5 py-5">
                    <div class="align-items-center mb-3">
                        <h4 class="text-right">Zakładanie nowego klienta</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 py-1">
                            <span class="labels">Firma</span>
                            <input name="company" type="text" class="form-control">
                            @error('company')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 py-1">
                            <span class="labels">NIP</span>
                            <input name="tax" type="text" class="form-control">
                            @error('tax')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 py-1">
                            <span class="labels">Imię</span>
                            <input name="name" type="text" class="form-control">
                            @error('name')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 py-1">
                            <span class="labels">Nazwisko</span>
                            <input name="surname" type="text" class="form-control">
                            @error('surname')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <span class="labels">Email</span>
                            <input name="email" type="email" class="form-control">
                            @error('email')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Numer telefonu</span>
                            <input name="phone" type="text" class="form-control">
                            @error('phone')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Adres zamieszkania</span>
                            <input name="address" type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Kod pocztowy</span>
                            <input name="postal_code" type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Miasto</span>
                            <input name="city" type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Województwo/region</span>
                            <input name="state" type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Kraj</span>
                            <input name="country" type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mt-2">
                            <span class="labels">Opiekun</span>
                            <select name="user_id" id="userSelect" class="form-control" style="width: 100%;">></select>
                        </div>
                    </div>
                    @include('partials.clients._clients-down-buttons')
                </div>
            </div>
        </div>
    </form>
    <script>
        var ajaxSearchUsersLink = @json(route('ajax.searchUsers'));
    </script>
    <script src="{{ asset('/js/clients/ajax_search_employees.js') }}"></script>
@endsection
