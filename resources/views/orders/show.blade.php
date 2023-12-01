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
                            <span class="badge rounded-pill bg-{{ app('OrderStatusEnum')->getStatusColor($order['status']) }}">
                                {{ app('OrderStatusEnum')->getStatus($order['status']) }}
                            </span>
                        </div>
                        <div class="col-12">
                            <div class="mt-3">
                                <a href="/invoice/{{ $order['id'] }}" class="btn btn-primary profile-button
                                @if (in_array($order['status'], [app('OrderStatusEnum')::PENDING['id'], app('OrderStatusEnum')::REJECTED['id']]))
                                    disabled
                                @endif
                                 " type="button">Faktura</a>
                            </div>
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
                                    <p class="name-and-brand pt-2 p-1 px-3">
                                        {{ strtoupper($item['name'].' '.$item['brand']) }}
                                        <a href="/products?search={{ $item['code'] }}&display=15&column=&order=" class="float-e link-offset-2 link-underline link-underline-opacity-0" target="_blank">
                                            <small class="text-muted">({{ $item['code'] }})</small>
                                        </a>
                                    </p>
                                    <div class="row pb-2 px-2">
                                        <div class="col-4 text-center small">
                                            <span class="d-block fw-bold">
                                                <i class="fa-regular fa-money-bill-1"></i>
                                            </span>
                                            {{ $item['price'].' PLN / '.app('ProductUnitEnum')->getUnit($item['unit']) }}
                                        </div>
                                        <div class="col-4 text-center small">
                                            <span class="d-block fw-bold">
                                                <i class="fa-solid fa-cubes"></i>
                                            </span>
                                            {{ $item['quantity'].' '.app('ProductUnitEnum')->getUnit($item['unit']) }}
                                        </div>
                                        <div class="col-4 text-center small">
                                            <span class="d-block fw-bold">
                                                <i class="fa-solid fa-equals"></i>
                                            </span>
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
            <div class="d-flex justify-content-between mt-5">
                <div class="d-inline-block">
                    <a
                        @if (in_array($order['status'], [app('OrderStatusEnum')::PENDING['id'], app('OrderStatusEnum')::READY['id']]))
                            href="/orders"
                        @elseif(in_array($order['status'], [app('OrderStatusEnum')::CLOSED['id'], app('OrderStatusEnum')::REJECTED['id']]))
                            href="/orders/archive"
                        @endif
                        class="btn btn-primary profile-button" type="button">Powrót do listy</a>
                </div>
                @if (in_array($order['status'], [app('OrderStatusEnum')::PENDING['id']]))
                    <div class="d-inline-block">
                        <button class="btn btn-success profile-button mb-2 mb-md-0" type="button" data-bs-toggle="modal" data-bs-target="#readyOrderModal">
                            <i class="fa-regular fa-circle-right me-1"></i>
                            Zamówienie gotowe
                        </button>
                        <button class="btn btn-danger profile-button" type="button" data-bs-toggle="modal" data-bs-target="#rejectOrderModal">
                            <i class="fa-solid fa-trash me-1"></i>
                            Odrzuć zamówienie
                        </button>
                    </div>
                @elseif(in_array($order['status'], [app('OrderStatusEnum')::READY['id']]))
                    <div class="d-inline-block">
                        <button class="btn btn-success profile-button mb-2 mb-md-0" type="button" data-bs-toggle="modal" data-bs-target="#closeOrderModal">
                            <i class="fa-regular fa-circle-right me-1"></i>
                            Zamknij zamówienie
                        </button>
                        <button class="btn btn-danger profile-button" type="button" data-bs-toggle="modal" data-bs-target="#rejectOrderModal">
                            <i class="fa-solid fa-trash me-1"></i>
                            Odrzuć zamówienie
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if (in_array($order['status'], [app('OrderStatusEnum')::PENDING['id']]))
    <!-- Modal Ready Order -->
    <div class="modal fade" id="readyOrderModal" tabindex="-1" aria-labelledby="readyOrderModal" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="/orders/{{ $order['id'] }}/ready" class="modal-content">
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
    @elseif(in_array($order['status'], [app('OrderStatusEnum')::READY['id']]))
        <!-- Modal Close Order -->
        <div class="modal fade" id="closeOrderModal" tabindex="-1" aria-labelledby="closeOrderModal" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="/orders/{{ $order['id'] }}/close" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="closeOrderModal">Zamknięcie zamówienia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span>Czy potwierdzasz zamknięcie zamówienia o nr {{ $order['invoice_num'] }}?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Potwierdź</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <!-- Modal Reject Order -->
    <div class="modal fade" id="rejectOrderModal" tabindex="-1" aria-labelledby="rejectOrderModal" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="/orders/{{ $order['id'] }}/reject" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectOrderModal">Odrzucanie zamówienia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Czy chcesz zamknąć i odrzucić zamówienie o nr {{ $order['invoice_num'] }}?</span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Odrzuć</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('/js/orders.show/search_order_item.js') }}"></script>
@endsection
