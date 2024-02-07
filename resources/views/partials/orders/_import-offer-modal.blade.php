<div class="modal fade" id="loadProductsModal" tabindex="-1" aria-labelledby="loadProductsModal" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{ route('importOffer') }}" class="modal-content" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="loadProductsModal">Ładowanie listy produktów z pliku .csv</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>Układ kolumn: kod produktu; ilość; *cena</span>
                <small class="mt-2 mb-1 d-block">*nieobowiązkowo, pobierana automatycznie</small>
                <input type="file" class="border form-control form-control-sm" name="csv_file" accept=".csv">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Załaduj</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </form>
    </div>
</div>
