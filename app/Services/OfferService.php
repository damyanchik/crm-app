<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Helpers\CSVHelper;
use App\Helpers\InvoiceHelper;
use App\Helpers\StockHelper;
use App\Models\Order;
use App\Models\OrderItem;
use App\Patterns\AbstractFactories\FileDataImporter\Factories\ProductForOfferFactory;
use App\Patterns\AbstractFactories\FileDataImporter\FileDataImporter;
use Illuminate\Foundation\Http\FormRequest;

class OfferService
{
    public function getOffers(): object
    {
        return Order::search(request('search'))
            ->where(function ($query) {
                $query->whereIn('status', [
                    OrderStatusEnum::OFFER['id'],
                    OrderStatusEnum::ACCEPTED['id']
                ]);
            })
            ->sortBy(
                request('column') ?? 'id',
                request('order') ?? 'asc'
            )
            ->paginate(request('display'));
    }

    public function store(array $validatedOffer, array $validatedOfferItems): void
    {
        $newOffer = Order::create($validatedOffer);

        OrderItem::insert(
            $this->prepareOfferItems(
                intval($newOffer->id),
                $validatedOfferItems['products']
            )
        );
    }

    public function update(array $offerValidated, array $offersItemsValidated, Order $order): void
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

    public function transformToOrder(Order $offer): void
    {
        $offer->update([
            'invoice_num' => InvoiceHelper::generateInvoiceNumber(),
            'status' => OrderStatusEnum::PENDING['id'],
            'updated_at' => now()
        ]);
    }

    public function destroy(Order $offer): void
    {
        StockHelper::removeAllQuantityToProducts($offer);
        $offer->delete();
    }

    public function validateAndImportCsv(FormRequest $request): array
    {
        $csvData = CSVHelper::validateFileAndReadToArray($request, [
            'code', 'quantity', 'price'
        ]);

        $fileImportProcessor = new FileDataImporter(new ProductForOfferFactory());

        return $fileImportProcessor->processData($csvData);
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
