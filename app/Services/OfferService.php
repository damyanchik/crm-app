<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Events\OrderToStock;
use App\Events\StockToOrder;
use App\Models\Order;
use App\Factories\FileDataImporter\FileDataImporter;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;

class OfferService
{
    public function __construct(
        protected FileDataImporter $fileDataImporter,
        protected OrderRepository $orderRepository,
        protected OrderItemRepository $orderItemRepository
    )
    {
    }

    public function getAll(array $searchParams): object
    {
        return $this->orderRepository->getByStatusAndSort($searchParams, [
            OrderStatusEnum::OFFER['id'],
            OrderStatusEnum::ACCEPTED['id']
        ]);
    }

    public function store(array $offerValidated, array $offersItemsValidated): void
    {
        $order = $this->orderRepository->storeAndGet($offerValidated);
        data_fill($offersItemsValidated['products'], '*.order_id', intval($order->id));
        $this->orderItemRepository->storeMany($offersItemsValidated['products']);
        event(new StockToOrder($order));
    }

    public function update(Order $order, array $offerValidated, array $offersItemsValidated): void
    {
        $this->orderRepository->update($order, $offerValidated);
        data_fill($offersItemsValidated['products'], '*.order_id', intval($order->id));
        event(new OrderToStock($order));
        $this->orderItemRepository->destroyManyByOrderId(intval($order->id));
        $this->orderItemRepository->storeMany($offersItemsValidated['products']);
        event(new StockToOrder($order));
    }

    public function destroy(Order $order): void
    {
        event(new OrderToStock($order));
        $this->orderItemRepository->destroyManyByOrderId(intval($order->id));
        $this->orderRepository->destroy($order);
    }

    public function transformToOrder(Order $order): void
    {
        $this->orderRepository->transformToOrder($order);
    }
}
