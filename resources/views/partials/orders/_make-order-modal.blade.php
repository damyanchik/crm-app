<div class="modal fade" id="makeOrderModal" tabindex="-1" aria-labelledby="makeOrderModal" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{ route('makeOrder', $offer['id']) }}" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="makeOrderModal">Tworzenie zamówienia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>Czy chcesz utworzyć zamówienie z oferty nr {{ $offer['id'] }}?</span>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Utwórz</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </form>
    </div>
</div>
