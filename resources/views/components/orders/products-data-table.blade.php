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
        @isset($products)
            @forelse($products as $product)
                <tr class="product">
                    <th scope="row" class="productIndex">{{ $loop->index + 1 }}</th>
                    <td>{{ strtoupper($product['name'].' '.$product['brand']) }}</td>
                    <input name="products[{{ $loop->index }}][name]"
                           value="{{ $product['name'].' '.$product['brand'] }}"
                           type="hidden">
                    <input name="products[{{ $loop->index }}][code]" value="{{ $product['code'] }}" class="product-code"
                           type="hidden">
                    <td>{{ $product['code'] }}</td>
                    <td>
                        {{ $product['quantity'] }} {{ app('ProductUnitEnum')->getUnit($product['unit']) }}
                        @if(!empty($product['changes']['quantity']))
                            <small class="d-block mt-1 flash-message__alert" style="font-size: 12px">
                                <i class="fa-solid fa-battery-half" style="cursor: help;"
                                   title="Zabrakło {{ $product['changes']['quantity'] - $product['quantity'] }}! Niepełna ilość pozycji w bazie."></i>
                                {{ $product['changes']['quantity'] - $product['quantity'] }}
                            </small>
                        @endif
                    </td>
                    <input name="products[{{ $loop->index }}][quantity]" class="product-quantity"
                           value="{{ $product['quantity'] }}" type="hidden">
                    <input name="products[{{ $loop->index }}][unit]" value="{{ $product['unit'] }}" type="hidden">
                    <td>
                        {{ app('PriceHelper')->formatPrice($product['price']) }}
                        / {{ app('ProductUnitEnum')->getUnit($product['unit']) }}
                        @if(!empty($product['changes']['price']))
                            <small class="d-block mt-1" style="font-size: 12px">
                                @if($product['changes']['price'] > $product['price'])
                                    <i class="fa-solid fa-turn-up" style="cursor: help;"
                                       title="Cena jest niższa niż określona w bazie."></i>
                                @else
                                    <i class="fa-solid fa-turn-down" style="cursor: help"
                                       title="Cena jest wyższa niż określona w bazie."></i>
                                @endif
                                {{ app('PriceHelper')->formatPrice($product['changes']['price']) }}
                            </small>
                        @endif
                    </td>
                    <td>
                        {{ app('PriceHelper')->formatPrice($product['price'] * $product['quantity']) }}
                        <input name="products[{{ $loop->index }}][price]" class="product-price"
                               value="{{ $product['price'] }}" type="hidden">
                        <input name="products[{{ $loop->index }}][product_price]"
                               value="{{ $product['price'] * $product['quantity'] }}" type="hidden">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-product">X</button>
                    </td>
                </tr>
            @empty
            @endforelse
        @endif
        </tbody>
    </table>
</div>
