<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Validators;

use App\Enum\ProductUnitEnum;
use Illuminate\Support\Facades\Validator;

class ProductAdditionValidator implements ValidatorInterface
{
    public function validate(array $data): bool
    {
        $validator = Validator::make($data, [
            '*.name' => 'required|string',
            '*.code' => 'required|string',
            '*.quantity' => 'required|numeric',
            '*.unit' => 'required|integer|between:0,'.(count(ProductUnitEnum::getAllUnits())-1),
            '*.price' => 'required|numeric',
            '*.brand_id' => 'nullable|string',
            '*.category_id' => 'nullable|string'
        ]);
        $errors = $validator->errors();

        return empty($errors->messages()) && !empty($data);
    }
}
