@extends('layout')

@section('content')
    <div class="container rounded bg-white mb-5">
        <div class="row mb-2 mb-md-0 text-center">
            <h3 class="col-12 text-right fw-bold">Zamówienie nr {{ $order['id'] }}</h3>
        </div>
        <div class="row">
            <div class="col-md-6 border-right">
                <div class="p-md-3 py-md-5">
                    <div class="row">
                        <h5 class="text fw-bold">Dane zamawiającego</h5>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <span class="labels">Imię</span>
                            <p class="small text-muted mb-1 my-2">{{ $order->client->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <span class="labels">Nazwisko</span>
                            <p class="small text-muted mb-1 my-2">{{ $order->client->surname }}</p>
                        </div>
                        <div class="col-md-6">
                            <span class="labels">Email</span>
                            <p class="small text-muted mb-1 my-2">{{ $order->client->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <span class="labels">Numer telefonu</span>
                            <p class="small text-muted mb-1 my-2">{{ $order->client->phone }} &nbsp;</p>
                        </div>
                        <div class="col-md-6">
                            <span class="labels">Adres zamieszkania</span>
                            <p class="small text-muted mb-1 my-2">{{ $order->client->address }} &nbsp;</p>
                        </div>
                        <div class="col-md-6">
                            <span class="labels">Kod pocztowy</span>
                            <p class="small text-muted mb-1 my-2">{{ $order->client->postal_code }} &nbsp;</p>
                        </div>
                        <div class="col-md-6">
                            <span class="labels">Miasto</span>
                            <p class="small text-muted mb-1 my-2">{{ $order->client->city }} &nbsp;</p>
                        </div>
                        <div class="col-md-6">
                            <span class="labels">Województwo</span>
                            <p class="small text-muted mb-1 my-2">{{ $order->client->state }} &nbsp;</p>
                        </div>
                        <div class="col-md-6">
                            <span class="labels">Kraj</span>
                            <p class="small text-muted mb-1 my-2">{{ $order->client->country }} &nbsp;</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <h5 class="col-12 text fw-bold">Obsługujący zamówienie</h5>
                            <p>
                                {{ $order->user->name.' '.$order->user->surname }}
                            </p>
                        </div>
                        <div class="col-6">
                            <h5 class="col-12 text fw-bold">Status zamówienia</h5>
                            <p>{{ app('statusHelper')->getOrderStatus($order->status)  }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-md-3 py-1 py-md-5">
                    <div class="col-md-12">
                        <h5 class="mb-2 fw-bold">Zamówione produkty</h5>
                        <div class="companyServe overflow-auto border border-2 p-1" style="height: 30rem; overflow-x: hidden !important; overflow-y: auto !important;">
                            @foreach($order->orderItem as $item)
                                <div class="border company-link my-1">
                                    <p class="name-and-brand pt-2 px-2">
                                        {{ $item['name'].' '.$item['brand'] }}
                                    </p>
                                    <div class="row pb-2 px-2">
                                        <div class="col-4 small">
                                            <span class="d-block fw-bold">Cena</span>
                                            {{ $item['price'].' PLN / '.app('unitHelper')->getProductUnit($item['unit']) }}
                                        </div>
                                        <div class="col-4 small">
                                            <span class="d-block fw-bold">Ilość</span>
                                            {{ $item['quantity'].' '.app('unitHelper')->getProductUnit($item['unit']) }}
                                        </div>
                                        <div class="col-4 small">
                                            <span class="d-block fw-bold">SUMA</span>
                                            {{ $item['product_price'].' PLN'}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input name="searchCompany" type="text" class="form-control mt-2 border-2" placeholder="Szukaj..." id="searchCompanyInput">
                    </div>
                </div>
            </div>
            <div class="mt-5 text-center">
                <a href="/orders" class="btn btn-primary profile-button" type="button">Powrót do listy</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/orders.show/search_order_item.js') }}"></script>
@endsection
