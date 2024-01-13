<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Brand;
use App\Repositories\BrandRepository;

class BrandService
{
    public function __construct(protected BrandRepository $brandRepository)
    {
    }

    public function getAll(array $searchParams): object
    {
        return $this->brandRepository->searchAndSort(new Brand(), $searchParams);
    }

    public function store(array $validatedData): void
    {
        $this->brandRepository->store($validatedData);
    }

    public function update(Brand $brand, array $validatedData): void
    {
        $this->brandRepository->update($brand, $validatedData);
    }

    public function destroy(Brand $brand): void
    {
        $this->brandRepository->destroy($brand);
    }
}
