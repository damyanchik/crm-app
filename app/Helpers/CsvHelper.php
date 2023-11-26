<?php

declare(strict_types=1);

namespace App\Helpers;

use League\Csv\Reader;

class CsvHelper
{
    public static function readToArray(string $filePath, array $columnHeaders): array
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setDelimiter(';');
        $csvData = iterator_to_array($csv->getRecords());
        $mappedArray = [];

        if (!empty($csvData) && !empty($columnHeaders))
            $mappedArray = self::mapArray($csvData, $columnHeaders);

        return $mappedArray;
    }

    private static function mapArray(array $csvData, array $columnHeaders): array
    {
        $csvMappedData = [];

        foreach ($csvData as $row) {
            $rowData = [];

            foreach ($columnHeaders as $columnName => $columnIndex) {
                $rowData[$columnIndex] = $row[$columnName];
            }

            $csvMappedData[] = $rowData;
        }

        return $csvMappedData;
    }
}
