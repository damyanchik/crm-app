<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Processors\Traits;

trait ProcessingAttributeWithProductTrait
{
    private function processItemsWithAttributes(object $filteredCollection, array $attributesFromBase): array
    {
        return $filteredCollection->transform(function ($item) use ($attributesFromBase) {
            $this->checkAttributeAndBindIdToProduct(
                $item['category_id'],
                $attributesFromBase['categories']
            );
            $this->checkAttributeAndBindIdToProduct(
                $item['brand_id'],
                $attributesFromBase['brands']
            );
            return $item;
        })->toArray();
    }

    private function checkAttributeAndBindIdToProduct(string &$attributeFromCsv, array $recordsFromBase): void
    {
        $normalizedRecords = array_change_key_case($recordsFromBase, CASE_LOWER);

        if (array_key_exists(strtolower($attributeFromCsv), $normalizedRecords)) {
            $attributeFromCsv = $normalizedRecords[strtolower($attributeFromCsv)];
        } else {
            $attributeFromCsv = null;
        }
    }
}
