<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdersItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'products.*.name' => 'required',
            'products.*.code' => 'nullable',
            'products.*.unit' => 'required',
            'products.*.quantity' => 'required',
            'products.*.price' => 'required',
            'products.*.product_price' => 'required'
        ];
    }
}
