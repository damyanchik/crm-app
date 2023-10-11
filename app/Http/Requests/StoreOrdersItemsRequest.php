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
            'user_id' => 'required',
            'client_id' => 'required',
            'status' => 'required',
            'invoice_num' => 'required',
            'total_quantity' => 'required',
            'total_price' => 'required'
        ];
    }
}
