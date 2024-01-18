<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Validators;

use App\Factories\FileDataImporter\Validators\Traits\CheckingErrorTrait;
use Illuminate\Support\Facades\Validator;

class ProductForOfferValidator implements ValidatorInterface
{
    use CheckingErrorTrait;

    public function validate(array $data): bool
    {
        $validator = Validator::make($data, [
            '*.code' => 'required|string',
            '*.quantity' => 'required|numeric',
            '*.price' => 'numeric',
        ]);

        return $this->isError($validator);
    }
}
