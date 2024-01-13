<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderStatusEnum;
use App\Models\Order;
use App\Factories\FileDataImporter\Factories\ProductForOfferFactory;
use App\Factories\FileDataImporter\FileDataImporter;
use App\Repositories\OrderRepository;

class OfferService
{
    public function __construct(
        protected FileDataImporter $fileDataImporter,
        protected OrderRepository $orderRepository,
        protected CSVService $CSVService
    )
    {
    }

    public function getAll(array $searchParams): object
    {
        return $this->orderRepository->getByStatusAndSort($searchParams, [
            OrderStatusEnum::OFFER['id'],
            OrderStatusEnum::ACCEPTED['id']
        ]);
    }

    public function store(array $offerValidated, array $offersItemsValidated): void
    {
        $this->orderRepository->storeWithItems($offerValidated, $offersItemsValidated);
    }

    public function update(Order $order, array $offerValidated, array $offersItemsValidated): void
    {
        $this->orderRepository->updateWithItems($order, $offerValidated, $offersItemsValidated);
    }

    public function destroy(Order $offer): void
    {
        $this->orderRepository->destroy($offer);
    }

    public function transformToOrder(Order $offer): void
    {
        $this->orderRepository->transformToOrder($offer);
    }

    public function validateAndImportCsv(object $file): array
    {
        $csvData = $this->CSVService->validateFileAndReadToArray($file, [
            'code', 'quantity', 'price'
        ]);

        $this->fileDataImporter->setFactory(new ProductForOfferFactory());

        return $this->fileDataImporter->processData($csvData);
    }
}
