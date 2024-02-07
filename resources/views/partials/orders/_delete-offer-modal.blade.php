<div class="modal fade" id="deleteOfferModal" tabindex="-1" aria-labelledby="deleteOfferModal" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{ route('destroyOffer', $offer['id']) }}" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title" id="deleteOfferModal">Usuwanie oferty</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>Czy chcesz usunąć ofertę nr {{ $offer['id'] }}?</span>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Usuń</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </form>
    </div>
</div>
