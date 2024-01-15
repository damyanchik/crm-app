<?php

declare(strict_types=1);

namespace App\Services;

use App\Factories\FileDataImporter\FileDataImporter;
use App\Helpers\PhotoHelper;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected FileDataImporter $fileDataImporter,
        protected CSVService $CSVService)
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

        $this->productRepository->update($product, $validatedData);
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
        return $this->productRepository->searchToAjax($searchTerm);
    }
}
