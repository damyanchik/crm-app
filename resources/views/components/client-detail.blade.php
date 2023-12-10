<div class="row mt-2">
    <div class="col-md-6">
        <span class="labels">Firma</span>
        <p class="small text-muted mb-1 my-2">{{ $client['company'] }}</p>
    </div>
    <div class="col-md-6">
        <span class="labels">NIP</span>
        <p class="small text-muted mb-1 my-2">{{ $client['tax'] }}</p>
    </div>
    <div class="col-md-6">
        <span class="labels">Imię</span>
        <p class="small text-muted mb-1 my-2">{{ $client['name'] }}</p>
    </div>
    <div class="col-md-6">
        <span class="labels">Nazwisko</span>
        <p class="small text-muted mb-1 my-2">{{ $client['surname'] }}</p>
    </div>
    <div class="col-md-12 mt-2">
        <span class="labels">Email</span>
        <p class="small text-muted mb-1 my-2">{{ $client['email'] }}</p>
    </div>
    <div class="col-md-12 mt-2">
        <span class="labels">Numer telefonu</span>
        <p class="small text-muted mb-1 my-2">{{ $client['phone'] }} &nbsp;</p>
    </div>
    <div class="col-md-12 mt-2">
        <span class="labels">Adres zamieszkania</span>
        <p class="small text-muted mb-1 my-2">{{ $client['address'] }}&nbsp;</p>
    </div>
    <div class="col-md-12 mt-2">
        <span class="labels">Kod pocztowy</span>
        <p class="small text-muted mb-1 my-2">{{ $client['postal_code'] }} &nbsp;</p>
    </div>
    <div class="col-md-12 mt-2">
        <span class="labels">Miasto</span>
        <p class="small text-muted mb-1 my-2">{{ $client['city'] }} &nbsp;</p>
    </div>
    <div class="col-md-12 mt-2">
        <span class="labels">Województwo</span>
        <p class="small text-muted mb-1 my-2">{{ $client['state'] }} &nbsp;</p>
    </div>
    <div class="col-md-12 mt-2">
        <span class="labels">Kraj</span>
        <p class="small text-muted mb-1 my-2">{{ $client['country'] }} &nbsp;</p>
    </div>
</div>
