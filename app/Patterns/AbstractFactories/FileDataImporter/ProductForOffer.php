<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter;

use Illuminate\Support\Facades\Validator;

class ProductForOffer implements ValidatorInterface
{
    public function validate(array $data): bool
    {
        $validator = Validator::make($data, [
            '*.code' => 'required|string',
            '*.quantity' => 'required|numeric',
            '*.price' => 'numeric',
        ]);
        $errors = $validator->errors();

        return empty($errors->messages()) && !empty($data);
    }
}
