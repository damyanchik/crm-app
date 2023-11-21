@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <form method="post" action="/orders/" class="col-md-12 border-right">
                @csrf
                <div class="p-3 py-2">
                    <div class="align-items-center mb-3">
                        <h4>Tworzenie nowego zamówienia</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <span class="labels">Klient</span>
                            <select name="client_id" id="clientSelect" class="form-control" style="width: 100%;"></select>
                            @error('client_id')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-2">
                            <span class="labels">Sprzedawca</span>
                            <input value="{{ Auth::user()->name }} {{ Auth::user()->surname }}" type="text" class="form-control" readonly>
                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                        </div>
                        <div class="col-md-4 mt-2">
                            <span class="labels">Status zamówienia</span>
                            <select name="status" class="form-control" placeholder="test">
                                <option value="" disabled selected>Wybierz status</option>
                                @foreach(app('OrderStatusEnum')->getAllStatuses() as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
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
                                    <input name="newQuantity" value="" placeholder="Wpisz ilość" type="number" class="form-control">
                                    <input name="newUnit" value="" type="number" class="form-control" hidden>
                                </div>
                                <div class="col-6 col-md-4 mt-2">
                                    <span class="labels">Cena <small class="show-price"></small></span>
                                    <input name="newPrice" value="" placeholder="Wpisz cenę" type="number" step="0.01" class="form-control">
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
                        <button id="createOrder" class="btn btn-primary profile-button" type="submit">Utwórz zamówienie</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        var unitsArray = JSON.parse(@json($jsonUnits));
        var ajaxSearchProductsLink = @json(route('ajax.searchProducts'));
        var ajaxSearchClientsLink = @json(route('ajax.searchClients'));
    </script>
    <script src="{{ asset('/js/orders.create/ajax_search_clients.js') }}"></script>
    <script src="{{ asset('/js/orders.create/ajax_search_products.js') }}"></script>
    <script src="{{ asset('/js/orders.create/order_item_list.js') }}"></script>
@endsection
