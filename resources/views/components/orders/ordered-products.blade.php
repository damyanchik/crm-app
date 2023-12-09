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
                                {{ app('PriceHelper')->formatPrice($item['price']).' / '.app('ProductUnitEnum')->getUnit($item['unit']) }}
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
                                {{ app('PriceHelper')->formatPrice($item['product_price']) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <input name="searchCompany" type="text" class="form-control mt-2 border-2" placeholder="Szukaj..." id="searchCompanyInput">
        </div>
    </div>
</div>
