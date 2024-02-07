<?php

declare(strict_types=1);

namespace App\Factories\FileDataImporter\Processors;

use App\Enum\ProductStatusEnum;
use App\Factories\FileDataImporter\Processors\Traits\AttributeStoringTrait;
use App\Factories\FileDataImporter\Processors\Traits\ProcessingAttributeWithProductTrait;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\BrandRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Collection;

class ProductAdditionProcessor implements ProcessorInterface
{
    use AttributeStoringTrait, ProcessingAttributeWithProductTrait;

    public function process(array $data): array
    {
        $this->storeNotExistedAttributes(
            $data,
            new BrandRepository(new Brand()),
            new ProductCategoryRepository(new ProductCategory())
        );

        $filteredCollection = $this->filterProducts($data, new ProductRepository(new Product()));

        $processedData = $this->processItemsWithAttributes(
            $filteredCollection, [
                'brands' => Brand::all()->pluck('id', 'name')->toArray(),
                'categories' => ProductCategory::all()->pluck('id', 'name')->toArray()
        ]);

        ProductStatusEnum::verifyProductsAndSetStatus($processedData);

        return $processedData;
    }

    private function filterProducts(array $data, ProductRepositoryInterface $productRepository): Collection
    {
        $existingProductCodes = $productRepository->getExistingCodes($data);

        return collect($data)->filter(function ($item) use ($existingProductCodes) {
            return !in_array(
                $item['code'],
                array_column($existingProductCodes, 'code')
            );
        })->unique('code');
    }
}
