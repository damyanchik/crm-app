<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ProductCategory;

class ProductCategoryService
{
    public function getAll(): object
    {
        return ProductCategory::where(
            'name', 'like', '%' . request('search') . '%'
        )->orderBy(
            request('column') ?? 'id',
            request('order') ?? 'ASC'
        )->paginate(request('display'));
    }

    public function store(array $formFields): void
    {
        ProductCategory::create($formFields);
    }

    public function update(ProductCategory $productCategory, array $formFields): void
    {
        $productCategory->update($formFields);
    }

    public function destroy(ProductCategory $productCategory): void
    {
        $productCategory->delete();
    }
}
