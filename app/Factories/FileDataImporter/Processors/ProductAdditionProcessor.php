<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Processors;

use App\Helpers\ProductStatusHelper;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductAdditionProcessor implements ProcessorInterface
{
    public function process(array $data): array
    {
        $this->storeNotExistedAttributes($data);

        $existingProductCodes = Product::getExistingByCodes($data);
        $filteredCollection = collect($data)->filter(function ($item) use ($existingProductCodes) {
            return !in_array(
                $item['code'],
                array_column($existingProductCodes, 'code')
            );
        })->unique('code');

        $processedData = $this->processItemsWithAttributes(
            $filteredCollection, [
                'brands' => Brand::all()->pluck('id', 'name')->toArray(),
                'categories' => ProductCategory::all()->pluck('id', 'name')->toArray()
        ]);

        ProductStatusHelper::checkAllQuantityAndSet($processedData);

        return $processedData;
    }

    private function storeNotExistedAttributes(array $data): void
    {
        $processedCategories = $this->completeQueryParameters('category_id', $data);
        ProductCategory::createOrIgnoreMany($processedCategories);

        $processedBrands = $this->completeQueryParameters('brand_id', $data);
        Brand::createOrIgnoreMany($processedBrands);
    }

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

    private function completeQueryParameters(string $attributeColumn, array $data): array
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

    private function checkAttributeAndBindIdToProduct(string|null &$attributeFromCsv, array $recordsFromBase): void
    {
        $normalizedRecords = array_change_key_case($recordsFromBase, CASE_LOWER);

        if (!empty($attributeFromCsv) && array_key_exists(strtolower($attributeFromCsv), $normalizedRecords)) {
            $attributeFromCsv = $normalizedRecords[strtolower($attributeFromCsv)];
        } else {
            $attributeFromCsv = null;
        }
    }
}
