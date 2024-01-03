<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\IndexRequest;
use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;

class BrandService
{
    public function __construct(protected SearchService $searchService)
    {
    }

    public function getAll(IndexRequest $indexRequest): object
    {
        return $this->searchService->searchItems(new Brand(), $indexRequest);
    }

    public function store(FormRequest $request): void
    {
        Brand::create($request->validated());
    }

    public function update(Brand $brand, FormRequest $request): void
    {
        $brand->update($request->validated());
    }

    public function destroy(Brand $brand): void
    {
        $brand->delete();
    }
}
