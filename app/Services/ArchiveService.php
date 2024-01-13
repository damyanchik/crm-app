<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Http\Requests\IndexRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;

class ArchiveService
{
    public function __construct( protected OrderRepository $orderRepository)
    {
    }

    public function getAll(array $searchParams): object
    {
        return $this->orderRepository->getByStatusAndSort($searchParams, [
            OrderStatusEnum::REJECTED['id'],
            OrderStatusEnum::CLOSED['id'],
        ]);
    }
}
