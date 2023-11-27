<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            //'code' => 'required',
            'brand_id' => 'nullable',
            'category_id' => 'nullable',
            'quantity' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'status' => 'required',
            'description' => 'nullable',
            'photo' => 'nullable|image|max:5120|dimensions:min_width=200,min_height=200,max_width=800,max_height=800'
        ];
    }
}
