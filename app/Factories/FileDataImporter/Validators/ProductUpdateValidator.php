<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Validators;

use Illuminate\Support\Facades\Validator;

class ProductUpdateValidator implements ValidatorInterface
{
    public function validate(array $data): bool
    {
        $validator = Validator::make($data, [
            '*.code' => 'required|string',
            '*.quantity' => 'required|numeric',
            '*.price' => 'required|numeric',
        ]);
        $errors = $validator->errors();

        return empty($errors->messages()) && !empty($data);
    }
}
