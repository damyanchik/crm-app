@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row">
            <form method="post" action="{{ route('updateOffer', $offer['id']) }}" class="col-md-12 border-right">
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
                                @if($offer['id'])
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
                                    @if($id !== \App\Enum\OrderStatusEnum::OFFER['id'] && $id !== \App\Enum\OrderStatusEnum::ACCEPTED['id'])
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
                    <x-orders.add-product :buttonClass="'disabled'" />
                    <x-orders.products-data-table :products="$offer->orderItem" />
                    <a href="{{ route('generateProductList', $offer['id']) }}" class="btn btn-primary profile-button">Oferta</a>
                    @include('partials.orders._offer-down-buttons')
                </div>
            </form>
        </div>
    </div>

    @include('partials.orders._make-order-modal')
    @include('partials.orders._delete-offer-modal')
    <script>
        var unitsArray = JSON.parse(@json($jsonUnits));
        var ajaxSearchProductsLink = @json(route('ajax.searchProducts'));
        var ajaxSearchClientsLink = @json(route('ajax.searchClients'));
    </script>
    <script src="{{ asset('/js/orders.create/ajax_search_clients.js') }}"></script>
    <script src="{{ asset('/js/orders.create/ajax_search_products.js') }}"></script>
    <script src="{{ asset('/js/orders.create/order_item_list.js') }}"></script>
@endsection
