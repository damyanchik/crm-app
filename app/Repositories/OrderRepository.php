<?php

namespace App\Repositories;

use App\Enum\OrderStatusEnum;
use App\Helpers\InvoiceHelper;
use App\Helpers\StockHelper;
use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\SearchableTrait;

class OrderRepository
{
    use SearchableTrait;

    public function getByStatusAndSort(array $searchParams, array|null $status = null): object
    {
        if ($status) {
            $callable = function ($query) use ($status) {
                $query->whereIn('status', $status);
            };
        } else {
            $callable = null;
        }

        return $this->searchAndSort(new Order(), $searchParams, $callable);
    }

    public function store(array $offerValidated, array $offersItemsValidated): void
    {
        $newOffer = Order::create($offerValidated);

        OrderItem::insert(
            $this->prepareOfferItems(
                intval($newOffer->id),
                $offersItemsValidated['products']
            )
        );
    }

    public function update(Order $order, array $offerValidated, array $offersItemsValidated): void
    {
        $order->update($offerValidated);
        StockHelper::removeAllQuantityToProducts($order);
        $order->orderItem()->delete();

        OrderItem::insert(
            $this->prepareOfferItems(
                intval($order->id),
                $offersItemsValidated['products']
            )
        );
    }

    public function destroy(Order $offer): void
    {
        StockHelper::removeAllQuantityToProducts($offer);
        $offer->delete();
    }

    public function transformToOrder(Order $offer): void
    {
        $offer->update([
            'invoice_num' => InvoiceHelper::generateInvoiceNumber(),
            'status' => OrderStatusEnum::PENDING['id'],
            'updated_at' => now()
        ]);
    }

    private function prepareOfferItems(int $offerId, array $offerItems): array
    {
        foreach ($offerItems as &$orderItem) {
            $orderItem['order_id'] = $offerId;
            StockHelper::takeQuantityFromProductByCode($orderItem['code'], $orderItem['quantity']);
        }

        return $offerItems;
    }
}
