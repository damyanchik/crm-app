<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ProductCategory;
use App\Repositories\ProductCategoryRepository;

class ProductCategoryService
{
    public function __construct(protected ProductCategoryRepository $categoryRepository)
    {
    }

    public function getAll(array $searchParams): object
    {
        return $this->categoryRepository->searchAndSort($searchParams);
    }

    public function store(array $validatedData): void
    {
        $this->categoryRepository->store($validatedData);
    }

    public function update(ProductCategory $productCategory, array $validatedData): void
    {
        $this->categoryRepository->update($productCategory, $validatedData);
    }

    public function destroy(ProductCategory $productCategory): void
    {
        $this->categoryRepository->destroy($productCategory);
    }

    public function handleAjax(string $searchTerm): object
    {
        return $this->categoryRepository->searchWhereItems(
            $searchTerm,
            ['name']
        );
    }
}
