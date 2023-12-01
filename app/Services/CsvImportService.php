<?php

declare(strict_types=1);

namespace App\Services;

use App\Strategies\CsvImportStrategyInterface;

class CsvImportService
{
    private CsvImportStrategyInterface $csvImportStrategy;

    public function setCsvImportStrategy(CsvImportStrategyInterface $csvImportStrategy)
    {
        $this->csvImportStrategy = $csvImportStrategy;
    }

    public function importDataFromCsv(array $csvData)
    {
        $this->validateStrategy();

        if ($this->csvImportStrategy->validate($csvData)) {
            return $this->csvImportStrategy->performOperation($csvData);
        } else {
            return;
        }
    }

    private function validateStrategy(): void
    {
        if ($this->csvImportStrategy === null) {
            throw new \Exception("CsvImportStrategy nie zostało ustawione.");
        }
    }
}
