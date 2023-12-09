<div class="modal fade" id="readyOrderModal" tabindex="-1" aria-labelledby="readyOrderModal" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{ route('readyOrder', $order['id']) }}" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="readyOrderModal">Gotowość zamówienia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>Czy potwierdzasz zamówienie o nr {{ $order['invoice_num'] }}?</span>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Potwierdź</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </form>
    </div>
</div>
