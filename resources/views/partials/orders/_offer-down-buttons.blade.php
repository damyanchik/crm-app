<div class="d-flex justify-content-between mt-5">
    <div class="d-inline-block">
        @can('updateOffer')
            <button id="createOrder" class="btn btn-primary profile-button mb-2 mb-md-0" type="submit">
                Wprowadź zmiany
            </button>
        @endcan
        <a href="{{ route('offers') }}" class="btn btn-primary profile-button" type="button">
            Powrót do listy
        </a>
    </div>
    <div class="d-inline-block">
        @can('makeOrder')
            <button class="btn btn-success profile-button mb-2 mb-md-0" type="button" data-bs-toggle="modal" data-bs-target="#makeOrderModal">
                <i class="fa-regular fa-circle-right me-1"></i>
                Utwórz zamówienie
            </button>
        @endcan
        @can('destroyOffer')
            <button class="btn btn-danger profile-button" type="button" data-bs-toggle="modal" data-bs-target="#deleteOfferModal">
                <i class="fa-solid fa-trash me-1"></i>
                Do kosza
            </button>
        @endcan
    </div>
</div>
