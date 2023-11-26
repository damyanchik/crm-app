<?php

declare(strict_types=1);

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class OrderCsvValidator
{
    public static function validate(array $csvData)
    {
        return Validator::make($csvData, [
            '*.code' => 'required|string',
            '*.quantity' => 'required|numeric',
            '*.price' => 'numeric',
        ]);
    }
}
