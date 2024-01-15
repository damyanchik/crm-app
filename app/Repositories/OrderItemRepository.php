<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\OrderItem;

class OrderItemRepository extends BaseRepository
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
