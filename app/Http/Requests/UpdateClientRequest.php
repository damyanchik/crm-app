<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email'],
            'phone' => 'required',
            'address' => 'nullable',
            'postal_code' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'tax' => 'required',
            'user_id' => 'nullable|exists:users,id'
        ];
    }
}
