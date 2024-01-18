<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Processors\Traits;

use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\ProductCategoryRepositoryInterface;

trait AttributeStoringTrait
{
    private function storeNotExistedAttributes(
        array $data,
        BrandRepositoryInterface $brandRepository,
        ProductCategoryRepositoryInterface $categoryRepository
    ): void
    {
        $processedCategories = $this->completeQueryParameters('category_id', $data);
        $categoryRepository->storeOrIgnoreMany($processedCategories);

        $processedBrands = $this->completeQueryParameters('brand_id', $data);
        $brandRepository->storeOrIgnoreMany($processedBrands);
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

}
