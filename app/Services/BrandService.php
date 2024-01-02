<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;

class BrandService
{
    public function getAll(): object
    {
        return Brand::where(
            'name',
            'like',
            '%' . request('search') . '%'
        )->orderBy(
            request('column') ?? 'id',
            request('order') ?? 'asc'
        )->paginate(
            request('display')
        );
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
