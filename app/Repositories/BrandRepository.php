<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Traits\SearchableTrait;

class BrandRepository
{
    use SearchableTrait;

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
