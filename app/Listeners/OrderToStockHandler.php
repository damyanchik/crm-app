<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\OrderToStock;
use App\Repositories\ProductRepository;
use App\Strategies\StockOperationStrategy\AdditionStrategy;
use App\Strategies\StockOperationStrategy\StockOperation;

class OrderToStockHandler
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected ProductRepository $productRepository,
        protected StockOperation $stockOperation
    )
    {
    }

    /**
     * Handle the event.
     */
    public function handle(OrderToStock $event): void
    {
        $codesAndQuantities = $event->order->orderItem->pluck('quantity', 'code')->toArray();
        $this->stockOperation->setStrategy(new AdditionStrategy($this->productRepository));
        $this->stockOperation->performOperation($codesAndQuantities);
    }
}
