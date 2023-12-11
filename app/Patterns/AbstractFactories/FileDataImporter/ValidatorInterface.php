<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter;

interface ValidatorInterface
{
    public function validate(array $data): bool;
}
