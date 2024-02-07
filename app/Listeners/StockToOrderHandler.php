<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\StockToOrder;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Strategies\StockOperationStrategy\StockOperation;
use App\Strategies\StockOperationStrategy\SubtractionStrategy;

class StockToOrderHandler
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected StockOperation $stockOperation
    )
    {
    }

    /**
     * Handle the event.
     */
    public function handle(StockToOrder $event): void
    {
        $codesAndQuantities = $event->order->orderItem->pluck('quantity', 'code')->toArray();
        $this->stockOperation->setStrategy(new SubtractionStrategy($this->productRepository));
        $this->stockOperation->performOperation($codesAndQuantities);
    }
}
