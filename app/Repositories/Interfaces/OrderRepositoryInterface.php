<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function __construct(Order $model);
    public function getByStatusAndSort(array $searchParams, array|null $status = null): object;
    public function storeAndGet(array $offerValidated): Order;
    public function transformToOrder(Order $offer): void;
}
