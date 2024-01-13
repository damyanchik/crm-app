<?php

namespace App\Repositories;

use App\Models\ProductCategory;
use App\Traits\SearchableTrait;

class ProductCategoryRepository
{
    use SearchableTrait;

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
