<?php

declare(strict_types=1);

namespace App\Patterns\AbstractFactories\FileDataImporter\Processors;

use App\Models\Product;

class ProductForOfferProcessor implements ProcessorInterface
{
    public function process(array $data): array
    {
        $existingProducts = $this->getExistingProducts($data);
        $collection = collect($data);

        $collection->transform(function ($item) use (&$existingProducts) {
            if (empty($existingProducts[$item['code']]))
                return $item = null;

            return $this->processItem($item, $existingProducts);
        });

        $filteredCollection = $collection->filter(function ($item) {
            return $item != null;
        });

        return $filteredCollection->toArray();
    }

    private function processItem($item, &$existingProducts): mixed
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

    private function updatePrice(&$item, $existingProducts)
    {
        if (empty($item['price']) && $item['price'] < 0)
            $item['price'] = $existingProducts[$item['code']]['price'];

        if ($existingProducts[$item['code']]['price'] != $item['price'] && $item['price'] > 0)
            $item['changes']['price'] = $existingProducts[$item['code']]['price'];
    }

    private function updateQuantity(&$item, &$existingProducts)
    {
        if ($existingProducts[$item['code']]['quantity'] > 0)
            $existingProducts[$item['code']]['quantity'] = $existingProducts[$item['code']]['quantity'] - $item['quantity'];
        else
            $item = null;

        if ($item != null && $existingProducts[$item['code']]['quantity'] < 0) {
            $item['changes']['quantity'] = $item['quantity'];
            $item['quantity'] = $item['quantity'] + $existingProducts[$item['code']]['quantity'];
            $existingProducts[$item['code']]['quantity'] = 0;
        }
    }

    private function getExistingProducts(array $data): array
    {
        $codes = array_column($data, 'code');

        return Product::whereIn('code', $codes)
            ->with('brand')
            ->select('name', 'code', 'quantity', 'price', 'unit', 'brand_id')
            ->get()
            ->map(function ($product) {
                $productArray = $product->toArray();

                return [
                        'name' => $productArray['name'],
                        'code' => $productArray['code'],
                        'quantity' => $productArray['quantity'],
                        'price' => $productArray['price'],
                        'unit' => $productArray['unit'],
                        'brand' => $product->brand->name ?? '',
                    ] + $productArray;
            })
            ->keyBy('code')
            ->toArray();
    }
}
