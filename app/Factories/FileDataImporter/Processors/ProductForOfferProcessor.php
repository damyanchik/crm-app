<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Processors;

use App\Factories\FileDataImporter\Processors\Traits\VerifyingPriceTrait;
use App\Factories\FileDataImporter\Processors\Traits\VeryfingQuantityTrait;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;

class ProductForOfferProcessor implements ProcessorInterface
{
    use VerifyingPriceTrait, VeryfingQuantityTrait;

    public function process(array $data): array
    {
        $existingProducts = $this->getExistingProducts($data, new ProductRepository(new Product()));

        $collection = collect($data)->transform(function ($item) use (&$existingProducts) {
            if (empty($existingProducts[$item['code']])) {
                return $item = null;
            }

            return $this->processItem($item, $existingProducts);
        });

        $filteredCollection = $collection->filter(function ($item) {
            return !empty($item);
        });

        return $filteredCollection->toArray();
    }

    private function processItem($item, &$existingProducts): array
    {
        $item += [
            'name' => $existingProducts[$item['code']]['name'],
            'unit' => $existingProducts[$item['code']]['unit'],
            'brand' => $existingProducts[$item['code']]['brand']
        ];

        $this->updatePrice($item, $existingProducts);
        $this->updateQuantity($item, $existingProducts);

        return $item;
    }

    private function getExistingProducts(array $data, ProductRepositoryInterface $productRepository): array
    {
        return $productRepository->getExistingProductsUsingData($data);
    }
}
