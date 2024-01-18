<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Brand;

interface BrandRepositoryInterface
{
    public function __construct(Brand $model);
    public function storeOrIgnoreMany(array $data): void;
}
