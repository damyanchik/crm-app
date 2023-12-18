<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Helpers\StockHelper;
use App\Models\Order;

class OrderService
{
    public function getOrders(): object
    {
        return Order::search(request('search'))
            ->where(function ($query) {
                $query->whereIn('status', [
                    OrderStatusEnum::PENDING['id'],
                    OrderStatusEnum::READY['id']
                ]);
            })
            ->sortBy(
                request('column') ?? 'id',
                request('order') ?? 'asc'
            )
            ->paginate(request('display'));
    }

    public function close(Order $order): void
    {
        $order->setAttribute('status', OrderStatusEnum::CLOSED['id']);
        $order->save();
    }

    public function reject(Order $order): void
    {
        StockHelper::removeAllQuantityToProducts($order);
        $order->setAttribute('status', OrderStatusEnum::REJECTED['id']);
        $order->save();
    }

    public function ready(Order $order): void
    {
        $order->setAttribute('status', OrderStatusEnum::READY['id']);
        $order->save();
    }
}
