<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Traits\SearchableTrait;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    use SearchableTrait;

    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    public function storeOrIgnoreMany(array $data): void
    {
        Brand::createOrIgnoreMany($data);
    }
}
