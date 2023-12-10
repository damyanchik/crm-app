<div class="col-md-5 border-right">
    <div class="p-3 p-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Dane pracownika</h4>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <span class="labels">Imię</span>
                <p class="small text-muted mb-1 my-2">{{ $user['name'] }}</p>
            </div>
            <div class="col-md-6">
                <span class="labels">Nazwisko</span>
                <p class="small text-muted mb-1 my-2">{{ $user['surname'] }}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 mt-2">
                <span class="labels">Email</span>
                <p class="small text-muted mb-1 my-2">{{ $user['email'] }}</p>
            </div>
            <div class="col-md-12 mt-2">
                <span class="labels">Numer telefonu</span>
                <p class="small text-muted mb-1 my-2">{{ $user['phone'] }} &nbsp;</p>
            </div>
            <div class="col-md-12 mt-2">
                <span class="labels">Adres zamieszkania</span>
                <p class="small text-muted mb-1 my-2">{{ $user['address'] }} &nbsp;</p>
            </div>
            <div class="col-md-12 mt-2">
                <span class="labels">Kod pocztowy</span>
                <p class="small text-muted mb-1 my-2">{{ $user['postal_code'] }} &nbsp;</p>
            </div>
            <div class="col-md-12 mt-2">
                <span class="labels">Miasto</span>
                <p class="small text-muted mb-1 my-2">{{ $user['city'] }} &nbsp;</p>
            </div>
            <div class="col-md-12 mt-2">
                <span class="labels">Województwo</span>
                <p class="small text-muted mb-1 my-2">{{ $user['state'] }} &nbsp;</p>
            </div>
            <div class="col-md-12 mt-2">
                <span class="labels">Kraj</span>
                <p class="small text-muted mb-1 my-2">{{ $user['country'] }} &nbsp;</p>
            </div>
        </div>
    </div>
