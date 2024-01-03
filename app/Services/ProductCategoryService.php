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

    public function store(FormRequest $request): void
    {
        ProductCategory::create($request->validated());
    }

    public function update(ProductCategory $productCategory, FormRequest $request): void
    {
        $productCategory->update($request->validated());
    }

    public function destroy(ProductCategory $productCategory): void
    {
        $productCategory->delete();
    }
}
