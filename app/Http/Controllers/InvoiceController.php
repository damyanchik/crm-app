<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\OrderStatusEnum;
use App\Models\CompanyInfo;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generateInvoice(Order $order): object
    {
        if (!in_array($order->status, [
                OrderStatusEnum::READY['id'],
                OrderStatusEnum::CLOSED['id']
            ]))
            return back()->with(
                'message', 'Błąd w generowaniu faktury, spróbuj ponownie.'
            );

        $companyInfo = CompanyInfo::all()->first();

        $data = [
            'invoiceNumber' => $order->invoice_num,
            'date' => $order->updated_at,

            'CRMCompany' => $companyInfo->company,
            'CRMTax' => $companyInfo->tax,
            'CRMAddress' => $companyInfo->address,
            'CRMCityAndPostalCode' => $companyInfo->postal_code.', '.$companyInfo->city,
            'CRMCountry' => $companyInfo->country,
            'CRMPhone' => $companyInfo->phone,
            'CRMEmail' => $companyInfo->email,

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

        return $pdf->download('invoice_'.$order->invoice_num.'.pdf');
    }
}
