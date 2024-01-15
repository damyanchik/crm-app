<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enum\OrderStatusEnum;
use App\Helpers\InvoiceHelper;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Traits\SearchableTrait;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    use SearchableTrait;

    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getByStatusAndSort(array $searchParams, array|null $status = null): object
    {
        if ($status) {
            $callable = function ($query) use ($status) {
                $query->whereIn('status', $status);
            };
        } else {
            $callable = null;
        }

        return $this->searchAndSort($searchParams, $callable);
    }

    public function storeAndGet(array $offerValidated): Order
    {
        return Order::create($offerValidated);
    }

    public function transformToOrder(Order $offer): void
    {
        $offer->update([
            'invoice_num' => $this->generateInvoiceNumber(),
            'status' => OrderStatusEnum::PENDING['id'],
            'updated_at' => now()
        ]);
    }

    private function generateInvoiceNumber(): string
    {
        $invoiceNumber = $this->getOrderQuantityInCurrentMonth() + 1;
        $invoice = InvoiceHelper::prepareInvoiceNumber($invoiceNumber);

        while (Order::where('invoice_num', '=', $invoice)->exists()) {
            $invoiceNumber++;
            $invoice = InvoiceHelper::prepareInvoiceNumber($invoiceNumber);
        }

        return $invoice;
    }

    private function getOrderQuantityInCurrentMonth(): int
    {
        return Order::whereMonth('created_at', '=', now()->month)
            ->whereNotIn('status', [
                OrderStatusEnum::OFFER['id'],
                OrderStatusEnum::ACCEPTED['id'],
            ])
            ->count();
    }
}
