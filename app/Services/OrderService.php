<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Events\OrderToStock;
use App\Models\Order;
use App\Repositories\OrderRepository;

class OrderService
{
    public function __construct(protected OrderRepository $orderRepository)
    {
    }

    public function getAll(array $searchParams): object
    {
        return $this->orderRepository->getByStatusAndSort($searchParams, [
            OrderStatusEnum::PENDING['id'],
            OrderStatusEnum::READY['id']
        ]);
    }

    public function close(Order $order): void
    {
        $order->setAttribute('status', OrderStatusEnum::CLOSED['id']);
        $order->save();
    }

    public function reject(Order $order): void
    {
        event(new OrderToStock($order));
        $order->setAttribute('status', OrderStatusEnum::REJECTED['id']);
        $order->save();
    }

    public function ready(Order $order): void
    {
        $order->setAttribute('status', OrderStatusEnum::READY['id']);
        $order->save();
    }
}
