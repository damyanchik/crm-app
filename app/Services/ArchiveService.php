<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Http\Requests\IndexRequest;
use App\Models\Order;

class ArchiveService
{
    public function __construct(protected SearchService $searchService)
    {
    }

    public function getAll(IndexRequest $request): object
    {
        $callable = function ($query) {
            $query->whereIn('status', [
                OrderStatusEnum::REJECTED['id'],
                OrderStatusEnum::CLOSED['id'],
            ]);
        };

        return $this->searchService->searchItems(new Order(), $request, $callable);
    }
}
