<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\OrderItem;
use App\Repositories\Interfaces\OrderItemRepositoryInterface;

class OrderItemRepository extends BaseRepository implements OrderItemRepositoryInterface
{
    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }

    public function storeMany(array $data): void
    {
        OrderItem::insert($data);
    }

    public function destroyManyByOrderId(int $orderId): void
    {
        OrderItem::where('order_id', $orderId)->delete();
    }
}
