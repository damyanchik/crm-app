<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait UpdateSelectedRecordsTrait
{
    public static function updateMany(array $data, string $updateByColumn): void
    {
        if (self::checkTablePropertyExist() || empty($data)) {
            return;
        }

        DB::update(self::buildFinalQuery($data, $updateByColumn));
    }

    private static function buildFinalQuery(array $data, string $updateByColumn): string
    {
        $cases = self::createCases($data, $updateByColumn);

        $updateRecords = implode(',', array_map(function ($updateRecord) {
            return "'{$updateRecord}'";
        }, array_column($data, $updateByColumn)));

        return "UPDATE " . (new static)->table . "
          SET
            ".implode(',', $cases)."
          WHERE $updateByColumn IN ({$updateRecords})";
    }

    private static function createCases(array $data, string $updateByColumn): array
    {
        $columnsToUpdate = self::checkColumnsToUpdate($data, $updateByColumn);

        $cases = [];
        $i = 0;
        foreach ($data as $item) {
            for ($x = count($columnsToUpdate)-1; $x >= 0; $x--) {
                $cases[$columnsToUpdate[$x]][$i] = "WHEN '{$item[$updateByColumn]}' THEN '{$item[$columnsToUpdate[$x]]}'";
            }
            $i++;
        }

        foreach ($cases as &$case) {
            $case = implode(' ', $case);
        }

        self::prepareCaseWithEveryColumn($cases, $updateByColumn);

        return $cases;
    }

    private static function checkColumnsToUpdate(array $data, string $updateByColumn): array
    {
        unset($data[0][$updateByColumn]);

        return array_keys($data[0]);
    }

    private static function prepareCaseWithEveryColumn(array &$cases, string $updateByColumn): void
    {
        $i = 0;
        foreach ($cases as $case => &$imploded) {
            $imploded = $case .' = CASE '. $updateByColumn .' '. $imploded. ' END';
            $i++;
        }
    }

    private static function checkTablePropertyExist(): bool
    {
        return !property_exists(static::class, 'table') ||
            empty((new static)->table);
    }
}
