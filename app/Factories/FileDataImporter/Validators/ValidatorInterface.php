<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Validators;

interface ValidatorInterface
{
    public function validate(array $data): bool;
}
