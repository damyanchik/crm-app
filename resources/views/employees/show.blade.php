@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold">{{ $user['position'] }}</span><span class="text-black-50">{{ $user['department'] }}</span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Dane użytkownika</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><span class="labels">Imię</span><p class="small text-muted mb-1 my-2">{{ $user['name'] }}</p></div>
                        <div class="col-md-6"><span class="labels">Nazwisko</span><p class="small text-muted mb-1 my-2">{{ $user['name'] }}</p></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mt-2"><span class="labels">Email</span><p class="small text-muted mb-1 my-2">{{ $user['email'] }}</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Numer telefonu</span><p class="small text-muted mb-1 my-2">{{ $user['phone'] }} &nbsp;</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Adres zamieszkania</span><p class="small text-muted mb-1 my-2">{{ $user['address'] }} &nbsp;</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Kod pocztowy</span><p class="small text-muted mb-1 my-2">{{ $user['postal_code'] }} &nbsp;</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Miasto</span><p class="small text-muted mb-1 my-2">{{ $user['city'] }} &nbsp;</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Województwo</span><p class="small text-muted mb-1 my-2">{{ $user['state'] }} &nbsp;</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Kraj</span><p class="small text-muted mb-1 my-2">{{ $user['country'] }} &nbsp;</p></div>
                    </div>
                    <div class="mt-5 text-center"><a href="/employees" class="btn btn-primary profile-button" type="button">Cofnij</a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                    <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                </div>
            </div>
        </div>
    </div>
@endsection
