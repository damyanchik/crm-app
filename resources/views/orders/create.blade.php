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
                            <input value="{{ Auth::user()->name }} {{ Auth::user()->surname }}" type="text" class="form-control form_readonly__grey" readonly>
                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                        </div>
                        <div class="col-md-4 mt-2">
                            <span class="labels">Status zamówienia</span>
                            <select name="status" class="form-control">
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
                        <div class="col-md-4 mt-2">
                            <span class="labels">Liczba produktów</span>
                            <input name="total_quantity" id="totalQuantity" value="0" type="number" class="form-control form_readonly__grey" readonly>
                        </div>
                        <div class="col-md-4 mt-2">
                            <span class="labels">Cena zamówienia</span>
                            <input name="total_price" id="totalPrice" value="0" type="number" step="0.01" class="form-control form_readonly__grey" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 border border-2 mt-5">
                        <div class="p-3 py-3">
                            <div class="float-end align-items-center experience" {{ (request()->is('orders/create/import')) ? 'hidden' : '' }}>
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
                    <div class="mt-5">
                        <table class="table" id="table-breakpoint">
                            <thead>
                            <tr>
                                <th scope="col">Nr</th>
                                <th scope="col">Produkt</th>
                                <th scope="col">Kod</th>
                                <th scope="col">Ilość</th>
                                <th scope="col">Cena</th>
                                <th scope="col">Suma</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody id="productList">
                                @isset($productsFromCsv)
                                    @forelse($productsFromCsv as $product)
                                        <tr class="product">
                                            <th scope="row" class="productIndex">{{ $loop->index + 1 }}</th>
                                            <td>{{ strtoupper($product['name']) }}</td>
                                            <input name="products[{{ $loop->index }}][name]" value="{{ $product['name'] }}" type="hidden">
                                            <input name="products[{{ $loop->index }}][code]" value="{{ $product['code'] }}" class="product-code" type="hidden">
                                            <td>{{ $product['code'] }}</td>
                                            <td>
                                                {{ $product['quantity'] }} {{ app('ProductUnitEnum')->getUnit($product['unit']) }}
                                                @if(!empty($product['changes']['quantity']))
                                                    <small class="d-block mt-1 flash-message__alert" style="font-size: 12px">
                                                        <i class="fa-solid fa-battery-half" style="cursor: help;" title="Zabrakło {{ $product['changes']['quantity'] - $product['quantity'] }}! Niepełna ilość pozycji w bazie."></i>
                                                        {{ $product['changes']['quantity'] - $product['quantity'] }}
                                                    </small>
                                                @endif
                                            </td>
                                            <input name="products[{{ $loop->index }}][quantity]" class="product-quantity" value="{{ $product['quantity'] }}" type="hidden">
                                            <input name="products[{{ $loop->index }}][unit]" value="{{ $product['unit'] }}" type="hidden">
                                            <td>
                                                {{ $product['price'] }} PLN / {{ app('ProductUnitEnum')->getUnit($product['unit']) }}
                                                @if(!empty($product['changes']['price']))
                                                    <small class="d-block mt-1" style="font-size: 12px">
                                                        @if($product['changes']['price'] > $product['price'])
                                                            <i class="fa-solid fa-turn-up" style="cursor: help;" title="Cena jest niższa niż określona w bazie."></i>
                                                        @else
                                                            <i class="fa-solid fa-turn-down" style="cursor: help" title="Cena jest wyższa niż określona w bazie."></i>
                                                        @endif
                                                        {{ $product['changes']['price'] }} PLN
                                                    </small>
                                                @endif
                                            </td>
                                            <td>{{ $product['price'] * $product['quantity'] }} PLN</td>
                                            <input name="products[{{ $loop->index }}][price]" class="product-price" value="{{ $product['price'] }}" type="hidden">
                                            <input name="products[{{ $loop->index }}][product_price]" value="{{ $product['price'] * $product['quantity'] }}" type="hidden">
                                            <td><button type="button" class="btn btn-danger remove-product">X</button></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Brak produktów do wyświetlenia.</td>
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5 text-center">
                        <button id="createOrder" class="btn btn-primary profile-button" type="submit">Utwórz zamówienie</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="loadProductsModal" tabindex="-1" aria-labelledby="loadProductsModal" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="/orders/create/import" class="modal-content" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="loadProductsModal">Ładowanie listy z produktami</h5>
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
    <script>
        var unitsArray = JSON.parse(@json($jsonUnits));
        var ajaxSearchProductsLink = @json(route('ajax.searchProducts'));
        var ajaxSearchClientsLink = @json(route('ajax.searchClients'));
    </script>
    <script src="{{ asset('/js/orders.create/ajax_search_clients.js') }}"></script>
    <script src="{{ asset('/js/orders.create/ajax_search_products.js') }}"></script>
    <script src="{{ asset('/js/orders.create/order_item_list.js') }}"></script>
@endsection
