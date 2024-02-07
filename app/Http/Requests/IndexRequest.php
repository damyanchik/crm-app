<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function getSearchParams(): array
    {
        return [
            'search' => (string) $this->input('search', ''),
            'column' => (string) $this->input('column', 'id'),
            'order' => (string) $this->input('order', 'ASC'),
            'display' => (int) $this->input('display', 15),
        ];
    }
}
