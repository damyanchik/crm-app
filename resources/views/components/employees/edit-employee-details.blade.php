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
        <input name="postal_code" type="text" class="form-control"
               value="{{ $user['postal_code'] }}">
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
        <input name="department" type="text" class="form-control"
               value="{{ $user['department'] }}">
    </div>
</div>
