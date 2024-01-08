<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\IndexRequest;
use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryService
{
    public function __construct(protected SearchService $searchService)
    {
    }

    public function getAll(IndexRequest $indexRequest): object
    {
        return $this->searchService->searchItems(new ProductCategory(), $indexRequest);
    }

    public function store(array $validatedData): void
    {
        ProductCategory::create($validatedData);
    }

    public function update(ProductCategory $productCategory, array $validatedData): void
    {
        $productCategory->update($validatedData);
    }

    public function destroy(ProductCategory $productCategory): void
    {
        $productCategory->delete();
    }
}
