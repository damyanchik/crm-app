<?php

declare(strict_types=1);

namespace App\Strategies\StockOperationStrategy;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;

class AdditionStrategy implements StrategyInterface
{
    public function __construct(protected ProductRepository $productRepository)
    {
    }

    public function update(array $items): void
    {
        $this->productRepository->updateMany($this->calculateStockDifferences($items));
    }

    private function calculateStockDifferences(array $items): array
    {
        $itemKeys = array_keys($items);
        return array_map(function ($quantity1, $quantity2, $code) {
            return [
                'code' => $code,
                'quantity' => $quantity1 + $quantity2
            ];
        }, $this->getCurrentStock($itemKeys), $items, $itemKeys);
    }

    private function getCurrentStock(array $codes): array
    {
        return $this->productRepository->getStock($codes);
    }
}
