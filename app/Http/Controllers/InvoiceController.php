<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generateInvoice(Order $order)
    {
        $data = [
            'invoiceNumber' => $order->invoice_num,
            'date' => $order->created_at,
            'clientCompany' => $order->client->company,
            'clientTax' => $order->client->tax,
            'clientAddress' => $order->client->address,
            'clientCityAndPostalCode' => $order->client->postal_code.', '.$order->client->city,
            'clientCountry' => $order->client->country,
            'clientPhone' => $order->client->phone,
            'clientEmail' => $order->client->email,
            'items' => $order->orderItem,
            'totalPrice' => $order->total_price,
            'totalQuantity' => $order->total_quantity,
            'seller' => $order->user->name.' '.$order->user->surname
        ];

        $pdf = Pdf::loadView('pdf.invoice', $data);

        return $pdf->download('invoice.pdf');
    }
}
