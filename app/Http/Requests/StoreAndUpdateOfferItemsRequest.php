<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAndUpdateOfferItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'products.*.name' => 'required|string|filled',
            'products.*.code' => 'required|string|filled',
            'products.*.unit' => 'required|integer|filled',
            'products.*.quantity' => 'required|numeric|filled',
            'products.*.price' => 'required|numeric|filled',
            'products.*.product_price' => 'required|numeric|filled'
        ];
    }
}
