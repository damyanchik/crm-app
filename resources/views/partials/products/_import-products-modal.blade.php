<div class="modal fade" id="addProductsModal" tabindex="-1" aria-labelledby="addProductsModal" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{ route('importNewProduct') }}" class="modal-content" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="addProductsModal">Dodawanie nowych produktów z pliku .csv</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="d-block">Układ kolumn: nazwa produktu; kod produktu; ilość; jednostka*; cena, marka**; kategoria produktowa**</span>
                <span class="d-block">W przypadku braku marki bądź kategorii produktowej zostanie utworzona nowa.</span>
                <small class="mt-2 mb-1 d-block">*należy podać numer: 1 - sztuki, 2 - komplety</small>
                <small class="d-block">**zaznaczone pozycje można pominąć</small>
                <input type="file" class="border form-control form-control-sm mt-2" name="csv_file" accept=".csv">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Załaduj</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="updateProductsModal" tabindex="-1" aria-labelledby="updateProductsModal" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{ route('importUpdateProduct') }}" class="modal-content" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="updateProductsModal">Aktualizacja nowych produktów z pliku .csv</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="d-block">Układ kolumn: kod produktu; ilość; cena</span>
                <input type="file" class="border form-control form-control-sm mt-2" name="csv_file" accept=".csv">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Załaduj</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
            </div>
        </form>
    </div>
</div>
