<div class="d-flex justify-content-between mt-5">
    <div class="d-inline-block">
        <a
            @if (in_array($order['status'], [app('OrderStatusEnum')::PENDING['id'], app('OrderStatusEnum')::READY['id']]))
                href="{{ route('orders') }}"
            @elseif(in_array($order['status'], [app('OrderStatusEnum')::CLOSED['id'], app('OrderStatusEnum')::REJECTED['id']]))
                href="{{ route('orderArchives') }}"
            @endif
            class="btn btn-primary profile-button" type="button">Powrót do listy</a>
    </div>
    @if (in_array($order['status'], [app('OrderStatusEnum')::PENDING['id']]))
        <div class="d-inline-block">
            @can('readyOrder')
                <button class="btn btn-success profile-button mb-2 mb-md-0" type="button" data-bs-toggle="modal" data-bs-target="#readyOrderModal">
                    <i class="fa-regular fa-circle-right me-1"></i>
                    Zamówienie gotowe
                </button>
            @endcan
            @can('rejectOrder')
                <button class="btn btn-danger profile-button" type="button" data-bs-toggle="modal" data-bs-target="#rejectOrderModal">
                    <i class="fa-solid fa-trash me-1"></i>
                    Odrzuć zamówienie
                </button>
            @endcan
        </div>
    @elseif(in_array($order['status'], [app('OrderStatusEnum')::READY['id']]))
        <div class="d-inline-block">
            @can('closeOrder')
                <button class="btn btn-success profile-button mb-2 mb-md-0" type="button" data-bs-toggle="modal" data-bs-target="#closeOrderModal">
                    <i class="fa-regular fa-circle-right me-1"></i>
                    Zamknij zamówienie
                </button>
            @endcan
            @can('rejectOrder')
                <button class="btn btn-danger profile-button" type="button" data-bs-toggle="modal" data-bs-target="#rejectOrderModal">
                    <i class="fa-solid fa-trash me-1"></i>
                    Odrzuć zamówienie
                </button>
            @endcan
        </div>
    @endif
</div>
