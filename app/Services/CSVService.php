<?php

declare(strict_types=1);

namespace App\Services;

use App\Factories\FileDataImporter\Factories\ProductAdditionFactory;
use App\Factories\FileDataImporter\Factories\ProductForOfferFactory;
use App\Factories\FileDataImporter\Factories\ProductUpdateFactory;
use App\Factories\FileDataImporter\FileDataImporter;
use App\Helpers\CSVHelper;
use App\Repositories\ProductRepository;

class CSVService
{
    public function __construct(
        protected FileDataImporter $fileDataImporter,
        protected ProductRepository $productRepository
    )
    {
    }

    public function validateAndImportCsv(object $file): array
    {
        $csvData = CSVHelper::validateFileAndReadToArray($file, [
            'code', 'quantity', 'price'
        ]);

        $this->fileDataImporter->setFactory(new ProductForOfferFactory());

        return $this->fileDataImporter->processData($csvData);
    }

    public function importNewProduct(object $file): void
    {
        $csvData = CSVHelper::validateFileAndReadToArray($file, [
            'name', 'code', 'quantity', 'unit', 'price', 'brand_id', 'category_id'
        ]);

        $this->fileDataImporter->setFactory(new ProductAdditionFactory());

        $this->productRepository->storeMany($this->fileDataImporter->processData($csvData));
    }

    public function importProductToUpdate(object $file): void
    {
        $csvData = CSVHelper::validateFileAndReadToArray($file, [
            'code', 'quantity', 'price'
        ]);

        $this->fileDataImporter->setFactory(new ProductUpdateFactory());

        $this->productRepository->updateMany($this->fileDataImporter->processData($csvData));
    }
}
