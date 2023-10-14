<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'brand_id' => 'required',
            'category_id' => 'nullable',
            'quantity' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'status' => 'required',
            'description' => 'nullable'
        ];
    }
}
