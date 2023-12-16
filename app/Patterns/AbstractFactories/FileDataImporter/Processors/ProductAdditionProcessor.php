<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter\Processors;

use App\Helpers\ProductStatusHelper;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductAdditionProcessor implements ProcessorInterface
{
    public function process(array $data): array
    {
        $collection = collect($data);

        $existingProducts = $this->getExistingProducts($data);

        //wyfiltrowanie nowych
        $filteredCollection = $collection->filter(function ($item) use ($existingProducts) {
            return !in_array(
                $item['code'],
                array_column($existingProducts, 'code')
            );
        })->unique('code');


        // Usuń puste wartości CAT
        $nonEmptyCategory = array_filter(array_column($data, 'category'));

        // Przekształć każdą niepustą wartość na strukturę danych kategorii
        $categoriesData = array_map(function ($value) {
            return [
                'name' => $value,
                'updated_at' => now(),
                'created_at' => now(),
            ];
        }, $nonEmptyCategory);

        ProductCategory::createOrIgnoreMany($categoriesData);


        // Usuń puste wartości BRA
        $nonEmptyBrands = array_filter(array_column($data, 'brand'));

        // Przekształć każdą niepustą wartość na strukturę danych kategorii
        $brandsData = array_map(function ($value) {
            return [
                'name' => $value,
                'updated_at' => now(),
                'created_at' => now(),
            ];
        }, $nonEmptyBrands);

        Brand::createOrIgnoreMany($brandsData);


        $productBrandsAndCategories = [
            'brands' => Brand::all()->pluck('id', 'name')->toArray(),
            'categories' => ProductCategory::all()->pluck('id', 'name')->toArray()
            ];

        $processedData = $filteredCollection->transform(function ($item) use ($productBrandsAndCategories) {
            return $this->checkAndBindToProduct($item, $productBrandsAndCategories);
            })->toArray();

        ProductStatusHelper::checkQuantityAndSetStatus($processedData);

        return $processedData;
    }

    private function checkAndBindToProduct(array $item, array $productBrandsAndCategories): array
    {
        if (empty($item['brand'])) {
            $item['brand_id'] = null;
            unset($item['brand']);
        } elseif (isset($productBrandsAndCategories['brands'][$item['brand']])) {
            $item['brand_id'] = $productBrandsAndCategories['brands'][$item['brand']];
            unset($item['brand']);
        }

        if (empty($item['category'])) {
            $item['category_id'] = null;
            unset($item['category']);
        } elseif (isset($productBrandsAndCategories['categories'][$item['category']])) {
            $item['category_id'] = $productBrandsAndCategories['categories'][$item['category']];
            unset($item['category']);
        }

        return $item;
    }

    private function getExistingProducts(array $data): array
    {
        $codes = array_column($data, 'code');

        return Product::whereIn('code', $codes)
            ->select('code')
            ->get()
            ->toArray();
    }
}
