<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ProductCategory;
use App\Repositories\Interfaces\ProductCategoryRepositoryInterface;
use App\Traits\SearchableTrait;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryRepositoryInterface
{
    use SearchableTrait;

    public function __construct(ProductCategory $model)
    {
        parent::__construct($model);
    }

    public function storeOrIgnoreMany(array $data): void
    {
        ProductCategory::createOrIgnoreMany($data);
    }
}
