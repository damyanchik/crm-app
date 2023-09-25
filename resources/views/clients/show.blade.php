@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <div class="col-md-6 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Dane klienta</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><span class="labels">Firma</span><p class="small text-muted mb-1 my-2">{{ $client['company'] }}</p></div>
                        <div class="col-md-6"><span class="labels">NIP</span><p class="small text-muted mb-1 my-2">{{ $client['tax'] }}</p></div>
                        <div class="col-md-6"><span class="labels">Imię</span><p class="small text-muted mb-1 my-2">{{ $client['name'] }}</p></div>
                        <div class="col-md-6"><span class="labels">Nazwisko</span><p class="small text-muted mb-1 my-2">{{ $client['surname'] }}</p></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mt-2"><span class="labels">Email</span><p class="small text-muted mb-1 my-2">{{ $client['email'] }}</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Numer telefonu</span><p class="small text-muted mb-1 my-2">{{ $client['phone'] }} &nbsp;</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Adres zamieszkania</span><p class="small text-muted mb-1 my-2">{{ $client['address'] }}&nbsp;</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Kod pocztowy</span><p class="small text-muted mb-1 my-2">{{ $client['postal_code'] }} &nbsp;</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Miasto</span><p class="small text-muted mb-1 my-2">{{ $client['city'] }} &nbsp;</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Województwo</span><p class="small text-muted mb-1 my-2">{{ $client['state'] }} &nbsp;</p></div>
                        <div class="col-md-12 mt-2"><span class="labels">Kraj</span><p class="small text-muted mb-1 my-2">{{ $client['country'] }} &nbsp;</p></div>
                    </div>
                    <div class="mt-5 text-center"><a href="/clients" class="btn btn-primary profile-button" type="button">Cofnij</a></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Dodaj notatkę</span></div><br>
                    <div class="col-md-12"><label class="labels">Zamówienia w toku</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                    <div class="col-md-12"><label class="labels">Historia zamówień</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                </div>
            </div>
        </div>
    </div>
@endsection
