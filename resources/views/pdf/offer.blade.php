<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            font-family: DejaVu Sans;
            margin: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        #invoice {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        #invoice, #invoice th, #invoice td {
            border: 1px solid #ddd;
        }

        #invoice th, #invoice td {
            padding: 10px;
            text-align: left;
        }

        #invoice th {
            background-color: #f2f2f2;
        }

        .details {
            margin-bottom: 20px;
        }

        .details, .details p {
            margin: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Oferta nr {{ $order['id'] }}</h1>
    <small>{{ $order['created_at'] }}</small>
</header>

<div class="details small text-end">
    <h3>Dostawca</h3>
    <p>{{ $company->company }}</p>
    <p>{{ $company->tax }}</p>
    <p>{{ $company->address }}</p>
    <p>{{ $company->postal_code .' '. $company->city }}</p>
    <p>{{ $company->country }}</p>
    <p>{{ $company->phone }}</p>
    <p>{{ $company->email }}</p>
</div>
<div class="details small text-start mb-3">
    <h3>Odbiorca</h3>
    <p>{{ $order->client->company }}</p>
    <p>{{ $order->client->tax }}</p>
    <p>{{ $order->client->address }}</p>
    <p>{{ $order->client->postal_code .' '. $order->client->city }}</p>
    <p>{{ $order->client->country }}</p>
    <p>{{ $order->client->phone }}</p>
    <p>{{ $order->client->email }}</p>
</div>

<table id="invoice" class="small">
    <thead>
    <tr>
        <th>Produkt</th>
        <th>Ilość</th>
        <th>Cena</th>
        <th>Suma</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->orderItem as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->quantity.' '.app('ProductUnitEnum')->getUnit($item->unit) }}</td>
            <td>{{ app('PriceHelper')->formatPrice($item->price) }}</td>
            <td>{{ app('PriceHelper')->formatPrice($item->product_price) }}</td>
        </tr>
    @endforeach

    </tbody>
    <tfoot>
    <tr>
        <td colspan="3" class="text-end" style="border: none; font-size: 12px; font-weight: bold;">RAZEM PRODUKTÓW</td>
        <td colspan="1" class="text-end"
            style="border: none; font-size: 12px; font-weight: bold;">{{ $order->total_quantity }}</td>
    </tr>
    <tr>
        <td colspan="3" class="text-end" style="border: none; font-size: 12px; font-weight: bold;">SUMA ZAMÓWIENIA</td>
        <td colspan="1" class="text-end"
            style="border: none; font-size: 12px; font-weight: bold;">{{ app('PriceHelper')->formatPrice($order->total_price) }}</td>
    </tr>
    </tfoot>
</table>
<div class="text-end pe-3 mt-4">
    <span style="font-size: 14px;">Oferujący</span><br/>
    <span style="font-weight: bold; font-size: 14px">{{ $order->user->name .' '. $order->user->surname }}</span>
</div>
</body>
</html>
