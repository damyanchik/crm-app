@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <form method="post" action="/orders/" class="col-md-12 border-right">
                @csrf
                <div class="p-3 py-2">
                    <div class="align-items-center mb-3">
                        <h4>Tworzenie nowego zamówienia</h4>
                        <p>Należy uzupełnić pola zaznaczone gwiazdką*</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <span class="labels">Klient*</span>
                            <select name="client_id" id="clientSelect" class="form-control" style="width: 100%;"></select>
                        </div>
                        <div class="col-md-12 mt-2">
                            <span class="labels">Sprzedawca</span>
                            <input value="{{ Auth::user()->name }} {{ Auth::user()->surname }}" type="text" class="form-control" readonly>
                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                        </div>
                        <div class="col-md-4 mt-2">
                            <span class="labels">Status zamówienia*</span>
                            <select name="status" class="form-control">
                                @foreach(app('statusHelper')->getAllOrderStatuses() as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-2"><span class="labels">Liczba produktów</span>
                            <input name="total_quantity" id="totalQuantity" value="0" type="number" class="form-control" readonly>
                        </div>
                        <div class="col-md-4 mt-2">
                            <span class="labels">Cena zamówienia</span>
                            <input name="total_price" id="totalPrice" value="0" type="number" step="0.01" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 border border-2 mt-5">
                        <div class="p-3 py-3">
                            <div class="float-end align-items-center experience">
                                <a href="#" class="btn border px-3 p-1 add-experience">
                                    <i class="fa fa-plus"></i>&nbsp;
                                    Załaduj listę produktów
                                </a>
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
                                    <input name="newProductCode" value="" type="text" class="form-control" readonly>
                                </div>
                                <div class="col-6 col-md-4 mt-2">
                                    <span class="labels">Ilość <small class="show-quantity"></small></span>
                                    <input name="newQuantity" value="" type="number" class="form-control">
                                    <input name="newUnit" value="" type="number" class="form-control" hidden>
                                </div>
                                <div class="col-6 col-md-4 mt-2">
                                    <span class="labels">Cena</span>
                                    <input name="newPrice" value="" type="number" step="0.01" class="form-control">
                                </div>
                            </div>
                                <div class="mt-3 mb-2 text-end">
                                    <button id="addProduct" class="btn btn-primary profile-button" type="button">Dodaj produkt</button>
                                </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Pozycja</th>
                                <th scope="col">Nazwa produktu</th>
                                <th scope="col">Ilość produktu</th>
                                <th scope="col">Cena jednostkowa</th>
                                <th scope="col">Suma</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody id="productList"></tbody>
                        </table>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Utwórz zamówienie</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('#clientSelect').select2({
            language: {
                inputTooShort: function(args) {
                    return "Wprowadź minimum 3 znaki.";
                }
            },
            ajax: {
                url: '{{ route('ajax.searchClients') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function (data) {
                    var options = data.clients.map(function (client) {
                        return '<option value="' + client.id + '">' + client.company + ' ' + client.name + ' ' + client.surname + '</option>';
                    });

                    $('#clientSelect').html(options.join(''));

                    return {
                        results: data.clients.map(function (client) {
                            return {
                                id: client.id,
                                text: client.company + ' ' + client.name + ' ' + client.surname
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 3,
            placeholder: 'Wybierz klienta',
            allowClear: true
        });
    </script>
    <script>
        var unitsArray = JSON.parse(@json($jsonUnits));

        $('#productSelect').select2({
            language: {
                inputTooShort: function(args) {
                    return "Wprowadź minimum 3 znaki.";
                }
            },

            ajax: {
                url: '{{ route('ajax.searchProducts') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function (data) {
                    var options = data.products.map(function (product) {
                        var displayName = product.name;
                        if (product.brand && product.brand.name) {
                            displayName += ' ' + product.brand.name;
                        }
                        return '<option value="">' + displayName + '</option>';
                    });

                    $('#productSelect').html(options.join(''));

                    return {
                        results: data.products.map(function (product) {
                            var displayName = product.name;
                            if (product.brand && product.brand.name) {
                                displayName += ' ' + product.brand.name;
                            }
                            return {
                                id: product.id,
                                text: displayName,
                                code: product.code,
                                quantity: product.quantity,
                                price: product.price,
                                unit: product.unit
                            };
                        })
                    };
                },
                cache: true
            },

            minimumInputLength: 3,
            placeholder: 'Wybierz produkt',
            allowClear: true
        });

        $('#productSelect').on('select2:select', function (e) {
            var selectedOption = e.params.data;

            $("input[name='newQuantity']").val(selectedOption.quantity);
            $("input[name='newPrice']").val(selectedOption.price);
            $("input[name='newProductCode']").val(selectedOption.code);
            $(".show-quantity").text('(Dostępne '+ selectedOption.quantity +' '+ unitsArray[selectedOption.unit] +')');
            $("input[name='newUnit']").val(selectedOption.unit);
        });

        let productCount = 1;

        function updateProductNumbers() {
            let totalQuantity = 0;
            let totalPrice = 0;

            $(".product").each(function (index) {
                const quantity = parseInt($(this).find(".product-quantity").val(), 10);
                const price = parseFloat($(this).find(".product-price").val());

                totalQuantity += quantity;
                totalPrice += price * quantity;

                $(this).find(".productIndex").text(index + 1);
            });

            $("#totalQuantity").val(totalQuantity);
            $("#totalPrice").val(totalPrice.toFixed(2)); // Zaokrąglamy cenę do dwóch miejsc po przecinku
        }

        $("#addProduct").click(function () {

                const newProduct = $("select[name='newProduct']").find(":selected").text();
                const newProductCode = $("input[name='newProductCode']").val();
                const newUnit = $("input[name='newUnit']").val();
                const newQuantity = $("input[name='newQuantity']").val();
                const newPrice = $("input[name='newPrice']").val();
                const newTotalPrice = newQuantity * newPrice;

                const productDiv = `
                            <tr class="product">
                                <th scope="row" class="productIndex">${productCount}</th>
                                <td>${newProduct}</td>
                                <input name="products[${productCount}][name]" value="${newProduct}" type="hidden">
                                <input name="products[${productCount}][code]" value="${newProductCode}" type="hidden">
                                <td>${newQuantity} ${unitsArray[newUnit]}</td>
                                <input name="products[${productCount}][quantity]" class="product-quantity" value="${newQuantity}" type="hidden">
                                <input name="products[${productCount}][unit]" value="${newUnit}" type="hidden">
                                <td>${newPrice} PLN / ${unitsArray[newUnit]}</td>
                                <td>${newTotalPrice} PLN</td>
                                <input name="products[${productCount}][price]" class="product-price" value="${newPrice}" type="hidden">
                                <input name="products[${productCount}][product_price]" value="${newTotalPrice}" type="hidden">

                                <td><button type="button" class="btn btn-danger remove-product">X</button></td>
                            </tr>`;

                $("select[name='newProduct']").val('');
                $("select[name='newProduct']").trigger('change');

                $("input[name='newProductCode']").val('');
                $("input[name='newUnit']").val('');
                $("input[name='newQuantity']").val('');
                $("input[name='newPrice']").val('');

                productCount++

                $("#productList").append(productDiv);
            updateProductNumbers();
        });

        $(document).on("click", ".remove-product", function () {
            $(this).closest(".product").remove();

            updateProductNumbers();
        });
    </script>
@endsection
