<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Helpers\CSVHelper;
use App\Helpers\InvoiceHelper;
use App\Helpers\StockHelper;
use App\Http\Requests\IndexRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Patterns\AbstractFactories\FileDataImporter\Factories\ProductForOfferFactory;
use App\Patterns\AbstractFactories\FileDataImporter\FileDataImporter;
use Illuminate\Foundation\Http\FormRequest;

class OfferService
{
    public function __construct(protected FileDataImporter $fileDataImporter, protected SearchService $searchService)
    {
    }

    public function getAll(IndexRequest $indexRequest): object
    {
        $callable = function ($query) {
            $query->whereIn('status', [
                OrderStatusEnum::OFFER['id'],
                OrderStatusEnum::ACCEPTED['id']
            ]);
        };

        return $this->searchService->searchItems(new Order(), $indexRequest, $callable);
    }

    public function store(FormRequest $offerRequest, FormRequest $itemsRequest): void
    {
        $newOffer = Order::create($offerRequest->validated());
        $offersItemsValidated = $itemsRequest->validated();

        OrderItem::insert(
            $this->prepareOfferItems(
                intval($newOffer->id),
                $offersItemsValidated['products']
            )
        );
    }

    public function update(Order $order, FormRequest $offerRequest, FormRequest $offersItemsRequest): void
    {
        $order->update($offerRequest->validated());
        StockHelper::removeAllQuantityToProducts($order);
        $order->orderItem()->delete();
        $offersItemsValidated = $offersItemsRequest->validated();

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

        $this->fileDataImporter->setFactory(new ProductForOfferFactory());

        return $this->fileDataImporter->processData($csvData);
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
