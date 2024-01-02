<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;

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
