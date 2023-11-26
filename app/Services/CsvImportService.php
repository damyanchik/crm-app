<?php

declare(strict_types=1);

namespace App\Services;

use App\Strategies\CsvImportStrategyInterface;

class CsvImportService
{
    private $csvImportStrategy;

    public function setCsvImportStrategy(CsvImportStrategyInterface $csvImportStrategy)
    {
        $this->csvImportStrategy = $csvImportStrategy;
    }

    public function importDataFromCsv(array $csvData)
    {
        if ($this->csvImportStrategy === null) {
            throw new \Exception("CsvImportStrategy nie zostało ustawione.");
        }

        return $this->csvImportStrategy->performOperation($csvData);
    }
}
