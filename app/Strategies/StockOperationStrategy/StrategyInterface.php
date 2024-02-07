<?php

declare(strict_types=1);

namespace App\Strategies\StockOperationStrategy;

interface StrategyInterface
{
    public function update(array $items): void;
}
