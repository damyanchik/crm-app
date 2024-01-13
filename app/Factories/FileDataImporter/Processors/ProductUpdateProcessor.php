<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Processors;

use App\Helpers\ProductHelper;
use App\Helpers\ProductStatusHelper;
use App\Models\Product;

class ProductUpdateProcessor implements ProcessorInterface
{
    public function process(array $data): array
    {
        $existingProducts = Product::getExistingByCodes($data);

        $filteredCollection = collect($data)->filter(function ($item) use ($existingProducts) {
            return in_array(
                $item['code'],
                array_column($existingProducts, 'code')
            );
        })->unique('code')->toArray();

        ProductStatusHelper::checkAllQuantityAndSet($filteredCollection);

        return $filteredCollection;
    }
}
