<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enum\OrderStatusEnum;
use App\Helpers\StockHelper;
use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class OrderRepository extends BaseRepository
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

    public function storeWithItems(array $offerValidated, array $offersItemsValidated): void
    {
        $newOffer = Order::create($offerValidated);

        OrderItem::insert(
            $this->prepareOfferItems(
                intval($newOffer->id),
                $offersItemsValidated['products']
            )
        );
    }

    public function updateWithItems(Order $order, array $offerValidated, array $offersItemsValidated): void
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

    public function destroy(Model|int $model): void
    {
        StockHelper::removeAllQuantityToProducts($model);
        parent::destroy($model);
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
        $invoice = $invoiceNumber . '/FV/' . now()->month . '/' . now()->year;

        while (Order::where('invoice_num', '=', $invoice)->exists()) {
            $invoiceNumber++;
            $invoice = $invoiceNumber . '/FV/' . now()->month . '/' . now()->year;
        }

        return $invoice;
    }

    private function getOrderQuantityInCurrentMonth(): int
    {
        $orderMonthQuantity = Order::whereMonth('created_at', '=', now()->month)
            ->whereNotIn('status', [
                OrderStatusEnum::OFFER['id'],
                OrderStatusEnum::ACCEPTED['id'],
            ])
            ->count();

        return $orderMonthQuantity->quantity;
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
