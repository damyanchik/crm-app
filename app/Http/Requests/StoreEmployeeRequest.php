<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'password' => 'required|min:8|confirmed',
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => 'nullable',
            'address' => 'nullable',
            'postal_code' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'position' => 'nullable',
            'department' => 'nullable',
            'avatar' => 'nullable|image|max:5120|dimensions:min_width=200,min_height=200,max_width=800,max_height=800'
        ];
    }
}
