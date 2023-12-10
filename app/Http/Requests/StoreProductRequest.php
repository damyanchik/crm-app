<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('products')->where(function ($query) {
                }),
            ],
            'code' => [
                'required',
                Rule::unique('products')->where(function ($query) {
                }),
            ],
            'brand_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'unit' => 'required|integer',
            'status' => 'required|integer',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:5120|dimensions:min_width=200,min_height=200,max_width=800,max_height=800'
        ];
    }
}
