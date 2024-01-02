<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Brand;

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

    public function store(array $formFields): void
    {
        Brand::create($formFields);
    }

    public function update(Brand $brand, array $formFields): void
    {
        $brand->update($formFields);
    }

    public function destroy(Brand $brand): void
    {
        $brand->delete();
    }
}
