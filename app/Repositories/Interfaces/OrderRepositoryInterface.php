<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function getByStatusAndSort(array $searchParams, ?array $status): object;
    public function storeAndGet(array $offerValidated): Order;
    public function transformToOrder(Order $order): void;
}
