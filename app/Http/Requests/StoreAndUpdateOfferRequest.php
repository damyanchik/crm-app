<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAndUpdateOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'client_id' => 'required|integer',
            'status' => 'required|integer',
            'total_quantity' => 'required|numeric',
            'total_price' => 'required|numeric'
        ];
    }
}
