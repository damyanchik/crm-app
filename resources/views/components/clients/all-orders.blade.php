<div class="col-md-6">
    <div class="p-3 py-1 py-md-5">
        <div class="col-md-12">
            <label class="labels mb-2">Lista wszystkich zamówień</label>
            <div class="companyServe overflow-auto border border-2 p-2" style="height: 30rem">
                @foreach($orders as $order)
                    <div class="p-1 border m-1 invoice-link">
                        <a href="{{ empty($order['invoice_num']) ? route('offers') : route('showOrder', $order['id']) }}" class="btn">
                            <i class="fa-solid fa-magnifying-glass me-2" style="font-size: 11px"></i>
                            {{ $order['invoice_num'] ?? 'Niewystawione' }}
                        </a>
                        <span class="m-1 p-1 float-end">{{ app('OrderStatusEnum')->getStatus($order['status']) }}</span>
                    </div>
                @endforeach
            </div>
            <input name="searchCompany" type="text" class="form-control mt-2 border-2" placeholder="Szukaj..." id="searchInvoices">
        </div>
    </div>
</div>
