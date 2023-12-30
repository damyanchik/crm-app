<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductListController extends Controller
{
    public function generateProductList(Order $order): object
    {
        $companyInfo = CompanyInfo::all()->first();

        $pdf = Pdf::loadView('pdf.product_list', $this->setData($order, $companyInfo));

        return $pdf->download('offer_'.$order->id.'.pdf');
    }

    private function setData($order, $companyInfo): array
    {
        return [
            'offerNumber' => $order->id,
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
    }
}
