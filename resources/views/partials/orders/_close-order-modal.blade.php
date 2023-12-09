<div class="modal fade" id="closeOrderModal" tabindex="-1" aria-labelledby="closeOrderModal" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{ route('closeOrder', $order['id']) }}" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="closeOrderModal">Zamknięcie zamówienia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>Czy potwierdzasz zamknięcie zamówienia o nr {{ $order['invoice_num'] }}?</span>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Potwierdź</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </form>
    </div>
</div>
