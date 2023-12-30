<div class="col-md-6 border-right">
    <div class="p-md-3 py-md-5">
        <div class="row">
            <h5 class="text fw-bold">Dane zamawiającego</h5>
        </div>
        <x-client-detail :client="$order->client" />
        <div class="row mt-2">
            <small>Utworzenie oferty: {{ $order['created_at'] }}</small>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <h5 class="col-12 text fw-bold">Obsługujący zamówienie</h5>
                <p>
                    <a href="{{ route('showEmployee', $order['user_id']) }}" style=" text-decoration: none !important;">
                        <i class="fa-solid fa-user" style="color: grey; font-size: 14px;"></i>
                    </a>
                    {{ $order->user->name.' '.$order->user->surname }}
                </p>
            </div>
            <div class="col-6">
                <h5 class="col-12 text fw-bold">Status zamówienia</h5>
                <span class="badge rounded-pill bg-{{ app('OrderStatusEnum')->getStatusColor($order['status']) }}">
                    {{ app('OrderStatusEnum')->getStatus($order['status']) }}
                </span>
            </div>
            <div class="col-12 mb-3 mb-md-0">
                <div class="mt-3">
                    <a href="{{ route('generateInvoice', $order['id']) }}" class="btn btn-primary profile-button
                       @if (in_array($order['status'], [app('OrderStatusEnum')::PENDING['id'], app('OrderStatusEnum')::REJECTED['id']]))
                            disabled
                       @endif
                    ">Faktura</a>
                    <a href="{{ route('generateProductList', $order['id']) }}" class="btn btn-primary profile-button">Lista produktów</a>
                </div>
            </div>
        </div>
    </div>
</div>
