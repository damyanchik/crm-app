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
                    <a href="{{ route('generateInvoice') }}" class="btn btn-primary profile-button
                       @if (in_array($order['status'], [app('OrderStatusEnum')::PENDING['id'], app('OrderStatusEnum')::REJECTED['id']]))
                            disabled
                       @endif
                    ">Faktura</a>
                </div>
            </div>
        </div>
    </div>
</div>
