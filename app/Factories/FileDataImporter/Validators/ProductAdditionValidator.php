<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Validators;

use App\Enum\ProductUnitEnum;
use App\Factories\FileDataImporter\Validators\Traits\CheckingErrorTrait;
use Illuminate\Support\Facades\Validator;

class ProductAdditionValidator implements ValidatorInterface
{
    use CheckingErrorTrait;

    public function validate(array $data): bool
    {
        $validator = Validator::make($data, [
            '*.name' => 'required|string',
            '*.code' => 'required|string',
            '*.quantity' => 'required|numeric',
            '*.unit' => 'required|integer|between:1,'.(count(ProductUnitEnum::getAllUnits())-1),
            '*.price' => 'required|numeric',
            '*.brand_id' => 'nullable|string',
            '*.category_id' => 'nullable|string'
        ]);

        return $this->isError($validator);
    }
}
