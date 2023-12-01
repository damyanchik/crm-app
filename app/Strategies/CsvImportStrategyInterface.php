<?php

declare(strict_types=1);

namespace App\Strategies;

interface CsvImportStrategyInterface
{
    public function validate(array $csvData): bool;
    public function performOperation(array $csvData): object;
}
