<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\CSVHelper;
use App\Helpers\PhotoHelper;
use App\Models\Product;
use App\Factories\FileDataImporter\Factories\ProductAdditionFactory;
use App\Factories\FileDataImporter\Factories\ProductUpdateFactory;
use App\Factories\FileDataImporter\FileDataImporter;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(protected ProductRepository $productRepository, protected FileDataImporter $fileDataImporter)
    {
    }

    public function getAll(array $searchParams): object
    {
        return $this->productRepository->searchAndSort($searchParams);
    }

    public function store(array $validatedData, object $file = null): void
    {
        if ($file->isValid()) {
            $validatedData['photo'] = $file->store('images/product_photo', 'public');
        }

        $this->productRepository->store($validatedData);
    }

    public function update(array $validatedData, Product $product, object $file = null): void
    {
        if ($file->isValid()) {
            if ($product->photo) {
                PhotoHelper::deletePreviousPhoto($product->photo);
            }
            $validatedData['photo'] = $file->store('images/product_photo', 'public');
        }

        $this->productRepository->update($validatedData, $product);
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

    public function destroyPhoto(Product $product): void
    {
        $this->productRepository->destroyPhoto($product);
    }

    public function destroy(Product $product): void
    {
        $this->productRepository->destroy($product);
    }

    public function handleAjax(string $searchTerm): object
    {
        return Product::with('brand')
            ->where('name', 'like', "%$searchTerm%")
            ->orWhere('code', 'like', "%$searchTerm%")
            ->orWhereHas('brand', function ($brandQuery) use ($searchTerm) {
                $brandQuery->where('name', 'like', "%$searchTerm%");
            })
            ->get();
    }
}
