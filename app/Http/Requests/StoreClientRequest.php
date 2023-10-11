<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company' => ['required', Rule::unique('client', 'company')],
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required',
            'address' => 'nullable',
            'postal_code' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'note'=> 'nullable',
            'tax' => 'required'
        ];
    }
}
