@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <form method="post" action="/offers/{{ $offer['id'] }}" class="col-md-12 border-right">
                @csrf
                @method('PUT')
                <div class="p-3 py-2">
                    <div class="align-items-center mb-3">
                        <h4>Edycja oferty o numerze {{ $offer['id'] }}</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <span class="labels">Klient</span>
                            <select name="client_id" id="clientSelect" class="form-control"
                                    style="width: 100%;">
                                @if( $offer['id'] )
                                    <option value="{{ $offer['client_id'] }}" selected>
                                        {{ $offer->client->name.' '.$offer->client->surname.' '.$offer->client->company }}
                                    </option>
                                @endif
                            </select>
                            @error('client_id')
                            <span class="flash-message__alert" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-2">
                            <span class="labels">Wystawiający</span>
                            <input value="{{ $offer->user->name }} {{ $offer->user->surname }}" type="text"
                                   class="form-control form_readonly__grey" readonly>
                            <input name="user_id" type="hidden" value="{{ $offer->user->id }}">
                        </div>
                        <div class="col-md-4 mt-2">
                            <span class="labels">Status</span>
                            <select name="status" class="form-control">
                                <option value="" disabled selected>Wybierz status</option>
                                @foreach(app('OrderStatusEnum')->getAllStatuses() as $id => $name)
                                    @if($id !== 0 && $id !== 1)
                                        @continue
                                    @endif
                                    <option value="{{ $id }}" {{ $offer['status'] == $id ? 'selected' : '' }}>{{ $name }}</option>
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
                            <input name="total_quantity" id="totalQuantity" value="0" type="number"
                                   class="form-control form_readonly__grey" readonly>
                        </div>
                        <div class="col-md-4 mt-2">
                            <span class="labels">Cena zamówienia</span>
                            <input name="total_price" id="totalPrice" value="0" type="number" step="0.01"
                                   class="form-control form_readonly__grey" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 border border-2 mt-5">
                        <div class="p-3 py-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h5 class="text-right">Dodawanie produktów</h5>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8 my-md-3">
                                    <select name="newProduct" id="productSelect" class="form-control"
                                            style="width: 100%;"></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4 mt-2">
                                    <span class="labels">Kod produktu</span>
                                    <input name="newProductCode" id="newProductCode" value="" type="text"
                                           class="form-control form_readonly__grey" readonly>
                                </div>
                                <div class="col-6 col-md-4 mt-2">
                                        <span class="labels">
                                            Ilość
                                            <small class="show-quantity"></small>
                                        </span>
                                    <input name="newQuantity" value="" placeholder="Wpisz ilość" min="0" type="number"
                                           class="form-control">
                                    <input name="newUnit" value="" type="number" class="form-control" hidden>
                                </div>
                                <div class="col-6 col-md-4 mt-2">
                                        <span class="labels">
                                            Cena
                                            <small class="show-price"></small>
                                        </span>
                                    <input name="newPrice" value="" placeholder="Wpisz cenę" type="number" step="0.01"
                                           min="0" class="form-control">
                                </div>
                            </div>
                            <div class="mt-3 mb-2 text-end">
                                <button id="addProduct" class="btn btn-primary profile-button" type="button">Dodaj
                                    produkt
                                </button>
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
                                @forelse($offer->orderItem as $item)
                                    <tr class="product">
                                        <th scope="row" class="productIndex">{{ $loop->index + 1 }}</th>
                                        <td>{{ strtoupper($item['name']) }}</td>
                                        <input name="products[{{ $loop->index }}][name]"
                                               value="{{ $item['name'] }}" type="hidden">
                                        <input name="products[{{ $loop->index }}][code]" value="{{ $item['code'] }}"
                                               class="product-code" type="hidden">
                                        <td>{{ $item['code'] }}</td>
                                        <td>
                                            {{ $item['quantity'] }} {{ app('ProductUnitEnum')->getUnit($item['unit']) }}
                                        </td>
                                        <input name="products[{{ $loop->index }}][quantity]" class="product-quantity"
                                               value="{{ $item['quantity'] }}" type="hidden">
                                        <input name="products[{{ $loop->index }}][unit]" value="{{ $item['unit'] }}"
                                               type="hidden">
                                        <td>
                                            {{ app('PriceHelper')->formatPrice($item['price']) }}
                                            / {{ app('ProductUnitEnum')->getUnit($item['unit']) }}
                                        </td>
                                        <td>{{  app('PriceHelper')->formatPrice($item['price'] * $item['quantity']) }}</td>
                                        <input name="products[{{ $loop->index }}][price]" class="product-price"
                                               value="{{ $item['price'] }}" type="hidden">
                                        <input name="products[{{ $loop->index }}][product_price]"
                                               value="{{ $item['price'] * $item['quantity'] }}" type="hidden">
                                        <td>
                                            <button type="button" class="btn btn-danger remove-product">X</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Brak produktów do wyświetlenia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between mt-5">
                        <div class="d-inline-block">
                            <button id="createOrder" class="btn btn-primary profile-button mb-2 mb-md-0" type="submit">
                                Wprowadź zmiany
                            </button>
                            <a href="/offers" class="btn btn-primary profile-button" type="button">
                                Powrót do listy
                            </a>
                        </div>
                        <div class="d-inline-block">
                            <button class="btn btn-success profile-button mb-2 mb-md-0" type="button" data-bs-toggle="modal" data-bs-target="#makeOrderModal">
                                <i class="fa-regular fa-circle-right me-1"></i>
                                Utwórz zamówienie
                            </button>
                            <button class="btn btn-danger profile-button" type="button" data-bs-toggle="modal" data-bs-target="#deleteOfferModal">
                                <i class="fa-solid fa-trash me-1"></i>
                                Do kosza
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Make Order -->
    <div class="modal fade" id="makeOrderModal" tabindex="-1" aria-labelledby="makeOrderModal" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="/offers/make-order/{{ $offer['id'] }}" class="modal-content">
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

    <!-- Modal Delete Order -->
    <div class="modal fade" id="deleteOfferModal" tabindex="-1" aria-labelledby="deleteOfferModal" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="/offers/{{ $offer['id'] }}" class="modal-content">
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

    <script>
        var unitsArray = JSON.parse(@json($jsonUnits));
        var ajaxSearchProductsLink = @json(route('ajax.searchProducts'));
        var ajaxSearchClientsLink = @json(route('ajax.searchClients'));
    </script>
    <script src="{{ asset('/js/orders.create/ajax_search_clients.js') }}"></script>
    <script src="{{ asset('/js/orders.create/ajax_search_products.js') }}"></script>
    <script src="{{ asset('/js/orders.create/order_item_list.js') }}"></script>
@endsection
