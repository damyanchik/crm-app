<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface OrderItemRepositoryInterface
{
    public function storeMany(array $data): void;
    public function destroyManyByOrderId(int $orderId): void;
}
