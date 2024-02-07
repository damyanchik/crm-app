<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiveChatPusherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => 'string',
            'name' => 'string',
            'time' => 'string',
            'avatar' => 'string',
        ];
    }
}
