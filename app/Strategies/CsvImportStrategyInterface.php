<?php

declare(strict_types=1);

namespace App\Strategies;

interface CsvImportStrategyInterface
{
    public function performOperation($csvData);
}
