<div class="col-md-12 border border-2 mt-5">
    <div class="p-3 py-3">
        <div class="float-end align-items-center experience">
            <button type="button" class="btn btn-primary border px-3 p-1" data-bs-toggle="modal" data-bs-target="#loadProductsModal">
                <i class="fa fa-plus"></i>&nbsp;
                Załaduj listę produktów
            </button>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-1">
            <h5 class="text-right">Dodawanie produktów</h5>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 my-md-3">
                <select name="newProduct" id="productSelect" class="form-control" style="width: 100%;"></select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mt-2">
                <span class="labels">Kod produktu</span>
                <input name="newProductCode" id="newProductCode" value="" type="text" class="form-control form_readonly__grey" readonly>
            </div>
            <div class="col-6 col-md-4 mt-2">
                <span class="labels">Ilość <small class="show-quantity"></small></span>
                <input name="newQuantity" value="" placeholder="Wpisz ilość" min="0" type="number" class="form-control">
                <input name="newUnit" value="" type="number" class="form-control" hidden>
            </div>
            <div class="col-6 col-md-4 mt-2">
                <span class="labels">Cena <small class="show-price"></small></span>
                <input name="newPrice" value="" placeholder="Wpisz cenę" type="number" step="0.01" min="0" class="form-control">
            </div>
        </div>
        <div class="mt-3 mb-2 text-end">
            <button id="addProduct" class="btn btn-primary profile-button" type="button">Dodaj produkt</button>
        </div>
    </div>
</div>
