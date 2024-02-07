<?php

declare(strict_types=1);

namespace App\Services;

use App\Factories\FileDataImporter\Factories\ProductAdditionFactory;
use App\Factories\FileDataImporter\Factories\ProductForOfferFactory;
use App\Factories\FileDataImporter\Factories\ProductUpdateFactory;
use App\Factories\FileDataImporter\FileDataImporter;
use App\Helpers\CSVHelper;
use App\Repositories\ProductRepository;

class CSVProductService
{
    const ALL_COLUMNS = ['name', 'code', 'quantity', 'unit', 'price', 'brand_id', 'category_id'];
    const BASIC_COLUMNS = ['code', 'quantity', 'price'];

    public function __construct(
        protected FileDataImporter $fileDataImporter,
        protected ProductRepository $productRepository
    )
    {
    }

    public function importToMakingOfferProcess(object $file): array
    {
        $csvData = CSVHelper::validateFileAndReadToArray($file, self::BASIC_COLUMNS);

        $this->fileDataImporter->setFactory(new ProductForOfferFactory());

        return $this->fileDataImporter->processData($csvData);
    }

    public function importToAddNewProduct(object $file): void
    {
        $csvData = CSVHelper::validateFileAndReadToArray($file, self::ALL_COLUMNS);

        $this->fileDataImporter->setFactory(new ProductAdditionFactory());

        $this->productRepository->storeMany($this->fileDataImporter->processData($csvData));
    }

    public function importToUpdateProduct(object $file): void
    {
        $csvData = CSVHelper::validateFileAndReadToArray($file, self::BASIC_COLUMNS);

        $this->fileDataImporter->setFactory(new ProductUpdateFactory());

        $this->productRepository->updateMany($this->fileDataImporter->processData($csvData));
    }
}
