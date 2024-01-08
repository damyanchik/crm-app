<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\IndexRequest;
use App\Models\Brand;

class BrandService
{
    public function __construct(protected SearchService $searchService)
    {
    }

    public function getAll(IndexRequest $indexRequest): object
    {
        return $this->searchService->searchItems(new Brand(), $indexRequest);
    }

    public function store(array $validatedData): void
    {
        Brand::create($validatedData);
    }

    public function update(Brand $brand, array $validatedData): void
    {
        $brand->update($validatedData);
    }

    public function destroy(Brand $brand): void
    {
        $brand->delete();
    }
}
