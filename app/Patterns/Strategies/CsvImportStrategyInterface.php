<?php

declare(strict_types=1);

namespace App\Patterns\Strategies;

interface CsvImportStrategyInterface
{
    public function validate(array $csvData): bool;
    public function performOperation(array $csvData): object;
}
