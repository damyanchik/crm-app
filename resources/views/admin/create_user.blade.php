@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <form method="post" action="{{ route('storeEmployeeAdmin') }}" class="d-flex" enctype="multipart/form-data">
                @csrf
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="{{ asset('images/unknown.png') }}">
                    </div>
                    @error('avatar')
                    <span class="flash-message__alert" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                    <input type="file" class="form-control" name="avatar">
                </div>
                <div class="col-md-6 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Utwórz nowe konto</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Imię</label>
                                <input name="name" type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Nazwisko</label>
                                <input name="surname" type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Podaj nowe hasło</label>
                                <input type="password" class="form-control" name="password" value="">
                                @error('password')
                                <span class="flash-message__alert" role="alert">
                                {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Powtórz nowe hasło</label>
                                <input type="password" class="form-control" name="password_confirmation" value="">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mt-2">
                                <label class="labels">Email</label>
                                <input name="email" type="email" class="form-control" value="">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Numer telefonu</label>
                                <input name="phone" type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Adres zamieszkania</label>
                                <input name="address" type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Kod pocztowy</label>
                                <input name="postal_code" type="text" class="form-control"
                                       value="">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Miasto</label>
                                <input name="city" type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Województwo</label>
                                <input name="state" type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="labels">Kraj</label>
                                <input name="country" type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Pozycja</label>
                                <input name="position" type="text" class="form-control" value="">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Dział</label>
                                <input name="department" type="text" class="form-control"
                                       value="">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Utwórz konto</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
