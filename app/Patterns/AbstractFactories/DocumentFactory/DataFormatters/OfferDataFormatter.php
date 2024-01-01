<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\DocumentFactory\DataFormatters;

use App\Models\CompanyInfo;

class OfferDataFormatter implements DataFormatterInterface
{
    public function prepareData(object $data): array
    {
        return [
            'offerNumber' => $data->id,
            'date' => $data->updated_at,

            'CRMCompany' => $this->getCompanyDetails()->company,
            'CRMTax' => $this->getCompanyDetails()->tax,
            'CRMAddress' => $this->getCompanyDetails()->address,
            'CRMCityAndPostalCode' => $this->getCompanyDetails()->postal_code.', '.$this->getCompanyDetails()->city,
            'CRMCountry' => $this->getCompanyDetails()->country,
            'CRMPhone' => $this->getCompanyDetails()->phone,
            'CRMEmail' => $this->getCompanyDetails()->email,

            'clientCompany' => $data->client->company,
            'clientTax' => $data->client->tax,
            'clientAddress' => $data->client->address,
            'clientCityAndPostalCode' => $data->client->postal_code.', '.$data->client->city,
            'clientCountry' => $data->client->country,
            'clientPhone' => $data->client->phone,
            'clientEmail' => $data->client->email,

            'items' => $data->orderItem,

            'totalPrice' => $data->total_price,
            'totalQuantity' => $data->total_quantity,

            'seller' => $data->user->name.' '.$data->user->surname
        ];
    }

    private function getCompanyDetails(): CompanyInfo
    {
        return CompanyInfo::all()->first();
    }
}
