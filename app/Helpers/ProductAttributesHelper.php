<?php

declare(strict_types=1);

namespace App\Helpers;

class ProductAttributesHelper
{
    public static function completeQueryParameters(string $attributeColumn, array $data): array
    {
        $nonEmptyAttributes = array_filter(array_column($data, $attributeColumn));

        $completedData = array_map(function ($value) {
            return [
                'name' => $value,
                'updated_at' => now(),
                'created_at' => now(),
            ];
        }, $nonEmptyAttributes);

        return $completedData;
    }

    public static function checkAttributeAndBindIdToProduct(string|null &$attributeFromCsv, array $recordsFromBase): void
    {
        $normalizedRecords = array_change_key_case($recordsFromBase, CASE_LOWER);

        if (!empty($attributeFromCsv) && array_key_exists(strtolower($attributeFromCsv), $normalizedRecords))
            $attributeFromCsv = $normalizedRecords[strtolower($attributeFromCsv)];
        else
            $attributeFromCsv = null;
    }
}
