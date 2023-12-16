<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter\Processors;

use App\Helpers\ProductStatusHelper;
use App\Models\Product;

class ProductUpdateProcessor implements ProcessorInterface
{
    public function process(array $data): array
    {
        $collection = collect($data);

        $existingProducts = $this->getExistingProducts($data);

        $filteredCollection = $collection->filter(function ($item) use ($existingProducts) {
            return in_array(
                $item['code'],
                array_column($existingProducts, 'code')
            );
        })->unique('code')->toArray();

        ProductStatusHelper::checkQuantityAndSetStatus($filteredCollection);

        return $filteredCollection;
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
