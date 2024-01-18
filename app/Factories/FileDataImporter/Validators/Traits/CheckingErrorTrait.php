<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Validators\Traits;

trait CheckingErrorTrait
{
    private function isError(object $validator): bool
    {
        $errors = $validator->errors();

        return empty($errors->messages());
    }
}
