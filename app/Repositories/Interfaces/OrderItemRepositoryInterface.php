<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\OrderItem;

interface OrderItemRepositoryInterface
{
    public function __construct(OrderItem $model);
    public function storeMany(array $data): void;
    public function destroyManyByOrderId(int $orderId): void;
}
