<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ProductCategory;
use App\Traits\SearchableTrait;

class ProductCategoryRepository extends BaseRepository
{
    use SearchableTrait;

    public function __construct(ProductCategory $model)
    {
        parent::__construct($model);
    }
}
