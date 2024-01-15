<?php

declare(strict_types=1);

namespace App\Strategies\StockOperationStrategy;

class StockOperation
{
    private StrategyInterface $strategy;

    public function setStrategy(StrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function performOperation(array $items): void
    {
        $this->strategy->update($items);
    }
}
