<?php

declare(strict_types=1);

namespace App\Helpers;

class ProductAttributesHelper
{
    public static function completeQueryParameters($attributeColumn, $data): array
    {
        $nonEmptyAttributes = array_filter(array_column($data, $attributeColumn));

        return array_map(function ($value) {
            return [
                'name' => $value,
                'updated_at' => now(),
                'created_at' => now(),
            ];
        }, $nonEmptyAttributes);
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
