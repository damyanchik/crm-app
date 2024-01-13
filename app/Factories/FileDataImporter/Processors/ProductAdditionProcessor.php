<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Processors;

use App\Helpers\ProductAttributesHelper;
use App\Helpers\ProductHelper;
use App\Helpers\ProductStatusHelper;
use App\Models\Brand;
use App\Models\ProductCategory;

class ProductAdditionProcessor implements ProcessorInterface
{
    public function process(array $data): array
    {
        $this->storeNotExistedAttributes($data);

        $existingProductCodes = ProductHelper::getExistingByCodes($data);
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
        $processedCategories = ProductAttributesHelper::completeQueryParameters('category_id', $data);
        ProductCategory::createOrIgnoreMany($processedCategories);

        $processedBrands = ProductAttributesHelper::completeQueryParameters('brand_id', $data);
        Brand::createOrIgnoreMany($processedBrands);
    }

    private function processItemsWithAttributes(object $filteredCollection, array $attributesFromBase): array
    {
        return $filteredCollection->transform(function ($item) use ($attributesFromBase) {
            ProductAttributesHelper::checkAttributeAndBindIdToProduct(
                $item['category_id'],
                $attributesFromBase['categories']
            );
            ProductAttributesHelper::checkAttributeAndBindIdToProduct(
                $item['brand_id'],
                $attributesFromBase['brands']
            );
            return $item;
        })->toArray();
    }
}
