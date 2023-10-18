@extends('layout')

@section('content')
    <form method="post" action="/employees/{{$user->id}}" class="container rounded bg-white mb-5">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Edytuj dane użytkownika</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Imię</label>
                            <input name="name" type="text" class="form-control" value="{{ $user['name'] }}">
                        </div>
                        <div class="col-md-6"><label class="labels">Nazwisko</label>
                            <input name="surname" type="text" class="form-control" value="{{ $user['surname'] }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mt-2">
                            <label class="labels">Email</label>
                            <input name="email" type="email" class="form-control" value="{{ $user['email'] }}">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="labels">Numer telefonu</label>
                            <input name="phone" type="text" class="form-control" value="{{ $user['phone'] }}">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="labels">Adres zamieszkania</label>
                            <input name="address" type="text" class="form-control" value="{{ $user['address'] }}">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="labels">Kod pocztowy</label>
                            <input name="postal_code" type="text" class="form-control" value="{{ $user['postal_code'] }}">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="labels">Miasto</label>
                            <input name="city" type="text" class="form-control" value="{{ $user['city'] }}">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="labels">Województwo</label>
                            <input name="state" type="text" class="form-control" value="{{ $user['state'] }}">
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="labels">Kraj</label>
                            <input name="country" type="text" class="form-control" value="{{ $user['country'] }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="labels">Pozycja</label>
                            <input name="position" type="text" class="form-control" value="{{ $user['position'] }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Dział</label>
                            <input name="department" type="text" class="form-control" value="{{ $user['department'] }}">
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Zapisz zmiany</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>Edit Experience</span>
                        <span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                    <div class="col-md-12">
                        <label class="labels">Experience in Designing</label>
                        <input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12">
                        <label class="labels">Additional Details</label>
                        <input type="text" class="form-control" placeholder="additional details" value=""></div>
                </div>
            </div>
        </div>
    </form>
@endsection
